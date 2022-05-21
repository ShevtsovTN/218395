<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
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
     * @return array|string|null
     * @throws AuthenticationException|Exception
     */
    public function authenticate($request, $guards): array|string|null
    {
        $access_key = $request->header('Authorization')?? null;

        if ($access_key === config('app_key.access_key')) {
            return $access_key;
        }
        throw new Exception('App key failure', 403);
    }
}
