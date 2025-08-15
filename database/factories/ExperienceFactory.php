<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companies = [
            'PT Tokopedia', 'PT Gojek Indonesia', 'PT Bukalapak.com', 'PT Traveloka Indonesia',
            'PT Shopee International Indonesia', 'PT Grab Indonesia', 'PT Blibli.com',
            'PT Lazada Indonesia', 'PT Tiket.com', 'PT Ruangguru', 'PT Dana Indonesia',
            'PT OVO Indonesia', 'PT LinkAja', 'PT Astra International', 'PT Telkom Indonesia',
        ];

        $positions = [
            'Software Engineer', 'Web Developer', 'Data Scientist', 'Product Manager',
            'UI/UX Designer', 'Digital Marketer', 'Content Writer', 'HR Manager',
            'Sales Executive', 'Customer Support', 'Project Manager', 'Business Analyst',
        ];

        $locations = [
            'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Medan',
            'Bali', 'Makassar', 'Semarang', 'Palembang', 'Balikpapan',
        ];

        $startDate = fake()->dateTimeBetween('-8 years', '-1 year');
        $endDate = fake()->dateTimeBetween($startDate, 'now');
        $isCurrent = fake()->boolean(30); // 30% chance of being current

        return [
            'company_name' => $companies[array_rand($companies)],
            'position' => $positions[array_rand($positions)],
            'location' => $locations[array_rand($locations)],
            'start_date' => $startDate,
            'end_date' => $isCurrent ? null : $endDate,
            'is_current' => $isCurrent,
            'description' => fake()->paragraphs(2, true),
        ];
    }
}