<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// Authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
// Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Tableau de bord
Route::middleware('auth')->group(function () {

   
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/availabilities', [DashboardController::class, 'availabilities'])->name('dashboard.availabilities');
Route::get('/dashboard/bookings', [DashboardController::class, 'bookings'])->name('dashboard.bookings');
Route::get('/dashboard/terrains/create', [DashboardController::class, 'createTerrain'])->name('dashboard.terrains.create');
Route::get('/dashboard/terrains', [DashboardController::class, 'terrains'])->name('dashboard.terrains');
Route::get('/dashboard/payments', [DashboardController::class, 'payments'])->name('dashboard.payments');
Route::get('/dashboard/reviews', [DashboardController::class, 'reviews'])->name('dashboard.reviews');
Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
Route::put('/dashboard/settings', [DashboardController::class, 'updateSettings'])->name('dashboard.settings.update');

// Profil
Route::middleware('auth')->group(function () {
    
});
// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');