@extends('layouts.app')

@section('title', $job->title . ' - ' . $job->company->name . ' | Glints')

@section('content')
<!-- Job Detail Section -->
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Job Header -->
        <div class="p-6 border-b">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    @if($job->company->logo)
                        <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-16 h-16 object-contain mr-4">
                    @else
                        <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-md mr-4">
                            <span class="text-gray-500 text-xl font-bold">{{ substr($job->company->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h1>
                        <div class="flex items-center mt-1">
                            <a href="#" class="text-blue-600 hover:underline font-medium">{{ $job->company->name }}</a>
                            @if($job->company->is_verified)
                                <span class="ml-2 bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">Verified</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:items-end">
                    <div class="mb-2">
                        <span class="inline-block bg-orange-100 text-orange-800 text-sm px-3 py-1 rounded-full">{{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}</span>
                    </div>
                    <div class="text-sm text-gray-500">
                        <span>Diposting {{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Job Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Left Column: Job Details -->
                <div class="md:col-span-2">
                    <!-- Job Overview -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Pekerjaan</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>
                    
                    <!-- Job Requirements -->
                    @if($job->requirements)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Persyaratan</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Job Responsibilities -->
                    @if($job->responsibilities)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Tanggung Jawab</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($job->responsibilities)) !!}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Job Benefits -->
                    @if($job->benefits)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Benefit</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($job->benefits)) !!}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Required Skills -->
                    @if($job->skills->count() > 0)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Keahlian yang Dibutuhkan</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($job->skills as $skill)
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Right Column: Job Meta & Apply -->
                <div class="md:col-span-1">
                    <!-- Apply Button -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        @if(Auth::check() && Auth::user()->isJobSeeker())
                            @if($hasApplied)
                                <button disabled class="w-full bg-gray-400 text-white font-medium py-3 px-4 rounded-md cursor-not-allowed mb-2">Sudah Melamar</button>
                                <p class="text-sm text-gray-500 text-center">Kamu sudah melamar pekerjaan ini</p>
                            @else
                                <a href="{{ route('jobs.apply', $job->slug) }}" class="block w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-md text-center transition duration-200 mb-2">Lamar Sekarang</a>
                                <p class="text-sm text-gray-500 text-center">Proses lamaran cepat dan mudah</p>
                            @endif
                        @elseif(Auth::check() && !Auth::user()->isJobSeeker())
                            <p class="text-sm text-gray-500 text-center mb-2">Kamu tidak dapat melamar sebagai perusahaan</p>
                            <a href="{{ route('jobseeker.register') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-md text-center transition duration-200">Daftar sebagai Pencari Kerja</a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-md text-center transition duration-200 mb-2">Login untuk Melamar</a>
                            <a href="{{ route('register') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-md text-center transition duration-200">Daftar Sekarang</a>
                        @endif
                    </div>
                    
                    <!-- Job Meta Info -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pekerjaan</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="text-gray-500 w-5 h-5 mr-3 mt-0.5">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Lokasi</span>
                                    <span class="block text-gray-600">{{ $job->location }}</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="text-gray-500 w-5 h-5 mr-3 mt-0.5">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Tipe Pekerjaan</span>
                                    <span class="block text-gray-600">{{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="text-gray-500 w-5 h-5 mr-3 mt-0.5">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Pengalaman</span>
                                    <span class="block text-gray-600">{{ ucfirst(str_replace('_', ' ', $job->experience_level)) }}</span>
                                </div>
                            </li>
                            @if($job->salary_range)
                            <li class="flex items-start">
                                <div class="text-gray-500 w-5 h-5 mr-3 mt-0.5">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Gaji</span>
                                    <span class="block text-gray-600">{{ $job->salary_range }}</span>
                                </div>
                            </li>
                            @endif
                            <li class="flex items-start">
                                <div class="text-gray-500 w-5 h-5 mr-3 mt-0.5">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Kategori</span>
                                    <span class="block text-gray-600">{{ $job->jobCategory->name }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Jobs Section -->
    @if($relatedJobs->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Pekerjaan Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedJobs as $relatedJob)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        @if($relatedJob->company->logo)
                            <img src="{{ asset('storage/' . $relatedJob->company->logo) }}" alt="{{ $relatedJob->company->name }}" class="w-12 h-12 object-contain mr-3">
                        @else
                            <div class="w-12 h-12 bg-gray-200 flex items-center justify-center rounded-md mr-3">
                                <span class="text-gray-500 text-lg font-bold">{{ substr($relatedJob->company->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <h3 class="font-medium text-gray-900 line-clamp-1">{{ $relatedJob->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $relatedJob->company->name }}</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center text-sm text-gray-500 mb-1">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $relatedJob->location }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-briefcase mr-2"></i>
                            <span>{{ ucfirst(str_replace('_', ' ', $relatedJob->employment_type)) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('jobs.show', $relatedJob->slug) }}" target="_blank" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-md text-center text-sm transition duration-200">Lihat Detail</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection