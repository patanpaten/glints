@extends('company.layout')

@section('title', 'Manage Jobs')

@section('content')
<h2 class="mb-4">Manage Jobs</h2>

<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link {{ $filter == 'all' ? 'active' : '' }}" href="{{ route('company.jobs.index', ['status' => 'all']) }}">Semua</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $filter == 'active' ? 'active' : '' }}" href="{{ route('company.jobs.index', ['status' => 'active']) }}">Aktif</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $filter == 'inactive' ? 'active' : '' }}" href="{{ route('company.jobs.index', ['status' => 'inactive']) }}">Nonaktif</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $filter == 'review' ? 'active' : '' }}" href="{{ route('company.jobs.index', ['status' => 'review']) }}">Dalam Review</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $filter == 'draft' ? 'active' : '' }}" href="{{ route('company.jobs.index', ['status' => 'draft']) }}">Draft</a>
    </li>
</ul>

<div class="mb-3">
    <a href="{{ route('company.jobs.create') }}" class="btn btn-primary">+ Create Job</a>
</div>

<div class="card">
    <div class="card-header">Job List</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($job->status) }}</span></td>
                        <td>{{ $job->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('company.jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('company.jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus job ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
