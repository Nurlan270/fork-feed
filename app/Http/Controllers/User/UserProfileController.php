<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ?User $user = null)
    {
        $user ??= auth()->user();

        $recipes = Recipe::query()->where('user_id', $user->id)->paginate(12);

        $ingredients = DB::table('ingredient_recipe')
            ->join('recipes', 'ingredient_recipe.recipe_id', '=', 'recipes.id')
            ->join('ingredients', 'ingredient_recipe.ingredient_id', '=', 'ingredients.id')
            ->select('ingredients.*', DB::raw('COUNT(*) as usage_count'))
            ->where('recipes.user_id', $user->id)
            ->groupBy('ingredients.name')
            ->orderByDesc('usage_count')
            ->limit(20)
            ->get();

        return view('user.profile', compact('user', 'recipes', 'ingredients'));
    }
}
