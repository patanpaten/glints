<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== LOGIN TEST ===\n";

// Check user for Company 1
$user = User::where('role_id', 2)->whereHas('company', function($q) {
    $q->where('id', 1);
})->first();

if($user) {
    echo "User found: {$user->email}\n";
    echo "Name: {$user->name}\n";
    echo "Role ID: {$user->role_id}\n";
    
    // Check if password is 'password'
    if(Hash::check('password', $user->password)) {
        echo "Password is 'password'\n";
    } else {
        echo "Password is NOT 'password'\n";
        // Try to update password to 'password'
        $user->password = Hash::make('password');
        $user->save();
        echo "Password updated to 'password'\n";
    }
} else {
    echo "No user found for Company 1\n";
}

echo "\n=== ALL COMPANY USERS ===\n";
$companyUsers = User::where('role_id', 2)->with('company')->get();
foreach($companyUsers as $user) {
    if($user->company) {
        echo "Email: {$user->email}, Company: {$user->company->name} (ID: {$user->company->id})\n";
    }
}