<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * GET the oldest record year of the user
     */
    public function getRecordYears(Request $request)
    {
        $userID = $request->user()->id;

        if (!$userID) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $oldestPaymentRecord = Payment::where('user_id', $userID)->oldest('date')->first();
        $oldestIncomeRecord = Income::where('user_id', $userID)->oldest('date')->first();
        $paymentYear = Carbon::create($oldestPaymentRecord?->date ?? now());
        $incomeYear = Carbon::create($oldestIncomeRecord?->date ?? now());

        if ($paymentYear->lessThan($incomeYear)) {
            return response()->json($paymentYear->year, 200);
        } else {
            return response()->json($incomeYear->year, 200);
        }
    }
}
