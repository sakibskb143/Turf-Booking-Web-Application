<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * @param  array<int, string>  $roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('users.login');
        }

        if (!in_array($request->user()->role, $roles, true)) {
            abort(Response::HTTP_FORBIDDEN, 'You are not authorized to access this resource.');
        }

        return $next($request);
    }
}

