@extends('company.app')

@section('title', 'Company Dashboard')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER PERUSAHAAN -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="position-relative">
                    @if(Auth::guard('company')->user()->logo)
                        <img src="{{ asset('storage/' . Auth::guard('company')->user()->logo) }}" 
                             alt="{{ Auth::guard('company')->user()->name }}" 
                             class="rounded" 
                             style="width: 60px; height: 60px; object-fit: cover;">
                    @else
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center text-white fw-bold" style="width: 60px; height: 60px; font-size: 24px;">
                            {{ Auth::guard('company')->user()->initials }}
                        </div>
                    @endif
                </div>
                <div>
                    <h2 class="fw-bold fs-5 mb-0">{{ Auth::guard('company')->user()->name }}</h2>
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <span class="badge bg-success-subtle text-success"><i class="fas fa-check-circle"></i> Terverifikasi</span>
                        @if(Auth::guard('company')->user()->isVip())
                            <span class="badge bg-warning-subtle text-warning"><i class="fas fa-crown"></i> VIP</span>
                        @endif
                        <span class="text-muted small">{{ Auth::guard('company')->user()->country }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('company.profile.edit2') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-edit"></i> Edit Profil Perusahaan
                </a>
                <a href="{{ route('company.premium-features.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-crown"></i> Lihat Paket Berlangganan Saya
                </a>
            </div>
        </div>
    </div>

    <!-- BODY -->
    <div class="row">
        
        <!-- LOWONGAN (kiri) -->
        <div class="col-md-8">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">Daftar Lowongan Kerja</div>
                <div class="card-body">
                    <!-- FILTER -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="position-relative w-50">
                            <input type="text" placeholder="Cari nama loker atau kata kunci"
                                class="form-control ps-4">
                            <i class="fas fa-search position-absolute" style="top: 12px; left: 12px;"></i>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted">Urutkan:</span>
                            <select class="form-select">
                                <option>Tanggal Diupdate</option>
                                <option>Nama Pekerjaan</option>
                            </select>
                        </div>
                    </div>

                    <!-- TAB -->
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a href="#" class="nav-link active fw-medium">Semua Loker <span class="badge rounded-pill bg-secondary ms-1">{{ $totalJobs }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-medium">Aktif <span class="badge rounded-pill bg-secondary ms-1">{{ $activeJobs }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-medium">Nonaktif <span class="badge rounded-pill bg-secondary ms-1">{{ $totalJobs - $activeJobs }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-medium">Dalam Review <span class="badge rounded-pill bg-secondary ms-1">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-medium">Draft <span class="badge rounded-pill bg-secondary ms-1">0</span></a>
                        </li>
                    </ul>

                    <!-- DAFTAR LOWONGAN DINAMIS -->

                    {{-- DEBUG LOG --}}
@php
    \Log::info('[Dashboard] recentJobs count: ' . ($recentJobs ? $recentJobs->count() : 0));
    if($recentJobs) {
        foreach($recentJobs as $job) {
            \Log::info('[Dashboard] Job: ' . $job->title . ' | Applications: ' . $job->applications->count());
        }
    }
@endphp


                    @if($recentJobs && $recentJobs->count() > 0)
                        @foreach($recentJobs as $job)
                        <div class="card mb-3 border shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="fw-bold">{{ $job->title }}</h5>
                                        <div class="d-flex align-items-center gap-2 text-muted small">
                                            <span><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $job->employment_type }}</span>
                                            @if($job->deadline)
                                                <span class="mx-1">•</span>
                                                <span>Aktif hingga: {{ $job->deadline->format('d M Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="badge {{ $job->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $job->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>

                                <div class="row mt-3 text-center">
                                    <div class="col-md-4">
                                        <p class="fw-bold mb-0">{{ $job->applications->where('status', 'interview')->count() }}</p>
                                        <p class="text-muted small mb-1">Interview</p>
                                        <a href="{{ route('company.applications.index', ['job' => $job->id, 'status' => 'interview']) }}" class="text-primary small fw-semibold">Lihat</a>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="fw-bold mb-0">{{ $job->applications->count() }}</p>
                                        <p class="text-muted small mb-1">Total Pelamar</p>
                                        <a href="{{ route('company.applications.index', ['job' => $job->id]) }}" class="text-primary small fw-semibold">Lihat</a>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="fw-bold mb-0">{{ $job->applications->where('status', 'rejected')->count() }}</p>
                                        <p class="text-muted small mb-1">Ditolak</p>
                                        <a href="{{ route('company.applications.index', ['job' => $job->id, 'status' => 'rejected']) }}" class="text-primary small fw-semibold">Lihat</a>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-3">
                                    <button class="btn btn-outline-warning btn-sm"><i class="fas fa-bolt"></i> Boost Lowongan</button>
                                    <a href="{{ route('company.applications.index', ['job' => $job->id]) }}" class="btn btn-primary btn-sm">Kelola Kandidat</a>
                                    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-users"></i> Recommended Talents</button>
                                    <div class="dropdown ms-auto">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('company.jobs.edit', $job->id) }}"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="deleteJob({{ $job->id }})"><i class="fas fa-trash me-2"></i> Hapus</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-briefcase text-muted" style="font-size: 48px;"></i>
                            <h5 class="text-muted mt-3">Belum Ada Lowongan</h5>
                            <p class="text-muted">Mulai posting lowongan pertama Anda untuk menarik kandidat terbaik.</p>
                            <a href="{{ route('company.jobs.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Buat Lowongan Baru
                            </a>
                        </div>
                    @endif

                    <!-- PAGINATION -->
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">«</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIDEBAR (kanan) -->
        <div class="col-md-4">
            <!-- NOTIFIKASI -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <span>Notifikasi (2)</span>
                </div>
                <div class="card-body p-0">
                    <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-warning-subtle p-2 rounded">
                                <img src="/glints-logo.png" alt="Glints VIP" class="img-fluid" style="width: 30px;" onerror="this.src='/company.png'">
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Tentang Glints VIP</h6>
                            </div>
                        </div>
                        <p class="text-muted small mb-2">Cek informasi seputar Glints VIP seperti durasi, fitur, dan lain-lain di halaman fitur.</p>
                        <a href="#" class="text-primary small fw-semibold">Cek Detail Fitur Glints VIP</a>
                    </div>
                    
                    <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-success-subtle p-2 rounded">
                                <i class="fab fa-whatsapp text-success fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Terima Notifikasi di WhatsApp</h6>
                            </div>
                        </div>
                        @if(Auth::guard('company')->user()->phone)
                            <p class="text-muted small mb-2">WhatsApp sudah terhubung: {{ Auth::guard('company')->user()->phone }}</p>
                            <span class="badge bg-success-subtle text-success"><i class="fas fa-check-circle"></i> Terhubung</span>
                        @else
                            <p class="text-muted small mb-2">Selalu update tentang perusahaan Anda dengan fitur notifikasi melalui WhatsApp.</p>
                            <a href="{{ route('company.whatsapp.form') }}" class="text-primary small fw-semibold">Hubungkan WhatsApp</a>
                        @endif
                    </div>
                    
                    <div class="p-3">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-primary-subtle p-2 rounded">
                                <i class="fas fa-mobile-alt text-primary fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Lebih Mudah di Aplikasi</h6>
                            </div>
                        </div>
                        <p class="text-muted small mb-2">Tingkatkan pengalaman rekrutmen dengan aplikasi mobile kami.</p>
                        <div class="text-center mt-3">
                            <img src="/qr-code.png" alt="QR Code" class="img-fluid" style="width: 150px;" onerror="this.src='{{ asset('images/placeholder-qr.svg') }}'">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- PREMIUM -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">Fitur Premium</div>
                <div class="card-body">
                    <p class="text-muted mb-4">Tingkatkan peluang mendapatkan kandidat terbaik dengan fitur premium.</p>
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="fw-bold">CV Search</h5>
                            <p class="text-muted small mb-2">Temukan kandidat potensial dari database CV kami.</p>
                            <button class="btn btn-primary btn-sm w-100">Coba Sekarang</button>
                        </div>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Job Boost</h5>
                            <p class="text-muted small mb-2">Tampilkan lowongan Anda di bagian teratas hasil pencarian.</p>
                            <button class="btn btn-primary btn-sm w-100">Coba Sekarang</button>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="fw-bold">Talent Analytics</h5>
                            <p class="text-muted small mb-2">Dapatkan insight mendalam tentang performa rekrutmen Anda.</p>
                            <button class="btn btn-primary btn-sm w-100">Coba Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- STATISTIK -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">Statistik Rekrutmen</div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Total Pelamar</span>
                            <span class="fw-bold">{{ number_format($totalApplications) }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $totalApplications > 0 ? min(($totalApplications / 100) * 10, 100) : 0 }}%" aria-valuenow="{{ $totalApplications }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Total Lowongan</span>
                            <span class="fw-bold">{{ $totalJobs }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalJobs > 0 ? min(($totalJobs / 20) * 100, 100) : 0 }}%" aria-valuenow="{{ $totalJobs }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Lowongan Aktif</span>
                            <span class="fw-bold">{{ $activeJobs }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $totalJobs > 0 ? ($activeJobs / $totalJobs) * 100 : 0 }}%" aria-valuenow="{{ $activeJobs }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <a href="{{ route('company.analytics.dashboard') }}" class="btn btn-link d-block text-center mt-3">Lihat Laporan Lengkap</a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
