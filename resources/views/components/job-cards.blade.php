@if($jobs->count() > 0)
    @foreach($jobs as $job)
        <div class="border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition bg-white p-3 mb-4">
            <div class="flex items-start gap-3">
                <!-- Company Logo -->
                <div class="w-10 h-10 rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-center flex-shrink-0">
                    @if($job->company && $job->company->logo)
                        <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-building text-gray-400 text-sm"></i>
                    @endif
                </div>
                
                <!-- Job Info -->
                <div class="flex-1 min-w-0">
                    <!-- Job Title and Salary -->
                    <div class="flex items-start justify-between mb-1">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-sm font-semibold text-gray-900 hover:text-blue-600 transition-colors leading-tight">
                                <a href="{{ route('jobs.show', $job->id) }}" class="block truncate">
                                    {{ $job->title }}
                                </a>
                            </h2>
                        </div>
                        <div class="ml-2 text-right flex-shrink-0">
                            <div class="text-xs font-bold text-blue-600">
                                @if($job->salary_min && $job->salary_max)
                                    Rp {{ number_format($job->salary_min/1000000, 1) }}jt-{{ number_format($job->salary_max/1000000, 1) }}jt
                                @else
                                    <span class="text-gray-500 text-xs">Gaji Tidak Ditampilkan</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-1 mb-1">
                        <span class="px-1.5 py-0.5 bg-orange-100 text-orange-700 text-xs rounded font-medium">
                            {{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}
                        </span>
                        <span class="px-1.5 py-0.5 bg-blue-100 text-blue-700 text-xs rounded font-medium">
                            {{ ucfirst($job->experience_level ?? 'Entry') }}
                        </span>
                        <span class="px-1.5 py-0.5 bg-green-100 text-green-700 text-xs rounded font-medium">
                            Freelance
                        </span>
                    </div>
                    
                    <!-- Additional Tags -->
                    <div class="flex flex-wrap gap-1 mb-2">
                        <span class="px-1.5 py-0.5 bg-gray-100 text-gray-600 text-xs rounded">
                            Kurang dari setahun
                        </span>
                        <span class="px-1.5 py-0.5 bg-gray-100 text-gray-600 text-xs rounded">
                            Minimal SD
                        </span>
                        <span class="px-1.5 py-0.5 bg-gray-100 text-gray-600 text-xs rounded">
                            +4
                        </span>
                    </div>
                    
                    <!-- Company Info -->
                    <div class="flex items-center gap-2 mb-2">
                        <div class="flex items-center text-sm text-blue-600">
                            <i class="fas fa-check-circle mr-1 text-xs"></i>
                            <span class="font-medium">{{ $job->company->name ?? 'Mitra Sewa Gojek' }}</span>
                        </div>
                    </div>
                    
                    <!-- Location -->
                    <div class="flex items-center text-xs text-gray-500 mb-2">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $job->location ?? 'Karawaci, Tangerang, Banten' }}
                    </div>
                    
                    <!-- Footer -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="px-1.5 py-0.5 bg-orange-500 text-white text-xs rounded font-bold">
                                HOT
                            </span>
                            <span class="px-1.5 py-0.5 bg-green-600 text-white text-xs rounded font-medium">
                                <i class="fas fa-check mr-1"></i>
                                Aktif Merekrut
                            </span>
                            <span class="text-xs text-blue-500">
                                {{ $job->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <button class="text-gray-400 hover:text-blue-500 transition-colors">
                            <i class="far fa-bookmark text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="empty-state text-center">
        <i class="fas fa-search fa-3x text-muted"></i>
        <h3 class="mt-3">Tidak ada lowongan kerja ditemukan</h3>
        <p class="text-muted">Coba ubah kata kunci pencarian atau filter yang Anda gunakan.</p>
    </div>
@endif