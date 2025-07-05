<?php

namespace App\Livewire;

use App\Models\Recipe;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Locked;
use Livewire\Component;

class RecipeCard extends Component
{
    #[Locked]
    public Recipe $recipe;
    public bool $showActionButtons = false;
    public bool $showRemoveBookmarkButton = false;
    public bool $isBookmarked = false;

    public function mount(): void
    {
        if ($this->showRemoveBookmarkButton) {
            $this->isBookmarked = auth()->user()->bookmarks()->where('recipe_id', $this->recipe->id)->exists();
        }
    }

    public function deleteRecipe(): void
    {
        Gate::authorize('delete', $this->recipe);

        $imagePaths = $this->recipe->images()->chunkMap(fn($image) => $image->relativePath())->toArray();

        Storage::delete($imagePaths);

        $this->recipe->delete();

        notyf()->success(__('flasher.recipe.deleted'));

        $this->dispatch('recipe-deleted');

        $this->skipRender();
    }

    public function removeBookmark(): void
    {
        Gate::authorize('bookmark', $this->recipe);

        auth()->user()->bookmarks()->detach($this->recipe->id);

        $this->dispatch('bookmark-removed');
    }
}
