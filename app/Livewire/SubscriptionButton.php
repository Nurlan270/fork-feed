<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class SubscriptionButton extends Component
{
    public User $user;
    public bool $isFollowing = false;

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->isFollowing = auth()->check() ? auth()->user()->following->contains($user->id) : false;
    }
    public function follow()
    {
        auth()->user()->following()->attach($this->user->id);
        $this->isFollowing = true;
    }

    public function unfollow()
    {
        auth()->user()->following()->detach($this->user->id);
        $this->isFollowing = false;
    }
}
