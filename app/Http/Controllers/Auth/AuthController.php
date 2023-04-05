<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $COOKIE_EXPIRE_TIME = 1 * (60 * 24 * 7);
    protected $AUTH_COOKIE_NAME = '_token';
    /**
     * Login Function
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "The provided credentials do not match our records"], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        $cookie = Cookie::make($this->AUTH_COOKIE_NAME, $token, $this->COOKIE_EXPIRE_TIME);

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

        $result = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if (!$user) {
                return response()->json(['error' => 'Registration Faild.'], 500);
            }

            $user->markEmailAsVerified();
            return $user;
        });

        $token = $result->createToken('authToken')->plainTextToken;
        $response = [
            'user' => $result,
        ];

        $cookie = cookie($this->AUTH_COOKIE_NAME, $token, $this->COOKIE_EXPIRE_TIME);

        return response()->json($response, 201)->withCookie($cookie);

    }

    /**
     * Logout Function
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $cookie = Cookie::forget($this->AUTH_COOKIE_NAME);
        $sesion_cookie = Cookie::forget('my_wallet_session');

        return response()->json(['logout' => true], 200)->withCookie($cookie)->withCookie($sesion_cookie);
    }

    /**
     * Check Token Is Expired
     */
    public function checkToken()
    {
        return response()->json('true', 200);
    }
}
