<div class="tab-pane fade" id="bookmarked" role="tabpanel" aria-labelledby="bookmarked-tab">
    <div class="container-fluid">
        <div class="row">
            <!-- Kolom Kiri: Daftar Lowongan Tersimpan -->
            <div class="col-lg-8">
                <div class="job-listings">
                    @if($savedJobs && $savedJobs->count() > 0)
                        @foreach($savedJobs as $job)
                            <div class="job-card mb-3 p-3 border rounded">
                                <div class="row">
                                    <div class="col-md-2">
                                        @if($job->company && $job->company->logo)
                                            <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="company-logo img-fluid" style="max-width: 60px; max-height: 60px;">
                                        @else
                                            <div class="company-logo-placeholder bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 8px;">
                                                <i class="fas fa-building text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="job-title mb-1">
                                            <a href="{{ route('jobseeker.jobs.show', $job->slug) }}" class="text-decoration-none text-dark">
                                                {{ $job->title }}
                                            </a>
                                        </h5>
                                        <p class="company-name text-muted mb-1">{{ $job->company->name ?? 'Perusahaan' }}</p>
                                        <p class="job-location text-muted mb-2">
                                            <i class="fas fa-map-marker-alt"></i> {{ $job->location ?? 'Lokasi tidak tersedia' }}
                                        </p>
                                        
                                        @if($job->salary_min && $job->salary_max)
                                            <p class="job-salary text-success mb-2">
                                                <i class="fas fa-money-bill-wave"></i> 
                                                Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp {{ number_format($job->salary_max, 0, ',', '.') }}
                                            </p>
                                        @endif
                                        
                                        <div class="job-meta d-flex flex-wrap gap-2 mb-2">
                                            @if($job->type)
                                                <span class="badge bg-primary">{{ $job->type }}</span>
                                            @endif
                                            @if($job->experience_level)
                                                <span class="badge bg-secondary">{{ $job->experience_level }}</span>
                                            @endif
                                            @if($job->work_system)
                                                <span class="badge bg-info">{{ $job->work_system }}</span>
                                            @endif
                                        </div>
                                        
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i> 
                                            Disimpan {{ $job->pivot->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button class="btn btn-outline-danger btn-sm" onclick="toggleBookmark({{ $job->id }}, this)" title="Hapus dari bookmark">
                                            <i class="fas fa-bookmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-bookmark fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Lowongan Tersimpan</h5>
                            <p class="text-muted">Simpan lowongan yang menarik untuk Anda dengan mengklik tombol bookmark</p>
                            <a href="#for-you" class="btn btn-primary" data-bs-toggle="tab">Jelajahi Lowongan</a>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Kolom Kanan: Banner atau Info Tambahan -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-bookmark fa-2x text-primary mb-3"></i>
                            <h6>Tips Bookmark</h6>
                            <p class="small text-muted">Simpan lowongan yang menarik dan lamar nanti ketika Anda siap. Lowongan tersimpan akan tetap ada hingga Anda menghapusnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>