<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Overide handle function and pass Bearer token from cookies to request header
     * @param token Bearer token from cookies
     *
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->cookie(env("AUTH_TOKEN_NAME"));
        $decToken = false;

        if ($token == null || "" || empty($token)) {
            return response()->json(["message" => "Unauthenticated.", "token" => false], 401);
        }

        try {
            $decToken = Crypt::decryptString($token);
        } catch (DecryptException $e) {
            $decToken = false;
        }

        if ($decToken) {
            $request->headers->set('Authorization', 'Bearer ' . $decToken);
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }
}
