<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Education::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $institutions = [
            'Universitas Indonesia', 'Institut Teknologi Bandung', 'Universitas Gadjah Mada',
            'Universitas Airlangga', 'Institut Teknologi Sepuluh Nopember', 'Universitas Brawijaya',
            'Universitas Padjadjaran', 'Universitas Diponegoro', 'Universitas Hasanuddin',
            'Universitas Bina Nusantara', 'Universitas Telkom', 'Universitas Multimedia Nusantara',
        ];

        $degrees = ['SMA', 'D3', 'S1', 'S2', 'S3'];

        $fields = [
            'Computer Science', 'Information Technology', 'Business Management',
            'Accounting', 'Marketing', 'Finance', 'Engineering', 'Design',
            'Communication', 'Psychology', 'Law', 'Medicine',
        ];

        $startDate = fake()->dateTimeBetween('-10 years', '-5 years');
        $endDate = fake()->dateTimeBetween($startDate, '-1 year');
        $isCurrent = fake()->boolean(20); // 20% chance of being current

        return [
            'institution' => $institutions[array_rand($institutions)],
            'degree' => $degrees[array_rand($degrees)],
            'field_of_study' => $fields[array_rand($fields)],
            'start_date' => $startDate,
            'end_date' => $isCurrent ? null : $endDate,
            'is_current' => $isCurrent,
            'description' => fake()->paragraphs(1, true),
        ];
    }
}