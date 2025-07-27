<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user()->role);
        // checking if user is logged in or not. if not logged in and trying to access dashboard page, user is redirected to account/login page
        if(Auth::user() == null){
            return redirect()->route('login');
        }else{
            
        if(Auth::user()->role != 'user'){
                return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
