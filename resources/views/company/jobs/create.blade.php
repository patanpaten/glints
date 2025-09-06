@extends('company.app')

@section('title', 'Buat Lowongan')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- CARD HEADER --}}
            <div class="card shadow mb-4">
                <div class="card-header text-center">
                    <div class="fw-bold mb-3">Pasang Loker</div>

                    {{-- STEP NAVIGATION --}}
                    <div class="d-flex justify-content-center">
                        <div class="d-flex align-items-center">
                            {{-- Step 1 --}}
                            <div class="d-flex align-items-center text-black">
                                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width:28px; height:28px;">
                                    1
                                </div>
                                <span class="ms-2">Info Loker</span>
                            </div>

                            {{-- Garis --}}
                            <div class="mx-3" style="width:60px; border-bottom:2px solid #ddd;"></div>

                            {{-- Step 2 --}}
                            <div class="d-flex align-items-center fw-reguler">
                                <div class="rounded-circle bg-light text-black d-flex justify-content-center align-items-center" style="width:28px; height:28px;">
                                    2
                                </div>
                                <span class="ms-1">Pertanyaan Skrining</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- VALIDASI ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('company.jobs.store') }}" method="POST" id="jobForm">
                @csrf

               {{-- DETAIL & KLASIFIKASI --}}
                <div class="row">
                    {{-- Detail & Jenis Pekerjaan --}}
                    <div class="col-md-8">
                        <div class="card shadow-sm mb-4 border-0">
                            <div class="card-header bg-white border-bottom-0">
                                <h6 class="fw-semibold mb-0">
                                    Detail & Jenis Pekerjaan <span class="text-danger">*</span>
                                </h6>
                            </div>
                            <hr class="my-3">
                            <div class="card-body">
                                {{-- Nama Loker --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Loker 
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" 
                                            height="18" width="18" fill="#017EB7">
                                            <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm0-2a8 8 0 1 0 0-16.001A8 8 0 0 0 12 20ZM11 7h2v2h-2V7Zm0 4h2v6h-2v-6Z"></path>
                                        </svg>
                                    </label>
                                    <div class="form-text">Ketik Nama Pekerjaan/Posisi</div>
                                    <input type="text" name="title" 
                                        class="form-control" 
                                        placeholder="Misal: Sales Manager" 
                                        value="{{ old('title') }}" required>
                                </div>

                                {{-- Bidang Kerja --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Bidang Kerja 
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" 
                                            height="18" width="18" fill="#017EB7">
                                            <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm0-2a8 8 0 1 0 0-16.001A8 8 0 0 0 12 20ZM11 7h2v2h-2V7Zm0 4h2v6h-2v-6Z"></path>
                                        </svg>
                                    </label>
                                    <div class="form-text">Pilih Bidang Kerja</div>
                                    <select name="job_category_id" class="form-select" required>
                                        <option value="">Pilih...</option>
                                        @foreach($jobCategories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('job_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Tipe Kerja --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tipe Kerja</label>
                                    <select name="employment_type" class="form-select" required>
                                        <option value="">Pilih tipe kerja</option>
                                        <option value="part-time" {{ old('employment_type') == 'part-time' ? 'selected' : '' }}>Paruh Waktu</option>
                                        <option value="internship" {{ old('employment_type') == 'internship' ? 'selected' : '' }}>Magang</option>
                                        <option value="freelance" {{ old('employment_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                        <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Klasifikasi Lowongan --}}
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white border-bottom">
                                <h6 class="fw-semibold mb-0 d-flex align-items-center">
                                    Klasifikasi Lowongan 
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" 
                                        height="18" width="18" fill="#017EB7">
                                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm0-2a8 8 0 1 0 0-16.001A8 8 0 0 0 12 20ZM11 7h2v2h-2V7Zm0 4h2v6h-2v-6Z"></path>
                                    </svg>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Bidang Kerja</p>
                                    <p class="text-dark mb-0 fw-normal" id="kategoriRealtime">-</p>
                                </div>

                                <div class="mb-3">
                                    <p class="text-muted mb-1">Lokasi</p>
                                    <p class="text-dark mb-0 fw-normal" id="lokasiRealtime">-</p>
                                </div>

                                <hr class="my-3">

                                <div>
                                    <p class="text-muted mb-1">Klasifikasi</p>
                                    <p class="text-dark mb-0 fw-normal" id="klasifikasiRealtime">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- LOKASI --}}
                <div class="card shadow mb-3 col-md-8">
                    <div class="card-body border-bottom pb-3 mb-3">
                        <h6 class="fw-semibold mb-3">Lokasi<span class="text-danger">*</span></h6>
                        <hr class="my-3">
                        <label class="form-label fw-semibold">Sistem Kerja</label>
                        <div class="d-flex gap-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="work_system" value="onsite" {{ old('work_system') == 'onsite' ? 'checked' : '' }}>
                                <label class="form-check-label">Di Kantor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="work_system" value="remote" {{ old('work_system') == 'remote' ? 'checked' : '' }}>
                                <label class="form-check-label">Remote / Dari Rumah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="work_system" value="hybrid" {{ old('work_system') == 'hybrid' ? 'checked' : '' }}>
                                <label class="form-check-label">Hibrid</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Lokasi</label>
                            <div>Negara</div>
                            <select name="country" class="form-select">
                                <option value="">Pilih negara</option>
                                <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                <option value="Singapore" {{ old('country') == 'Singapore' ? 'selected' : '' }}>Singapura</option>
                                <option value="Philippines" {{ old('country') == 'Philippines' ? 'selected' : '' }}>Filipina</option>
                                <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div>Alamat Kantor</div>
                            <input type="text" name="office_address" class="form-control" placeholder="Masukkan alamat kantor" value="{{ old('office_address') }}">
                            <div class="form-text">Lowonganmu akan muncul saat kandidat mencari kerja di kota atau provinsimu.</div>
                        </div>

                                {{-- GLINTS VIP --}}
                            <div class="border border-warning p-3 rounded ">
                                <span class="d-inline-flex align-items-center gap-1 bg-warning text-dark fw-semibold px-2 py-1 rounded">
                                    <img src="{{ asset('images/glints-vip-icon.svg') }}" alt="Glints VIP" width="14" height="14">
                                    GLINTS VIP
                                </span>

                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="glintsVipLocation" 
                                        name="vip_location" value="1">
                                    <label class="form-check-label fw-semibold" for="glintsVipLocation">
                                        Pelamar wajib punya info domisili
                                    </label>
                                </div>

                                <div class="form-text">
                                    Beli Glints VIP untuk menggunakan fitur ini. 
                                    <a href="#" class="text-primary">Upgrade ke VIP</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="card mb-4 shadow-sm description-card col-md-8">
                    <div class="card-body col-md-8">
                        {{-- Header --}}
                        <div class="d-flex mb-2">
                            <h6 class="fw-semibold mb-0">Deskripsi Pekerjaan</h6>
                            <span class="text-danger ms-1">*</span>
                        </div>

                        {{-- Helper text --}}
                        <div class="form-text mb-3" style="font-size: 0.9rem;">
                            • Bingung menulis apa? 
                            <a href="#" class="text-primary text-decoration-none">Gunakan template</a><br>
                            • Dengan melanjutkan memposting lowongan ini, Anda menyatakan telah membaca 
                            dan menyetujui 
                            <a href="#" class="text-primary text-decoration-none">Ketentuan Lowongan Kerja</a>.
                        </div>

                        <hr class="my-3">

                        {{-- Toolbar --}}
                        <div class="d-flex gap-2 mb-2">
                            <button type="button" class="btn btn-sm border bg-white" title="Bold">
                                <i class="fas fa-bold"></i>
                            </button>
                            <button type="button" class="btn btn-sm border bg-white" title="Italic">
                                <i class="fas fa-italic"></i>
                            </button>
                            <button type="button" class="btn btn-sm border bg-white" title="Bullet List">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <button type="button" class="btn btn-sm border bg-white" title="Numbered List">
                                <i class="fas fa-list-ol"></i>
                            </button>
                        </div>

                        {{-- Textarea --}}
                        <textarea name="description" rows="6" class="form-control" 
                                placeholder="Jelaskan tanggung jawab pekerjaan ini (min 5 karakter)" 
                                required>{{ old('description') }}</textarea>
                    </div>
                </div>

<style>
    .description-card {
        max-width: 800px;   /* ukuran lebar card */
        margin: 0 auto;     /* center di tengah */
        border-radius: 12px; /* biar halus */
    }
    .description-card .card-body {
        padding: 24px; /* lebih lega */
    }
    .description-card .btn-sm {
        padding: 4px 8px;
        line-height: 1;
        border-radius: 4px;
    }
    .description-card .btn-sm:hover {
        background-color: #f8f9fa;
    }
    textarea[name="description"] {
        font-size: 0.95rem;
        background-color: #fff;
        resize: vertical;
    }
</style>


               {{-- GAJI --}}
<div class="card shadow-sm mb-3 col-md-8">
    <div class="card-body p-3">
        {{-- Header --}}
        <h6 class="fw-semibold mb-2">
            Gaji <span class="text-danger">*</span>
        </h6>
        <p class="text-muted small mb-3">
            Dengan menyertakan kisaran gaji yang jelas di lowongan pekerjaan Anda, Anda menarik kandidat yang sesuai dengan harapan Anda dan menyederhanakan proses perekrutan.
        </p>
        <hr class="my-2">

        {{-- Gaji Minimum & Maksimum --}}
        <div class="d-flex align-items-end gap-4 flex-wrap mb-3">
            <div style="width:160px">
                <label class="form-label fw-semibold mb-1">Jumlah Minimum</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" 
                           name="salary_min" 
                           class="form-control" 
                           value="{{ old('salary_min') }}" 
                           placeholder="0">
                </div>
            </div>

            <div class="text-muted small mb-2">hingga</div>

            <div style="width:160px">
                <label class="form-label fw-semibold mb-1">Jumlah Maksimum</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" 
                           name="salary_max" 
                           class="form-control" 
                           value="{{ old('salary_max') }}" 
                           placeholder="0">
                </div>
            </div>
        </div>

        {{-- Bonus --}}
        <div class="form-label fw-semibold mb-1">Bonus</div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="addBonus" name="bonus" value="1">
            <label class="form-check-label fw-semibold" for="addBonus">
                Tambahkan Bonus
            </label>
        </div>

        {{-- GLINTS VIP --}}
                            <div class="border border-warning p-3 rounded ">
                                <span class="d-inline-flex align-items-center gap-1 bg-warning text-dark fw-semibold px-2 py-1 rounded">
                                    <img src="{{ asset('images/glints-vip-icon.svg') }}" alt="Glints VIP" width="14" height="14">
                                    GLINTS VIP
                                </span>

                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="glintsVipLocation" 
                                        name="vip_location" value="1">
                                    <label class="form-check-label fw-semibold" for="glintsVipLocation">
                                        Tidak menampilkan gaji di lowongan
                                    </label>
                                </div>

                                <div class="form-text">
                                    Beli Glints VIP untuk menggunakan fitur ini. 
                                    <a href="#" class="text-primary">Upgrade ke VIP</a>
                                </div>
                            </div>
        </div>
    </div>
</div>

<style>
    .input-group-text {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .form-check-label {
        cursor: pointer;
    }
    .card-body {
        padding: 1.25rem !important; /* sedikit lebih besar dari sebelumnya */
    }
</style>


                {{-- PERSYARATAN --}}
<div class="card shadow-sm mb-4 col-md-8">
    <div class="card-body p-3">

        <h6 class="fw-semibold mb-3">Persyaratan Kerja <span class="text-danger">*</span></h6>
        <hr class="my-2">

        {{-- Jenis Kelamin --}}
        <label class="form-label fw-semibold">Jenis Kelamin</label>
        <div class="d-flex gap-4 mb-3">
            <div class="form-check">
                <input type="radio" name="gender" value="male" class="form-check-input" id="genderMale">
                <label for="genderMale" class="form-check-label">Laki-laki</label>
            </div>
            <div class="form-check">
                <input type="radio" name="gender" value="female" class="form-check-input" id="genderFemale">
                <label for="genderFemale" class="form-check-label">Perempuan</label>
            </div>
            <div class="form-check">
                <input type="radio" name="gender" value="any" class="form-check-input" id="genderAny" checked>
                <label for="genderAny" class="form-check-label">Tanpa Preferensi</label>
            </div>
        </div>

        {{-- Usia --}}
        <label class="form-label fw-semibold">Usia</label>
        <div class="d-flex align-items-end gap-3 flex-wrap mb-2">
            <div style="width:160px">
                <div class="small text-muted">Min</div>
                <input type="number" name="age_min" class="form-control form-control-sm"
                       placeholder="18" value="{{ old('age_min') }}">
            </div>
            <span class="text-muted small">hingga</span>
            <div style="width:160px">
                <div class="small text-muted">Maks</div>
                <input type="number" name="age_max" class="form-control form-control-sm"
                       placeholder="65" value="{{ old('age_max') }}">
            </div>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="noAgeLimit" name="no_age_limit" value="1">
            <label class="form-check-label" for="noAgeLimit">Tidak ada batasan umur</label>
        </div>

        {{-- Skill --}}
        <div class="mb-3">
            <div class="form-label fw-semibold">Skill Wajib Diisi <small class="text-muted">(maksimal 20)</small></div>
            <input type="text" name="skills" class="form-control form-control-sm"
                   placeholder="Cari Skill" value="{{ old('skills') }}">
        </div>

        {{-- Pendidikan --}}
        <div class="mb-3">
            <div class="form-label fw-semibold">Pendidikan Minimal yang Dibutuhkan</div>
            <select name="education_level" class="form-select form-select-sm">
                <option value="">Belum dipilih</option>
                <option value="sd">SD</option>
                <option value="smp">SMP</option>
                <option value="sma">SMA/SMK</option>
                <option value="diploma">Diploma</option>
            </select>
        </div>

         {{-- GLINTS VIP --}}
                            <div class="border border-warning p-3 rounded ">
                                <span class="d-inline-flex align-items-center gap-1 bg-warning text-dark fw-semibold px-2 py-1 rounded">
                                    <img src="{{ asset('images/glints-vip-icon.svg') }}" alt="Glints VIP" width="14" height="14">
                                    GLINTS VIP
                                </span>

                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="glintsVipLocation" 
                                        name="vip_location" value="1">
                                    <label class="form-check-label fw-semibold" for="glintsVipLocation">
                                        Pelamar wajib memiliki tingkat pendidikan
                                    </label>
                                </div>

                                <div class="form-text">
                                    Beli Glints VIP untuk menggunakan fitur ini. 
                                    <a href="#" class="text-primary">Upgrade ke VIP</a>
                                </div>
                            </div>

        {{-- Pengalaman --}}
        <div class="mb-2">
            <div class="form-label fw-semibold">Pengalaman Kerja yang Dibutuhkan</div>
            <select name="experience_level" class="form-select form-select-sm">
                <option value="">Belum dipilih</option>
                <option value="lt1">Kurang dari 1 tahun</option>
                <option value="1-3">1 sampai 3 tahun</option>
                <option value="3-5">3 sampai 5 tahun</option>
                <option value="5-10">5 sampai 10 tahun</option>
            </select>
        </div>

    </div>
</div>

<style>
    .form-check-label { cursor: pointer; }
    .card-body { font-size: 14px; color: #2D2D2D; }
    .form-label { font-size: 14px; }
    .form-text, small { font-size: 12px; color: #666; }
</style>


                {{-- PERSYARATAN WAJIB TAMBAHAN --}}
                <div class="card shadow mb-4 col-md-8">
                    <div class="card-body border-bottom pb-3 mb-3">
                        <h6 class="fw-semibold mb-3">Persyaratan Wajib Tambahan<span class="text-danger">*</span></h6>
                        <div class="form-text mb-3">Pelamar akan diwajibkan memiliki persyaratan ini ketika melamar.</div>
                        <hr>
                        {{-- GLINTS VIP --}}
                            <div class="border border-warning p-3 rounded ">
                                <span class="d-inline-flex align-items-center gap-1 bg-warning text-dark fw-semibold px-2 py-1 rounded">
                                    <img src="{{ asset('images/glints-vip-icon.svg') }}" alt="Glints VIP" width="14" height="14">
                                    GLINTS VIP
                                </span>

                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="glintsVipLocation" 
                                        name="vip_location" value="1">
                                    <label class="form-check-label fw-semibold" for="glintsVipLocation">
                                        Wajib memiliki foto profil
                                    </label>
                                </div>

                                <div class="form-text">
                                    Beli Glints VIP untuk menggunakan fitur ini. 
                                    <a href="#" class="text-primary">Upgrade ke VIP</a>
                                </div>
                            </div>
                        {{-- GLINTS VIP --}}
                            <div class="border border-warning p-3 rounded ">
                                <span class="d-inline-flex align-items-center gap-1 bg-warning text-dark fw-semibold px-2 py-1 rounded">
                                    <img src="{{ asset('images/glints-vip-icon.svg') }}" alt="Glints VIP" width="14" height="14">
                                    GLINTS VIP
                                </span>

                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="glintsVipLocation" 
                                        name="vip_location" value="1">
                                    <label class="form-check-label fw-semibold" for="glintsVipLocation">
                                        Pelamar wajib punya CV
                                    </label>
                                </div>

                                <div class="form-text">
                                    Beli Glints VIP untuk menggunakan fitur ini. 
                                    <a href="#" class="text-primary">Upgrade ke VIP</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4 col-md-8">
  <div class="card-body p-3 d-flex justify-content-between align-items-start">
    <div>
      <p class="fw-semibold mb-2 text-dark" style="font-size: 15px;">Tentang loker ini</p>
      <ul class="mb-0 ps-3 text-secondary" style="font-size: 14px;">
        <li>
          Memakai 1 job slot saya 
          <span class="text-muted">(Job slot tersedia: 5)</span>
        </li>
        <li>
          Dapat dinonaktifkan kapan saja untuk mengembalikan slot yang dipakai
        </li>
      </ul>
    </div>
    <img src="{{ asset('images/thumbs-up.png') }}" 
         alt="Thumbs Up" 
         class="ms-3" 
         style="max-width: 80px; height: auto;">
  </div>
</div>


<style>
  .card-body p { margin-bottom: 6px; }
  .card-body ul li { margin-bottom: 4px; }
</style>


                {{-- FOOTER FIXED --}}
                <div class="fixed-bottom bg-white border-top p-3 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold">Status:</span> Draft<br>
                            <small class="text-muted">Otomatis disimpan dalam DRAFT: {{ now()->diffForHumans() }}</small>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-secondary" type="button" disabled>Pratinjau</button>
                            <button class="btn btn-secondary" type="button" disabled>Sebelumnya</button>
                            <button class="btn btn-primary" type="submit">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Bidang Kerja
    const kategoriSelect = document.querySelector("select[name='job_category_id']");
    const kategoriRealtime = document.getElementById("kategoriRealtime");
    if (kategoriSelect && kategoriRealtime) {
        kategoriSelect.addEventListener("change", function () {
            kategoriRealtime.textContent = this.options[this.selectedIndex].text || "-";
        });
    }

    // Lokasi (contoh: ada input lokasi)
    const lokasiInput = document.querySelector("input[name='location']");
    const lokasiRealtime = document.getElementById("lokasiRealtime");
    if (lokasiInput && lokasiRealtime) {
        lokasiInput.addEventListener("input", function () {
            lokasiRealtime.textContent = this.value || "-";
        });
    }

    // Klasifikasi (bisa ambil dari tipe kerja / employment_type)
    const klasifikasiSelect = document.querySelector("select[name='employment_type']");
    const klasifikasiRealtime = document.getElementById("klasifikasiRealtime");
    if (klasifikasiSelect && klasifikasiRealtime) {
        klasifikasiSelect.addEventListener("change", function () {
            klasifikasiRealtime.textContent = this.options[this.selectedIndex].text || "-";
        });
    }
});
</script>

@endsection
