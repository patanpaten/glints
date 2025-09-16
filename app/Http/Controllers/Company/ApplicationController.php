<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\ApplicationService;
use App\Services\JobService;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    protected $applicationService;
    protected $jobService;
    protected $companyService;

    public function __construct(
        ApplicationService $applicationService,
        JobService $jobService,
        CompanyService $companyService
    ) {
        $this->applicationService = $applicationService;
        $this->jobService = $jobService;
        $this->companyService = $companyService;
        $this->middleware(['auth:company', 'role:company']);
        Log::info('[ApplicationController] Initialized');
    }

    /**
     * List applications for a job.
     */
    public function index($jobId)
    {
        $company = Auth::guard('company')->user();
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $job = $this->jobService->findById($jobId);
        if (!$job || $job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')
                ->with('error', 'You are not authorized to view applications for this job.');
        }

        Log::info('[ApplicationController] Fetching paginated applications', ['job_id' => $jobId]);

        // Gunakan eager loading untuk job dan jobSeeker
        $applications = $this->applicationService->getPaginatedByJobId($jobId, 15);

        Log::info('[ApplicationController] Retrieved applications count: '.$applications->total());

        return view('company.applications.index', compact('applications', 'job', 'company'));
    }

    /**
     * Show application detail.
     */
    public function show($id)
    {
        $company = Auth::guard('company')->user();
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        Log::info('[ApplicationController] Show application', ['id' => $id]);

        $application = $this->applicationService->findById($id, ['*'], ['job', 'jobSeeker']);
        if (!$application || $application->job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')
                ->with('error', 'You are not authorized to view this application.');
        }

        return view('company.applications.show', compact('application', 'company'));
    }

    /**
     * Update application status.
     */
    public function update(Request $request, $id)
    {
        $company = Auth::guard('company')->user();
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        Log::info('[ApplicationController] Update application status', ['id' => $id]);

        $application = $this->applicationService->findById($id, ['*'], ['job']);
        if (!$application || $application->job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')
                ->with('error', 'You are not authorized to update this application.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected,hired',
            'notes'  => 'nullable|string',
        ]);

        $this->applicationService->updateStatus($id, $validated['status'], $validated['notes'] ?? null);

        Log::info('[ApplicationController] Application status updated', ['id' => $id, 'status' => $validated['status']]);

        return redirect()->route('company.applications.show', $id)
            ->with('success', 'Application status updated successfully!');
    }

    /**
     * Download applicant resume.
     */
    public function downloadResume($id)
    {
        $company = Auth::guard('company')->user();
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        Log::info('[ApplicationController] Download resume', ['id' => $id]);

        $application = $this->applicationService->findById($id, ['*'], ['job']);
        if (!$application || $application->job->company_id !== $company->id) {
            return redirect()->route('company.jobs.index')
                ->with('error', 'You are not authorized to download this resume.');
        }

        if (!$application->resume || !Storage::disk('public')->exists($application->resume)) {
            return redirect()->route('company.applications.show', $id)
                ->with('error', 'Resume file not found.');
        }

        Log::info('[ApplicationController] Resume file exists: '.$application->resume);

        return Storage::disk('public')->download($application->resume);
    }

    /**
     * Show all applications across company jobs.
     */
    public function all(Request $request)
    {
        $company = Auth::guard('company')->user();
        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please complete your company profile first.');
        }

        $status = $request->input('status');
        $jobId  = $request->input('job_id');

        Log::info('[ApplicationController] Fetching all applications', ['company_id' => $company->id, 'status' => $status, 'job_id' => $jobId]);

        $query = $this->applicationService->getRepositoryInstance()->getModel()
            ->whereHas('job', function ($q) use ($company) {
                $q->where('company_id', $company->id);
            })
            ->with(['job', 'jobSeeker']);

        if ($status) {
            $query->where('status', $status);
        }
        if ($jobId) {
            $query->where('job_id', $jobId);
        }

        $applications = $query->paginate(15);
        Log::info('[ApplicationController] Total applications fetched: '.$applications->total());

        $jobs = $this->jobService->getByCompanyId($company->id);

        return view('company.applications.all', compact('applications', 'jobs', 'company', 'status', 'jobId'));
    }
}
