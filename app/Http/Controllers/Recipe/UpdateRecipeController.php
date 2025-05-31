<?php

namespace App\Http\Controllers\Recipe;

use App\Exceptions\RemovalOfAllRecipeImagesException;
use App\Exceptions\RecipeImagesUploadLimitExceededException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Recipes\UpdateRecipeRequest;
use App\Http\Services\RecipeService;
use App\Models\Recipe;
use Illuminate\Support\Facades\Gate;

class UpdateRecipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRecipeRequest $request, Recipe $recipe, RecipeService $service)
    {
        Gate::authorize('update', $recipe);

        try {
            $service->updateRecipe($request, $recipe);

            notyf()->success(__('flasher.recipe.updated'));

            return redirect()->route('user.profile');
        } catch (RemovalOfAllRecipeImagesException|RecipeImagesUploadLimitExceededException $e) {
            notyf()->error($e->getMessage());
        }

        return back();
    }
}
