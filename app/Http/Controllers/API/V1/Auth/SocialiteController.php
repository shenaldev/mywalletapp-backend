<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    protected $COOKIE_EXPIRE_TIME = 1 * (60 * 24 * 7);
    protected $AUTH_COOKIE_NAME = 'mywallet_token';

    public function authenticate(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        try {
            /** @var \Laravel\Socialite\Two\GoogleProvider $google */
            $google = Socialite::driver('google');

            $user = $google->userFromToken($request->token);
            $user = $this->FindOrCreate($user);

            $token = $user->createToken('authToken')->plainTextToken;
            $encToken = Crypt::encryptString($token);
            $response = [
                'user' => $user,
                'token' => $encToken,
            ];

            $cookie = Cookie::make($this->AUTH_COOKIE_NAME, $encToken, $this->COOKIE_EXPIRE_TIME);

            return response()->json($response, 201)->withCookie($cookie);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);
        }
    }


    private function FindOrCreate($oauthUser)
    {
        $userInDB = User::where('email', $oauthUser->email)
            ->with('userProfile')
            ->first();

        // If user not found, create new user
        if (!$userInDB) {
            $newUser = User::create([
                'name' => $oauthUser->name,
                'email' => $oauthUser->email,
            ]);

            UserProfile::create([
                'user_id' => $newUser->id,
                'avatar' => $oauthUser->avatar,
            ]);

            $newUser->markEmailAsVerified();
            $newUser = $newUser->load('userProfile');

            return $newUser;
        }

        return $userInDB;
    }
}
