<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Payment;
use App\Traits\UserCategoryTrait;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    use UserCategoryTrait;

    public function index(Request $request, $year)
    {
        if ($year == null || $year == '') {
            return response()->json(['message' => 'Invaild year'], 400);
        }

        $userID = $request->user()->id;

        $paymentTotalByCategory = Payment::where('payments.user_id', $userID)
            ->whereYear('date', $year)
            ->join('categories', 'categories.id', '=', 'payments.category_id')
            ->selectRaw('sum(amount) as total, category_id')
            ->groupBy('category_id')
            ->orderBy('category_id')
            ->get();
        $paymentTotalByCategory = $this->mapTotalByCategory($userID, $paymentTotalByCategory);

        $paymentTotalByMonth = Payment::where('payments.user_id', $userID)
            ->whereYear('date', $year)
            ->selectRaw('sum(amount) as total, month(date) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $paymentTotalByMonth = $this->mapMonth($paymentTotalByMonth);

        $totalPayments = Payment::where('user_id', $userID)
            ->whereYear('date', $year)
            ->sum('amount');

        $totalIncome = Income::where('user_id', $userID)
            ->whereYear('date', $year)
            ->sum('amount');

        $totalIncomeByMonth = Income::where('user_id', $userID)
            ->whereYear('date', $year)
            ->selectRaw('sum(amount) as total, month(date) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $totalIncomeByMonth = $this->mapMonth($totalIncomeByMonth);


        return response()->json([
            'payment_by_category' => $paymentTotalByCategory,
            'payment_by_month' => $paymentTotalByMonth,
            'total_payment' => $totalPayments,
            'total_income' => $totalIncome,
            'income_by_month' => $totalIncomeByMonth
        ]);
    }


    /**
     * Map total values of categories with user categories
     * @param [type] $userID
     * @param [type] $totals
     * @return void
     */
    private function mapTotalByCategory($userID, $totals)
    {
        $userCategories = $this->getUserCategories($userID);
        $mappedData = [];

        foreach ($userCategories as $category) {
            $newCategoryObj = [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'icon' => $category->icon,
                'total' => '0.00'
            ];

            foreach ($totals as $total) {
                if ($category->id == $total->category_id) {
                    $newCategoryObj['total'] = $total->total;
                }
            }
            array_push($mappedData, $newCategoryObj);
        }

        return $mappedData;
    }

    private function mapMonth($data)
    {
        $newData = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = [
                'month' => $i,
                'total' => '0.00'
            ];
            foreach ($data as $item) {
                if ($item->month == $i) {
                    $month['total'] = $item->total;
                }
            }
            array_push($newData, $month);
        }
        return $newData;
    }
}
