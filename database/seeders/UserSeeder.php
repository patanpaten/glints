<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@glints.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role_id' => 1, // Admin role
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Company User
        User::create([
            'name' => 'PT Tech Indonesia',
            'email' => 'hr@techindo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role_id' => 2, // Company role
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Job Seeker User
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role_id' => 3, // Job Seeker role
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}