<!DOCTYPE html>
<html>
<head>
    <title>Company Dashboard</title>
</head>
<body>
    <h1>Welcome, {{ $company->name }}</h1>

    <h2>Statistics</h2>
    <ul>
        <li>Total Jobs: {{ $totalJobs }}</li>
        <li>Active Jobs: {{ $activeJobs }}</li>
        <li>Total Applications: {{ $totalApplications }}</li>
    </ul>

    <h2>Recent Jobs</h2>
    <ul>
        @forelse($recentJobs as $job)
            <li>{{ $job->title }} - {{ $job->is_active ? 'Active' : 'Inactive' }}</li>
        @empty
            <li>No jobs posted yet.</li>
        @endforelse
    </ul>
</body>
</html>
