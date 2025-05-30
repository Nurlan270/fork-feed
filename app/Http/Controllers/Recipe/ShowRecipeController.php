<?php

namespace App\Http\Controllers\Recipe;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class ShowRecipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Recipe $recipe)
    {
        return view('recipe.show', compact('recipe'));
    }
}
