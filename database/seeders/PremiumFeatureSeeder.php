<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PremiumFeature;

class PremiumFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'name' => 'Basic',
                'description' => 'Essential features for small companies',
                'price' => 29.99,
                'duration_days' => 30,
                'features' => [
                    'Up to 5 active job postings',
                    'Basic analytics dashboard',
                    'Email support',
                    'Standard job templates'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Professional',
                'description' => 'Advanced features for growing companies',
                'price' => 79.99,
                'duration_days' => 30,
                'features' => [
                    'Up to 20 active job postings',
                    'Advanced analytics with charts',
                    'CV search functionality',
                    'Priority support',
                    'Custom job templates',
                    'Job promotion features',
                    'Applicant tracking system'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Enterprise',
                'description' => 'Full-featured solution for large companies',
                'price' => 199.99,
                'duration_days' => 30,
                'features' => [
                    'Unlimited job postings',
                    'Full analytics suite',
                    'Advanced CV search with AI matching',
                    'Dedicated account manager',
                    'Custom integrations',
                    'White-label options',
                    'Advanced reporting',
                    'Bulk operations',
                    'API access'
                ],
                'is_active' => true
            ]
        ];

        foreach ($features as $feature) {
            PremiumFeature::create($feature);
        }
    }
}
