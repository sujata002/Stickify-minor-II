<?php

use Illuminate\Http\Request;
use App\Http\Controllers\admin\LoginController as AdminLoginController;     // created alias of admin/logincontroller since arko pani logincontroller cha
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\LoginController;            // importing this since we have used LoginController tala route ma
use App\Http\Controllers\DashboardController;  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Models\Note;
use App\Http\Controllers\NotesViewController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StripeController;

//swekchya ko token ko lagi matra ho yo 
Route::get('/extension/check-login', function () {
    if (Auth::check()) {
        return response()->json(['logged_in' => true, 'user' => Auth::user()]);
    } else {
        return response()->json(['logged_in' => false], 401);
    }
});

Route::post('/extension/save-note', function (Request $request) {
    if (!Auth::check()) {
        return response()->json(['message' => 'Not logged in'], 401);
    }

    $user = Auth::user();

    Note::create([
        'user_id' => $user->id,
        'title' => $request->title ?? 'Untitled',
        'note_text' => $request->note_text ?? '',
        'url' => $request->url ?? '',
    ]);

    return response()->json(['message' => 'Note saved']);
}); 

//samira ko ho yo 
//Option A: Redirected to laravel home page 
Route::get('home', function () {
     return view('home');
})->name('home'); // this is the home page of laravel app

//email contact form route
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');





// this is my route

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});


// Dashboard route showing the token generation form
Route::get('/dashboard', function () {
    $user = Auth::user();
    $notes = $user ? Note::where('user_id', $user->id)->get() : collect();  // Fetch notes for logged-in user
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

Route::group(['prefix' => 'account'],function(){             

            Route::get('login',[LoginController::class,'index'])->name('login');

        // Route::get('login',[LoginController::class,'index'])->name('login');
        Route::get('register',[LoginController::class,'register'])->name('register');
        Route::post('process-register',[LoginController::class,'processRegister'])->name('processRegister');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('authenticate');



    // this is Authenticated middleware for people who are logged in
    Route::group(['middleware' => 'user'], function(){          

        Route::get('logout',[LoginController::class,'logout'])->name('logout');          // this route is for logout
        Route::get('dashboard',[DashboardController::class,'dashboard'])->name('user.dashboard');    

        // billing history route for user
        Route::get('billing-history', [DashboardController::class, 'billingHistory'])->name('user.billing');
    });

});



// laravel’s built-in Auth system and middleware do all of this when Auth::attempt() is called and protect routes with auth middleware.

/* for admin */

Route::group(['prefix' => 'admin'],function(){             

        // this is guest middleware for admin who are not logged in
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');    
        Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');


//     // this is Authenticated middleware for admin who are logged in
    Route::group(['middleware' => 'admin'], function(){          

        Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');    // this needs to be called in admin's dashboard blade file logout ko option ma
        Route::get('users', [AdminDashboardController::class, 'users'])->name('admin.users');                   // show users list
        Route::delete('/users/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');     // delete user route (for delete form)
        // added this promote route:
        Route::patch('/users/{id}/promote', [AdminDashboardController::class, 'promoteUser'])->name('admin.users.promote');

        // to edit and update user
        Route::get('/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/users/{id}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
        Route::patch('/users/{id}/update-role', [AdminDashboardController::class, 'updateUserRole'])->name('admin.users.updateRole');    // for updating user's role thru users list in admin dashboard

        // for billing history in admin dashboard
        Route::get('/payments', [AdminDashboardController::class, 'allPayments'])->name('admin.payments');
    
    });

});

/* for payment gateway */

// Route::post('stripe/checkout',[StripeController::class,'checkout'])->name('stripe.checkout');
Route::post('stripe/checkout-session',[StripeController::class,'session'])->name('stripe.session');
Route::get('stripe/checkout-success',[StripeController::class,'success'])->name('stripe.success');
Route::get('stripe/checkout-cancel',[StripeController::class,'cancel'])->name('stripe.cancel');