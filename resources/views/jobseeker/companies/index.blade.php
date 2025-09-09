@extends('layouts.jobseeker')

@section('title', 'Companies - Find Your Dream Company')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Find Companies in Indonesia</h1>
                <p class="text-lg text-gray-600 mb-8">Discover amazing companies and explore career opportunities</p>
                
                <!-- Search Form -->
                <form method="GET" action="{{ route('jobseeker.companies') }}" class="max-w-4xl mx-auto">
                    <div class="flex flex-col md:flex-row gap-4 mb-6">
                        <!-- Company Search -->
                        <div class="flex-1">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search companies..." 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <!-- Location Filter -->
                        <div class="md:w-48">
                            <input type="text" 
                                   name="location" 
                                   value="{{ request('location') }}"
                                   placeholder="Location" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <!-- Search Button -->
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </div>
                    
                    <!-- Advanced Filters -->
                    <div class="flex flex-wrap gap-4 justify-center">
                        <!-- Industry Filter -->
                        <select name="industry" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Industries</option>
                            @if(isset($industries))
                                @foreach($industries as $industry)
                                    <option value="{{ $industry }}" {{ request('industry') == $industry ? 'selected' : '' }}>
                                        {{ $industry }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        
                        <!-- Company Size Filter -->
                        <select name="size" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Sizes</option>
                            <option value="startup" {{ request('size') == 'startup' ? 'selected' : '' }}>Startup (1-50)</option>
                            <option value="medium" {{ request('size') == 'medium' ? 'selected' : '' }}>Medium (51-200)</option>
                            <option value="large" {{ request('size') == 'large' ? 'selected' : '' }}>Large (201+)</option>
                        </select>
                        
                        <!-- Clear Filters -->
                        @if(request()->hasAny(['search', 'location', 'industry', 'size']))
                            <a href="{{ route('jobseeker.companies') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                <i class="fas fa-times mr-1"></i>Clear Filters
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Results Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Results Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    @if(isset($companies) && $companies->total() > 0)
                        {{ number_format($companies->total()) }} Companies Found
                    @else
                        No Companies Found
                    @endif
                </h2>
                @if(request()->hasAny(['search', 'location', 'industry', 'size']))
                    <p class="text-gray-600 mt-1">
                        @if(request('search'))
                            Search: "{{ request('search') }}"
                        @endif
                        @if(request('location'))
                            | Location: "{{ request('location') }}"
                        @endif
                        @if(request('industry'))
                            | Industry: "{{ request('industry') }}"
                        @endif
                        @if(request('size'))
                            | Size: "{{ ucfirst(request('size')) }}"
                        @endif
                    </p>
                @endif
            </div>
        </div>

        <!-- Companies Grid -->
        @if(isset($companies) && $companies->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($companies as $company)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                        <div class="p-6">
                            <!-- Company Header -->
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="flex-shrink-0">
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" 
                                             alt="{{ $company->name }}" 
                                             class="w-16 h-16 rounded-lg object-cover">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-building text-gray-400 text-xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                                        <a href="{{ route('jobseeker.companies.show', $company->slug) }}" 
                                           class="hover:text-blue-600 transition-colors duration-200">
                                            {{ $company->name }}
                                        </a>
                                    </h3>
                                    @if($company->industry)
                                        <p class="text-sm text-gray-600 mt-1">{{ $company->industry }}</p>
                                    @endif
                                    @if($company->location)
                                        <p class="text-sm text-gray-500 mt-1">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $company->location }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Company Description -->
                            @if($company->description)
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($company->description, 120) }}
                                </p>
                            @endif

                            <!-- Company Stats -->
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                @if($company->employee_count)
                                    <span>
                                        <i class="fas fa-users mr-1"></i>
                                        {{ number_format($company->employee_count) }} employees
                                    </span>
                                @endif
                                @if($company->jobs_count)
                                    <span>
                                        <i class="fas fa-briefcase mr-1"></i>
                                        {{ $company->jobs_count }} open positions
                                    </span>
                                @endif
                            </div>

                            <!-- Action Button -->
                            <div class="flex space-x-2">
                                <a href="{{ route('jobseeker.companies.show', $company->slug) }}" 
                                   class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    View Company
                                </a>
                                @if($company->jobs_count > 0)
                                    <a href="{{ route('jobseeker.jobs.index', ['company' => $company->slug]) }}" 
                                       class="flex-1 bg-gray-100 text-gray-700 text-center py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                        View Jobs
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $companies->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-building text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Companies Found</h3>
                    <p class="text-gray-600 mb-6">
                        @if(request()->hasAny(['search', 'location', 'industry', 'size']))
                            We couldn't find any companies matching your criteria. Try adjusting your filters.
                        @else
                            There are no companies available at the moment.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'location', 'industry', 'size']))
                        <a href="{{ route('jobseeker.companies') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>Clear All Filters
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush