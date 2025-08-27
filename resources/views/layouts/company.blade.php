{{-- resources/views/layouts/company.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Glints for Employers') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white border-gray">
        <div class="max-w-7xl mx-auto px-2 py-1 flex justify-between items-center">

            {{-- Kiri: Logo --}}
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo dan teks glints.png') }}" alt="Glints Logo" class="h-15 w-auto">
            </div>

            {{-- Kanan: Login & Language --}}
            <div class="flex items-center space-x-4">

                {{-- Tombol Masuk --}}
                <a href="{{ route('company.login') }}" 
                class="px-4 py-1.5 border rounded text-sm font-medium hover:bg-gray-100">
                    MASUK
                </a>

                {{-- Garis pembatas --}}
                <div class="w-px h-6 bg-gray-300"></div>

                {{-- Dropdown Bahasa --}}
                <div class="relative group">
                    <button class="flex items-center space-x-1 text-sm text-gray-700 hover:text-black focus:outline-none">
                        <i class="fas fa-globe text-gray-600"></i>
                        <span>ID</span>
                        <i class="fas fa-chevron-down text-xs text-gray-600"></i>
                    </button>

                    {{-- Dropdown menu --}}
                    <div 
                        class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg opacity-0 invisible 
                            group-hover:opacity-100 group-hover:visible transition duration-200">
                        
                        <a href="?lang=id" class="block px-4 py-2 text-sm hover:bg-blue-50">
                            <span class="font-bold">ID</span>
                            <div class="text-gray-500 text-xs">Bahasa Indonesia</div>
                        </a>
                        <a href="?lang=en" class="block px-4 py-2 text-sm hover:bg-blue-50">
                            <span class="font-bold">EN</span>
                            <div class="text-gray-500 text-xs">English</div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </nav>

<script>
    // Dropdown toggle - removed since we're using CSS hover instead
    document.addEventListener('DOMContentLoaded', () => {
        // Language dropdown functionality can be added here if needed
        console.log('Company layout loaded');
    });
</script>


    {{-- Konten --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-50 -mt-15 text-sm text-gray-700">
        <div class="max-w-[770px] mx-auto px-4 py-20">
            
            {{-- Link atas --}}
            <div class="flex flex-wrap gap-6 mb-35">
                <a href="#" class="text-black-600 underline">Saya adalah Pencari Kerja</a>
                <a href="#" class="text-black-600 underline">Hubungi Bantuan</a>
            </div>

            <hr class="my-4">

            {{-- Layanan Pengaduan Konsumen --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="font-semibold">Layanan Pengaduan Konsumen</p>
                    <p>Kecamatan Setiabudi, Jakarta Selatan 12930</p>
                    <p>Alamat Email: <a href="mailto:hi@glints.com" class="text-blue-600 hover:underline">hi@glints.com</a></p>
                </div>
                <div>
                    <p>Direktorat Jenderal Perlindungan Konsumen dan Tertib Niaga</p>
                    <p>Nomor Kontak WhatsApp: 0853-1111-1010</p>
                </div>
            </div>

            {{-- Copyright --}}
            <p class="text-gray-500">
                © {{ date('Y') }} Glints | SIUPMSE: 12970003304280003
            </p>
        </div>
    </footer>

</body>
</html>
