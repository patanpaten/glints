@extends('company.app')

@section('title', 'Applications')

@section('content')
<div class="card border-0 shadow-sm">
    {{-- Menu Utama --}}
    <div class="card-header bg-white border-0 pb-0">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active fw-semibold bg-primary text-white rounded-3" href="#">
                    Semua Kandidat
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        {{-- Sub Judul Navigasi --}}
        <ul class="nav nav-tabs border-0 mb-3">
            <li class="nav-item">
                <a class="nav-link active border-0 border-bottom border-primary text-primary fw-semibold" href="#">
                    Chat Dimulai <span class="badge bg-light text-secondary ms-1">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-0 border-bottom text-secondary" href="#">
                    Terhubung <span class="badge bg-light text-secondary ms-1">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary border-0 border-bottom" href="#">
                    Skill & Psikotes <span class="badge bg-light text-secondary ms-1">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary border-0 border-bottom" href="#">
                    Wawancara <span class="badge bg-light text-secondary ms-1">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary border-0 border-bottom" href="#">
                    Negosiasi <span class="badge bg-light text-secondary ms-1">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary border-0 border-bottom" href="#">
                    Direkrut <span class="badge bg-light text-secondary ms-1">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary border-0 border-bottom" href="#">
                    Belum Sesuai <span class="badge bg-light text-secondary ms-1">0</span>
                </a>
            </li>
        </ul>

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="flex-grow-1 me-2">
                <input type="text" class="form-control" 
                    placeholder="Cari dengan nama atau posisi di tahap: Chat Dimulai">
            </div>
            <div class="d-flex gap-2">
                {{-- Tombol hanya untuk VIP --}}
                <button class="btn btn-outline-secondary" disabled>
                    <i class="fas fa-question-circle me-1"></i> Pertanyaan Skrining
                    <span class="badge bg-dark text-warning ms-1">VIP</span>
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fas fa-sort me-1"></i> Urutkan: Baru ke Lama
                </button>
            </div>
        </div>

        {{-- Tabel Kandidat --}}
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th class="fw-semibold">Nama & Domisili</th>
                    <th class="fw-semibold">WhatsApp</th>
                    <th class="fw-semibold">Pengalaman</th>
                    <th class="fw-semibold">Pengalaman Kerja</th>
                    <th class="fw-semibold">Pendidikan</th>
                    <th class="fw-semibold">Tanggal Melamar</th>
                    <th class="fw-semibold">Jenis Kelamin</th>
                    <th class="fw-semibold">Terakhir Aktif</th>
                    <th class="fw-semibold">Tindakan</th>
                </tr>

            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->jobSeeker->name }}</td>
                        <td>{{ $application->jobSeeker->phone ?? '-' }}</td>
                        <td>{{ $application->jobSeeker->experience ?? '-' }}</td>
                        <td>{{ $application->jobSeeker->work_experience ?? '-' }}</td>
                        <td>{{ $application->jobSeeker->education ?? '-' }}</td>
                        <td>{{ $application->created_at->format('d M Y') }}</td>
                        <td>{{ $application->jobSeeker->gender ?? '-' }}</td>
                        <td>{{ $application->jobSeeker->last_active ?? '-' }}</td>
                        <td>
                            <a href="{{ route('company.applications.show', $application->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="text-center mt-4 p-5 border-0 bg-white">
                                <img src="{{ asset('images/empety.gif') }}" 
                                    alt="Empty" style="max-width:150px;" class="mb-3">
                                <h5 class="fw-semibold">Belum ada pelamar di tahap skill & psikotes</h5>
                                <p class="text-muted mb-1">
                                    Pelamar yang ada di tahap skill & psikotes akan ditampilkan di sini
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Keterangan tambahan di luar card --}}
<div class="text-center mt-3">
    <small class="text-muted">
        Anda hanya dapat melihat lamaran yang diterima dalam 90 hari terakhir.
    </small>
</div>
@endsection
