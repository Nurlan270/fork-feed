<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function subscribe(User $user, User $targetUser): bool
    {
        return $user->hasVerifiedEmail() && $user->id !== $targetUser->id;
    }

    public function unsubscribe(User $user, User $targetUser): bool
    {
        return $user->hasVerifiedEmail() && $user->id !== $targetUser->id;
    }
}
