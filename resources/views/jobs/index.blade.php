@extends('layouts.app')

@section('title', 'Lowongan Kerja Terbaru di Indonesia | Glints')

@section('content')
<!-- Hero Section -->
<section class="bg-white py-6 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <form action="{{ route('jobs.index') }}" method="GET" class="flex gap-2 flex-col md:flex-row">
                
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
                <div class="w-full md:w-64 relative bg-blue-50 rounded-lg flex items-center">
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
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition w-full md:w-auto"
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
        <!-- Page Title -->
        <div class="max-w-6xl mx-auto mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 total-job-search-result-count">
                Lowongan Kerja di Indonesia
            </h1>
        </div>
        
        <div class="flex flex-col md:flex-row gap-8 max-w-6xl mx-auto">
            

            <!-- Sidebar Filter -->
            <aside class="w-full md:w-1/4">
                <div class="sticky top-4 bg-white p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Filter</h3>
                        <button type="button" onclick="clearFilters()" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Reset
                        </button>
                    </div>

                    {{-- QR Card --}}
                    <div class="mb-4 p-3 rounded-lg border border-blue-200 bg-blue-50 flex flex-col items-center text-center">
                        <img src="/images/qr-code.png" alt="QR Code" class="w-20 h-20 mb-2">
                        <p class="text-sm font-medium">Dapatkan notifikasi lokermu secara langsung di Aplikasi Glints</p>
                        <span class="text-xs text-gray-600 italic">Scan kode QR untuk download</span>
                    </div>

                    <form action="{{ route('jobs.index') }}" method="GET" id="filter-form">
                        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">

                       {{-- Prioritaskan --}}

                        <div x-data="{ open: true }" class="border-b pb-3 mb-3">
                            {{-- Header --}}
                            <div class="flex justify-between items-center cursor-pointer select-none" @click="open = !open">
                                <h4 class="font-medium text-gray-900">Prioritaskan</h4>
                                <svg :class="{ 'rotate-180': open }"
                                    class="w-4 h-4 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>

                            {{-- Body --}}
                            <div x-show="open" class="mt-3">
                                @php
                                    $sortOptions = [
                                        'relevant' => 'Paling Relevan',
                                        'latest' => 'Baru Ditambahkan',
                                    ];
                                @endphp
                                <div class="flex gap-3" role="radiogroup" aria-label="sortBy filter options">
                                    @foreach($sortOptions as $value => $label)
                                        <label class="flex items-center">
                                            <input type="radio" name="sort" value="{{ $value }}"
                                                class="hidden peer"
                                                {{ request('sort', 'relevant') == $value ? 'checked' : '' }}>
                                            <div class="px-3 py-1 rounded-full border cursor-pointer text-sm
                                                peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600
                                                hover:bg-gray-100 transition">
                                                {{ $label }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>



                        {{-- Tipe Pekerjaan --}}
                        <div x-data="{ open: true }" class="border-b pb-3 mb-3">
                            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                                <h4 class="font-medium text-gray-900">Tipe Pekerjaan</h4>
                                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div x-show="open" class="mt-2 space-y-2">
                                @php
                                    $employmentTypes = [
                                        'full_time' => 'Penuh Waktu',
                                        'contract' => 'Kontrak',
                                        'internship' => 'Magang',
                                        'freelance' => 'Freelance',
                                        'part_time' => 'Paruh Waktu',
                                        'daily' => 'Harian'
                                    ];
                                @endphp
                                @foreach($employmentTypes as $value => $label)
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" name="employment_type[]" value="{{ $value }}"
                                            {{ in_array($value, request('employment_type', [])) ? 'checked' : '' }}
                                            class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <span class="text-sm">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Kebijakan Kerja --}}
                        <div x-data="{ open: true }" class="border-b pb-3 mb-3">
                            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                                <h4 class="font-medium text-gray-900">Kebijakan Kerja</h4>
                                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div x-show="open" class="mt-2 space-y-2">
                                @php
                                    $workPolicies = [
                                        'onsite' => 'Kerja di kantor',
                                        'hybrid' => 'Kerja di kantor / rumah',
                                        'remote' => 'Kerja remote/dari rumah'
                                    ];
                                @endphp
                                @foreach($workPolicies as $value => $label)
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" name="work_policy[]" value="{{ $value }}"
                                            {{ in_array($value, request('work_policy', [])) ? 'checked' : '' }}
                                            class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <span class="text-sm">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Kecamatan --}}
                        <div x-data="{ open: true }">
                            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                                <h4 class="font-medium text-gray-900">Kecamatan</h4>
                                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div x-show="open" class="mt-2 max-h-48 overflow-y-auto space-y-2">
                                @foreach($districts as $id => $name)
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" name="district[]" value="{{ $id }}"
                                            {{ in_array($id, request('district', [])) ? 'checked' : '' }}
                                            class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <span class="text-sm">{{ $name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                            Terapkan Filter
                        </button>
                    </form>
                </div>
            </aside>
            
            <!-- Job Listings -->
            <div class="w-full md:w-3/4">
                <!-- Header with job count and sorting -->

                
                <!-- Job Cards -->
                <div class="space-y-4">
                    @include('components.job-cards', ['jobs' => $jobs])
                </div>

                <!-- Pagination -->
                @if($jobs->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $jobs->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function sortJobs(sortValue) {
        const url = new URL(window.location);
        url.searchParams.set('sort', sortValue);
        window.location.href = url.toString();
    }
    function clearFilters() {
        const url = new URL(window.location);
        window.location.href = url.origin + url.pathname;
    }
</script>
@endpush
