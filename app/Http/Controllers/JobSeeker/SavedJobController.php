<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\JobSeekerService;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
    protected $jobSeekerService;
    protected $jobService;

    /**
     * SavedJobController constructor.
     *
     * @param JobSeekerService $jobSeekerService
     * @param JobService $jobService
     */
    public function __construct(
        JobSeekerService $jobSeekerService,
        JobService $jobService
    ) {
        $this->jobSeekerService = $jobSeekerService;
        $this->jobService = $jobService;
        $this->middleware('auth');
        $this->middleware('role:job-seeker');
    }

    /**
     * Display a listing of saved jobs.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Please complete your profile first.']);
            }
            
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        // Get saved jobs with related data
        $savedJobs = $jobSeeker->savedJobs()->with('company')->get();

        if ($request->ajax() || $request->get('ajax')) {
            return response()->json([
                'success' => true,
                'savedJobs' => $savedJobs
            ]);
        }

        // For regular requests, use pagination
        $savedJobsPaginated = $jobSeeker->savedJobs()->with('company')->paginate(10);
        
        return view('jobseeker.saved_jobs.index', compact('jobSeeker') + ['savedJobs' => $savedJobsPaginated]);
    }

    /**
     * Save a job for later.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        // Validate the request
        $request->validate([
            'job_id' => 'required|integer|exists:job_listings,id'
        ]);
        
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Please complete your profile first.']);
            }
            
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $jobId = $request->input('job_id');
        $job = $this->jobService->findById($jobId);

        if (!$job) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Job not found.']);
            }
            
            return redirect()->route('jobs.index')
                ->with('error', 'Job not found.');
        }

        // Check if already saved
        if ($jobSeeker->savedJobs()->where('job_id', $jobId)->exists()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Job already saved.']);
            }
            
            return redirect()->back()
                ->with('info', 'Job already saved.');
        }

        // Save the job
        $jobSeeker->savedJobs()->attach($jobId);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Job saved successfully.']);
        }
        
        return redirect()->back()
            ->with('success', 'Job saved successfully.');
    }

    /**
     * Remove a saved job.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function unsave(Request $request)
    {
        // Validate the request
        $request->validate([
            'job_id' => 'required|integer|exists:job_listings,id'
        ]);
        
        $jobId = $request->input('job_id');
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Please complete your profile first.']);
            }
            
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        // Check if job exists in saved jobs
        if (!$jobSeeker->savedJobs()->where('job_id', $jobId)->exists()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Job not found in saved jobs.']);
            }
            
            return redirect()->route('jobseeker.saved_jobs.index')
                ->with('error', 'Job not found in saved jobs.');
        }

        // Remove the job from saved jobs
        $jobSeeker->savedJobs()->detach($jobId);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Job removed from saved jobs.']);
        }
        
        return redirect()->route('jobseeker.saved_jobs.index')
            ->with('success', 'Job removed from saved jobs.');
    }
}