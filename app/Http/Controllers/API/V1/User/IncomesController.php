<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeNote;
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
            'source' => 'required|string|min:3|max:200',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'currency' => 'required|max:3',
            'note' => "nullable|string|max:500",
        ]);

        $userID = $request->user()->id;
        $results = DB::transaction(function () use ($request, $userID) {
            //Create Payment
            $income = Income::create([
                'source' => $request->source,
                'amount' => $request->amount,
                'date' => date($request->date),
                'currency' => $request->currency,
                'user_id' => $userID,
            ]);

            //Create Addtional Detail If Exists
            $note = null;
            if ($request->filled('note')) {
                $note = IncomeNote::create([
                    'note' => $request->note,
                    'income_id' => $income->id,
                ]);
            }

            if (!$income) {
                return response()->json(["message" => "Income not created"], 400);
            }

            return ['income' => $income, 'note' => $note];
        });

        return response()->json($results);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'source' => 'required|string|min:3|max:200',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'currency' => 'required|max:3',
            'note' => "nullable|string|max:500",
        ]);

        $income = Income::find($id);
        $note = $income->incomeNote;

        $results = DB::transaction(function () use ($request, $income, $note) {
            //Update Income
            $income->source = $request->source;
            $income->amount = $request->amount;
            $income->date = $request->date;
            $income->currency = $request->currency;
            $income->save();

            //Update Income Note If Exists
            if ($request->filled('note')) {
                if (empty($note)) {
                    IncomeNote::create([
                        'note' => $request->note,
                        'income_id' => $income->id,
                    ]);
                } else {
                    $note->note = $request->note;
                    $note->save();
                }
            } else {
                //DELETE Income Note IF FIELD IS EMPTY AND EXISTS IN DATABASE
                if (!empty($note)) {
                    $note->delete();
                }
            }

            return $income;
        });

        if (!$results) {
            return response()->json(['message' => 'Income not updated'], 400);
        }

        $newIncomeData = Income::find($id);
        $newIncomeData->incomeNote;
        return response()->json($newIncomeData, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->isIncomeExists($id)) {
            return response()->json(['message' => 'Income not found'], 404);
        }

        if (!$this->isIncomeBelongsToUser($id, Auth::user()->id)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $income = Income::find($id);
        $note = $income->incomeNote;

        $results = DB::transaction(function () use ($income, $note) {
            if ($note) {
                $note->delete();
            }

            $income->delete();
            return true;
        });

        if (!$results) {
            return response()->json(['message' => 'Income not deleted'], 500);
        }

        return response()->json(['message' => 'Income deleted'], 200);
    }

    /**
     * Check if income exists
     */
    private function isIncomeExists(string $id)
    {
        return Income::where('id', '=', $id)->exists();
    }

    /**
     * Check if income belongs to user
     */
    private function isIncomeBelongsToUser(string $id, string $userID)
    {
        return Income::where('id', '=', $id)->where('user_id', '=', $userID)->exists();
    }
}
