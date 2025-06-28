<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function follow(User $user, User $targetUser): bool
    {
        return $user->hasVerifiedEmail() && $user->id !== $targetUser->id;
    }

    public function unfollow(User $user, User $targetUser): bool
    {
        return $user->hasVerifiedEmail() && $user->id !== $targetUser->id;
    }

    public function chat(User $user, User $targetUser): bool
    {
        return $user->hasVerifiedEmail() && $user->id !== $targetUser->id;
    }
}
