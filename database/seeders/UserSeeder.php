<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->roles()->attach(Role::where('name', 'admin')->first());
        $sportiveRole = Role::where('name', 'sportive')->first();
        $organisateurRole = Role::where('name', 'organisateur')->first();
        User::factory()->count(10)->create()->each(function ($user) use ($sportiveRole) {
            $user->roles()->attach($sportiveRole);
        });
    
        User::factory()->count(10)->create()->each(function ($user) use ($organisateurRole) {
            $user->roles()->attach($organisateurRole);
        });
    }
}
