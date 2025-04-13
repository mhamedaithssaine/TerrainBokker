<?php

namespace Database\Factories;

use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Sponsor::class;
 
     
    public function definition(): array
    {
        return [
            'name'=>$this->faker->company,
            'logo' => $this->faker->imageUrl(100, 100, 'business'),
        ];
    }
}
