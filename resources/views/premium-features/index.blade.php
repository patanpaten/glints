@extends('company.app')

@section('title', 'Company Dashboard')

@section('content')
<style>
    /* Hilangkan border default Bootstrap */
.custom-tabs .nav-link {
  border: none;
  color: #6c757d;
  font-weight: 500;
  background: transparent;
  position: relative;
}

.custom-tabs .nav-link.active {
  color: #007bff; /* biru */
  font-weight: 600;
}

.custom-tabs .nav-link.active::after {
  content: "";
  position: absolute;
  bottom: -1px;
  left: 0;
  width: 100%;
  height: 3px;
  background-color: #007bff; /* garis biru bawah */
  border-radius: 3px;
}

/* Badge abu-abu kecil */
.custom-tabs .badge {
  background-color: #f0f0f0;
  color: #555;
  font-size: 12px;
  font-weight: 500;
  border-radius: 12px;
  padding: 2px 6px;
}


</style>
<div class="container-fluid py-4">

    <!-- HEADER PERUSAHAAN -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
            <h2 class="fw-bold mb-0" style="color: #2D2D2D;">Fitur Premium</h2>
        </div>
    </div>

    <!-- BODY -->
    <div class="row">
      <!-- LOWONGAN (kiri) -->
        <div class="col-md-8">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">

                    <!-- TABS -->
<ul class="nav nav-tabs custom-tabs mb-3">
    <!-- Semua Fitur -->
    <li class="nav-item">
        <button class="nav-link active"
                id="features-tab"
                data-bs-toggle="tab"
                data-bs-target="#features"
                type="button">
            Semua Fitur
        </button>
    </li>

    <!-- Dibeli -->
    <li class="nav-item">
        <button class="nav-link d-flex align-items-center gap-2"
                id="purchases-tab"
                data-bs-toggle="tab"
                data-bs-target="#purchases"
                type="button">
            Dibeli
            <span class="badge">0</span>
        </button>
    </li>
</ul>


                    <!-- TAB CONTENT -->
                    <div class="tab-content">
                        <!-- SEMUA FITUR -->
                        <div class="tab-pane fade show active" id="features">
                            <div class="row mt-3">
                                <!-- Glints VIP -->
                                <div class="col-12 mb-3">
                                    <div class="border rounded p-3">
                                        <p class="mb-2">
                                            <span class="px-2 py-1 rounded-pill" 
                                                style="background-color: #f0d807; color:#000000; display: inline-block;">
                                                <span class="fw-semibold">Promo Terbatas!</span> 
                                                Upgrade ke VIP, dapatkan 150 Glints Credits per bulan gratis!
                                            </span>
                                        </p>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-start">
                                                <img src="{{ asset('images/glints-vip-icon.svg') }}"
                                                    alt="Glints VIP" class="me-3" style="width:60px; height:60px;">
                                                <div>
                                                    <h6 class="fw-bold mb-1">Glints VIP</h6>
                                                    <p class="small text-muted mb-0">
                                                        Ingin meningkatkan proses rekrutmen dengan fitur premium? Upgrade ke Glints VIP!
                                                    </p>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary fw-semibold px-4">Beli</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hot Job -->
                                <div class="col-12 mb-3">
                                    <div class="border rounded p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-start">
                                                <img src="{{ asset('images/job-boost-icon.svg') }}"
                                                    alt="Hot Job" class="me-3" style="width:60px; height:60px;">
                                                <div>
                                                    <h6 class="fw-bold mb-1">Hot Job</h6>
                                                    <p class="small text-muted mb-0">
                                                        Butuh lebih banyak pelamar? Boost lowongan kamu dengan hot job!
                                                    </p>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary fw-semibold px-4">Beli</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recommended Talents -->
                                <div class="col-12 mb-3">
                                    <div class="border rounded p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-start">
                                                <img src="{{ asset('images/recommended-talent-icon.svg') }}"
                                                    alt="Recommended Talents" class="me-3" style="width:60px; height:60px;">
                                                <div>
                                                    <h6 class="fw-bold mb-1">Recommended Talents</h6>
                                                    <p class="small text-muted mb-0">
                                                        Kesulitan mendapatkan pelamar yang tepat? Coba Recommended Talent!
                                                    </p>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary fw-semibold px-4">Beli</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cari CV -->
                                <div class="col-12 mb-3">
                                    <div class="border rounded p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-start">
                                                <img src="{{ asset('images/talent-seach-feature.svg') }}"
                                                    alt="Cari CV" class="me-3" style="width:60px; height:60px;">
                                                <div>
                                                    <h6 class="fw-bold mb-1">Cari CV</h6>
                                                    <p class="small text-muted mb-0">
                                                        Kesulitan menemukan pelamar yang cocok? Cari di database Glints dan hubungi langsung!
                                                    </p>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary fw-semibold px-4">Beli</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DIBELI -->
                        <div class="tab-pane fade" id="purchases">
                            <div class="d-flex flex-column align-items-center justify-content-center text-center py-5">
                                <!-- Gambar / Icon -->
                                <img src="{{ asset('images/sampah.gif') }}"
                                    alt="Empty State"
                                    class="mb-3" style="max-width: 200px;">

                                <!-- Judul -->
                                <h5 class="fw-bold">Belum memiliki item</h5>

                                <!-- Deskripsi -->
                                <p class="text-muted mb-3">
                                    Anda belum membeli fitur apapun
                                </p>

                                <!-- Tombol Aksi -->
                                <a href="{{ route('company.premium-features.index') }}" class="btn btn-primary">
                                    Cek Fitur Premium
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB CONTENT -->

                </div>
            </div>
        </div>

        <!-- SIDEBAR (kanan) -->
        <div class="col-md-4">
            <!-- GLINTS CREDITS CARD -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-semibold text-dark">Glints Credits</span>
                            <i class="fas fa-info-circle text-primary"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#F5282D" height="32" width="32" viewBox="0 0 24 24">
                            <path d="m10.72 2 4.2 5.78L22 7.69l-4.15 5.64L20.26 20l-6.76-2.22L7.88 22v-7.08L2 10.86l6.73-2.09L10.72 2Z"></path>
                        </svg>
                        <span class="fw-bold fs-5 text-dark">0</span>
                    </div>
                    <button class="btn btn-outline-dark w-100 fw-semibold">
                        Top Up
                    </button>
                </div>
            </div>

            <!-- PAKET SAAT INI CARD -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <p class="fw-semibold text-dark mb-3">Paket Saat Ini</p>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="40" viewBox="0 0 24 24">
                            <path d="M12 .5 16 8l7.5 4-7.5 4-4 7.5L8 16 .5 12 8 8l4-7.5Z"></path>
                        </svg>
                        <span class="fw-bold fs-6 text-dark">Standard</span>
                    </div>
                    <p class="text-muted small mb-3">0 / 5 lowongan sedang aktif</p>
                    <a href="{{ route('company.pricing') }}" class="btn btn-outline-dark w-100 fw-semibold">
                        Lihat Paket
                    </a>


                </div>
            </div>

            <!-- CARD UTAMA -->
<div class="card shadow-sm mb-3 border-0">
    <div class="card-body p-3">

        <!-- LIST FITUR -->
        <div class="list-group">

            <!-- Riwayat Pembayaran -->
            <a href="{{ route('company.riwayat', ['tab' => 'ORDER_HISTORY']) }}"
               class="list-group-item list-group-item-action d-flex align-items-center rounded mb-2 border">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="20" height="20" class="me-3">
                    <path d="m16 2 5 5v13.992A1 1 0 0 1 20.007 22H3.993A1 1 0 0 1 3 21.008V2.992C3 2.444 3.447 2 3.998 2H16Zm-1 2H5v16h14V8h-4V4Zm-2 5v4h3v2h-5V9h2Z"></path>
                </svg>
                <span class="flex-grow-1 fw-medium text-dark">Riwayat Pembayaran</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="#999999" width="18" height="18">
                    <path d="m13.172 12-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414 4.95-4.95Z"></path>
                </svg>
            </a>

            <!-- Loker Aktif -->
            <a href="{{ route('company.riwayat', ['tab' => 'ACTIVE_JOBS']) }}"
               class="list-group-item list-group-item-action d-flex align-items-center rounded mb-2 border">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="20" height="20" class="me-3">
                    <path d="M7 5V2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4ZM4 16v3h16v-3H4Zm0-2h16V7H4v7ZM9 3v2h6V3H9Zm2 8h2v2h-2v-2Z"></path>
                </svg>
                <span class="flex-grow-1 fw-medium text-dark">Loker Aktif</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="#999999" width="18" height="18">
                    <path d="m13.172 12-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414 4.95-4.95Z"></path>
                </svg>
            </a>

            <!-- Riwayat Credits -->
            <a href="{{ route('company.riwayat', ['tab' => 'CREDIT_HISTORY']) }}"
               class="list-group-item list-group-item-action d-flex align-items-center rounded mb-2 border">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="20" height="20" class="me-3">
                    <path d="m10.72 2 4.2 5.78L22 7.69l-4.15 5.64L20.26 20l-6.76-2.22L7.88 22v-7.08L2 10.86l6.73-2.09L10.72 2Z"></path>
                </svg>
                <span class="flex-grow-1 fw-medium text-dark">Riwayat Credits</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="#999999" width="18" height="18">
                    <path d="m13.172 12-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414 4.95-4.95Z"></path>
                </svg>
            </a>

        </div>
    </div>
</div>


        </div>
    </div>
</div>
@endsection
