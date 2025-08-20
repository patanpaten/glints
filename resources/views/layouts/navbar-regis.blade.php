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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-6">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        <img src="{{ asset('images/logohome.svg') }}" alt="Glints Logo" class="h-15 w-auto">
                    </a>
    
                    <!-- Navigation Menu - Desktop -->
                    <nav class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('jobs.index') }}" class="text-gray-700 hover:text-blue-600 text-sm font-medium transition-colors duration-200">LOWONGAN KERJA</a>
                        <a href="{{ route('companies.index') }}" class="text-gray-700 hover:text-blue-600 text-sm font-medium transition-colors duration-200">PERUSAHAAN</a>
                        <a href="{{ route('blog') }}" target="_blank" rel="noopener noreferrer" class="text-gray-700 hover:text-blue-600 text-sm font-medium transition-colors duration-200">BLOG</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600 text-sm font-medium transition-colors duration-200">EXPERTCLASS</a>
                    </nav>
                </div>
                
                <!-- Right Side Action Buttons -->
                <div class="flex items-center space-x-0">
                    <!-- Download App Button -->
                    <a href="#" class="hidden md:inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm font-medium transition-colors duration-200">
                        UNDUH APP GLINTS
                    </a>
                    
                    <!-- Language/Region Selector -->
                    <div class="hidden md:flex items-center space-x-1 text-gray-600 px-2">
                        <img src="{{ asset('images/indonesia.png') }}" alt="ID" class="w-4 h-4 rounded-full">
                        <span class="text-sm font-medium">ID</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                    
                    <!-- Auth Buttons -->
                    <a href="{{ route('register') }}" class="hidden md:inline-flex items-center text-gray-700 hover:text-blue-600 px-2 py-2 text-sm font-medium transition-colors duration-200">
                        DAFTAR
                    </a>
                    
                    <a href="{{ route('login') }}" class="hidden md:inline-flex items-center text-gray-700 hover:text-blue-600 px-2 py-2 text-sm font-medium transition-colors duration-200">
                        MASUK
                    </a>
                    
                    <!-- For Company Button -->
                    <a href="{{ route('companies.index') }}" class="hidden md:inline-flex items-center border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-3 py-2 rounded text-sm font-medium transition-all duration-200">
                        <span>UNTUK PERUSAHAAN</span>
                        <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                    
                    <!-- Mobile Menu Button -->
                    <button type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-expanded="false" onclick="toggleMobileMenu()">
                        <span class="sr-only">Open menu</span>
                        <i class="fas fa-bars" id="mobile-menu-icon"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                    <!-- Mobile Navigation Links -->
                    <a href="{{ route('jobs.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 text-sm font-medium">LOWONGAN KERJA</a>
                    <a href="{{ route('companies.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 text-sm font-medium">PERUSAHAAN</a>
                    <a href="{{ route('blog') }}" target="_blank" rel="noopener noreferrer" class="block px-3 py-2 text-gray-700 hover:text-blue-600 text-sm font-medium">BLOG</a>
                    <a href="#" class="block px-3 py-2 text-gray-700 hover:text-blue-600 text-sm font-medium">EXPERTCLASS</a>
                    
                    <!-- Mobile Action Buttons -->
                    <div class="pt-4 space-y-2">
                        <a href="#" class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded text-sm font-medium w-full">
                            UNDUH APP GLINTS
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-3 rounded text-sm font-medium w-full">
                            DAFTAR
                        </a>
                        <a href="{{ route('login') }}" class="flex items-center justify-center border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-3 rounded text-sm font-medium w-full">
                            MASUK
                        </a>
                        <a href="{{ route('companies.index') }}" class="flex items-center justify-center border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-3 rounded text-sm font-medium w-full">
                            <span>UNTUK PERUSAHAAN</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
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
            if (window.innerWidth >= 768) {
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