<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        $middleware->redirectTo(
            guests: '/account/login',             // if users try to access authenticated pages w/o logging in, they will be redirected to login page    
            users: '/account/dashboard'          // if users r already logged in and they r still trying to access dashboard, they r redirected to dashboard again
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
