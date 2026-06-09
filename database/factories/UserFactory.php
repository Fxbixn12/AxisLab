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
            'name' => fake()->name(),
            'apellido' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

            // --- NUEVOS CAMPOS PARA QUE GITHUB NO FALLE ---
            'tipo_documento' => fake()->randomElement(['DNI', 'CE', 'Pasaporte']), // Elige uno al azar
            'numero_documento' => fake()->numerify('########'), // Inventa 8 números al azar
            'telefono' => fake()->numerify('9########'), // Inventa un celular que empiece con 9
            'fecha_nacimiento' => fake()->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'), // Inventa una fecha de alguien mayor de edad
            'id_rol' => 2, // Rol de cliente por defecto para las pruebas
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
