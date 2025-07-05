<?php

namespace App\Livewire;

use App\Enums\ReactionType;
use App\Models\Ingredient;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShowIngredients extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $sort = '';

    public function render(): View
    {
        return view('livewire.show-ingredients', [
            'ingredients' => $this->ingredients(),
        ]);
    }

    public function updated($property): void
    {
        if (in_array($property, ['search', 'sort'])) {
            $this->resetPage();
        }
    }

    protected function ingredients(): LengthAwarePaginator
    {
        $query = Ingredient::query()->withCount([
            'recipes as recipes_count' => fn($q) => $q->select(DB::raw('COUNT(*)')),
            'recipes as likes_count'   => function (Builder $query) {
                $query->whereHas('reactions', function (Builder $query) {
                    $query->where('type', ReactionType::LIKE);
                });
            },
        ])->orderByRaw($this->getSortColumn());

        if ($this->search) {
            $ids = Ingredient::search($this->search)->get()->pluck('id');

            $query->whereIn('id', $ids);
        }

        return $query->paginate(52);
    }

    protected function getSortColumn(): string
    {
        return match ($this->sort) {
            'most_liked' => 'likes_count DESC',
            default      => 'recipes_count DESC',
        };
    }
}
