<?php

use App\Http\Controllers\User\UserFollowController;
use App\Models\User;

Route::name('user.')->middleware('auth')->group(function () {
    Route::view('profile', 'user.profile')->name('profile');
    Route::view('bookmarks', 'user.bookmarks')->name('bookmarks');
    Route::view('settings', 'user.settings')->name('settings');
});

Route::name('user.')->prefix('@{user}')->group(function () {
    Route::get('/', function (User $user) {
        return view('user.profile', compact('user'));
    })->name('tag-profile');

    Route::get('following', [UserFollowController::class, 'following'])->name('following');
    Route::get('followers', [UserFollowController::class, 'followers'])->name('followers');
});
