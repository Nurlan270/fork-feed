<?php

namespace App\Livewire\User;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    public function mount(): void
    {
        $this->user ??= auth()->user();
    }

    public function render(): View
    {
        return view('livewire.user.profile', [
            'recipes'     => $this->getRecipes(),
            'ingredients' => $this->getIngredients(),
        ]);
    }

    public function deleteRecipe()
    {
        dd('Hello');
    }

    protected function getRecipes(): LengthAwarePaginator
    {
        return Recipe::with(['firstImage', 'limitedIngredients'])
            ->where('user_id', $this->user->id)
            ->latest()
            ->paginate(20);
    }

    protected function getIngredients(): Collection
    {
        return Ingredient::withCount([
            'recipes' => function ($query) {
                $query->where('user_id', $this->user->id);
            }])
            ->whereHas('recipes', function ($query) {
                $query->where('user_id', $this->user->id);
            })
            ->orderByDesc('recipes_count')
            ->limit(20)
            ->get();
    }
}
