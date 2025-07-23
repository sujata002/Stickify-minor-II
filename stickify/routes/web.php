<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); // ensure user is logged in

Route::post('/generate-token', [TokenController::class, 'generateToken'])
    ->name('generate.token')
    ->middleware('auth');
