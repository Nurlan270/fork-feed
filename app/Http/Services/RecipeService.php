<?php

namespace App\Http\Services;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class RecipeService
{
    public function createRecipe(FormRequest $request): Recipe
    {
        return $request->user()->recipes()->create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);
    }

    public function createIngredients(FormRequest $request): array
    {
        return collect(json_decode($request->ingredients))
            ->pluck('value')
            ->filter()
            ->unique()
            ->map(function ($name) {
                return Ingredient::firstOrCreate(['name' => ucfirst($name)])->id;
            })->toArray();
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

    protected function removeDeletedImages(FormRequest $request): void
    {
        $deletedImages = collect(json_decode($request->deleted_images, true))->filter();

        $ids = $deletedImages->keys();
        $names = $deletedImages->values()->map(fn($name) => 'recipe-images/' . $name);

        RecipeImage::whereIn('id', $ids)->delete();

        Storage::delete($names->toArray());
    }

    public function updateRecipe(FormRequest $request, Recipe $recipe): void
    {
        $recipe->update($request->only('title', 'description'));

        $ingredients = $this->createIngredients($request);

        $recipe->ingredients()->sync($ingredients);

        $this->removeDeletedImages($request);

        $this->storeImages($request, $recipe);
    }
}
