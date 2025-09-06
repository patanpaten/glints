@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                {{-- Ini form login biasa (untuk /login) --}}
                @include('auth.login-form')

                {{-- Ini modal login (untuk navbar) --}}
                @include('auth.login-modal')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Modal hanya muncul kalau login lewat modal & ada error --}}
    @if (session('login_from') === 'modal' && ($errors->has('email') || $errors->has('password')))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var loginModalElement = document.getElementById('loginModal');
                if (loginModalElement) {
                    loginModalElement.style.display = 'flex';
                }
            });
        </script>
    @endif
@endpush
