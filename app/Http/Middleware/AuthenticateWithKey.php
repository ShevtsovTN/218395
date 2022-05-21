<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AuthenticateWithKey extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param string[] ...$guards
     * @return string|array
     *
     * @throws AuthenticationException
     */
    public function authenticate($request, $guards): string|array
    {
        $access_key = $request->header('Authorization')?? null;

        if ($access_key) {
            return $access_key;
        }

        $this->unauthenticated($request, $guards);
    }
}
