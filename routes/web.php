<?php

use Illuminate\Http\Request;

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/recipe.php';
require_once __DIR__ . '/user.php';

Route::view('/', 'welcome')->name('welcome');

Route::view('explore', 'explore')->name('explore');
