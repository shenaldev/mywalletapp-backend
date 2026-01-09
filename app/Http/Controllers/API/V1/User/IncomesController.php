<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeNote;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class IncomesController extends Controller
{
    /**
     * Get user incomes for specific date range
     */
    public function index(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $startDate = Carbon::createFromDate($request->year, $request->month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
        $userId = $request->user()->id;

        $incomes = Income::where('user_id', '=', $userId)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')->get();

        //GET TOTAL SUM OF ALL INCOMES
        $incomesSum = $incomes->sum('amount');

        return response()->json([
            'incomes' => $incomes,
            'total' => $incomesSum,
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

        DB::beginTransaction();
        try {
            $income = Income::create([
                'source' => Str::squish($request->source),
                'amount' => $request->amount,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'currency' => Str::upper($request->currency),
                'user_id' => $userID,
            ]);

            //Create Note If Exists
            $note = null;
            if ($request->filled('note')) {
                $note = IncomeNote::create([
                    'note' => $request->note,
                    'income_id' => $income->id,
                ]);
            }

            $income['note'] = $note;

            DB::commit();
            return response()->json(['income' => $income]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create income']);
        }
    }

    /**
     * Display the specified income.
     */
    public function show(Request $request, $id)
    {
        $income = Income::with(['income_note:id,note,income_id'])
            ->where('id', '=', $id)
            ->where('user_id', '=', $request->user()->id)
            ->firstOrFail();

        return response()->json($income);
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

        DB::beginTransaction();
        try {
            $income->source = $request->source;
            $income->amount = $request->amount;
            $income->date = Carbon::parse($request->date)->format('Y-m-d');;
            $income->currency = Str::upper($request->currency);
            $income->save();

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

            DB::commit();
            return response()->json(['message' => 'Income updated successful.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => 'Failed to update income.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $income = Income::findOrFail($id);

        if (!$this->isIncomeBelongsToUser($id, Auth::user()->id)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $note = $income->incomeNote;
        DB::beginTransaction();
        try {
            if ($note) {
                $note->delete();
            }

            $income->delete();

            DB::commit();
            return response()->json(['message' => 'Income deleted successful.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete income.'], 500);
        }
    }

    /**
     * Check if income belongs to user
     */
    private function isIncomeBelongsToUser(string $id, string $userID)
    {
        return Income::where('id', '=', $id)->where('user_id', '=', $userID)->exists();
    }
}
