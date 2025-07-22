use App\Http\Controllers\TokenController;

// Route to generate token (POST)

Route::middleware(['auth'])->post('/generate-token', [TokenController::class, 'generateToken'])->name('token.generate');

Route::get('/', function () {
    return redirect()->route('www.stickify.com');
});
