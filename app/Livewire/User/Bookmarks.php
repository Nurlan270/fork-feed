<?php

namespace App\Livewire\User;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Bookmarks extends Component
{
    public Collection $bookmarks;

    public function mount(): void
    {
        $this->bookmarks = auth()->user()->bookmarks()->with('firstImage')->get();
    }

    public function removeBookmark(string $id): void
    {
        auth()->user()->bookmarks()->detach($id);

        $this->bookmarks = auth()->user()->bookmarks()->with('firstImage')->get();
    }
}
