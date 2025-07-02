<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeImage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'title'       => $this->faker->words(asText: true),
            'description' => $this->faker->sentences(200, asText: true),
            'views'       => $this->faker->numberBetween(0, 100000),
        ];
    }

    public function configure(): RecipeFactory|Factory
    {
        return $this->afterCreating(function (Recipe $recipe) {
            $ingredients = Ingredient::inRandomOrder()->take(rand(5, 15))->pluck('id');
            $recipe->ingredients()->attach($ingredients);

            RecipeImage::factory(rand(1, 5))->create([
                'recipe_id' => $recipe->id,
            ]);
        });
    }
}
