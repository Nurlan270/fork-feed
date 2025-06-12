<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ShowBookmarks extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('bookmark-removed')]
    public function render()
    {
        $bookmarks = auth()->user()->bookmarks()
            ->with('firstImage')
            ->latest()
            ->paginate(50);

        if ($bookmarks->isEmpty() && $bookmarks->currentPage() > 1) {
            $this->previousPage();
        }

        return view('livewire.show-bookmarks', compact('bookmarks'));
    }
}
