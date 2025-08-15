<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Finance',
            'Healthcare',
            'Education',
            'Marketing',
            'Sales',
            'Customer Service',
            'Human Resources',
            'Engineering',
            'Design',
            'Legal',
            'Administration',
            'Retail',
            'Hospitality',
            'Manufacturing',
        ];

        foreach ($categories as $category) {
            JobCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}