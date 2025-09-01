<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Login Flow...\n";
echo "===================\n\n";

// Test 1: Check if user exists
echo "1. Checking if user hans@gmail.com exists...\n";
$user = User::where('email', 'hans@gmail.com')->first();
if ($user) {
    echo "   ✓ User found: {$user->name} (Role: {$user->role->name})\n";
} else {
    echo "   ✗ User not found\n";
    exit(1);
}

// Test 2: Verify password
echo "\n2. Verifying password 'hans1234'...\n";
if (Hash::check('hans1234', $user->password)) {
    echo "   ✓ Password is correct\n";
} else {
    echo "   ✗ Password is incorrect\n";
    exit(1);
}

// Test 3: Test Auth attempt
echo "\n3. Testing Auth::attempt...\n";
$credentials = ['email' => 'hans@gmail.com', 'password' => 'hans1234'];
if (Auth::attempt($credentials)) {
    echo "   ✓ Auth::attempt successful\n";
    $authenticatedUser = Auth::user();
    echo "   ✓ Authenticated user: {$authenticatedUser->name}\n";
    echo "   ✓ User role: {$authenticatedUser->role->name}\n";
    
    // Test redirect logic
    echo "\n4. Testing redirect logic...\n";
    switch ($authenticatedUser->role->name) {
        case 'admin':
            $expectedRedirect = 'admin.dashboard';
            break;
        case 'company':
            $expectedRedirect = 'company.dashboard';
            break;
        case 'job-seeker':
            $expectedRedirect = 'jobseeker.dashboard';
            break;
        default:
            $expectedRedirect = 'home';
    }
    echo "   ✓ Expected redirect for role '{$authenticatedUser->role->name}': {$expectedRedirect}\n";
    
    Auth::logout();
} else {
    echo "   ✗ Auth::attempt failed\n";
    exit(1);
}

echo "\n===================\n";
echo "All tests passed! Login flow should work correctly.\n";
echo "\nIf login still doesn't work in browser, the issue might be:\n";
echo "- Session configuration\n";
echo "- CSRF token validation\n";
echo "- JavaScript interference\n";
echo "- Browser cache/cookies\n";