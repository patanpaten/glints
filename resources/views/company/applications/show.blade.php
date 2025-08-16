@extends('company.layout')

@section('title', 'Application Detail')

@section('content')
<div class="card">
    <div class="card-header">Application Detail</div>
    <div class="card-body">
        <h5>Applicant: {{ $application->jobSeeker->name }}</h5>
        <p>Email: {{ $application->jobSeeker->email }}</p>
        <p>Job: {{ $application->job->title }}</p>
        <p>Status: 
            <span class="badge 
                @if($application->status === 'pending') bg-warning 
                @elseif($application->status === 'accepted') bg-success 
                @else bg-danger @endif">
                {{ ucfirst($application->status) }}
            </span>
        </p>
        <hr>
        <h6>Cover Letter:</h6>
        <p>{{ $application->cover_letter }}</p>
        <hr>
        <a href="{{ route('company.applications.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
