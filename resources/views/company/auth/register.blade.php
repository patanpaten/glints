@extends('layouts.company')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white shadow-md rounded-2xl flex overflow-hidden max-w-[750px] w-full">

        {{-- Sidebar Kiri --}}
        <div class="w-1/5 bg-[#DCEBFF] p-8 flex flex-col justify-center space-y-10">
            <div class="flex flex-col items-left text-left gap-3">
                <i><img src="{{ asset('images/access-talents-icon.svg') }}" class="w-10 h-10 object-contain mb-2">
            </i>
                <p class="text-gray-800 text-sm font-medium leading-snug">Akses 9 Juta+ Talenta</p>
            </div>
            <div class="flex flex-col items-left text-left gap-3">
                 <i><img src="{{ asset('images/chat-and-hire-icon.svg') }}" class="w-10 h-10 object-contain mb-2">
            </i>
                <p class="text-gray-800 text-sm font-medium leading-snug">Chat dan Rekrut Talenta Langsung</p>
            </div>
            <div class="flex flex-col items-left text-left gap-3">
                <i><img src="{{ asset('images/process-sparkling-icon.svg') }}" class="w-10 h-10 object-contain mb-2">
            </i>
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
                <a href="#" 
                class="flex items-center justify-center gap-2 w-full py-3 border rounded-full hover:bg-gray-50">
                    <img src="{{ asset('images/google.png') }}" class="w-5 h-5" alt="Google">
                    Daftar dengan Google
                </a>

                <!-- Email -->
                <a href="{{ route('company.register.email.form') }}" 
                class="flex items-center justify-center gap-2 w-full py-3 border rounded-full  hover:bg-gray-50">
                    <img src="{{ asset('images/email.jpg') }}" class="w-7 h-7 -ml-4" alt="Email">
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
                    <img src="{{ asset('images/linkedin.png') }}" class="w-5 h-5" alt="LinkedIn">
                </button>
                <button class="border rounded-full p-3 hover:bg-gray-50">
                    <img src="{{ asset('images/facebook.png') }}" class="w-5 h-5" alt="Facebook">
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
    <!-- Floating QR Card -->
    <div
    class="fixed bottom-60 -right-3 bg-white rounded-xl shadow-lg p-5 w-30 flex flex-col items-center z-50"
    >
    <!-- QR Code -->
    <img 
        src="{{ asset('images/glints-web2-app-qr.png') }}" 
        alt="Employer Web to App QR" 
        class="w-18 h-18 object-contain mb-2"
    >

    <!-- Text -->
    <p class="text-center text-gray-700 text-sm leading-tight">
        Rekrut Cepat <br> dengan Glints App
    </p>
    </div>

    <!-- WhatsApp Floating Button -->
    <a
    href="#"
    class="fixed bottom-22 right-3 bg-green-500 hover:bg-green-600 text-white 
            w-15 h-15 flex items-center justify-center rounded-full shadow-lg z-50"
    >
    <i class="fab fa-whatsapp text-4xl"></i>
    </a>
    </div>
</div>
@endsection