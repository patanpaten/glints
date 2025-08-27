<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Glints TapLoker Blog')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Blog Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-1xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-21">
                <!-- Logo and Navigation -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo dan teks glints.png') }}" alt="Glints TapLoker" class="h-12 w-auto">
                    </a>
                    <div class="hidden lg:flex">
                        <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-gray-900 font-bold text-sm transition-colors duration-200">Lowongan Kerja</a>
                    </div>
                </div>
                
                <!-- Desktop Action Buttons -->
                <div class="hidden lg:flex items-center space-x-3 button-group">
                    <!-- Tombol Primary -->
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 text-sm font-bold subscribe">
                        Unduh App Glints
                    </button>
                
                    <!-- Tombol Outline Primary -->
                    <a href="{{ route('register') }}">
                        <button class="border border-blue-600 text-blue-600 px-5 py-2 text-sm font-bold outline-primary">
                            buat akun
                        </button>
                    </a>
                
                    <!-- Separator -->
                    <span class="w-px h-6 bg-gray-300 separator"></span>
                
                    <!-- Tombol Outline Black -->
                    <a href="{{ route('company.register') }}">
                        <button class="border border-gray-400 text-gray-800 px-5 py-2 text-sm font-bold outline-black">
                            untuk perusahaan <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </a>
                </div>
                
                <style>
                    /* Meniru style Glints */
                    .button-group button {
                        font-family: inherit;
                        text-transform: none;
                        transition: all 0.2s ease-in-out;
                    }
                    .button-group .subscribe {
                        background-color: #0070F3;
                    }
                    .button-group .outline-primary {
                        border: 1px solid #0070F3;
                        color: #0070F3;
                        background-color: transparent;
                    }
                    .button-group .outline-primary:hover {
                        background-color: #0070F3;
                        color: white;
                    }
                    .button-group .outline-black {
                        border: 1px solid #333;
                        color: #333;
                        background-color: transparent;
                    }
                    .button-group .outline-black:hover {
                        background-color: #333;
                        color: white;
                    }
                    .button-group .separator {
                        background-color: #ddd;
                    }
                </style>
                
                
                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-gray-200">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="{{ route('jobs.index') }}" class="block px-3 py-2 text-gray-600 hover:text-gray-900 font-normal text-sm transition-colors duration-200">Lowongan Kerja</a>
            </div>
            <div class="px-4 py-3 border-t border-gray-200 space-y-2">
                <a href="#" class="block w-full text-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-none transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>
                    Unduh App Glints
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2.5 border border-blue-600 text-blue-600 hover:bg-blue-50 text-sm font-medium rounded-none transition-colors duration-200">
                    Buat Akun
                </a>
                <div class="w-full h-px bg-gray-300 my-2"></div>
                <a href="{{ route('company.register') }}" class="block w-full text-center px-4 py-2.5 border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm font-medium rounded-none transition-colors duration-200">
                    Untuk Perusahaan
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </nav>
    
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
    

    
    <!-- Mobile Menu JavaScript -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobile-menu');
            const button = event.target.closest('button[onclick="toggleMobileMenu()"]');
            
            if (!menu.contains(event.target) && !button && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
        
        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                document.getElementById('mobile-menu').classList.add('hidden');
            }
        });
    </script>
</body>
</html>