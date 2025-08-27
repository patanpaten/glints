@extends('layouts.company')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white shadow-md rounded-2xl flex overflow-hidden max-w-[750px] w-full">

        {{-- Sidebar Kiri --}}
        <div class="w-1/5 bg-[#DCEBFF] p-8 flex flex-col justify-center space-y-10">
            <div class="flex flex-col items-center text-center gap-3">
                <i class="fas fa-users text-blue-600 text-3xl"></i>
                <p class="text-gray-800 text-sm font-medium leading-snug">Akses 9 Juta+ Talenta</p>
            </div>
            <div class="flex flex-col items-center text-center gap-3">
                 <i class="fas fa-comments text-blue-600 text-3xl"></i>
                <p class="text-gray-800 text-sm font-medium leading-snug">Chat dan Rekrut Talenta Langsung</p>
            </div>
            <div class="flex flex-col items-center text-center gap-3">
                <i class="fas fa-magic text-blue-600 text-3xl"></i>
                <p class="text-gray-800 text-sm font-medium leading-snug">Rekrutmen Cepat dengan Bantuan AI</p>
            </div>
        </div>

        <!-- FORM KANAN -->
        <div class="w-full max-w-[420px] p-8 flex flex-col justify-center mx-auto">
            <h1 class="text-[28px] font-bold text-center leading-snug">
                Pasang Iklan Lowongan Kerja Gratis!
            </h1>

            <div class="mt-8 space-y-4">
                <!-- Google -->
                <button class="flex items-center justify-center gap-2 w-full py-3 border rounded-full hover:bg-gray-50">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                    Daftar dengan Google
                </button>

                <!-- Email -->
                <a href="{{ route('company.register.email.form') }}" 
                class="flex items-center justify-center gap-2 w-full py-3 border rounded-full hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z" />
                    </svg>
                    Daftar dengan Email
                </a>

            </div>

            <div class="flex items-center gap-2 my-6">
                <hr class="flex-1 border-gray-300">
                <span class="text-gray-500 text-sm">Atau dengan</span>
                <hr class="flex-1 border-gray-300">
            </div>

            <div class="flex justify-center gap-6">
                <button class="border rounded-full p-3 hover:bg-gray-50">
                    <img src="https://www.svgrepo.com/show/448234/linkedin.svg" class="w-5 h-5" alt="LinkedIn">
                </button>
                <button class="border rounded-full p-3 hover:bg-gray-50">
                    <img src="https://www.svgrepo.com/show/448224/facebook.svg" class="w-5 h-5" alt="Facebook">
                </button>
            </div>

            <p class="text-center text-xs text-gray-500 mt-6">
                Dengan melanjutkan, anda menyetujui 
                <a href="#" class="text-blue-600">Perjanjian Pengguna</a>, 
                <a href="#" class="text-blue-600">Kebijakan Privasi</a>, 
                dan <a href="#" class="text-blue-600">Syarat Ketentuan Layanan</a>.
            </p>

            <p class="text-center text-sm mt-6">
                Sudah punya akun? 
                <a href="{{ route('company.login') }}" class="text-blue-600">Login di sini</a>
            </p>
        </div>

    </div>
</div>
@endsection
