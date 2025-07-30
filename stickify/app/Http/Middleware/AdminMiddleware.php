<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // checking if admin is logged in or not. if not logged in and trying to access dashboard page, admin is redirected to admin/login page
        if(!Auth::user()){
             return redirect()->route('admin.login');
        }elseif(Auth::user()->role != 'admin'){
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}