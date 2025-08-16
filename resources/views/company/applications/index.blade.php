@extends('company.layout')

@section('title', 'Applications')

@section('content')
<div class="card">
    <div class="card-header">Job Applications</div>
    <div class="card-body">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Job</th>
                    <th>Status</th>
                    <th>Applied At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->jobSeeker->name }}</td>
                        <td>{{ $application->job->title }}</td>
                        <td>
                            <span class="badge 
                                @if($application->status === 'pending') bg-warning 
                                @elseif($application->status === 'accepted') bg-success 
                                @else bg-danger @endif">
                                {{ ucfirst($application->status) }}
                            </span>
                        </td>
                        <td>{{ $application->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('company.applications.show', ['id' => $application->id]) }}" 
                               class="btn btn-sm btn-info">
                                View
                            </a>

                            <form action="{{ route('company.applications.update-status', ['id' => $application->id]) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                        class="form-select form-select-sm d-inline w-auto">
                                    <option value="pending"  {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No applications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
