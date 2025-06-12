<?php

namespace App\Livewire;

use App\Enums\ReactionType;
use App\Models\Recipe;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Explore extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $sort = '';

    public function render(): View
    {
        return view('livewire.explore', [
            'recipes' => $this->recipes(),
        ]);
    }

    public function deleteRecipe(string $id): void
    {
        $recipe = Recipe::findOrFail($id);

        Gate::authorize('delete', $recipe);

        $imagePaths = $recipe->images()->chunkMap(fn($image) => $image->relativePath())->toArray();

        Storage::delete($imagePaths);

        $recipe->delete();

        notyf()->success(__('flasher.recipe.deleted'));
    }

    public function updated($property): void
    {
        if (in_array($property, ['search', 'sort'])) {
            $this->resetPage();
        }
    }

    protected function recipes(): LengthAwarePaginator
    {
        $query = Recipe::with(['firstImage', 'author', 'limitedIngredients'])
            ->withCount([
                'reactions as likes_count'    => fn($q) => $q->where('type', ReactionType::LIKE),
                'reactions as dislikes_count' => fn($q) => $q->where('type', ReactionType::DISLIKE),
            ])
            ->orderByRaw($this->getSortColumn());

        if ($this->search) {
            $ids = Recipe::search($this->search)->get()->pluck('id');

            $query->whereIn('id', $ids);
        }

        return $query->paginate(50);
    }

    protected function getSortColumn(): string
    {
        return match ($this->sort) {
            'popular' => '(likes_count - dislikes_count) + recipes.views DESC',
            'liked'   => 'likes_count DESC',
            'newest'  => 'recipes.created_at DESC',
            'oldest'  => 'recipes.created_at ASC',
            default   => 'recipes.views DESC',
        };
    }
}
