<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\JobSeeker;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobSeekers = JobSeeker::all();

        // Experience for Job Seeker 1 (John Doe) - Fresh Graduate with Internship
        Experience::create([
            'job_seeker_id' => $jobSeekers->first()->id,
            'company_name' => 'PT Startup Digital',
            'position' => 'Frontend Developer Intern',
            'start_date' => '2017-01-01',
            'end_date' => '2017-06-01',
            'is_current' => false,
            'description' => 'Mengembangkan user interface untuk aplikasi web menggunakan React.js. Berkolaborasi dengan tim design untuk implementasi mockup ke dalam kode.',
            'location' => 'Jakarta, Indonesia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Experience for Job Seeker 2 (Jane Smith) - Mid-level Designer
        Experience::create([
            'job_seeker_id' => $jobSeekers->skip(1)->first()->id ?? $jobSeekers->first()->id,
            'company_name' => 'Creative Agency Bandung',
            'position' => 'Junior UI/UX Designer',
            'start_date' => '2014-08-01',
            'end_date' => '2016-12-01',
            'is_current' => false,
            'description' => 'Merancang interface untuk berbagai klien dari startup hingga enterprise. Melakukan user research dan usability testing.',
            'location' => 'Bandung, Indonesia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Experience::create([
            'job_seeker_id' => $jobSeekers->skip(1)->first()->id ?? $jobSeekers->first()->id,
            'company_name' => 'PT Digital Innovation',
            'position' => 'Senior UI/UX Designer',
            'start_date' => '2017-01-01',
            'end_date' => null,
            'is_current' => true,
            'description' => 'Memimpin tim design untuk produk fintech. Bertanggung jawab atas design system dan user experience strategy.',
            'location' => 'Bandung, Indonesia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Experience for Job Seeker 3 (Ahmad Rahman) - Senior Developer
        Experience::create([
            'job_seeker_id' => $jobSeekers->skip(2)->first()->id ?? $jobSeekers->first()->id,
            'company_name' => 'PT Software Solutions',
            'position' => 'Junior Software Developer',
            'start_date' => '2012-08-01',
            'end_date' => '2015-07-01',
            'is_current' => false,
            'description' => 'Mengembangkan aplikasi web menggunakan PHP dan MySQL. Maintenance sistem existing dan bug fixing.',
            'location' => 'Surabaya, Indonesia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Experience::create([
            'job_seeker_id' => $jobSeekers->skip(2)->first()->id ?? $jobSeekers->first()->id,
            'company_name' => 'PT Tech Innovate',
            'position' => 'Senior Full Stack Developer',
            'start_date' => '2015-08-01',
            'end_date' => null,
            'is_current' => true,
            'description' => 'Lead developer untuk platform e-commerce. Menggunakan Node.js, React, dan AWS. Mentoring junior developers dan code review.',
            'location' => 'Surabaya, Indonesia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}