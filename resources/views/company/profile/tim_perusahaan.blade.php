@extends('company.app')

@section('content')
<style>
    body{
        font-family: 'Inter', sans-serif;
        background-color: #ffffff;
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
<div class="containe">
    <div class="row">
        {{-- Kolom kiri: Daftar Anggota Tim --}}
        <div class="col-md-8">
            <h3 class="mb-2">Anggota Tim</h3>
            <p class="text-muted" style="font-size: 14px;">
                Kami tahu perekrutan adalah tim effort dan kolaborasi selalu menjadi cara terbaik untuk melakukannya.
                Tambahkan kolega Anda sebagai administrator atau rekruter ke akun perusahaan Anda.
            </p>

            <div class="card">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th class="fw-semibold">Nama & Nomor Telepon</th>
                                <th>Terakhir Terlihat</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($members as $member)
                                <tr>
                                    <td>
                                        <a href="#" class="text-decoration-none">+</a>
                                    </td>
                                    <td>
                                        {{ $member->first_name ?? $member->name }} {{ $member->last_name ?? '' }}
<br>

                                        <small>{{ $member->phone }}</small>
                                    </td>
                                    <td class="last-seen" data-name="{{ $member->name }}">-</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->role }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada anggota tim</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-2 d-flex justify-content-end">
                {{ $members->links() }}
            </div>
        </div>

        {{-- Kolom kanan: Form Tambah Anggota Tim --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {{-- Logo & Profil Perusahaan --}}
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $company->logo
                                    ? asset('storage/' . $company->logo)
                                    : 'https://via.placeholder.com/50' }}"
                             class="me-2 rounded" alt="Logo Perusahaan" width="50" height="50">

                        <div>
                            <strong>{{ $company->name }}</strong><br>
                            <a href="{{ route('company.account-settings.index') }}"
                               class="text-decoration-none" style="font-size: 13px;">
                                ✎ Perbarui Profil Perusahaan
                            </a>
                        </div>
                    </div>

                    <hr>
                    <h6 class="mb-3">Tambahkan Anggota Tim Baru</h6>

                    <form action="{{ route('company.tim.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="firstName" class="form-control custom-border rounded-0" placeholder="Nama Depan" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="lastName" class="form-control custom-border rounded-0" placeholder="Nama Belakang">
                        </div>
                        <div class="mb-2">
                            <input type="email" name="email" class="form-control custom-border rounded-0" placeholder="Masukkan email anggota baru" required>
                        </div>
                        <div class="mb-2">
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" name="phone" class="form-control custom-border rounded-0" placeholder="Nomor Telepon" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <input type="password" name="password" class="form-control custom-border rounded-0" placeholder="Masukkan kata sandi anggota baru">
                            <small class="text-muted" style="font-size: 12px;">Hanya diperlukan jika pengguna tidak memiliki akun.</small>
                        </div>
                        <div class="mb-3">
                            <select name="role" class="form-select form-control custom-border rounded-0" required>
                                <option value="">Pilih peran untuk anggota baru</option>
                                <option value="ADMIN">Administrator</option>
                                <option value="RECRUITER">Recruiter</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-0 fw-bold">TAMBAHKAN ANGGOTA TIM</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Script untuk mengisi kolom "Terakhir Terlihat" --}}
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const lastSeenCells = document.querySelectorAll(".last-seen");

    lastSeenCells.forEach(cell => {
        // Simulasi: waktu random 0 - 120 menit lalu
        let minutesAgo = Math.floor(Math.random() * 120);

        let text = "";
        if (minutesAgo === 0) {
            text = "Baru saja";
        } else if (minutesAgo < 60) {
            text = minutesAgo + " menit lalu";
        } else {
            let jam = Math.floor(minutesAgo / 60);
            text = jam + " jam lalu";
        }

        cell.textContent = text;
    });
});
</script>
@endpush
