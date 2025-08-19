@extends('layouts.app')

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
                <form method="GET" action="{{ route('companies.index') }}" class="max-w-4xl mx-auto">
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
                            @foreach($industries as $industry)
                                <option value="{{ $industry }}" {{ request('industry') == $industry ? 'selected' : '' }}>
                                    {{ $industry }}
                                </option>
                            @endforeach
                        </select>
                        
                        <!-- Company Size Filter -->
                        <select name="company_size" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Sizes</option>
                            @foreach($companySizes as $value => $label)
                                <option value="{{ $value }}" {{ request('company_size') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        
                        @if(request()->hasAny(['search', 'location', 'industry', 'company_size']))
                            <a href="{{ route('companies.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                Clear Filters
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
                    {{ $companies->total() }} Companies Found
                </h2>
                @if(request()->hasAny(['search', 'location', 'industry', 'company_size']))
                    <p class="text-gray-600 mt-1">
                        Showing results for: 
                        @if(request('search'))
                            "{{ request('search') }}"
                        @endif
                        @if(request('location'))
                            in {{ request('location') }}
                        @endif
                        @if(request('industry'))
                            • {{ request('industry') }}
                        @endif
                        @if(request('company_size'))
                            • {{ $companySizes[request('company_size')] }}
                        @endif
                    </p>
                @endif
            </div>
        </div>
        
        <!-- Companies Grid -->
        @if($companies->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($companies as $company)
                    <div class="bg-white rounded-lg border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                        <div class="p-6">
                            <!-- Company Header -->
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="flex-shrink-0">
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" 
                                             alt="{{ $company->name }}" 
                                             class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                                    @else
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                                            <i class="fas fa-building text-gray-400 text-xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                                        <a href="{{ route('companies.show', $company) }}" class="hover:text-blue-600 transition-colors duration-200">
                                            {{ $company->name }}
                                        </a>
                                    </h3>
                                    @if($company->industry)
                                        <p class="text-sm text-gray-600 mt-1">{{ $company->industry }}</p>
                                    @endif
                                    @if($company->city)
                                        <p class="text-sm text-gray-500 mt-1">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $company->city }}
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
                                <div class="flex items-center space-x-4">
                                    @if($company->company_size)
                                        <span>
                                            <i class="fas fa-users mr-1"></i>{{ $company->company_size }}
                                        </span>
                                    @endif
                                    <span>
                                        <i class="fas fa-briefcase mr-1"></i>{{ $company->jobs->count() }} jobs
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('companies.show', $company) }}" 
                                   class="flex-1 text-center px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                    View Company
                                </a>
                                @if($company->jobs->count() > 0)
                                    <a href="{{ route('jobs.index', ['company' => $company->name]) }}" 
                                       class="flex-1 text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        View Jobs ({{ $company->jobs->count() }})
                                    </a>
                                @else
                                    <div class="flex-1 text-center px-4 py-2 bg-gray-100 text-gray-500 rounded-lg cursor-not-allowed">
                                        No Active Jobs
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Active Jobs Indicator -->
                        @if($company->jobs->count() > 0)
                            <div class="px-6 py-3 bg-green-50 border-t border-gray-200 rounded-b-lg">
                                <p class="text-sm text-green-700">
                                    <i class="fas fa-circle text-green-500 mr-2"></i>
                                    Actively hiring • {{ $company->jobs->count() }} open positions
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $companies->appends(request()->query())->links() }}
            </div>
        @else
            <!-- No Results -->
            <div class="text-center py-12">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-search text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No companies found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any companies matching your search criteria. Try adjusting your filters or search terms.
                    </p>
                    <a href="{{ route('companies.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-refresh mr-2"></i>View All Companies
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection