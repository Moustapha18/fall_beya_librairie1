<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livre>
 */
class LivreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(3),
            'auteur' => $this->faker->name(),
            'categorie' => $this->faker->randomElement(['Roman', 'Science', 'Histoire']),
            'prix' => $this->faker->randomFloat(2, 5, 100),
            'description' => $this->faker->paragraph(),
            'stock' => $this->faker->numberBetween(0, 20),
            'image' => null
        ];
    }
}
