<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class GetPaymentsController extends Controller
{
    /**
     * Get payments and payments from database then
     * group payments by category
     * take monthly total
     * return response
     */
    public function getPayments(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $endDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $from = date($year . '-' . $month . '-01');
        $to = date($year . '-' . $month . '-' . $endDay);
        $userID = Auth::user()->id;

        $categories = Category::where("primary", 1)
            ->orWhere("user_id", $userID)
            ->get();
        $payments = Payment::where('user_id', $userID)
            ->whereBetween('date', [$from, $to])
            ->get();
        $mappedPayments = $this->getPaymentsByCategories($categories, $payments);

        //GET SUM OF MONTHLY PAYMENTS BY CATEGORY
        $monthlyTotal = Payment::where('user_id', $userID)
            ->whereBetween('date', [$from, $to])
            ->sum('amount');


        return response()->json(["payments" => $mappedPayments, "total" => $monthlyTotal]);
    }

    /**
     * Group payments by category
     */
    private function getPaymentsByCategories($categories, $payments)
    {
        $collect = collect();
        foreach ($categories as $category) {
            $currentCategory = $category;
            $currentCategory->payments = collect();
            $total = 0;
            foreach ($payments as $payment) {
                if ($payment->category_id == $category->id) {
                    $currentCategory->payments->push($payment);
                    $total += $payment->amount;
                }
            }
            $currentCategory->total = $total;
            $collect->push($currentCategory);
            $total = 0;
        }

        return $collect;
    }
}
