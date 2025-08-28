<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Job;
use App\Models\Company;
use App\Models\Application;

echo "=== DATA CHECK ===\n";
echo "Total Companies: " . Company::count() . "\n";
echo "Total Jobs: " . Job::count() . "\n";
echo "Total Applications: " . Application::count() . "\n\n";

echo "=== JOBS BY COMPANY ===\n";
$jobs = Job::with('company')->get();
foreach($jobs as $job) {
    echo "Job ID: {$job->id}, Company ID: {$job->company_id}, Company: {$job->company->name}, Title: {$job->title}\n";
}

echo "\n=== COMPANY 31 DETAILS ===\n";
$company31 = Company::find(31);
if($company31) {
    echo "Company 31: {$company31->name}\n";
    echo "Jobs for Company 31: " . Job::where('company_id', 31)->count() . "\n";
    echo "Active Jobs for Company 31: " . Job::where('company_id', 31)->where('is_active', true)->count() . "\n";
} else {
    echo "Company 31 not found\n";
}

echo "\n=== COMPANIES WITH JOBS ===\n";
$companiesWithJobs = Job::select('company_id')->distinct()->get();
foreach($companiesWithJobs as $item) {
    $company = Company::find($item->company_id);
    $jobCount = Job::where('company_id', $item->company_id)->count();
    echo "Company ID: {$item->company_id}, Name: {$company->name}, Jobs: {$jobCount}\n";
}

echo "\n=== USERS FOR COMPANIES WITH JOBS ===\n";
use App\Models\User;
foreach($companiesWithJobs as $item) {
    $company = Company::find($item->company_id);
    $user = User::where('role_id', 2)->whereHas('company', function($q) use ($item) {
        $q->where('id', $item->company_id);
    })->first();
    
    if($user) {
        echo "Company ID: {$item->company_id} ({$company->name}) - User: {$user->email}\n";
    } else {
        echo "Company ID: {$item->company_id} ({$company->name}) - No user found\n";
    }
}