<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ?User $user = null)
    {
        $user ??= auth()->user();

        $recipes = Recipe::with(['firstImage', 'limitedIngredients'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        $ingredients = Ingredient::withCount([
            'recipes' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->whereHas('recipes', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderByDesc('recipes_count')
            ->limit(20)
            ->get();

        return view('user.profile', [
            'user'        => $user,
            'recipes'     => $recipes,
            'ingredients' => $ingredients,
        ]);
    }
}
