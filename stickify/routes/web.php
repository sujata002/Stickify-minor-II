<?php

use App\Http\Controllers\admin\LoginController as AdminLoginController;     // created alias of admin/logincontroller since arko pani logincontroller cha
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\LoginController;            // importing this since we have used LoginController tala route ma
use App\Http\Controllers\DashboardController;  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Models\Note;
use App\Http\Controllers\NotesViewController;


// this is my route

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});


// Dashboard route showing the token generation form
Route::get('/dashboard', function () {
    $notes = Note::where('user_id', auth()->id())->get();  // Fetch notes for logged-in user
    return view('dashboard', compact('notes'));             // Pass notes to view
})->middleware('auth')->name('dashboard');

// Token generation POST route for normal form submit (if you keep it)
Route::post('/generate-token', [TokenController::class, 'generateToken'])
    ->name('generate.token');
// API route for AJAX token generation (recommended for your modal)
Route::post('/api/generate-token', [TokenController::class, 'generateToken'])
    ->name('api.generate.token');

Route::middleware('auth')->group(function () {
    // My Notes Blade View
    Route::get('/mynotes', [NotesViewController::class, 'index'])->name('mynotes');
    Route::get('/mynotes/create', [NotesViewController::class, 'create'])->name('mynotes.create');
    Route::post('/mynotes/store', [NotesViewController::class, 'store'])->name('mynotes.store');
    Route::get('/mynotes/edit/{id}', [NotesViewController::class, 'edit'])->name('mynotes.edit');
    Route::post('/mynotes/update/{id}', [NotesViewController::class, 'update'])->name('mynotes.update');
    Route::get('/mynotes/delete/{id}', [NotesViewController::class, 'delete'])->name('mynotes.delete');

    Route::get('/mynotes/trash', [NotesViewController::class, 'trash'])->name('mynotes.trash');
    Route::post('/mynotes/restore/{id}', [NotesViewController::class, 'restore'])->name('mynotes.restore');
    Route::delete('/mynotes/destroy/{id}', [NotesViewController::class, 'destroy'])->name('mynotes.destroy');

});


// pulled from sk-work for login and sigup logic

// Route::get('/', function () {
//     return view('welcome');
// });

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


// for admin

Route::get('admin/login',[AdminLoginController::class,'index'])->name('admin.login');
// Route::get('admin/dashboard',[AdminDashboardController::class,'dashboard'])->middleware('auth:admin')->name('admin.dashboard');    
Route::post('admin/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

});
Route::get('admin/logout',[AdminLoginController::class,'logout'])->name('admin.logout');    // this needs to be called in admin's dashboard blade file logout ko option ma


