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
        @if(Auth::guard('company')->user()->logo)
            <img src="{{ asset('storage/' . Auth::guard('company')->user()->logo) }}"
                 alt="{{ Auth::guard('company')->user()->name }}"
                 class="rounded-circle border mb-3"
                 style="width: 90px; height: 90px; object-fit: cover;">
        @else
            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mb-3"
                 style="width: 90px; height: 90px; font-size: 28px;">
                {{ Auth::guard('company')->user()->initials }}
            </div>
        @endif

        <h6 class="fw-bold mb-0">{{ Auth::guard('company')->user()->name }}</h6>
        <small class="text-muted">{{ Auth::guard('company')->user()->company_name ?? '' }}</small>
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
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" class="rounded-circle border profile-pic">
                                    @else
                                        <div class="profile-placeholder rounded-circle border">
                                            <i class="fas fa-user text-muted fs-2"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <input type="file" name="logo" class="form-control mb-2" accept=".jpg,.jpeg,.png">
                                    <small class="text-muted d-block">Format yang dapat diterima: <b>.jpg, .jpeg, .png</b></small>
                                    <small class="text-muted d-block">Ukuran yang disarankan: <b>120px x 120px</b></small>
                                </div>
                            </div>
                        </div>

                        {{-- Nama Depan --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Nama Depan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $company->first_name) }}" placeholder="Masukkan nama depan Anda">
                            </div>
                        </div>

                        {{-- Nama Belakang --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Nama Belakang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $company->last_name) }}" placeholder="Masukkan nama belakang Anda">
                            </div>
                        </div>

                        {{-- Negara --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Negara</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="country">
                                    <option value="Indonesia" selected>Indonesia</option>
                                    <!-- Tambahkan opsi negara lain -->
                                </select>
                            </div>
                        </div>

                        {{-- Kota --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Kota</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="city">
                                    <option value="">Pilih kota Anda</option>
                                </select>
                            </div>
                        </div>

                        {{-- Jabatan --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="position" value="{{ old('position', $company->position) }}" placeholder="Jabatan atau posisi Anda di perusahaan">
                            </div>
                        </div>

                        {{-- Kewarganegaraan --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="nationality">
                                    <option value="">Pilih kewarganegaraan</option>
                                </select>
                            </div>
                        </div>

                        {{-- Bahasa Pilihan --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-semibold">Bahasa Pilihan</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="language">
                                    <option value="id" selected>Bahasa Indonesia</option>
                                    <option value="en">English</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold text-uppercase">Simpan Perubahan</button>
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
                    
                    <form action="{{ route('company.account-settings.update-account') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- perbarui email --}}
                        <h5 class="fw-bold mb-3">Perbarui Email</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Alamat email baru</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukkan alamat email baru">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold text-uppercase">UBAH ALAMAT EMAIL</button>
                            </div>
                        </div>

                        {{-- perbarui kata sandi --}}
                        <h5 class="fw-bold mb-3">Perbarui kata sandi</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Kata sandi baru</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukkan kata sandi baru">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Konfirmasi kata sandi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="konfirmasi kata sandi anda">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold text-uppercase">UBAH KATA SANDI</button>
                            </div>
                        </div>

                        {{-- perbarui WA --}}
                        <h5 class="fw-bold mb-3">Update Whatsapp Number</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Whatsapp Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukkan nomor whatsapp baru">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold text-uppercase">UPDATE & VERIFIKASI</button>
                            </div>
                        </div>
   
                    </form>
                </div>

                <!-- Akun Terhubung -->
                <div class="tab-pane fade" id="connected">
                    <b class="d-block mb-2">Akun Terhubung</b>
                    <p>Anda dapat masuk melalui salah satu akun terhubung yang tercantum di bawah ini.</p>

                    {{-- Akun yang sudah terhubung --}}
                    <div class="d-flex justify-content-around align-items-center mb-2">
                        <div>
                            <span class="fw-bold d-block">Nami Cat Burglar</span>
                            <span class="text-muted">namicatburglar0003@gmail.com</span>
                        </div>
                        <div class="text-primary fw-bold d-flex align-items-center" style="cursor:pointer;">
                            <span class="me-2">HAPUS</span>
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 100 100">
                                <path d="M100 10L90 0 50 40 10 0 0 10l40 40L0 90l10 10 40-40 40 40 10-10-40-40z"></path>
                            </svg>
                        </div>
                        <hr>
                    </div>

                    <hr> 

                    {{-- Pilihan hubungkan akun --}}
                    <div class="text-center mb-3 fw-bold">
                        Akun mana yang ingin Anda hubungkan?
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        {{-- Facebook --}}
                        <button class="btn text-white fw-bold" 
                                style="background-color:#405A93; padding:10px 30px; text-transform:uppercase;">
                            <i class="bi bi-facebook me-2"></i> Facebook
                        </button>

                        {{-- LinkedIn --}}
                        <button class="btn text-white fw-bold" 
                                style="background-color:#317AB0; padding:10px 30px; text-transform:uppercase;">
                            <i class="bi bi-linkedin me-2"></i> LinkedIn
                        </button>
                    </div>
                </div>


                <!-- Notifications -->
                <div class="tab-pane fade" id="notifications">
                    <h5 class="fw-bold">Notifikasi</h5>
                    <p>Pilih tipe notifikasi apa saja yang ingin Anda terima.</p>
                    <hr>

                    <!-- Notifikasi Email -->
                    <form method="POST" action="#">
                        @csrf
                        @method('PUT')
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
                                <input class="form-check-input" type="checkbox" id="email_application_notifications" name="email_application_notifications" value="1" checked>
                            </div>
                            <label for="email_application_notifications" class="m-0">Info Lamaran</label>
                        </div>

                        <!-- Tombol -->
                        <button type="submit" class="btn btn-secondary px-4" disabled>SIMPAN PERUBAHAN</button>
                    </form>

                    <hr>

                    <!-- Notifikasi WhatsApp -->
                    <form method="POST" action="#">
                        @csrf
                        @method('PUT')
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
                                <input class="form-check-input" type="checkbox" id="wa_application_notifications" name="wa_application_notifications" value="1" checked>
                            </div>
                            <label for="wa_application_notifications" class="m-0">Info Lamaran</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input" type="checkbox" id="wa_job_notifications" name="wa_job_notifications" value="1" checked>
                            </div>
                            <label for="wa_job_notifications" class="m-0">Info Lowongan</label>
                        </div>

                        <!-- Tombol -->
                        <button type="submit" class="btn btn-secondary px-4" disabled>SIMPAN PERUBAHAN</button>
                    </form>
                </div>


                <!-- Profil Perusahaan -->
                <div class="tab-pane fade" id="company-profile">
                    <h5 class="fw-bold mb-3">Perbarui Profil Perusahaan</h5>

                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                        <!-- Logo Perusahaan -->
                        <div class="d-flex align-items-center">
                            @if(Auth::guard('company')->user()->logo)
                                <img src="{{ asset('storage/' . Auth::guard('company')->user()->logo) }}"
                                    alt="{{ Auth::guard('company')->user()->name }}"
                                    class="rounded-circle border"
                                    style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                    style="width: 70px; height: 70px; font-size: 22px;">
                                    {{ Auth::guard('company')->user()->initials }}
                                </div>
                            @endif

                            <!-- Nama Perusahaan -->
                            <div class="ms-3">
                                <h6 class="fw-bold mb-0">{{ Auth::guard('company')->user()->name }}</h6>
                                <small class="text-muted">
                                    Terakhir diperbarui {{ \Carbon\Carbon::parse(Auth::guard('company')->user()->updated_at)->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>

                        <!-- Tombol Perbarui -->
                        <div>
                            <a href="{{ route('company.profile.edit') }}" class="btn btn-primary fw-bold px-4">
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
                                    {{-- @forelse($addresses as $address)
                                        <tr>
                                            <td>{{ $address->full_address }}</td>
                                            <td class="text-end">
                                                <form action="#" method="POST" onsubmit="return confirm('Yakin ingin menghapus alamat ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-3">
                                                Belum ada alamat kantor ditambahkan
                                            </td>
                                        </tr>
                                    @endforelse --}}
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
                    <button class="btn btn-primary fw-bold px-4 py-2">UBAH</button>
                </div>

                <!-- Bantuan & Dukungan -->
                <div class="tab-pane fade" id="support">
                    <h5 class="fw-bold mb-2">Bantuan & Dukungan</h5>
                    <p class="mb-3">Untuk bantuan mengenai akun Glints Anda, hubungi kami melalui tombol di bawah ini.</p>
            
                    <!-- Tombol -->
                    <button class="btn btn-primary fw-bold px-4 py-2">DAPATKAN BANTUAN</button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
