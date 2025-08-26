@if($jobs->count() > 0)
    @foreach($jobs as $job)
        <div class="job-card">
            <!-- Job Card Header -->
            <div class="job-header">
                <div class="job-logo">
                    @if($job->company && $job->company->logo)
                        <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}">
                    @else
                        <div class="job-logo-placeholder">
                            <i class="fas fa-building"></i>
                        </div>
                    @endif
                </div>
                <div class="job-info">
                    <h3 class="job-title">
                        <a href="{{ route('jobs.show', $job->id) }}">
                            {{ $job->title }}
                        </a>
                    </h3>
                    <div class="job-company">
                        {{ $job->company->name ?? 'Perusahaan' }}
                    </div>
                    <div class="job-meta">
                        <span class="job-location">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $job->location ?? 'Jakarta, Indonesia' }}
                        </span>
                        @if($job->salary_min && $job->salary_max)
                            <span class="job-salary">
                                <i class="fas fa-money-bill-wave"></i>
                                Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp {{ number_format($job->salary_max, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>
                    <div class="job-date">
                        <i class="fas fa-clock"></i>
                        {{ $job->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            
            <!-- Job Tags -->
            <div class="job-tags">
                <span class="job-tag job-tag-type">
                    {{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}
                </span>
                @if($job->experience_level)
                    <span class="job-tag job-tag-level">
                        {{ ucfirst($job->experience_level) }} Level
                    </span>
                @endif
                @if($job->category)
                    <span class="job-tag job-tag-category">
                        {{ $job->category->name }}
                    </span>
                @endif
            </div>
            
            <!-- Job Description -->
            @if($job->description)
                <div class="job-description">
                    {{ Str::limit(strip_tags($job->description), 120) }}
                </div>
            @endif
            
            <!-- Job Footer -->
            <div class="job-footer">
                <div class="job-posted-date">
                    Diposting {{ $job->created_at->format('d M Y') }}
                </div>
                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">
                    Lihat Detail
                    <i class="fas fa-arrow-right"></i>
                </a>
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