<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  Create users
        //  If you want to create users with associated recipes, add `->withRecipes()` to the factory call
        User::factory(100)->withRecipes()->create();

        //  Create recipes for a specific user
        //  Recipe::factory(100)->create([
        //    'user_id' => 1, // Specify User ID you want to create recipes for
        //  ]);
    }
}
