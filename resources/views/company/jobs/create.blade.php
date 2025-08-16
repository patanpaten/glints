@extends('company.layout')

@section('title', 'Create Job')

@section('content')
<div class="card">
    <div class="card-header">Create New Job</div>
    <div class="card-body">
        <form action="{{ route('company.jobs.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter job title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control" placeholder="Job description" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Requirements</label>
                <textarea name="requirements" rows="4" class="form-control" placeholder="Job requirements"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" placeholder="Job location">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button class="btn btn-success" type="submit">Create</button>
            <a href="{{ route('company.jobs.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
