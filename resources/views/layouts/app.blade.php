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
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full mx-auto px-25 py-0">
        <div class="flex items-center justify-between">
            
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img src="{{ asset('images/logohome.svg') }}" alt="Glints Logo" class="h-14 lg:h-20 w-auto">
                </a>
            </div>

            <!-- Navigation Menu - Desktop -->
            <nav class="hidden lg:flex items-center space-x-8 -ml-90">
                <a href="{{ route('jobs.index') }}" class="text-black hover:underline underline-offset-6 decoration-black decoration-2 font-normal text-base transition-colors duration-200">LOWONGAN KERJA</a>

                <a href="{{ route('companies.index') }}" class="text-black hover:underline underline-offset-6 decoration-black decoration-2 font-normal text-base transition-colors duration-200">PERUSAHAAN</a>
                <a href="{{ route('blog') }}" target="_blank" rel="noopener noreferrer" class="text-black hover:underline underline-offset-6 decoration-black decoration-2 font-normal text-base transition-colors duration-200">BLOG</a>
                <a href="#" class="text-black hover:underline underline-offset-6 decoration-black decoration-2 font-normal text-base transition-colors duration-200">EXPERTCLASS</a>
            </nav>

            <!-- Right Side Action Buttons -->
            <div class="flex items-center space-x-3">
                <!-- Download App Button -->
                <a href="#" class="hidden lg:flex items-center bg-[#01579b] hover:bg-blue-700 text-white px-4 py-2 rounded-none text-sm font-medium transition-colors duration-200">
                    <span>UNDUH APP GLINTS</span>
                </a>

                  <!-- Language/Region Selector -->
                  <div class="relative">
                      <button id="langBtn" 
                        class="text-black focus:outline-none text-base font-medium inline-flex items-center gap-1 
                              border-b-3 border-transparent hover:border-black transition-all duration-200">
                        <i class="fas fa-globe"></i>
                        <span>ID</span>
                        <i id="langIcon" class="fas fa-chevron-down text-xs"></i>
                    </button> 


                      <!-- Dropdown -->
                      <div id="langMenu" class="hidden absolute left-0 mt-2 w-36 bg-white border border-gray-200 rounded-none shadow-lg z-50">
                          <ul class="py-1 text-sm text-black uppercase">
                              <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">ENGLISH</a></li>
                              <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">INDONESIAN</a></li>
                          </ul>
                      </div>
                  </div>



                <!-- Additional Buttons -->
                <a href="{{ route('register') }}" class="hidden lg:flex items-center text-black hover:underline underline-offset-7 decoration-2 decoration-black text-base font-medium transition-colors duration-200">DAFTAR</a>
                <a href="{{ route('login') }}" class="hidden lg:flex items-center text-black hover:underline underline-offset-7 decoration-2 decoration-black text-base font-medium transition-colors duration-200">MASUK</a>

                <!-- For Company Button (dipaksa ke kanan) -->
                <div class="ml-6">
                    <a href="{{ route('companies.index') }}" class="hidden lg:flex items-center border border-[#01579b] text-[#01579b] hover:bg-[#01579b] hover:text-white px-4 py-2.5 rounded-none text-sm font-medium transition-all duration-200">
                        <span>UNTUK PERUSAHAAN</span>
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button type="button" class="lg:hidden bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-expanded="false" onclick="toggleMobileMenu()">
                    <span class="sr-only">Open menu</span>
                    <i class="fas fa-bars" id="mobile-menu-icon"></i>
                </button>
            </div>
        </div>
    </div>

   <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden fixed top-0 right-0 h-full w-72 bg-[#01579b] text-white shadow-lg z-50 overflow-y-auto">
        <div class="flex justify-end p-4">
            <!-- Close Button -->
            <button onclick="toggleMobileMenu()" class="text-white text-2xl">
                &times;
            </button>
        </div>
        <nav class="flex flex-col space-y-2 px-6">
            <!-- Unduh App -->
            <a href="#" class="border border-white text-white px-4 py-2 text-sm font-medium text-center hover:bg-white hover:text-[#01579b] transition">
                UNDUH APP GLINTS
            </a>

            <hr class="border-white/40">

            <!-- Auth -->
            <a href="{{ route('login') }}" class="px-2 py-2 rounded hover:bg-white/10">MASUK</a>
            <a href="{{ route('register') }}" class="px-2 py-2 rounded hover:bg-white/10">DAFTAR</a>

            <hr class="border-white/40">

            <!-- Menu Utama -->
            <a href="{{ route('jobs.index') }}" class="px-2 py-2 rounded hover:bg-white/10">LOWONGAN KERJA</a>
            <a href="{{ route('companies.index') }}" class="px-2 py-2 rounded hover:bg-white/10">PERUSAHAAN</a>
            <a href="{{ route('blog') }}" class="px-2 py-2 rounded hover:bg-white/10">BLOG</a>
            <a href="#" class="px-2 py-2 rounded hover:bg-white/10">EXPERTCLASS</a>

            <hr class="border-white/40">

            <!-- Untuk Perusahaan -->
            <a href="{{ route('companies.index') }}" class="flex items-center justify-between px-2 py-2 rounded hover:bg-white/10 transition">
                UNTUK PERUSAHAAN 
                <i class="fas fa-arrow-right ml-2"></i>
            </a>

            <!-- Language Dropdown -->
            <div class="relative mt-4">
                <button onclick="toggleLang()" class="flex items-center space-x-2 px-2 py-2 rounded hover:bg-white/10 w-full">
                    <i class="fas fa-globe"></i>
                    <span id="current-lang">ID</span>
                    <i class="fas fa-chevron-down text-xs ml-auto"></i>
                </button>
                <div id="lang-menu" class="hidden absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg">
                    <a href="#" onclick="setLang('ID')" class="block px-4 py-2 hover:bg-gray-200">Indonesia</a>
                    <a href="#" onclick="setLang('EN')" class="block px-4 py-2 hover:bg-gray-200">English</a>
                </div>
            </div>
        </nav>
    </div>

</header>


<!-- Main Content -->
<main>
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
                        <p class="font-poppins text-white text-[15px] leading-relaxed tracking-wide">
                            Secara resmi diluncurkan pada tahun 2015 di Singapura, Glints telah memberdayakan lebih dari 5 juta bakat dan 60.000 organisasi untuk mewujudkan potensi manusia mereka.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kolom 2: Untuk Pencari Kerja -->
            <div class="text-center lg:text-left">
                <h3 class="font-semibold text-gray-400 text-[16px] mb-4">Untuk Pencari Kerja</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Lokasi Pekerjaan</a></li>
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Nama Perusahaan</a></li>
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Kategori Pekerjaan</a></li>
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Lowongan Kerja Populer</a></li>
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Help Center</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Untuk Pemberi Kerja -->
            <div class="text-center lg:text-left">
                <h3 class="font-semibold text-gray-400 text-[16px] mb-4">Untuk Pemberi Kerja</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Untuk Pemberi Kerja</a></li>
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">HR Tips</a></li>
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Glints Platform</a></li>
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Perekrutan</a></li>
                    <li><a href="#" class="text-[14px] font-poppins tracking-wide">Bakat Terkelola</a></li>
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
</script>

@stack('scripts')
</body>
</html>
