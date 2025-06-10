<?php

use App\Livewire\User\Bookmarks;
use App\Http\Controllers\User\{
    UserProfileController,
    UserFollowController,
};

Route::get('profile', UserProfileController::class)
    ->middleware('auth')
    ->name('user.profile');

Route::name('user.')->prefix('@{user:username}')->group(function () {
    Route::get('/', UserProfileController::class)->name('tag-profile');
    Route::get('following', [UserFollowController::class, 'following'])->name('following');
    Route::get('followers', [UserFollowController::class, 'followers'])->name('followers');
});

Route::get('bookmarks', Bookmarks::class)
    ->middleware(['auth', 'verified'])
    ->name('user.bookmarks');
