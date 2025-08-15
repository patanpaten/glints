<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
            ],
            [
                'name' => 'Company',
                'slug' => 'company',
            ],
            [
                'name' => 'Job Seeker',
                'slug' => 'job-seeker',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}