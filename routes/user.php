<?php

use App\Http\Controllers\User\UserFollowController;
use App\Models\User;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::name('user.')
    ->prefix(LaravelLocalization::setLocale())
    ->middleware([
        'auth',
        'localize',
        'localizationRedirect',
    ])->group(function () {
        Route::view('profile', 'user.profile')->name('profile');
        Route::view('bookmarks', 'user.bookmarks')->name('bookmarks');
        Route::view('settings', 'user.settings')->name('settings');
    });

Route::name('user.')
    ->prefix(LaravelLocalization::setLocale() . '/@{user}')
    ->middleware([
        'localize',
        'localizationRedirect',
    ])->group(function () {
        Route::get('/', function (User $user) {
            return view('user.profile', compact('user'));
        })->name('tag-profile');

        Route::get('following', [UserFollowController::class, 'following'])->name('following');
        Route::get('followers', [UserFollowController::class, 'followers'])->name('followers');
    });
