@extends('company.layout-profil')

@section('title', 'Tetap Terhubung dengan WhatsApp')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">
    <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-md">
        
        <!-- Gambar + Judul -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/wa-verification.svg') }}" 
                 alt="Whatsapp Verification" 
                 class="w-40 mb-4">
            <h2 class="text-lg font-semibold text-gray-900 text-center">
                Tetap terhubung dengan Whatsapp
            </h2>
            <p class="text-sm text-gray-600 text-center mt-2">
                Ikut serta untuk menerima pemberitahuan WhatsApp dan login yang aman serta 
                menerima pemberitahuan terkait loker dan lamaran.
            </p>
        </div>

        <!-- Form -->
        <form id="whatsapp-verification-input-number-form" 
              method="POST" 
              action="{{ route('company.whatsapp.save') }}" 
              class="space-y-5">
            @csrf

            <!-- Input Nomor HP -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">No. HP</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        +62
                    </span>
                    <input type="tel" name="phone" id="phone"
                           class="flex-1 min-w-0 block w-full px-3 py-2 border border-gray-300 rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Ketik nomor HP Anda" required>
                </div>
            </div>

            <!-- Checkbox -->
            <div class="flex items-start">
                <input id="agree" name="agree" type="checkbox" 
                       class="h-4 w-4 mt-1 text-blue-600 border-gray-300 rounded focus:ring-blue-500" checked>
                <label for="agree" class="ml-2 text-sm text-gray-700">
                    Saya setuju untuk menerima update dari loker di nomor Whatsapp saya
                </label>
            </div>

            <!-- Tombol -->
            <div class="pt-2 text-right">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500">
                    Simpan Nomor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
