@extends('company.layout')

@section('title', 'Edit Profile')

@section('content')
<div class="card">
    <div class="card-header">Edit Company Profile</div>
    <div class="card-body">
        <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $company->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Website</label>
                <input type="url" name="website" class="form-control" value="{{ old('website', $company->website) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Logo</label>
                <input type="file" name="logo" class="form-control">
                @if($company->logo)
                    <img src="{{ asset('storage/'.$company->logo) }}" alt="Logo" class="mt-2" height="80">
                @endif
            </div>
            <button class="btn btn-primary" type="submit">Save Changes</button>
            <a href="{{ route('company.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
