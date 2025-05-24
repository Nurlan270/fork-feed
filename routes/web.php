<?php

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/recipe.php';

use App\Models\User;

Route::view('/', 'welcome')->name('welcome');

//  Authenticated & Verified routes
Route::middleware(['auth', 'verified'])->group(function () {
    //
});

//  Authenticated routes
Route::middleware('auth')->group(function () {
    //  My Profile
    Route::get('profile', function () {
        $user = auth()->user();
        $ingredients = DB::table('ingredient_recipe')
            ->join('recipes', 'ingredient_recipe.recipe_id', '=', 'recipes.id')
            ->join('ingredients', 'ingredient_recipe.ingredient_id', '=', 'ingredients.id')
            ->select('ingredients.*', DB::raw('COUNT(*) as usage_count'))
            ->where('recipes.user_id', $user->id)
            ->groupBy('ingredients.name')
            ->orderByDesc('usage_count')
            ->limit(12)
            ->get();

        return view('profile', compact('user', 'ingredients'));
    })->name('profile');
});

//  Others Profile
Route::get('@{user:username}', function (User $user) {
    $ingredients = DB::table('ingredient_recipe')
        ->join('recipes', 'ingredient_recipe.recipe_id', '=', 'recipes.id')
        ->join('ingredients', 'ingredient_recipe.ingredient_id', '=', 'ingredients.id')
        ->select('ingredients.*', DB::raw('COUNT(*) as usage_count'))
        ->where('recipes.user_id', $user->id)
        ->groupBy('ingredients.name')
        ->orderByDesc('usage_count')
        ->limit(12)
        ->get();

    return view('profile', compact('user', 'ingredients'));
});
