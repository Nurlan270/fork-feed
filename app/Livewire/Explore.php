<?php

namespace App\Livewire;

use App\Enums\ReactionType;
use App\Models\Recipe;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class Explore extends Component
{
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

    protected function recipes(): Collection
    {
        $recipeIds = Recipe::search($this->search)->get()->pluck('id');

        return Recipe::with(['firstImage', 'author', 'limitedIngredients'])
            ->withCount([
                'reactions as likes_count'    => fn($q) => $q->where('type', ReactionType::LIKE),
                'reactions as dislikes_count' => fn($q) => $q->where('type', ReactionType::DISLIKE),
            ])
            ->whereIn('id', $recipeIds)
            ->orderByRaw($this->getSortColumn())
            ->get();
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
