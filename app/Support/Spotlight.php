<?php

namespace App\Support;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Spotlight
{
    public function search(Request $request): Collection|array
    {
        if (!auth()->check()) {
            return [];
        }

        return collect()
            ->merge($this->users($request->string('search')))
            ->merge($this->recipes($request->string('search')));
    }


    protected function recipes(string $search = ''): Collection
    {
        return Recipe::search($search)->get()
            ->map(function ($recipe) {
                return [
                    'name'        => $recipe->title,
                    'description' => Str::limit($recipe->description),
                    'avatar'      => $recipe->firstImage?->path,
                    'link'        => getLocalizedURL('recipe.show', $recipe),
                ];
            });
    }

    protected function users(string $search = ''): Collection
    {
        return User::search($search)->get()
            ->map(function ($user) {
                return [
                    'name'        => $user->name,
                    'description' => '@' . $user->username,
                    'avatar'      => $user->avatar,
                    'link'        => getLocalizedURL('user.tag-profile', $user),
                ];
            });
    }
}

