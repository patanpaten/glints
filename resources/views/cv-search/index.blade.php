@extends('company.app')

@section('title', 'Cari CV')

@section('content')
<div class="container-fluid py-4">

    <!-- Header + Tabs in Card -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body p-0">
            
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
                <h4 class="fw-bold mb-0">Cari CV</h4>
            </div>

            <!-- Tabs -->
<ul class="nav nav-tabs px-3 border-bottom">
    <!-- Cari Kandidat -->
    <li class="nav-item">
        <a class="nav-link active d-flex align-items-center gap-2" href="#">
            <i class="fas fa-search"></i>
            <span>Cari Kandidat</span>
        </a>
    </li>

    <!-- Kandidat Disimpan -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="#">
            <i class="fas fa-bookmark"></i>
            <span>Kandidat Disimpan</span>
            <span class="badge rounded-pill bg-light text-muted border">1</span>
        </a>
    </li>

    <!-- Kandidat Dibuka -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="#">
            <i class="fas fa-lock-open"></i>
            <span>Kandidat Dibuka</span>
            <span class="badge rounded-pill bg-light text-muted border">0</span>
        </a>
    </li>
</ul>

<style>
    .nav-tabs .nav-link {
        color: #6c757d; /* abu default */
        border: none;
        padding: 8px 16px;
    }

    .nav-tabs .nav-link:hover {
        color: #0d6efd;
        background-color: transparent;
    }

    .nav-tabs .nav-link.active {
        color: #0d6efd;
        font-weight: 600;
        border: none;
        border-bottom: 3px solid #0d6efd; /* garis biru bawah */
        background-color: transparent;
    }

    .nav-tabs .badge {
        font-size: 12px;
        font-weight: 500;
    }
</style>


        </div>
    </div>



    <!-- Search Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Saldo Cari CV -->
            <div class="d-flex justify-content-end mb-2">
                <span class="badge bg-light text-dark">
                    <i class="fas fa-search me-1 text-primary"></i> 
                    Saldo Cari CV: <span class="fw-bold text-primary">0</span>
                </span>
            </div>

            <!-- Form -->
            <form method="GET" action="{{ route('company.cv-search.index') }}">
                
            <div class="input-group mb-3" style="max-width: 550px; border: 1px solid #ced4da; border-radius: .375rem; overflow: hidden;">
                <span class="input-group-text bg-white border-0 pe-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="keyword" class="form-control border-0 shadow-none"
                    placeholder="Cari"
                    value="{{ request('keyword') }}">
            </div>


                <!-- Filter Row -->
                <div class="row g-2 align-items-center">

                    <!-- Total Pengalaman -->
                    <div class="col-md-2">
                        <select name="experience" class="form-select">
                            <option value="0-3">Kurang dari setahun</option>
                            <option value="0-3">1 sampai 3 Tahun</option>
                            <option value="3-5">3 sampai 5 Tahun</option>
                            <option value="5-10">5 sampai 10 Tahun</option>
                            <option value="10+">10 Tahun +</option>
                            <option value="0-3">Tanpa Preferensi</option>
                        </select>
                    </div>

                    <!-- Domisili -->
                    <div class="col-md-2">
                        <select name="location" class="form-select">
                            <option value="">Domisili Saat Ini</option>
                            <option value="Jakarta" {{ request('location')=='Jakarta'?'selected':'' }}>Jakarta</option>
                            <option value="Bandung" {{ request('location')=='Bandung'?'selected':'' }}>Bandung</option>
                            <option value="Sleman" {{ request('location')=='Sleman'?'selected':'' }}>Sleman</option>
                        </select>
                    </div>

                    <!-- Pendidikan -->
                    <div class="col-md-2">
                        <select name="education" class="form-select">
                            <option value="">Tingkat Pendidikan</option>
                            <option value="SD" {{ request('education')=='SD'?'selected':'' }}>SD</option>
                            <option value="SMP" {{ request('education')=='SMP'?'selected':'' }}>SMP</option>
                            <option value="SMA/SMK" {{ request('education')=='SMA/SMK'?'selected':'' }}>SMA/SMK</option>
                            <option value="Diploma" {{ request('education')=='Diploma'?'selected':'' }}>Diploma</option>
                            <option value="S1" {{ request('education')=='S1'?'selected':'' }}>S1</option>
                            <option value="S2" {{ request('education')=='S2'?'selected':'' }}>S2</option>
                            <option value="S3" {{ request('education')=='S3'?'selected':'' }}>S3</option>
                        </select>
                    </div>

                    <!-- Semua Filter -->
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-sliders-h me-1"></i> Semua Filter
                        </button>
                    </div>

                    <!-- Urutkan -->
                    <div class="col-md-2 ms-auto">
                        <select name="sort" class="form-select">
                            <option value="relevance" {{ request('sort')=='relevance'?'selected':'' }}>Paling Relevan</option>
                            <option value="recent" {{ request('sort')=='recent'?'selected':'' }}>Terbaru</option>
                        </select>
                    </div>

                </div>
            </form>
        </div>
    </div>



    

    <!-- Search Results -->
    @if(isset($candidates) && $candidates->count() > 0)
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">CV</th>
                            <th scope="col">Terakhir Mengakses</th>
                            <th scope="col">Total Pengalaman</th>
                            <th scope="col">Domisili Saat Ini</th>
                            <th scope="col">Pekerjaan Saat Ini</th>
                            <th scope="col">Pendidikan Terakhir</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($candidates as $candidate)
                            <tr>
                                <!-- Foto -->
                                <td>
                                    <img src="{{ $candidate->photo_url ?? asset('images/default-avatar.png') }}"
                                        class="rounded-circle me-2"
                                        alt="Foto Kandidat"
                                        width="40" height="40">
                                </td>

                                <!-- Terakhir akses -->
                                <td>{{ $candidate->last_access->diffForHumans() }}</td>

                                <!-- Pengalaman -->
                                <td>{{ $candidate->experience ?? '-' }}</td>

                                <!-- Domisili -->
                                <td>{{ $candidate->location ?? '-' }}</td>

                                <!-- Pekerjaan -->
                                <td>
                                    <div>{{ $candidate->current_job_title ?? '-' }}</div>
                                    <small class="text-muted">{{ $candidate->current_company ?? '' }}</small>
                                </td>

                                <!-- Pendidikan -->
                                <td>
                                    <div>{{ $candidate->last_education ?? '-' }}</div>
                                    <small class="text-muted">{{ $candidate->university ?? '' }}</small>
                                </td>

                                <!-- Aksi -->
                                <td>
                                    <a href="{{ route('company.cv-search.view', $candidate->id) }}"
                                       class="btn btn-primary btn-sm">
                                        Akses CV
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="text-center mt-4 p-5 border rounded bg-white shadow-sm">
            <img src="{{ asset('images/sampah.gif') }}" alt="Empty" style="max-width:150px;" class="mb-3">
            <h5 class="fw-bold">Belum ada hasil</h5>
            <p class="text-muted">Gunakan filter di atas untuk mulai mencari kandidat.</p>
        </div>
    @endif

</div>
@endsection
