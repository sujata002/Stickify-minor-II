<?php

use App\Http\Controllers\LoginController;            // importing this since we have used LoginController tala route ma

Route::get('/', function () {
    return view('welcome');
});

//giving route for login.blade.php page ani teslai name deko euta account.login bhanera

Route::get('account/login',[LoginController::class,'index'])->name('account.login');
Route::post('account/authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');

