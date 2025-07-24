<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard route showing the token generation form
Route::get('/dashboard', function () {
    return view('dashboard'); // Make sure dashboard.blade.php exists with your form
})->name('dashboard');

// Token generation POST route for normal form submit (if you keep it)
Route::post('/generate-token', [TokenController::class, 'generateToken'])
    ->name('generate.token');

// API route for AJAX token generation (recommended for your modal)
Route::post('/api/generate-token', [TokenController::class, 'generateToken'])
    ->name('api.generate.token');
