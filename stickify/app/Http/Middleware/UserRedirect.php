<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRedirect
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            // If user is logged in and role is 'user', redirect them to their dashboard
            return redirect()->route('user.dashboard');
        }

        // Otherwise, allow request to proceed (e.g., to login/register pages)
        return $next($request);
    }
}
