<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\NotesController; 


Route::post('/verify-token', [TokenController::class, 'verifyToken']);

Route::post('/notes', [NotesController::class, 'saveNote']);