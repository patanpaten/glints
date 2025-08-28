<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\JobController as CompanyJobController;
use App\Http\Controllers\Company\ApplicationController as CompanyApplicationController;
use App\Http\Controllers\Company\Auth\LoginController as CompanyLoginController;
use App\Http\Controllers\Company\Auth\RegisterController as CompanyRegisterController;
use App\Http\Controllers\Company\Auth\CompanyRegisterEmailController;
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
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompaniesController;

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

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{article}', [BlogController::class, 'show'])->name('blog.show');

// ==========================
// Authentication (Jobseeker / Default User)
// ==========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login-regis', fn () => view('auth.login-regis'))->name('login-regis');
Route::get('/login-email', fn () => view('auth.login-email'))->name('login-email');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::get('/register-email', fn () => view('auth.register-email'))->name('register-email');
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
Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompaniesController::class, 'show'])->name('companies.show');

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
    Route::resource('premium-features', PremiumFeatureController::class)->only(['index','create','store']);
    Route::get('/analytics', [AnalyticsController::class, 'adminDashboard'])->name('analytics.dashboard');
});

// ==========================
// Company Auth (tanpa middleware auth:company)
// ==========================
Route::prefix('company')->name('company.')->group(function () {
    // Login
    Route::get('/login', [CompanyLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CompanyLoginController::class, 'login']);
    Route::post('/logout', [CompanyLoginController::class, 'logout'])->name('logout');

    // Register
    Route::get('/register', [CompanyRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [CompanyRegisterController::class, 'register']);
});

// ==========================
// Company (hanya bisa diakses setelah login perusahaan)
// ==========================
Route::prefix('company')->name('company.')->middleware('auth:company')->group(function () {
    // Dashboard
    Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('/', [CompanyController::class, 'store'])->name('store');
        Route::get('/edit', [CompanyController::class, 'edit'])->name('edit');
        Route::put('/', [CompanyController::class, 'update'])->name('update');
    });

    // WhatsApp
    Route::prefix('whatsapp')->name('whatsapp.')->group(function () {
        Route::get('/', [CompanyController::class, 'whatsappForm'])->name('form');
        Route::post('/', [CompanyController::class, 'saveWhatsapp'])->name('save');
    });

    // Logo Upload
    Route::post('/logo/upload', [CompanyController::class, 'uploadLogo'])->name('logo.upload');

    Route::get('/profile', [CompanyController::class, 'edit'])->name('profile');

    // Jobs Management
    Route::resource('jobs', CompanyJobController::class)->except(['show']);
    Route::get('/jobs/{job}/applications', [CompanyApplicationController::class, 'index'])->name('applications.index');
    Route::patch('/jobs/{job}/toggle-active', [CompanyJobController::class, 'toggleActive'])->name('jobs.toggle-active');
    Route::patch('/jobs/{job}/toggle-featured', [CompanyJobController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Applications
    Route::get('/applications', [CompanyApplicationController::class, 'all'])->name('applications.all');
    Route::get('/applications/{application}', [CompanyApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [CompanyApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::get('/applications/{application}/resume', [CompanyApplicationController::class, 'downloadResume'])->name('applications.download-resume');
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
    Route::get('/profile', [JobSeekerController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/create', [JobSeekerController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [JobSeekerController::class, 'storeProfile'])->name('profile.store');
    Route::get('/profile/edit', [JobSeekerController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [JobSeekerController::class, 'updateProfile'])->name('profile.update');
    Route::resource('education', EducationController::class)->only(['create','store','edit','update']);
    Route::resource('experience', ExperienceController::class)->only(['create','store','edit','update']);
    Route::resource('skills', SkillController::class)->only(['create','store','edit','update']);
    Route::get('/skills/search', [SkillController::class, 'search'])->name('skills.search');
    Route::get('/applications', [JobSeekerApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [JobSeekerApplicationController::class, 'show'])->name('applications.show');
    Route::get('/jobs/{job}/apply', [JobSeekerApplicationController::class, 'create'])->name('applications.create');
    Route::post('/jobs/{job}/apply', [JobSeekerApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}/resume', [JobSeekerApplicationController::class, 'downloadResume'])->name('applications.download-resume');
    Route::patch('/applications/{application}/withdraw', [JobSeekerApplicationController::class, 'withdraw'])->name('applications.withdraw');
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



// form register
Route::get('/company/register-email', [CompanyRegisterEmailController::class, 'showRegisterForm'])
     ->name('company.register.email.form');

// proses register
Route::post('/company/register-email', [CompanyRegisterEmailController::class, 'register'])
     ->name('company.register.email');
