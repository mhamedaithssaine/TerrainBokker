<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage-category']);
        Permission::create(['name' => 'manage-user']);
        Permission::create(['name' => 'manage-sponsor']);
        Permission::create(['name' => 'manage-terrain']);
    }
}
