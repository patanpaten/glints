<?php

namespace Database\Factories;

use App\Models\JobSeeker;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobSeekerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobSeeker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = [
            'Software Engineer', 'Web Developer', 'Data Scientist', 'Product Manager',
            'UI/UX Designer', 'Digital Marketer', 'Content Writer', 'HR Manager',
            'Sales Executive', 'Customer Support', 'Project Manager', 'Business Analyst',
        ];

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'birth_date' => fake()->dateTimeBetween('-40 years', '-20 years'),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'province' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'profile_picture' => null, // Would be a file path in real scenario
            'summary' => fake()->paragraphs(2, true),
            'current_position' => $positions[array_rand($positions)],
            'expected_salary' => fake()->numberBetween(5, 50) . '000000',
        ];
    }
}