<?php

use App\Models\Ingredient;
use App\Http\Middleware\IncrementViewsNumber;
use App\Http\Controllers\Recipe\{
    CreateRecipeController,
    EditRecipeController,
    ShowRecipeController,
    StoreRecipeController,
    UpdateRecipeController
};

Route::name('recipe.')->prefix('recipes')->middleware(['auth', 'verified'])->group(function () {
    Route::get('create', CreateRecipeController::class)->name('create');
    Route::post('/', StoreRecipeController::class)->name('store');
    Route::get('{recipe}/edit', EditRecipeController::class)->name('edit');
    Route::patch('{recipe}', UpdateRecipeController::class)->name('update');
});

Route::get('recipes/{recipe}', ShowRecipeController::class)
    ->middleware(IncrementViewsNumber::class)
    ->name('recipe.show');

Route::get('recipes/ingredient/{ingredient:slug}', function (Ingredient $ingredient) {
    return view('recipe.by-ingredient', compact('ingredient'));
})->name('recipe.by-ingredient');
