<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\JobService;
use App\Services\CompanyService;
use App\Services\JobCategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    protected $jobService;
    protected $companyService;
    protected $jobCategoryService;

    public function __construct(JobService $jobService, CompanyService $companyService, JobCategoryService $jobCategoryService)
    {
        $this->middleware(['auth:company', 'role:company']);
        $this->jobService = $jobService;
        $this->companyService = $companyService;
        $this->jobCategoryService = $jobCategoryService;
    }

    public function index(Request $request)
    {
    $company = Auth::guard('company')->user();

    if (!$company) {
        return redirect()->route('company.profile.create')
            ->with('error', 'Lengkapi profil perusahaan dulu.');
    }

    $status = $request->get('status', 'all'); // default all
    $jobs   = $this->jobService->getByCompanyAndStatus($company->id, $status);

    // Statistik job
    $stats = [
        'all'      => $this->jobService->countByCompanyAndStatus($company->id, null),
        'active'   => $this->jobService->countByCompanyAndStatus($company->id, 'active'),
        'inactive' => $this->jobService->countByCompanyAndStatus($company->id, 'inactive'),
        'review'   => $this->jobService->countByCompanyAndStatus($company->id, 'review'),
        'draft'    => $this->jobService->countByCompanyAndStatus($company->id, 'draft'),
    ];

    return view('company.jobs.index', compact('company', 'jobs', 'status', 'stats'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        \Log::info('Job create form accessed', ['company_id' => auth('company')->id()]);
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        // Get all job categories for dropdown
        $jobCategories = $this->jobCategoryService->getAllCategories();

        return view('company.jobs.create', compact('company', 'jobCategories'));
    }

    /**
     * Store a newly created job in storage.
     */
    public function store(Request $request)
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        try {
            \Log::info('Job creation started', [
                'request_data' => $request->all(),
                'company_id' => auth('company')->id(),
                'company_authenticated' => auth('company')->check()
            ]);
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'job_category_id' => 'required|exists:job_categories,id',
                'description' => 'required|string',
                'requirements' => 'nullable|string',
                'responsibilities' => 'nullable|string',
                'location' => 'required|string|max:255',
                'employment_type' => 'required|string|in:full-time,part-time,contract,internship',
                'experience_level' => 'nullable|string|in:entry,mid,senior',
                'education_level' => 'nullable|string',
                'salary_range' => 'nullable|string',
                'vacancies' => 'nullable|integer|min:1',
                'deadline' => 'nullable|date|after_or_equal:today',
            ]);

            \Log::info('Validation passed', ['validated_data' => $validated]);

            // Generate slug from title
            $validated['slug'] = Str::slug($validated['title'] . '-' . $company->id . '-' . time());
            $validated['company_id'] = $company->id;
            $validated['is_active'] = $request->has('is_active') ? 1 : 0;
            $validated['vacancies'] = $validated['vacancies'] ?? 1;

            \Log::info('Data prepared for creation', ['final_data' => $validated]);

            // Create job using repository
            $job = $this->jobService->getRepository()->create($validated);

            \Log::info('Job created successfully', ['job_id' => $job->id]);

            \Log::info('Attempting to redirect to company.dashboard');
            $redirectResponse = redirect()->route('company.dashboard')
                ->with('success', 'Lowongan kerja berhasil dibuat!');
            \Log::info('Redirect response created', ['status' => $redirectResponse->getStatusCode()]);
            
            return $redirectResponse;
        } catch (\Exception $e) {
            \Log::error('Job creation failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
