@extends('company.app')

@section('title', 'Company Dashboard')

@section('content')

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
                    <div class="d-flex align-items-center gap-2">
                    @if(Auth::guard('company')->user()->is_verified)
                        <span class="badge bg-success-subtle text-success">
                            <i class="fas fa-check-circle"></i> Terverifikasi
                        </span>
                    @else
                    <svg viewBox="0 0 12 15" xmlns="http://www.w3.org/2000/svg" 
                            fill="#D4D5D8" height="20" width="20">
                            <path d="m6 .167 5.478 1.217a.667.667 0 0 1 .522.65v6.659a4 4 0 0 1-1.781 3.328L6 14.833l-4.219-2.812A4 4 0 0 1 0 8.693V2.035c0-.313.217-.583.522-.651L6 .167ZM8.968 4.98l-3.3 3.3-1.885-1.886-.943.943 2.828 2.829 4.243-4.243-.943-.943Z"></path>
                        </svg>
                        <span class="text-muted fw-semibold">
                            Belum Diverifikasi 
                        </span>
                        <span class="fw-semibold">
                            -
                        </span>
                        <!-- Tombol / Link -->
                        <a href="#" 
                        class="text-primary fw-semibold text-decoration-none" 
                        data-bs-toggle="modal" 
                        data-bs-target="#verificationModal">
                        Verifikasi Perusahaan
                        </a>

                        <!-- Modal Verifikasi Perusahaan -->
                        <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                            <div class="modal-content rounded-3 shadow">

                            <!-- Header -->
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-semibold" id="verificationModalLabel">Verifikasi Perusahaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="border-top"></div>

                            <!-- Body (Scrollable) -->
                            <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                                
                                <!-- Banner Info -->
                                <div class="alert d-flex align-items-center rounded-3 mb-4" 
                                    role="alert" 
                                    style="background-color:#f8f9fa; border:1px solid #dee2e6; color:#495057;">
                                <i class="bi bi-info-circle me-2"></i>
                                <span>Verifikasi memerlukan waktu 2 hari kerja</span>
                                </div>

                                <p class="mb-3">Silakan pilih metode verifikasi untuk melanjutkan.</p>

                                <!-- Pilihan Metode -->
                                <div class="row g-3 mb-4">
                                <!-- Pilihan Metode -->
                                <div class="row g-3 mb-4">
                                <!-- Opsi Dokumen Legal -->
                                <div class="col-md-6">
                                <div class="card border shadow-sm h-100">
                                    <div class="card-body position-relative">

                                    <!-- Direkomendasikan -->
                                    <span class="badge position-absolute" 
                                        style="background-color:#ff8000; color:#fff; top:-10px; left:15px; z-index:1;">
                                    Direkomendasikan
                                    </span>


                                    <!-- Judul + Icon -->
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('images/verify-with-legal-documents-icon.svg') }}" 
                                            class="me-2" width="40" height="40" />
                                        <h6 class="fw-semibold mb-0">Verifikasi dengan Dokumen Legal</h6>
                                    </div>

                                    <hr class="my-2">

                                    <!-- Subjudul -->
                                    <p class="small mb-2 text-muted fw-semibold">Anda akan mendapatkan:</p>

                                    <!-- 3 Item Sejajar -->
                                    <div class="d-flex justify-content-between text-center">
                                        <div>
                                        <div class="fw-bold">5</div>
                                        <div class="small text-muted">Loker aktif (Paket Standard)</div>
                                        </div>
                                        <div>
                                        <div>✔</div>
                                        <div class="small text-muted">Badge terverifikasi</div>
                                        </div>
                                        <div>
                                        <div>🛒</div>
                                        <div class="small text-muted">Fitur berbayar</div>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                </div>


                                <!-- Opsi Bukti Kepemilikan -->
                                <div class="col-md-6">
                                <div class="card border shadow-sm h-100">
                                    <div class="card-body position-relative">

                                    <!-- Judul + Icon -->
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('images/verify-with-proof-of-ownership-icon.svg') }}" 
                                            class="me-2" width="40" height="40" />
                                        <h6 class="fw-semibold mb-0">Verifikasi dengan Bukti Kepemilikan</h6>
                                    </div>

                                    <hr class="my-2">

                                    <!-- Subjudul -->
                                    <p class="small mb-2 text-muted fw-semibold">Anda akan mendapatkan:</p>

                                    <!-- 3 Item Sejajar -->
                                    <div class="d-flex justify-content-between text-center">
                                        <div>
                                        <div class="fw-bold">3</div>
                                        <div class="small text-muted">Loker aktif (Paket Standard)</div>
                                        </div>
                                        <div>
                                        <div>🛒</div>
                                        <div class="small text-muted">Fitur berbayar</div>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                </div>
                                </div>

                                {{-- <!-- Form & Sidebar verifikasi dengan dokumen legal -->
                                <div class="row g-3">
                                <!-- Sidebar Kiri -->
                                <div class="col-md-4">
                                    <div class="card border-1 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Dibutuhkan</h6>
                                        <ul class="list-unstyled small mb-0">
                                        <li>NPWP Perusahaan</li>
                                        <li>Nomor NPWP Perusahaan</li>
                                        <li>NIB Perusahaan <span class="text-muted">(Opsional)</span></li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>

                                <!-- Form Kanan -->
                                <div class="col-md-8">
                                    <div class="card border-1 shadow-sm">
                                    <div class="card-body">
                                        <form>
                                        <!-- Custom Input File NPWP -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Upload NPWP Perusahaan <span class="text-danger">*</span></label><br>
                                            <input type="file" id="uploadNPWP" accept=".pdf,.jpg,.jpeg,.png" hidden>
                                            <label for="uploadNPWP" class="btn btn-outline-secondary d-inline-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 24 24">
                                                <path d="M3 19h18v2H3v-2Zm10-9v8h-2v-8H4l8-8 8 8h-7Z"/>
                                            </svg>
                                            Pilih File
                                            </label>
                                            <small class="text-muted d-block mt-2">
                                            <span class="fw-semibold">Format yang dapat diterima:</span> pdf, jpg, jpeg, png | 
                                            <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                                            </small>
                                        </div>

                                        <!-- Nomor NPWP -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nomor NPWP Perusahaan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>

                                        <!-- NIB -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">13 Digit NIB Perusahaan - <span class="text-muted">Opsional</span></label>
                                            <input type="text" class="form-control">
                                            <small class="text-muted d-block mt-1">
                                            Melampirkan NIB anda akan mempercepat verifikasi
                                            </small>
                                        </div>

                                        <!-- Dokumen Tambahan -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Dokumen Tambahan</label><br>
                                            <input type="file" id="extraDocs" accept=".pdf,.jpg,.jpeg,.png" hidden>
                                            <label for="extraDocs" class="btn btn-outline-secondary d-inline-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 24 24">
                                                <path d="M3 19h18v2H3v-2Zm10-9v8h-2v-8H4l8-8 8 8h-7Z"/>
                                            </svg>
                                            Pilih File (Maks: 5)
                                            </label>
                                            <small class="text-muted d-block mt-2">
                                            <span class="fw-semibold">Format yang dapat diterima:</span> pdf, jpg, jpeg, png | 
                                            <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                                            </small>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div> --}}


                                <!-- Form & Sidebar verifikasi dengan bukti kepemilikan -->
                                <div class="row g-3">
                                <!-- Sidebar Kiri -->
                                <div class="col-md-3">
                                    <div class="card border-1 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Dibutuhkan</h6>
                                        <ul class="list-unstyled small mb-0">
                                        <li>Verifikasi WhatsApp</li>
                                        <li>KTP/NPWP Pribadi</li>
                                        <li>Nomor KTP/NPWP Pribadi</li>
                                        <li>NIB Pribadi (Opsional)</li>
                                        <li>Foto Aktivitas Bisnis Online/Offline</li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>

                                <!-- Form Kanan -->
                                <div class="col-md-9">
                                <div class="card border-1 shadow-sm">
                                    <div class="card-body">
                                    <form>

                                        <!-- Verifikasi WhatsApp -->
                                        <div class="mb-3">
                                        <label class="form-label fw-semibold">Verifikasi WhatsApp <span class="text-danger">*</span></label>
                                        <div class="alert alert-light border d-flex align-items-center p-2 mb-0">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            <span>Status Verifikasi: <strong class="text-success"><br>Terverifikasi</strong></span>
                                        </div>
                                        </div>

                                        <!-- Pilih Salah Satu: NPWP / KTP -->
                                        <div class="mb-3">
                                        <label class="form-label fw-semibold">Pilih Salah Satu <span class="text-danger">*</span></label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="identityType" id="npwp" checked>
                                            <label class="form-check-label" for="npwp">NPWP Pribadi</label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="identityType" id="ktp">
                                            <label class="form-check-label" for="ktp">KTP Pribadi</label>
                                            </div>
                                        </div>
                                        </div>

                                        <!-- Upload NPWP/KTP -->
                                        <div class="mb-3">
                                        <input type="file" id="uploadIdentity" accept=".pdf,.jpg,.jpeg,.png" hidden>
                                        <label for="uploadIdentity" class="btn btn-outline-secondary d-inline-flex align-items-center">
                                            <i class="bi bi-upload me-2"></i>Pilih File
                                        </label>
                                        <small class="text-muted d-block mt-2">
                                            <span class="fw-semibold">Format yang dapat diterima:</span> pdf, jpg, jpeg, png | 
                                            <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                                        </small>
                                        </div>

                                        <!-- Nomor NPWP -->
                                        <div class="mb-3">
                                        <label class="form-label fw-semibold">Nomor NPWP Pribadi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control">
                                        </div>

                                        <!-- NIB -->
                                        <div class="mb-3">
                                        <label class="form-label fw-semibold">NIB Pribadi</label>
                                        <input type="text" class="form-control">
                                        <small class="text-muted d-block mt-1">
                                            Melampirkan NIB anda akan mempercepat verifikasi
                                        </small>
                                        </div>

                                        <!-- Pilih Salah Satu: Aktivitas Bisnis -->
                                        <div class="mb-3">
                                        <label class="form-label fw-semibold">Pilih Salah Satu <span class="text-danger">*</span></label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="businessProof" id="online" checked>
                                            <label class="form-check-label" for="online">Foto Aktivitas Bisnis Online (Min 2)</label>
                                            </div><br>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="businessProof" id="offline">
                                            <label class="form-check-label" for="offline">Foto Aktivitas Bisnis Offline (Min 2)</label>
                                            </div>
                                        </div>
                                        </div>

                                        <!-- Upload Foto Aktivitas -->
                                        <div class="mb-3">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <label class="border rounded d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                                            <i class="bi bi-plus-lg fs-4"></i>
                                            <span class="small">Unggah</span>
                                            <input type="file" accept=".jpg,.jpeg,.png" hidden>
                                            </label>
                                            <label class="border rounded d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                                            <i class="bi bi-plus-lg fs-4"></i>
                                            <span class="small">Unggah</span>
                                            <input type="file" accept=".jpg,.jpeg,.png" hidden>
                                            </label>
                                            <label class="border rounded d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                                            <i class="bi bi-plus-lg fs-4"></i>
                                            <span class="small">Unggah</span>
                                            <input type="file" accept=".jpg,.jpeg,.png" hidden>
                                            </label>
                                            <label class="border rounded d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                                            <i class="bi bi-plus-lg fs-4"></i>
                                            <span class="small">Unggah</span>
                                            <input type="file" accept=".jpg,.jpeg,.png" hidden>
                                            </label>
                                        </div>
                                        <small class="text-muted d-block mt-2">
                                            <span class="fw-semibold">Format yang diterima:</span> jpg, jpeg, png | 
                                            <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                                        </small>
                                        </div>

                                        <!-- Dokumen Tambahan -->
                                        <div class="mb-3">
                                        <label class="form-label fw-semibold">Dokumen Tambahan</label><br>
                                        <input type="file" id="extraDocs" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                                        <label for="extraDocs" class="btn btn-outline-secondary d-inline-flex align-items-center">
                                            <i class="bi bi-upload me-2"></i>Pilih File (Maks: 5)
                                        </label>
                                        <small class="text-muted d-block mt-2">
                                            <span class="fw-semibold">Format yang dapat diterima:</span> pdf, jpg, jpeg, png | 
                                            <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                                        </small>
                                        </div>

                                    </form>
                                    </div>
                                </div>
                                </div>

                                </div>

                            </div> <!-- /modal-body -->
                            </div>
                            <!-- Footer (Sticky di bawah) -->
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-secondary" disabled>Kirim</button>
                            </div>
                        </div>
                        </div>
                        </div>
                    @endif
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
    
<div class="container-fluid py-2">
    <!-- BODY -->
    <div class="row">

        <!-- LOWONGAN (kiri) -->
        <div class="col-md-8">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <p class="fw-bold mb-0" style="color: #2D2D2D;">Daftar Lowongan Kerja</p>
                </div>
                <div class="card-body">
                    <!-- FILTER -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="position-relative w-50">
                            <input type="text" placeholder="Cari nama loker atau kata kunci"
                                class="form-control"
                                style="height: 38px; border-radius: 6px; padding-left: 40px;">
                            <i class="fas fa-search position-absolute"
                            style="top: 50%; left: 12px; transform: translateY(-50%); color: #666;"></i>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-outline-secondary d-flex align-items-center" style="height: 38px; border-radius: 6px;">
                                <i class="fas fa-sort me-2"></i>
                                <span class="text-muted fw-bold me-2">Urutkan:</span>
                                <span>Tanggal Diupdate</span>
                            </button>
                        </div>
                    </div>

                    <!-- TAB -->
                    <ul class="nav nav-tabs mb-4" role="tablist" style="border-bottom: none;">
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link active d-flex align-items-center justify-content-between"
                            style="color: #666;" role="tab">
                                Semua Loker
                                <span class="badge rounded-pill" style="background-color: #d3d3d3; color: #363636; margin-left: 6px;">{{ $totalJobs }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-between" style="color: #666;" role="tab">
                                Aktif
                                <span class="badge rounded-pill" style="background-color:  #d3d3d3; color: #363636; margin-left: 6px;">{{ $activeJobs }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-between" style="color: #666;" role="tab">
                                Nonaktif
                                <span class="badge rounded-pill" style="background-color:  #d3d3d3; color: #363636; margin-left: 6px;">{{ $totalJobs - $activeJobs }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-between" style="color: #017EB7;" role="tab">
                                Dalam Review
                                <span class="badge rounded-pill" style="background-color: #d3d3d3; color:#017EB7; margin-left: 6px;">0</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-between" style="color: #666;" role="tab">
                                Draft
                                <span class="badge rounded-pill" style="background-color:  #d3d3d3; color: #363636; margin-left: 6px;">0</span>
                            </a>
                        </li>
                    </ul>

                    {{-- DAFTAR LOWONGAN DINAMIS --}}
                    @if($recentJobs && $recentJobs->count() > 0)
                        @foreach($recentJobs as $job)
                            <div class="card mb-3 border shadow-sm rounded-3 position-relative">
                                {{-- Status di pojok kanan atas --}}
                                <div class="position-absolute top-0 end-0 m-3 d-flex align-items-center gap-1">
                                    <span class="badge bg-light text-dark border px-2 py-1 d-flex align-items-center gap-2">
                                        <span class="fw-semibold">{{ $job->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                        <span class="d-inline-block rounded-circle"
                                            style="width:12px; height:12px; background-color: {{ $job->is_active ? '#28a745' : '#6c757d' }};">
                                        </span>
                                    </span>
                                </div>

                                <div class="card-body p-3">
                                    {{-- Header + Statistik sejajar --}}
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        {{-- Kiri: Judul + Detail --}}
                                        <div class="me-3" style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                                            <h5 class="fw-semibold mb-2 text-wrap">{{ $job->title }}</h5>
                                            <div class="d-flex flex-column text-muted small gap-1 mt-4">
                                                <span class="text-wrap">
                                                    <i class="fas fa-clock me-1"></i> {{ $job->employment_type }}
                                                </span>
                                                <span class="text-wrap mt-2">
                                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $job->office_address }}
                                                </span>
                                                <span class="text-wrap mt-3">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    Aktif hingga: {{ $job->created_at->addDays(30)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Kanan: Statistik --}}
                                        <div class="row text-center border rounded-2 py-2 mt-5" style="min-width: 550px; margin-right: 5px; me-10">
                                            <div class="col-4 border-end">
                                                <p class="fw-bold mb-0">{{ $job->chat_count ?? 0 }}</p>
                                                <p class="text-muted small mb-1">Chat Dimulai</p>
                                                <a href="{{ route('company.applications.index', ['job' => $job->id, 'status' => 'interview']) }}"
                                                class="text-primary small fw-bold text-decoration-none">Lihat</a>
                                            </div>
                                            <div class="col-4 border-end">
                                                <p class="fw-bold mb-0">{{ $job->applications_count ?? 0 }}</p>
                                                <p class="text-muted small mb-1">Terhubung</p>
                                                <a href="{{ route('company.applications.index', ['job' => $job->id]) }}"
                                                class="text-primary small fw-bold text-decoration-none">Lihat</a>
                                            </div>
                                            <div class="col-4">
                                                <p class="fw-bold mb-0">{{ $job->rejected_count ?? 0 }}</p>
                                                <p class="text-muted small mb-1">Belum Sesuai</p>
                                                <a href="{{ route('company.applications.index', ['job' => $job->id, 'status' => 'rejected']) }}"
                                                class="text-primary small fw-bold text-decoration-none">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- FOOTER: Action Buttons --}}
                                <div class="card-footer bg-light border-top d-flex justify-content-between align-items-center py-2">

                                    {{-- Kiri: Boost --}}
                                    <div>
                                        <button class="btn btn-outline-warning btn-sm fw-semibold">
                                            <i class="fas fa-bolt me-1"></i> Boost Lowongan
                                        </button>
                                    </div>

                                    {{-- Kanan: tombol lain --}}
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('company.applications.index', ['job' => $job->id]) }}"
                                        class="btn btn-primary btn-sm fw-semibold">
                                            Kelola Kandidat
                                        </a>
                                        <button class="btn btn-outline-secondary btn-sm fw-semibold">
                                            Recommended Talents
                                        </button>

                                        {{-- Dropdown kanan --}}
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border d-flex align-items-center justify-content-center"
                                                    type="button" data-bs-toggle="dropdown"
                                                    style="width:40px; height:30px;">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('company.jobs.edit', $job->id) }}">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">Bagikan</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">Duplikat</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">Ekspor CSV</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <h5 class="text-muted mt-3">Belum memiliki item</h5>
                        </div>
                    @endif

                    <!-- PAGINATION -->
                    <div class="d-flex justify-content-center mt-4">
{{-- ini cuman tampil ketika ada loker, kalo gak ada loker yang tampil hanya yang atas --}}
                        <p>Anda telah mencapai batas maksimal</p>
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
                <p class="small mb-3">Dapatkan fitur eksklusif untuk proses rekrutmen yang lebih cepat!</p>
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
