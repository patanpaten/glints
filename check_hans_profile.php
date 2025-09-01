<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use App\Models\User;
use App\Models\JobSeeker;

echo "=== Checking Hans Profile Data ===\n";

// Find user hans
$user = User::where('email', 'hans@gmail.com')->first();

if (!$user) {
    echo "✗ User hans@gmail.com not found\n";
    exit(1);
}

echo "✓ User found: " . $user->email . "\n";
echo "  User ID: " . $user->id . "\n";
echo "  Name: " . $user->name . "\n";
echo "  Role: " . ($user->role ? $user->role->name : 'No role') . "\n";

// Check if JobSeeker profile exists
$jobSeeker = JobSeeker::where('user_id', $user->id)->first();

if (!$jobSeeker) {
    echo "\n✗ JobSeeker profile NOT found for user ID: " . $user->id . "\n";
    echo "This is why user is redirected to profile creation page!\n";
    
    echo "\n=== Creating JobSeeker Profile ===\n";
    
    // Create basic JobSeeker profile
    $jobSeeker = new JobSeeker();
    $jobSeeker->user_id = $user->id;
    $jobSeeker->phone = '081234567890'; // Default phone
    $jobSeeker->address = 'Jakarta, Indonesia'; // Default address
    $jobSeeker->date_of_birth = '1990-01-01'; // Default DOB
    $jobSeeker->gender = 'male'; // Default gender
    $jobSeeker->about = 'Experienced professional looking for new opportunities.';
    $jobSeeker->save();
    
    echo "✓ JobSeeker profile created successfully!\n";
    echo "  JobSeeker ID: " . $jobSeeker->id . "\n";
    echo "  Phone: " . $jobSeeker->phone . "\n";
    echo "  Address: " . $jobSeeker->address . "\n";
    
} else {
    echo "\n✓ JobSeeker profile found!\n";
    echo "  JobSeeker ID: " . $jobSeeker->id . "\n";
    echo "  Phone: " . ($jobSeeker->phone ?? 'Not set') . "\n";
    echo "  Address: " . ($jobSeeker->address ?? 'Not set') . "\n";
    echo "  Date of Birth: " . ($jobSeeker->date_of_birth ?? 'Not set') . "\n";
    echo "  Gender: " . ($jobSeeker->gender ?? 'Not set') . "\n";
}

echo "\n=== Test Complete ===\n";
echo "Now user hans should be able to access dashboard directly!\n";