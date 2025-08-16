@extends('company.layout')

@section('title', 'Create Company Profile')

@section('content')
<div class="card">
    <div class="card-header">Create Company Profile</div>
    <div class="card-body">
        <form action="{{ route('company.profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter company name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Logo</label>
                <input type="file" name="logo" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control" placeholder="Describe your company"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address">
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('company.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
