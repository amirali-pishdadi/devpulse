<?php

namespace Database\Factories;

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
            'name'              => $this->faker->name,
            'username'          => $this->faker->unique()->userName,
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->boolean(80) ? now() : null, 
            'password'          => Hash::make('password'), 
            'is_admin'          => $this->faker->boolean(20), 
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
