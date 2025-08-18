<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Glints - Platform Lowongan Kerja Terbesar di Indonesia')</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header/Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        <img src="{{ asset('images/glinthome.png') }}" alt="Glints Logo" class="h-16">
                    </a>
                </div>
                
                <!-- Navigation Menu - Desktop -->
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Lowongan Kerja</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Perusahaan</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Blog</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">ExpertClass</a>
                </nav>
                
                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Download App Button -->
                    <a href="#" class="hidden md:flex items-center text-blue-600 bg-blue-50 hover:bg-blue-100 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-download mr-2"></i>
                        <span>Unduh App Glints</span>
                    </a>
                    
                    <!-- Language Selector -->
                    <div class="relative hidden md:block">
                        <button class="flex items-center text-gray-700 hover:text-orange-500">
                            <span class="mr-1">ID</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                    </div>
                    
                    <!-- Auth Buttons -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500 font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-orange-500 font-medium">Daftar</a>
                    </div>
                    
                    <!-- For Company Button -->
                    <a href="#" class="hidden md:block text-gray-700 hover:text-orange-500 border border-gray-300 hover:border-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                        Untuk Perusahaan
                    </a>
                    
                    <!-- Mobile Menu Button -->
                    <button type="button" class="md:hidden bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8">
                <!-- Bagian Kiri - Glints Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/glinthome.png') }}" alt="Glints Logo" class="h-30 mr-10">
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Secara resmi diluncurkan pada tahun 2015 di Singapura, Glints telah memberdayakan lebih dari 5 juta bakat dan 60.000 organisasi untuk mewujudkan potensi manusia mereka.</p>
                    <div class="flex space-x-4 mb-4">
                        <a href="#" class="text-gray-400 hover:text-orange-500"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-orange-500"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-orange-500"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-orange-500"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-orange-500"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-gray-400 hover:text-orange-500"><i class="fab fa-tiktok"></i></a>
                    </div>
                    <p class="text-sm text-gray-500">&copy; 2025 PT. Glints Indonesia Group</p>
                </div>
                
                <!-- Bagian Tengah - 3 Kolom -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Untuk Pencari Kerja -->
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">Untuk Pencari Kerja</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Lokasi Pekerjaan</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Nama Perusahaan</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Kategori Pekerjaan</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Lowongan Kerja Populer</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Help Center</a></li>
                        </ul>
                    </div>
                    
                    <!-- Untuk Pemberi Kerja -->
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">Untuk Pemberi Kerja</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Untuk Pemberi Kerja</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">HR Tips</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Glints Platform</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Perekrutan</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Bakat Terkelola</a></li>
                        </ul>
                    </div>
                    
                    <!-- Perusahaan -->
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">Perusahaan</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Tentang Kami</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Hired Blog</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Inside Glints</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Tech Blog</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Careers</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Report Vulnerability</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Perjanjian Pengguna</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Kebijakan Privasi</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-orange-500 text-sm">Syarat dan Ketentuan Layanan</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Bagian Kanan - Download App & Sertifikasi -->
                <div>
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-2">Terdaftar dan diawasi oleh</h3>
                        <div class="flex items-center space-x-4">
                            <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                <span class="text-xs font-bold">K</span>
                            </div>
                            <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                <span class="text-xs font-bold">KRI</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">Dapatkan Aplikasi Glints</h3>
                        <div class="flex space-x-2 mb-4">
                            <div class="w-24 h-24 bg-gray-200 flex items-center justify-center rounded">
                                <i class="fas fa-qrcode text-gray-400 text-4xl"></i>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <a href="#" class="block bg-gray-800 text-white px-3 py-2 rounded flex items-center h-10">
                                    <i class="fab fa-google-play mr-2"></i>
                                    <span>Google Play</span>
                                </a>
                                <a href="#" class="block bg-gray-800 text-white px-3 py-2 rounded flex items-center h-10">
                                    <i class="fab fa-apple mr-2"></i>
                                    <span>App Store</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- WhatsApp Floating Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="#" class="bg-green-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-green-600 transition-colors">
            <i class="fab fa-whatsapp text-2xl"></i>
        </a>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>