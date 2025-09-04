<?php

namespace Database\Seeders;

use App\Models\JobSeeker;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing job seeker user
        $jobSeekerUser1 = User::where('email', 'john.doe@gmail.com')->first();
        
        // Create additional job seeker users
        $jobSeekerUser2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role_id' => 3, // Job Seeker role
        ]);

        $jobSeekerUser3 = User::create([
            'name' => 'Ahmad Rahman',
            'email' => 'ahmad.rahman@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role_id' => 3, // Job Seeker role
        ]);

        // Job Seeker 1
        JobSeeker::create([
            'user_id' => $jobSeekerUser1->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '+62-812-3456-7890',
            'birth_date' => '1995-05-15',
            'address' => 'Jl. Merdeka No. 123, Jakarta',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'postal_code' => '12345',
            'summary' => 'Fresh graduate dengan passion di bidang teknologi dan pengembangan software. Memiliki pengalaman magang di beberapa startup teknologi.',
            'profile_picture' => null,
            'current_position' => 'Fresh Graduate',
            'expected_salary' => '8000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Job Seeker 2
        JobSeeker::create([
            'user_id' => $jobSeekerUser2->id,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'phone' => '+62-813-9876-5432',
            'birth_date' => '1992-08-22',
            'address' => 'Jl. Sudirman No. 456, Bandung',
            'city' => 'Bandung',
            'province' => 'Jawa Barat',
            'postal_code' => '40123',
            'summary' => 'UI/UX Designer berpengalaman 3 tahun dengan keahlian dalam design thinking dan user research. Passionate tentang creating user-centered design.',
            'profile_picture' => null,
            'current_position' => 'Senior UI/UX Designer',
            'expected_salary' => '12000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Job Seeker 3
        JobSeeker::create([
            'user_id' => $jobSeekerUser3->id,
            'first_name' => 'Ahmad',
            'last_name' => 'Rahman',
            'phone' => '+62-814-1122-3344',
            'birth_date' => '1990-12-10',
            'address' => 'Jl. Diponegoro No. 789, Surabaya',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => '60123',
            'summary' => 'Senior Software Engineer dengan 5 tahun pengalaman dalam full-stack development. Expert dalam React, Node.js, dan cloud technologies.',
            'profile_picture' => null,
            'current_position' => 'Senior Full Stack Developer',
            'expected_salary' => '18000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}