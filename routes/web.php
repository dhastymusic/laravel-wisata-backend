<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('pages.auth.login');
});


//Register
Route::get('/register', function () {
    return view('pages.auth.register');
});
//Forgot Password
Route::get('/forgot-password', function () {
    return view('pages.auth.forgot-password');
});
//Reset Password
Route::get('/reset-password', function () {
    return view('pages.auth.reset-password');
});

//Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard');
    })->name('home');
    //users
    Route::resource('users', UserController::class);
    //categories
    Route::resource('categories', CategoryController::class);
    //products
    Route::resource('products', ProductController::class);
});

