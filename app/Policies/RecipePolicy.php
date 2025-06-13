<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecipePolicy
{
    public function update(User $user, Recipe $recipe): Response
    {
        return $user->id === $recipe->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function delete(User $user, Recipe $recipe): Response
    {
        return $user->id === $recipe->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function like(User $user): Response
    {
        return $user->hasVerifiedEmail()
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function dislike(User $user): Response
    {
        return $user->hasVerifiedEmail()
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function bookmark(User $user): Response
    {
        return $user->hasVerifiedEmail()
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
