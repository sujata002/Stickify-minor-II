<?php

use App\Http\Controllers\admin\LoginController as AdminLoginController;     // created alias of admin/logincontroller since arko pani logincontroller cha
use App\Http\Controllers\LoginController;            // importing this since we have used LoginController tala route ma
use App\Http\Controllers\DashboardController;  
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// this is grouped for users, like what pages they can access. Users cant access dashboard without logging in

Route::group(['prefix' => 'account'],function(){             // prefix example: /account/login, /account/register, etc.

    // this is guest middleware for users who are not logged in
    Route::group(['middleware' => 'guest'], function(){            // middleware named guest and call back function 

        Route::get('login',[LoginController::class,'index'])->name('login');
        Route::get('register',[LoginController::class,'register'])->name('register');
        Route::post('process-register',[LoginController::class,'processRegister'])->name('processRegister');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('authenticate');

    });

    // this is Authenticated middleware for people who are logged in
    Route::group(['middleware' => 'auth'], function(){          

        // Route::get('logout',[LoginController::class,'logout'])->name('logout');          this route is for logout. uncomment it after logout functionality is done
        Route::get('dashboard',[DashboardController::class,'dashboard'])->middleware('auth')->name('user.dashboard');    


    });

});

// laravel’s built-in Auth system and middleware do all of this when Auth::attempt() is called and protect routes with auth middleware.

Route::get('admin/login',[AdminLoginController::class,'index'])->name('admin.login');

