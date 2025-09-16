<div id="bookmarked" class="py-6">
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex gap-6">
                <!-- Kolom Kiri: Daftar Lowongan Tersimpan -->
                <div class="w-2/3">
                    <div class="job-listings space-y-4">
                    @if($savedJobs && $savedJobs->count() > 0)
                        @foreach($savedJobs as $job)
                            <div class="job-card border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-all duration-200 bg-white p-4 group cursor-pointer" data-job-id="{{ $job->id }}">
                                <div class="flex items-start gap-3">
                                    <!-- Company Logo -->
                                    <div class="w-12 h-12 rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-content-center flex-shrink-0">
                                        @if($job->company && $job->company->logo)
                                            <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-building text-gray-400 text-lg"></i>
                                        @endif
                                    </div>
                                    
                                    <!-- Job Info -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Job Title -->
                                        <div class="mb-2">
                                            <h2 class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition-colors">
                                                <a href="{{ route('jobseeker.jobs.show', $job->slug) }}" class="text-decoration-none">
                                                    {{ $job->title }}
                                                </a>
                                            </h2>
                                        </div>
                                        
                                        <!-- Company Name -->
                                        <div class="mb-2">
                                            <span class="text-sm font-medium text-gray-700">{{ $job->company->name ?? 'Perusahaan' }}</span>
                                        </div>
                                        
                                        <!-- Location -->
                                        <div class="flex items-center text-sm text-gray-600 mb-3">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            <span>{{ $job->location ?? 'Lokasi tidak tersedia' }}</span>
                                        </div>
                                        
                                        @if($job->salary_min && $job->salary_max)
                                            <div class="flex items-center text-sm text-green-600 mb-3">
                                                <i class="fas fa-money-bill-wave mr-1"></i>
                                                <span>Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp {{ number_format($job->salary_max, 0, ',', '.') }}</span>
                                            </div>
                                        @endif
                                        
                                        <!-- Job Meta -->
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            @if($job->type)
                                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ $job->type }}</span>
                                            @endif
                                            @if($job->experience_level)
                                                <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{ $job->experience_level }}</span>
                                            @endif
                                            @if($job->work_system)
                                                <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">{{ $job->work_system }}</span>
                                            @endif
                                        </div>
                                        
                                        <!-- Saved Time -->
                                        <div class="text-xs text-gray-500">
                                            <i class="fas fa-clock mr-1"></i>
                                            Disimpan {{ $job->pivot->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    
                                    <!-- Bookmark Button -->
                                    <button class="text-red-500 hover:text-red-700 transition-colors p-1" onclick="event.stopPropagation(); bookmarkManager.toggleBookmark({{ $job->id }}, this)" title="Hapus dari bookmark">
                                        <i class="fas fa-bookmark text-lg"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-bookmark text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Lowongan Tersimpan</h3>
                            <p class="text-gray-500 mb-6">Simpan lowongan yang menarik untuk Anda dengan mengklik tombol bookmark</p>
                            <button onclick="document.querySelector('[data-tab=\"FOR_YOU\"]').click()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                Jelajahi Lowongan
                            </button>
                        </div>
                    @endif
                    </div>
                </div>
                
                <!-- Kolom Kanan: Banner atau Info Tambahan -->
                <div class="w-1/3">
                    <div class="sticky top-5">
                        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                            <i class="fas fa-bookmark text-3xl text-blue-600 mb-4"></i>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tips Bookmark</h3>
                            <p class="text-sm text-gray-600">Simpan lowongan yang menarik dan lamar nanti ketika Anda siap. Lowongan tersimpan akan tetap ada hingga Anda menghapusnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>