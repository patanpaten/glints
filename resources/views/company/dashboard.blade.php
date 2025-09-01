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
                <a href="{{ route('company.profile.edit2') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <svg viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="currentColor">
                    <path d="M10.345 4.667H17.5a.833.833 0 0 1 .833.833v11.667A.833.833 0 0 1 17.5 18h-15a.833.833 0 0 1-.833-.833V3.833A.833.833 0 0 1 2.5 3h6.178l1.667 1.667ZM10 11.333a2.083 2.083 0 1 0 0-4.166 2.083 2.083 0 0 0 0 4.166ZM6.667 15.5h6.666a3.333 3.333 0 1 0-6.666 0Z"></path>
                </svg>
                Edit Profil Perusahaan
                </a>

                <a href="{{ route('company.premium-features.index') }}" class="btn btn-outline-secondary">
                <svg viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="currentColor">
                    <path d="M15.833 18.833H4.167a2.5 2.5 0 0 1-2.5-2.5V3a.833.833 0 0 1 .833-.833h11.667A.833.833 0 0 1 15 3v10h3.333v3.333a2.5 2.5 0 0 1-2.5 2.5ZM15 14.667v1.666a.834.834 0 0 0 1.667 0v-1.666H15ZM5 6.333V8h6.667V6.333H5Zm0 3.334v1.666h6.667V9.667H5ZM5 13v1.667h4.167V13H5Z"></path>
                </svg>
                Lihat Paket Berlangganan Saya
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
                                        <p class="fw-bold mb-0">{{ $job->interview_count ?? 0 }}</p>
                                        <p class="text-muted small mb-1">Interview</p>
                                        <a href="{{ route('company.applications.index', ['job' => $job->id, 'status' => 'interview']) }}" class="text-primary small fw-semibold">Lihat</a>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="fw-bold mb-0">{{ $job->applications_count ?? 0 }}</p>
                                        <p class="text-muted small mb-1">Total Pelamar</p>
                                        <a href="{{ route('company.applications.index', ['job' => $job->id]) }}" class="text-primary small fw-semibold">Lihat</a>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="fw-bold mb-0">{{ $job->rejected_count ?? 0 }}</p>
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
                    <span>Notifikasi (1)</span>
                </div>
                <div class="card-body p-0">
                    <!-- Notifikasi 1: Verifikasi -->
                    <div class="p-3">
                        <div class="d-flex align-items-start gap-3 mb-2">
                            <div class="bg-light p-2 rounded">
                                <i class="fas fa-shield-alt text-secondary" style="font-size:20px;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Verifikasi Diperlukan</h6>
                                <p class="text-muted small mb-2">Verifikasi perusahaan Anda untuk posting lowongan pekerjaan dan dapatkan akses ke banyak fitur.</p>
                                <button class="btn btn-outline-primary btn-sm">Verifikasi Perusahaan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VIP CARD -->
            <div class="card border-0 shadow-sm mb-3 text-white"
                style="background: linear-gradient(to bottom, #4b4b4b, #fbbf24); border-radius: 8px;">
            <div class="card-body d-flex align-items-center p-3">
                <!-- Logo -->
                <img src="{{ asset('images/glints-vip-icon.svg') }}" 
                    alt="Glints VIP Icon" style="width:150px; height:150px;" class="me-4  " />
                <!-- Konten -->
                <div>
                <h6 class="fw-bold mb-2">Fitur baru: Glints VIP!</h6>
                <p class="small mb-3 mb-2">Dapatkan fitur eksklusif untuk proses rekrutmen yang lebih cepat!</p>
                <button class="btn btn-outline-light btn-sm fw-semibold px-3">
                    Upgrade ke VIP
                </button>
                </div>
            </div>
            </div>

            <!-- APP QR CODE CARD -->
            <div class="card border-0 shadow-sm mb-3 text-white"
                style="background: linear-gradient(135deg, #1eb2ff, #007bff); border-radius: 8px;">
            <div class="card-body p-3">

                <div class="d-flex align-items-center gap-3">
                
                <!-- Bagian QR + label -->
                <div class="text-center">
                    <!-- Label bubble -->
                    <div class="d-inline-block position-relative bg-white text-primary fw-bold px-2 py-1 rounded mb-2"
                        style="font-size: 0.7rem;">
                    SCAN UNTUK DOWNLOAD
                    <!-- segitiga bawah -->
                    <div style="
                        position: absolute; 
                        bottom: -6px; left: 50%; 
                        transform: translateX(-50%);
                        width: 0; height: 0; 
                        border-left: 6px solid transparent; 
                        border-right: 6px solid transparent; 
                        border-top: 6px solid white;">
                    </div>
                    </div>

                    <!-- QR Code box -->
                    <div class="bg-white rounded p-2 d-inline-block">
                    <img src="{{ asset('images/glints-web2-app-qr.png') }}" 
                        alt="Employers App QR" width="120" height="120" class="p-2" />
                    </div>
                </div>

                <!-- Bagian Teks -->
                <div>
                    <h6 class="fw-bold mb-1">Lebih Mudah di Aplikasi</h6>
                    <p class="small mb-3">Tingkatin pengalaman rekrutmenmu dengan Aplikasi Glints!</p>
                    <a href="https://help.glints.com/hc/id-id/sections/29365279475993-Glints-App-for-Employers-FAQs" 
                    target="_blank" class="btn btn-outline-light btn-sm fw-semibold px-3">
                    Cara Menggunakan
                    </a>
                </div>
                </div>
            </div>
            </div>





        </div>
    </div>
</div>
@endsection
