<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

//  Authentication
Route::name('auth.')->prefix('auth')->middleware('guest')->group(function () {
    //  Register
   Route::view('register', 'auth.register')->name('register');
   Route::post('register', RegisterController::class)->name('register.store');

   //   Login
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', LoginController::class)->name('login.store');

   /* OAuth Providers */

    //  GitHub
    Route::get('github', [GithubController::class, 'redirect'])->name('github');
    Route::get('github/callback', [GithubController::class, 'callback'])->name('github.callback');

    //  Google
    Route::get('google', [GoogleController::class, 'redirect'])->name('google');
    Route::get('google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

Route::post('logout', LogoutController::class)->middleware('auth')->name('logout');
