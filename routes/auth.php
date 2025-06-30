<?php

use App\Http\Controllers\Auth\{EmailVerificationController,
    GithubController,
    GoogleController,
    LoginController,
    LogoutController,
    PasswordResetController,
    RegisterController};
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//  Authentication
Route::name('auth.')
    ->prefix(LaravelLocalization::setLocale() . '/auth')
    ->middleware([
        'guest',
        'localize',
        'localizationRedirect',
        'localeCookieRedirect',
    ])->group(function () {
        //  Register
        Route::view('register', 'auth.register')->name('register');
        Route::post('register', RegisterController::class)
            ->middleware('throttle:5,2')->name('register.store');

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

//  Restore Password
Route::name('password.')
    ->prefix(LaravelLocalization::setLocale() . '/auth')
    ->middleware([
        'guest',
        'localize',
        'localizationRedirect',
        'localeCookieRedirect',
    ])->group(function () {
        Route::view('forgot-password', 'auth.password.forgot')->name('request');
        Route::post('forgot-password', [PasswordResetController::class, 'email'])
            ->middleware('throttle:5,2')->name('email');

        Route::get('reset-password/{token}', function (string $token) {
            return view('auth.password.reset', compact('token'));
        })->name('reset');

        Route::post('reset-password', [PasswordResetController::class, 'update'])->name('update');
    });

//  Verify Email
Route::name('verification.')
    ->prefix(LaravelLocalization::setLocale() . '/auth/email')
    ->middleware([
        'auth',
        'localize',
        'localizationRedirect',
        'localeCookieRedirect',
    ])->group(function () {
        Route::view('verify', 'auth.email.verify')->name('notice');

        Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')->name('verify');

        Route::post('send', [EmailVerificationController::class, 'send'])
            ->middleware('throttle:5,2')->name('send');
    });

//  Logout
Route::post(LaravelLocalization::setLocale() . '/logout', LogoutController::class)
    ->middleware([
        'auth',
        'localize',
        'localizationRedirect',
        'localeCookieRedirect',
    ])->name('logout');
