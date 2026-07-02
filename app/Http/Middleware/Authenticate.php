<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Authenticate extends Middleware
{
    /**
     * Override handle function and pass Bearer token from cookies to request header
     * @param token Bearer token from cookies
     *
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->cookie(env("AUTH_TOKEN_NAME"));

        if ($token != null && $token != "" && !empty($token)) {
            $decToken = false;
            try {
                $decToken = Crypt::decryptString($token);
            } catch (DecryptException $e) {
                $decToken = false;
            }

            if ($decToken) {
                $request->headers->set('Authorization', 'Bearer ' . $decToken);
            }
        }

        return $next($request);
    }
}
