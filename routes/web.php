<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true, 'register' => true]);

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('review', App\Http\Controllers\ReviewController::class);
Route::resource('admin', App\Http\Controllers\AdministrationController::class);
Route::resource('user', App\Http\Controllers\UserController::class);