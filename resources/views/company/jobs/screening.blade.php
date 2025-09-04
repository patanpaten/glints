@extends('company.app')

@section('title', 'Pertanyaan Skrining')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <div class="fw-bold mb-3">Pasang Loker</div>

        {{-- STEP NAVIGATION --}}
        <div class="d-flex justify-content-center">
            <div class="d-flex align-items-center">

                {{-- Step 1 (Done) --}}
                <div class="d-flex align-items-center text-success">
                    <div class="rounded-circle bg-success text-white d-flex justify-content-center align-items-center" style="width:28px; height:28px;">
                        ✓
                    </div>
                    <span class="ms-2">Info Loker</span>
                </div>

                {{-- Garis Penghubung --}}
                <div class="mx-3" style="width:60px; border-bottom:2px solid #ddd;"></div>

                {{-- Step 2 (Active) --}}
                <div class="d-flex align-items-center fw-bold text-primary">
                    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width:28px; height:28px;">
                        2
                    </div>
                    <span class="ms-2">Pertanyaan Skrining</span>
                </div>

            </div>
        </div>
    </div>

    <div class="card-body">

        {{-- FORM PERTANYAAN SKRINING --}}
        <form action="{{ route('company.jobs.screening.store', $job->id) }}" method="POST">
            @csrf

            {{-- BOX PERTANYAAN --}}
            <div class="border rounded p-3 mb-4 bg-light">
                <span class="badge bg-warning text-dark mb-2">GLINTS VIP</span>
                <h5 class="fw-bold">Pertanyaan Skrining</h5>
                <p class="text-muted">Pilih pertanyaan untuk mengevaluasi pelamar selama proses penyaringan.</p>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tambah Pertanyaan</label> <br>
                    <p class="text-muted">0/9 pertanyaan ditambahkan</p>
                    <select name="type" class="form-select" required>
                        <option value="">Pilih jenis</option>
                        <option value="skill">Keahlian</option>
                        <option value="experience">Pengalaman Kerja</option>
                        <option value="industry">Pengalaman di Industri</option>
                        <option value="location">Lokasi</option>
                        <option value="document">Dokumen / Sertifikat</option>
                        <option value="policy">Kebijakan Kerja</option>
                        <option value="custom">Pertanyaan Kustom</option>
                    </select>
                </div>


                <div class="alert alert-secondary mt-3 mb-0">
                    <i class="bi bi-info-circle"></i>
                    (i) Pertanyaan skrining tidak dapat diubah setelah lowongan diposting.
                    Ini memastikan semua pelamar akan menerima pertanyaan yang sama.
                </div>
            </div>

            {{-- STATUS --}}
            <div class="mb-3">
                <p class="mb-0 fw-bold">Status:
                    <span class="text-warning">{{ $job->is_active ? 'Aktif' : 'Draft' }}</span>
                </p>
                <small class="text-muted">Otomatis disimpan dalam DRAFT: {{ $job->updated_at->diffForHumans() }}</small>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="#" class="btn btn-outline-secondary">Pratinjau</a>
                <a href="#" class="btn btn-outline-secondary">Sebelumnya</a>
                <button type="submit" class="btn btn-primary">Pasang Loker</button>
            </div>
        </form>
    </div>
</div>
@endsection
