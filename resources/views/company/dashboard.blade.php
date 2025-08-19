@extends('company.app')

@section('title', 'Company Dashboard')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER PERUSAHAAN -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-light rounded p-2" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <img src="/images/areakerja.jpeg" class="img-fluid" alt="Area Kerja Logo">
                </div>
                <div>
                    <h2 class="fw-bold fs-5 mb-0">{{ auth()->user()->company->name ?? 'Areakerja' }}</h2>
                    <div class="d-flex align-items-center gap-1 mt-1">
                        <span class="badge bg-success-subtle text-success"><i class="fas fa-check-circle"></i> Terverifikasi</span>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('company.profile') }}" class="btn btn-outline-secondary">
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
                            <a href="#" class="nav-link active fw-medium">Semua Loker <span class="badge rounded-pill bg-secondary ms-1">30</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-medium">Aktif <span class="badge rounded-pill bg-secondary ms-1">5</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-medium">Nonaktif <span class="badge rounded-pill bg-secondary ms-1">25</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-medium">Dalam Review <span class="badge rounded-pill bg-secondary ms-1">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-medium">Draft <span class="badge rounded-pill bg-secondary ms-1">35</span></a>
                        </li>
                    </ul>

                    <!-- CARD LOWONGAN -->
                    <div class="card mb-3 border shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="fw-bold">Admin Perkantoran (Intern)</h5>
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <span><i class="fas fa-map-marker-alt"></i> Kementren Kotagede, Yogyakarta, DI Yogyakarta</span>
                                        <span class="mx-1">•</span>
                                        <span>Aktif hingga: 28 Agu 2025</span>
                                    </div>
                                </div>
                                <span class="badge bg-success">Aktif</span>
                            </div>

                            <div class="row mt-3 text-center">
                                <div class="col-md-4">
                                    <p class="fw-bold mb-0">149</p>
                                    <p class="text-muted small mb-1">Chat Dimulai</p>
                                    <a href="#" class="text-primary small fw-semibold">Lihat</a>
                                </div>
                                <div class="col-md-4">
                                    <p class="fw-bold mb-0">806</p>
                                    <p class="text-muted small mb-1">Terhubung</p>
                                    <a href="#" class="text-primary small fw-semibold">Lihat</a>
                                </div>
                                <div class="col-md-4">
                                    <p class="fw-bold mb-0">11</p>
                                    <p class="text-muted small mb-1">Belum Sesuai</p>
                                    <a href="#" class="text-primary small fw-semibold">Lihat</a>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <button class="btn btn-outline-warning btn-sm"><i class="fas fa-bolt"></i> Boost Lowongan</button>
                                <button class="btn btn-primary btn-sm">Kelola Kandidat</button>
                                <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i> Recommended Talents</button>
                                <div class="dropdown ms-auto">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD LOWONGAN -->
                    <div class="card mb-3 border shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="fw-bold">Marketing Specialist</h5>
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <span><i class="fas fa-map-marker-alt"></i> Full-time - Jakarta</span>
                                        <span class="mx-1">•</span>
                                        <span>Aktif hingga: 15 Sep 2025</span>
                                    </div>
                                </div>
                                <span class="badge bg-success">Aktif</span>
                            </div>

                            <div class="row mt-3 text-center">
                                <div class="col-md-4">
                                    <p class="fw-bold mb-0">72</p>
                                    <p class="text-muted small mb-1">Chat Dimulai</p>
                                    <a href="#" class="text-primary small fw-semibold">Lihat</a>
                                </div>
                                <div class="col-md-4">
                                    <p class="fw-bold mb-0">341</p>
                                    <p class="text-muted small mb-1">Terhubung</p>
                                    <a href="#" class="text-primary small fw-semibold">Lihat</a>
                                </div>
                                <div class="col-md-4">
                                    <p class="fw-bold mb-0">5</p>
                                    <p class="text-muted small mb-1">Belum Sesuai</p>
                                    <a href="#" class="text-primary small fw-semibold">Lihat</a>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <button class="btn btn-outline-warning btn-sm"><i class="fas fa-bolt"></i> Boost Lowongan</button>
                                <button class="btn btn-primary btn-sm">Kelola Kandidat</button>
                                <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i> Recommended Talents</button>
                                <div class="dropdown ms-auto">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

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
                        <p class="text-muted small mb-2">Selalu update tentang perusahaan Anda dengan fitur notifikasi melalui WhatsApp.</p>
                        <a href="#" class="text-primary small fw-semibold">Kirim OTP</a>
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
                            <span class="fw-bold">1,245</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Tingkat Respons</span>
                            <span class="fw-bold">68%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Tingkat Konversi</span>
                            <span class="fw-bold">42%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 42%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <a href="#" class="btn btn-link d-block text-center mt-3">Lihat Laporan Lengkap</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
