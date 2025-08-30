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

        {{-- Form kanan --}}
        <div class="flex-1 flex items-center justify-center p-5">
            <div class="w-full max-w-[420px] mx-auto pb-8">
                <h2 class="text-[28px] font-bold text-center mb-4 leading-snug">
                    Pasang Iklan Lowongan <br> Kerja Gratis!
                </h2>

                <form method="POST" action="{{ route('company.register.email') }}" class="space-y-3 mb-6">
                    @csrf

                    {{-- Nama --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                        <input id="name" type="text"
                            class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:border-blue-500 focus:outline-none @error('name') border-red-500 @enderror"
                            name="name" value="{{ old('name') }}" required autofocus
                            placeholder="Ketik nama perusahaan anda">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">⚠ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input id="email" type="email"
                            class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:border-blue-500 focus:outline-none @error('email') border-red-500 @enderror"
                            name="email" value="{{ old('email') }}" required
                            placeholder="Masukkan email Anda">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">⚠ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor HP --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                        <input id="phone" type="tel"
                            class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:border-blue-500 focus:outline-none @error('phone') border-red-500 @enderror"
                            name="phone" value="{{ old('phone') }}" required
                            placeholder="Masukkan nomor HP perusahaan">
                        @error('phone')
                            <p class="text-xs text-red-500 mt-1">⚠ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <input id="password" type="password"
                                class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:border-blue-500 focus:outline-none @error('password') border-red-500 @enderror"
                                name="password" required
                                placeholder="Masukkan password">
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <i id="toggleIcon" class="fas fa-eye-slash text-sm"></i>
                            </button>
                        </div>
                        <p id="passwordWarning" class="text-xs text-red-500 mt-1 hidden">⚠ Password minimal 6 karakter</p>
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">⚠ {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <a href="#" class="text-blue-600 hover:underline">Lupa password?</a>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 cursor-pointer text-white py-2 rounded hover:bg-blue-700 transition text-sm">
                        Daftar
                    </button>

                    {{-- Divider --}}
                    <div class="relative my-3">
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
                        Perjanjian Pengguna, Kebijakan Privasi, & Syarat ketentuan Layanan
                    </p>

                    <p class="text-center mt-3 text-sm">
                        Sudah punya akun?
                        <a href="{{ route('company.login') }}" class="text-blue-600 hover:underline">Login di sini</a>
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

// Validasi password minimal 6 karakter
document.getElementById("password").addEventListener("input", function() {
    const warning = document.getElementById("passwordWarning");
    if (this.value.length < 6) {
        warning.classList.remove("hidden");
    } else {
        warning.classList.add("hidden");
    }
});
</script>
@endsection
