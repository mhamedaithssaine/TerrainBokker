<?php

namespace Database\Factories;

use App\Models\Sponsor;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Terrain>
 */
class TerrainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'photo' => $this->faker->imageUrl(),
            'prix' => $this->faker->randomFloat(2, 100, 1000),
            'sponsor_id' => Sponsor::inRandomOrder()->first()->id, 
            'categorie_id' => Category::inRandomOrder()->first()->id,
            'statut' => $this->faker->randomElement(['disponible', 'indisponible']),
            'adresse' => $this->faker->address,
        ];
    
    }
}
