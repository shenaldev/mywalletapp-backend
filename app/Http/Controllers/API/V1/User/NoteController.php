<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeNote;
use App\Models\Payment;
use App\Models\PaymentNote;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Get Payment Note
     * @param $request
     * @param $id = payment id
     * 
     */
    public function get_payment_note(Request $request, $id)
    {
        $userId = $request->user()->id;

        $payment = Payment::where('user_id', '=', $userId)
            ->where('id', '=', $id)
            ->exists();

        if (!$payment) {
            return response()->json([
                'message' => 'Unauthorized resource'
            ], 403);
        }

        $note = PaymentNote::where('payment_id', '=', $id)->first();
        return response()->json($note);
    }

    /**
     * Get Income Note
     * @param $request
     * @param $id = income id
     * 
     */
    public function get_income_note(Request $request, $id)
    {
        $userId = $request->user()->id;

        $income = Income::where('user_id', '=', $userId)
            ->where('id', '=', $id)
            ->exists();

        if (!$income) {
            return response()->json([
                'message' => 'Unauthorized resource'
            ], 403);
        }

        $note = IncomeNote::where('income_id', '=', $id)->first();
        return response()->json($note);
    }
}
