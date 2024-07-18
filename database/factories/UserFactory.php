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
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'phone'             => fake()->phoneNumber(),
            'mobile'            => fake()->phoneNumber(),
            'role'              => fake()->randomElement(['admin', 'landlord', 'tenant', 'visitor']),
            'cpf_cnpj'          => fake()->unique()->bothify('###########'),
            'user_notes'        => fake()->sentence(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now(),
            'deleted_at'        => null,
            'cep'               => fake()->bothify('##########'),
            'rua'               => fake()->streetAddress(),
            'bairro'            => fake()->streetName(),
            'cidade'            => fake()->city(),
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
}
