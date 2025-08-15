<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->jobTitle();
        $employmentTypes = ['Full-time', 'Part-time', 'Contract', 'Internship', 'Freelance'];
        $experienceLevels = ['Entry Level', 'Mid Level', 'Senior Level', 'Executive Level'];
        $educationLevels = ['SMA', 'D3', 'S1', 'S2', 'S3'];
        $locations = [
            'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Medan',
            'Bali', 'Makassar', 'Semarang', 'Palembang', 'Balikpapan',
        ];
        $salaryRanges = [
            '5-10 juta', '10-15 juta', '15-20 juta', '20-25 juta',
            '25-30 juta', '30-40 juta', '40-50 juta', 'Negotiable',
        ];

        return [
            'title' => $title,
            'slug' => Str::slug($title . '-' . Str::random(8)),
            'description' => fake()->paragraphs(4, true),
            'requirements' => fake()->paragraphs(3, true),
            'responsibilities' => fake()->paragraphs(3, true),
            'location' => $locations[array_rand($locations)],
            'employment_type' => $employmentTypes[array_rand($employmentTypes)],
            'experience_level' => $experienceLevels[array_rand($experienceLevels)],
            'education_level' => $educationLevels[array_rand($educationLevels)],
            'salary_range' => $salaryRanges[array_rand($salaryRanges)],
            'vacancies' => fake()->numberBetween(1, 5),
            'deadline' => fake()->dateTimeBetween('+1 week', '+2 months'),
            'is_active' => fake()->boolean(80), // 80% chance of being active
            'is_featured' => fake()->boolean(20), // 20% chance of being featured
        ];
    }
}