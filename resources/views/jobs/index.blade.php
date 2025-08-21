@extends('layouts.app')

@section('title', 'Lowongan Kerja Terbaru di Indonesia | Glints')

@section('content')
<!-- Hero Section -->
<section class="bg-white py-6 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <form action="{{ route('jobs.index') }}" method="GET" class="flex gap-2">
                
                <!-- Input Keyword -->
                <div class="flex-1 relative bg-blue-50 rounded-lg flex items-center">
                    <i class="fas fa-search text-gray-500 ml-3"></i>
                    <input 
                        type="text" 
                        id="keyword" 
                        name="keyword" 
                        value="{{ request('keyword') }}" 
                        placeholder="Cari Nama Pekerjaan, Skill, dan Perusahaan" 
                        class="w-full bg-transparent px-3 py-3 focus:outline-none"
                    >
                </div>

                <!-- Input Location -->
                <div class="w-64 relative bg-blue-50 rounded-lg flex items-center">
                    <i class="fas fa-map-marker-alt text-gray-500 ml-3"></i>
                    <input 
                        type="text" 
                        id="location" 
                        name="location" 
                        value="{{ request('location') ?? 'All Cities/Provinces' }}" 
                        placeholder="Tambahkan kota/provinsi" 
                        class="w-full bg-transparent px-3 py-3 focus:outline-none"
                    >
                    @if(request('location'))
                        <button type="button" onclick="document.getElementById('location').value=''" class="mr-3 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    @endif
                </div>

                <!-- Button -->
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition"
                >
                    CARI
                </button>

            </form>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row">
            <!-- Sidebar/Filters -->
            <div class="w-full md:w-1/4 mb-8 md:mb-0 md:pr-8">
                <div class="bg-white p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Filter</h3>
                        <button type="button" onclick="clearFilters()" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Reset
                        </button>
                    </div>
                    
                    <form action="{{ route('jobs.index') }}" method="GET" id="filter-form">
                        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                        
                        <!-- Employment Type Filter -->
                        <div class="mb-6">
                            <h4 class="text-md font-medium text-gray-900 mb-3">Tipe Pekerjaan</h4>
                            <div class="space-y-2">
                                @php
                                    $employmentTypes = [
                                        'full_time' => 'Full Time',
                                        'part_time' => 'Part Time', 
                                        'contract' => 'Contract',
                                        'internship' => 'Internship',
                                        'freelance' => 'Freelance'
                                    ];
                                @endphp
                                @foreach($employmentTypes as $value => $label)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="employment_type[]" value="{{ $value }}" 
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mr-2"
                                               {{ in_array($value, request('employment_type', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Experience Level Filter -->
                        <div class="mb-6">
                            <h4 class="text-md font-medium text-gray-900 mb-3">Level Pengalaman</h4>
                            <div class="space-y-2">
                                @php
                                    $experienceLevels = [
                                        'entry' => 'Entry Level',
                                        'mid' => 'Mid Level',
                                        'senior' => 'Senior Level',
                                        'manager' => 'Manager',
                                        'director' => 'Director'
                                    ];
                                @endphp
                                @foreach($experienceLevels as $value => $label)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="experience_level[]" value="{{ $value }}"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mr-2"
                                               {{ in_array($value, request('experience_level', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Salary Range Filter -->
                        <div class="mb-6">
                            <h4 class="text-md font-medium text-gray-900 mb-3">Range Gaji</h4>
                            <div class="space-y-2">
                                @php
                                    $salaryRanges = [
                                        '0-5000000' => '< Rp 5 Juta',
                                        '5000000-10000000' => 'Rp 5 - 10 Juta',
                                        '10000000-15000000' => 'Rp 10 - 15 Juta',
                                        '15000000-20000000' => 'Rp 15 - 20 Juta',
                                        '20000000-' => '> Rp 20 Juta'
                                    ];
                                @endphp
                                @foreach($salaryRanges as $value => $label)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="salary_range[]" value="{{ $value }}"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mr-2"
                                               {{ in_array($value, request('salary_range', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            Terapkan Filter
                        </button>
                    </form>
                </div>
                

            </div>
            
            <!-- Job Listings -->
            <div class="w-full md:w-3/4">
                <!-- Header with job count and sorting -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $jobs->total() }} lowongan kerja ditemukan</h2>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">Urutkan:</span>
                        <select id="sort" name="sort" onchange="sortJobs(this.value)" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="salary_high" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Gaji Tertinggi</option>
                            <option value="salary_low" {{ request('sort') == 'salary_low' ? 'selected' : '' }}>Gaji Terendah</option>
                            <option value="company" {{ request('sort') == 'company' ? 'selected' : '' }}>Nama Perusahaan</option>
                        </select>
                    </div>
                </div>
                
                <!-- Job Cards -->
                <div class="space-y-4">
                    @forelse($jobs as $job)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-start space-x-3">
                                <!-- Company Logo -->
                                <div class="flex-shrink-0">
                                    @if($job->company && $job->company->logo)
                                        <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-10 h-10 rounded object-cover">
                                    @else
                                        <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                                            <i class="fas fa-building text-gray-400 text-sm"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Job Details -->
                                <div class="flex-1 min-w-0">
                                    <div class="mb-2">
                                        <h3 class="text-base font-semibold text-gray-900 hover:text-blue-600 cursor-pointer mb-1">
                                            <a href="{{ route('jobs.show', $job->slug) }}" class="hover:underline">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-1">{{ $job->company ? $job->company->name : 'Perusahaan Tidak Diketahui' }}</p>
                                        <p class="text-gray-500 text-xs flex items-center">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            {{ $job->location }}
                                            <span class="mx-2">•</span>
                                            {{ $job->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    
                                    <!-- Job Tags -->
                                    <div class="flex flex-wrap gap-1 mb-2">
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">{{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}</span>
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">{{ ucfirst($job->experience_level) }}</span>
                                        @if($job->category)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">{{ $job->category->name }}</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Skills -->
                                    @if($job->skills->count() > 0)
                                        <div class="mb-3">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($job->skills->take(2) as $skill)
                                                    <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded">{{ $skill->name }}</span>
                                                @endforeach
                                                @if($job->skills->count() > 2)
                                                    <span class="text-gray-500 text-xs">+{{ $job->skills->count() - 2 }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Salary and Apply Button -->
                                    <div class="flex justify-between items-center">
                                        <div>
                                            @if($job->salary_range)
                                            <span class="text-green-600 font-medium">
                                                {{ $job->salary_range }}
                                            </span>
                                            @else
                                                <p class="text-gray-500 text-sm">Gaji dapat dinegosiasi</p>
                                            @endif
                                        </div>
                                        <a href="{{ route('jobs.show', $job->slug) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-sm font-medium transition duration-200">
                                            Lamar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-12 rounded-xl shadow-sm text-center border border-gray-100">
                            <div class="text-gray-400 mb-6">
                                <i class="fas fa-search text-6xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak ada lowongan ditemukan</h3>
                            <p class="text-gray-500 mb-6">Coba ubah filter pencarian atau kata kunci Anda untuk menemukan lowongan yang sesuai.</p>
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-300">
                                <i class="fas fa-refresh mr-2"></i>
                                Reset Pencarian
                            </a>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($jobs->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                            {{ $jobs->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
                

            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script>
    // Sort jobs function
    function sortJobs(sortValue) {
        const url = new URL(window.location);
        url.searchParams.set('sort', sortValue);
        window.location.href = url.toString();
    }
    
    // Clear all filters function
    function clearFilters() {
        const url = new URL(window.location);
        // Keep only the base URL, remove all query parameters
        window.location.href = url.origin + url.pathname;
    }
    
    // Toggle advanced filters function

    
    // Auto-submit filter form when checkboxes change
    document.addEventListener('DOMContentLoaded', function() {
        // Handle sort change
        const sortSelect = document.getElementById('sort');
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const url = new URL(window.location.href);
                url.searchParams.set('sort', this.value);
                window.location.href = url.toString();
            });
            
            // Set current sort value
            const urlParams = new URLSearchParams(window.location.search);
            const sortValue = urlParams.get('sort');
            if (sortValue) {
                sortSelect.value = sortValue;
            }
        }
        
        const filterForm = document.getElementById('filter-form');
        if (filterForm) {
            const checkboxes = filterForm.querySelectorAll('input[type="checkbox"]');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Add a small delay to allow multiple quick selections
                    clearTimeout(window.filterTimeout);
                    window.filterTimeout = setTimeout(() => {
                        filterForm.submit();
                    }, 300);
                });
            });
            
            // Add loading state to filter form
            filterForm.addEventListener('submit', function() {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    const originalText = submitButton.innerHTML;
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memuat...';
                    submitButton.disabled = true;
                    
                    // Re-enable button after a timeout as fallback
                    setTimeout(() => {
                        submitButton.innerHTML = originalText;
                        submitButton.disabled = false;
                    }, 5000);
                }
            });
        }
        
        // Smooth scroll to job listings when filters are applied
        if (window.location.search) {
            const jobListings = document.querySelector('.space-y-6');
            if (jobListings) {
                setTimeout(() => {
                    jobListings.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            }
        }
    });
</script>
@endpush