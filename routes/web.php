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
use App\Http\Controllers\Company\AccountSettingsController;
use App\Http\Controllers\JobSeeker\JobSeekerController;
use App\Http\Controllers\JobSeeker\EducationController;
use App\Http\Controllers\JobSeeker\ExperienceController;
use App\Http\Controllers\JobSeeker\SkillController;
use App\Http\Controllers\JobSeeker\ApplicationController;
use App\Http\Controllers\JobSeeker\SavedJobController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PremiumFeatureController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CvSearchController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\Company\TeamController;

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

    // Account Settings
    Route::prefix('account-settings')->name('account-settings.')->group(function () {
        Route::get('/', [AccountSettingsController::class, 'index'])->name('index');
        Route::put('/account', [AccountSettingsController::class, 'updateAccount'])->name('update-account');
        Route::put('/password', [AccountSettingsController::class, 'updatePassword'])->name('update-password');
        Route::put('/notifications', [AccountSettingsController::class, 'updateNotifications'])->name('update-notifications');
        Route::put('/social-media', [AccountSettingsController::class, 'updateSocialMedia'])->name('update-social-media');
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('/', [CompanyController::class, 'store'])->name('store');
        Route::get('/edit', [CompanyController::class, 'edit'])->name('edit');
        Route::put('/', [CompanyController::class, 'update'])->name('update');
        Route::get('/edit2', [CompanyController::class, 'edit2'])->name('edit2');
        Route::put('/update2', [CompanyController::class, 'update2'])->name('update2');
    });

    // WhatsApp
    Route::prefix('whatsapp')->name('whatsapp.')->group(function () {
        Route::get('/', [CompanyController::class, 'whatsappForm'])->name('form');
        Route::post('/', [CompanyController::class, 'saveWhatsapp'])->name('save');
    });

    // Logo Upload
    Route::post('/logo/upload', [CompanyController::class, 'uploadLogo'])->name('logo.upload');

    Route::get('/profile', [CompanyController::class, 'edit'])->name('profile');
    Route::get('/profile/edit', [CompanyController::class, 'edit'])->name('profile.edit');


    Route::get('/company/{id}/edit2', [CompanyController::class, 'edit2'])->name('company.edit2');
    Route::put('/company/{id}', [CompanyController::class, 'update'])->name('company.update');

    // Step 2 - Pertanyaan Skrining
    Route::get('/jobs/{job}/screening', [CompanyJobController::class, 'screening'])
        ->name('jobs.screening');
    Route::post('/jobs/{job}/screening', [CompanyJobController::class, 'storeScreening'])
        ->name('jobs.screening.store');
    Route::delete('/jobs/{job}/screening/{question}', [CompanyJobController::class, 'destroyScreening'])
        ->name('jobs.screening.destroy');


    // Jobs Management
    Route::resource('jobs', CompanyJobController::class)->except(['show']);
    Route::get('/jobs/{job}/applications', [CompanyApplicationController::class, 'index'])->name('applications.index');
    Route::patch('/jobs/{job}/toggle-active', [CompanyJobController::class, 'toggleActive'])->name('jobs.toggle-active');
    Route::patch('/jobs/{job}/toggle-featured', [CompanyJobController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Tim Perusahaan
    Route::get('/tim', [TeamController::class, 'index'])->name('tim.index');
    Route::post('/tim', [TeamController::class, 'store'])->name('tim.store');

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
Route::prefix('jobseeker')->name('jobseeker.')->middleware(['auth', 'role:job-seeker'])->group(function () {
    Route::get('/dashboard', [JobSeekerController::class, 'dashboard'])->name('dashboard');

    // Old Profile Routes
    Route::get('/profile', [JobSeekerController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/create', [JobSeekerController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [JobSeekerController::class, 'storeProfile'])->name('profile.store');
    Route::get('/profile/edit', [JobSeekerController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [JobSeekerController::class, 'updateProfile'])->name('profile.update');

    // New CRUD Profile Routes
    Route::get('/profile/view', [App\Http\Controllers\JobSeeker\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/new', [App\Http\Controllers\JobSeeker\ProfileController::class, 'create'])->name('profile.new');
    Route::post('/profile/new', [App\Http\Controllers\JobSeeker\ProfileController::class, 'store'])->name('profile.save');
    Route::get('/profile/{id}/edit', [App\Http\Controllers\JobSeeker\ProfileController::class, 'edit'])->name('profile.edit.id');
    Route::put('/profile/{id}', [App\Http\Controllers\JobSeeker\ProfileController::class, 'update'])->name('profile.update.id');
    Route::delete('/profile/picture', [App\Http\Controllers\JobSeeker\ProfileController::class, 'removeProfilePicture'])->name('profile.remove.picture');
    Route::resource('education', EducationController::class)->only(['create','store','edit','update']);
    Route::resource('experience', ExperienceController::class)->only(['create','store','edit','update']);
    Route::resource('skills', SkillController::class)->only(['create','store','edit','update']);
    Route::get('/skills/search', [SkillController::class, 'search'])->name('skills.search');
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}/resume', [ApplicationController::class, 'downloadResume'])->name('applications.download-resume');
    Route::patch('/applications/{application}/withdraw', [ApplicationController::class, 'withdraw'])->name('applications.withdraw');
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/saved-jobs', [SavedJobController::class, 'save'])->name('saved-jobs.save');
    Route::delete('/saved-jobs', [SavedJobController::class, 'unsave'])->name('saved-jobs.unsave');

    // Jobs routes for jobseeker
    Route::get('/jobs', [JobSeekerController::class, 'jobs'])->name('jobs.index');

    // Companies routes for jobseeker
    Route::get('/companies', [JobSeekerController::class, 'companies'])->name('companies');
    Route::get('/companies/{company}', [JobSeekerController::class, 'companyDetail'])->name('companies.show');
});

// Job detail route (accessible without specific role)
Route::get('/jobseeker/jobs/{slug}', [JobSeekerController::class, 'jobDetail'])->name('jobseeker.jobs.show');

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
