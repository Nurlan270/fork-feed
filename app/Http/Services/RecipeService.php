<?php

namespace App\Http\Services;

use App\Exceptions\RecipeImagesUploadLimitExceededException;
use App\Exceptions\RemovalOfAllRecipeImagesException;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class RecipeService
{
    /**
     * @throws \App\Exceptions\RecipeImagesUploadLimitExceededException
     */
    public function createRecipe(FormRequest $request): void
    {
        $ingredients = $this->createIngredients($request);

        $recipe = $request->user()->recipes()->create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        $recipe->ingredients()->sync($ingredients);

        $this->storeImages($request, $recipe);
    }

    /**
     * @throws \App\Exceptions\RemovalOfAllRecipeImagesException
     * @throws \App\Exceptions\RecipeImagesUploadLimitExceededException
     */
    public function updateRecipe(FormRequest $request, Recipe $recipe): void
    {
        $recipe->update($request->only('title', 'description'));

        $ingredients = $this->createIngredients($request);

        $recipe->ingredients()->sync($ingredients);

        $this->removeDeletedImages($request, $recipe);

        $this->storeImages($request, $recipe);
    }

    protected function createIngredients(FormRequest $request): array
    {
        return collect(json_decode($request->ingredients))
            ->pluck('value')
            ->filter()
            ->unique()
            ->map(function ($name) {
                return Ingredient::firstOrCreate(['name' => ucfirst($name)])->id;
            })->toArray();
    }

    protected function storeImages(FormRequest $request, Recipe $recipe): void
    {
        $existingImagesCount = RecipeImage::where('recipe_id', $recipe->id)->count();
        $uploadedImagesCount = $request->hasFile('images') ? count($request->file('images')) : 0;

        if (($existingImagesCount + $uploadedImagesCount) > 20) {
            throw new RecipeImagesUploadLimitExceededException(
                __('flasher.exceptions.recipe_images_upload_limit_exceeded')
            );
        }

        $names = collect($request->file('images'))->map(function ($image) {
            return $image->store('/', 'recipe-images');
        });

        $recipe->images()->createMany(
            $names->map(fn($name) => ['path' => 'recipe-images/' . $name])->toArray()
        );
    }

    protected function removeDeletedImages(FormRequest $request, Recipe $recipe): void
    {
        $deletedImages = collect(json_decode($request->deleted_images))->filter();

        if ($deletedImages->isNotEmpty() && !$request->hasFile('images')) {
            $imagesCount = RecipeImage::where('recipe_id', $recipe->id)->count();
            if ($imagesCount <= 1 || $deletedImages->count() >= $imagesCount) {
                throw new RemovalOfAllRecipeImagesException(
                    __('flasher.exceptions.removal_of_all_recipe_images')
                );
            }
        }

        $ids = $deletedImages->keys();
        $imagePaths = $deletedImages->values()->toArray();

        Storage::delete($imagePaths);

        RecipeImage::whereIn('id', $ids)->delete();
    }
}
