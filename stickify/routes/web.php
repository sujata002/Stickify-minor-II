<?php
use Illuminate\Support\Facades\Route; // yo added 

use App\Http\Controllers\TokenController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth'); // ensure user is logged in

Route::post('/generate-token', [TokenController::class, 'generateToken'])
    ->name('generate.token')
    ->middleware('auth');


    //yo ni add gareko ani pachi chalna thanlyo laravel exception dekhayo navaye
Route::get('/login', function () {
    return view('dashboard'); // or whatever Blade view you're using
})->name('login');
