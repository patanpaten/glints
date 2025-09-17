@extends('company.app')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold fs-5 mb-4">Pengaturan Akun</h2>
    <div class="row">
        <!-- Sidebar -->
<div class="col-lg-3 col-md-4 border-end">
    <!-- Profile Section -->
    <div class="text-center mb-4">
        @if($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" class="rounded-circle border profile-pic">
        @else
            <div class="profile-placeholder rounded-circle border">
                <i class="fas fa-user text-muted fs-2"></i>
            </div>
        @endif

        <h6 class="fw-bold mb-0 mt-3">{{ $user->name ?? '' }}</h6>
        <small class="text-muted">{{ $company->name ?? '' }}</small>
    </div>

    <!-- Navigation -->
    <div class="list-group list-group-flush">
        <a href="#account-info" class="list-group-item list-group-item-action active" data-bs-toggle="pill">
            Informasi Utama
        </a>
        <a href="#password" class="list-group-item list-group-item-action" data-bs-toggle="pill">
            Keamanan Akun
        </a>
        <a href="#connected" class="list-group-item list-group-item-action" data-bs-toggle="pill">
            Akun Terhubung
        </a>
        <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="pill">
            Notifikasi
        </a>
        <a href="#company-profile" class="list-group-item list-group-item-action" data-bs-toggle="pill">
            Profil Perusahaan
        </a>
        <a href="#office-address" class="list-group-item list-group-item-action" data-bs-toggle="pill">
            Daftar Alamat Kantor
        </a>
        <a href="#reject-mode" class="list-group-item list-group-item-action" data-bs-toggle="pill">
            Mode Penolakan
        </a>
        <a href="#support" class="list-group-item list-group-item-action" data-bs-toggle="pill">
            Bantuan & Dukungan
        </a>
    </div>
</div>

<!-- Tambahkan CSS kustom -->
<style>
    .list-group-item {
        border: none; /* Hilangkan border default */
        padding: 10px 16px;
        font-weight: 500;
        color: #495057;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }
    .list-group-item.active {
        background-color: #e7f1ff; /* Biru muda */
        color: #0d6efd;            /* Biru bootstrap */
        font-weight: 600;
    }

    .btn-upload {
        border: 2px solid #0d6efd; /* biru Bootstrap */
        color: #0d6efd;
        background: transparent;
        font-weight: bold;
        padding: 6px 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    .btn-upload:hover {
        background: #0d6efd;
        color: #fff;
    }
    .btn-upload input[type="file"] {
        display: none; /* sembunyikan input asli */
    }
    .form-group {
        position: relative;
    }
    .form-group label.floating-label {
        position: absolute;
        top: -10px;
        left: 12px;
        background: #fff;
        padding: 0 5px;
        font-size: 12px;
        color: #6c757d;
    }
    .form-control.custom-border {
        border: 2px solid #ccc; /* abu-abu */
        border-radius: 4px;
        padding: 10px;
    }
    .form-control.custom-border:focus {
        border-color: #0d6efd; /* biru */
        box-shadow: none;
    }
</style>


        <!-- Main Content -->
        <div class="col-lg-9 col-md-8">
            <div class="tab-content">
                <!-- Account Information -->
                <div class="tab-pane fade show active" id="account-info">
                    <h5 class="fw-bold mb-4">Perbarui Informasi Dasar</h5>
                    <form action="{{ route('company.account-settings.update-account') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Foto Profil --}}
                        <div class="row mb-4 align-items-center">
                            <label class="col-sm-3 col-form-label fw-semibold">Foto Profil</label>
                            <div class="col-sm-9 d-flex align-items-start gap-3">
                                <div class="profile-pic-wrapper">
                                    @if($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="rounded-circle border profile-pic">
                                    @else
                                        <div class="profile-placeholder rounded-circle border">
                                            <i class="fas fa-user text-muted fs-2"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <label class="btn-upload">
                                        <i class="bi bi-upload"></i> UNGGAH
                                        <input type="file" name="logo" accept=".jpg,.jpeg,.png">
                                    </label>

                                    <small class="text-muted d-block">Format yang dapat diterima: <b>.jpg, .jpeg, .png</b></small>
                                    <small class="text-muted d-block">Ukuran yang disarankan: <b>120px x 120px</b></small>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-semibold">Nama Depan</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="firstName" class="floating-label">Masukkan nama depan Anda</label>
                                    <input type="text" 
                                        class="form-control custom-border rounded-0" 
                                        name="name" 
                                        id="firstName"
                                        value="{{ old('name', $user->name ?? '') }}" 
                                        required>
                                </div>
                            </div>
                        </div>



                        {{-- Nama Belakang --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-semibold">Nama Belakang</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="firstName" class="floating-label">Masukkan nama belakang Anda</label>
                                    <input type="text" class="form-control custom-border rounded-0" name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}" placeholder="Masukkan nama belakang Anda">
                                </div>
                            </div>
                        </div>

                        {{-- Negara --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-semibold">Negara</label>
                            <div class="col-sm-9">
                                <select class="form-select form-control custom-border rounded-0" name="country">
                                    <option value="">Pilih negara</option>
                                    <option value="Indonesia" {{ old('country', $user->country ?? '') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="Malaysia" {{ old('country', $user->country ?? '') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                    <option value="Singapore" {{ old('country', $user->country ?? '') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                </select>
                            </div>
                        </div>

                        {{-- Kota --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-semibold">Kota</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control custom-border rounded-0" name="city" value="{{ old('city', $user->city ?? '') }}" placeholder="Masukkan kota tempat tinggal">
                            </div>
                        </div>

                        {{-- Jabatan --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-semibold">Jabatan</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="firstName" class="floating-label">Jabatan atau posisi Anda di perusahaan</label>
                                    <input type="text" class="form-control custom-border rounded-0" name="position" value="{{ old('position', $user->position ?? '') }}" placeholder="Masukkan jabatan Anda">
                                </div>
                            </div>
                        </div>

                        {{-- Kewarganegaraan --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-semibold">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <select class="form-select form-control custom-border rounded-0" name="nationality">
                                    <option value="">Pilih kewarganegaraan</option>
                                    <option value="Indonesia" {{ old('nationality', $user->nationality ?? '') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="Malaysia" {{ old('nationality', $user->nationality ?? '') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                    <option value="Singapore" {{ old('nationality', $user->nationality ?? '') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                </select>
                            </div>
                        </div>

                        {{-- Bahasa Pilihan --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-semibold">Bahasa Pilihan</label>
                            <div class="col-sm-9">
                                <select class="form-select form-control custom-border rounded-0" name="preferred_language">
                                    <option value="">Pilih bahasa</option>
                                    <option value="Bahasa Indonesia" {{ old('preferred_language', $user->preferred_language ?? '') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                    <option value="English" {{ old('preferred_language', $user->preferred_language ?? '') == 'English' ? 'selected' : '' }}>English</option>
                                </select>
                            </div>
                        </div>



                        {{-- Tombol Simpan --}}
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold text-uppercase rounded-0">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <style>.profile-pic {
                    width: 120px;
                    height: 120px;
                    object-fit: cover;
                }
                .profile-placeholder {
                    width: 120px;
                    height: 120px;
                    background: #f8f9fa;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                </style>


                <!-- keamanan akun -->
                <div class="tab-pane fade" id="password">
                    {{-- Form Update Email --}}
                    <form id="updateEmailForm" action="{{ route('company.account-settings.update-account') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="email">

                        <h5 class="fw-bold mb-3">Perbarui Email</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Alamat email baru</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="firstName" class="floating-label">Masukan email baru Anda</label>
                                    <input type="email" name="email" class="form-control custom-border rounded-0" value="{{ old('email', $company->user->email ?? '') }}" placeholder="Masukkan alamat email baru" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold text-uppercase rounded-0">UBAH ALAMAT EMAIL</button>
                            </div>
                        </div>
                    </form>

                    {{-- Form Update Password --}}
                    <form id="updatePasswordForm" action="{{ route('company.account-settings.update-password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h5 class="fw-bold mb-3">Perbarui kata sandi</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Kata sandi lama</label>
                            <div class="col-sm-9">
                                <input type="password" name="current_password" class="form-control custom-border rounded-0" placeholder="Masukkan kata sandi lama" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Kata sandi baru</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control custom-border rounded-0" placeholder="Masukkan kata sandi baru" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Konfirmasi kata sandi</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" class="form-control custom-border rounded-0" placeholder="Konfirmasi kata sandi anda" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold text-uppercase rounded-0">UBAH KATA SANDI</button>
                            </div>
                        </div>
                    </form>

                    {{-- Form Update WhatsApp --}}
                    <form id="updateWhatsAppForm" action="{{ route('company.account-settings.update-account') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="whatsapp">

                        <h5 class="fw-bold mb-3">Update Whatsapp Number</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Whatsapp Number</label>
                            <div class="col-sm-9">
                                <input type="tel" name="whatsapp" class="form-control custom-border rounded-0" value="{{ old('whatsapp', $company->phone ?? '') }}" placeholder="Masukkan nomor whatsapp baru">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold text-uppercase rounded-0">UPDATE & VERIFIKASI</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Akun Terhubung -->
                <div class="tab-pane fade" id="connected">
                    <b class="d-block mb-2">Akun Terhubung</b>
                    <p>Anda dapat masuk melalui salah satu akun terhubung yang tercantum di bawah ini.</p>

                    {{-- Akun yang sudah terhubung --}}
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
                        <div>
                            <span class="fw-bold d-block">{{ $company->name ?? 'Nama Perusahaan' }}</span>
                            <span class="text-muted">{{ $user->email ?? 'email@company.com' }}</span>
                        </div>
                        <div class="text-primary fw-bold d-flex align-items-center" style="cursor:pointer;">
                            <span class="me-2">HAPUS</span>
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 100 100">
                                <path d="M100 10L90 0 50 40 10 0 0 10l40 40L0 90l10 10 40-40 40 40 10-10-40-40z"></path>
                            </svg>
                        </div>
                    </div>

                    <hr> 

                    {{-- Social Media Accounts --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Media Sosial Terhubung</h6>
                        
                        {{-- Facebook --}}
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-facebook text-primary me-2 fs-5"></i>
                                <span>Facebook: {{ $company->facebook ?? 'Belum terhubung' }}</span>
                            </div>
                            @if($company->facebook)
                                <button class="btn btn-outline-danger btn-sm">Putuskan</button>
                            @else
                                <button class="btn btn-primary btn-sm">Hubungkan</button>
                            @endif
                        </div>
                        
                        {{-- LinkedIn --}}
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-linkedin text-primary me-2 fs-5"></i>
                                <span>LinkedIn: {{ $company->linkedin ?? 'Belum terhubung' }}</span>
                            </div>
                            @if($company->linkedin)
                                <button class="btn btn-outline-danger btn-sm">Putuskan</button>
                            @else
                                <button class="btn btn-primary btn-sm">Hubungkan</button>
                            @endif
                        </div>
                        
                        {{-- Instagram --}}
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-instagram text-primary me-2 fs-5"></i>
                                <span>Instagram: {{ $company->instagram ?? 'Belum terhubung' }}</span>
                            </div>
                            @if($company->instagram)
                                <button class="btn btn-outline-danger btn-sm">Putuskan</button>
                            @else
                                <button class="btn btn-primary btn-sm">Hubungkan</button>
                            @endif
                        </div>
                        
                        {{-- Twitter --}}
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-twitter text-primary me-2 fs-5"></i>
                                <span>Twitter: {{ $company->twitter ?? 'Belum terhubung' }}</span>
                            </div>
                            @if($company->twitter)
                                <button class="btn btn-outline-danger btn-sm">Putuskan</button>
                            @else
                                <button class="btn btn-primary btn-sm">Hubungkan</button>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- Notifications -->
                <div class="tab-pane fade" id="notifications">
                    <h5 class="fw-bold">Notifikasi</h5>
                    <p>Pilih tipe notifikasi apa saja yang ingin Anda terima.</p>
                    <hr>

                    <!-- Form Notifikasi -->
                    <form id="updateNotificationsForm" method="POST" action="{{ route('company.account-settings.update-notifications') }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Notifikasi Email -->
                        <div class="mb-4">
                            <div class="mb-2 d-flex align-items-center">
                                <!-- Icon Email -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#666" class="me-2" viewBox="0 0 24 24">
                                    <path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm17 4.238-7.928 7.1L4 7.216V19h16V7.238ZM4.511 5l7.55 6.662L19.502 5H4.511Z"></path>
                                </svg>
                                <span class="fw-bold">Notifikasi Email</span>
                            </div>
                            <p class="text-muted">Terima notifikasi ke email Anda.</p>

                            <!-- Switch -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="form-check form-switch me-3">
                                    <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications" value="1" {{ old('email_notifications', $company->email_notifications ?? false) ? 'checked' : '' }}>
                                </div>
                                <label for="email_notifications" class="m-0">Info Lamaran</label>
                            </div>
                            <!-- Tombol -->
                        <button type="submit" class="btn btn-primary px-4 rounded-0">SIMPAN PERUBAHAN</button>
                        </div>

                        <hr>

                        <!-- Notifikasi WhatsApp -->
                        <div class="mb-4">
                            <div class="mb-2 d-flex align-items-center">
                                <!-- Icon WhatsApp -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#666" class="me-2" viewBox="0 0 24 24">
                                    <path d="M20 3.449A11.827 11.827 0 0 0 12.006 0C5.374 0 0 5.373 0 12c0 2.117.555 4.175 1.608 5.998L0 24l6.164-1.594A11.94 11.94 0 0 0 12.006 24c6.627 0 11.994-5.373 11.994-12 0-3.195-1.244-6.199-3.413-8.551ZM12.006 22.05a9.87 9.87 0 0 1-5.026-1.374l-.36-.214-3.66.946.975-3.563-.234-.367a9.933 9.933 0 0 1-1.528-5.478c0-5.517 4.48-9.998 10.008-9.998a9.97 9.97 0 0 1 10.002 10c0 5.52-4.485 9.998-10.007 9.998Zm5.59-7.487c-.307-.153-1.81-.894-2.09-.994-.28-.1-.484-.153-.688.153-.204.307-.791.993-.969 1.197-.179.204-.356.23-.663.077-.307-.154-1.296-.478-2.469-1.522-.913-.815-1.528-1.822-1.707-2.128-.179-.307-.019-.473.134-.626.138-.138.307-.356.46-.534.153-.178.204-.306.307-.51.102-.204.051-.383-.025-.536-.077-.154-.688-1.663-.944-2.28-.25-.599-.505-.518-.688-.528-.178-.008-.383-.01-.587-.01-.204 0-.535.077-.816.383-.28.307-1.07 1.046-1.07 2.553s1.095 2.96 1.247 3.166c.153.204 2.155 3.287 5.223 4.61.73.316 1.3.505 1.745.646.733.233 1.398.2 1.923.121.587-.087 1.81-.739 2.066-1.452.255-.713.255-1.323.178-1.452-.076-.127-.28-.203-.587-.356Z"/>
                                </svg>
                                <span class="fw-bold">Notifikasi WhatsApp</span>
                            </div>
                            <p class="text-muted">Terima notifikasi ke nomor WhatsApp Anda yang sudah terverifikasi.</p>

                            <!-- Switches -->
                            <div class="d-flex align-items-center mb-2">
                                <div class="form-check form-switch me-3">
                                    <input class="form-check-input" type="checkbox" id="application_notifications" name="application_notifications" value="1" {{ old('application_notifications', $company->application_notifications ?? false) ? 'checked' : '' }}>
                                </div>
                                <label for="application_notifications" class="m-0">Info Lamaran</label>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="form-check form-switch me-3">
                                    <input class="form-check-input" type="checkbox" id="marketing_notifications" name="marketing_notifications" value="1" {{ old('marketing_notifications', $company->marketing_notifications ?? false) ? 'checked' : '' }}>
                                </div>
                                <label for="marketing_notifications" class="m-0">Info Marketing</label>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <button type="submit" class="btn btn-primary px-4 rounded-0">SIMPAN PERUBAHAN</button>
                    </form>
                </div>


                <!-- Profil Perusahaan -->
                <div class="tab-pane fade" id="company-profile">
                    <h5 class="fw-bold mb-3">Perbarui Profil Perusahaan</h5>

                    <div class="d-flex align-items-center mb-4">
                            <div class="me-3">
                    @if(Auth::guard('company')->user()->logo)
                        <img src="{{ asset('storage/' . Auth::guard('company')->user()->logo) }}"
                             alt="{{ Auth::guard('company')->user()->name }}"
                            class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                    @else
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 24px; font-weight: bold;">
                            {{ Auth::guard('company')->user()->initials }}
                        </div>
                    @endif
                </div>
                            
                                           
                            
                            <div class="flex-grow-1">
                                <h5 class="mb-1">{{ Auth::guard('company')->user()->name }}</h5>
                                <small class="text-muted">Terakhir diperbarui: {{ Auth::guard('company')->user()->updated_at->format('d M Y') }}</small>
                            </div>
                            <div>
                                <a href="{{ route('company.profile.edit2') }}" class="btn btn-primary fw-bold px-4 rounded-0">
                                    PERBARUI PROFIL
                                </a>
                            </div>
                        </div>
                </div>


                <!-- Daftar alamat kantor -->
                <div class="tab-pane fade" id="office-address">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Work Addresses</h5>
                        <a href="#" class="btn btn-primary btn-sm fw-bold">
                            Tambah
                        </a>
                    </div>
                    <hr class="mt-0">

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th class="text-end">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($company->address || $company->city || $company->state)
                                        <tr>
                                            <td>
                                                <small class="text-muted">{{ $company->address ?? 'Alamat belum diatur' }}</small>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('company.profile.edit') }}" class="btn btn-outline-dark btn-sm px-4 fw-semibold">Edit</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">
                                                Belum ada alamat kantor ditambahkan
                                                <br>
                                                <small>Silakan tambahkan alamat melalui halaman profil perusahaan</small>
                                            </td>
                                        </tr>
                                    @endforelse 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- Mode Penolakan -->
                <div class="tab-pane fade" id="reject-mode">
                    <h5 class="fw-bold mb-2">Mode Penolakan</h5>
                    <p class="mb-3">Pilih dan modifikasi template pesan saat menolak lamaran kandidat.</p>
                    <hr class="mt-0">

                    <div class="d-flex align-items-start mb-3">
                        <!-- Teks -->
                        <div>
                            <span class="fw-bold d-block">Pesan khusus dengan alasan penolakan yang berbeda</span>
                            <small class="text-muted">Kirim pesan penolakan spesifik dengan alasan yang Anda pilih.</small>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <button class="btn btn-primary fw-bold px-4 py-2 rounded-0" style="width:200px;">UBAH</button>
                </div>

                <!-- Bantuan & Dukungan -->
                <div class="tab-pane fade" id="support">
                    <h5 class="fw-bold mb-2">Bantuan & Dukungan</h5>
                    <p class="mb-3">Untuk bantuan mengenai akun Glints Anda, hubungi kami melalui tombol di bawah ini.</p>
            
                    <!-- Tombol -->
                    <button class="btn btn-primary fw-bold px-4 py-2 rounded-0">DAPATKAN BANTUAN</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Alert untuk feedback -->
<div id="alertContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;"></div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Function untuk menampilkan alert
    function showAlert(message, type = 'success') {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        $('#alertContainer').html(alertHtml);
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }

    // Function untuk clear validation errors
    function clearValidationErrors(form) {
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').text('');
    }

    // Function untuk show validation errors
    function showValidationErrors(form, errors) {
        $.each(errors, function(field, messages) {
            const input = form.find(`[name="${field}"]`);
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text(messages[0]);
        });
    }

    // Handle Account Info Form
    $('#updateAccountForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const formData = new FormData(this);
        
        clearValidationErrors(form);
        form.find('button[type="submit"]').prop('disabled', true).text('Menyimpan...');
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                showAlert('Informasi akun berhasil diperbarui!', 'success');
                form.find('button[type="submit"]').prop('disabled', false).text('SIMPAN PERUBAHAN');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(form, xhr.responseJSON.errors);
                } else {
                    showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                }
                form.find('button[type="submit"]').prop('disabled', false).text('SIMPAN PERUBAHAN');
            }
        });
    });

    // Handle Email Form
    $('#updateEmailForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        
        clearValidationErrors(form);
        form.find('button[type="submit"]').prop('disabled', true).text('Mengubah...');
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                showAlert('Email berhasil diperbarui!', 'success');
                form.find('button[type="submit"]').prop('disabled', false).text('UBAH ALAMAT EMAIL');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(form, xhr.responseJSON.errors);
                } else {
                    showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                }
                form.find('button[type="submit"]').prop('disabled', false).text('UBAH ALAMAT EMAIL');
            }
        });
    });

    // Handle Password Form
    $('#updatePasswordForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        
        clearValidationErrors(form);
        form.find('button[type="submit"]').prop('disabled', true).text('Mengubah...');
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                showAlert('Password berhasil diperbarui!', 'success');
                form[0].reset(); // Clear form
                form.find('button[type="submit"]').prop('disabled', false).text('UBAH KATA SANDI');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(form, xhr.responseJSON.errors);
                } else {
                    showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                }
                form.find('button[type="submit"]').prop('disabled', false).text('UBAH KATA SANDI');
            }
        });
    });

    // Handle WhatsApp Form
    $('#updateWhatsAppForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        
        clearValidationErrors(form);
        form.find('button[type="submit"]').prop('disabled', true).text('Memperbarui...');
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                showAlert('Nomor WhatsApp berhasil diperbarui!', 'success');
                form.find('button[type="submit"]').prop('disabled', false).text('UPDATE & VERIFIKASI');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(form, xhr.responseJSON.errors);
                } else {
                    showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                }
                form.find('button[type="submit"]').prop('disabled', false).text('UPDATE & VERIFIKASI');
            }
        });
    });

    // Handle Notifications Form
    $('#updateNotificationsForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        
        form.find('button[type="submit"]').prop('disabled', true).text('Menyimpan...');
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                showAlert('Pengaturan notifikasi berhasil diperbarui!', 'success');
                form.find('button[type="submit"]').prop('disabled', false).text('SIMPAN PERUBAHAN');
            },
            error: function(xhr) {
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                form.find('button[type="submit"]').prop('disabled', false).text('SIMPAN PERUBAHAN');
            }
        });
    });

    // Tab navigation
    $('.list-group-item[data-bs-toggle="pill"]').on('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all items
        $('.list-group-item').removeClass('active');
        
        // Add active class to clicked item
        $(this).addClass('active');
        
        // Hide all tab panes
        $('.tab-pane').removeClass('show active');
        
        // Show target tab pane
        const target = $(this).attr('href');
        $(target).addClass('show active');
    });
});
</script>
@endpush
