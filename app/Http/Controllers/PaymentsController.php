<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentAdditionalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    /**
     * Get user payments for specific date range
     */
    public function getPayments(Request $request)
    {
        //
        $year = $request->year;
        $month = $request->month;
        $endDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $form = date($year . '-' . $month . '-01');
        $to = date($year . '-' . $month . '-' . $endDay);
        $user = Auth::user()->id;

        // Get All Payments by Category
        $payments = Payment::select('id', 'payment_for', 'amount', 'date', 'category_id')
            ->where('user_id', '=', $user)
            ->whereBetween('date', [$form, $to])
            ->where('category_id', '!=', '1') // Exclude Primary Category
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('category_id');

        //Payments Total By Category
        $totals = Payment::select('category_id', DB::raw('SUM(payments.amount) as total'))
            ->where('user_id', '=', $user)
            ->whereBetween('payments.date', [$form, $to])
            ->groupBy('category_id')
            ->get();

        // Get General Payments
        $generalPayments = Payment::select('id', 'payment_for', 'amount', 'date')
            ->where('user_id', '=', $user)
            ->whereBetween('date', [$form, $to])
            ->where('category_id', '=', '1')
            ->orderBy('date', 'asc')
            ->get();

        // GET TOTAL SUM OF ALL PAYMENTS
        $paymentsSum = Payment::where('user_id', '=', $user)
            ->whereBetween('date', [$form, $to])
            ->sum('amount');

        return response()->json([
            'payments' => $payments,
            'general' => $generalPayments,
            'totals' => $totals,
            'payments_sum' => $paymentsSum,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'payment_for' => 'required|string|min:3|max:200',
            'cost' => 'required|numeric',
            'date' => 'required|date',
            'category' => 'required',
            'additional_details' => "nullable|string|max:200",
        ]);

        $user_id = Auth::user()->id;
        $results = DB::transaction(function () use ($request, $user_id) {
            //Create Payment
            $payment = Payment::create([
                'payment_for' => $request->payment_for,
                'amount' => $request->cost,
                'date' => date($request->date),
                'category_id' => $request->category,
                'user_id' => $user_id,
            ]);

            //Create Addtional Detail If Exists
            if ($request->filled('additional_details')) {
                PaymentAdditionalDetail::create([
                    'details' => $request->additional_details,
                    'payment_id' => $payment->id,
                ]);
            }

            // Return error if unsuccessfull
            if (!$payment) {
                return response()->json(['payment' => null, 'errors' => true]);
            }

            return $payment;
        });

        return response()->json(['payment' => $results, 'errors' => false]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
