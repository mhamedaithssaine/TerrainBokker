<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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
// Route::resource('sponsors', SponsorController::class);
Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsors.index');
Route::get('/sponsors/create', [SponsorController::class, 'create'])->name('sponsors.create');
Route::post('/sponsors', [SponsorController::class, 'store'])->name('sponsors.store');
Route::get('/sponsors/{sponsor}/edit', [SponsorController::class, 'edit'])->name('sponsors.edit');
Route::put('/sponsors/{sponsor}', [SponsorController::class, 'update'])->name('sponsors.update');
Route::delete('/sponsors/{sponsor}', [SponsorController::class, 'destroy'])->name('sponsors.destroy');


//routes terrain
Route::resource('terrains',TerrainController::class);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/availabilities', [DashboardController::class, 'availabilities'])->name('dashboard.availabilities');
Route::get('/dashboard/bookings', [DashboardController::class, 'bookings'])->name('dashboard.bookings');
Route::get('/dashboard/payments', [DashboardController::class, 'payments'])->name('dashboard.payments');
Route::get('/dashboard/reviews', [DashboardController::class, 'reviews'])->name('dashboard.reviews');
Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
Route::put('/dashboard/settings', [DashboardController::class, 'updateSettings'])->name('dashboard.settings.update');

// Profil
Route::middleware('auth')->group(function () {
    
});
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

//roles 
Route::resource('roles', RoleController::class);


//permissions 
Route::resource('permissions',PermissionController::class);


//users 
Route::resource('users',UserController::class);

//update de role
Route::put('/users/{user}/update-role', [UserController::class, 'updateRole'])
    ->name('users.update-role');

//home 
Route::get('/', [HomeController::class,'index'])->name('home');

//contact 
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');