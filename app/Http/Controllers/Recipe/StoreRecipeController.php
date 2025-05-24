<?php

namespace App\Http\Controllers\Recipe;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recipes\StoreRecipeRequest;
use App\Http\Services\RecipeService;

class StoreRecipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRecipeRequest $request, RecipeService $service)
    {
        $request->validated();

        $ingredientIds = $service->createAndGetIngredientIds($request);

        $recipe = $service->createAndGetRecipe($request);

        $recipe->ingredients()->sync($ingredientIds);

        $service->storeImages($request, $recipe);

        return redirect()->route('profile');
    }
}
