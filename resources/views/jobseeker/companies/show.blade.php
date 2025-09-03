@extends('layouts.jobseeker')

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
                    
                    @if($company->tagline)
                        <p class="text-lg text-gray-700 mb-4">{{ $company->tagline }}</p>
                    @endif
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        @if($jobs->count() > 0)
                            <a href="{{ route('jobseeker.jobs', ['company' => $company->slug]) }}" 
                               class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <i class="fas fa-briefcase mr-2"></i>View {{ $jobs->count() }} Open Positions
                            </a>
                        @endif
                        
                        <button onclick="followCompany({{ $company->id }})" 
                                class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            <i class="fas fa-heart mr-2"></i>Follow Company
                        </button>
                        
                        <button onclick="shareCompany()" 
                                class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            <i class="fas fa-share mr-2"></i>Share
                        </button>
                    </div>
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
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">About {{ $company->name }}</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($company->description)) !!}
                        </div>
                    </div>
                @endif

                <!-- Company Culture -->
                @if($company->culture)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Company Culture</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($company->culture)) !!}
                        </div>
                    </div>
                @endif

                <!-- Open Positions -->
                @if($jobs->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Open Positions ({{ $jobs->count() }})</h2>
                            <a href="{{ route('jobseeker.jobs', ['company' => $company->slug]) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                View All Jobs <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($jobs->take(5) as $job)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-sm transition-shadow duration-200">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900 mb-2">
                                                <a href="{{ route('jobseeker.jobs.show', $job->slug) }}" 
                                                   class="hover:text-blue-600 transition-colors duration-200">
                                                    {{ $job->title }}
                                                </a>
                                            </h3>
                                            
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-3">
                                                @if($job->location)
                                                    <span class="flex items-center">
                                                        <i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }}
                                                    </span>
                                                @endif
                                                
                                                @if($job->job_type)
                                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs">
                                                        {{ $job->job_type }}
                                                    </span>
                                                @endif
                                                
                                                @if($job->salary_min && $job->salary_max)
                                                    <span class="flex items-center">
                                                        <i class="fas fa-money-bill-wave mr-1"></i>
                                                        Rp {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            @if($job->description)
                                                <p class="text-gray-600 text-sm line-clamp-2">
                                                    {{ Str::limit(strip_tags($job->description), 150) }}
                                                </p>
                                            @endif
                                        </div>
                                        
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="{{ route('jobseeker.jobs.show', $job->slug) }}" 
                                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm">
                                                Apply Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Company Stats -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Overview</h3>
                    
                    <div class="space-y-4">
                        @if($company->founded_year)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Founded</span>
                                <span class="font-medium">{{ $company->founded_year }}</span>
                            </div>
                        @endif
                        
                        @if($company->company_size)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Company Size</span>
                                <span class="font-medium">{{ $company->company_size }} employees</span>
                            </div>
                        @endif
                        
                        @if($company->industry)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Industry</span>
                                <span class="font-medium">{{ $company->industry }}</span>
                            </div>
                        @endif
                        
                        @if($company->headquarters)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Headquarters</span>
                                <span class="font-medium">{{ $company->headquarters }}</span>
                            </div>
                        @endif
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Open Positions</span>
                            <span class="font-medium">{{ $jobs->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                @if($company->email || $company->phone || $company->address)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                        
                        <div class="space-y-3">
                            @if($company->email)
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-gray-400 mr-3"></i>
                                    <a href="mailto:{{ $company->email }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $company->email }}
                                    </a>
                                </div>
                            @endif
                            
                            @if($company->phone)
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 mr-3"></i>
                                    <a href="tel:{{ $company->phone }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $company->phone }}
                                    </a>
                                </div>
                            @endif
                            
                            @if($company->address)
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-3 mt-1"></i>
                                    <span class="text-gray-700">{{ $company->address }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Social Media -->
                @if($company->linkedin || $company->twitter || $company->facebook)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
                        
                        <div class="flex space-x-3">
                            @if($company->linkedin)
                                <a href="{{ $company->linkedin }}" target="_blank" 
                                   class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @endif
                            
                            @if($company->twitter)
                                <a href="{{ $company->twitter }}" target="_blank" 
                                   class="bg-blue-400 text-white p-2 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            
                            @if($company->facebook)
                                <a href="{{ $company->facebook }}" target="_blank" 
                                   class="bg-blue-800 text-white p-2 rounded-lg hover:bg-blue-900 transition-colors duration-200">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush

@push('scripts')
<script>
function followCompany(companyId) {
    // AJAX call to follow/unfollow company
    fetch(`/jobseeker/companies/${companyId}/follow`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update button text/state
            const button = event.target;
            if (data.following) {
                button.innerHTML = '<i class="fas fa-heart mr-2"></i>Following';
                button.classList.add('bg-red-100', 'text-red-700');
                button.classList.remove('bg-gray-100', 'text-gray-700');
            } else {
                button.innerHTML = '<i class="fas fa-heart mr-2"></i>Follow Company';
                button.classList.remove('bg-red-100', 'text-red-700');
                button.classList.add('bg-gray-100', 'text-gray-700');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    });
}

function shareCompany() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $company->name }}',
            text: 'Check out {{ $company->name }} on Glints',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link copied to clipboard!');
        });
    }
}
</script>
@endpush