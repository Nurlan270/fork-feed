<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'username'          => $this->faker->userName(),
            'email'             => $this->faker->unique()->safeEmail(),
            'avatar'            => asset('media/logo-mini.png'),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create a user with associated recipes.
     *
     * @param int $recipesCount Count of recipes to create for each user
     *
     * @return \Database\Factories\UserFactory
     */
    public function withRecipes(int $recipesCount = 2): UserFactory
    {
        return $this->afterCreating(function (User $user) use ($recipesCount) {
            Recipe::factory($recipesCount)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
