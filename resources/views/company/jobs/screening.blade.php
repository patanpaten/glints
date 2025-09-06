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
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-success text-white d-flex justify-content-center align-items-center" style="width:28px; height:28px;">
                        ✓
                    </div>
                    <span class="ms-2">Info Loker</span>
                </div>

                {{-- Garis Penghubung --}}
                <div class="mx-3" style="width:60px; border-bottom:2px solid #ddd;"></div>

                {{-- Step 2 (Active) --}}
                <div class="d-flex align-items-center fw-bold">
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



 {{-- FOOTER FIXED --}}
                <div class="fixed-bottom bg-white border-top p-3 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
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

            </div>
                </div>
        </form>
    </div>
</div>
@endsection
