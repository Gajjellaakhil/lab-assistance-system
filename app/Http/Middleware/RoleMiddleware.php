<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // Check for admin guard
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasRole($role)) {
            return $next($request);
        }

        // Check for web (student) guard
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole($role)) {
            return $next($request);
        }

        // If the user doesn’t have the required role, abort with 403
        abort(403, 'Unauthorized action.');
    }
}
