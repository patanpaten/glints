<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <style>
        /* Isolate Bootstrap styles to modal only */
        .bootstrap-modal .modal,
        .bootstrap-modal .modal *,
        .bootstrap-modal .modal-dialog,
        .bootstrap-modal .modal-content,
        .bootstrap-modal .modal-header,
        .bootstrap-modal .modal-body,
        .bootstrap-modal .modal-footer {
            all: revert;
        }
        
        /* Import Bootstrap CSS with namespace */
        .bootstrap-modal {
            /* Bootstrap Modal Styles */
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
        }
        
        .bootstrap-modal .modal {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1055;
            display: none;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0;
        }
        
        .bootstrap-modal .modal-dialog {
            position: relative;
            width: auto;
            margin: 0.5rem;
            pointer-events: none;
        }
        
        .bootstrap-modal .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }
        
        .bootstrap-modal .modal.show .modal-dialog {
            transform: none;
        }
        
        .bootstrap-modal .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }
        
        .bootstrap-modal .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0.375rem;
            outline: 0;
        }
        
        .bootstrap-modal .modal-backdrop {
             position: fixed;
             top: 0;
             left: 0;
             z-index: 1050;
             width: 100vw;
             height: 100vh;
             background-color: rgba(0, 0, 0, 0.5);
         }
         
         .bootstrap-modal .modal-backdrop.fade {
             opacity: 0;
             transition: opacity 0.15s linear;
         }
         
         .bootstrap-modal .modal-backdrop.show {
             opacity: 1;
         }
         
         /* Ensure backdrop appears when modal is shown */
         .bootstrap-modal .modal.show ~ .modal-backdrop,
         .bootstrap-modal .modal-backdrop.show {
             display: block;
             opacity: 1;
         }
        
        .bootstrap-modal .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.375rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .bootstrap-modal .btn-close {
            box-sizing: content-box;
            width: 1em;
            height: 1em;
            padding: 0.25em 0.25em;
            color: #000;
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='m.235.867 4.596 4.596 4.596-4.596a.5.5 0 0 1 .708.708L5.939 6.171l4.596 4.596a.5.5 0 0 1-.708.708L5.231 6.879.635 11.475a.5.5 0 0 1-.708-.708L4.523 6.171.027 1.575a.5.5 0 0 1 .708-.708z'/%3e%3c/svg%3e") center/1em auto no-repeat;
            border: 0;
            border-radius: 0.375rem;
            opacity: 0.5;
        }
        
        .bootstrap-modal .btn-close:hover {
            color: #000;
            text-decoration: none;
            opacity: 0.75;
        }
        
        .bootstrap-modal .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .bootstrap-modal .form-control:focus {
            color: #212529;
            background-color: #fff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        .bootstrap-modal .form-label {
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .bootstrap-modal .btn-warning {
            color: #000;
            background-color: #ffc107;
            border-color: #ffc107;
        }
        
        .bootstrap-modal .btn-warning:hover {
            color: #000;
            background-color: #ffca2c;
            border-color: #ffc720;
        }
        
        .bootstrap-modal .btn-light {
            color: #000;
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }
        
        .bootstrap-modal .btn-light:hover {
            color: #000;
            background-color: #f9fafb;
            border-color: #f9fafb;
        }
        
        .bootstrap-modal .btn-link {
            font-weight: 400;
            color: #0d6efd;
            text-decoration: underline;
        }
        
        .bootstrap-modal .btn-link:hover {
            color: #0a58ca;
        }
        
        .bootstrap-modal .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }
        
        .bootstrap-modal .d-flex {
            display: flex !important;
        }
        
        .bootstrap-modal .d-grid {
            display: grid !important;
        }
        
        .bootstrap-modal .justify-content-between {
            justify-content: space-between !important;
        }
        
        .bootstrap-modal .justify-content-center {
            justify-content: center !important;
        }
        
        .bootstrap-modal .align-items-center {
            align-items: center !important;
        }
        
        .bootstrap-modal .gap-3 {
            gap: 1rem !important;
        }
        
        .bootstrap-modal .mb-0 {
            margin-bottom: 0 !important;
        }
        
        .bootstrap-modal .mb-1 {
            margin-bottom: 0.25rem !important;
        }
        
        .bootstrap-modal .mb-2 {
            margin-bottom: 0.5rem !important;
        }
        
        .bootstrap-modal .mb-3 {
            margin-bottom: 1rem !important;
        }
        
        .bootstrap-modal .mb-4 {
            margin-bottom: 1.5rem !important;
        }
        
        .bootstrap-modal .me-3 {
            margin-right: 1rem !important;
        }
        
        .bootstrap-modal .mx-2 {
            margin-left: 0.5rem !important;
            margin-right: 0.5rem !important;
        }
        
        .bootstrap-modal .p-0 {
            padding: 0 !important;
        }
        
        .bootstrap-modal .p-3 {
            padding: 1rem !important;
        }
        
        .bootstrap-modal .p-4 {
            padding: 1.5rem !important;
        }
        
        .bootstrap-modal .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }
        
        .bootstrap-modal .fw-bold {
            font-weight: 700 !important;
        }
        
        .bootstrap-modal .text-center {
            text-align: center !important;
        }
        
        .bootstrap-modal .text-muted {
            color: #6c757d !important;
        }
        
        .bootstrap-modal .text-warning {
            color: #ffc107 !important;
        }
        
        .bootstrap-modal .text-white {
            color: #fff !important;
        }
        
        .bootstrap-modal .text-danger {
            color: #dc3545 !important;
        }
        
        .bootstrap-modal .text-primary {
            color: #0d6efd !important;
        }
        
        .bootstrap-modal .text-info {
            color: #0dcaf0 !important;
        }
        
        .bootstrap-modal .small {
            font-size: 0.875em;
        }
        
        .bootstrap-modal .border {
            border: 1px solid #dee2e6 !important;
        }
        
        .bootstrap-modal .border-bottom {
            border-bottom: 1px solid #dee2e6 !important;
        }
        
        .bootstrap-modal .rounded-circle {
            border-radius: 50% !important;
        }
        
        .bootstrap-modal .flex-grow-1 {
            flex-grow: 1 !important;
        }
        
        .bootstrap-modal .fab {
            font-family: "Font Awesome 6 Brands";
        }
        
        .bootstrap-modal .fas {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }
        
        .bootstrap-modal .fa-lg {
            font-size: 1.33333em;
            line-height: 0.75em;
            vertical-align: -0.0667em;
        }
        
        .bootstrap-modal .fa-arrow-left:before {
            content: "\f060";
        }
        
        @media (min-width: 576px) {
            .bootstrap-modal .modal-dialog {
                max-width: 500px;
                margin: 1.75rem auto;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header/Navbar -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="flex items-center justify-between h-16">
      
      <!-- Logo -->
      <div class="flex items-center mr-8">
        <a href="{{ route('home') }}" class="flex-shrink-0 ml-2">
          <img src="{{ asset('images/logohome.svg') }}" alt="Glints Logo" class="h-15 w-auto">
        </a>
      </div>

      <!-- Menu Desktop -->
      <nav class="hidden lg:flex items-center space-x-6 mr-auto">
        <a href="{{ route('jobs.index') }}" 
           class="text-xs font-semibold uppercase tracking-wide transition-all duration-200 border-b-2 {{ request()->routeIs('jobs.index') ? 'border-black text-black' : 'border-transparent text-gray-700 hover:border-black hover:text-black' }}">
           Lowongan Kerja
        </a>
        <a href="{{ route('companies.index') }}" 
           class="text-xs font-semibold uppercase tracking-wide transition-all duration-200 border-b-2 {{ request()->routeIs('companies.index') ? 'border-black text-black' : 'border-transparent text-gray-700 hover:border-black hover:text-black' }}">
           Perusahaan
        </a>
        <a href="{{ route('blog') }}" target="_blank" rel="noopener noreferrer"
           class="text-xs font-semibold uppercase tracking-wide transition-all duration-200 border-b-2 {{ request()->is('blog') ? 'border-black text-black' : 'border-transparent text-gray-700 hover:border-black hover:text-black' }}">
           Blog
        </a>
        <a href="#"
           class="text-xs font-semibold uppercase tracking-wide transition-all duration-200 border-b-2 {{ request()->is('expertclass') ? 'border-black text-black' : 'border-transparent text-gray-700 hover:border-black hover:text-black' }}">
           ExpertClass
        </a>
      </nav>

      <!-- Actions -->
      <div class="flex items-center space-x-4">
        
        <!-- Unduh App -->
        <a href="#"
           class="hidden lg:flex items-center bg-[#0277bd] hover:bg-[#01579b] text-white px-4 py-2 text-xs font-semibold tracking-wide transition">
           Unduh App Glints
        </a>

        <!-- Language -->
        <div class="relative hidden lg:block">
          <button id="langBtn" 
                  class="flex items-center text-xs font-semibold tracking-wide text-gray-700 border-b-2 border-transparent hover:border-black transition">
            <i class="fas fa-globe mr-1"></i>
            ID
            <i class="fas fa-chevron-down ml-1 text-[10px]"></i>
          </button>
          <div id="langMenu" class="hidden absolute left-0 mt-2 w-32 bg-white border border-gray-200 shadow-md">
            <a href="#" class="block px-3 py-2 text-xs hover:bg-gray-100">English</a>
            <a href="#" class="block px-3 py-2 text-xs hover:bg-gray-100">Indonesian</a>
          </div>
        </div>

        <!-- Daftar & Masuk -->
        <a href="{{ route('register') }}" class="hidden lg:flex text-xs font-semibold tracking-wide text-gray-800 hover:underline underline-offset-4 decoration-2">
          Daftar
        </a>
        <a href="{{ route('login') }}" onclick="document.getElementById('loginModal').style.display='flex'; return false;"
           class="hidden lg:flex text-xs font-semibold tracking-wide text-gray-800 hover:underline underline-offset-4 decoration-2">
          Masuk
        </a>

        <!-- Untuk Perusahaan -->
        <a href="{{ route('company.register') }}"
           class="hidden lg:flex items-center border border-[#0277bd] text-[#0277bd] hover:bg-[#0277bd] hover:text-white px-3 py-1.5 text-xs font-semibold tracking-wide transition">
          Untuk Perusahaan
          <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
        </a>
      </div>

      <!-- Mobile Menu Button -->
      <button onclick="toggleMobileMenu()" class="lg:hidden text-2xl text-gray-800">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </div>


        <!-- Mobile Menu --> 
        <div id="mobile-menu" class="lg:hidden hidden fixed top-0 right-0 h-full w-72 bg-[#01579b] text-white shadow-lg z-50 overflow-y-auto"> 
            <div class="flex justify-end p-4"> 
                <!-- Close Button --> 
                <button onclick="toggleMobileMenu()" class="text-white text-2xl hover:text-gray-300 transition-colors">
                    <i class="fas fa-times"></i>
                </button> 
            </div> 
            <nav class="flex flex-col space-y-4 px-6 pb-6"> 
                <!-- Unduh App --> 
                <a href="#" class="border border-white text-white px-4 py-2 text-sm font-medium text-center hover:bg-white hover:text-[#01579b] transition rounded">
                    UNDUH APP GLINTS
                </a>
                
                <hr class="border-white/40">
                
                <!-- Auth --> 
                @if(request()->routeIs('login'))
                    <a href="{{ route('login') }}" class="px-2 py-2 rounded hover:bg-white/10 transition-colors">
                        MASUK
                    </a>
                @else
                    <a href="#" onclick="document.getElementById('loginModal').style.display='flex'; return false;" class="px-2 py-2 rounded hover:bg-white/10 transition-colors">
                        MASUK
                    </a>
                @endif 
                <a href="{{ route('register') }}" class="px-2 py-2 rounded hover:bg-white/10 transition-colors">
                    DAFTAR
                </a>
                
                <hr class="border-white/40">
                
                <!-- Menu Utama -->
                <a href="{{ route('jobs.index') }}" class="px-2 py-2 rounded hover:bg-white/10 transition-colors">
                    LOWONGAN KERJA
                </a> 
                <a href="{{ route('companies.index') }}" class="px-2 py-2 rounded hover:bg-white/10 transition-colors">
                    PERUSAHAAN
                </a> 
                <a href="{{ route('blog') }}" class="px-2 py-2 rounded hover:bg-white/10 transition-colors">
                    BLOG
                </a> 
                <a href="#" class="px-2 py-2 rounded hover:bg-white/10 transition-colors">
                    EXPERTCLASS
                </a>
                
                <hr class="border-white/40">
                
                <!-- Untuk Perusahaan --> 
                <a href="{{ route('company.register') }}" class="flex items-center justify-between px-2 py-2 rounded hover:bg-white/10 transition-colors">
                    <span>UNTUK PERUSAHAAN</span>
                    <i class="fas fa-arrow-right"></i>
                </a> 
                
                <!-- Language Dropdown --> 
                <div class="relative mt-4"> 
                    <button onclick="toggleLang()" class="flex items-center justify-between px-2 py-2 rounded hover:bg-white/10 w-full transition-colors"> 
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-globe"></i> 
                            <span id="current-lang">ID</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs"></i> 
                    </button> 
                    <div id="lang-menu" class="hidden absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg z-10"> 
                        <a href="#" onclick="setLang('ID')" class="block px-4 py-2 hover:bg-gray-200 transition-colors">
                            Indonesia
                        </a> 
                        <a href="#" onclick="setLang('EN')" class="block px-4 py-2 hover:bg-gray-200 transition-colors">
                            English
                        </a> 
                    </div> 
                </div> 
            </nav> 
        </div> 
        </header> 

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

     {{-- Modal Login --}} 
    @include('auth.login-modal') 

    <!-- Scripts -->
<script>
    function toggleMobileMenu() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    }

    function toggleLang() {
        document.getElementById('lang-menu').classList.toggle('hidden');
    }

    function setLang(lang) {
        document.getElementById('current-lang').innerText = lang;
        document.getElementById('lang-menu').classList.add('hidden');
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const mobileMenu = document.getElementById('mobile-menu');
        const menuButton = event.target.closest('button[onclick="toggleMobileMenu()"]');
        if (!menuButton && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
        }
    });

    // Close mobile menu on window resize to desktop size
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.add('hidden');
        }
    });
</script>
    @stack('scripts')
</body>
</html>