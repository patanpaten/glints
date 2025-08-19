<?php

namespace App\Http\Controllers;

use App\Services\JobService;
use App\Services\JobCategoryService;
use App\Services\SkillService;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    protected $jobService;
    protected $jobCategoryService;
    protected $skillService;
    protected $applicationService;

    /**
     * JobController constructor.
     *
     * @param JobService $jobService
     * @param JobCategoryService $jobCategoryService
     * @param SkillService $skillService
     * @param ApplicationService $applicationService
     */
    public function __construct(
        JobService $jobService,
        JobCategoryService $jobCategoryService,
        SkillService $skillService,
        ApplicationService $applicationService
    ) {
        $this->jobService = $jobService;
        $this->jobCategoryService = $jobCategoryService;
        $this->skillService = $skillService;
        $this->applicationService = $applicationService;
    }

    /**
     * Display a listing of jobs.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'keyword',
            'location',
            'category_id',
            'employment_type',
            'experience_level',
            'skill_ids',
            'salary_range',
            'sort'
        ]);
        
        $jobs = $this->jobService->getJobs($filters);
        $categories = $this->jobCategoryService->getAllCategories();
        $popularSkills = $this->skillService->getPopularSkills();
        
        return view('jobs.index', compact('jobs', 'categories', 'popularSkills', 'filters'));
    }

    /**
     * Display the specified job.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug)
    {
        $job = $this->jobService->findBySlug($slug);
        
        if (!$job) {
            abort(404);
        }
        
        $relatedJobs = $this->jobService->getRelatedJobs($job);
        
        $hasApplied = false;
        if (Auth::check() && Auth::user()->isJobSeeker() && Auth::user()->jobSeeker) {
            $hasApplied = $this->applicationService->hasApplied(
                $job->id,
                Auth::user()->jobSeeker->id
            );
        }

        return view('jobs.show', compact('job', 'relatedJobs', 'hasApplied'));
    }

    /**
     * Show the form for applying to a job.
     *
     * @param string $slug
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showApplyForm(string $slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to apply for jobs.');
        }

        if (!Auth::user()->isJobSeeker()) {
            return redirect()->back()
                ->with('error', 'Only job seekers can apply for jobs.');
        }

        $job = $this->jobService->repository->model
            ->where('slug', $slug)
            ->with('company')
            ->firstOrFail();

        if (!$job->is_active) {
            return redirect()->route('jobs.show', $job->slug)
                ->with('error', 'This job is no longer accepting applications.');
        }

        $jobSeeker = Auth::user()->jobSeeker;
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile before applying for jobs.');
        }

        if ($this->applicationService->hasApplied($job->id, $jobSeeker->id)) {
            return redirect()->route('jobs.show', $job->slug)
                ->with('error', 'You have already applied for this job.');
        }

        return view('jobs.apply', compact('job', 'jobSeeker'));
    }

    /**
     * Store a job application.
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply(Request $request, string $slug)
    {
        if (!Auth::check() || !Auth::user()->isJobSeeker()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in as a job seeker to apply for jobs.');
        }

        $job = $this->jobService->repository->model
            ->where('slug', $slug)
            ->firstOrFail();

        if (!$job->is_active) {
            return redirect()->route('jobs.show', $job->slug)
                ->with('error', 'This job is no longer accepting applications.');
        }

        $jobSeeker = Auth::user()->jobSeeker;
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile before applying for jobs.');
        }

        if ($this->applicationService->hasApplied($job->id, $jobSeeker->id)) {
            return redirect()->route('jobs.show', $job->slug)
                ->with('error', 'You have already applied for this job.');
        }

        $validated = $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $applicationData = [
            'job_id' => $job->id,
            'job_seeker_id' => $jobSeeker->id,
            'cover_letter' => $validated['cover_letter'],
            'resume' => $request->file('resume'),
        ];

        $this->applicationService->createApplication($applicationData);

        return redirect()->route('jobs.show', $job->slug)
            ->with('success', 'Your application has been submitted successfully!');
    }

    /**
     * Display jobs by category.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function byCategory(string $slug)
    {
        $category = $this->jobCategoryService->getBySlug($slug);
        
        if (!$category) {
            abort(404);
        }

        $jobs = $this->jobService->getByCategory($category->id, 15);
        $categories = $this->jobCategoryService->all();
        $popularSkills = $this->skillService->getPopularSkills(15);

        return view('jobs.by-category', compact('jobs', 'category', 'categories', 'popularSkills'));
    }
}