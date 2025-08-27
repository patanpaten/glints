@extends('layouts.blog')

@section('title', 'Glints TapLoker Blog - Tips Karir & Lowongan Kerja')

@section('content')
    <!-- Hero Section -->
    <section style="background-color: #FFEF4F; padding: 50px 0;">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">

                <!-- Judul -->
                <h2 style="font-size: 28px; font-weight: 700; color: #000;">Glints TapLoker Blog</h2>

                <!-- Subjudul -->
                <p style="color: #000; font-size: 16px; margin-top: 4px;">Artikel karier &amp; pengembangan diri</p>

                <!-- Jarak -->
                <div style="height: 24px;"></div>

                <!-- Search Bar -->
                <form action="{{ route('blog') }}" method="GET"
                    style="display: flex; max-width: 600px; margin: 0 auto; border: 1px solid #555; background-color: white;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel"
                        style="flex: 1; padding: 10px; border: none; outline: none; font-size: 16px; background-color: white;">
                    <button type="submit"
                        style="background-color: #0077B6; border: none; padding: 0 16px; cursor: pointer;">
                        <i class="fas fa-search" style="color: white;"></i>
                    </button>
                </form>

                <!-- Jarak -->
                <div style="height: 24px;"></div>
            </div>
        </div>
    </section>




    <!-- Rekomendasi Glints Section - Full Width -->
    <section class="py-12 bg-white">
        <div class="w-full px-6">
            <div class="max-w-none mx-0">
                <h3 class="text-2xl font-bold text-gray-900">Rekomendasi Glints</h3>
                <hr class="my-4 border-gray-200">

                <div class="overflow-x-auto">
                    <ul class="flex gap-6 pb-4" style="width: max-content;">

                        <!-- Artikel 1 -->
                        <a href="#" class="block">
                            <li
                                class="carouselItem w-80 flex-shrink-0 border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200">

                                <!-- Gambar background -->
                                <div class="frame h-48 bg-center bg-cover"
                                    style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2024/12/Daftar-Gaji-2024.webp');">
                                </div>

                                <!-- Label -->
                                <i class="block text-sm text-blue-700 mt-2 px-2">Konten Eksklusif</i>

                                <!-- Judul -->
                                <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                    Daftar Gaji 2025 &amp; Panduan Negosiasi untuk Pemula
                                </b>

                                <!-- Info penulis & tanggal -->
                                <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                    <span>Idzni Meutia</span>
                                    <span>09 Des 2024</span>
                                </div>

                                <!-- Waktu baca -->
                                <p class="text-xs text-gray-500 px-2 mb-2">Dibaca 18 mnt</p>
                            </li>
                        </a>


                        <!-- Artikel 2 -->
                        <a href="https://glints.com/id/lowongan/kalender-2025-dan-tanggal-merah/" target="_self"
                            rel="follow noopener noreferrer" class="block">
                            <li
                                class="carouselItem w-80 flex-shrink-0 overflow-hidden transition-shadow duration-200 hover:shadow-lg">

                                <!-- Gambar -->
                                <div class="frame h-48 bg-center bg-cover"
                                    style="background-image: url('https://glints.com/id/lowongan/wp-content/uploads/2021/12/unrecognizable-businesswoman-sitting-desk-with-laptop-looking-calendar.jpg');">
                                </div>

                                <!-- Kategori -->
                                <i class="block text-sm text-blue-700 mt-2 px-2">Kehidupan Profesional</i>

                                <!-- Judul -->
                                <b class="block text-gray-900 text-base leading-snug mt-1 px-1 hover:underline">
                                    Kalender 2025: Ini Dia Tanggal Merah &amp; Cuti Bersamanya
                                </b>

                                <!-- Penulis & Tanggal -->
                                <div class="flex justify-between text-xs text-gray-500 mt-1 px-1">
                                    <span>Alisatul Aini</span>
                                    <span>18 Okt 2024</span>
                                </div>

                                <!-- Lama baca -->
                                <p class="text-xs text-gray-500 px-1 mb-2">Dibaca 9 mnt</p>
                            </li>
                        </a>


                        <!-- Artikel 3 -->
                        <a href="https://glints.com/id/lowongan/kalkulator-pph-21/" target="_self"
                            rel="follow noopener noreferrer" class="block">
                            <li
                                class="carouselItem w-80 flex-shrink-0 overflow-hidden transition-shadow duration-200 hover:shadow-lg">

                                <!-- Gambar -->
                                <div class="frame h-48 bg-center bg-cover"
                                    style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2024/02/Featured-Image.jpg');">
                                </div>

                                <!-- Kategori -->
                                <i class="block text-sm text-blue-700 mt-2 px-2">Kehidupan Profesional</i>

                                <!-- Judul -->
                                <b class="block text-gray-900 text-base leading-snug mt-1 px-1 hover:underline">
                                    Kalkulator PPh 21 dan Gaji Bersih: Download Excel Gratis di Sini
                                </b>

                                <!-- Penulis & Tanggal -->
                                <div class="flex justify-between text-xs text-gray-500 mt-1 px-1">
                                    <span>Glints Indonesia</span>
                                    <span>16 Feb 2024</span>
                                </div>

                                <!-- Lama baca -->
                                <p class="text-xs text-gray-500 px-1 mb-2">Dibaca 5 mnt</p>
                            </li>
                        </a>


                        <!-- Artikel 4 -->
                        <a href="https://glints.com/id/lowongan/kalender-2025-dan-tanggal-merah/" target="_self"
                            rel="follow noopener noreferrer" class="block">
                            <li
                                class="carouselItem w-80 flex-shrink-0 border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200">

                                <!-- Gambar -->
                                <div class="frame h-48 bg-center bg-cover"
                                    style="background-image: url('https://glints.com/id/lowongan/wp-content/uploads/2021/12/unrecognizable-businesswoman-sitting-desk-with-laptop-looking-calendar.jpg');">
                                </div>

                                <!-- Kategori -->
                                <i class="block text-sm text-blue-700 mt-2 px-2">Kehidupan Profesional</i>

                                <!-- Judul -->
                                <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                    Kalender 2025: Ini Dia Tanggal Merah &amp; Cuti Bersamanya
                                </b>

                                <!-- Penulis & Tanggal -->
                                <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                    <span>Alisatul Aini</span>
                                    <span>18 Okt 2024</span>
                                </div>

                                <!-- Waktu baca -->
                                <p class="text-xs text-gray-500 px-2 mb-2">Dibaca 9 mnt</p>
                            </li>
                        </a>

                        {{-- artikel 5  --}}
                        <a href="https://glints.com/id/lowongan/kalender-2025-dan-tanggal-merah/" target="_self"
                            rel="follow noopener noreferrer" class="block">
                            <li
                                class="carouselItem w-80 flex-shrink-0 border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200">

                                <!-- Gambar -->
                                <div class="frame h-48 bg-center bg-cover"
                                    style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2021/09/Featured-Image-.png');">
                                </div>

                                <!-- Kategori -->
                                <i class="block text-sm text-blue-700 mt-2 px-2">KONTEN EKSKLUSIF</i>

                                <!-- Judul -->
                                <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                    Contoh CV ATS-friendly Plus Cara Membuat & Template Gratis
                                </b>

                                <!-- Penulis & Tanggal -->
                                <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                    <span> Glints Indonesia </span>
                                    <span> 22 Sep 2021 </span>
                                </div>

                                <!-- Waktu baca -->
                                <p class="text-xs text-gray-500 px-2 mb-2"> Dibaca 18 mnt</p>
                            </li>
                        </a>


                    </ul>
                </div>
            </div>
        </div>
    </section>


    <style>
        .carouselItem {
            background-color: white;
        }

        .frame {
            background-size: cover;
            background-position: center center;
        }
    </style>


    <!-- Main Content -->
    <section class="py-12 bg-white">
        <div class="w-full px-6">
            <div class="max-w-none mx-0">
                <div class="flex gap-8">
                    <!-- Left Content -->
                    <div class="w-2/3">

                        <!-- Artikel Terbaru Section -->
                        <div class="mb-12">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terbaru</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <a href="https://glints.com/id/lowongan/sales-dan-marketing/" target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem">

                                        <!-- Gambar -->
                                        <div class="frame h-48 bg-center bg-cover"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2018/01/perbedaan-sales-dan-marketing.jpg');">
                                        </div>

                                        <!-- Kategori -->
                                        <i class="block text-sm text-blue-700 mt-2 px-2"> Perencanaan Karier </i>

                                        <!-- Judul -->
                                        <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                            Perbedaan Sales dan Marketing: Definisi hingga Prospek Kariernya
                                        </b>

                                        <!-- Penulis & Tanggal -->
                                        <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                            <span> Shely Napitupulu </span>
                                            <span> 20 Agu 2025 </span>
                                        </div>

                                        <!-- Waktu baca -->
                                        <p class="text-xs text-gray-500 px-2 mb-2"> Dibaca 9 mnt</p>
                                    </li>
                                </a>

                                <a href="https://glints.com/id/lowongan/tips-bergabung-sebagai-relawan/"target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem">

                                        <!-- Gambar -->
                                        <div class="frame h-48 bg-center bg-cover"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2018/01/relawan-cover.png');">
                                        </div>

                                        <!-- Kategori -->
                                        <i class="block text-sm text-blue-700 mt-2 px-2"> Dunia Kerja </i>

                                        <!-- Judul -->
                                        <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                            Ingin Menjadi Relawan untuk Kegiatan Sosial? Yuk, Simak 7 Tips ini!
                                        </b>

                                        <!-- Penulis & Tanggal -->
                                        <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                            <span> Mutia Isni Rahayu </span>
                                            <span> 19 Agu 2025 </span>
                                        </div>

                                        <!-- Waktu baca -->
                                        <p class="text-xs text-gray-500 px-2 mb-2"> Dibaca 6 mnt</p>
                                    </li>
                                </a>


                                <a href="https://glints.com/id/lowongan/mahasiswa-di-konferensi-internasional/"
                                    target="_self" rel="follow noopener noreferrer">
                                    <li class="carouselItem">

                                        <!-- Gambar -->
                                        <div class="frame h-48 bg-center bg-cover"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2018/01/konferensi-internasional.jpg');">
                                        </div>

                                        <!-- Kategori -->
                                        <i class="block text-sm text-blue-700 mt-2 px-2"> Kegiatan & Organisasi Kampus </i>

                                        <!-- Judul -->
                                        <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                            6 Hal yang Perlu Dilakukan Mahasiswa saat Konferensi Internasional
                                        </b>

                                        <!-- Penulis & Tanggal -->
                                        <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                            <span> Shely Napitupulu </span>
                                            <span> 19 Agu 2025 </span>
                                        </div>

                                        <!-- Waktu baca -->
                                        <p class="text-xs text-gray-500 px-2 mb-2"> Dibaca 6 mnt</p>
                                    </li>
                                </a>


                                <a href="https://glints.com/id/lowongan/cara-menghadapi-masalah-di-dunia-kerja/"
                                    target="_self" rel="follow noopener noreferrer">
                                    <li class="carouselItem">

                                        <!-- Gambar -->
                                        <div class="frame h-48 bg-center bg-cover"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2018/01/cara-menghadapi-masalah-cover.jpeg');">
                                        </div>

                                        <!-- Kategori -->
                                        <i class="block text-sm text-blue-700 mt-2 px-2"> Dunia Kerja </i>

                                        <!-- Judul -->
                                        <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                            7 Cara Menghadapi Masalah di Dunia Kerja a la Entrepreneur Terkenal
                                        </b>

                                        <!-- Penulis & Tanggal -->
                                        <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                            <span> Irene Gianov </span>
                                            <span> 19 Agu 2025 </span>
                                        </div>

                                        <!-- Waktu baca -->
                                        <p class="text-xs text-gray-500 px-2 mb-2"> Dibaca 7 mnt</p>
                                    </li>
                                </a>


                                <a href="https://glints.com/id/lowongan/menghadapi-kolega-negatif/" target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem">

                                        <!-- Gambar -->
                                        <div class="frame h-48 bg-center bg-cover"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2018/01/kolega-cover.jpg');">
                                        </div>

                                        <!-- Kategori -->
                                        <i class="block text-sm text-blue-700 mt-2 px-2"> Dunia Kerja </i>

                                        <!-- Judul -->
                                        <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                            8 Cara Menghadapi Kolega yang Bersikap Negatif di Kantor
                                        </b>

                                        <!-- Penulis & Tanggal -->
                                        <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                            <span> Rio Pradana </span>
                                            <span> 19 Agu 2025 </span>
                                        </div>

                                        <!-- Waktu baca -->
                                        <p class="text-xs text-gray-500 px-2 mb-2"> Dibaca 6 mnt</p>
                                    </li>
                                </a>


                                <a href="https://glints.com/id/lowongan/membangun-kesempatan-kerja/" target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem">

                                        <!-- Gambar -->
                                        <div class="frame h-48 bg-center bg-cover"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2018/01/kesempatan-karier.jpeg');">
                                        </div>

                                        <!-- Kategori -->
                                        <i class="block text-sm text-blue-700 mt-2 px-2"> Dunia Kerja </i>

                                        <!-- Judul -->
                                        <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                            6 Tips Membangun Kesempatan Kerja untuk Karier Impianmu
                                        </b>

                                        <!-- Penulis & Tanggal -->
                                        <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                            <span> Mutia Isni Rahayu </span>
                                            <span> 19 Agu 2025 </span>
                                        </div>

                                        <!-- Waktu baca -->
                                        <p class="text-xs text-gray-500 px-2 mb-2"> Dibaca 6 mnt</p>
                                    </li>
                                </a>

                                <a href="https://glints.com/id/lowongan/articles" target="_self"
                                    rel="follow noopener noreferrer">
                                    <button class="other-btn">
                                        lihat lainnya <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </button>
                                </a>

                                <style>
                                    .other-btn {
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 6px;
                                        padding: 8px 16px;
                                        font-size: 14px;
                                        font-weight: 500;
                                        color: #0073e6;
                                        background-color: transparent;
                                        border: 1px solid #0073e6;
                                        cursor: pointer;
                                        transition: all 0.2s ease;
                                        text-transform: lowercase;
                                    }

                                    .other-btn:hover {
                                        background-color: #0073e6;
                                        color: white;
                                    }

                                    .other-btn i {
                                        font-size: 12px;
                                    }
                                </style>

                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div class="w-1/3">
                        <!-- Paling Banyak Dibaca Section -->
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <!-- Gambar Iklan -->
                            <div class="ads">
                                <div>
                                    <a href="https://glints.com/id/lowongan/dokumen-lamaran-kerja-fresh-graduate/?utm_source=blog&amp;utm_medium=homepage-banner&amp;utm_campaign=fresh-graduate-kit&amp;utm_content=dokumen-lamaran-kerja-fresh-graduate-28-may-24"
                                        target="_self" rel="follow noopener noreferrer">

                                        <img width="2000" height="1999"
                                            src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_2000,h_1999/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022.jpg"
                                            data-src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_2000,h_1999/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022.jpg"
                                            class="image wp-image-113578 attachment-full size-full lazyloaded"
                                            alt="" style="max-width: 100%; height: auto;" decoding="async"
                                            data-srcset="
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_2000/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022.jpg 2000w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_300/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-300x300.jpg 300w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_1024/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-1024x1024.jpg 1024w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_150/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-150x150.jpg 150w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_768/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-768x768.jpg 768w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_1536/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-1536x1536.jpg 1536w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_144/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-144x144.jpg 144w"
                                            sizes="(max-width: 2000px) 100vw, 2000px"
                                            srcset="
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_2000/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022.jpg 2000w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_300/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-300x300.jpg 300w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_1024/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-1024x1024.jpg 1024w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_150/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-150x150.jpg 150w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_768/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-768x768.jpg 768w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_1536/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-1536x1536.jpg 1536w, 
                                                https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_144/https://glints.com/id/lowongan/wp-content/uploads/2022/09/Fresh-Graduate-Starter-kit_Homepage-Banner-Sep2022-144x144.jpg 144w">
                                    </a>
                                </div>
                            </div>


                            <!-- Judul -->
                            <h3 class="text-xl font-bold text-gray-900">Paling Banyak Dibaca</h3>
                            <hr class="my-3">

                            <!-- Daftar Artikel -->
                            <ul class="space-y-4">
                                <a href="https://glints.com/id/lowongan/kelebihan-dan-kelemahan/" target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem flex space-x-3">
                                        <div class="frame lazyloaded w-20 h-20 flex-shrink-0 rounded"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2021/08/confident-asian-businesswoman-sitting-meeting-office-smiling.jpg'); background-size: cover; background-position: center center;">
                                        </div>
                                        <div class="flex-1">
                                            <i class="block text-sm text-blue-700 mt-2 px-2"> Pencarian Kerja </i>
                                            <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                                60 Contoh Kelebihan dan Kekurangan untuk Jawaban Interview
                                            </b>
                                            <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                                <span> Andre Oliver </span>
                                            </div>
                                        </div>
                                    </li>
                                </a>

                                <a href="https://glints.com/id/lowongan/cek-ijazah-online-dikti/" target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem flex space-x-3">
                                        <div class="frame lazyloaded w-20 h-20 flex-shrink-0 rounded"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2024/03/96231-1.jpg'); background-size: cover; background-position: center center;">
                                        </div>
                                        <div class="flex-1">
                                            <i class="block text-sm text-blue-700 mt-2 px-2"> Kehidupan Mahasiswa </i>
                                            <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                                Cara Cek Ijazah Online SD hingga S1 di Situs Dikti & Kemdikbud
                                            </b>
                                            <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                                <span> M. Ichsan Medina </span>
                                            </div>
                                        </div>
                                    </li>
                                </a>

                                <a href="https://glints.com/id/lowongan/contoh-cv-lamaran-kerja/"target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem flex space-x-3">
                                        <div class="frame lazyloaded w-20 h-20 flex-shrink-0 rounded"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2023/11/3D8EA4AE-0F8C-4D61-84E3-D20336391E4D.jpeg'); background-size: cover; background-position: center center;">
                                        </div>
                                        <div class="flex-1">
                                            <i class="block text-sm text-blue-700 mt-2 px-2"> CV </i>
                                            <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                                36 Contoh CV Lamaran Kerja dan Template Gratisnya
                                            </b>
                                            <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                                <span> Alisatul Aini </span>
                                            </div>
                                        </div>
                                    </li>
                                </a>

                                <a href="https://glints.com/id/lowongan/cv-ats-friendly/" target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem flex space-x-3">
                                        <div class="frame lazyloaded w-20 h-20 flex-shrink-0 rounded"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2021/09/Featured-Image-.png'); background-size: cover; background-position: center center;">
                                        </div>
                                        <div class="flex-1">
                                            <i class="block text-sm text-blue-700 mt-2 px-2"> Konten Eksklusif </i>
                                            <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                                Contoh CV ATS-friendly Plus Cara Membuat & Template Gratis
                                            </b>
                                            <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                                <span> Glints Indonesia </span>
                                            </div>
                                        </div>
                                    </li>
                                </a>

                                <a href="https://glints.com/id/lowongan/pertanyaan-wawancara-kerja/" target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem flex space-x-3">
                                        <div class="frame lazyloaded w-20 h-20 flex-shrink-0 rounded"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2018/01/pexels-photo-288477.jpeg'); background-size: cover; background-position: center center;">
                                        </div>
                                        <div class="flex-1">
                                            <i class="block text-sm text-blue-700 mt-2 px-2"> Pencarian Kerja </i>
                                            <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                                30 Pertanyaan Interview Kerja dan Contoh Jawaban yang Baik
                                            </b>
                                            <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                                <span> Shely Napitupulu </span>
                                            </div>
                                        </div>
                                    </li>
                                </a>

                                <a href="https://glints.com/id/lowongan/contoh-soal-psikotes-jawaban/" target="_self"
                                    rel="follow noopener noreferrer">
                                    <li class="carouselItem flex space-x-3">
                                        <div class="frame lazyloaded w-20 h-20 flex-shrink-0 rounded"
                                            style="background-image: url('https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://glints.com/id/lowongan/wp-content/uploads/2018/01/persiapan-psikotes-kerja.jpg'); background-size: cover; background-position: center center;">
                                        </div>
                                        <div class="flex-1">
                                            <i class="block text-sm text-blue-700 mt-2 px-2"> Pencarian Kerja </i>
                                            <b class="block text-gray-900 text-base leading-snug px-2 mt-1 line-clamp-2">
                                                80 Contoh Soal Psikotes Lengkap + Jawaban & Penjelasannya
                                            </b>
                                            <div class="flex justify-between text-xs text-gray-500 px-2 mt-1">
                                                <span> Tim Glints TapLoker </span>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pilih Topik Section -->
    <section class="py-12 bg-gray-50">
        <div class="w-full px-8">
            <div class="max-w-none mx-0">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Pilih Topik</h2>
                <div class="mb-8">
                    <!-- Baris pertama - 3 card -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 px-80">
                        @php
                            $topicsRow1 = [
                                [
                                    'name' => 'Pencarian Kerja',
                                    'color' => 'border-orange-400',
                                    'bg' => 'bg-gray-100',
                                    'hoverBg' => 'hover:bg-orange-100',
                                ],
                                [
                                    'name' => 'Kehidupan Profesional',
                                    'color' => 'border-gray-400',
                                    'bg' => 'bg-gray-100',
                                    'hoverBg' => 'hover:bg-gray-200',
                                ],
                                [
                                    'name' => 'Perencanaan Karier',
                                    'color' => 'border-yellow-400',
                                    'bg' => 'bg-gray-100',
                                    'hoverBg' => 'hover:bg-yellow-100',
                                ],
                            ];
                        @endphp
                        @foreach ($topicsRow1 as $topic)
                            <a href="{{ route('blog', ['category' => [$topic['name']]]) }}"
                                class="{{ $topic['bg'] }} border-b-4 {{ $topic['color'] }} p-6 rounded-lg text-center {{ $topic['hoverBg'] }} hover:shadow-md transition-all duration-200">
                                <span class="text-sm font-bold text-gray-800">{{ $topic['name'] }}</span>
                            </a>
                        @endforeach
                    </div>

                    <!-- Baris kedua - 2 card -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto px-20">
                        @php
                            $topicsRow2 = [
                                [
                                    'name' => 'Mengatur Keuangan',
                                    'color' => 'border-gray-400',
                                    'bg' => 'bg-gray-100',
                                    'hoverBg' => 'hover:bg-gray-200',
                                ],
                                [
                                    'name' => 'Kehidupan Mahasiswa',
                                    'color' => 'border-blue-400',
                                    'bg' => 'bg-gray-100',
                                    'hoverBg' => 'hover:bg-blue-100',
                                ],
                            ];
                        @endphp
                        @foreach ($topicsRow2 as $topic)
                            <a href="{{ route('blog', ['category' => [$topic['name']]]) }}"
                                class="{{ $topic['bg'] }} border-b-4 {{ $topic['color'] }} p-6 rounded-lg text-center {{ $topic['hoverBg'] }} hover:shadow-md transition-all duration-200">
                                <span class="text-sm font-bold text-gray-800">{{ $topic['name'] }}</span>
                            </a>
                        @endforeach
                    </div>

                </div>
                <div class="text-center">
                    <a href="{{ route('blog') }}"
                        class="inline-block border-2 border-blue-500 text-blue-500 px-8 py-3 rounded-lg font-medium hover:bg-blue-500 hover:text-white transition-colors duration-200">
                        LIHAT LAINNYA →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row justify-between items-start gap-8">
                    <!-- Logo Section -->
                    <div class="lg:w-1/4">
                        <div class="flex items-center mb-3">
                            <div class="bg-white p-1 rounded mr-2">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L3.09 8.26L12 14L20.91 8.26L12 2Z" />
                                    <path d="M3.09 15.74L12 22L20.91 15.74L12 9.48L3.09 15.74Z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold">glints</div>
                                <div class="text-xs text-blue-400">TapLoker</div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-2 mb-3">
                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs font-medium transition-colors w-28">
                                BERLANGGANAN
                            </button>
                            <button
                                class="bg-transparent border border-white hover:bg-white hover:text-black text-white px-3 py-1.5 rounded text-xs font-medium transition-colors w-28">
                                CARI LOWONGAN
                            </button>
                        </div>
                    </div>

                    <!-- Categories Grid -->
                    <div class="lg:w-3/4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Kategori Topik -->
                            <div>
                                <h4 class="font-bold mb-3 text-white text-xs tracking-wider">KATEGORI TOPIK</h4>
                                <ul class="space-y-1.5 text-xs text-gray-400">
                                    <li><a href="#" class="hover:text-white transition-colors">Pencarian Kerja</a>
                                    </li>
                                    <li><a href="#" class="hover:text-white transition-colors">Kehidupan
                                            Profesional</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Perencanaan
                                            Karier</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Kehidupan
                                            Mahasiswa</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Konten Eksklusif</a>
                                    </li>
                                    <li><a href="#" class="hover:text-white transition-colors">Kabar Glints</a></li>
                                </ul>
                            </div>

                            <!-- Media Sosial -->
                            <div>
                                <h4 class="font-bold mb-3 text-white text-xs tracking-wider">MEDIA SOSIAL</h4>
                                <ul class="space-y-1.5 text-xs text-gray-400">
                                    <li><a href="#" class="hover:text-white transition-colors">Facebook</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Twitter</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Instagram</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">LinkedIn</a></li>
                                </ul>
                            </div>

                            <!-- Cari Kerja Berdasarkan -->
                            <div>
                                <h4 class="font-bold mb-3 text-white text-xs tracking-wider">CARI KERJA BERDASARKAN</h4>
                                <ul class="space-y-1.5 text-xs text-gray-400">
                                    <li><a href="#" class="hover:text-white transition-colors">Lokasi</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Nama Perusahaan</a>
                                    </li>
                                    <li><a href="#" class="hover:text-white transition-colors">Kategori</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Paling Banyak
                                            Dicari</a></li>
                                </ul>
                            </div>

                            <!-- Tambah Ilmu & Skill -->
                            <div>
                                <h4 class="font-bold mb-3 text-white text-xs tracking-wider">TAMBAH ILMU & SKILL</h4>
                                <ul class="space-y-1.5 text-xs text-gray-400">
                                    <li><a href="#" class="hover:text-white transition-colors">All Topics</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Articles</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">author</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">Search</a></li>
                                    <li><a href="#" class="hover:text-white transition-colors">tags</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <script>
        function sortArticles(sortValue) {
            const url = new URL(window.location);
            url.searchParams.set('sort', sortValue);
            window.location.href = url.toString();
        }
    </script>
@endsection