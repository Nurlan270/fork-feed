<?php

require_once __DIR__ . '/auth.php';

use App\Http\Controllers\Recipe\CreateRecipeController;
use App\Http\Controllers\Recipe\StoreRecipeController;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    //  Recipe
    Route::name('recipe.')->prefix('recipes')->group(function () {
       Route::get('create', CreateRecipeController::class)->name('create');
       Route::post('/', StoreRecipeController::class)->name('store');
    });

    //  Profile
    Route::get('profile', function () {
        $recipes = auth()->user()->recipes()->get();
        $ingredients = Ingredient::inRandomOrder()->take(12)->get();
        return view('profile', compact('recipes', 'ingredients'));
    })->name('profile');
});
