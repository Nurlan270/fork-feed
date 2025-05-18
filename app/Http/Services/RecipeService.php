<?php

namespace App\Http\Services;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Foundation\Http\FormRequest;

class RecipeService
{
    public function createAndGetIngredientIds(FormRequest $request): array
    {
        $ingredients = collect(json_decode($request->ingredients))
            ->pluck('value')
            ->filter()
            ->unique();

        return $ingredients->map(function ($name) {
            return Ingredient::firstOrCreate(['name' => ucfirst($name)])->id;
        })->toArray();
    }

    public function createAndGetRecipe(FormRequest $request): Recipe
    {
        return $request->user()->recipes()->create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);
    }

    public function storeImages(FormRequest $request, Recipe $recipe): void
    {
        $names = collect($request->file('images'))->map(function ($image) {
            return $image->store('/', 'recipe-images');
        });

        $recipe->images()->createMany(
            $names->map(fn($name) => ['name' => $name])->toArray()
        );
    }
}
