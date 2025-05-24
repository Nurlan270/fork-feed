<?php

require_once __DIR__ . '/auth.php';

use App\Http\Controllers\Recipe\CreateRecipeController;
use App\Http\Controllers\Recipe\StoreRecipeController;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

//  Authenticated & Verified routes
Route::middleware(['auth', 'verified'])->group(function () {
    //  Recipe
    Route::name('recipe.')->prefix('recipes')->group(function () {
        Route::get('create', CreateRecipeController::class)->name('create');
        Route::post('/', StoreRecipeController::class)->name('store');
    });
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
            ->get();

        return view('profile', compact('user', 'ingredients'));
    })->name('profile');
});

//  Others Profile
Route::get('@{user:username}', function (User $user) {
    $ingredients = Ingredient::take(12)->get();
    return view('profile', compact('user', 'ingredients'));
});
