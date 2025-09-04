<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            JobCategorySeeder::class,
            SkillSeeder::class,
            PremiumFeatureSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
            JobSeekerSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            JobSeeder::class,
            ApplicationSeeder::class,
        ]);

        // All data seeding is now handled by individual seeders above
    }
}
