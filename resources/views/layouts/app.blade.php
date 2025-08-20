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
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        <img src="{{ asset('images/logohome.svg') }}" alt="Glints Logo" class="h-14 lg:h-20 w-auto">
                    </a>
                </div>
                
                <!-- Navigation Menu - Desktop -->
                <nav class="hidden lg:flex items-center space-x-8 lg:ml-[-250px]">
                    <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-blue-600 font-normal text-sm transition-colors duration-200">LOWONGAN KERJA</a>
                    <a href="{{ route('companies.index') }}" class="text-gray-600 hover:text-blue-600 font-normal text-sm transition-colors duration-200">PERUSAHAAN</a>
                    <a href="{{ route('blog') }}" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-600 font-normal text-sm transition-colors duration-200">BLOG</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 font-normal text-sm transition-colors duration-200">EXPERTCLASS</a>
                </nav>
                
                <!-- Right Side Action Buttons -->
                <div class="flex items-center space-x-3">
                    <!-- Download App Button -->
                    <a href="#" class="hidden lg:flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-md text-sm font-medium transition-colors duration-200">
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
                    
                    <!-- For Company Button -->
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
<footer class="bg-gray-900 text-white relative overflow-hidden">
  <!-- Background image -->
  <img src="/images/footer_bg.webp" alt="Footer Background" class="absolute inset-0 w-full h-full object-cover opacity-90">

  <div class="relative container mx-auto px-6 py-12">
    <!-- Grid utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-10">

      <!-- Kolom Logo + Asia Pacific -->
      <!-- Kolom Logo + Asia Pacific -->
<div class="lg:col-span-2">
  <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-6 space-y-4 lg:space-y-0">
    
    <!-- Logo -->
    <img src="/images/logof.svg" 
         alt="Glints" 
         class="max-h-[120px] w-auto">

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
        Secara resmi diluncurkan pada tahun 2015 di Singapura, Glints telah memberdayakan lebih dari 5 juta bakat
        dan 60.000 organisasi untuk mewujudkan potensi manusia mereka.
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
    </script>
    @stack('scripts')
</body>
</html>
