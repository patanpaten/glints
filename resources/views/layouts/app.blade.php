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

    <!-- Vite Styles & Scripts --> 
    @vite(['resources/css/app.css', 'resources/js/app.js']) 

    <!-- Bootstrap CSS - Isolated for Modal Only --> 
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

    <!-- App CSS --> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 

    <!-- Additional Styles --> 
    @stack('styles') 

</head>

    <body> 
        <!-- Header/Navbar -->
        <header class="bg-white border-b border-gray-300 sticky top-0 z-10">
            <div class="w-full mx-auto px-25 py-0">
                <div class="flex items-center justify-between">
                    
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex-shrink-0">
                            <img src="{{ asset('images/logohome.svg') }}" alt="Glints Logo" class="h-14 lg:h-18 w-auto">
                        </a>
                    </div>
                    <!-- Navigation Menu - Desktop -->
                    <nav class="hidden lg:flex items-center space-x-6 -ml-50">
                        <a href="{{ route('jobs.index') }}" class="text-black {{ request()->routeIs('jobs.index') ? 'active' : '' }} nav-link font-semibold text-xs transition-colors duration-200">LOWONGAN KERJA</a>
                        <a href="{{ route('companies.index') }}" class="text-black {{ request()->routeIs('companies.index') ? 'active' : '' }} nav-link font-semibold text-xs transition-colors duration-200">PERUSAHAAN</a>
                        <a href="{{ route('blog') }}" target="_blank" rel="noopener noreferrer" class="text-black {{ request()->Is('blog') ? 'active' : '' }} nav-link font-semibold text-xs transition-colors duration-200">BLOG</a>
                        <a href="#" class="text-black {{ request()->Is('expertclass') ? 'active' : '' }} nav-link font-semibold text-xs transition-colors duration-200">EXPERTCLASS</a>
                    </nav>

                    <!-- Right Side Action Buttons -->
                    <div class="flex items-center space-x-3">
                    <!-- Download App Button -->
                    <a href="#" class="hidden lg:flex items-center bg-[#0277bd] hover:bg-blue-700 text-white px-3 py-1.5 rounded-none text-xs font-medium transition-colors duration-200">
                        <span>UNDUH APP GLINTS</span>
                    </a>

                    <!-- Language/Region Selector -->
                    <div class="relative">
                        <button id="langBtn" 
                            class="text-black focus:outline-none text-xs font-medium inline-flex items-center gap-1 
                                border-b-3 border-transparent hover:border-black transition-all duration-200">
                            <i class="fas fa-globe"></i>
                            <span>ID</span>
                            <i id="langIcon" class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <!-- Dropdown -->
                        <div id="langMenu" class="hidden absolute left-0 mt-2 w-36 bg-white border border-gray-200 rounded-none shadow-lg z-50">
                            <ul class="py-1 text-xs text-black uppercase">
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">ENGLISH</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">INDONESIAN</a></li>
                            </ul>
                        </div>
                    </div> 

                    <!-- Additional Buttons -->
                    <a href="{{ route('register') }}" 
                    class="ml-6 hidden lg:flex items-center text-black hover:underline 
                            underline-offset-4 decoration-2 decoration-black 
                            text-xs font-medium transition-colors duration-200">
                        DAFTAR
                    </a>

                    @if(request()->routeIs('login'))
                        <a href="{{ route('login') }}"
                        class="ml-6 hidden lg:flex items-center text-black hover:underline 
                                underline-offset-4 decoration-2 decoration-black 
                                text-xs font-medium transition-colors duration-200">
                            MASUK
                        </a>
                    @else
                        <a href="#" onclick="document.getElementById('loginModal').style.display='flex'; return false;"
                        class="ml-6 hidden lg:flex items-center text-black hover:underline 
                                underline-offset-4 decoration-2 decoration-black 
                                text-xs font-medium transition-colors duration-200">
                            MASUK
                        </a>
                    @endif

                    <!-- For Company Button (dipaksa ke kanan) -->
                    <div>
                        <a href="{{ route('companies.index') }}" class="hidden lg:flex items-center border border-[#01579b] text-[#0277bd] hover:bg-[#0277bd] hover:text-white px-2.5 py-1.5 rounded-none text-xs font-medium transition-all duration-200">
                            <span>UNTUK PERUSAHAAN</span>
                            <i class="ml-5 fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

                    <!-- Mobile Menu Button -->
                    <button onclick="toggleMobileMenu()" class="lg:hidden text-black text-2xl focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
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
                <a href="{{ route('companies.index') }}" class="flex items-center justify-between px-2 py-2 rounded hover:bg-white/10 transition-colors">
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
        
        {{-- Konten Halaman --}} 
        <main class="py-4"> 
            @yield('content') 
        </main> 
        
        <!-- Footer --> 
         <footer class="bg-gray-900 text-white relative overflow-hidden"> 
            <!-- Background image --> 
            <img src="/images/footer_bg.webp" alt="Footer Background" class="absolute inset-0 w-full h-full object-cover opacity-90"> 
            <div class="relative container mx-auto px-6 py-12"> 
                <!-- Grid utama --> 
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-10"> 
                    <!-- Kolom Logo + Asia Pacific --> 
                    <div class="lg:col-span-2"> 
                        <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-6 space-y-4 lg:space-y-0"> 
                            <!-- Logo --> 
                            <img src="/images/logof.svg" alt="Glints" class="max-h-[120px] w-auto"> 
                            <!-- Info Glints Asia Pacific --> 
                            <div class="text-center lg:text-left"> 
                                <h4 class="text-white mb-3 font-poppins tracking-widest">Glints Asia Pacific</h4> 
                                <!-- Ikon Negara --> 
                                <div class="flex flex-wrap justify-center lg:justify-start gap-3 mb-4"> 
                                    <img src="/images/singapore.png" class="w-[23px] h-[23px] rounded-full"> 
                                    <img src="/images/indonesia.png" class="w-[23px] h-[23px] rounded-full"> 
                                    <img src="/images/malaysia.png" class="w-[23px] h-[23px] rounded-full"> 
                                    <img src="/images/vietnam.png" class="w-[23px] h-[23px] rounded-full"> 
                                    <img src="/images/china.png" class="w-[23px] h-[23px] rounded-full"> 
                                    <img src="/images/hongkong.png" class="w-[23px] h-[23px] rounded-full"> 
                                </div> 
                                <!-- Deskripsi --> 
                                <p class="font-poppins text-white text-[15px] leading-relaxed tracking-wide"> Secara resmi diluncurkan pada tahun 2015 di Singapura, Glints telah memberdayakan lebih dari 5 juta bakat dan 60.000 organisasi untuk mewujudkan potensi manusia mereka. </p> 
                            </div> 
                        </div> 
                    </div> 
                    <!-- Kolom 2: Untuk Pencari Kerja --> 
                     <div class="text-center lg:text-left"> 
                        <h3 class="!font-semibold !text-gray-400 !text-[16px] !mb-4">Untuk Pencari Kerja</h3> 
                        <ul class="space-y-2"> 
                            <li><a href="#" class="!text-[14px] !font-poppins !tracking-wide no-underline !no-underline">Lokasi Pekerjaan</a></li> 
                            <li><a href="#" class="text-[14px] font-poppins tracking-wide no-underline !no-underline">Nama Perusahaan</a></li> 
                            <li><a href="#" class="text-[14px] font-poppins tracking-wide no-underline !no-underline">Kategori Pekerjaan</a></li> 
                            <li><a href="#" class="text-[14px] font-poppins tracking-wide no-underline !no-underline">Lowongan Kerja Populer</a></li> 
                            <li><a href="#" class="text-[14px] font-poppins tracking-wide no-underline !no-underline ">Help Center</a></li> 
                        </ul> 
                    </div> 
                    <!-- Kolom 3: Untuk Pemberi Kerja --> 
                    <div class="text-center lg:text-left"> 
                        <h3 class="font-semibold text-gray-400 text-[16px] mb-4">
                            Untuk Pemberi Kerja
                        </h3> 
                        <ul class="space-y-2"> 
                            <li>
                                <a href="#" class="text-[14px] font-poppins tracking-wide">Untuk Pemberi Kerja</a>
                            </li> <li><a href="#" class="text-[14px] font-poppins tracking-wide">HR Tips</a>
                        </li> 
                        <li>
                            <a href="#" class="text-[14px] font-poppins tracking-wide">Glints Platform</a>
                        </li> 
                        <li>
                            <a href="#" class="text-[14px] font-poppins tracking-wide">Perekrutan</a>
                        </li> 
                        <li>
                            <a href="#" class="text-[14px] font-poppins tracking-wide">Bakat Terkelola</a>
                        </li> 
                    </ul> 
                </div> 
                <!-- Kolom 4: Perusahaan --> 
                <div class="text-center lg:text-left"> 
                    <h3 class="font-semibold text-gray-400 text-[16px] mb-4">Perusahaan</h3> 
                    <ul class="space-y-2"> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Tentang Kami</a></li> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Hired Blog</a></li> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Inside Glints</a></li> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Tech Blog</a></li> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Careers</a></li> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Report Vulnerability</a></li> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Perjanjian Pengguna</a></li> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Kebijakan Privasi</a></li> 
                        <li><a href="#" class="text-[14px] font-poppins tracking-wide">Syarat & Ketentuan</a></li> 
                    </ul> 
                </div> 
                <!-- Kolom 5: Kominfo & App --> 
                <div class="text-center lg:text-left"> 
                    <h3 class="text-white text-[16px] mb-3 font-poppins tracking-wide">Terdaftar dan diawasi oleh</h3> 
                    <div class="flex justify-center lg:justify-start items-center space-x-4 mb-6"> 
                        <img src="/images/kominfo2.webp" alt="Kominfo" class="h-12"> 
                        <img src="/images/kementerian2.webp" alt="Kemnaker" class="h-12"> 
                    </div> 
                    <h3 class="text-white text-[15px] mb-3 font-poppins tracking-wide">Dapatkan Aplikasi Glints</h3> 
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4"> 
                        <div class="w-32 h-32 bg-white rounded flex items-center justify-center"> 
                            <img src="/images/mobile-app-download-qr-code-id-footer.webp" alt="QR Code" class="w-28 h-28 object-contain"> 
                        </div> 
                        <div class="flex flex-col space-y-3"> 
                            <a href="#"><img src="/images/google-play-badge-id.png" class="h-12"></a> 
                            <a href="#"><img src="/images/apple-store-badge-id.png" class="h-12"></a> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <!-- Social Media --> 
            <div class="flex flex-wrap justify-center lg:justify-start gap-6 my-6"> 
                <a href="#" class="text-white"><i class="fab fa-instagram text-[28px]"></i></a> 
                <a href="#" class="text-white"><i class="fab fa-youtube text-[28px]"></i></a> 
                <a href="#" class="text-white"><i class="fab fa-facebook text-[28px]"></i></a> 
                <a href="#" class="text-white"><i class="fab fa-linkedin text-[28px]"></i></a> 
                <a href="#" class="text-white"><i class="fas fa-envelope text-[28px]"></i></a> 
                <a href="#" class="text-white"><i class="fab fa-tiktok text-[28px]"></i></a> 
            </div> 
            <!-- Copyright --> 
            <p class="text-center lg:text-left text-white text-[14px] font-poppins tracking-wide">&copy; 2025 PT. Glints Indonesia Group</p> 
        </div> 
    </footer> 
    
    {{-- Modal Login --}} 
    @include('auth.login-modal') 
    
<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileBtn = document.getElementById('mobileBtn'); // kasih ID di tombol menu
        const langBtn = document.getElementById('langBtn');
        const langMenu = document.getElementById('langMenu');
        const langIcon = document.getElementById('langIcon');
        const currentLang = document.getElementById('current-lang'); // kalau mau update teks ID/EN

        // Toggle Mobile Menu
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function (event) {
                if (!mobileBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });

            // Close mobile menu on resize to desktop
            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1024) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }

        // Toggle Language Dropdown
        function toggleLang() {
        document.getElementById('lang-menu').classList.toggle('hidden');
    }

    function setLang(lang) {
        document.getElementById('current-lang').innerText = lang;
        document.getElementById('lang-menu').classList.add('hidden');
    }
        
    });
</script>

            
            @stack('scripts') 
            
            {{-- Bootstrap JS for Modal Only --}}
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            
            {{-- JS --}} 
            <script src="{{ asset('js/app.js') }}"></script> 
            @stack('scripts') 
</body> 
</html>