<?php

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/recipe.php';
require_once __DIR__ . '/user.php';

Route::view('/', 'welcome')->name('welcome');
