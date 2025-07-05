<?php

namespace App\Livewire;

use App\Enums\ReactionType;
use App\Models\Recipe;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRecipes extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $sort = '';

    public function render(): View
    {
        return view('livewire.show-recipes', [
            'recipes' => $this->recipes(),
        ]);
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
