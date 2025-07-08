<?php

use App\Http\Controllers\LoginController;            // importing this since we have used LoginController tala route ma
use App\Http\Controllers\DashboardController;  

Route::get('/', function () {
    return view('welcome');
});

//giving route for login.blade.php page ani teslai name deko euta account.login bhanera

Route::get('/account/login',[LoginController::class,'index'])->name('login');

Route::get('/account/register',[LoginController::class,'register'])->name('register');

Route::post('/account/process-register',[LoginController::class,'processRegister'])->name('processRegister');

Route::post('/account/authenticate',[LoginController::class,'authenticate'])->name('authenticate');

Route::get('/account/dashboard',[DashboardController::class,'dashboard'])->middleware('auth')->name('user.dashboard');        
// 'dashboard' bhaneko chai uta controller ma method ko naam dashboard cha dont get confused