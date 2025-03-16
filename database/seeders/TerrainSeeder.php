<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use App\Models\Terrain;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TerrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(5)->create();
        Sponsor::factory()->count(5)->create();
        Terrain::factory()->count(10)->create();
    }
}
