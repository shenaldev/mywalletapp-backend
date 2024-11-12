<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Payment;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    use ImageUploadTrait;

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

    /**
     * Update user and user profile
     * if the user has an avatar, delete the current avatar and upload the new one
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'default_currency' => 'required|string|max:3',
        ]);

        $user = User::findOrfail($request->user()->id);

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $currentAvatar = $user->userProfile->avatar;
            if ($currentAvatar) {
                $this->deleteImage($currentAvatar);
            }

            $avatar = $this->uploadImage($request->file('avatar'), 'avatars');
            $user->userProfile->avatar = $avatar;
            $user->userProfile->save();
        }

        $user->name = $request->name;
        $user->userProfile->default_currency = $request->default_currency;
        $user->userProfile->save();
        $user->save();

        $user = $user->load('userProfile');

        return response()->json($user, 200);
    }
}
