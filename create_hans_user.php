<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Hash;

echo "Creating Hans user...\n";

// Check if hans user already exists
$existingUser = User::where('email', 'hans@gmail.com')->first();
if ($existingUser) {
    echo "User hans@gmail.com already exists!\n";
    echo "Email: {$existingUser->email}\n";
    echo "Name: {$existingUser->name}\n";
    echo "Role ID: {$existingUser->role_id}\n";
    exit(0);
}

// Create hans user
$user = User::create([
    'name' => 'Hans Doe',
    'email' => 'hans@gmail.com',
    'email_verified_at' => now(),
    'password' => Hash::make('hans1234'),
    'role_id' => 3, // Job Seeker role
    'created_at' => now(),
    'updated_at' => now(),
]);

echo "User hans@gmail.com created successfully!\n";
echo "Email: {$user->email}\n";
echo "Password: hans1234\n";
echo "Role ID: {$user->role_id}\n";

// Create JobSeeker profile for hans
$jobSeeker = JobSeeker::create([
    'user_id' => $user->id,
    'first_name' => 'Hans',
    'last_name' => 'Doe',
    'birth_date' => '1990-01-01',
    'phone' => '081234567890',
    'address' => 'Jl. Sudirman No. 123',
    'city' => 'Jakarta',
    'province' => 'DKI Jakarta',
    'summary' => 'Experienced professional looking for new opportunities.',
    'created_at' => now(),
    'updated_at' => now(),
]);

echo "JobSeeker profile created for hans (ID: {$jobSeeker->id})\n";
echo "\nNow hans can login with:\n";
echo "Email: hans@gmail.com\n";
echo "Password: hans1234\n";