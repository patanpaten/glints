@extends('layouts.jobseeker')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">Profil Saya</h2>
                <a href="{{ route('jobseeker.profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>
            <hr>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <!-- Profile Information -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    @if($jobSeeker->profile_picture)
                        <img src="{{ asset('storage/' . $jobSeeker->profile_picture) }}" alt="Profile Picture" class="rounded-circle mb-4" width="150" height="150">
                    @else
                        <img src="{{ asset('images/placeholder-user.svg') }}" alt="Profile Picture" class="rounded-circle mb-4" width="150" height="150">
                    @endif
                    <h3 class="fw-bold">{{ $jobSeeker->first_name }} {{ $jobSeeker->last_name }}</h3>
                    <p class="text-muted">{{ $jobSeeker->current_position ?? 'Belum ada posisi' }}</p>
                    <div class="d-flex justify-content-center">
                        <span class="badge bg-primary me-2">{{ $jobSeeker->city }}, {{ $jobSeeker->province }}</span>
                        <span class="badge bg-secondary">{{ $jobSeeker->postal_code }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact & Summary -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Informasi Kontak</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Telepon:</div>
                        <div class="col-md-8">{{ $jobSeeker->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Alamat:</div>
                        <div class="col-md-8">{{ $jobSeeker->address }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal Lahir:</div>
                        <div class="col-md-8">{{ $jobSeeker->birth_date->format('d F Y') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 fw-bold">Gaji yang Diharapkan:</div>
                        <div class="col-md-8">Rp {{ number_format($jobSeeker->expected_salary, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Ringkasan Profil</h5>
                </div>
                <div class="card-body">
                    <p>{{ $jobSeeker->summary }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Keahlian</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus"></i> Tambah Keahlian
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($skills as $skill)
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary p-2 me-2">{{ $skill->name }}</span>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Belum ada keahlian yang ditambahkan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Education -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Pendidikan</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus"></i> Tambah Pendidikan
                    </a>
                </div>
                <div class="card-body">
                    @forelse($educations as $education)
                        <div class="mb-4 pb-4 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-bold">{{ $education->institution }}</h5>
                                    <p class="mb-1">{{ $education->degree }} - {{ $education->field_of_study }}</p>
                                    <p class="text-muted">{{ $education->start_date->format('M Y') }} - 
                                        @if($education->is_current)
                                            Sekarang
                                        @else
                                            {{ $education->end_date->format('M Y') }}
                                        @endif
                                    </p>
                                    @if($education->description)
                                        <p>{{ $education->description }}</p>
                                    @endif
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada pendidikan yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Experience -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Pengalaman Kerja</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus"></i> Tambah Pengalaman
                    </a>
                </div>
                <div class="card-body">
                    @forelse($experiences as $experience)
                        <div class="mb-4 pb-4 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-bold">{{ $experience->title }}</h5>
                                    <p class="mb-1">{{ $experience->company }} - {{ $experience->location }}</p>
                                    <p class="text-muted">{{ $experience->start_date->format('M Y') }} - 
                                        @if($experience->is_current)
                                            Sekarang
                                        @else
                                            {{ $experience->end_date->format('M Y') }}
                                        @endif
                                    </p>
                                    @if($experience->description)
                                        <p>{{ $experience->description }}</p>
                                    @endif
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada pengalaman kerja yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection