<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Terrain;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'terrain_id' => Terrain::inRandomOrder()->first()->id,
            'sportive_id' => User::inRandomOrder()->first()->id,
            'date_debut' => $this->faker->dateTimeBetween('now', '+1 month'),
            'date_fin' => $this->faker->dateTimeBetween('+1 hour', '+2 months'),
            'statut' => $this->faker->randomElement(['confirmée', 'en_attente', 'annulée']),
        ];
    }
}
