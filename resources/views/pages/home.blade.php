@extends('layouts.app')

@section('title', 'Glints - Platform Lowongan Kerja Terbesar di Indonesia')

@section('content')
    <!-- Hero Section -->
<section class="bg-gradient-to-b from-blue-50 to-white py-5">
  <div class="container mx-auto px-6 text-center">
    <h1 class="text-4xl md:text-4xl font-extrabold text-gray-900 leading-tight max-w-3xl mx-auto">
      Cari 40,000+ Loker di Indonesia
    </h1>

    <!-- Search Bar -->
    <form class="flex items-center gap-3 w-full max-w-4xl mx-auto py-10">
  <!-- Input keyword -->
  <div class="flex-1">
    <input 
      type="text" 
      placeholder="Cari Nama Pekerjaan, Skill, dan Perusahaan" 
      class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
  </div>

  <!-- Dropdown lokasi -->
  <div class="flex-1">
    <select 
      class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
      <option>Semua Kota/Provinsi</option>
      <option>Jakarta</option>
      <option>Bandung</option>
      <option>Surabaya</option>
    </select>
  </div>

  <!-- Tombol -->
  <button 
    type="submit" 
    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700"
  >
    Cari
  </button>
</form>

  </div>
</section>

<section class="py-10 bg-gray-50">
  <div class="container mx-auto px-4">
    <!-- Judul -->
    <h2 class="text-lg font-semibold text-gray-800 mb-6">
      Kategori pekerjaan populer
    </h2>

    <!-- Grid semua kategori -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4 max-w-6xl">
      <!-- Kategori biasa -->
      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        Admin & HR
      </a>
      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        Marketing
      </a>
      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        Operasional
      </a>
      <!-- Aktif Merekrut -->
      <a href="#" class="border border-red-400 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center gap-2 text-red-600 font-medium">
        <i class="fas fa-fire"></i> Aktif Merekrut
      </a>

      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        Supply Chain & Logistik
      </a>
      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        Business Development & Sales
      </a>
      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        Akuntansi & Keuangan
      </a>
      <!-- Remote -->
      <a href="#" class="border border-yellow-400 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center gap-2 text-yellow-600 font-medium">
        <i class="fas fa-globe"></i> WFH/Remote
      </a>

      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        Desain
      </a>
      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        Media & Komunikasi
      </a>
      <a href="#" class="border border-gray-300 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center">
        IT
      </a>
      <!-- Fresh Graduate -->
      <a href="#" class="border border-blue-400 rounded-md py-3 px-2 text-center hover:shadow-md transition flex items-center justify-center gap-2 text-blue-600 font-medium">
        <i class="fas fa-graduation-cap"></i> Fresh Graduate
      </a>
    </div>
  </div>
  <a
  href="#"
  class="fixed bottom-10 right-5 bg-green-500 hover:bg-green-600 text-white 
         w-16 h-16 flex items-center justify-center rounded-full shadow-lg z-50"
>
  <i class="fab fa-whatsapp text-4xl"></i>
</a>
</section>


   <section class="py-10 bg-gray-50">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
      
      <!-- Urgent Hiring -->
      <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
          Dibutuhkan Segera
        </h2>
        <div class="flex flex-wrap gap-3">
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Data Analyst</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Digital Marketing</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Customer Service</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Admin</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Desain Grafis</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Penulisan Konten</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Quality Assurance</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Web Developer</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Human Resource (HRD)</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">UI/UX Designer</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Content Creator</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Product Manager</span>
          <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Social Media Specialist</span>
        </div>
      </div>

      <!-- Trusted Companies -->
      <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
          Perusahaan Terpercaya, merekrut
        </h2>
        <div class="flex items-center flex-wrap gap-6">
          <img src="/images/megaCentralFinance.webp" alt="MCF" class="h-13 transition duration-200">
          <img src="/images/oppo.webp" alt="OPPO" class="h-14 transition duration-200">
          <img src="/images/restoranKasAmerica.webp" alt="A&W" class="h-13 transition duration-200">
          <img src="images/ruangGuru.webp" alt="Ruangguru" class="h-13 transition duration-200">
          <a href="#" class="text-blue-600 hover:underline text-sm">Lainnya...</a>
        </div>
      </div>

    </div>
  </div>
</section>



<section class="bg-yellow-400">
  <div class="container mx-auto px-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 items-stretch gap-12">

      <!-- Left content -->
      <div class="flex flex-col justify-center text-center lg:text-left py-12">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
          Cepat. Mudah. Terupdate.
        </h2>
        <p class="text-lg text-gray-800 mb-2">
          Ngobrolin lamaran kerja dengan HRD
        </p>
        <p class="text-xl font-semibold text-gray-900 mb-6">
          #TinggalChatAja
        </p>

        <!-- QR Section -->
        <div class="flex items-center justify-center lg:justify-start gap-4">
          <!-- QR Code -->
          <div class="w-28 h-28">
            <img 
              src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/yellowBanner/qrCode.webp" 
              alt="QR Code" 
              class="w-full h-full object-contain"
            >
          </div>
          <!-- Scan to Download -->
          <div class="w-36">
            <img 
              src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/yellowBanner/scanToDownload_ID.webp" 
              alt="Scan to Download" 
              class="w-full object-contain"
            >
          </div>
        </div>
      </div>

      <!-- Right Phone Image -->
      <div class="flex justify-center items-end">
        <img 
          src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/yellowBanner/phoneDesktop_ID.webp" 
          alt="Phone App Preview" 
          class="w-full max-w-md object-contain drop-shadow-2xl"
        >
      </div>

    </div>
  </div>
</section>



   <!-- App Promotion Section -->
<section class="bg-[#0C1C3C] py-16 text-white">
  <div class="container mx-auto px-6 text-center">

    <!-- Title -->
    <h2 class="text-3xl lg:text-4xl font-bold mb-4">
      Cari. Lamar. Dapat kerja. Serba bisa di aplikasi!
    </h2>
    <p class="text-lg text-blue-100 max-w-3xl mx-auto mb-12">
      Maksimalkan pencarian kerja dengan rekomendasi loker khusus buat kamu, 
      notifikasi loker baru, dan update status dari loker kamu — semua dalam genggamanmu.
    </p>

   <!-- Phone Images (horizontal row, sejajar bawah) -->
<div class="flex justify-center items-end gap-8 mb-16">
  <!-- Phone 1 -->
  <div class="flex">
    <img 
      src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/blueBanner/phoneDesktop1_ID.webp" 
      alt="Phone Preview 1" 
      class="w-52 lg:w-60"
    >
  </div>

  <!-- Phone 2 with gradient fade -->
  <div class="relative flex">
    <img 
      src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/blueBanner/phoneDesktop2_ID.webp" 
      alt="Phone Preview 2" 
      class="w-52 lg:w-60"
    >
    <!-- Gradient Fade -->
    <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-t from-[#0C1C3C] to-transparent"></div>
  </div>

  <!-- Phone 3 -->
  <div class="flex">
    <img 
      src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/blueBanner/phoneDesktop3_ID.webp" 
      alt="Phone Preview 3" 
      class="w-52 lg:w-60"
    >
  </div>
</div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-8 max-w-4xl mx-auto">
      <!-- Left text -->
      <div class="text-center lg:text-left">
        <h3 class="text-xl font-bold mb-2">Dapatkan Aplikasi Glints</h3>
        <p class="text-blue-100 text-sm">
          Temukan pekerjaan dan karier impianmu dengan lebih banyak fitur di aplikasi.
        </p>
      </div>

      <!-- QR Code -->
      <div class="flex flex-col items-center lg:items-start gap-3">
        <img 
          src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/blueBanner/qrCode.webp" 
          alt="QR Code" 
          class="w-28 h-28"
        >
        <button class="bg-yellow-400 text-blue-900 font-bold px-5 py-2 rounded">
          SCAN UNTUK DOWNLOAD
        </button>
      </div>
    </div>

  </div>
</section>



    <!-- Testimonials Section -->
<section class="bg-gray-50 py-16">
  <div class="container mx-auto px-6 text-center">

    <!-- Title -->
    <h2 class="text-3xl lg:text-4xl font-bold mb-4">
      4 juta talenta dapat kerja via Glints
    </h2>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-12">
      Pelajari tips cari kerja di Glints dari mereka. Kalau mereka bisa, maka kamu juga!
    </p>

    <!-- Testimonials Grid -->
    <div class="grid gap-8 md:grid-cols-3">

      <!-- Card 1 -->
      <a href="https://glints.com/id/lowongan/bangun-karier-sesuai-passion-jadi-penulis/?utm_source=website&utm_medium=testimonial&utm_campaign=talent-stories" 
         target="_blank"
         class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center text-center hover:shadow-xl transition">
        <img src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/testimonials/user1.webp" 
             alt="Testimonial user"
             class="w-24 h-24 rounded-full object-cover mb-4">
        <p class="text-gray-700 italic mb-4">
          "Glints jadi platform cari kerja yang paling mudah & cepat buatku. Aku berhasil career switch ke bidang yang jadi passion-ku dan dapat kerja cuma dalam 4 hari."
        </p>
        <p class="text-sm text-gray-500 font-medium">
          Windya A., 24 tahun <br> <span class="text-gray-700">Strategi Konten</span>
        </p>
      </a>

      <!-- Card 2 -->
      <a href="https://glints.com/id/lowongan/sukses-berkarier-di-bidang-it/?utm_source=website&utm_medium=testimonial&utm_campaign=talent-stories" 
         target="_blank"
         class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center text-center hover:shadow-xl transition">
        <img src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/testimonials/user2.webp" 
             alt="Testimonial user"
             class="w-24 h-24 rounded-full object-cover mb-4">
        <p class="text-gray-700 italic mb-4">
          "Lewat Glints, aku bisa dapat pekerjaan yang bikin aku puas dan orang tua bangga. Prosesnya cepat, cuma 4 hari aku langsung dihubungi rekruter."
        </p>
        <p class="text-sm text-gray-500 font-medium">
          Dimas B Wicaksono, 26 tahun <br> <span class="text-gray-700">Senior Account Executive</span>
        </p>
      </a>

      <!-- Card 3 -->
      <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center text-center hover:shadow-xl transition">
        <img src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/testimonials/user3.webp" 
             alt="Testimonial user"
             class="w-24 h-24 rounded-full object-cover mb-4">
        <p class="text-gray-700 italic mb-4">
          "Lewat Glints, aku berhasil mematahkan stigma jurusanku & berhasil dapat kerja sebelum lulus. Prosesnya cepat, aku diterima seminggu setelah interview."
        </p>
        <p class="text-sm text-gray-500 font-medium">
          Ashalia T. Tasha, 21 tahun <br> <span class="text-gray-700">Komunikasi Pemasaran</span>
        </p>
      </div>

    </div>
  </div>
</section>


   <!-- Map Section -->
<section class="bg-white py-16">
  <div class="container mx-auto px-6 text-center">

    <!-- Title -->
    <h2 class="text-3xl lg:text-4xl font-bold mb-8">
      Temukan loker di kota besar atau sekitarmu
    </h2>

    <!-- Map Image -->
    <div class="flex justify-center mb-8">
      <img src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/dst/homePage/mapSection/map.webp"
           alt="Temukan loker di kota besar atau sekitarmu"
           class="rounded-lg shadow-lg max-w-4xl w-full object-cover">
    </div>

    <!-- City Links -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 text-sm font-medium">
      <a href="/id/job-location/indonesia/dki-jakarta" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Jakarta</a>
      <a href="/id/job-location/indonesia/banten/tangerang" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Tangerang</a>
      <a href="/id/job-location/indonesia/jawa-tengah/semarang" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Semarang</a>
      <a href="/id/job-location/indonesia/jawa-barat/depok" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Depok</a>
      <a href="/id/job-location/indonesia/jawa-barat/bandung" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Bandung</a>
      <a href="/id/job-location/indonesia/jawa-timur/surabaya" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Surabaya</a>
      <a href="/id/job-location/indonesia/jawa-barat/bogor" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Bogor</a>
      <a href="/id/job-location/indonesia/sumatra-utara/medan" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Medan</a>
      <a href="/id/job-location/indonesia/di-yogyakarta-jogja/yogyakarta-jogja" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Yogyakarta</a>
      <a href="/id/job-location/indonesia/jawa-barat/bekasi" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Bekasi</a>
      <a href="/id/job-location/indonesia/jawa-timur/malang" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Malang</a>
      <a href="/id/job-location/indonesia/sulawesi-selatan/makassar" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Makassar</a>
    </div>

  </div>
</section>


   <section class="bg-white py-10">
  <div class="container mx-auto px-6">
    <!-- Title -->
    <h2 class="text-xl font-semibold mb-4">
      Pencarian populer di Glints
    </h2>

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-4">
      <ul class="flex space-x-6">
        <li>
          <button 
            class="tab-btn border-b-2 border-blue-500 text-blue-600 pb-2 font-medium"
            data-tab="posisi">
            Posisi Pekerjaan
          </button>
        </li>
        <li>
          <button 
            class="tab-btn text-gray-600 hover:text-blue-600 pb-2 font-medium"
            data-tab="kategori">
            Kategori Pekerjaan
          </button>
        </li>
        <li>
          <button 
            class="tab-btn text-gray-600 hover:text-blue-600 pb-2 font-medium"
            data-tab="lokasi">
            Lokasi
          </button>
        </li>
        <li>
          <button 
            class="tab-btn text-gray-600 hover:text-blue-600 pb-2 font-medium"
            data-tab="kata-kunci">
            Kata Kunci
          </button>
        </li>
      </ul>
    </div>

    <div id="posisi" class="tab-content flex flex-wrap gap-x-2 gap-y-2 text-sm">
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Penulis
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Rekruter
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Customer Service
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Akuntan
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Manager Sales
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Sales Executive
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Account Manager
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker UI/UX Designer
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Editor Video &amp; Film
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Digital Marketing Manager
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Frontend Developer
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Backend Developer
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Android Developer
  </a>
  <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Desainer Grafis &amp; Brand
  </a>
  <a href="#" class="underline">Loker Manager Perkantoran</a>
</div>


    <!-- Tab content lain (kosong dulu, bisa diisi sesuai kebutuhan) -->
    <div id="kategori" class="tab-content hidden gap-x-2 gap-y-2 text-sm">
    <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Human Resources (HR)
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Admin
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Supply Chain & Logistik
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Hotel, Restaurant & Travel
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Marketing
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Legal, Consulting & Translation
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Finance
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Legal Services
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Kesehatan
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Konsultan
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Information Technology
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Desain
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Product Management
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Software Development
    </a>
    <a href="#" class="underline">Loker Web Development</a>
    </div>

    <div id="lokasi" class="tab-content hidden gap-x-2 gap-y-2 text-sm">
    <a href="#" class="underline after:content-[','] last:after:content-['']">
    Loker Jakarta
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Jakarta Selatan
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Jakarta Pusat
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Jakarta Barat
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Jakarta Utara
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Jakarta Timur
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Bandung
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Karawang
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Surabaya
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Medan
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Palembang
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Tangerang
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Bogor
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Pekanbaru
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Semarang
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Batam
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Makassar
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Sleman
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Malang
    </a>
    <a href="#" class="underline">Loker Sidoarjo</a>

    </div>
    <div id="kata-kunci" class="tab-content hidden gap-x-2 gap-y-2 text-sm">
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Project Based Online
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Work From Home Online
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Fresh Graduate
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        WFH/Remote
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker BUMN
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Supir Pribadi
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Asisten Virtual
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Copywriter
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Guru Online
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Ilustrator
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Wedding Organizer
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Data Entry
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Lulusan SMA
    </a>
    <a href="#" class="underline after:content-[','] last:after:content-['']">
        Loker Freelance Writer
    </a>
    <a href="#" class="underline">Loker Model</a>

    </div>
  </div>
</section>

<script>
  // Tab interaktif
  const tabs = document.querySelectorAll('.tab-btn');
  const contents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      // reset semua tab
      tabs.forEach(t => t.classList.remove('border-blue-500', 'text-blue-600'));
      tabs.forEach(t => t.classList.add('text-gray-600'));

      // aktifkan tab yang diklik
      tab.classList.add('border-blue-500', 'text-blue-600');
      tab.classList.remove('text-gray-600');

      // sembunyikan semua konten
      contents.forEach(c => c.classList.add('hidden'));
      
      // tampilkan konten sesuai data-tab
      document.getElementById(tab.dataset.tab).classList.remove('hidden');
    });
  });
</script>

@endsection

@push('styles')
<style>
    /* Custom styles for homepage */
    .feature-card:hover {
        border-color: #FF750F;
    }
</style>
@endpush