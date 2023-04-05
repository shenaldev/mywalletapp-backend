<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeAdditionalDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncomesController extends Controller
{
    /**
     * Get user incomes for specific date range
     */
    public function getIncomes(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $endDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $form = date($year . '-' . $month . '-01');
        $to = date($year . '-' . $month . '-' . $endDay);
        $user = Auth::user()->id;

        $incomes = Income::select('id', 'from', 'value', 'date')
            ->where('user_id', '=', $user)
            ->whereBetween('date', [$form, $to])
            ->orderBy('date', 'asc')->get();

        //GET TOOTAL SUM OF ALL INCOMES
        $incomesSum = Income::where('user_id', '=', $user)
            ->whereBetween('date', [$form, $to])
            ->sum('value');

        return response()->json([
            'incomes' => $incomes,
            'incomes_sum' => $incomesSum,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //
        $request->validate([
            'from' => 'required|string|min:3|max:200',
            'value' => 'required|numeric',
            'date' => 'required|date',
            'additional_details' => "nullable|string|max:200",
        ]);

        $user_id = Auth::user()->id;
        $results = DB::transaction(function () use ($request, $user_id) {
            //Create Payment
            $income = Income::create([
                'from' => $request->from,
                'value' => $request->value,
                'date' => date($request->date),
                'user_id' => $user_id,
            ]);

            //Create Addtional Detail If Exists
            if ($request->filled('additional_details')) {
                IncomeAdditionalDetails::create([
                    'details' => $request->additional_details,
                    'income_id' => $income->id,
                ]);
            }

            // Return error if unsuccessfull
            if (!$income) {
                return response()->json(['income' => null, 'errors' => true]);
            }

            return $income;
        });

        return response()->json(['icome' => $results, 'errors' => false]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
