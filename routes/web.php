<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/user.php';
require_once __DIR__ . '/recipe.php';

Route::prefix(LaravelLocalization::setLocale())->middleware([
    'localize',
    'localizationRedirect',
    'localeCookieRedirect',
])->group(function () {
    // Prepend the locale to the Livewire update route
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });

    Route::view('/', 'welcome')->name('welcome');

    Route::view('explore', 'explore')->name('explore');
});
