<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestCompanyUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:test-company-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test company user for login testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get company role
        $companyRole = Role::where('slug', 'company')->first();
        
        if (!$companyRole) {
            $this->error('Company role not found!');
            return 1;
        }

        // Create test user
        $user = User::create([
            'name' => 'Test Company',
            'email' => 'company@test.com',
            'password' => Hash::make('password123'),
            'role_id' => $companyRole->id,
            'email_verified_at' => now(),
        ]);

        // Create company profile
        $company = Company::create([
            'user_id' => $user->id,
            'name' => 'Test Company Ltd',
            'description' => 'A test company for login testing',
            'address' => 'Test Address 123',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'postal_code' => '12345',
            'phone' => '081234567890',
            'website' => 'https://testcompany.com',
            'industry' => 'Technology',
            'company_size' => '1-10',
        ]);

        $this->info('Test company user created successfully!');
        $this->info('Email: company@test.com');
        $this->info('Password: password123');
        $this->info('Company ID: ' . $company->id);
        
        return 0;
    }
}
