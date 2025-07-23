<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard route with auth middleware
Route::get('/dashboard', function () {
    return view('dashboard'); // Ensure resources/views/dashboard.blade.php exists
})->name('dashboard')->middleware('auth');

// Token generation route with auth middleware
Route::post('/generate-token', [TokenController::class, 'generateToken'])
    ->name('generate.token')
    ->middleware('auth');
