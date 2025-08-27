@extends('layouts.company')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="flex w-full max-w-[750px] bg-white rounded shadow-md overflow-hidden">
        
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

        {{-- Form login kanan --}}
        <div class="flex-1 flex items-center justify-center p-5">
            <div class="w-full max-w-[420px] mx-auto">
                <h2 class="text-[28px] font-bold text-center mb-6 leading-snug">
                    Pasang Iklan Lowongan <br> Kerja Gratis!
                </h2>

                <form method="POST" action="{{ route('company.login') }}" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input id="email" type="email"
                            class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none @error('email') border-red-500 @enderror"
                            name="email" value="{{ old('email') }}" required autofocus
                            placeholder="Masukkan email Anda">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">⚠ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <input id="password" type="password"
                                class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none @error('password') border-red-500 @enderror"
                                name="password" required
                                placeholder="Masukkan password">
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <i id="toggleIcon" class="fas fa-eye-slash text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">⚠ {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <a href="#" class="text-blue-600 hover:underline">Lupa password?</a>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition text-sm">
                        Masuk
                    </button>

                    {{-- Divider --}}
                    <div class="relative my-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="bg-white px-2 text-gray-500">Atau dengan</span>
                        </div>
                    </div>

                    {{-- Social login --}}
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="border p-2 rounded-full hover:bg-gray-50">
                            <img src="/images/google.png" alt="Google" class="w-5 h-5">
                        </a>
                        <a href="#" class="border p-2 rounded-full hover:bg-gray-50">
                            <img src="/images/linkedin.png" alt="LinkedIn" class="w-5 h-5">
                        </a>
                        <a href="#" class="border p-2 rounded-full hover:bg-gray-50">
                            <img src="/images/facebook.png" alt="Facebook" class="w-5 h-5">
                        </a>
                    </div>

                    <p class="text-[11px] text-gray-500 text-center mt-3 leading-snug">
                        Dengan melanjutkan, anda menyetujui <br>
                        Perjanjian Pengguna, Kebijakan Privasi, & Syarat Layanan
                    </p>

                    <p class="text-center mt-3 text-sm">
                        Belum punya akun?
                        <a href="{{ route('company.register') }}" class="text-blue-600 hover:underline ">Daftar di sini</a>
                    </p>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}
</script>
@endsection
