@extends('company.layout')

@section('title', 'Edit Job')

@section('content')
<div class="card">
    <div class="card-header">Edit Job</div>
    <div class="card-body">
        <form action="{{ route('company.jobs.update', $job->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control" value="{{ $job->title }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control" required>{{ $job->description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Requirements</label>
                <textarea name="requirements" rows="4" class="form-control">{{ $job->requirements }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ $job->location }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ $job->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$job->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
            <a href="{{ route('company.jobs.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
