<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  Create ingredients
        Ingredient::factory(25)->create();

        //  Create users
        //  If you want to create users without associated recipes, remove `->withRecipes()` from the factory call
        User::factory(100)->withRecipes()->create();

        //  Create recipes for a specific user
//          Recipe::factory(50)->create([
//            'user_id' => 1, // Specify User ID you want to create recipes for
//          ]);
    }
}
