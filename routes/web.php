<?php

require_once __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

