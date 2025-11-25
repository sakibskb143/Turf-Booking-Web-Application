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
            return redirect()->route('users.login')->with('error', 'Please login to access this page.');
        }

        $userRole = $request->user()->role;
        
        if (!in_array($userRole, $roles, true)) {
            // Redirect based on user's actual role
            $redirectRoute = match ($userRole) {
                'owner' => 'owner.dashboard',
                'admin' => 'admin.dashboard',
                default => 'user.dashboard',
            };
            
            return redirect()->route($redirectRoute)
                ->with('error', 'You are not authorized to access this resource.');
        }

        return $next($request);
    }
}

