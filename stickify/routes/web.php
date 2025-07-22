use App\Http\Controllers\TokenController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth'); // ensure user is logged in

Route::post('/generate-token', [TokenController::class, 'generateToken'])
    ->name('generate.token')
    ->middleware('auth');
