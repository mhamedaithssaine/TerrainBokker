<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SportiveProfileController;
use App\Http\Controllers\ReservationAdminController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Routes d'authentification (non protégées par auth)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Routes publiques (non protégées par auth)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// Routes protégées par le middleware auth
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::middleware('role:admin')->group(function(){
      // Profil
      Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
      Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
      Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

       // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/resrvations', [DashboardController::class, 'indexReservation'])->name('dashboard.reservations.index');
    Route::get('/dashboard/reservations/{id}', [DashboardController::class, 'showReservation'])->name('dashboard.reservations.show');


    // Payments routes
    Route::get('/dashboard/payments', [DashboardController::class, 'indexPayment'])->name('dashboard.payments.index');
    Route::get('/dashboard/payments/{payment}', [DashboardController::class, 'showPayment'])->name('dashboard.payments.show');

      // Catégories
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

        // tags
        Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
        Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
        Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
        Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
        Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

        // Terrains
        Route::resource('terrains', TerrainController::class);

        // Rôles
        Route::resource('roles', RoleController::class);

        // Permissions
        Route::resource('permissions', PermissionController::class);

        // Utilisateurs
        Route::resource('users', UserController::class);
        Route::put('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');
        

        //Manage feedback par admin 
        Route::get('/dashboard/feedbacks', [FeedbackController::class, 'index'])->name('dashboard.feedback.index');
        Route::patch('/dashboard/feedbacks/{feedback}', [FeedbackController::class, 'updateStatus'])->name('dashboard.feedback.update');


        // Réservations par admin
        Route::get('/dashboard/createreservation', [ReservationAdminController::class, 'createreservation'])->name('dashboard.createreservation');
        Route::post('/dashboard/createreservation/store', [ReservationAdminController::class, 'store'])->name('dashboard.createreservation.store');
        Route::get('/dashboard/createreservation/terrain/{terrain_id}/reservations', [ReservationAdminController::class, 'getTerrainReservations'])->name('dashboard.createreservation.reservations');

        // Statistiques
        Route::get('/components/stats-card', [StatistiqueController::class, 'StatistiqueCard'])->name('components.stats-card');
        Route::get('/components/recent-reservations', [StatistiqueController::class, 'recentReservations'])->name('components.recent-reservations');
        Route::get('/dashboard/feedbackrecents', [StatistiqueController::class, 'index'])->name('components.feedbackrecents');

    });
  

   


    // Réservations
    Route::middleware('role:sportive')->group(function () {
        Route::get('/reservations/create/{terrain_id}', [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
        Route::get('/reservations/payment/success/{id}', [ReservationController::class, 'paymentSuccess'])->name('reservations.payment.success');
        Route::get('/reservations/payment/cancel/{id}', [ReservationController::class, 'paymentCancel'])->name('reservations.payment.cancel');
        Route::get('/reservations/{id}/ticket', [TicketController::class, 'downloadTicket'])->name('reservations.ticket');
        
        // Feedback par sportive 
        Route::post('/feedback', [HomeController::class, 'storeFeedback'])->name('feedback.store'); 

        // Profile sportive 
        Route::get('/sportive/profile', [SportiveProfileController::class, 'show'])->name('sportive.profile');
        Route::get('/sportive/profile/edit', [SportiveProfileController::class, 'edit'])->name('sportive.profile.edit');
        Route::put('/sportive/profile', [SportiveProfileController::class, 'update'])->name('sportive.profile.update');
    });

});