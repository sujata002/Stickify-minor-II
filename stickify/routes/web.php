Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/generate-token', [DashboardController::class, 'generateToken'])->name('generate.token');
});



