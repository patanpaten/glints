<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Services\JobService;
use App\Services\JobCategoryService;
use App\Services\SkillService;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    protected $jobService, $jobCategoryService, $skillService, $companyService;

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
     * Ambil data company user login
     */
    private function getCompanyOrRedirect()
    {
        $company = $this->companyService->getByUserId(Auth::id());
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }
        return $company;
    }

    public function index()
    {
        $company = $this->getCompanyOrRedirect();
        if ($company instanceof \Illuminate\Http\RedirectResponse) return $company;

        $jobs = $this->jobService->getPaginatedByCompanyId($company->id, 10);

        return view('company.jobs.index', compact('jobs', 'company'));
    }

    public function create()
    {
        $company = $this->getCompanyOrRedirect();
        if ($company instanceof \Illuminate\Http\RedirectResponse) return $company;

        $categories = $this->jobCategoryService->all();
        $skills = $this->skillService->all();

        return view('company.jobs.create', compact('categories', 'skills', 'company'));
    }

    public function store(Request $request)
    {
        $company = $this->getCompanyOrRedirect();
        if ($company instanceof \Illuminate\Http\RedirectResponse) return $company;

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
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $skills = $validated['skills'] ?? [];
        unset($validated['skills']);

        $job = $this->jobService->createJob($validated);

        if (!empty($skills)) {
            $job->skills()->attach($skills);
        }

        return redirect()->route('company.jobs.index')->with('success', 'Job created successfully!');
    }

    public function edit(Job $job)
    {
        $company = $this->getCompanyOrRedirect();
        if ($company instanceof \Illuminate\Http\RedirectResponse) return $company;

        if ($job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')->with('error', 'Unauthorized.');
        }

        $categories = $this->jobCategoryService->all();
        $skills = $this->skillService->all();
        $selectedSkills = $job->skills->pluck('id')->toArray();

        return view('company.jobs.edit', compact('job', 'categories', 'skills', 'selectedSkills', 'company'));
    }

    public function update(Request $request, Job $job)
    {
        $company = $this->getCompanyOrRedirect();
        if ($company instanceof \Illuminate\Http\RedirectResponse) return $company;

        if ($job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')->with('error', 'Unauthorized.');
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
            'deadline' => 'required|date|after_or_equal:today',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $skills = $validated['skills'] ?? [];
        unset($validated['skills']);

        $this->jobService->updateJob($job->id, $validated);
        $job->skills()->sync($skills);

        return redirect()->route('company.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        $company = $this->getCompanyOrRedirect();
        if ($company instanceof \Illuminate\Http\RedirectResponse) return $company;

        if ($job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')->with('error', 'Unauthorized.');
        }

        $this->jobService->deleteById($job->id);

        return redirect()->route('company.jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function toggleActive(Job $job)
    {
        $company = $this->getCompanyOrRedirect();
        if ($company instanceof \Illuminate\Http\RedirectResponse) return $company;

        if ($job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')->with('error', 'Unauthorized.');
        }

        $this->jobService->toggleActive($job->id);

        return redirect()->route('company.jobs.index')->with('success', 'Job status updated successfully!');
    }
}
