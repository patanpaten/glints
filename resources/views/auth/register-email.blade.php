{{-- resources/views/register.blade.php --}}
@extends('layouts.navbar-regis')

@section('content')

<div class="min-h-screen bg-gray-50 px-4 flex flex-col items-center justify-center">
    <style>
        /* Bayangan rapat (kaya gambar 1) */
        .shadow-rapat {
          text-shadow: 
              -2px 2px 0 #ff0,   /* kuning */
            -3px 3px 0 #00f;   /* biru */
            
        }
    
        /* Bayangan tebal (kaya gambar 2) */
        .shadow-tebal {
          text-shadow: 
              -2px 2px 0 #ff0,
            -4px 4px 0 #00f; 
            
        }
      </style>
    
    
    {{-- Judul di atas form --}}
    <div class="text-center mb-8">
        <h1 class="TitleStyles_Title-sc-6snwzj-0 aries-typography-title SignUpPagesc_Title-sc-f658cd-3 text-3xl font-bold text-black">
            Mari buat profil <br>
            <span class="font-bold text-4xl shadow-rapat">
                Glints
            </span> kamu.
        </h1>
    </div>


    {{-- Card Form --}}
    <div class="w-full max-w-3xl bg-white p-8 rounded-lg shadow border border-gray-200">
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            
            {{-- Nama depan & belakang --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Nama Depan</label>
                    <input type="text" name="first_name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[#00B14F]">
                </div>
                <div>
                    <label class="block text-sm mb-1">Nama Belakang</label>
                    <input type="text" name="last_name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[#00B14F]">
                </div>
            </div>

            {{-- Email & Kata Sandi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[#00B14F]">
                </div>
                <div>
                    <label class="block text-sm mb-1">Buat Kata Sandi</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[#00B14F]">
                </div>
            </div>

            {{-- Lokasi & Nomor WhatsApp --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Lokasi</label>
                    <input type="text" name="location" placeholder="Masukkan lokasimu (Kota & Negara)" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[#00B14F]">
                </div>
                <div>
                    <label class="block text-sm mb-1">Nomor WhatsApp</label>
                    <div class="flex">
                        <span class="px-3 py-2 border border-gray-300 bg-gray-100 rounded-l">+62</span>
                        <input type="text" name="whatsapp" class="w-full border border-gray-300 border-l-0 rounded-r px-3 py-2 focus:outline-none focus:border-[#00B14F]">
                    </div>
                    <div class="mt-2 flex items-start gap-2 bg-blue-50 border border-blue-200 p-2 rounded">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="wa" class="w-5 h-5">
                        <p class="text-xs text-blue-600">Pastikan nomor yang kamu masukkan aktif dan terhubung dengan WhatsApp</p>
                    </div>
                </div>
            </div>

            {{-- Checkbox --}}
            <div class="flex items-start gap-2">
                <input type="checkbox" class="mt-1">
                <p class="text-sm text-gray-600">
                    Saya bersedia menerima informasi lowongan kerja dan tips karir melalui email dan WhatsApp.
                </p>
            </div>

            {{-- Tombol Daftar --}}
            <button type="submit" class="w-full bg-[#E30613] hover:bg-red-700 text-white font-semibold py-3 rounded shadow-[0_4px_0_#FFD700]">
                Daftar
            </button>

            {{-- Link perusahaan --}}
            <p class="text-center text-sm">
                Untuk perusahaan, <a href="#" class="text-blue-600 hover:underline">kunjungi halaman ini</a>.
            </p>

            {{-- Ketentuan layanan --}}
            <p class="text-xs text-gray-500 text-center">
                Dengan mendaftar, kamu setuju dengan <span class="font-semibold">Ketentuan Layanan</span> kami.
            </p>

            {{-- Link login --}}
            <p class="text-center text-sm">
                Sudah punya akun? <a href="{{ route('login-regis') }}" class="text-blue-600 hover:underline">Masuk</a>
            </p>
        </form>
    </div>
</div>
@endsection