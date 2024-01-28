<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Payment;
use Illuminate\Support\Number;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generate(Request $request, $year)
    {
        if ($year == null || $year == '') {
            return response("Not Valid Year", 400);
        }

        $userID = $request->user()->id;

        $totalIncome = Income::where('user_id', $userID)
            ->whereYear('date', $year)
            ->sum('value');
        $totalSpent = Payment::where('user_id', $userID)
            ->whereYear('date', $year)
            ->sum('amount');

        $monthlyIncome = Income::where('user_id', $userID)
            ->whereYear('date', $year)
            ->selectRaw('sum(value) as total, MONTH(date) as month')
            ->groupBy('month')
            ->get();

        $monthlySpent = Payment::where('user_id', $userID)
            ->whereYear('date', $year)
            ->selectRaw('sum(amount) as total, MONTH(date) as month')
            ->groupBy('month')
            ->get();

        $paymentsGroupedByCategory = Payment::where('user_id', $userID)
            ->whereYear('date', $year)
            ->join('categories', 'categories.id', '=', 'payments.category_id')
            ->selectRaw('sum(amount) as total, category_id, categories.slug as category_slug')
            ->groupBy('category_id')
            ->get();

        return response()->json([
            'total_income' => Number::format($totalIncome, 2),
            'total_spent' => Number::format($totalSpent, 2),
            'monthly_income' => $monthlyIncome,
            'monthly_spent' => $monthlySpent,
            'payment_by_category' => $paymentsGroupedByCategory
        ]);
    }
}
