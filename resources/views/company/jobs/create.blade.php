@extends('company.app')

@section('title', 'Buat Lowongan')

@section('content')
<div class="card">
    <div class="card-header fw-bold">Buat Lowongan Baru</div>
    <div class="card-body">
        {{-- Validasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('company.jobs.store') }}" method="POST" id="jobForm">
            @csrf

            {{-- DETAIL & JENIS PEKERJAAN --}}
            <h5 class="fw-bold mb-3">Detail & Jenis Pekerjaan</h5>

            <div class="mb-3">
                <label class="form-label">Nama Lowongan / Posisi <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="Ketik nama pekerjaan/posisi" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Bidang Kerja <span class="text-danger">*</span></label>
                <select name="job_category_id" class="form-select" required>
                    <option value="">Pilih bidang kerja</option>
                    @foreach($jobCategories as $category)
                        <option value="{{ $category->id }}" {{ old('job_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipe Kerja</label>
                <select name="employment_type" class="form-select" required>
                    <option value="">Pilih tipe kerja</option>
                    <option value="part-time" {{ old('employment_type') == 'part-time' ? 'selected' : '' }}>Paruh Waktu</option>
                    <option value="internship" {{ old('employment_type') == 'internship' ? 'selected' : '' }}>Magang</option>
                    <option value="freelance" {{ old('employment_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                </select>
            </div>

            {{-- SEBELAHNYA: KLASIFIKASI LOWONGAN --}}
            <h6 class="fw-bold mt-4">Klasifikasi Lowongan</h6>
            <div class="row">
                <div class="col-md-4">Bidang Kerja: <span class="text-muted">-</span></div>
                <div class="col-md-4">Lokasi: <span class="text-muted">-</span></div>
                <div class="col-md-4">Klasifikasi: <span class="text-muted">-</span></div>
            </div>

            {{-- SISTEM KERJA --}}
            <div class="mt-4">
                <label class="form-label fw-bold">Sistem Kerja</label>
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

            <div class="mb-3 mt-3">
                <label class="form-label">Lokasi (Negara)</label>
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
                <label class="form-label">Alamat Kantor</label>
                <input type="text" name="office_address" class="form-control" placeholder="Masukkan alamat kantor" value="{{ old('office_address') }}">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="glintsVipLocation" name="vip_location" value="1">
                <label class="form-check-label" for="glintsVipLocation">Pelamar wajib punya info domisili</label>
                <div class="form-text">Beli Glints VIP untuk menggunakan fitur ini. Upgrade ke VIP.</div>
            </div>

            {{-- DESKRIPSI PEKERJAAN --}}
            <h5 class="fw-bold mt-4">Deskripsi Pekerjaan</h5>
            <textarea name="description" rows="5" class="form-control" placeholder="Tuliskan deskripsi pekerjaan" required>{{ old('description') }}</textarea>

            {{-- GAJI --}}
            <h5 class="fw-bold mt-4">Gaji</h5>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Jumlah Minimum</label>
                    <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jumlah Maksimum</label>
                    <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max') }}">
                </div>
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="bonus" value="1">
                <label class="form-check-label">Tambah Bonus</label>
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="hide_salary" value="1">
                <label class="form-check-label">Tidak menampilkan gaji di lowongan</label>
                <div class="form-text">Beli Glints VIP untuk menggunakan fitur ini. Upgrade ke VIP.</div>
            </div>

            {{-- PERSYARATAN KERJA --}}
            <h5 class="fw-bold mt-4">Persyaratan Kerja</h5>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input type="radio" name="gender" value="male" class="form-check-input"> Laki-laki
                </div>
                <div class="form-check">
                    <input type="radio" name="gender" value="female" class="form-check-input"> Perempuan
                </div>
                <div class="form-check">
                    <input type="radio" name="gender" value="any" class="form-check-input" checked> Tanpa Preferensi
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Usia</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="number" name="age_min" class="form-control" placeholder="Min" value="{{ old('age_min') }}">
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="age_max" class="form-control" placeholder="Maks" value="{{ old('age_max') }}">
                    </div>
                </div>
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" name="no_age_limit" value="1">
                    <label class="form-check-label">Tidak ada batasan umur</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Skill wajib diisi (maksimal 20)</label>
                <input type="text" name="skills" class="form-control" value="{{ old('skills') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Pendidikan minimal yang dibutuhkan</label>
                <select name="education_level" class="form-select">
                    <option value="">Pilih pendidikan</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA/SMK</option>
                    <option value="diploma">Diploma</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="glintsVipEducation" name="vip_education" value="1">
                <label class="form-check-label" for="glintsVipEducation">Pelamar wajib memiliki tingkat pendidikan</label>
                <div class="form-text">
                    • Pelamar akan diwajibkan memiliki informasi ini ketika melamar.<br>
                    • Pelamar akan menerima peringatan saat melamar jika informasi mereka tidak sesuai.<br>
                    • Tidak bisa diubah setelah lowongan diposting.
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Pengalaman kerja yang dibutuhkan</label>
                <select name="experience_level" class="form-select">
                    <option value="">Pilih pengalaman</option>
                    <option value="lt1">Kurang dari 1 tahun</option>
                    <option value="1-3">1 sampai 3 tahun</option>
                    <option value="3-5">3 sampai 5 tahun</option>
                    <option value="5-10">5 sampai 10 tahun</option>
                </select>
            </div>

            <h6 class="fw-bold mt-3">Persyaratan Wajib Tambahan</h6>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="requirePhoto" name="require_photo" value="1">
                <label class="form-check-label" for="requirePhoto">Wajib memiliki foto profil</label>
                <div class="form-text">• Pelamar wajib memiliki foto profil saat melamar, tidak bisa diubah setelah diposting.</div>
            </div>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="requireCV" name="require_cv" value="1">
                <label class="form-check-label" for="requireCV">Pelamar wajib punya CV</label>
                <div class="form-text">• Pelamar wajib memiliki informasi ini saat melamar, tidak bisa diubah setelah diposting.</div>
            </div>

            {{-- TENTANG LOKER --}}
            <h5 class="fw-bold mt-4">Tentang Loker Ini</h5>
            <ul>
                <li>Memakai 1 job slot saya (Job slot tersedia: 0)</li>
                <li>Dapat dinonaktifkan kapan saja untuk mengembalikan slot yang dipakai</li>
            </ul>

            {{-- STATUS --}}
            <div class="mt-3">
                <span class="fw-bold">Status:</span> Draft<br>
                <small class="text-muted">Otomatis disimpan dalam draft: {{ now()->diffForHumans() }}</small>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary" type="button" disabled >Pratinjau</button>
                <button class="btn btn-secondary" type="button" disabled>Sebelumnya</button>
                <button class="btn btn-success" type="submit" id="previewBtn" >Selanjutnya</button>
            </div>
        </form>
    </div>
</div>
@endsection
