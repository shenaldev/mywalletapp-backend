<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SinglePaymentResource;
use App\Models\Category;
use App\Models\Payment;
use App\Models\PaymentNote;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentsController extends Controller
{
    /**
     * Display a listing of payments grouped by category.
     */
    public function index(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $startDate = Carbon::createFromDate($request->year, $request->month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
        $userId = $request->user()->id;

        // Fetch categories with their payments in a single query
        $categories = Category::where(function ($query) use ($userId) {
            $query->where('primary', 1)
                ->orWhere('user_id', $userId);
        })
            ->with(['payments' => function ($query) use ($userId, $startDate, $endDate) {
                $query->where('user_id', $userId)
                    ->whereBetween('date', [$startDate, $endDate]);
            }])
            ->get()
            ->map(function ($category) {
                $category->total = $category->payments->sum('amount');
                return $category;
            });

        // Calculate monthly total
        $monthlyTotal = $categories->sum('total');

        return response()->json([
            'payments' => $categories,
            'total' => $monthlyTotal
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:200',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'note' => "nullable|string|max:200",
        ]);

        $userID = $request->user()->id;

        $results = DB::transaction(function () use ($request, $userID) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            //Create Payment
            $payment = Payment::create([
                'name' => Str::squish($request->name),
                'amount' => $request->amount,
                'date' => $date,
                'currency' => $request->user()->profile->default_currency,
                'category_id' => $request->category_id,
                'payment_method_id' => $request->payment_method_id,
                'user_id' => $userID,
            ]);

            //Create Payment Note If Exists
            $note = null;
            if ($request->filled('note')) {
                $note = PaymentNote::create([
                    'note' => $request->note,
                    'payment_id' => $payment->id,
                ]);
            }

            if (!$payment) {
                return response()->json(['message' => 'Payment not created'], 500);
            }

            return ['payment' => $payment, 'note' => $note];
        });

        return response()->json($results, 201);
    }

    /**
     * Display the specified payment.
     */
    public function show(Request $request, $id)
    {
        $payment = Payment::where('id', '=', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json(new SinglePaymentResource($payment));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:200',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'note' => 'nullable|string|max:200',
        ]);

        $payment = Payment::findOrFail($id);

        // Authorization check
        if ($payment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            DB::transaction(function () use ($request, $payment) {
                // Update payment
                $payment->update([
                    'name' => $request->name,
                    'amount' => $request->amount,
                    'date' => Carbon::parse($request->data)->format('Y-m-d'),
                    'category_id' => $request->category_id,
                    'payment_method_id' => $request->payment_method_id,
                ]);

                // Handle payment note
                if (!empty($request->note)) {
                    $payment->payment_note()->updateOrCreate(
                        ['payment_id' => $payment->id],
                        ['note' => $request->note]
                    );
                } else {
                    // Delete note if it exists and note is empty
                    $payment->payment_note()->delete();
                }
            });

            return response()->json([
                'message' => 'Payment updated successfully',
                'data' => $payment
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update payment',
                'error' => config('app.debug') ? $e->getMessage() : 'An error occurred'
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);

        if (!$this->isPaymentBelongsToUser($id, Auth::user()->id)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $paymentNote = $payment->paymentNote;
        $results = DB::transaction(function () use ($payment, $paymentNote) {
            if ($paymentNote) {
                $paymentNote->delete();
            }

            $payment->delete();
            return $payment;
        });

        if (!$results) {
            return response()->json(['message' => 'Payment not deleted'], 500);
        }

        return response()->json(['message' => 'Payment deleted'], 200);
    }

    /**
     * Check if payment belongs to user
     */
    private function isPaymentBelongsToUser($id, $userID)
    {
        return Payment::where('id', $id)->where('user_id', $userID)->exists();
    }
}
