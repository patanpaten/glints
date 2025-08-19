@extends('layouts.app')

@section('title', $company->name . ' - Company Profile')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Company Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                <!-- Company Logo -->
                <div class="flex-shrink-0">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" 
                             alt="{{ $company->name }}" 
                             class="w-24 h-24 rounded-lg object-cover border border-gray-200">
                    @else
                        <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                            <i class="fas fa-building text-gray-400 text-3xl"></i>
                        </div>
                    @endif
                </div>
                
                <!-- Company Info -->
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $company->name }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-gray-600 mb-4">
                        @if($company->industry)
                            <span class="flex items-center">
                                <i class="fas fa-industry mr-2"></i>{{ $company->industry }}
                            </span>
                        @endif
                        
                        @if($company->city)
                            <span class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>{{ $company->city }}, {{ $company->province }}
                            </span>
                        @endif
                        
                        @if($company->company_size)
                            <span class="flex items-center">
                                <i class="fas fa-users mr-2"></i>{{ $company->company_size }} employees
                            </span>
                        @endif
                        
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800">
                                <i class="fas fa-globe mr-2"></i>Website
                            </a>
                        @endif
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $activeJobs->count() }}</div>
                            <div class="text-sm text-gray-600">Active Jobs</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $totalJobs }}</div>
                            <div class="text-sm text-gray-600">Total Jobs Posted</div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col space-y-2">
                    @if($activeJobs->count() > 0)
                        <a href="{{ route('jobs.index', ['company' => $company->name]) }}" 
                           class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 text-center">
                            View All Jobs ({{ $activeJobs->count() }})
                        </a>
                    @endif
                    <a href="{{ route('companies.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 text-center">
                        Back to Companies
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Company Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- About Company -->
                @if($company->description)
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>About {{ $company->name }}
                        </h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($company->description)) !!}
                        </div>
                    </div>
                @endif
                
                <!-- Active Jobs -->
                @if($activeJobs->count() > 0)
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">
                                <i class="fas fa-briefcase mr-2 text-blue-600"></i>Open Positions ({{ $activeJobs->count() }})
                            </h2>
                            @if($activeJobs->count() > 5)
                                <a href="{{ route('jobs.index', ['company' => $company->name]) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    View All Jobs →
                                </a>
                            @endif
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($activeJobs->take(5) as $job)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                <a href="{{ route('jobs.show', $job->slug) }}" class="hover:text-blue-600 transition-colors duration-200">
                                                    {{ $job->title }}
                                                </a>
                                            </h3>
                                            
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-3">
                                                <span class="flex items-center">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }}
                                                </span>
                                                <span class="flex items-center">
                                                    <i class="fas fa-briefcase mr-1"></i>{{ $job->employment_type }}
                                                </span>
                                                @if($job->salary_range)
                                                    <span class="flex items-center">
                                                        <i class="fas fa-money-bill-wave mr-1"></i>
                                                        {{ $job->salary_range }}
                                                    </span>
                                                @endif
                                                <span class="flex items-center">
                                                    <i class="fas fa-clock mr-1"></i>{{ $job->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            
                                            @if($job->description)
                                                <p class="text-gray-700 text-sm line-clamp-2">
                                                    {{ Str::limit(strip_tags($job->description), 150) }}
                                                </p>
                                            @endif
                                        </div>
                                        
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="{{ route('jobs.show', $job->slug) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                View Job
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg border border-gray-200 p-6 text-center">
                        <i class="fas fa-briefcase text-gray-300 text-4xl mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Active Job Openings</h3>
                        <p class="text-gray-600">{{ $company->name }} doesn't have any active job openings at the moment. Check back later for new opportunities!</p>
                    </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Company Details -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-building mr-2 text-blue-600"></i>Company Details
                    </h3>
                    
                    <div class="space-y-4">
                        @if($company->industry)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Industry</dt>
                                <dd class="text-sm text-gray-900 mt-1">{{ $company->industry }}</dd>
                            </div>
                        @endif
                        
                        @if($company->company_size)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Company Size</dt>
                                <dd class="text-sm text-gray-900 mt-1">{{ $company->company_size }} employees</dd>
                            </div>
                        @endif
                        
                        @if($company->address)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="text-sm text-gray-900 mt-1">
                                    {{ $company->address }}<br>
                                    {{ $company->city }}, {{ $company->province }} {{ $company->postal_code }}
                                </dd>
                            </div>
                        @endif
                        
                        @if($company->phone)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="text-sm text-gray-900 mt-1">
                                    <a href="tel:{{ $company->phone }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $company->phone }}
                                    </a>
                                </dd>
                            </div>
                        @endif
                        
                        @if($company->website)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Website</dt>
                                <dd class="text-sm text-gray-900 mt-1">
                                    <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        {{ $company->website }}
                                    </a>
                                </dd>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-rocket mr-2 text-blue-600"></i>Quick Actions
                    </h3>
                    
                    <div class="space-y-3">
                        @if($activeJobs->count() > 0)
                            <a href="{{ route('jobs.index', ['company' => $company->name]) }}" 
                               class="block w-full px-4 py-3 bg-blue-600 text-white text-center font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <i class="fas fa-search mr-2"></i>Browse All Jobs
                            </a>
                        @endif
                        
                        <a href="{{ route('companies.index') }}" 
                           class="block w-full px-4 py-3 border border-gray-300 text-gray-700 text-center font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-building mr-2"></i>Explore Other Companies
                        </a>
                        
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank"
                               class="block w-full px-4 py-3 border border-gray-300 text-gray-700 text-center font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-external-link-alt mr-2"></i>Visit Company Website
                            </a>
                        @endif
                    </div>
                </div>
                
                <!-- Related Companies -->
                @if($relatedCompanies->count() > 0)
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-users mr-2 text-blue-600"></i>Similar Companies
                        </h3>
                        
                        <div class="space-y-4">
                            @foreach($relatedCompanies as $relatedCompany)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @if($relatedCompany->logo)
                                            <img src="{{ asset('storage/' . $relatedCompany->logo) }}" 
                                                 alt="{{ $relatedCompany->name }}" 
                                                 class="w-10 h-10 rounded object-cover border border-gray-200">
                                        @else
                                            <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center border border-gray-200">
                                                <i class="fas fa-building text-gray-400 text-sm"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 truncate">
                                            <a href="{{ route('companies.show', $relatedCompany) }}" class="hover:text-blue-600">
                                                {{ $relatedCompany->name }}
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-500">
                                            {{ $relatedCompany->jobs_count }} active jobs
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection