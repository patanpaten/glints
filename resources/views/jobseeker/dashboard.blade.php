<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Dashboard - Glints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse" style="min-height: 100vh;">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Job Seeker Dashboard</h4>
                        <p class="text-white-50">{{ Auth::user()->name }}</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('jobseeker.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('jobseeker.profile.edit') }}">
                                <i class="bi bi-person-circle me-2"></i>
                                My Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('jobseeker.education.edit') }}">
                                <i class="bi bi-mortarboard me-2"></i>
                                Education
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('jobseeker.experience.edit') }}">
                                <i class="bi bi-briefcase me-2"></i>
                                Experience
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('jobseeker.skills.edit') }}">
                                <i class="bi bi-tools me-2"></i>
                                Skills
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('jobseeker.applications.index') }}">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                My Applications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('jobseeker.saved-jobs.index') }}">
                                <i class="bi bi-bookmark-heart me-2"></i>
                                Saved Jobs
                            </a>
                        </li>
                        <li class="nav-item mt-5">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link text-white border-0 bg-transparent">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                @if(!Auth::user()->jobSeeker || !Auth::user()->jobSeeker->is_profile_complete)
                    <div class="alert alert-warning">
                        <strong>Welcome!</strong> Please complete your profile to start applying for jobs.
                        <a href="{{ route('jobseeker.profile.edit') }}" class="btn btn-sm btn-warning ms-3">Complete Profile</a>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Applications</h5>
                                <h2 class="card-text">{{ $totalApplications }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <h5 class="card-title">Pending</h5>
                                <h2 class="card-text">{{ $pendingApplications }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">Shortlisted</h5>
                                <h2 class="card-text">{{ $shortlistedApplications }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Saved Jobs</h5>
                                <h2 class="card-text">{{ $savedJobs }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Applications</h5>
                            </div>
                            <div class="card-body">
                                @if(count($recentApplications) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Job Title</th>
                                                    <th>Company</th>
                                                    <th>Status</th>
                                                    <th>Applied</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentApplications as $application)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('jobseeker.applications.show', $application->id) }}">
                                                                {{ $application->job->title }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $application->job->company->name }}</td>
                                                        <td>
                                                            @if($application->status == 'pending')
                                                                <span class="badge bg-warning text-dark">Pending</span>
                                                            @elseif($application->status == 'reviewed')
                                                                <span class="badge bg-info">Reviewed</span>
                                                            @elseif($application->status == 'shortlisted')
                                                                <span class="badge bg-primary">Shortlisted</span>
                                                            @elseif($application->status == 'rejected')
                                                                <span class="badge bg-danger">Rejected</span>
                                                            @elseif($application->status == 'hired')
                                                                <span class="badge bg-success">Hired</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $application->created_at->diffForHumans() }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-center py-3">You haven't applied to any jobs yet.</p>
                                    <div class="text-center">
                                        <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse Jobs</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recommended Jobs</h5>
                            </div>
                            <div class="card-body">
                                @if(count($recommendedJobs) > 0)
                                    <div class="list-group">
                                        @foreach($recommendedJobs as $job)
                                            <a href="{{ route('jobs.show', $job->id) }}" target="_blank" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{ $job->title }}</h5>
                                                    <small>{{ $job->created_at->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-1">{{ $job->company->name }} - {{ $job->location }}</p>
                                                <small>{{ Str::limit($job->description, 100) }}</small>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-center py-3">No recommended jobs available.</p>
                                    <div class="text-center">
                                        <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse All Jobs</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Profile Completion</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $profileCompletion = 0;
                                    $steps = [];
                                    
                                    if (Auth::user()->jobSeeker) {
                                        $profileCompletion += 20;
                                    } else {
                                        $steps[] = ['route' => 'jobseeker.profile.create', 'text' => 'Complete Basic Profile'];
                                    }
                                    
                                    if (Auth::user()->jobSeeker && Auth::user()->jobSeeker->educations->count() > 0) {
                                        $profileCompletion += 20;
                                    } else {
                                        $steps[] = ['route' => 'jobseeker.education.create', 'text' => 'Add Education'];
                                    }
                                    
                                    if (Auth::user()->jobSeeker && Auth::user()->jobSeeker->experiences->count() > 0) {
                                        $profileCompletion += 20;
                                    } else {
                                        $steps[] = ['route' => 'jobseeker.experience.create', 'text' => 'Add Experience'];
                                    }
                                    
                                    if (Auth::user()->jobSeeker && Auth::user()->jobSeeker->skills->count() > 0) {
                                        $profileCompletion += 20;
                                    } else {
                                        $steps[] = ['route' => 'jobseeker.skills.edit', 'text' => 'Add Skills'];
                                    }
                                    
                                    if (Auth::user()->jobSeeker && Auth::user()->jobSeeker->resume) {
                                        $profileCompletion += 20;
                                    } else {
                                        $steps[] = ['route' => 'jobseeker.profile.edit', 'text' => 'Upload Resume'];
                                    }
                                @endphp

                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $profileCompletion }}%" aria-valuenow="{{ $profileCompletion }}" aria-valuemin="0" aria-valuemax="100">{{ $profileCompletion }}%</div>
                                </div>

                                @if(count($steps) > 0)
                                    <p>Complete these steps to improve your profile:</p>
                                    <ul>
                                        @foreach($steps as $step)
                                            <li>
                                                <a href="{{ route($step['route']) }}">{{ $step['text'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-success">Your profile is complete! You can now apply for jobs.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>