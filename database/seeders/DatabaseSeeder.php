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
        ]);

        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1, // Admin role
        ]);

        // Create company users and their companies
        User::factory(5)->create([
            'role_id' => 2, // Company role
        ])->each(function ($user) {
            $user->company()->create(\App\Models\Company::factory()->make()->toArray());
        });

        // Create job seeker users and their profiles
        User::factory(20)->create([
            'role_id' => 3, // Job Seeker role
        ])->each(function ($user) {
            $jobSeeker = $user->jobSeeker()->create(\App\Models\JobSeeker::factory()->make()->toArray());
            
            // Create educations
            $jobSeeker->educations()->createMany(\App\Models\Education::factory(rand(1, 3))->make()->toArray());
            
            // Create experiences
            $jobSeeker->experiences()->createMany(\App\Models\Experience::factory(rand(1, 5))->make()->toArray());
            
            // Attach skills
            $skillIds = \App\Models\Skill::inRandomOrder()->limit(rand(3, 8))->pluck('id');
            $levels = ['beginner', 'intermediate', 'advanced', 'expert'];
            
            foreach ($skillIds as $skillId) {
                $jobSeeker->skills()->attach($skillId, ['level' => $levels[array_rand($levels)]]);
            }
        });

        // Create jobs
        \App\Models\Company::all()->each(function ($company) {
            $jobs = \App\Models\Job::factory(rand(1, 3))->make([
                'company_id' => $company->id,
                'job_category_id' => \App\Models\JobCategory::inRandomOrder()->first()->id,
            ]);
            
            $company->jobs()->saveMany($jobs);
            
            // Attach skills to jobs
            $company->jobs->each(function ($job) {
                $skillIds = \App\Models\Skill::inRandomOrder()->limit(rand(3, 6))->pluck('id');
                $job->skills()->attach($skillIds);
                
                // Create applications
                $jobSeekerIds = \App\Models\JobSeeker::inRandomOrder()->limit(rand(0, 5))->pluck('id');
                $statuses = ['pending', 'reviewed', 'shortlisted', 'rejected', 'hired'];
                
                foreach ($jobSeekerIds as $jobSeekerId) {
                    \App\Models\Application::create([
                        'job_id' => $job->id,
                        'job_seeker_id' => $jobSeekerId,
                        'cover_letter' => fake()->paragraphs(3, true),
                        'status' => $statuses[array_rand($statuses)],
                    ]);
                }
            });
        });
    }
}
