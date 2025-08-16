@extends('company.layout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Jobs</h5>
                <h2>{{ \App\Models\Job::where('company_id', auth()->user()->company->id)->count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Applications</h5>
                <h2>{{ \App\Models\Application::whereHas('job', fn($q) => $q->where('company_id', auth()->user()->company->id))->count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5>Active Jobs</h5>
                <h2>{{ \App\Models\Job::where('company_id', auth()->user()->company->id)->where('is_active', true)->count() }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
