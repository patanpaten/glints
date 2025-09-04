<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Company;
use App\Models\JobCategory;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Job 1
        Job::create([
            'company_id' => 1,
            'job_category_id' => 1, // Technology
            'title' => 'Frontend Developer',
            'slug' => Str::slug('Frontend Developer'),
            'description' => 'Kami mencari Frontend Developer yang berpengalaman untuk bergabung dengan tim development kami. Kandidat ideal memiliki pengalaman dalam React.js, Vue.js, atau Angular. Minimal 2 tahun pengalaman dalam frontend development, menguasai HTML, CSS, JavaScript, dan framework modern seperti React atau Vue.',
            'location' => 'Jakarta, Indonesia',
            'employment_type' => 'full-time',
            'experience_level' => 'mid-level',
            'education_level' => 'S1',
            'vacancies' => 2,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Job 2
        Job::create([
            'company_id' => 2,
            'job_category_id' => 2, // Design
            'title' => 'UI/UX Designer',
            'slug' => Str::slug('UI/UX Designer'),
            'description' => 'Bergabunglah dengan tim kreatif kami sebagai UI/UX Designer. Anda akan bertanggung jawab untuk merancang pengalaman pengguna yang intuitif dan menarik. Minimal 3 tahun pengalaman dalam UI/UX design, menguasai Figma, Sketch, atau Adobe XD, pemahaman tentang user research dan usability testing.',
            'location' => 'Bandung, Indonesia',
            'employment_type' => 'full-time',
            'experience_level' => 'mid-level',
            'education_level' => 'S1',
            'vacancies' => 1,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Job 3
        Job::create([
            'company_id' => 3,
            'job_category_id' => 1, // Technology
            'title' => 'Senior Backend Developer',
            'slug' => Str::slug('Senior Backend Developer'),
            'description' => 'Kami membutuhkan Senior Backend Developer untuk memimpin pengembangan sistem backend yang scalable dan robust. Posisi ini cocok untuk yang ingin berkembang di startup fintech. Minimal 5 tahun pengalaman backend development, menguasai Node.js, Python, atau Java, pengalaman dengan database dan cloud services.',
            'location' => 'Surabaya, Indonesia',
            'employment_type' => 'full-time',
            'experience_level' => 'senior-level',
            'education_level' => 'S1',
            'vacancies' => 1,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}