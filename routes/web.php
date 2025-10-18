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
