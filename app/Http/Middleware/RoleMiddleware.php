<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, string $roles = '')
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $allowed = array_map('trim', explode(',', $roles));

        if (! in_array(Auth::user()->role, $allowed, true)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
