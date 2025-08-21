@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('auth.login-modal')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // otomatis buka modal kalau halaman /login diakses
    document.addEventListener('DOMContentLoaded', function () {
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    });
</script>
@endpush
