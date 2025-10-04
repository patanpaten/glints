@extends('company.app')

@section('title', 'Company Dashboard')

@section('content')
@php
    // mapping query param ke nama tab
    $tab = request('tab');
    if ($tab === 'ACTIVE_JOBS') {
        $activeTab = 'loker';
    } elseif ($tab === 'ORDER_HISTORY') {
        $activeTab = 'pembayaran';
    } elseif ($tab === 'CREDIT_HISTORY') {
        $activeTab = 'credit';
    } else {
        $activeTab = 'loker'; // default
    }
@endphp

<div class="container-fluid py-4">

    <!-- HEADER PERUSAHAAN -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
    <a href="{{ route('company.premium-features.index') }}" 
       class="fw-bold mb-0 text-decoration-none d-flex align-items-center" 
       style="color: #2D2D2D; font-size: 1.25rem;">
        <i class="fa fa-arrow-left"></i>
    </a>
</div>

    </div>

    <!-- BODY -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">

                    <!-- TABS -->
<ul class="nav nav-tabs mb-3 border-bottom">
    <!-- Loker Aktif -->
    <li class="nav-item">
        <a class="nav-link fw-semibold px-3 {{ $activeTab == 'loker' ? 'active' : '' }}"
           data-bs-toggle="tab"
           href="#loker">
            Loker Aktif
        </a>
    </li>

    <!-- Riwayat Pembayaran -->
    <li class="nav-item">
        <a class="nav-link fw-semibold px-3 {{ $activeTab == 'pembayaran' ? 'active' : '' }}"
           data-bs-toggle="tab"
           href="#pembayaran">
            Riwayat Pembayaran
        </a>
    </li>

    <!-- Riwayat Credit -->
    <li class="nav-item">
        <a class="nav-link fw-semibold px-3 {{ $activeTab == 'credit' ? 'active' : '' }}"
           data-bs-toggle="tab"
           href="#credit">
            Riwayat Credit
        </a>
    </li>
</ul>

<style>
    /* Tab default */
    .nav-tabs .nav-link {
        color: #6c757d; /* abu */
        border: none;
        transition: all 0.2s ease;
    }

    /* Hover */
    .nav-tabs .nav-link:hover {
        color: #0d6efd; /* biru bootstrap */
        background-color: rgba(13, 110, 253, 0.05);
        border-radius: 6px 6px 0 0;
    }

    /* Aktif */
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border: none;
        border-bottom: 3px solid #0d6efd;
        background-color: transparent;
        border-radius: 0;
    }
</style>


                    <!-- TAB CONTENT -->
                    <div class="tab-content">

                        <!-- LOKER AKTIF -->
                        <div class="tab-pane fade {{ $activeTab == 'loker' ? 'show active' : '' }}" id="loker">
                            <h5 class="fw-bold mb-1">Kelola Loker Aktif Anda</h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                 <p class="text-muted small">
                                Loker hanya dapat dikelola oleh kreator dan editor yang telah ditambahkan. <br>
                                Untuk mengelola slot loker yang dipakai atau mengelola loker yang tidak Anda buat, hubungi kreator loker.
                            </p>
                                <div class="col-md-1.5">
                                    <select class="form-select" disabled style="opacity: 0.6; cursor: not-allowed;">
                                        <option>Semua Kreator</option>
                                    </select>
                                </div>
                            </div>  

                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Dibuat pada</th>
                                            <th>Nama Loker</th>
                                            <th>Tipe Kerja</th>
                                            <th>Kreator</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <img src="{{ asset('images/sampah.gif') }}"
                                                    alt="Empty State"
                                                    class="mb-3" style="max-width: 200px;">
                                                <h6 class="fw-bold">Belum ada loker aktif</h6>
                                                <p class="text-muted">Pasang loker sekarang dan temukan kandidat yang tepat bagi perusahaan Anda.</p>
                                                <a href="{{ route('company.jobs.create') }}" class="btn btn-primary">
                                                    Pasang Loker
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- RIWAYAT PEMBAYARAN -->
                        <div class="tab-pane fade {{ $activeTab == 'pembayaran' ? 'show active' : '' }}" id="pembayaran">
                            <h5 class="fw-bold mb-1">Riwayat Pembayaran</h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                 <p class="text-muted small">
                                Lihat transaksi terbaru, download invoice, dan selesaikan pembayaran di platform Glints.
                            </p>
                                <div class="col-md-1.5">
                                    <select class="form-select" disabled style="opacity: 0.6; cursor: not-allowed;">
                                        <option>Semua status</option>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Dibuat pada</th>
                                            <th>Produk</th>
                                            <th>Harga (Credits)</th>
                                            <th>Credits Dibeli</th>
                                            <th>Total Dibayar (Rp)</th>
                                            <th>Pengguna</th>
                                            <th>Status</th>
                                            <th>Invoice</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <img src="{{ asset('images/sampah.gif') }}"
                                                     alt="Empty State"
                                                     class="mb-3" style="max-width: 200px;">
                                                <h6 class="fw-bold">Belum memiliki item</h6>
                                                <p class="text-muted">Anda belum membeli fitur apapun</p>
                                                <a href="{{ route('company.premium-features.index') }}" class="btn btn-primary">
                                                    Cek Fitur Premium
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- RIWAYAT CREDIT -->
                        <div class="tab-pane fade {{ $activeTab == 'credit' ? 'show active' : '' }}" id="credit">
                            <h5 class="fw-bold mb-1">Riwayat Credits</h5>
                            <p class="text-muted small">
                                Cek riwayat penggunaan Glints Credits Anda. Pakai Glints Credits untuk menggunakan berbagai fitur premium di platform Glints Employer.
                            </p>

                            <div class="row g-2 mb-3">
                            <div class="col-md-2">
                                <select class="form-select form-select-sm">
                                    <option>Filter Kreator</option>
                                    <option>Semua kreator</option>
                                    <option>User Company</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select form-select-sm">
                                    <option>Penggunaan</option>
                                    <option>Cari CV</option>
                                    <option>Hot Job</option>
                                    <option>Recommended Talent</option>
                                    <option>VIP Membership</option>
                                    <option>Paket Berlangganan</option>
                                    <option>Credit Gratis</option>
                                    <option>Top Up Credits</option>
                                    <option>Top Up Credits (via Sales Team)</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select form-select-sm">
                                    <option>Baru ke Lama</option>
                                    <option>Lama ke Baru</option>
                                </select>
                            </div>
                        </div>


                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tanggal / Waktu</th>
                                            <th>Penggunaan</th>
                                            <th>Jumlah</th>
                                            <th>Kreator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <img src="{{ asset('images/sampah.gif') }}"
                                                     alt="Empty State"
                                                     class="mb-3" style="max-width: 200px;">
                                                <h6 class="fw-bold">Belum memiliki item</h6>
                                                <p class="text-muted">Anda belum menggunakan Glints Credit</p>
                                                <a href="{{ route('company.premium-features.index') }}" class="btn btn-primary">
                                                    Lihat Fitur
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- END TAB CONTENT -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
