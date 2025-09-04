<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Job;
use App\Models\JobSeeker;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = Job::all();
        $jobSeekers = JobSeeker::all();

        // Application 1 - John Doe applies for Frontend Developer
        Application::create([
            'job_id' => $jobs->where('title', 'Frontend Developer')->first()->id ?? $jobs->first()->id,
            'job_seeker_id' => $jobSeekers->first()->id,
            'cover_letter' => 'Saya sangat tertarik dengan posisi Frontend Developer di perusahaan Anda. Sebagai fresh graduate dengan pengalaman magang, saya memiliki passion yang besar dalam pengembangan web dan selalu eager to learn teknologi baru. Pengalaman magang saya di startup digital telah memberikan saya exposure yang baik terhadap React.js dan modern web development practices.',
            'status' => 'pending',
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(5),
        ]);

        // Application 2 - Jane Smith applies for UI/UX Designer
        Application::create([
            'job_id' => $jobs->where('title', 'UI/UX Designer')->first()->id ?? $jobs->first()->id,
            'job_seeker_id' => $jobSeekers->skip(1)->first()->id ?? $jobSeekers->first()->id,
            'cover_letter' => 'Dengan pengalaman 3 tahun sebagai UI/UX Designer, saya yakin dapat memberikan kontribusi yang signifikan untuk tim kreatif Anda. Portfolio saya menunjukkan kemampuan dalam user research, wireframing, prototyping, dan collaboration dengan development team. Saya excited untuk bergabung dengan perusahaan yang menghargai user-centered design approach.',
            'status' => 'reviewed',
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(2),
        ]);

        // Application 3 - Ahmad Rahman applies for Senior Backend Developer
        Application::create([
            'job_id' => $jobs->where('title', 'Senior Backend Developer')->first()->id ?? $jobs->first()->id,
            'job_seeker_id' => $jobSeekers->skip(2)->first()->id ?? $jobSeekers->first()->id,
            'cover_letter' => 'Sebagai Senior Full Stack Developer dengan 5+ tahun pengalaman, saya tertarik untuk fokus pada backend development di startup fintech Anda. Pengalaman saya dalam membangun scalable systems menggunakan Node.js, microservices architecture, dan cloud technologies akan sangat relevan untuk posisi ini. Saya juga memiliki pengalaman dalam mentoring junior developers dan code review processes.',
            'status' => 'shortlisted',
            'created_at' => now()->subDays(15),
            'updated_at' => now()->subDays(1),
        ]);
    }
}