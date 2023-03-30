<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

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
        $token = $request->cookie('_token');

        if ($token) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }

}
