@extends('company.layout')

@section('title', 'Manage Jobs')

@section('content')
@php
    // default fallback kalau controller tidak mengirim
    $status = $status ?? request('status', 'all');
    $stats = $stats ?? [
        'all' => 0,
        'active' => 0,
        'inactive' => 0,
        'review' => 0,
        'draft' => 0,
    ];
@endphp

<div class="container py-4">
    <h2 class="mb-4 fw-bold">Manage Jobs</h2>

    <!-- TAB FILTER STATUS -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ $status === 'all' ? 'active' : '' }}"
               href="{{ route('company.jobs.index', ['status' => 'all']) }}">
               Semua ({{ $stats['all'] ?? 0 }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status === 'active' ? 'active' : '' }}"
               href="{{ route('company.jobs.index', ['status' => 'active']) }}">
               Aktif ({{ $stats['active'] ?? 0 }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status === 'inactive' ? 'active' : '' }}"
               href="{{ route('company.jobs.index', ['status' => 'inactive']) }}">
               Nonaktif ({{ $stats['inactive'] ?? 0 }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status === 'review' ? 'active' : '' }}"
               href="{{ route('company.jobs.index', ['status' => 'review']) }}">
               Dalam Review ({{ $stats['review'] ?? 0 }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status === 'draft' ? 'active' : '' }}"
               href="{{ route('company.jobs.index', ['status' => 'draft']) }}">
               Draft ({{ $stats['draft'] ?? 0 }})
            </a>
        </li>
    </ul>

    <!-- TOMBOL CREATE -->
    <div class="mb-4 text-end">
        <a href="{{ route('company.jobs.create') }}" class="btn btn-primary">
            + Buat Lowongan
        </a>
    </div>

    <!-- LIST LOWONGAN -->
    @forelse($jobs as $job)
        @php
            // badge kelas untuk status (aman jika status null)
            $statusText = $job->status ?? 'n/a';
            switch($statusText) {
                case 'active': $badgeClass = 'bg-success'; break;
                case 'inactive': $badgeClass = 'bg-secondary'; break;
                case 'review': $badgeClass = 'bg-warning text-dark'; break;
                case 'draft': $badgeClass = 'bg-dark'; break;
                default: $badgeClass = 'bg-light text-dark'; break;
            }
        @endphp

        <div class="card border shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-start">
                <!-- Info Lowongan -->
                <div>
                    <h5 class="fw-bold mb-1">{{ $job->title }}</h5>
                    <p class="small text-muted mb-1">📍 {{ $job->type ?? '-' }} - {{ $job->location ?? '-' }}</p>
                    <p class="small text-muted mb-0">
                        Aktif hingga: {{ optional($job->expired_at)->format('d M Y') ?? '-' }}
                    </p>
                </div>

                <!-- Status -->
                <span class="badge {{ $badgeClass }}">
                    {{ ucfirst($statusText) }}
                </span>
            </div>

            <!-- Footer Aksi -->
            <div class="card-footer bg-light d-flex justify-content-end gap-2">
                {{-- Link ke daftar pelamar untuk job ini (route membutuhkan parameter 'job') --}}
                <a href="{{ route('company.applications.index', ['job' => $job->id]) }}" class="btn btn-sm btn-info">
                    👥 Pelamar
                </a>

                <a href="{{ route('company.jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">
                    ✏️ Edit
                </a>

                <form action="{{ route('company.jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin ingin menghapus job ini?')">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5">
            <p class="mb-0">Belum ada lowongan tersedia</p>
        </div>
    @endforelse

    {{-- Pagination (jika $jobs adalah paginator) --}}
    @if(method_exists($jobs, 'links'))
        <div class="mt-3">
            {{ $jobs->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
