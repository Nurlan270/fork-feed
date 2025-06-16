<?php

use App\Http\Controllers\Recipe\{CreateRecipeController,
    EditRecipeController,
    ShowRecipeController,
    StoreRecipeController,
    UpdateRecipeController};
use App\Http\Middleware\IncrementViewsNumber;
use App\Models\Ingredient;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::name('recipe.')
    ->prefix(LaravelLocalization::setLocale() . '/recipes')
    ->middleware([
        'auth',
        'verified',
        'localize',
        'localizationRedirect',
    ])->group(function () {
        Route::get('create', CreateRecipeController::class)->name('create');
        Route::post('/', StoreRecipeController::class)->name('store');
        Route::get('{recipe}/edit', EditRecipeController::class)->name('edit');
        Route::patch('{recipe}', UpdateRecipeController::class)->name('update');
    });

Route::get(LaravelLocalization::setLocale() . '/recipes/{recipe}', ShowRecipeController::class)
    ->middleware([
        IncrementViewsNumber::class,
        'localize',
        'localizationRedirect',
    ])->name('recipe.show');

Route::get(LaravelLocalization::setLocale() . '/recipes/ingredient/{ingredient:slug}',
    function (Ingredient $ingredient) {
        return view('recipe.by-ingredient', compact('ingredient'));
    })->middleware([
    'localize',
    'localizationRedirect',
])->name('recipe.by-ingredient');
