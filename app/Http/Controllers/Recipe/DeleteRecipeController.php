<?php

namespace App\Http\Controllers\Recipe;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DeleteRecipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Recipe $recipe)
    {
        Gate::authorize('delete', $recipe);

        $recipe->images()->each(function ($image) {
            Storage::delete($image->path);
        });

        $recipe->delete();

        notyf()->success(__('flasher.recipe.deleted'));

        return back();
    }
}
