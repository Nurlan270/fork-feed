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
        $service->createRecipe($request);

        notyf()->success(__('flasher.recipe.created'));

        return redirect()->route('user.profile');
    }
}
