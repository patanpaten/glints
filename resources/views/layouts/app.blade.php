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
                        <img src="{{ asset('images/glinthome.png') }}" alt="Glints Logo" class="h-12">
                    </a>
                </div>
                
                <!-- Navigation Menu - Desktop -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-blue-600 font-normal text-sm transition-colors duration-200">LOWONGAN KERJA</a>
                    <a href="{{ route('companies.index') }}" class="text-gray-600 hover:text-blue-600 font-normal text-sm transition-colors duration-200">PERUSAHAAN</a>
                    <a href="{{ route('blog') }}" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-600 font-normal text-sm transition-colors duration-200">BLOG</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 font-normal text-sm transition-colors duration-200">EXPERTCLASS</a>
                </nav>
                
                <!-- Right Side Action Buttons -->
                <div class="flex items-center space-x-3">
                    <!-- Download App Button - Blue Solid with Download Icon -->
                    <a href="#" class="hidden lg:flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-md text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-download mr-2 text-sm"></i>
                        <span>UNDUH APP GLINTS</span>
                    </a>
                    
                    <!-- Language/Region Selector -->
                    <div class="hidden lg:flex items-center space-x-2">
                        <div class="w-4 h-4 bg-gray-400 rounded-full"></div>
                        <span class="text-gray-600 text-sm">ID</span>
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </div>
                    
                    <!-- Additional Buttons -->
                    <a href="#" class="hidden lg:flex items-center text-gray-600 hover:text-blue-600 text-sm font-medium transition-colors duration-200">
                        DAFTAR
                    </a>
                    
                    <a href="#" class="hidden lg:flex items-center text-gray-600 hover:text-blue-600 text-sm font-medium transition-colors duration-200">
                        MASUK
                    </a>
                    
                    <!-- For Company Button - Blue Outline with Arrow -->
                    <a href="{{ route('companies.index') }}" class="hidden lg:flex items-center border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2.5 rounded-md text-sm font-medium transition-all duration-200">
                        <span>UNTUK PERUSAHAAN</span>
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                    
                    <!-- Mobile Menu Button -->
                    <button type="button" class="lg:hidden bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-expanded="false" onclick="toggleMobileMenu()">
                        <span class="sr-only">Open menu</span>
                        <i class="fas fa-bars" id="mobile-menu-icon"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div class="lg:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                    <!-- Mobile Navigation Links -->
                    <a href="{{ route('jobs.index') }}" class="block px-3 py-2 text-gray-600 hover:text-blue-600 font-normal text-sm">LOWONGAN KERJA</a>
                    <a href="{{ route('companies.index') }}" class="block px-3 py-2 text-gray-600 hover:text-blue-600 font-normal text-sm">PERUSAHAAN</a>
                    <a href="{{ route('blog') }}" target="_blank" rel="noopener noreferrer" class="block px-3 py-2 text-gray-600 hover:text-blue-600 font-normal text-sm">BLOG</a>
                    <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 font-normal text-sm">EXPERTCLASS</a>
                    
                    <!-- Mobile Action Buttons -->
                    <div class="pt-4 space-y-2">
                        <a href="#" class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-md text-sm font-medium w-full">
                            <i class="fas fa-download mr-2 text-sm"></i>
                            <span>UNDUH APP GLINTS</span>
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-3 rounded-md text-sm font-medium w-full">
                            DAFTAR
                        </a>
                        <a href="#" class="flex items-center justify-center border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-4 py-3 rounded-md text-sm font-medium w-full">
                            MASUK
                        </a>
                        <a href="{{ route('companies.index') }}" class="flex items-center justify-center border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-3 rounded-md text-sm font-medium w-full">
                            <span>UNTUK PERUSAHAAN</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-8">
                <!-- Bagian Kiri - Glints Asia Pacific Info -->
                <div class="lg:col-span-1">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Glints <span class="text-blue-400">Asia Pacific</span></h2>
                            <div class="bg-gray-800 px-2 py-1 rounded text-xs text-white mt-1">TapLoker</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-1 mb-4">
                        <div class="w-3 h-3 bg-pink-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-pink-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                        <div class="w-3 h-3 bg-red-700 rounded-full"></div>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">Secara resmi diluncurkan pada tahun 2015 di Singapura, Glints telah memberdayakan lebih dari 5 juta bakat dan 60.000 organisasi untuk mewujudkan potensi manusia mereka.</p>
                </div>
                
                <!-- Untuk Pencari Kerja -->
                <div>
                    <h3 class="font-semibold text-white mb-4">Untuk Pencari Kerja</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Lokasi Pekerjaan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Nama Perusahaan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Kategori Pekerjaan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Lowongan Kerja Populer</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Help Center</a></li>
                    </ul>
                </div>
                
                <!-- Untuk Pemberi Kerja -->
                <div>
                    <h3 class="font-semibold text-white mb-4">Untuk Pemberi Kerja</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Untuk Pemberi Kerja</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">HR Tips</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Glints Platform</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Perekrutan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Bakat Terkelola</a></li>
                    </ul>
                </div>
                
                <!-- Perusahaan -->
                <div>
                    <h3 class="font-semibold text-white mb-4">Perusahaan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Hired Blog</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Inside Glints</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Tech Blog</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Careers</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Report Vulnerability</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Perjanjian Pengguna</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Syarat dan Ketentuan Layanan</a></li>
                    </ul>
                </div>
                
                <!-- Terdaftar dan diawasi oleh -->
                <div>
                    <h3 class="font-semibold text-white mb-4">Terdaftar dan diawasi oleh</h3>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-white rounded p-2 flex items-center justify-center">
                            <div class="w-16 h-10 bg-blue-600 rounded flex items-center justify-center">
                                <span class="text-white font-bold text-xs">KOMINFO</span>
                            </div>
                        </div>
                        <div class="bg-white rounded p-2 flex items-center justify-center">
                            <div class="w-16 h-10 flex items-center justify-center">
                                <span class="text-black font-bold text-xs text-center leading-tight">KEMENTERIAN<br>KETENAGAKERJAAN</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Dapatkan Aplikasi Glints -->
                <div>
                    <h3 class="font-semibold text-white mb-4">Dapatkan Aplikasi Glints</h3>
                    <div class="flex items-start space-x-3">
                        <div class="w-16 h-16 bg-white rounded flex items-center justify-center">
                            <div class="w-12 h-12 border border-gray-300 bg-gray-100 flex items-center justify-center">
                                <div class="grid grid-cols-5 gap-px">
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                    <div class="w-1 h-1 bg-white"></div>
                                    <div class="w-1 h-1 bg-black"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <a href="#" class="bg-black text-white px-3 py-2 rounded flex items-center text-xs">
                                <i class="fab fa-google-play mr-2 text-lg"></i>
                                <div>
                                    <div class="text-xs">DAPATKAN DI</div>
                                    <div class="font-bold">Google Play</div>
                                </div>
                            </a>
                            <a href="#" class="bg-black text-white px-3 py-2 rounded flex items-center text-xs">
                                <i class="fab fa-apple mr-2 text-lg"></i>
                                <div>
                                    <div class="text-xs">Download di</div>
                                    <div class="font-bold">App Store</div>
                                </div>
                            </a>
                        </div>
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fab fa-whatsapp text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bagian Bawah -->
            <div class="border-t border-gray-700 mt-8 pt-6">
                <div class="flex flex-col lg:flex-row justify-between items-center">
                    <!-- Social Media -->
                    <div class="flex space-x-4 mb-4 lg:mb-0">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-tiktok text-xl"></i>
                        </a>
                    </div>
                    
                    <!-- Copyright -->
                    <div class="text-center lg:text-right">
                        <p class="text-sm text-gray-400">&copy; 2025 PT. Glints Indonesia Group</p>
                    </div>
                </div>
                
                <!-- Terdaftar dan diawasi oleh -->
                <div class="mt-6 pt-6 border-t border-gray-700">
                    <div class="flex flex-col lg:flex-row justify-between items-center">
                        <div class="mb-4 lg:mb-0">
                            <h4 class="text-sm font-semibold text-white mb-3">Terdaftar dan diawasi oleh</h4>
                            <div class="flex items-center space-x-4">
                                <div class="bg-white rounded p-2">
                                    <img src="/images/kominfo-logo.png" alt="KOMINFO" class="h-8 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                    <div class="text-blue-600 font-bold text-xs" style="display:none;">KOMINFO</div>
                                </div>
                                <div class="bg-white rounded p-2">
                                    <img src="/images/kemnaker-logo.png" alt="KEMENTERIAN KETENAGAKERJAAN" class="h-8 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                    <div class="text-black font-bold text-xs text-center" style="display:none;">KEMENTERIAN<br>KETENAGAKERJAAN</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dapatkan Aplikasi Glints -->
                        <div class="text-center lg:text-right">
                            <h4 class="text-sm font-semibold text-white mb-3">Dapatkan Aplikasi Glints</h4>
                            <div class="flex items-center justify-center lg:justify-end space-x-3">
                                <div class="w-16 h-16 bg-white rounded flex items-center justify-center">
                                    <div class="w-12 h-12 border border-gray-300">
                                        <!-- QR Code placeholder -->
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-xs text-gray-500">QR</div>
                                    </div>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <a href="#" class="bg-black text-white px-3 py-2 rounded flex items-center text-xs">
                                        <i class="fab fa-google-play mr-2"></i>
                                        <div>
                                            <div class="text-xs">DAPATKAN DI</div>
                                            <div class="font-bold">Google Play</div>
                                        </div>
                                    </a>
                                    <a href="#" class="bg-black text-white px-3 py-2 rounded flex items-center text-xs">
                                        <i class="fab fa-apple mr-2"></i>
                                        <div>
                                            <div class="text-xs">Download di</div>
                                            <div class="font-bold">App Store</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                    <i class="fab fa-whatsapp text-white text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    


    <!-- Scripts -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('mobile-menu-icon');
            
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            } else {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = event.target.closest('button[onclick="toggleMobileMenu()"]');
            
            if (!menuButton && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                const menuIcon = document.getElementById('mobile-menu-icon');
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        });
        
        // Close mobile menu on window resize to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const mobileMenu = document.getElementById('mobile-menu');
                const menuIcon = document.getElementById('mobile-menu-icon');
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>