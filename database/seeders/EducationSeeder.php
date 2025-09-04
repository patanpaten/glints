<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\JobSeeker;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobSeekers = JobSeeker::all();

        // Education 1
        Education::create([
            'job_seeker_id' => 1,
            'institution' => 'Universitas Indonesia',
            'degree' => 'Bachelor',
            'field_of_study' => 'Computer Science',
            'start_date' => '2013-08-01',
            'end_date' => '2017-07-01',
            'is_current' => false,
            'description' => 'Fokus pada software engineering dan algoritma. Aktif dalam organisasi mahasiswa dan kompetisi programming.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Education for Job Seeker 2 (Jane Smith)
        Education::create([
            'job_seeker_id' => $jobSeekers->skip(1)->first()->id ?? $jobSeekers->first()->id,
            'institution' => 'Institut Teknologi Bandung',
            'degree' => 'Bachelor',
            'field_of_study' => 'Visual Communication Design',
            'start_date' => '2010-08-01',
            'end_date' => '2014-07-01',
            'is_current' => false,
            'description' => 'Spesialisasi dalam digital design dan user interface. Thesis tentang user experience dalam aplikasi mobile.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Education for Job Seeker 3 (Ahmad Rahman)
        Education::create([
            'job_seeker_id' => $jobSeekers->skip(2)->first()->id ?? $jobSeekers->first()->id,
            'institution' => 'Institut Teknologi Sepuluh Nopember',
            'degree' => 'Bachelor',
            'field_of_study' => 'Informatics Engineering',
            'start_date' => '2008-08-01',
            'end_date' => '2012-07-01',
            'is_current' => false,
            'description' => 'Konsentrasi pada software engineering dan database systems. Proyek akhir tentang sistem informasi manajemen.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}