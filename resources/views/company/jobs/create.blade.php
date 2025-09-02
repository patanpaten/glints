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

            <div class="mb-3">
                <label class="form-label">Judul Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan judul pekerjaan" value="{{ old('title') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Kategori Pekerjaan <span class="text-danger">*</span></label>
                <select name="job_category_id" class="form-select" required>
                    <option value="">Pilih kategori</option>
                    @foreach($jobCategories as $category)
                        <option value="{{ $category->id }}" {{ old('job_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Deskripsi Pekerjaan</label>
                <textarea name="description" rows="5" class="form-control" placeholder="Tuliskan deskripsi pekerjaan" required>{{ old('description') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Kualifikasi</label>
                <textarea name="requirements" rows="4" class="form-control" placeholder="Tuliskan kualifikasi yang dibutuhkan">{{ old('requirements') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tanggung Jawab</label>
                <textarea name="responsibilities" rows="4" class="form-control" placeholder="Tuliskan tanggung jawab pekerjaan">{{ old('responsibilities') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" name="location" class="form-control" placeholder="Lokasi pekerjaan" value="{{ old('location') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jenis Pekerjaan</label>
                <select name="employment_type" class="form-select" required>
                    <option value="">Pilih jenis pekerjaan</option>
                    <option value="full-time" {{ old('employment_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part-time" {{ old('employment_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                    <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                    <option value="internship" {{ old('employment_type') == 'internship' ? 'selected' : '' }}>Magang</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tingkat Pengalaman</label>
                <select name="experience_level" class="form-select">
                    <option value="">Pilih tingkat pengalaman</option>
                    <option value="entry" {{ old('experience_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                    <option value="mid" {{ old('experience_level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                    <option value="senior" {{ old('experience_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tingkat Pendidikan</label>
                <input type="text" name="education_level" class="form-control" placeholder="Contoh: S1, S2" value="{{ old('education_level') }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Rentang Gaji</label>
                <input type="text" name="salary_range" class="form-control" placeholder="Contoh: 5.000.000 - 8.000.000" value="{{ old('salary_range') }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jumlah Lowongan</label>
                <input type="number" name="vacancies" class="form-control" placeholder="Jumlah posisi" min="1" value="{{ old('vacancies', 1) }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Batas Waktu Pendaftaran <span class="text-danger">*</span></label>
                <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}" min="{{ date('Y-m-d') }}" required>
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Aktif (Lowongan akan terlihat oleh pencari kerja)
                    </label>
                </div>
            </div>
            
            <button class="btn btn-success" type="submit" id="submitBtn">Simpan Lowongan</button>
            <a href="{{ route('company.dashboard') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
document.getElementById('jobForm').addEventListener('submit', function() {
    let btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = 'Menyimpan...';
});
</script>
@endsection
