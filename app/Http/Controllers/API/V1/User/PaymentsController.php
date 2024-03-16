<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use App\Models\PaymentMethod;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:200',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'currency' => 'required|string|max:3',
            'category_id' => 'required',
            'payment_method_id' => 'required',
            'note' => "nullable|string|max:200",
        ]);

        $userID = $request->user()->id;

        if (!$this->isCategoryExist($request->category_id)) {
            return response()->json(['message' => 'Category does not exist'], 400);
        }

        if (!$this->isPaymentMethodExist($request->payment_method_id)) {
            return response()->json(['message' => 'Payment Method does not exist'], 400);
        }


        $results = DB::transaction(function () use ($request, $userID) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            //Create Payment
            $payment = Payment::create([
                'name' => $request->name,
                'amount' => $request->amount,
                'date' => $date,
                'currency' => Str::upper($request->currency),
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:200',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'currency' => 'required|string|max:3',
            'category_id' => 'required',
            'payment_method_id' => 'required',
            'note' => "nullable|string|max:200",
        ]);

        if (!$this->isPaymentBelongsToUser($id, Auth::user()->id)) {
            return response()->json(['message' => 'Unathorized'], 401);
        }

        $payment = Payment::find($id);
        $paymentNote = $payment->paymentNote;

        $results = DB::transaction(function () use ($request, $payment, $paymentNote) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            //UPDATE PAYMENT
            $payment->name = $request->name;
            $payment->amount = $request->amount;
            $payment->date = $date;
            $payment->currency = Str::upper($request->currency);
            $payment->category_id = $request->category_id;
            $payment->payment_method_id = $request->payment_method_id;
            $payment->save();

            //CREATE OR UPDATE PAYMENT NOTE
            if ($request->filled('note')) {
                if (empty($paymentNote)) {
                    PaymentNote::create([
                        'note' => $request->note,
                        'payment_id' => $payment->id,
                    ]);
                } else {
                    $paymentNote->note = $request->note;
                    $paymentNote->save();
                }
            } else {
                if (!empty($paymentNote)) {
                    try {
                        $paymentNote->delete();
                    } catch (Exception $e) {
                        return;
                    }
                }
            }

            return $payment;
        });

        if (!$results) {
            return response()->json(['message' => 'Payment not updated'], 500);
        }

        $newPayment = Payment::find($id);
        $newPayment->paymentNote;
        return response()->json($newPayment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Payment::find($id) === null) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if (!$this->isPaymentBelongsToUser($id, Auth::user()->id)) {
            return response()->json(['message' => 'Unathorized'], 401);
        }

        $payment = Payment::find($id);
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
     * Check if category exists
     */
    private function isCategoryExist($id)
    {
        return Category::where('id', $id)->exists();
    }

    /**
     * Check if payment method exists
     */
    private function isPaymentMethodExist($id)
    {
        return PaymentMethod::where('id', $id)->exists();
    }

    /**
     * Check if payment belongs to user
     */
    private function isPaymentBelongsToUser($id, $userID)
    {
        return Payment::where('id', $id)->where('user_id', $userID)->exists();
    }
}
