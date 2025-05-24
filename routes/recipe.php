<?php

use App\Http\Controllers\Recipe\CreateRecipeController;
use App\Http\Controllers\Recipe\DeleteRecipeController;
use App\Http\Controllers\Recipe\StoreRecipeController;

Route::name('recipe.')->prefix('recipes')->middleware('web')->group(function () {
    Route::get('create', CreateRecipeController::class)->name('create');
    Route::post('/', StoreRecipeController::class)->name('store');

    Route::delete('{recipe}', DeleteRecipeController::class)->name('delete');
});
