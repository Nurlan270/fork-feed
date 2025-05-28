<?php

use App\Http\Controllers\Recipe\{
    CreateRecipeController,
    DeleteRecipeController,
    EditRecipeController,
    StoreRecipeController,
    UpdateRecipeController
};

Route::name('recipe.')->prefix('recipes')->middleware(['auth', 'verified'])->group(function () {
    Route::get('create', CreateRecipeController::class)->name('create');
    Route::post('/', StoreRecipeController::class)->name('store');
    Route::get('{recipe}/edit', EditRecipeController::class)->name('edit');
    Route::patch('{recipe}', UpdateRecipeController::class)->name('update');
    Route::delete('{recipe}', DeleteRecipeController::class)->name('delete');
});
