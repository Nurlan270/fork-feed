<?php

use Illuminate\Support\Str;

if (!function_exists('getUsernameSlug')) {
    function getUsernameSlug(string $username): string
    {
        return Str::of($username)->trim()->lower()->replace(' ', '_');
    }
}
