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
            ->with('additionalDetails:id,details,income_id')
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
        $request->validate([
            'from' => 'required|string|min:3|max:200',
            'value' => 'required|numeric',
            'date' => 'required|date',
            'additional_details' => "nullable|string|max:200",
        ]);

        $user_id = Auth::user()->id;
        $results = DB::transaction(function () use ($request, $user_id) {
            //Create Payment
            $additional_details = null;
            $income = Income::create([
                'from' => $request->from,
                'value' => $request->value,
                'date' => date($request->date),
                'user_id' => $user_id,
            ]);

            //Create Addtional Detail If Exists
            if ($request->filled('additional_details')) {
                $detals = IncomeAdditionalDetails::create([
                    'details' => $request->additional_details,
                    'income_id' => $income->id,
                ]);
                $additional_details = $detals;
            }

            // Return error if unsuccessfull
            if (!$income) {
                return response()->json(['income' => null, 'errors' => true]);
            }

            $newIncome = [
                'id' => $income->id,
                'from' => $income->from,
                'value' => $income->value,
                'date' => $income->date,
                'additional_details' => $additional_details,
            ];

            return $newIncome;
        });

        return response()->json(['income' => $results, 'errors' => false]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'from' => 'required|string|min:3|max:200',
            'value' => 'required|numeric',
            'date' => 'required|date',
            'additional_details' => "nullable|string|max:200",
        ]);

        $income = Income::find($id);
        $additional_details = $income->additionalDetails;

        $results = DB::transaction(function () use ($request, $income, $additional_details) {
            //Update Income
            $income->from = $request->from;
            $income->value = $request->value;
            $income->date = $request->date;
            $income->save();

            //Update Additional Details If Exists
            if ($request->filled('additional_details')) {
                if (empty($additional_details)) {
                    IncomeAdditionalDetails::create([
                        'details' => $request->additional_details,
                        'income_id' => $income->id,
                    ]);
                } else {
                    $additional_details->details = $request->additional_details;
                    $additional_details->save();
                }
            } else {
                //DELETE ADDITIONAL DETAILS IF FIELD IS EMPTY AND EXISTS IN DATABASE

                if (!empty($additional_details)) {
                    $additional_details->delete();
                }
            }
            // RETURN FALSE IF UNSUCCESSFULL
            if (!$income) {
                return false;
            }
            return true;
        });

        if (!$results) {
            return response()->json(['income' => null, 'errors' => true]);
        }

        $newIncomeData = Income::find($id);
        $newIncomeData->additionalDetails;
        return response()->json(['income' => $newIncomeData, 'errors' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $income = Income::find($id);
        $delete = Income::destroy($id);

        if ($delete) {
            return response()->json(['success' => true, 'income' => $income], 200);
        }

        return response()->json(['success' => false, 'income' => null], 404);

    }
}
