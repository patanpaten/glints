@extends('layouts.app')

@section('title', 'Glints - Platform Lowongan Kerja Terbesar di Indonesia')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4">
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
                                    <option>Semua Kota/Provinsi</option>
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
            <h1 class="display-4 fw-bold mb-4">Find Your Dream Job Today</h1>
            <p class="lead mb-5">Connect with top employers and discover opportunities that match your skills and aspirations.</p>
            <form action="{{ route('jobs.index') }}" method="GET" class="row g-3 justify-content-center">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Job title, keywords, or company">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select form-select-lg">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\JobCategory::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Search</button>
    </section>
            </form>
    <!-- Trusted Companies Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Perusahaan Terpercaya</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <h2 class="text-center mb-5">Featured Jobs</h2>
                    <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-200">
                        <img src="{{ asset('images/placeholder-logo.svg') }}" alt="Ruangguru" class="max-h-12">
                    </div>
                        <div class="card h-100 shadow-sm">
                        <img src="{{ asset('images/placeholder-logo.svg') }}" alt="Tokopedia" class="max-h-12">
                                <h5 class="card-title">{{ $job->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $job->company->name }}</h6>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary">{{ $job->job_type }}</span>
                                    <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h2 class="text-3xl font-bold text-white mb-4">Cari. Lamar. Dapat kerja.</h2>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ route('jobs.show', $job->id) }}" target="_blank" class="btn btn-outline-primary w-100">View Details</a>
                            <i class="fab fa-google-play text-2xl mr-3"></i>
                            <div>
                                <div class="text-xs">GET IT ON</div>
                                <div class="text-sm font-medium">Google Play</div>
                            </div>
            <div class="text-center mt-4">
                <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">View All Jobs</a>
            </div>
                        </a>
                        <a href="#" class="bg-black text-white px-6 py-3 rounded-lg flex items-center">
                            <i class="fab fa-apple text-2xl mr-3"></i>
                            <div>
                                <div class="text-xs">Download on the</div>
                                <div class="text-sm font-medium">App Store</div>
            <h2 class="text-center mb-5">Browse by Category</h2>
                </div>
                @foreach(\App\Models\JobCategory::withCount('jobs')->orderByDesc('jobs_count')->take(8)->get() as $category)
                <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Testimoni Pengguna</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="card feature-card h-100 text-center shadow-sm">
                        <div class="flex items-center mb-4">
                                    <i class="bi bi-briefcase fs-1 text-primary mb-3"></i>
                                <p class="text-sm text-gray-500">24 tahun, Web Developer</p>
                            </div>
                        <p class="text-gray-600">"Berkat Glints, saya berhasil mendapatkan pekerjaan impian saya sebagai Web Developer di perusahaan teknologi terkemuka hanya dalam waktu 2 minggu!"</p>
                        <div class="mt-4 flex text-orange-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/placeholder-user.svg') }}" alt="User" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-medium text-gray-900">Siti Nurhaliza</h4>
                                <p class="text-sm text-gray-500">27 tahun, Marketing Manager</p>
            <h2 class="text-center mb-5">Why Choose Glints?</h2>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                    <div class="card feature-card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-search fs-1 text-primary mb-3"></i>
                            <img src="{{ asset('images/placeholder-user.svg') }}" alt="User" class="w-12 h-12 rounded-full mr-4">
                            <p class="card-text">Browse thousands of job listings from top companies across various industries.</p>
                                <p class="text-sm text-gray-500">22 tahun, Fresh Graduate</p>
                            </div>
                        </div>
                        <p class="text-gray-600">"Sebagai fresh graduate, Glints sangat membantu saya menemukan pekerjaan pertama yang sesuai dengan latar belakang pendidikan saya. Proses lamarnya juga sangat mudah!"</p>
                    <div class="card feature-card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-person-badge fs-1 text-primary mb-3"></i>
                            <i class="fas fa-star"></i>
                            <p class="card-text">Create a comprehensive profile to showcase your skills and experience to employers.</p>
                </div>
            </div>
        </div>
    </section>
                    <div class="card feature-card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-building fs-1 text-primary mb-3"></i>
                <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Cari Lowongan di Kota Besar Indonesia</h2>
                            <p class="card-text">Post job openings and find qualified candidates for your company's positions.</p>
                        <div class="relative w-full max-w-md">
                            <!-- Simplified Indonesia Map with Dot Matrix -->
                            <svg viewBox="0 0 400 200" class="w-full">
                                <g fill="#FF750F" fill-opacity="0.2">
                                    <!-- Simplified dot matrix representation of Indonesia -->
                                    <!-- This is a placeholder - in a real implementation you would have actual coordinates -->
                                    <circle cx="100" cy="100" r="3" fill="#FF750F" fill-opacity="0.6"/>
                                    <circle cx="110" cy="95" r="3" fill="#FF750F" fill-opacity="0.6"/>
    <section class="py-5 bg-primary text-white text-center">
                                    <circle cx="130" cy="105" r="3" fill="#FF750F" fill-opacity="0.6"/>
            <h2 class="mb-4">Ready to Start Your Career Journey?</h2>
            <p class="lead mb-4">Join thousands of job seekers who have found their dream jobs through Glints.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 me-2">Sign Up Now</a>
            <a href="{{ route('jobs.index') }}" class="btn btn-outline-light btn-lg px-4">Browse Jobs</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Bogor</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Bekasi</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Tangerang</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Bandung</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Medan</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Malang</a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Semarang</a>
                <div class="col-md-4 mb-4">
                    <h5>Glints</h5>
                    <p>Your trusted platform for finding the perfect job match and advancing your career.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>For Job Seekers</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('jobs.index') }}" class="text-white">Browse Jobs</a></li>
                        <li><a href="#" class="text-white">Career Advice</a></li>
                        <li><a href="#" class="text-white">Resume Tips</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>For Employers</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('register') }}" class="text-white">Post a Job</a></li>
                        <li><a href="#" class="text-white">Hiring Solutions</a></li>
                        <li><a href="#" class="text-white">Pricing</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Company</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}" class="text-white">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white">Contact Us</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Connect</h5>
                    <div class="d-flex gap-3 fs-4">
                    </div>
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