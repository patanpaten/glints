/**
 * Bookmark Management System
 * Handles saving and removing job bookmarks
 */

class BookmarkManager {
    constructor() {
        this.savedJobsArray = window.savedJobsArray || [];
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        this.isAuthenticated = window.isAuthenticated || false;
        this.loginUrl = window.loginUrl || '/login';
        this.pendingRequests = new Set(); // Track pending requests to prevent race conditions
        
        // Initialize bookmark states on page load
        this.initializeBookmarkStates();
    }

    /**
     * Initialize bookmark states on page load
     * Ensures all bookmark buttons reflect the correct state
     */
    initializeBookmarkStates() {
        if (!this.isAuthenticated) return;
        
        // Find all bookmark buttons and update their states
        const allBookmarkButtons = document.querySelectorAll('[onclick*="toggleBookmark"], [onclick*="bookmarkManager.toggleBookmark"]');
        
        allBookmarkButtons.forEach(button => {
            const onclickAttr = button.getAttribute('onclick');
            const jobIdMatch = onclickAttr.match(/toggleBookmark\((\d+)/);
            
            if (jobIdMatch) {
                const jobId = parseInt(jobIdMatch[1]);
                const isBookmarked = this.isJobBookmarked(jobId);
                this.updateButtonState(button, isBookmarked);
            }
        });
    }

    /**
     * Toggle bookmark status for a job
     * @param {number} jobId - The job ID
     * @param {HTMLElement} buttonElement - The bookmark button element
     */
    async toggleBookmark(jobId, buttonElement = null) {
        // Check authentication
        if (!this.isAuthenticated) {
            this.showAuthenticationRequired();
            return;
        }

        // Prevent race conditions - check if request is already pending
        if (this.pendingRequests.has(jobId)) {
            return;
        }

        // Add to pending requests
        this.pendingRequests.add(jobId);

        // Show loading state
        this.setButtonLoading(buttonElement, true);

        try {
            const isBookmarked = this.isJobBookmarked(jobId);
            const response = await this.makeBookmarkRequestWithRetry(jobId, isBookmarked);
            
            if (response.success) {
                this.updateBookmarkState(jobId, !isBookmarked);
                this.setButtonLoading(buttonElement, false);
                this.updateAllBookmarkButtons(jobId, !isBookmarked);
                this.handleTabUpdates(jobId, isBookmarked);
                this.showToast(response.message, 'success');
            } else {
                this.setButtonLoading(buttonElement, false);
                this.showToast(response.message || 'Terjadi kesalahan', 'error');
            }
        } catch (error) {
            console.error('Bookmark error:', error);
            this.setButtonLoading(buttonElement, false);
            
            // Show more specific error messages
            if (error.message.includes('timeout')) {
                this.showToast('Koneksi timeout - silakan coba lagi', 'error');
            } else if (error.message.includes('Network error')) {
                this.showToast('Masalah koneksi internet - silakan coba lagi', 'error');
            } else {
                this.showToast('Terjadi kesalahan saat menyimpan lowongan', 'error');
            }
        } finally {
            // Remove from pending requests
            this.pendingRequests.delete(jobId);
        }
    }

    /**
     * Check if a job is bookmarked
     * @param {number} jobId - The job ID
     * @returns {boolean}
     */
    isJobBookmarked(jobId) {
        return this.savedJobsArray.includes(parseInt(jobId));
    }

    /**
     * Make API request to bookmark/unbookmark job
     * @param {number} jobId - The job ID
     * @param {boolean} isBookmarked - Current bookmark status
     * @returns {Promise<Object>}
     */
    async makeBookmarkRequest(jobId, isBookmarked) {
        const url = '/jobseeker/saved-jobs';
        const method = isBookmarked ? 'DELETE' : 'POST';
        const data = { job_id: jobId };

        // Create AbortController for timeout handling
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 10000); // 10 second timeout

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data),
                signal: controller.signal
            });

            clearTimeout(timeoutId);

            // Check if response is ok
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            return result;
        } catch (error) {
            clearTimeout(timeoutId);
            
            if (error.name === 'AbortError') {
                throw new Error('Request timeout - please check your connection');
            } else if (error instanceof TypeError && error.message.includes('fetch')) {
                throw new Error('Network error - please check your internet connection');
            } else {
                throw error;
            }
        }
    }

    /**
     * Make bookmark request with retry mechanism
     * @param {number} jobId - The job ID
     * @param {boolean} isBookmarked - Current bookmark status
     * @param {number} maxRetries - Maximum number of retries
     * @returns {Promise<Object>}
     */
    async makeBookmarkRequestWithRetry(jobId, isBookmarked, maxRetries = 2) {
        let lastError;
        
        for (let attempt = 0; attempt <= maxRetries; attempt++) {
            try {
                return await this.makeBookmarkRequest(jobId, isBookmarked);
            } catch (error) {
                lastError = error;
                
                // Don't retry on certain errors
                if (error.message.includes('HTTP error! status: 4')) {
                    // Client errors (4xx) shouldn't be retried
                    throw error;
                }
                
                // Wait before retry (exponential backoff)
                if (attempt < maxRetries) {
                    const delay = Math.pow(2, attempt) * 1000; // 1s, 2s, 4s...
                    await new Promise(resolve => setTimeout(resolve, delay));
                }
            }
        }
        
        throw lastError;
    }

    /**
     * Update internal bookmark state
     * @param {number} jobId - The job ID
     * @param {boolean} isBookmarked - New bookmark status
     */
    updateBookmarkState(jobId, isBookmarked) {
        const jobIdInt = parseInt(jobId);
        
        if (isBookmarked) {
            if (!this.savedJobsArray.includes(jobIdInt)) {
                this.savedJobsArray.push(jobIdInt);
            }
        } else {
            this.savedJobsArray = this.savedJobsArray.filter(id => id !== jobIdInt);
        }

        // Update global variable
        window.savedJobsArray = this.savedJobsArray;
    }

    /**
     * Update bookmark button appearance
     * @param {HTMLElement} buttonElement - The bookmark button
     * @param {boolean} isBookmarked - New bookmark status
     */
    updateButtonState(buttonElement, isBookmarked) {
        if (!buttonElement) return;

        const icon = buttonElement.querySelector('i');
        if (icon) {
            icon.className = isBookmarked ? 'fas fa-bookmark text-lg' : 'far fa-bookmark text-lg';
        }

        buttonElement.title = isBookmarked ? 'Hapus dari bookmark' : 'Simpan lowongan';
        
        // Update button classes
        buttonElement.classList.remove('text-blue-500', 'text-gray-400');
        buttonElement.classList.add(isBookmarked ? 'text-blue-500' : 'text-gray-400');
    }

    /**
     * Update all bookmark buttons for a specific job
     * @param {number} jobId - The job ID
     * @param {boolean} isBookmarked - New bookmark status
     */
    updateAllBookmarkButtons(jobId, isBookmarked) {
        // Find buttons with precise onclick patterns to avoid job ID conflicts
        const buttons1 = document.querySelectorAll(`[onclick*="toggleBookmark(${jobId})"]`);
        const buttons2 = document.querySelectorAll(`[onclick*="toggleBookmark(${jobId},"]`);
        const buttons3 = document.querySelectorAll(`[onclick*="bookmarkManager.toggleBookmark(${jobId},"]`);
        
        // Combine all sets of buttons and remove duplicates
        const allButtons = [...new Set([...buttons1, ...buttons2, ...buttons3])];
        allButtons.forEach(button => this.updateButtonState(button, isBookmarked));
    }

    /**
     * Handle tab-specific updates
     * @param {number} jobId - The job ID
     * @param {boolean} wasBookmarked - Previous bookmark status
     */
    handleTabUpdates(jobId, wasBookmarked) {
        const isBookmarkedTabActive = this.isBookmarkedTabActive();
        
        if (isBookmarkedTabActive) {
            if (wasBookmarked) {
                // Job was bookmarked, now unbookmarked - remove from bookmarked tab
                this.removeJobFromBookmarkedTab(jobId);
            } else {
                // Job was not bookmarked, now bookmarked - add to bookmarked tab
                this.addJobToBookmarkedTab(jobId);
            }
        }
    }

    /**
     * Check if bookmarked tab is currently active
     * @returns {boolean}
     */
    isBookmarkedTabActive() {
        const bookmarkedTab = document.querySelector('.tab-BOOKMARKED');
        return bookmarkedTab && bookmarkedTab.classList.contains('active');
    }

    /**
     * Remove job card from bookmarked tab
     * @param {number} jobId - The job ID
     */
    removeJobFromBookmarkedTab(jobId) {
        const jobCard = document.querySelector(`#tab-content-BOOKMARKED [data-job-id="${jobId}"]`);
        if (jobCard) {
            jobCard.style.transition = 'opacity 0.3s ease';
            jobCard.style.opacity = '0';
            
            setTimeout(() => {
                jobCard.remove();
                this.checkEmptyBookmarkedTab();
            }, 300);
        }
    }

    /**
     * Add job to bookmarked tab
     * @param {number} jobId - The job ID
     */
    addJobToBookmarkedTab(jobId) {
        // Reload bookmarked jobs to get fresh data
        this.loadBookmarkedJobs();
    }

    /**
     * Check if bookmarked tab is empty and show empty state
     */
    checkEmptyBookmarkedTab() {
        const remainingCards = document.querySelectorAll('#tab-content-BOOKMARKED [data-job-id]');
        if (remainingCards.length === 0) {
            this.showEmptyBookmarkState();
        }
    }

    /**
     * Load bookmarked jobs from server
     */
    async loadBookmarkedJobs() {
        const container = document.querySelector('#tab-content-BOOKMARKED #bookmarked');
        if (!container) return;

        // Show loading state
        container.innerHTML = `
            <div class="text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                <p class="text-gray-500">Memuat lowongan tersimpan...</p>
            </div>
        `;

        try {
            const response = await fetch('/jobseeker/saved-jobs?ajax=1', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                }
            });

            const data = await response.json();
            
            if (data.success && data.savedJobs && data.savedJobs.length > 0) {
                this.displayBookmarkedJobs(data.savedJobs);
            } else {
                this.showEmptyBookmarkState();
            }
        } catch (error) {
            console.error('Error loading bookmarked jobs:', error);
            this.showLoadingError();
        }
    }

    /**
     * Display bookmarked jobs in the UI
     * @param {Array} savedJobs - Array of saved jobs
     */
    displayBookmarkedJobs(savedJobs) {
        const container = document.querySelector('#tab-content-BOOKMARKED #bookmarked');
        if (!container) return;

        const jobsHtml = savedJobs.map(job => this.createJobCardHtml(job)).join('');
        container.innerHTML = jobsHtml;
        
        // Update savedJobsArray to ensure consistency
        this.savedJobsArray = savedJobs.map(job => parseInt(job.id));
        window.savedJobsArray = this.savedJobsArray;
    }

    /**
     * Create HTML for a job card
     * @param {Object} job - Job object
     * @returns {string} HTML string
     */
    createJobCardHtml(job) {
        return `
            <div class="job-card border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-all duration-200 bg-white p-4 group cursor-pointer" data-job-id="${job.id}">
                <div class="flex items-start gap-3">
                    <!-- Company Logo -->
                    <div class="w-12 h-12 rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-content-center flex-shrink-0">
                        ${job.company && job.company.logo ? 
                            `<img src="/storage/${job.company.logo}" alt="${job.company.name}" class="w-full h-full object-cover">` : 
                            `<i class="fas fa-building text-gray-400 text-lg"></i>`
                        }
                    </div>
                    
                    <!-- Job Info -->
                    <div class="flex-1 min-w-0">
                        <!-- Job Title -->
                        <div class="mb-2">
                            <h2 class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition-colors">
                                <a href="/jobseeker/jobs/${job.slug}" class="text-decoration-none">
                                    ${job.title}
                                </a>
                            </h2>
                        </div>
                        
                        <!-- Company Name -->
                        <div class="mb-2">
                            <span class="text-sm font-medium text-gray-700">${job.company?.name || 'Perusahaan'}</span>
                        </div>
                        
                        <!-- Location -->
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>${job.location || 'Lokasi tidak tersedia'}</span>
                        </div>
                        
                        <!-- Employment Type & Work System -->
                        <div class="flex flex-wrap gap-2 mb-3">
                            ${job.employment_type ? `<span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">${job.employment_type}</span>` : ''}
                            ${job.work_system ? `<span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">${job.work_system}</span>` : ''}
                        </div>
                        
                        <!-- Saved Time -->
                        <div class="text-xs text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            Disimpan ${job.pivot ? new Date(job.pivot.created_at).toLocaleDateString('id-ID') : 'baru-baru ini'}
                        </div>
                    </div>
                    
                    <!-- Bookmark Button -->
                    <button class="text-red-500 hover:text-red-700 transition-colors p-1" onclick="event.stopPropagation(); bookmarkManager.toggleBookmark(${job.id}, this)" title="Hapus dari bookmark">
                        <i class="fas fa-bookmark text-lg"></i>
                    </button>
                </div>
            </div>
        `;
    }

    /**
     * Show empty bookmark state
     */
    showEmptyBookmarkState() {
        const container = document.querySelector('#tab-content-BOOKMARKED #bookmarked');
        if (!container) return;

        container.innerHTML = `
            <div class="text-center py-12">
                <i class="fas fa-bookmark text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Lowongan Tersimpan</h3>
                <p class="text-gray-500 mb-6">Simpan lowongan yang menarik untuk Anda dengan mengklik tombol bookmark</p>
                <button onclick="document.querySelector('[data-tab=\"FOR_YOU\"]').click()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Jelajahi Lowongan
                </button>
            </div>
        `;
    }

    /**
     * Show loading error state
     */
    showLoadingError() {
        const container = document.querySelector('#tab-content-BOOKMARKED #bookmarked');
        if (!container) return;

        container.innerHTML = `
            <div class="text-center py-12">
                <i class="fas fa-exclamation-triangle text-6xl text-red-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Gagal Memuat Data</h3>
                <p class="text-gray-500 mb-6">Terjadi kesalahan saat memuat lowongan tersimpan</p>
                <button onclick="bookmarkManager.loadBookmarkedJobs()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Coba Lagi
                </button>
            </div>
        `;
    }

    /**
     * Set button loading state
     * @param {HTMLElement} buttonElement - The button element
     * @param {boolean} isLoading - Loading state
     */
    setButtonLoading(buttonElement, isLoading) {
        if (!buttonElement) return;

        if (isLoading) {
            // Store original content
            buttonElement.dataset.originalContent = buttonElement.innerHTML;
            buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin text-lg"></i>';
            buttonElement.disabled = true;
        } else {
            buttonElement.disabled = false;
            // Restore original content if available
            if (buttonElement.dataset.originalContent) {
                buttonElement.innerHTML = buttonElement.dataset.originalContent;
                delete buttonElement.dataset.originalContent;
            }
        }
    }

    /**
     * Show authentication required message
     */
    showAuthenticationRequired() {
        alert('Silakan login terlebih dahulu untuk menyimpan lowongan.');
        window.location.href = this.loginUrl;
    }

    /**
     * Show toast notification
     * @param {string} message - The message to show
     * @param {string} type - The type of toast (success, error, info)
     */
    showToast(message, type = 'info') {
        // Use existing toast function if available, otherwise fallback to alert
        if (typeof window.showToast === 'function') {
            window.showToast(message, type);
        } else {
            console.log(`${type.toUpperCase()}: ${message}`);
            // You can implement a custom toast here
        }
    }
}

// Initialize bookmark manager
const bookmarkManager = new BookmarkManager();

// Global function for backward compatibility
function toggleBookmark(jobId, buttonElement = null) {
    bookmarkManager.toggleBookmark(jobId, buttonElement);
}

// Load bookmarked jobs when tab is activated
function loadBookmarkedJobs() {
    bookmarkManager.loadBookmarkedJobs();
}