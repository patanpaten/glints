@extends('layouts.jobseeker')

@section('title', 'Lowongan Kerja Terbaru di Indonesia | Glints')

@section('content')
    <!-- Tab Navigation -->
    <section class="bg-white border-b border-gray-100 sticky top-16 z-40">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div
                    class="TabsStyle__TabsContainer-sc-t1kk7p-0 fNRRdF horizontal-aries-tabs aries-tabs stylessc__JobTabList-sc-hzz5jk-0 iKiRnp">
                    <div class="TabsStyle__TabsHeader-sc-t1kk7p-1 hQwlmT horizontal-tabs-header tabs-header bg-white">
                        <ul class="horizontal-tabs-list tabs-list flex border-b border-gray-200" role="tablist">
                            <li class="tab-FOR_YOU active horizontal-tab" role="tab" aria-selected="true"
                                aria-controls="tab-item-FOR_YOU">
                                <button type="button" data-tab="FOR_YOU"
                                    class="flex items-center gap-2 px-4 py-3 text-blue-600 border-b-2 border-blue-600 font-medium hover:text-blue-700 transition-colors">
                                    <!-- Icon -->
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 100 100">
                                        <path
                                            d="M65.02 83.54v3.812c0 3.035-2.228 5.559-5.128 5.989l-.94 3.464A4.311 4.311 0 0 1 54.79 100h-9.318a4.311 4.311 0 0 1-4.162-3.195l-.913-3.464a6.075 6.075 0 0 1-5.156-6.015v-3.813a3.667 3.667 0 0 1 3.679-3.68h22.422a3.707 3.707 0 0 1 3.679 3.706zm17.267-51.397a31.988 31.988 0 0 1-9.023 22.315 29.482 29.482 0 0 0-7.894 16.004 5.316 5.316 0 0 1-5.263 4.485H40.155c-2.604 0-4.86-1.88-5.236-4.458-.94-5.988-3.706-11.68-7.948-16.058-5.478-5.693-8.889-13.426-8.97-21.938A32.056 32.056 0 0 1 49.93 0c17.857-.134 32.357 14.312 32.357 32.142zM53.769 12.675a3.627 3.627 0 0 0-3.625-3.625c-12.781 0-23.2 10.392-23.2 23.2a3.627 3.627 0 0 0 3.625 3.626 3.627 3.627 0 0 0 3.625-3.625c0-8.808 7.17-15.95 15.95-15.95a3.61 3.61 0 0 0 3.626-3.626zM15.453 37.984a2.766 2.766 0 0 1-2.778 2.777H2.942a2.78 2.78 0 0 1-2.777-2.777 2.78 2.78 0 0 1 2.777-2.778h9.733a2.78 2.78 0 0 1 2.778 2.778zm82.222-2.769a2.78 2.78 0 0 1 2.778 2.778 2.78 2.78 0 0 1-2.778 2.778h-9.733a2.78 2.78 0 0 1-2.777-2.778 2.78 2.78 0 0 1 2.777-2.778h9.733zM21.11 61.111a2.745 2.745 0 0 1 3.91 0 2.77 2.77 0 0 1 0 3.93l-6.893 6.893a2.774 2.774 0 0 1-1.955.803 2.77 2.77 0 0 1-1.955-4.733l6.893-6.893zm64.12-45.432c-.72 0-1.42-.267-1.976-.802a2.77 2.77 0 0 1 0-3.93l6.893-6.894a2.77 2.77 0 0 1 3.93 0 2.77 2.77 0 0 1 0 3.93l-6.893 6.894a2.774 2.774 0 0 1-1.955.802zm-74.12-.823L4.198 7.963a2.77 2.77 0 0 1 0-3.93 2.77 2.77 0 0 1 3.93 0l6.893 6.893a2.77 2.77 0 0 1-1.955 4.732c-.7 0-1.42-.267-1.955-.802zm67.074 46.255l6.873 6.893a2.77 2.77 0 0 1-1.955 4.733c-.7 0-1.42-.268-1.955-.803l-6.893-6.893a2.77 2.77 0 0 1 0-3.93 2.77 2.77 0 0 1 3.93 0z">
                                        </path>
                                    </svg>
                                    <span>For You</span>
                                </button>
                            </li>
                            <li class="tab-EXPLORE horizontal-tab" role="tab" aria-selected="false"
                                aria-controls="tab-item-EXPLORE">
                                <button type="button" data-tab="EXPLORE"
                                    class="flex items-center gap-2 px-4 py-3 text-gray-600 hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 100 100">
                                        <path
                                            d="M45.982 46.205c1.19-1.19 2.53-1.785 4.018-1.785s2.79.558 3.906 1.674C55.022 47.21 55.58 48.512 55.58 50s-.558 2.79-1.674 3.906C52.79 55.022 51.488 55.58 50 55.58s-2.79-.558-3.906-1.674C44.978 52.79 44.42 51.488 44.42 50s.52-2.753 1.562-3.795zm-31.25-31.473C24.554 4.911 36.31 0 50 0c13.69 0 25.446 4.91 35.268 14.732C95.089 24.554 100 36.31 100 50c0 13.69-4.91 25.446-14.732 35.268C75.446 95.089 63.69 100 50 100c-13.69 0-25.446-4.91-35.268-14.732C4.911 75.446 0 63.69 0 50c0-13.69 4.91-25.446 14.732-35.268zm46.206 46.206L79.91 20.089 39.062 39.063 20.09 79.91l40.849-18.974z">
                                        </path>
                                    </svg>
                                    <span>Eksplor</span>
                                </button>
                            </li>
                            <li class="tab-BOOKMARKED horizontal-tab" role="tab" aria-selected="false"
                                aria-controls="tab-item-BOOKMARKED">
                                <button type="button" data-tab="BOOKMARKED"
                                    class="flex items-center gap-2 px-4 py-3 text-gray-600 hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 100 100">
                                        <polygon points="12 0 12 100 50 71.6603516 88 100 88 0"></polygon>
                                    </svg>
                                    <span>Bookmark</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tab Content -->
    <section class="bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <!-- For You Tab Content -->
                <div id="tab-content-FOR_YOU" class="tab-content active">
                    @include('jobseeker.jobs.for-you')
                </div>
                
                <!-- Explore Tab Content -->
                <div id="tab-content-EXPLORE" class="tab-content">
                    @include('jobseeker.jobs.explore', ['jobs' => $jobs])
                </div>
                
                <!-- Bookmarked Tab Content -->
                <div id="tab-content-BOOKMARKED" class="tab-content">
                    @include('jobseeker.jobs.bookmarked')
                </div>
                
            
                            

    <!-- Mobile App Download Banner (Hidden on desktop) -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 lg:hidden">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-lg"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-sm">Unduh Aplikasi Glints</p>
                        <p class="text-xs opacity-90">Dapatkan notifikasi lowongan terbaru</p>
                    </div>
                </div>
                <button class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-medium transition">
                    Unduh
                </button>
            </div>
        </div>
    </section>



    

    <style>
        .tab-content {
            display: block;
        }

        .tab-content.hidden {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>

    <script>
        // Mobile Filter Toggle Functionality
        function toggleMobileFilters() {
            const mobileFilters = document.getElementById('mobile-filters');
            const overlay = document.getElementById('mobile-filter-overlay');

            if (mobileFilters.classList.contains('-translate-x-full')) {
                // Show filters
                mobileFilters.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                // Hide filters
                mobileFilters.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        // Job Detail Functions
        function showJobDetail(jobId) {
            // Remove active state from all job cards
            document.querySelectorAll('.job-card').forEach(card => {
                card.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50');
            });

            // Add active state to clicked job card
            const clickedCard = document.querySelector(`[data-job-id="${jobId}"]`);
            if (clickedCard) {
                clickedCard.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50');
            }

            // Hide placeholder and show loading
            document.getElementById('job-detail-placeholder').classList.add('hidden');
            document.getElementById('job-detail-content').classList.remove('hidden');
            document.getElementById('job-detail-content').innerHTML = `
                <div class="text-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                    <p class="text-gray-500">Memuat detail lowongan...</p>
                </div>
            `;

            // Fetch job details (you can replace this with actual AJAX call)
            setTimeout(() => {
                loadJobDetail(jobId);
            }, 500);
        }

        function loadJobDetail(jobId) {
            // Find job data from the current page (in real implementation, you might fetch from server)
            const jobCards = document.querySelectorAll('.job-card');
            let jobData = null;
            
            jobCards.forEach(card => {
                if (card.getAttribute('data-job-id') == jobId) {
                    jobData = extractJobDataFromCard(card);
                }
            });

            if (jobData) {
                displayJobDetail(jobData);
            }
        }

        function extractJobDataFromCard(card) {
            const id = card.getAttribute('data-job-id');
            const title = card.querySelector('h2').textContent.trim();
            const company = card.querySelector('.text-gray-700.font-medium').textContent.trim();
            const location = card.querySelector('.text-gray-600').textContent.trim().replace('🗺️', '').trim();
            const salary = card.querySelector('.text-green-600')?.textContent.trim() || 'Gaji akan dibahas saat interview';
            const tags = Array.from(card.querySelectorAll('.px-2.py-1')).map(tag => tag.textContent.trim());
            const postedTime = card.querySelector('.text-xs.text-gray-500').textContent.trim();
            const logo = card.querySelector('img')?.src || null;
            const companyInitial = company.charAt(0);
            
            return {
                id,
                title,
                company,
                location,
                salary,
                tags,
                postedTime,
                logo,
                companyInitial
            };
        }

        function displayJobDetail(jobData) {
            const detailContent = `
                <div class="space-y-6">
                    <!-- Job Header -->
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start gap-4 mb-4">
                            ${jobData.logo ? 
                                `<img src="${jobData.logo}" alt="${jobData.company}" class="w-16 h-16 rounded-lg object-cover border border-gray-200">` :
                                `<div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">${jobData.companyInitial}</span>
                                </div>`
                            }
                            <div class="flex-1">
                                <h1 class="text-2xl font-bold text-gray-900 mb-2">${jobData.title}</h1>
                                <p class="text-lg text-gray-700 font-medium mb-1">${jobData.company}</p>
                                <p class="text-gray-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    ${jobData.location}
                                </p>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <span class="text-xl font-bold text-green-600">${jobData.salary}</span>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            ${jobData.tags.map(tag => `<span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">${tag}</span>`).join('')}
                        </div>
                        
                        <p class="text-gray-500 text-sm">${jobData.postedTime}</p>
                    </div>

                    <!-- Job Description -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Pekerjaan</h2>
                        <div class="prose prose-sm max-w-none text-gray-700">
                            <p class="mb-4">Kami sedang mencari kandidat yang berpengalaman untuk bergabung dengan tim kami. Posisi ini menawarkan kesempatan untuk berkembang dalam lingkungan kerja yang dinamis dan inovatif.</p>
                            
                            <h3 class="font-semibold text-gray-900 mb-2">Tanggung Jawab:</h3>
                            <ul class="list-disc list-inside space-y-1 mb-4">
                                <li>Melaksanakan tugas sesuai dengan job description</li>
                                <li>Berkolaborasi dengan tim untuk mencapai target</li>
                                <li>Mengembangkan dan mengimplementasikan strategi</li>
                                <li>Melakukan analisis dan pelaporan berkala</li>
                            </ul>
                            
                            <h3 class="font-semibold text-gray-900 mb-2">Kualifikasi:</h3>
                            <ul class="list-disc list-inside space-y-1 mb-4">
                                <li>Pendidikan minimal S1 dari jurusan terkait</li>
                                <li>Pengalaman kerja minimal 2 tahun di bidang yang sama</li>
                                <li>Kemampuan komunikasi yang baik</li>
                                <li>Menguasai tools dan software yang relevan</li>
                            </ul>
                            
                            <h3 class="font-semibold text-gray-900 mb-2">Yang Kami Tawarkan:</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Gaji kompetitif sesuai pengalaman</li>
                                <li>Tunjangan kesehatan dan BPJS</li>
                                <li>Lingkungan kerja yang supportif</li>
                                <li>Kesempatan pengembangan karir</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Apply Button -->
                    <div class="border-t border-gray-200 pt-6">
                        <button onclick="applyToJob(${jobData.id})" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-medium transition-colors">
                            Lamar Sekarang
                        </button>
                        <button onclick="toggleBookmark(${jobData.id})" class="w-full mt-3 border border-gray-300 hover:bg-gray-50 text-gray-700 py-3 px-6 rounded-lg font-medium transition-colors">
                            Simpan Lowongan
                        </button>
                    </div>
                </div>
            `;
            
            document.getElementById('job-detail-content').innerHTML = detailContent;
        }

        function applyToJob(jobId) {
            // Redirect to application page
            window.location.href = `/jobseeker/jobs/${jobId}/apply`;
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {

            // Real-time timestamp updates
            function updateTimestamps() {
                const timeElements = document.querySelectorAll('.job-time');
                timeElements.forEach(element => {
                    const createdAt = element.getAttribute('data-created');
                    if (createdAt) {
                        const date = new Date(createdAt);
                        const now = new Date();
                        const diffInSeconds = Math.floor((now - date) / 1000);

                        let timeAgo;
                        if (diffInSeconds < 60) {
                            timeAgo = 'Baru saja';
                        } else if (diffInSeconds < 3600) {
                            const minutes = Math.floor(diffInSeconds / 60);
                            timeAgo = `${minutes} menit yang lalu`;
                        } else if (diffInSeconds < 86400) {
                            const hours = Math.floor(diffInSeconds / 3600);
                            timeAgo = `${hours} jam yang lalu`;
                        } else if (diffInSeconds < 2592000) {
                            const days = Math.floor(diffInSeconds / 86400);
                            timeAgo = `${days} hari yang lalu`;
                        } else if (diffInSeconds < 31536000) {
                            const months = Math.floor(diffInSeconds / 2592000);
                            timeAgo = `${months} bulan yang lalu`;
                        } else {
                            const years = Math.floor(diffInSeconds / 31536000);
                            timeAgo = `${years} tahun yang lalu`;
                        }

                        element.textContent = `Diposting ${timeAgo}`;
                    }
                });
            }

            // Update timestamps immediately and then every minute
            updateTimestamps();
            setInterval(updateTimestamps, 60000);

            // Load More Functionality (if needed)
            const loadMoreBtn = document.getElementById('load-more-btn');
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    // Add load more functionality here
                    console.log('Load more jobs');
                });
            }

            // Tab Navigation Functionality
            const tabItems = document.querySelectorAll('[role="tab"]');
            const tabButtons = document.querySelectorAll('[role="tab"] button');

            tabButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    // Remove active state from all tabs
                    tabItems.forEach(tab => {
                        tab.classList.remove('active');
                        tab.setAttribute('aria-selected', 'false');
                        const tabButton = tab.querySelector('button');
                        if (tabButton) {
                            tabButton.classList.remove('text-blue-600', 'border-b-2',
                                'border-blue-600');
                            tabButton.classList.add('text-gray-600');
                        }
                    });

                    // Add active state to clicked tab
                    const parentTab = button.closest('[role="tab"]');
                    if (parentTab) {
                        parentTab.classList.add('active');
                        parentTab.setAttribute('aria-selected', 'true');
                        button.classList.remove('text-gray-600');
                        button.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                    }

                    // Show/hide tab content based on selected tab
                    const tabId = button.getAttribute('data-tab');
                    const allTabContents = document.querySelectorAll('.tab-content');

                    // Hide all tab contents
                    allTabContents.forEach(content => {
                        content.classList.add('hidden');
                        content.classList.remove('active');
                    });

                    // Show selected tab content
                    const selectedContent = document.getElementById(`tab-content-${tabId}`);
                    if (selectedContent) {
                        selectedContent.classList.remove('hidden');
                        selectedContent.classList.add('active');
                    }
                });
            });
        });

        function clearLocation() {
            const locationElement = document.getElementById('location');
            if (locationElement) {
                locationElement.value = 'All Cities/Provinces';
            }
        }

        function toggleSaveJob(jobId) {
            // Implementation for saving/unsaving jobs
            console.log('Toggle save job:', jobId);
        }

        // Bookmark functionality
        function toggleBookmark(jobId, buttonElement = null) {
            // Check if user is authenticated
            @guest
                alert('Silakan login terlebih dahulu untuk menyimpan lowongan.');
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            // Show loading state
            if (buttonElement) {
                const originalContent = buttonElement.innerHTML;
                buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                buttonElement.disabled = true;
            }

            // Check if job is already bookmarked
            const isBookmarked = checkIfBookmarked(jobId);
            const url = isBookmarked ? 
                `{{ route('jobseeker.saved-jobs.unsave', ':jobId') }}`.replace(':jobId', jobId) :
                `{{ route('jobseeker.saved-jobs.save') }}`;
            const method = isBookmarked ? 'DELETE' : 'POST';
            const data = isBookmarked ? {} : { job_id: jobId };

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update saved jobs array dynamically
                    const jobIdInt = parseInt(jobId);
                    if (isBookmarked) {
                        // Remove from saved jobs array
                        savedJobsArray = savedJobsArray.filter(id => id !== jobIdInt);
                    } else {
                        // Add to saved jobs array
                        savedJobsArray.push(jobIdInt);
                    }
                    
                    // Update bookmark status
                    updateBookmarkStatus(jobId, !isBookmarked);
                    
                    // Show success message
                    showToast(data.message, 'success');
                    
                    // If we're on bookmarked tab and removing bookmark, remove the job card
                    if (isBookmarked && isBookmarkedTabActive()) {
                        removeJobCardFromBookmarked(jobId);
                    }
                    
                    // If we just added a bookmark and we're on bookmarked tab, reload the tab content
                    if (!isBookmarked && isBookmarkedTabActive()) {
                        location.reload();
                    }
                } else {
                    showToast(data.message || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan saat menyimpan lowongan', 'error');
            })
            .finally(() => {
                // Restore button state
                if (buttonElement) {
                    const isNowBookmarked = !isBookmarked;
                    buttonElement.innerHTML = isNowBookmarked ? 
                        '<i class="fas fa-bookmark"></i>' : 
                        '<i class="far fa-bookmark"></i>';
                    buttonElement.disabled = false;
                    
                    // Update button classes
                    if (isNowBookmarked) {
                        buttonElement.classList.remove('btn-outline-secondary');
                        buttonElement.classList.add('btn-outline-danger');
                        buttonElement.title = 'Hapus dari bookmark';
                    } else {
                        buttonElement.classList.remove('btn-outline-danger');
                        buttonElement.classList.add('btn-outline-secondary');
                        buttonElement.title = 'Simpan lowongan';
                    }
                }
            });
        }

        // Global variable to track saved jobs dynamically
        let savedJobsArray = @json($savedJobs->pluck('id')->toArray() ?? []);

        function checkIfBookmarked(jobId) {
            // Check if job is in saved jobs list
            return savedJobsArray.includes(parseInt(jobId));
        }

        function updateBookmarkStatus(jobId, isBookmarked) {
            // Update all bookmark buttons for this job
            const bookmarkButtons = document.querySelectorAll(`[onclick*="toggleBookmark(${jobId}"]`);
            bookmarkButtons.forEach(button => {
                const icon = button.querySelector('i');
                if (icon) {
                    if (isBookmarked) {
                        icon.className = 'fas fa-bookmark';
                        button.classList.remove('btn-outline-secondary');
                        button.classList.add('btn-outline-danger');
                        button.title = 'Hapus dari bookmark';
                    } else {
                        icon.className = 'far fa-bookmark';
                        button.classList.remove('btn-outline-danger');
                        button.classList.add('btn-outline-secondary');
                        button.title = 'Simpan lowongan';
                    }
                }
            });
        }

        function isBookmarkedTabActive() {
            const bookmarkedTab = document.querySelector('[data-tab="BOOKMARKED"]');
            return bookmarkedTab && bookmarkedTab.closest('[role="tab"]').classList.contains('active');
        }

        function removeJobCardFromBookmarked(jobId) {
            const jobCard = document.querySelector(`#tab-content-BOOKMARKED .job-card [href*="${jobId}"]`);
            if (jobCard) {
                const cardElement = jobCard.closest('.job-card');
                if (cardElement) {
                    cardElement.style.transition = 'opacity 0.3s ease';
                    cardElement.style.opacity = '0';
                    setTimeout(() => {
                        cardElement.remove();
                        
                        // Check if no more saved jobs
                        const remainingCards = document.querySelectorAll('#tab-content-BOOKMARKED .job-card');
                        if (remainingCards.length === 0) {
                            const jobListings = document.querySelector('#tab-content-BOOKMARKED .job-listings');
                            if (jobListings) {
                                jobListings.innerHTML = `
                                    <div class="text-center py-5">
                                        <i class="fas fa-bookmark fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum Ada Lowongan Tersimpan</h5>
                                        <p class="text-muted">Simpan lowongan yang menarik untuk Anda dengan mengklik tombol bookmark</p>
                                        <a href="#for-you" class="btn btn-primary" data-bs-toggle="tab">Jelajahi Lowongan</a>
                                    </div>
                                `;
                            }
                        }
                    }, 300);
                }
            }
        }

        function showToast(message, type = 'info') {
            // Create toast notification
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 3000);
        }

        // Toggle filter section visibility
        function toggleExploreFilterSection(sectionId) {
            const content = document.getElementById(sectionId + '-content');
            const icon = document.getElementById(sectionId + '-icon');
            
            if (content.style.display === 'none') {
                content.style.display = 'block';
                icon.style.transform = 'rotate(0deg)';
            } else {
                content.style.display = 'none';
                icon.style.transform = 'rotate(-90deg)';
            }
        }

        // Update explore filters
        function updateExploreFilters() {
            // Get all filter values
            const employmentTypes = Array.from(document.querySelectorAll('input[name="explore_employment_type[]"]:checked')).map(cb => cb.value);
            const workSystems = Array.from(document.querySelectorAll('input[name="explore_work_system[]"]:checked')).map(cb => cb.value);
            const locations = Array.from(document.querySelectorAll('input[name="explore_locations[]"]:checked')).map(cb => cb.value);
            const experienceLevels = Array.from(document.querySelectorAll('input[name="explore_experience_level[]"]:checked')).map(cb => cb.value);
            
            // Apply filters to job list
            searchExploreJobs();
        }

        // Clear all explore filters
        function clearExploreFilters() {
            // Uncheck all checkboxes
            document.querySelectorAll('input[name^="explore_"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            // Reset search form
            document.getElementById('explore-keyword').value = '';
            document.getElementById('explore-location').value = '';
            
            // Refresh job list
            searchExploreJobs();
        }

        // Explore tab functions
        function toggleExploreFilters() {
            const filters = document.getElementById('explore-desktop-filters');
            filters.classList.toggle('hidden');
        }

        function searchExploreJobs() {
            const form = document.getElementById('explore-search-form');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            
            // Add AJAX call to load jobs
            fetch(`{{ route('jobseeker.jobs.index') }}?${params.toString()}&ajax=1`)
                .then(response => response.json())
                .then(data => {
                    displayExploreJobs(data.jobs);
                })
                .catch(error => {
                    console.error('Error loading jobs:', error);
                });
        }

        function displayExploreJobs(jobs) {
            const container = document.getElementById('explore-jobs-container');
            
            if (!jobs || jobs.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-search fa-3x text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Lowongan Ditemukan</h3>
                        <p class="text-gray-500">Coba ubah kata kunci atau filter pencarian Anda</p>
                    </div>
                `;
                return;
            }

            let jobsHtml = '';
            jobs.forEach(job => {
                jobsHtml += `
                    <div class="job-card bg-white border rounded-lg p-4 cursor-pointer hover:shadow-md transition-shadow" 
                         data-job-id="${job.id}" onclick="showExploreJobDetail(this)">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-building text-gray-400"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 mb-1 truncate">${job.title}</h3>
                                <p class="text-gray-600 text-sm mb-2">${job.company_name}</p>
                                <div class="flex flex-wrap gap-2 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                        ${job.location || 'Remote'}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-briefcase"></i>
                                        ${job.employment_type || 'Full-time'}
                                    </span>
                                    ${job.salary_range ? `
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-dollar-sign"></i>
                                            ${job.salary_range}
                                        </span>
                                    ` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = jobsHtml;
        }

        function showExploreJobDetail(card) {
            // Remove highlight from other cards
            document.querySelectorAll('#explore-jobs-container .job-card').forEach(c => {
                c.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50');
            });
            
            // Highlight selected card
            card.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50');
            
            // Extract job data and display detail
            const jobData = extractJobDataFromCard(card);
            displayExploreJobDetail(jobData);
        }

        function displayExploreJobDetail(jobData) {
            const placeholder = document.getElementById('explore-job-detail-placeholder');
            const content = document.getElementById('explore-job-detail-content');
            
            placeholder.classList.add('hidden');
            content.classList.remove('hidden');
            
            content.innerHTML = `
                <div class="space-y-6">
                    <!-- Header -->
                    <div class="border-b pb-4">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-building text-gray-400 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-xl font-bold text-gray-900 mb-1">${jobData.title}</h2>
                                <p class="text-gray-600 mb-2">${jobData.company}</p>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                        ${jobData.location}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-briefcase"></i>
                                        ${jobData.type || 'Full-time'}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock"></i>
                                        ${jobData.postedTime || 'Baru saja'}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Job Description -->
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3">Deskripsi Pekerjaan</h3>
                        <div class="text-gray-700 text-sm leading-relaxed">
                            <p>Kami sedang mencari kandidat yang berpengalaman untuk posisi ${jobData.title}. Kandidat ideal memiliki passion dalam bidang teknologi dan siap untuk berkontribusi dalam tim yang dinamis.</p>
                            
                            <h4 class="font-medium mt-4 mb-2">Tanggung Jawab:</h4>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                <li>Mengembangkan dan memelihara aplikasi web</li>
                                <li>Berkolaborasi dengan tim lintas fungsi</li>
                                <li>Memastikan kualitas kode dan performa aplikasi</li>
                                <li>Mengikuti best practices dalam development</li>
                            </ul>
                            
                            <h4 class="font-medium mt-4 mb-2">Kualifikasi:</h4>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                <li>Minimal 2 tahun pengalaman di bidang terkait</li>
                                <li>Menguasai teknologi web modern</li>
                                <li>Kemampuan komunikasi yang baik</li>
                                <li>Mampu bekerja dalam tim</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Apply Button -->
                    <div class="flex gap-3 pt-4 border-t">
                        <button onclick="applyToJob(${jobData.id})" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition">
                            Lamar Sekarang
                        </button>
                        <button onclick="toggleBookmark(${jobData.id})" 
                                class="px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-bookmark text-gray-400"></i>
                        </button>
                    </div>
                </div>
            `;
        }

        // Handle explore search form submission
        document.addEventListener('DOMContentLoaded', function() {
            const exploreForm = document.getElementById('explore-search-form');
            if (exploreForm) {
                exploreForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    searchExploreJobs();
                });
            }
        });
    </script>

    <!-- Mobile Filter Overlay -->
    <div id="mobile-filter-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Mobile Filter Sidebar -->
    <div id="mobile-filters" class="fixed top-0 left-0 h-full w-80 bg-white z-50 transform -translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Filter Lowongan</h3>
                <button onclick="toggleMobileFilters()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Filter Content -->
            <div class="space-y-6">
                <!-- Tipe Pekerjaan -->
                <div>
                    <h4 class="font-medium mb-3">Tipe Pekerjaan</h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" value="kontrak" class="mr-2" onchange="updateExploreFilters()">
                            <span>Kontrak</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" value="magang" class="mr-2" onchange="updateExploreFilters()">
                            <span>Magang</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" value="paruh_waktu" class="mr-2" onchange="updateExploreFilters()">
                            <span>Paruh Waktu</span>
                        </label>
@endsection