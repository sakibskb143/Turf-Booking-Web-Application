<?php

use Illuminate\Support\Facades\Route;


Route::get('/home', function (){
    return view('layouts.master_navbar');
});
Route::get('/', function () {
    return view('pages.home');
});

Route::get('/aboutus', function () {
    return view('pages.aboutus');
})->name('aboutus');

Route::get('/contactus', function () {
    return view('pages.contactus');
})->name('contactus');

Route::get('/bookturf',function(){
    return  view('pages.bookturf');
})->name('bookturf');

Route::view('/admin/login', 'auth.admin_login')->name('admin.login');
Route::view('/auth/users_login', 'auth.users_login')->name('users.login');
Route::view('/auth/users_signup', 'auth.users_signup')->name('users.signup');

// Turf Owner Authentication Pages (frontend only)
Route::view('/auth/owners_login', 'auth.owners_login')->name('owners.login');
Route::view('/auth/owners_signup', 'auth.owners_signup')->name('owners.signup');

// turf user_dashboard
Route::get('/user/dashboard', function () {
    return view('user_dashboard.dashboard');
})->name('user.dashboard');

Route::get('/user/bookings', function () {
    return view('user_dashboard.bookings');
})->name('user.bookings');

Route::get('/user/profile', function () {
    return view('user_dashboard.profile');
})->name('user.profile');






Route::get('/booking-system/{category}', function ($category) {
    return view('pages.bookingsystem', compact('category'));
});

Route::get('/owner/dashboard', function () {
    return view('owner_dashboard.dashboard');
})->name('owner.dashboard');

Route::get('/owner/manage-turf', function () {
    return view('owner_dashboard.turf_management');
})->name('owner.manageTurf');

Route::get('/owner/manage-slots', function () {
    return view('Owner_dashboard.manage_slots');
})->name('owner.manageSlots');

Route::get('/owner/bookings', function () {
    return view('owner_dashboard.bookings');
})->name('owner.bookings');


Route::get('/owner/coupons', function () {
    return view('owner_dashboard.coupons');
})->name('owner.coupons');


Route::get('/owner/notifications', function () {
    return view('owner_dashboard.owner_notifications');
})->name('owner.notifications');

