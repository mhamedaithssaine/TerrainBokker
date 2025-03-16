<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CategoryController;

// Routes d'authentification

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Password Reset
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');





// Routes categories 
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index'); 
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store'); 
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update'); 
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy'); 
});

//Routes sponsor 



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
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');