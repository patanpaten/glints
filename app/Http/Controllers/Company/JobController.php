<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\JobService;
use App\Services\JobCategoryService;
use App\Services\SkillService;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    protected $jobService;
    protected $jobCategoryService;
    protected $skillService;
    protected $companyService;

    /**
     * JobController constructor.
     *
     * @param JobService $jobService
     * @param JobCategoryService $jobCategoryService
     * @param SkillService $skillService
     * @param CompanyService $companyService
     */
    public function __construct(
        JobService $jobService,
        JobCategoryService $jobCategoryService,
        SkillService $skillService,
        CompanyService $companyService
    ) {
        $this->jobService = $jobService;
        $this->jobCategoryService = $jobCategoryService;
        $this->skillService = $skillService;
        $this->companyService = $companyService;
        $this->middleware('auth');
        $this->middleware('role:company');
    }

    /**
     * Display a listing of the jobs.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $company = $this->companyService->getByUserId(Auth::id());
        
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $jobs = $this->jobService->getPaginatedByCompanyId($company->id, 10);

        return view('company.jobs.index', compact('jobs', 'company'));
    }

    /**
     * Show the form for creating a new job.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $company = $this->companyService->getByUserId(Auth::id());
        
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $categories = $this->jobCategoryService->all();
        $skills = $this->skillService->all();

        return view('company.jobs.create', compact('categories', 'skills', 'company'));
    }

    /**
     * Store a newly created job.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $company = $this->companyService->getByUserId(Auth::id());
        
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'job_category_id' => 'required|exists:job_categories,id',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'responsibilities' => 'required|string',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string|max:100',
            'experience_level' => 'required|string|max:100',
            'education_level' => 'required|string|max:100',
            'salary_range' => 'required|string|max:100',
            'vacancies' => 'required|integer|min:1',
            'deadline' => 'required|date|after:today',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $validated['company_id'] = $company->id;
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $skills = $request->input('skills', []);

        $jobData = $validated;
        unset($jobData['skills']);

        $job = $this->jobService->createJob($jobData);

        if (!empty($skills)) {
            $job->skills()->attach($skills);
        }

        return redirect()->route('company.jobs.index')
            ->with('success', 'Job created successfully!');
    }

    /**
     * Show the form for editing the job.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $company = $this->companyService->getByUserId(Auth::id());
        
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $job = $this->jobService->findById($id);

        if ($job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')
                ->with('error', 'You are not authorized to edit this job.');
        }

        $categories = $this->jobCategoryService->all();
        $skills = $this->skillService->all();
        $selectedSkills = $job->skills->pluck('id')->toArray();

        return view('company.jobs.edit', compact('job', 'categories', 'skills', 'selectedSkills', 'company'));
    }

    /**
     * Update the job.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $company = $this->companyService->getByUserId(Auth::id());
        
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $job = $this->jobService->findById($id);

        if ($job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')
                ->with('error', 'You are not authorized to update this job.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'job_category_id' => 'required|exists:job_categories,id',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'responsibilities' => 'required|string',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string|max:100',
            'experience_level' => 'required|string|max:100',
            'education_level' => 'required|string|max:100',
            'salary_range' => 'required|string|max:100',
            'vacancies' => 'required|integer|min:1',
            'deadline' => 'required|date',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $skills = $request->input('skills', []);

        $jobData = $validated;
        unset($jobData['skills']);

        $job = $this->jobService->updateJob($id, $jobData);

        $job->skills()->sync($skills);

        return redirect()->route('company.jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the job.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $company = $this->companyService->getByUserId(Auth::id());
        
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $job = $this->jobService->findById($id);

        if ($job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')
                ->with('error', 'You are not authorized to delete this job.');
        }

        $this->jobService->deleteById($id);

        return redirect()->route('company.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }

    /**
     * Toggle job active status.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleActive($id)
    {
        $company = $this->companyService->getByUserId(Auth::id());
        
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $job = $this->jobService->findById($id);

        if ($job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')
                ->with('error', 'You are not authorized to update this job.');
        }

        $this->jobService->toggleActive($id);

        return redirect()->route('company.jobs.index')
            ->with('success', 'Job status updated successfully!');
    }
}