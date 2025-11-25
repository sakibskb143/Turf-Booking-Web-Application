<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\TurfController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::view('/home', 'layouts.master_navbar');
Route::view('/', 'pages.home');
Route::view('/aboutus', 'pages.aboutus')->name('aboutus');
Route::view('/contactus', 'pages.contactus')->name('contactus');

Route::get('/bookturf', [BookingController::class, 'index'])->name('bookturf');
Route::get('/turfs/{turf}/slots', [BookingController::class, 'slots'])->name('turfs.slots');
Route::post('/bookings', [BookingController::class, 'store'])
    ->middleware(['auth', 'role:user'])
    ->name('bookings.store');

Route::middleware('guest')->group(function () {
    Route::view('/admin/login', 'auth.admin_login')->name('admin.login');
    Route::view('/admin/signup', 'auth.admin_signup')->name('admin.signup');
    Route::view('/auth/users_login', 'auth.users_login')->name('users.login');
    Route::view('/auth/users_signup', 'auth.users_signup')->name('users.signup');
    Route::view('/auth/owners_login', 'auth.owners_login')->name('owners.login');
    Route::view('/auth/owners_signup', 'auth.owners_signup')->name('owners.signup');
});

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('/auth/users_signup', 'registerUser')->name('users.register');
        Route::post('/auth/users_login', 'loginUser')->name('users.authenticate');
        Route::post('/auth/owners_signup', 'registerOwner')->name('owners.register');
        Route::post('/auth/owners_login', 'loginOwner')->name('owners.authenticate');
        Route::post('/admin/signup', 'registerAdmin')->name('admin.register');
        Route::post('/admin/login', 'loginAdmin')->name('admin.authenticate');
    });

    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::get('/booking-system/{category}', function (string $category) {
    return view('pages.bookingsystem', compact('category'));
});

Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/bookings', [UserDashboardController::class, 'bookings'])->name('bookings');
        Route::get('/notifications', [UserDashboardController::class, 'notifications'])->name('notifications');
        Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
    });

Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [OwnerDashboardController::class, 'dashboard'])->name('dashboard');
        
        // Turf Management
        Route::get('/manage-turf', [OwnerDashboardController::class, 'manageTurf'])->name('manageTurf');
        Route::post('/turfs', [OwnerDashboardController::class, 'storeTurf'])->name('turfs.store');
        Route::put('/turfs/{turf}', [OwnerDashboardController::class, 'updateTurf'])->name('turfs.update');
        Route::delete('/turfs/{turf}', [OwnerDashboardController::class, 'destroyTurf'])->name('turfs.destroy');
        
        // Slot Management
        Route::get('/manage-slots', [OwnerDashboardController::class, 'manageSlots'])->name('manageSlots');
        Route::post('/turfs/{turf}/slots', [TurfController::class, 'storeSlot'])->name('slots.store');
        Route::put('/slots/{slot}', [TurfController::class, 'updateSlot'])->name('slots.update');
        Route::delete('/slots/{slot}', [TurfController::class, 'destroySlot'])->name('slots.destroy');
        Route::get('/turfs/{turf}/slots-data', [TurfController::class, 'getSlots'])->name('slots.data');
        
        // Bookings
        Route::get('/bookings', [OwnerDashboardController::class, 'bookings'])->name('bookings');
        Route::put('/bookings/{booking}/status', [OwnerDashboardController::class, 'updateBookingStatus'])->name('bookings.updateStatus');
        
        // Coupons (view only for now)
        Route::view('/coupons', 'owner_dashboard.coupons')->name('coupons');
        
        // Notifications
        Route::get('/notifications', [OwnerDashboardController::class, 'notifications'])->name('notifications');
    });

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    });
