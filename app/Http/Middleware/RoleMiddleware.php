<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        abort_if(auth()->user()->role !== $role, 403);
        return $next($request);
    }
}