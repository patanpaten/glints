<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Role;

echo "All Roles:\n";
echo "==========\n";

foreach (Role::all() as $role) {
    echo "Name: {$role->name} -> Slug: {$role->slug}\n";
}

echo "\nChecking user hans@gmail.com role:\n";
$user = App\Models\User::where('email', 'hans@gmail.com')->first();
if ($user && $user->role) {
    echo "User role name: {$user->role->name}\n";
    echo "User role slug: {$user->role->slug}\n";
}