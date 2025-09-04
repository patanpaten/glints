<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get company users
        $companyUser1 = User::where('email', 'hr@techindo.com')->first();
        
        // Create additional company users if needed
        $companyUser2 = User::create([
            'name' => 'PT Digital Solutions',
            'email' => 'contact@digitalsol.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role_id' => 2, // Company role
        ]);

        $companyUser3 = User::create([
            'name' => 'CV Startup Inovasi',
            'email' => 'info@startupinovasi.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role_id' => 2, // Company role
        ]);

        // Company 1
        Company::create([
            'user_id' => $companyUser1->id,
            'name' => 'PT Tech Indonesia',
            'description' => 'Perusahaan teknologi terdepan di Indonesia yang fokus pada pengembangan software dan aplikasi mobile.',
            'industry' => 'Technology',
            'website' => 'https://techindo.com',
            'logo' => null,
            'company_size' => '51-200',
            'phone' => '+62-21-12345678',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'postal_code' => '12345',
            'country' => 'Indonesia',
            'credits' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Company 2
        Company::create([
            'user_id' => $companyUser2->id,
            'name' => 'PT Digital Solutions',
            'description' => 'Solusi digital terpadu untuk transformasi bisnis perusahaan modern.',
            'industry' => 'Digital Marketing',
            'website' => 'https://digitalsol.com',
            'logo' => null,
            'company_size' => '11-50',
            'phone' => '+62-22-87654321',
            'address' => 'Jl. Dago No. 456, Bandung',
            'city' => 'Bandung',
            'province' => 'Jawa Barat',
            'postal_code' => '40123',
            'country' => 'Indonesia',
            'credits' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Company 3
        Company::create([
            'user_id' => $companyUser3->id,
            'name' => 'CV Startup Inovasi',
            'description' => 'Startup yang berfokus pada inovasi teknologi untuk solusi bisnis UMKM.',
            'industry' => 'Fintech',
            'website' => 'https://startupinovasi.com',
            'logo' => null,
            'company_size' => '1-10',
            'phone' => '+62-31-11223344',
            'address' => 'Jl. Pemuda No. 789, Surabaya',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => '60123',
            'country' => 'Indonesia',
            'credits' => 25,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}