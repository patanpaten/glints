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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Job routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/category/{slug}', [JobController::class, 'byCategory'])->name('jobs.category');

// Company routes
Route::prefix('company')->name('company.')->middleware(['auth', 'role:company'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
    
    // Company Profile
    Route::get('/profile/create', [CompanyController::class, 'create'])->name('profile.create');
    Route::post('/profile', [CompanyController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [CompanyController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [CompanyController::class, 'update'])->name('profile.update');
    
    // Jobs Management
    Route::get('/jobs', [CompanyJobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [CompanyJobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [CompanyJobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [CompanyJobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [CompanyJobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [CompanyJobController::class, 'destroy'])->name('jobs.destroy');
    Route::patch('/jobs/{id}/toggle-active', [CompanyJobController::class, 'toggleActive'])->name('jobs.toggle-active');
    Route::patch('/jobs/{id}/toggle-featured', [CompanyJobController::class, 'toggleFeatured'])->name('jobs.toggle-featured');
    
    // Applications Management
    Route::get('/jobs/{jobId}/applications', [CompanyApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}', [CompanyApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{id}/status', [CompanyApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::get('/applications/{id}/resume', [CompanyApplicationController::class, 'downloadResume'])->name('applications.download-resume');
    Route::get('/applications', [CompanyApplicationController::class, 'all'])->name('applications.all');
});

// Job Seeker routes
Route::prefix('jobseeker')->name('jobseeker.')->middleware(['auth', 'role:job-seeker'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [JobSeekerController::class, 'dashboard'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile/create', [JobSeekerController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [JobSeekerController::class, 'storeProfile'])->name('profile.store');
    Route::get('/profile/edit', [JobSeekerController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [JobSeekerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile', [JobSeekerController::class, 'showProfile'])->name('profile.show');
    
    // Education Management
    Route::get('/education/create', [EducationController::class, 'create'])->name('education.create');
    Route::post('/education', [EducationController::class, 'store'])->name('education.store');
    Route::get('/education/edit', [EducationController::class, 'edit'])->name('education.edit');
    Route::put('/education', [EducationController::class, 'update'])->name('education.update');
    
    // Experience Management
    Route::get('/experience/create', [ExperienceController::class, 'create'])->name('experience.create');
    Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');
    Route::get('/experience/edit', [ExperienceController::class, 'edit'])->name('experience.edit');
    Route::put('/experience', [ExperienceController::class, 'update'])->name('experience.update');
    
    // Skills Management
    Route::get('/skills/create', [SkillController::class, 'create'])->name('skill.create');
    Route::post('/skills', [SkillController::class, 'store'])->name('skill.store');
    Route::get('/skills/edit', [SkillController::class, 'edit'])->name('skill.edit');
    Route::put('/skills', [SkillController::class, 'update'])->name('skill.update');
    Route::get('/skills/search', [SkillController::class, 'search'])->name('skill.search');
    
    // Applications Management
    Route::get('/applications', [JobSeekerApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}', [JobSeekerApplicationController::class, 'show'])->name('applications.show');
    Route::get('/jobs/{jobId}/apply', [JobSeekerApplicationController::class, 'create'])->name('applications.create');
    Route::post('/jobs/{jobId}/apply', [JobSeekerApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{id}/resume', [JobSeekerApplicationController::class, 'downloadResume'])->name('applications.download-resume');
    Route::patch('/applications/{id}/withdraw', [JobSeekerApplicationController::class, 'withdraw'])->name('applications.withdraw');
    
    // Saved Jobs
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/saved-jobs', [SavedJobController::class, 'save'])->name('saved-jobs.save');
    Route::delete('/saved-jobs/{jobId}', [SavedJobController::class, 'unsave'])->name('saved-jobs.unsave');
});

// Apply for job (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/jobs/{slug}/apply', [JobController::class, 'showApplicationForm'])->name('jobs.apply');
    Route::post('/jobs/{slug}/apply', [JobController::class, 'submitApplication'])->name('jobs.submit-application');
});
