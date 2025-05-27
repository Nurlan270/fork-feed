<?php

namespace App\Http\Controllers\Recipe;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;

class EditRecipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Recipe $recipe)
    {
        $ingredients = Ingredient::pluck('name')->all();

        return view('recipe.edit', compact('recipe', 'ingredients'));
    }
}
