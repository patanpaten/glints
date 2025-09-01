<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

echo "=== Testing Dashboard Access ===\n";

// Test 1: Check if jobseeker.dashboard route exists
try {
    $route = Route::getRoutes()->getByName('jobseeker.dashboard');
    if ($route) {
        echo "✓ Route 'jobseeker.dashboard' exists\n";
        echo "  URI: " . $route->uri() . "\n";
        echo "  Methods: " . implode(', ', $route->methods()) . "\n";
        echo "  Middleware: " . implode(', ', $route->middleware()) . "\n";
    } else {
        echo "✗ Route 'jobseeker.dashboard' not found\n";
    }
} catch (Exception $e) {
    echo "✗ Error checking route: " . $e->getMessage() . "\n";
}

echo "\n";

// Test 2: Check user role and slug
$user = User::where('email', 'hans@gmail.com')->first();
if ($user) {
    echo "✓ User found: " . $user->email . "\n";
    if ($user->role) {
        echo "  Role name: " . $user->role->name . "\n";
        echo "  Role slug: " . $user->role->slug . "\n";
        
        // Test middleware logic
        $expectedMiddlewareRole = 'job-seeker';
        $userRoleSlug = strtolower($user->role->slug);
        
        echo "  Expected middleware role: " . $expectedMiddlewareRole . "\n";
        echo "  User role slug (lowercase): " . $userRoleSlug . "\n";
        
        if ($userRoleSlug === $expectedMiddlewareRole) {
            echo "  ✓ Role matches middleware expectation\n";
        } else {
            echo "  ✗ Role mismatch - this will cause middleware to fail\n";
        }
    } else {
        echo "  ✗ User has no role assigned\n";
    }
} else {
    echo "✗ User not found\n";
}

echo "\n";

// Test 3: Simulate login and check redirect
echo "=== Simulating Login Process ===\n";
try {
    // Simulate successful authentication
    Auth::login($user);
    echo "✓ User authenticated successfully\n";
    
    $role = Auth::user()->role?->slug;
    echo "  Authenticated user role slug: " . ($role ?? 'null') . "\n";
    
    // Simulate AuthController logic
    if ($role === 'admin') {
        echo "  → Would redirect to admin.dashboard\n";
    } elseif ($role === 'company') {
        echo "  → Would redirect to company.dashboard\n";
    } else {
        echo "  → Would redirect to jobseeker.dashboard (default)\n";
    }
    
    Auth::logout();
    echo "✓ User logged out\n";
    
} catch (Exception $e) {
    echo "✗ Error during login simulation: " . $e->getMessage() . "\n";
}

echo "\n=== Test Complete ===\n";