<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\JobService;
use App\Services\CompanyService;
use App\Services\JobCategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Job;

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
                'location' => 'nullable|string|max:255',
                'employment_type' => 'required|string|in:full-time,part-time,contract,internship,freelance',
                'work_system' => 'nullable|string|in:onsite,remote,hybrid',
                'country' => 'nullable|string|max:255',
                'office_address' => 'nullable|string',
                'experience_level' => 'nullable|string|in:entry,mid,senior,lt1,1-3,3-5,5-10',
                'education_level' => 'nullable|string|in:sd,smp,sma,diploma',
                'salary_min' => 'nullable|numeric|min:0',
                'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
                'bonus' => 'nullable|boolean',
                'hide_salary' => 'nullable|boolean',
                'gender' => 'nullable|string|in:male,female,any',
                'age_min' => 'nullable|integer|min:16|max:100',
                'age_max' => 'nullable|integer|min:16|max:100|gte:age_min',
                'no_age_limit' => 'nullable|boolean',
                'skills' => 'nullable|string',
                'require_photo' => 'nullable|boolean',
                'require_cv' => 'nullable|boolean',
                'vip_location' => 'nullable|boolean',
                'vip_education' => 'nullable|boolean',
                'vacancies' => 'nullable|integer|min:1',
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

            // Redirect ke screening setelah membuat job
            return redirect()->route('company.jobs.screening', $job->id)
                ->with('success', 'Lowongan kerja berhasil dibuat! Silakan tambahkan pertanyaan skrining.');
        } catch (\Exception $e) {
            \Log::error('Job creation failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function screening($jobId)
    {
        $job = Job::findOrFail($jobId);
        $questions = $job->screeningQuestions; // relasi hasMany
        return view('company.jobs.screening', compact('job', 'questions'));
    }

    public function storeScreening(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        $validated = $request->validate([
            'type' => 'required|string',
        ]);

        // Buat pertanyaan berdasarkan type yang dipilih
        $questionText = $this->getQuestionByType($validated['type']);
        
        $job->screeningQuestions()->create([
            'job_listing_id' => $job->id,
            'type' => $validated['type'],
            'question' => $questionText
        ]);

        return redirect()->route('company.dashboard')
            ->with('success', 'Pertanyaan skrining berhasil ditambahkan! Lowongan kerja telah berhasil dibuat.');
    }

    public function destroyScreening($jobId, $questionId)
    {
        $job = Job::findOrFail($jobId);
        $question = $job->screeningQuestions()->findOrFail($questionId);
        
        $question->delete();
        
        return redirect()->route('company.jobs.screening', $job->id)
            ->with('success', 'Pertanyaan skrining berhasil dihapus!');
    }

    private function getQuestionByType($type)
    {
        $questions = [
            'skill' => 'Apa keahlian utama yang Anda miliki yang relevan dengan posisi ini?',
            'experience' => 'Berapa tahun pengalaman kerja yang Anda miliki di bidang yang relevan?',
            'industry' => 'Apakah Anda memiliki pengalaman di industri yang sama dengan perusahaan kami?',
            'location' => 'Apakah Anda bersedia bekerja di lokasi yang telah ditentukan?',
            'document' => 'Apakah Anda memiliki sertifikat atau dokumen pendukung yang relevan?',
            'policy' => 'Apakah Anda bersedia mengikuti kebijakan kerja perusahaan?',
            'custom' => 'Pertanyaan khusus untuk posisi ini'
        ];

        return $questions[$type] ?? 'Pertanyaan skrining';
    }
}
