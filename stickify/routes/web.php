<?php

use App\Http\Controllers\admin\LoginController as AdminLoginController;     // created alias of admin/logincontroller since arko pani logincontroller cha
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\LoginController;            // importing this since we have used LoginController tala route ma
use App\Http\Controllers\DashboardController;  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ContactController;



//Option A: Redirected to laravel home page 
Route::get('/', function () {
     return view('home');
})->name('home'); // this is the home page of laravel app
//added by samira
           

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

        Route::get('logout',[LoginController::class,'logout'])->name('logout');          // this route is for logout
        Route::get('dashboard',[DashboardController::class,'dashboard'])->middleware('auth')->name('user.dashboard');    

    });

});
// laravel’s built-in Auth system and middleware do all of this when Auth::attempt() is called and protect routes with auth middleware.


/* for admin */

// this is outside the prefix because we want to login admins only in admin login. users are displayed unauthorization message is tried to login
Route::get('admin/login',[AdminLoginController::class,'index'])->name('admin.login');    
Route::post('admin/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users');                   // show users list
    Route::delete('/users/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');     // delete user route (for delete form)
    // added this promote route:
    Route::patch('/users/{id}/promote', [AdminDashboardController::class, 'promoteUser'])->name('admin.users.promote');

    // to edit and update user
    Route::get('/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');

});
Route::patch('/users/{id}/update-role', [AdminDashboardController::class, 'updateUserRole'])->name('admin.users.updateRole');    // for updating user's role thru users list in admin dashboard
Route::get('admin/logout',[AdminLoginController::class,'logout'])->name('admin.logout');    // this needs to be called in admin's dashboard blade file logout ko option ma


/*** for token part -- copy-pasted from dg-work manually ***/

// Dashboard route showing the token generation form
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Token generation POST route for normal form submit (if you keep it)
Route::post('/generate-token', [TokenController::class, 'generateToken'])->name('generate.token');

// API route for AJAX token generation (recommended for your modal)
Route::post('/api/generate-token', [TokenController::class, 'generateToken'])->name('api.generate.token');

    // notes route
Route::middleware('auth')->group(function () {
    Route::get('/notes', [NotesController::class, 'index']);
    Route::post('/notes', [NotesController::class, 'store']);
    Route::get('/notes/{id}', [NotesController::class, 'show']);
    Route::put('/notes/{id}', [NotesController::class, 'update']);
    Route::delete('/notes/{id}', [NotesController::class, 'destroy']);
});

//email contact form route
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

