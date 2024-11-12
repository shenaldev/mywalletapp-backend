<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Current password is incorrect']
            ]);
            return;
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully'], 200);
    }
}
