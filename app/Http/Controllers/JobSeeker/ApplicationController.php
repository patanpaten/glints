<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Services\JobSeekerService;
use App\Services\ApplicationService;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    protected $jobSeekerService;
    protected $applicationService;
    protected $jobService;

    /**
     * ApplicationController constructor.
     *
     * @param JobSeekerService $jobSeekerService
     * @param ApplicationService $applicationService
     * @param JobService $jobService
     */
    public function __construct(
        JobSeekerService $jobSeekerService,
        ApplicationService $applicationService,
        JobService $jobService
    ) {
        $this->jobSeekerService = $jobSeekerService;
        $this->applicationService = $applicationService;
        $this->jobService = $jobService;
        
        $this->middleware('auth');
        $this->middleware('role:job-seeker');
    }

    /**
     * Display a listing of the job seeker's applications.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $status = $request->input('status');
        $applications = $this->applicationService->getByJobSeekerId($jobSeeker->id, true, 10);
        
        if ($status) {
            $applications = $this->applicationService->getByStatus($status, null, $jobSeeker->id, true, 10);
        }

        return view('jobseeker.applications.index', compact('jobSeeker', 'applications', 'status'));
    }

    /**
     * Display the specified application.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $application = $this->applicationService->findById($id);

        if (!$application || $application->job_seeker_id !== $jobSeeker->id) {
            return redirect()->route('jobseeker.applications.index')
                ->with('error', 'Application not found.');
        }

        return view('jobseeker.applications.show', compact('jobSeeker', 'application'));
    }

    /**
     * Show the form for creating a new application.
     *
     * @param Job $job
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create(Job $job)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        if (!$job->is_active) {
            return redirect()->route('jobs.index')
                ->with('error', 'Job not found or no longer active.');
        }

        // Check if already applied
        if ($this->applicationService->hasApplied($jobSeeker->id, $job->id)) {
            return redirect()->route('jobs.show', $job->slug)
                ->with('info', 'You have already applied for this job.');
        }

        return view('jobseeker.applications.create', compact('jobSeeker', 'job'));
    }

    /**
     * Store a newly created application.
     *
     * @param Request $request
     * @param int $jobId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $jobId)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $job = $this->jobService->findById($jobId);

        if (!$job || !$job->is_active) {
            return redirect()->route('jobs.index')
                ->with('error', 'Job not found or no longer active.');
        }

        // Check if already applied
        if ($this->applicationService->hasApplied($jobSeeker->id, $job->id)) {
            return redirect()->route('jobs.show', $job->slug)
                ->with('info', 'You have already applied for this job.');
        }

        $validated = $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $validated['job_id'] = $job->id;
        $validated['job_seeker_id'] = $jobSeeker->id;

        $this->applicationService->createApplication($validated);

        return redirect()->route('jobseeker.applications.index')
            ->with('success', 'Application submitted successfully!');
    }

    /**
     * Download the resume attached to an application.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse
     */
    public function downloadResume($id)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $application = $this->applicationService->findById($id);

        if (!$application || $application->job_seeker_id !== $jobSeeker->id) {
            return redirect()->route('jobseeker.applications.index')
                ->with('error', 'Application not found.');
        }

        if (!$application->resume || !Storage::exists($application->resume)) {
            return redirect()->route('jobseeker.applications.show', $application->id)
                ->with('error', 'Resume file not found.');
        }

        return Storage::download($application->resume);
    }

    /**
     * Withdraw an application.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function withdraw($id)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $application = $this->applicationService->findById($id);

        if (!$application || $application->job_seeker_id !== $jobSeeker->id) {
            return redirect()->route('jobseeker.applications.index')
                ->with('error', 'Application not found.');
        }

        // Only allow withdrawal if application is still pending
        if ($application->status !== 'pending') {
            return redirect()->route('jobseeker.applications.show', $application->id)
                ->with('error', 'Cannot withdraw application that has been processed.');
        }

        // Update status to 'withdrawn'
        $this->applicationService->updateStatus($application->id, 'withdrawn');

        return redirect()->route('jobseeker.applications.index')
            ->with('success', 'Application withdrawn successfully.');
    }
}