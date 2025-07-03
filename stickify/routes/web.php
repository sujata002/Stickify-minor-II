<?php

use App\Http\Controllers\LoginController;            // importing this since we have used LoginController tala route ma
use App\Http\Controllers\DashboardController;  

Route::get('/', function () {
    return view('welcome');
});

//giving route for login.blade.php page ani teslai name deko euta account.login bhanera

Route::get('account/login',[LoginController::class,'index'])->name('account.login');
Route::post('account/authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
Route::get('account/dashboard',[DashboardController::class,'dashboard'])->name('account.dashboard');        
// 'dashboard' bhaneko chai uta controller ma method ko naam dashboard cha dont get confused

