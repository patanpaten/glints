@extends('layouts.jobseeker')

@section('title', 'Lowongan Kerja Terbaru di Indonesia | Glints')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-6 border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <form action="{{ route('jobseeker.jobs') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-stretch">

                    <!-- Input Keyword -->
                    <div class="flex-1">
                        <div class="relative flex items-center border border-gray-300 rounded-lg bg-white px-11 py-2">
                            <!-- Input -->
                            <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}"
                                placeholder="Cari Nama Pekerjaan, Skill, dan Perusahaan"
                                aria-label="Cari Nama Pekerjaan, Skill, dan Perusahaan"
                                class="flex-1 text-gray-900 text-sm focus:outline-none placeholder-gray-500">
                            <!-- Icon Search -->
                            <div class="absolute left-3 text-gray-500 pointer-events-none">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 100 100">
                                    <path
                                        d="M70 43c0-14.886-12.114-27-27-27S16 28.114 16 43s12.114 27 27 27 27-12.114 27-27zm30 49.308c0 4.206-3.486 7.692-7.692 7.692-2.044 0-4.027-.841-5.409-2.284L66.286 77.163c-7.031 4.868-15.445 7.452-23.978 7.452C18.93 84.615 0 65.685 0 42.308 0 18.93 18.93 0 42.308 0c23.377 0 42.307 18.93 42.307 42.308 0 8.533-2.584 16.947-7.452 23.978L97.776 86.9C99.16 88.281 100 90.264 100 92.308z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Input Location -->
                    <div class="flex-1 md:w-64">
                        <div class="relative flex items-center border border-gray-300 rounded-lg bg-white px-9 py-2">
                            <!-- Input -->
                            <input type="text" id="location" name="location"
                                value="{{ request('location') ?? 'All Cities/Provinces' }}"
                                placeholder="Tambahkan kota/provinsi" aria-label="Tambahkan kota/provinsi"
                                class="flex-1 text-gray-900 text-sm focus:outline-none placeholder-gray-500">

                            <!-- Start Icon -->
                            <div class="absolute left-3 text-gray-500 pointer-events-none">
                                <svg width="1em" height="1em" fill="currentColor" viewBox="0 0 100 100">
                                    <path
                                        d="M24.491 10.268C31.485 3.423 39.893 0 49.714 0c9.822 0 18.23 3.423 25.224 10.268 6.994 6.845 10.49 15.104 10.49 24.777 0 7.738-2.976 17.038-8.928 27.901-5.952 10.864-11.905 19.792-17.857 26.786L49.714 100c-1.041-1.042-2.343-2.493-3.906-4.353-1.562-1.86-4.39-5.468-8.482-10.826-4.092-5.357-7.701-10.565-10.826-15.625-3.125-5.06-5.99-10.788-8.594-17.187C15.302 45.61 14 39.955 14 35.045c0-9.673 3.497-17.932 10.491-24.777zm16.072 33.705c2.53 2.381 5.58 3.572 9.151 3.572 3.572 0 6.585-1.228 9.04-3.683 2.456-2.456 3.684-5.395 3.684-8.817 0-3.423-1.228-6.362-3.684-8.817-2.455-2.456-5.468-3.683-9.04-3.683-3.571 0-6.585 1.227-9.04 3.683-2.455 2.455-3.683 5.394-3.683 8.817 0 3.422 1.19 6.398 3.571 8.928z" />
                                </svg>
                            </div>

                            <!-- Clear Button -->
                            @if (request('location'))
                                <button type="button" onclick="clearLocation()"
                                    class="absolute right-3 text-gray-400 hover:text-gray-600">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 100 100">
                                        <path
                                            d="M50 0C22.386 0 0 22.386 0 50s22.386 50 50 50 50-22.386 50-50S77.614 0 50 0zm25 68.75L68.75 75 50 56.25 31.25 75 25 68.75 43.75 50 25 31.25 31.25 25 50 43.75 68.75 25 75 31.25 56.25 50 75 68.75z" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Search Button -->
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2 min-w-[120px]">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 100 100">
                            <path
                                d="M70 43c0-14.886-12.114-27-27-27S16 28.114 16 43s12.114 27 27 27 27-12.114 27-27zm30 49.308c0 4.206-3.486 7.692-7.692 7.692-2.044 0-4.027-.841-5.409-2.284L66.286 77.163c-7.031 4.868-15.445 7.452-23.978 7.452C18.93 84.615 0 65.685 0 42.308 0 18.93 18.93 0 42.308 0c23.377 0 42.307 18.93 42.307 42.308 0 8.533-2.584 16.947-7.452 23.978L97.776 86.9C99.16 88.281 100 90.264 100 92.308z" />
                        </svg>
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Jobs Listing -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Results Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">
                        @if(request('keyword') || request('location'))
                            Hasil Pencarian Lowongan Kerja
                        @else
                            Lowongan Kerja Terbaru
                        @endif
                    </h1>
                    <div class="text-sm text-gray-600">
                        {{ $jobs->total() }} lowongan ditemukan
                        <!-- Debug: {{ $jobs->count() }} items on current page -->
                    </div>
                </div>

                <!-- Job Cards -->
                <div class="space-y-4">
                    @forelse($jobs as $job)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-4 mb-3">
                                        <!-- Company Logo -->
                                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                            @if($job->company && $job->company->logo)
                                                <img src="{{ Storage::url($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 100 100">
                                                    <path d="M20 20h60v60H20z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                                <a href="{{ route('jobseeker.jobs.show', $job->slug) }}" class="hover:text-blue-600 transition-colors">
                                                    {{ $job->title }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 text-sm">
                                                {{ $job->company->name ?? 'Company' }} • {{ $job->location }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <p class="text-gray-700 text-sm line-clamp-2">
                                            {{ Str::limit($job->description, 150) }}
                                        </p>
                                    </div>
                                    
                                    <div class="flex items-center gap-4 text-sm text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 100 100">
                                                <path d="M50 10c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zm0 72c-17.673 0-32-14.327-32-32s14.327-32 32-32 32 14.327 32 32-14.327 32-32 32zm16-32H50V34c0-2.209-1.791-4-4-4s-4 1.791-4 4v20c0 2.209 1.791 4 4 4h20c2.209 0 4-1.791 4-4s-1.791-4-4-4z"/>
                                            </svg>
                                            {{ $job->employment_type }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 100 100">
                                                <path d="M85 25H15c-2.761 0-5 2.239-5 5v40c0 2.761 2.239 5 5 5h70c2.761 0 5-2.239 5-5V30c0-2.761-2.239-5-5-5zM15 35h70v30H15V35zm70-5v5H15v-5h70z"/>
                                            </svg>
                                            @if($job->salary_min && $job->salary_max)
                                                Rp {{ number_format($job->salary_min) }} - Rp {{ number_format($job->salary_max) }}
                                            @else
                                                Gaji Kompetitif
                                            @endif
                                        </span>
                                        <span>{{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                
                                <!-- Save Job Button -->
                                <div class="ml-4">
                                    <button type="button" class="p-2 text-gray-400 hover:text-red-500 transition-colors" 
                                            onclick="toggleSaveJob({{ $job->id }})">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 100 100">
                                            <path d="M50 85L20 55V15h60v40L50 85z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 100 100">
                                <path d="M50 10c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zm0 72c-17.673 0-32-14.327-32-32s14.327-32 32-32 32 14.327 32 32-14.327 32-32 32z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada lowongan ditemukan</h3>
                            <p class="text-gray-500">Coba ubah kata kunci atau filter pencarian Anda.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($jobs->hasPages())
                    <div class="mt-8">
                        {{ $jobs->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        function clearLocation() {
            document.getElementById('location').value = 'All Cities/Provinces';
        }
        
        function toggleSaveJob(jobId) {
            // Implementation for saving/unsaving jobs
            console.log('Toggle save job:', jobId);
        }
    </script>
@endsection