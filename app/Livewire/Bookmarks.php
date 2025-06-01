<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Bookmarks extends Component
{
    public Collection $bookmarks;

    public function removeBookmark(string $id): void
    {
        auth()->user()->bookmarks()->detach($id);

        $this->bookmarks = auth()->user()->bookmarks()->get();
    }
}
