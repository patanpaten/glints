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

// Blog - redirect to external URL
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::get('/blog/{article}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// ==========================
// Authentication
// ==========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login-regis', function () {
    return view('auth.login-regis');
})->name('login-regis');

Route::get('/login-email', function () {
    return view('auth.login-email');
})->name('login-email');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::get('/register-email', function () {
    return view('auth.register-email');
})->name('register-email');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// Jobs (public)
// ==========================
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/category/{slug}', [JobController::class, 'byCategory'])->name('jobs.category');
Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{slug}/apply', [JobController::class, 'showApplyForm'])->name('jobs.apply');
Route::post('/jobs/{slug}/apply', [JobController::class, 'apply'])->name('jobs.submit-application');

// ==========================
// Companies (public)
// ==========================
Route::get('/companies', [App\Http\Controllers\CompaniesController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [App\Http\Controllers\CompaniesController::class, 'show'])->name('companies.show');

// ==========================
// Premium (public)
// ==========================
Route::prefix('premium-features')->name('premium-features.')->group(function () {
    Route::get('/', [PremiumFeatureController::class, 'index'])->name('index');
    Route::get('/{feature}', [PremiumFeatureController::class, 'show'])->name('show');
});

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
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/create', [CompanyController::class, 'create'])->name('create');
        Route::post('/store', [CompanyController::class, 'store'])->name('store');
        Route::get('/edit', [CompanyController::class, 'edit'])->name('edit');
        Route::post('/update', [CompanyController::class, 'update'])->name('update');
    });
    // Direct profile route for sidebar link
    Route::get('/profile', [CompanyController::class, 'edit'])->name('profile');


    // Jobs Management
    Route::resource('jobs', CompanyJobController::class)->except(['show']);
    Route::get('/jobs/{job}/applications', [CompanyApplicationController::class, 'index'])->name('applications.index');
    Route::patch('/jobs/{job}/toggle-active', [CompanyJobController::class, 'toggleActive'])->name('jobs.toggle-active');
    Route::patch('/jobs/{job}/toggle-featured', [CompanyJobController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Applications (per job + global)
    Route::get('/jobs/{job}/applications', [CompanyApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications', [CompanyApplicationController::class, 'all'])->name('applications.all');
    Route::get('/applications/{application}', [CompanyApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [CompanyApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::get('/applications/{application}/resume', [CompanyApplicationController::class, 'downloadResume'])->name('applications.download-resume');
    // Direct applicants route for sidebar link
    Route::get('/applicants', [CompanyApplicationController::class, 'all'])->name('applicants.index');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'companyDashboard'])->name('analytics.dashboard');
    Route::get('/jobs/{job}/analytics', [AnalyticsController::class, 'jobAnalytics'])->name('analytics.job');
    Route::get('/analytics/export', [AnalyticsController::class, 'export'])->name('analytics.export');

    // CV Search
    Route::prefix('cv-search')->name('cv-search.')->group(function () {
        Route::get('/', [CvSearchController::class, 'index'])->name('index');
        Route::post('/', [CvSearchController::class, 'search'])->name('search');
        Route::get('/{cvSearch}/results', [CvSearchController::class, 'results'])->name('results');
        Route::get('/result/{result}/profile', [CvSearchController::class, 'showProfile'])->name('profile');
        Route::get('/suggestions', [CvSearchController::class, 'suggestions'])->name('suggestions');
    });

    // Premium Features (khusus company)
    Route::prefix('premium-features')->name('premium-features.')->group(function () {
        Route::get('/', [PremiumFeatureController::class, 'index'])->name('index');
        Route::get('/{feature}', [PremiumFeatureController::class, 'show'])->name('show');
        Route::post('/{feature}/subscribe', [PremiumFeatureController::class, 'subscribe'])->name('subscribe');
        Route::patch('/subscriptions/{subscription}/cancel', [PremiumFeatureController::class, 'cancel'])->name('subscriptions.cancel');
        Route::get('/subscriptions/history', [PremiumFeatureController::class, 'history'])->name('subscriptions.history');
    });
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
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/{application}', [ChatController::class, 'show'])->name('show');
        Route::post('/{application}/send', [ChatController::class, 'send'])->name('send');
        Route::patch('/{application}/read', [ChatController::class, 'markAsRead'])->name('read');
        Route::get('/unread-count', [ChatController::class, 'getUnreadCount'])->name('unread-count');
        Route::get('/conversations', [ChatController::class, 'getConversations'])->name('conversations');
    });
});
