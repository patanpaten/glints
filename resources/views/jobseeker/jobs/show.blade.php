@extends('layouts.jobseeker')

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
                            <a href="{{ route('jobseeker.companies.show', $job->company->slug) }}" class="text-blue-600 hover:underline font-medium">{{ $job->company->name }}</a>
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

                    <!-- Requirements -->
                    @if($job->requirements)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Persyaratan</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    </div>
                    @endif

                    <!-- Skills -->
                    @if($job->skills && count($job->skills) > 0)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Keahlian yang Dibutuhkan</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($job->skills as $skill)
                                <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Right Column: Job Info & Apply -->
                <div class="md:col-span-1">
                    <!-- Apply Button -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <button onclick="applyForJob({{ $job->id }})" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                            Lamar Sekarang
                        </button>
                        <button onclick="saveJob({{ $job->id }})" class="w-full mt-3 border border-gray-300 text-gray-700 font-medium py-3 px-4 rounded-lg hover:bg-gray-50 transition duration-200">
                            Simpan Lowongan
                        </button>
                    </div>
                    
                    <!-- Job Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Lowongan</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 100 100">
                                    <path d="M24.491 10.268C31.485 3.423 39.893 0 49.714 0c9.822 0 18.23 3.423 25.224 10.268 6.994 6.845 10.49 15.104 10.49 24.777 0 7.738-2.976 17.038-8.928 27.901-5.952 10.864-11.905 19.792-17.857 26.786L49.714 100c-1.041-1.042-2.343-2.493-3.906-4.353-1.562-1.86-4.39-5.468-8.482-10.826-4.092-5.357-7.701-10.565-10.826-15.625-3.125-5.06-5.99-10.788-8.594-17.187C15.302 45.61 14 39.955 14 35.045c0-9.673 3.497-17.932 10.491-24.777zm16.072 33.705c2.53 2.381 5.58 3.572 9.151 3.572 3.572 0 6.585-1.228 9.04-3.683 2.456-2.456 3.684-5.395 3.684-8.817 0-3.423-1.228-6.362-3.684-8.817-2.455-2.456-5.468-3.683-9.04-3.683-3.571 0-6.585 1.227-9.04 3.683-2.455 2.455-3.683 5.394-3.683 8.817 0 3.422 1.19 6.398 3.571 8.928z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Lokasi</p>
                                    <p class="text-sm text-gray-600">{{ $job->location }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 100 100">
                                    <path d="M85 25H15c-2.761 0-5 2.239-5 5v40c0 2.761 2.239 5 5 5h70c2.761 0 5-2.239 5-5V30c0-2.761-2.239-5-5-5zM15 35h70v30H15V35zm70-5v5H15v-5h70z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Gaji</p>
                                    <p class="text-sm text-gray-600">
                                        @if($job->salary_min && $job->salary_max)
                                            Rp {{ number_format($job->salary_min) }} - Rp {{ number_format($job->salary_max) }}
                                        @else
                                            Gaji Kompetitif
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 100 100">
                                    <path d="M50 10c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zm0 72c-17.673 0-32-14.327-32-32s14.327-32 32-32 32 14.327 32 32-14.327 32-32 32zm16-32H50V34c0-2.209-1.791-4-4-4s-4 1.791-4 4v20c0 2.209 1.791 4 4 4h20c2.209 0 4-1.791 4-4s-1.791-4-4-4z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Tipe Pekerjaan</p>
                                    <p class="text-sm text-gray-600">{{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}</p>
                                </div>
                            </div>
                            
                            @if($job->experience_level)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 100 100">
                                    <path d="M80 20H20c-5.5 0-10 4.5-10 10v40c0 5.5 4.5 10 10 10h60c5.5 0 10-4.5 10-10V30c0-5.5-4.5-10-10-10zM20 30h60v40H20V30z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Level Pengalaman</p>
                                    <p class="text-sm text-gray-600">{{ ucfirst(str_replace('_', ' ', $job->experience_level)) }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($job->category)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 100 100">
                                    <path d="M20 20h60v60H20z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Kategori</p>
                                    <p class="text-sm text-gray-600">{{ $job->category->name }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Similar Jobs -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Lowongan Serupa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Similar job cards would go here -->
        </div>
    </div>
</div>

<script>
function applyForJob(jobId) {
    window.location.href = `{{ route('jobseeker.applications.create', '') }}/${jobId}`;
}

function saveJob(jobId) {
    // Implementation for saving job
    fetch(`{{ route('jobseeker.saved-jobs.save') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ job_id: jobId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Lowongan berhasil disimpan!');
        } else {
            alert('Gagal menyimpan lowongan.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan.');
    });
}
</script>
@endsection