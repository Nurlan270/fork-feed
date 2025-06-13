<?php

namespace App\Livewire\User;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRecipes extends Component
{
    use WithPagination;

    public ?User $user;

    public function mount(): void
    {
        $this->user ??= auth()->user();
    }

    public function render(): View
    {
        return view('livewire.user.show-recipes', [
            'recipes'     => $this->recipes(),
            'ingredients' => $this->ingredients(),
        ]);
    }

    protected function recipes(): LengthAwarePaginator
    {
        return Recipe::with(['firstImage', 'limitedIngredients'])
            ->where('user_id', $this->user->id)
            ->latest()
            ->paginate(25);
    }

    protected function ingredients(): Collection
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
