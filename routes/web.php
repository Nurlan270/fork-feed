<?php

require_once __DIR__ . '/auth.php';

use App\Http\Controllers\Recipe\StoreRecipeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    //  Recipe
    Route::name('recipe.')->prefix('recipes')->group(function () {
       Route::view('create', 'recipe.create')->name('create');
       Route::post('/', StoreRecipeController::class)->name('store');
    });

    //  Profile
    Route::get('profile', function () {
        $recipes = auth()->user()->recipes()->get();
        return view('profile', compact('recipes'));
    })->name('profile');
});
