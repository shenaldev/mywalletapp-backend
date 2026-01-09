<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $COOKIE_EXPIRE_TIME = 1 * (60 * 24 * 7);
    protected $AUTH_COOKIE_NAME = 'mywallet_token';
    /**
     * Login Function
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
            ->with('profile')
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "The provided credentials do not match our records"], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;
        $encToken = Crypt::encryptString($token);
        $response = [
            'user' => $user,
            'token' => $encToken,
        ];

        $cookie = Cookie::make($this->AUTH_COOKIE_NAME, $encToken, $this->COOKIE_EXPIRE_TIME);

        return response()->json($response, 201)->withCookie($cookie);
    }

    /**
     * Register User Function
     * @param Request $request user Data
     * @return $user $token
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:200',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var User $result */
        $result = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            UserProfile::create([
                'default_currency' => 'USD',
                'user_id' => $user->id,
            ]);

            if (!$user) {
                return response()->json(['error' => 'Registration Failed.'], 500);
            }

            return $user;
        });

        $user = User::with('profile')->find($result->id);

        if ($user) {
            $token = $user->createToken('authToken')->plainTextToken;
            $encToken = Crypt::encryptString($token);
            $response = [
                'user' => $user,
                'token' => $encToken,
            ];

            $cookie = cookie($this->AUTH_COOKIE_NAME, $encToken, $this->COOKIE_EXPIRE_TIME);

            return response()->json($response, 201)->withCookie($cookie);
        }
    }

    /**
     * Logout Function
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $cookie = Cookie::forget($this->AUTH_COOKIE_NAME);
        $session_cookie = Cookie::forget('my_wallet_session');

        return response()->json(['logout' => true], 200)->withCookie($cookie)->withCookie($session_cookie);
    }

    /**
     * Check Token Is Expired
     */
    public function checkToken(Request $request)
    {
        if ($request->user()) {
            return response()->json(['token' => true], 200);
        }
        return response()->json(["message" => "Unauthenticated.", "token" => false], 401);
    }

    /**
     * Remove Cookies From Browser When User Token Has Expired
     */
    public function removeCookies()
    {
        $tokenCookie = Cookie::forget($this->AUTH_COOKIE_NAME);
        return response()->json(['success' => true], 200)->withCookie($tokenCookie);
    }
}
