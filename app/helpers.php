<?php

use App\Models\User;
use Illuminate\Support\Str;

if (!function_exists('getUsernameSlug')) {
    function getUsernameSlug(string $username, bool $checkForExistence = false): string
    {
        $username = Str::of($username)->trim()->lower()->slug('_');

        if ($checkForExistence && User::where('username', $username)->exists()) {
            $username .= Str::random(2);
        }

        return $username;
    }
}

if (!function_exists('markRoute')) {
    function markRoute(string $routeName, string $classes)
    {
        if (Route::is($routeName)) {
            return $classes;
        }
    }
}
