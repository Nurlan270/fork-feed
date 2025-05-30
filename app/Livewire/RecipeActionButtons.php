<?php

namespace App\Livewire;

use App\Enums\ReactionType;
use App\Models\Recipe;
use Livewire\Component;

class RecipeActionButtons extends Component
{
    public Recipe $recipe;
    public bool $liked = false;
    public bool $disliked = false;
    public bool $bookmarked = false;

    public function mount(): void
    {
        $user = auth()->user();

        if ($user?->likes()->where('recipe_id', $this->recipe->id)->exists())
            $this->liked = true;
        elseif ($user?->dislikes()->where('recipe_id', $this->recipe->id)->exists())
            $this->disliked = true;

        if ($user?->bookmarks()->where('recipe_id', $this->recipe->id)->exists())
            $this->bookmarked = true;
    }

    public function like(): void
    {
        auth()->user()->reactions()->syncWithoutDetaching([
            $this->recipe->id => ['type' => ReactionType::LIKE],
        ]);

        $this->liked = true;
        $this->disliked = false;
    }

    public function dislike(): void
    {
        auth()->user()->reactions()->syncWithoutDetaching([
            $this->recipe->id => ['type' => ReactionType::DISLIKE],
        ]);

        $this->disliked = true;
        $this->liked = false;
    }

    public function resetReaction(): void
    {
        auth()->user()->reactions()->detach($this->recipe->id);

        $this->liked = false;
        $this->disliked = false;
    }

    public function bookmark(): void
    {
        auth()->user()->bookmarks()->syncWithoutDetaching($this->recipe->id);

        $this->bookmarked = true;
    }

    public function removeBookmark(): void
    {
        auth()->user()->bookmarks()->detach($this->recipe->id);

        $this->bookmarked = false;
    }
}
