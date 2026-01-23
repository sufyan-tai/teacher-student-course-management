<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== $role) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
