<?php

namespace App\Livewire\Buttons;

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UserActionButtons extends Component
{
    #[Locked]
    public User $user;
    public bool $isFollowing = false;

    public function mount(): void
    {
        $this->isFollowing = auth()->user()?->following->contains($this->user->id) ?? false;
    }
    public function follow(): void
    {
        auth()->user()->following()->attach($this->user->id);
        $this->isFollowing = true;
    }

    public function unfollow(): void
    {
        auth()->user()->following()->detach($this->user->id);
        $this->isFollowing = false;
    }
}
