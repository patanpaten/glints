@extends('company.layout')

@section('title', 'All Applications')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">All Applications</h2>

    <div class="card mb-4">
        <div class="card-header bg-light">Filter Applications</div>
        <div class="card-body">
            <form method="GET" action="{{ route('company.applications.all') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Status:</label>
                    <select name="status" class="form-select">
                        <option value="">--All--</option>
                        <option value="pending" {{ $status=='pending'?'selected':'' }}>Pending</option>
                        <option value="reviewed" {{ $status=='reviewed'?'selected':'' }}>Reviewed</option>
                        <option value="shortlisted" {{ $status=='shortlisted'?'selected':'' }}>Shortlisted</option>
                        <option value="rejected" {{ $status=='rejected'?'selected':'' }}>Rejected</option>
                        <option value="hired" {{ $status=='hired'?'selected':'' }}>Hired</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Job:</label>
                    <select name="job_id" class="form-select">
                        <option value="">--All--</option>
                        @foreach($jobs as $job)
                            <option value="{{ $job->id }}" {{ $jobId==$job->id?'selected':'' }}>{{ $job->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">Applications List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Applicant</th>
                            <th>Job</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $app)
                        <tr>
                            <td>{{ $app->jobSeeker->name }}</td>
                            <td>{{ $app->job->title }}</td>
                            <td>
                                <span class="badge 
                                    @if($app->status === 'pending') bg-warning text-dark
                                    @elseif($app->status === 'reviewed') bg-info text-dark
                                    @elseif($app->status === 'shortlisted') bg-primary
                                    @elseif($app->status === 'hired') bg-success
                                    @else bg-danger @endif">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('company.applications.show', $app->id) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                        @endforeach
                        
                        @if(count($applications) === 0)
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No applications found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $applications->withQueryString()->links() }}
    </div>
</div>
@endsection
