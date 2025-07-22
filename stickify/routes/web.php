<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

// Show token generation form
Route::get('/generate-token', [TokenController::class, 'showForm'])->name('token.form');

// Handle token generation request
Route::post('/generate-token', [TokenController::class, 'generateToken'])->name('generate.token');
