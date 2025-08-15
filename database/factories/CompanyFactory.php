<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $industries = [
            'Technology', 'Finance', 'Healthcare', 'Education', 'Marketing',
            'Retail', 'Manufacturing', 'Hospitality', 'Construction', 'Transportation',
        ];

        $companySizes = [10, 50, 100, 250, 500, 1000, 5000, 10000];

        return [
            'name' => fake()->company(),
            'logo' => null, // Would be a file path in real scenario
            'description' => fake()->paragraphs(3, true),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'province' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'phone' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'industry' => $industries[array_rand($industries)],
            'company_size' => $companySizes[array_rand($companySizes)],
        ];
    }
}