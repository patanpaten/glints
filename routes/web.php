<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\JobController as CompanyJobController;
use App\Http\Controllers\Company\ApplicationController as CompanyApplicationController;
use App\Http\Controllers\JobSeeker\JobSeekerController;
use App\Http\Controllers\JobSeeker\EducationController;
use App\Http\Controllers\JobSeeker\ExperienceController;
use App\Http\Controllers\JobSeeker\SkillController;
use App\Http\Controllers\JobSeeker\ApplicationController as JobSeekerApplicationController;
use App\Http\Controllers\JobSeeker\SavedJobController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PremiumFeatureController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CvSearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================
// Public routes
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// ==========================
// Authentication
// ==========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// Jobs (public)
// ==========================
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/category/{slug}', [JobController::class, 'byCategory'])->name('jobs.category');
Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');

// ==========================
// Admin
// ==========================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Premium Features Management
    Route::resource('premium-features', PremiumFeatureController::class)->only(['index','create','store']);

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'adminDashboard'])->name('analytics.dashboard');
});

// ==========================
// Company
// ==========================
Route::prefix('company')->name('company.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile/create', [CompanyController::class, 'create'])->name('profile.create');
    Route::post('/profile', [CompanyController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [CompanyController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [CompanyController::class, 'update'])->name('profile.update');

    // Jobs Management
    Route::resource('jobs', CompanyJobController::class)->except(['show']);
    Route::patch('/jobs/{job}/toggle-active', [CompanyJobController::class, 'toggleActive'])->name('jobs.toggle-active');
    Route::patch('/jobs/{job}/toggle-featured', [CompanyJobController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Applications (per job + global)
    Route::get('/jobs/{job}/applications', [CompanyApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications', [CompanyApplicationController::class, 'all'])->name('applications.all');
    Route::get('/applications/{application}', [CompanyApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [CompanyApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::get('/applications/{application}/resume', [CompanyApplicationController::class, 'downloadResume'])->name('applications.download-resume');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'companyDashboard'])->name('analytics.dashboard');
    Route::get('/jobs/{job}/analytics', [AnalyticsController::class, 'jobAnalytics'])->name('analytics.job');
    Route::get('/analytics/export', [AnalyticsController::class, 'export'])->name('analytics.export');

    // CV Search
    Route::get('/cv-search', [CvSearchController::class, 'index'])->name('cv-search.index');
    Route::post('/cv-search', [CvSearchController::class, 'search'])->name('cv-search.search');
    Route::get('/cv-search/{cvSearch}/results', [CvSearchController::class, 'results'])->name('cv-search.results');
    Route::get('/cv-search/result/{result}/profile', [CvSearchController::class, 'showProfile'])->name('cv-search.profile');
    Route::get('/cv-search/suggestions', [CvSearchController::class, 'suggestions'])->name('cv-search.suggestions');

    // Premium Features
    Route::get('/premium-features', [PremiumFeatureController::class, 'index'])->name('premium-features.index');
    Route::get('/premium-features/{feature}', [PremiumFeatureController::class, 'show'])->name('premium-features.show');
    Route::post('/premium-features/{feature}/subscribe', [PremiumFeatureController::class, 'subscribe'])->name('premium-features.subscribe');
    Route::patch('/subscriptions/{subscription}/cancel', [PremiumFeatureController::class, 'cancel'])->name('subscriptions.cancel');
    Route::get('/subscriptions/history', [PremiumFeatureController::class, 'history'])->name('subscriptions.history');
});

// ==========================
// Job Seeker
// ==========================
Route::prefix('jobseeker')->name('jobseeker.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [JobSeekerController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [JobSeekerController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/create', [JobSeekerController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [JobSeekerController::class, 'storeProfile'])->name('profile.store');
    Route::get('/profile/edit', [JobSeekerController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [JobSeekerController::class, 'updateProfile'])->name('profile.update');

    // Education
    Route::resource('education', EducationController::class)->only(['create','store','edit','update']);

    // Experience
    Route::resource('experience', ExperienceController::class)->only(['create','store','edit','update']);

    // Skills
    Route::resource('skills', SkillController::class)->only(['create','store','edit','update']);
    Route::get('/skills/search', [SkillController::class, 'search'])->name('skills.search');

    // Applications
    Route::get('/applications', [JobSeekerApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [JobSeekerApplicationController::class, 'show'])->name('applications.show');
    Route::get('/jobs/{job}/apply', [JobSeekerApplicationController::class, 'create'])->name('applications.create');
    Route::post('/jobs/{job}/apply', [JobSeekerApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}/resume', [JobSeekerApplicationController::class, 'downloadResume'])->name('applications.download-resume');
    Route::patch('/applications/{application}/withdraw', [JobSeekerApplicationController::class, 'withdraw'])->name('applications.withdraw');

    // Saved Jobs
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/saved-jobs', [SavedJobController::class, 'save'])->name('saved-jobs.save');
    Route::delete('/saved-jobs/{job}', [SavedJobController::class, 'unsave'])->name('saved-jobs.unsave');
});

// ==========================
// Apply (general, after login)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/jobs/{slug}/apply', [JobController::class, 'showApplicationForm'])->name('jobs.apply');
    Route::post('/jobs/{slug}/apply', [JobController::class, 'submitApplication'])->name('jobs.submit-application');

    // Chat
    Route::get('/chat/{application}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{application}/send', [ChatController::class, 'send'])->name('chat.send');
    Route::patch('/chat/{application}/read', [ChatController::class, 'markAsRead'])->name('chat.read');
    Route::get('/chat/unread-count', [ChatController::class, 'getUnreadCount'])->name('chat.unread-count');
    Route::get('/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
});

// ==========================
// Premium (public)
// ==========================
Route::get('/premium-features', [PremiumFeatureController::class, 'index'])->name('premium-features.index');
Route::get('/premium-features/{feature}', [PremiumFeatureController::class, 'show'])->name('premium-features.show');
