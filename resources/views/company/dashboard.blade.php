<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard - Glints</title>
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
                        <h4 class="text-white">Company Dashboard</h4>
                        <p class="text-white-50">{{ Auth::user()->company->name ?? 'Complete Your Profile' }}</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('company.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('company.profile.edit') }}">
                                <i class="bi bi-person-circle me-2"></i>
                                Company Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('company.jobs.index') }}">
                                <i class="bi bi-briefcase me-2"></i>
                                Manage Jobs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('company.applications.all') }}">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                All Applications
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

                @if(!Auth::user()->company || !Auth::user()->company->is_profile_complete)
                    <div class="alert alert-warning">
                        <strong>Welcome!</strong> Please complete your company profile to start posting jobs.
                        <a href="{{ route('company.profile.edit') }}" class="btn btn-sm btn-warning ms-3">Complete Profile</a>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Jobs</h5>
                                <h2 class="card-text">{{ Auth::user()->company ? Auth::user()->company->jobs->count() : 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Active Jobs</h5>
                                <h2 class="card-text">{{ Auth::user()->company ? Auth::user()->company->jobs->where('is_active', true)->count() : 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Applications</h5>
                                <h2 class="card-text">{{ Auth::user()->company ? \App\Models\Application::whereIn('job_id', Auth::user()->company->jobs->pluck('id'))->count() : 0 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Jobs</h5>
                            </div>
                            <div class="card-body">
                                @if(Auth::user()->company && Auth::user()->company->jobs->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th>Applications</th>
                                                    <th>Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(Auth::user()->company->jobs->sortByDesc('created_at')->take(5) as $job)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('company.jobs.show', $job->id) }}">
                                                                {{ $job->title }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if($job->is_active)
                                                                <span class="badge bg-success">Active</span>
                                                            @else
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $job->applications->count() }}</td>
                                                        <td>{{ $job->created_at->diffForHumans() }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-center py-3">No jobs posted yet.</p>
                                    <div class="text-center">
                                        <a href="{{ route('company.jobs.create') }}" class="btn btn-primary">Post a Job</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Applications</h5>
                            </div>
                            <div class="card-body">
                                @if(Auth::user()->company && \App\Models\Application::whereIn('job_id', Auth::user()->company->jobs->pluck('id'))->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Job</th>
                                                    <th>Applicant</th>
                                                    <th>Status</th>
                                                    <th>Applied</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(\App\Models\Application::whereIn('job_id', Auth::user()->company->jobs->pluck('id'))->with(['job', 'jobSeeker.user'])->latest()->take(5)->get() as $application)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('company.jobs.applications.index', $application->job_id) }}">
                                                                {{ $application->job->title }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $application->jobSeeker->user->name }}</td>
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
                                    <p class="text-center py-3">No applications received yet.</p>
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