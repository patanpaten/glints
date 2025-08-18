@extends('layouts.app')

@section('title', 'Glints - Platform Lowongan Kerja Terbesar di Indonesia')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Cari 40,000+ loker di Indonesia</h1>
                
                <!-- Search Bar -->
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-orange-500 focus:border-orange-500" placeholder="Cari Nama Pekerjaan, Skill, dan Perusahaan">
                            </div>
                        </div>
                        <div class="w-full md:w-48">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                <select class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                                    <option>Semua Lokasi</option>
                                    <option>Jakarta</option>
                                    <option>Bandung</option>
                                    <option>Surabaya</option>
                                    <option>Yogyakarta</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full md:w-auto">
                            <button type="submit" class="w-full md:w-auto bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-8 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Popular Categories -->
            <div class="mt-8">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-user-tie text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Admin & HR</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-bullhorn text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Marketing</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-cogs text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Operasional</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-truck text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Supply Chain & Logistik</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-chart-line text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Business Development & Sales</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-calculator text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Akuntansi & Keuangan</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-paint-brush text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Desain</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-newspaper text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Media & Komunikasi</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-laptop-code text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">IT</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-graduation-cap text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Fresh Graduate</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-briefcase text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Aktif Merekrut</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-home text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">WFH/Remote</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Urgent Hiring Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Dibutuhkan Segera</h2>
                <div class="flex flex-wrap gap-3">
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Data Analyst</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Digital Marketing</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Customer Service</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Admin</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Desain Grafis</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Penulisan Konten</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Web Developer</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">UI/UX Designer</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Social Media Specialist</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Project Manager</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">HR Specialist</a>
                    <a href="#" class="bg-white border border-gray-200 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition duration-200">Content Creator</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted Companies Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Perusahaan Terpercaya</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-200">
                        <div class="bg-gray-100 w-full h-12 flex items-center justify-center rounded">MCF</div>
                    </div>
                    <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-200">
                        <div class="bg-gray-100 w-full h-12 flex items-center justify-center rounded">OPPO</div>
                    </div>
                    <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-200">
                        <div class="bg-gray-100 w-full h-12 flex items-center justify-center rounded">A&W</div>
                    </div>
                    <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-200">
                        <div class="bg-gray-100 w-full h-12 flex items-center justify-center rounded">Ruangguru</div>
                    </div>
                    <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-200">
                        <div class="bg-gray-100 w-full h-12 flex items-center justify-center rounded">Tokopedia</div>
                    </div>
                    <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-200">
                        <div class="bg-gray-100 w-full h-12 flex items-center justify-center rounded">Gojek</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- App Promotion Section -->
    <section class="py-12 bg-gradient-to-r from-yellow-400 to-blue-500">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h2 class="text-3xl font-bold text-white mb-4">Cari. Lamar. Dapat kerja.</h2>
                    <h3 class="text-2xl font-bold text-white mb-6">Serba bisa di aplikasi!</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-black text-white px-6 py-3 rounded-lg flex items-center">
                            <i class="fab fa-google-play text-2xl mr-3"></i>
                            <div>
                                <div class="text-xs">GET IT ON</div>
                                <div class="text-sm font-medium">Google Play</div>
                            </div>
                        </a>
                        <a href="#" class="bg-black text-white px-6 py-3 rounded-lg flex items-center">
                            <i class="fab fa-apple text-2xl mr-3"></i>
                            <div>
                                <div class="text-xs">Download on the</div>
                                <div class="text-sm font-medium">App Store</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="bg-white rounded-xl shadow-lg h-80 w-40 flex items-center justify-center">
                        <span class="text-gray-400">App Mockup</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Testimoni Pengguna</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-gray-200 mr-4 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Andi Pratama</h4>
                                <p class="text-sm text-gray-500">24 tahun, Web Developer</p>
                            </div>
                        </div>
                        <p class="text-gray-600">"Berkat Glints, saya berhasil mendapatkan pekerjaan impian saya sebagai Web Developer di perusahaan teknologi terkemuka hanya dalam waktu 2 minggu!"</p>
                        <div class="mt-4 flex text-orange-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-gray-200 mr-4 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Siti Nurhaliza</h4>
                                <p class="text-sm text-gray-500">27 tahun, Marketing Manager</p>
                            </div>
                        </div>
                        <p class="text-gray-600">"Platform yang sangat user-friendly dan memiliki banyak lowongan berkualitas. Saya menemukan pekerjaan yang sesuai dengan passion saya di bidang marketing."</p>
                        <div class="mt-4 flex text-orange-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-gray-200 mr-4 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Budi Santoso</h4>
                                <p class="text-sm text-gray-500">22 tahun, Fresh Graduate</p>
                            </div>
                        </div>
                        <p class="text-gray-600">"Sebagai fresh graduate, Glints sangat membantu saya menemukan pekerjaan pertama yang sesuai dengan latar belakang pendidikan saya. Proses lamarnya juga sangat mudah!"</p>
                        <div class="mt-4 flex text-orange-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Indonesia Map Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Cari Lowongan di Kota Besar Indonesia</h2>
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-8 md:mb-0 flex justify-center">
                        <div class="relative w-full max-w-md">
                            <!-- Simplified Indonesia Map with Dot Matrix -->
                            <svg viewBox="0 0 400 200" class="w-full">
                                <g fill="#FF750F" fill-opacity="0.2">
                                    <!-- Simplified dot matrix representation of Indonesia -->
                                    <!-- This is a placeholder - in a real implementation you would have actual coordinates -->
                                    <circle cx="100" cy="100" r="3" fill="#FF750F" fill-opacity="0.6"/>
                                    <circle cx="110" cy="95" r="3" fill="#FF750F" fill-opacity="0.6"/>
                                    <circle cx="120" cy="100" r="3" fill="#FF750F" fill-opacity="0.6"/>
                                    <circle cx="130" cy="105" r="3" fill="#FF750F" fill-opacity="0.6"/>
                                    <circle cx="140" cy="100" r="3" fill="#FF750F" fill-opacity="0.6"/>
                                    <circle cx="150" cy="95" r="3" fill="#FF750F" fill-opacity="0.6"/>
                                    <!-- Jakarta - bigger dot -->
                                    <circle cx="140" cy="100" r="5" fill="#FF750F" fill-opacity="1"/>
                                    <!-- More dots would be added to form Indonesia's islands -->
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <div class="grid grid-cols-2 gap-4">
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Jakarta</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Depok</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Bogor</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Bekasi</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Tangerang</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Bandung</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Medan</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Malang</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Semarang</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Surabaya</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Yogyakarta</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Makassar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Searches Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Pencarian Populer</h2>
                
                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-8">
                        <a href="#" class="border-orange-500 text-orange-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Posisi Pekerjaan</a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Kategori Pekerjaan</a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Lokasi</a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Kata Kunci</a>
                    </nav>
                </div>
                
                <!-- Links -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Penulis</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Rekruter</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Customer Service</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker UI/UX Designer</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Backend Developer</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Digital Marketing</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Data Analyst</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Content Writer</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Graphic Designer</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Social Media Specialist</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Frontend Developer</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker HR Manager</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Project Manager</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Business Analyst</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Product Manager</a>
                    <a href="#" class="text-gray-700 hover:text-orange-500 text-sm">Loker Full Stack Developer</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Custom styles for homepage */
    .feature-card:hover {
        border-color: #FF750F;
    }
</style>
@endpush