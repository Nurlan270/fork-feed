<?php

use App\Models\User;
use App\Http\Controllers\User\UserFollowController;

Route::view('profile', 'user.profile')
    ->middleware('auth')
    ->name('user.profile');

Route::name('user.')->prefix('@{user}')->group(function () {
    Route::get('/', function (User $user) {
        return view('user.profile', compact('user'));
    })->name('tag-profile');

    Route::get('following', [UserFollowController::class, 'following'])->name('following');
    Route::get('followers', [UserFollowController::class, 'followers'])->name('followers');
});

Route::view('bookmarks', 'user.bookmarks')
    ->middleware(['auth', 'verified'])
    ->name('user.bookmarks');
