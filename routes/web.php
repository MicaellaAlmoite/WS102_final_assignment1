<?php
use App\Http\Controllers\StudentPortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [StudentPortalController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [StudentPortalController::class, 'register']);
    Route::get('/login', [StudentPortalController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [StudentPortalController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [StudentPortalController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [StudentPortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [StudentPortalController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [StudentPortalController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [StudentPortalController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [StudentPortalController::class, 'updatePassword'])->name('profile.update-password');
});