<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\JobSeekerService;
use App\Services\EducationService;
use App\Services\ExperienceService;
use App\Services\SkillService;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSeekerController extends Controller
{
    protected $jobSeekerService;
    protected $educationService;
    protected $experienceService;
    protected $skillService;
    protected $applicationService;

    /**
     * JobSeekerController constructor.
     *
     * @param JobSeekerService $jobSeekerService
     * @param EducationService $educationService
     * @param ExperienceService $experienceService
     * @param SkillService $skillService
     * @param ApplicationService $applicationService
     */
    public function __construct(
        JobSeekerService $jobSeekerService,
        EducationService $educationService,
        ExperienceService $experienceService,
        SkillService $skillService,
        ApplicationService $applicationService
    ) {
        $this->jobSeekerService = $jobSeekerService;
        $this->educationService = $educationService;
        $this->experienceService = $experienceService;
        $this->skillService = $skillService;
        $this->applicationService = $applicationService;
        $this->middleware('auth');
        $this->middleware('role:job-seeker');
    }

    /**
     * Display job seeker dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function dashboard()
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $recentApplications = $this->applicationService->getByJobSeekerId($jobSeeker->id)->take(5);
        $totalApplications = $this->applicationService->repository->model->where('job_seeker_id', $jobSeeker->id)->count();
        $pendingApplications = $this->applicationService->repository->model->where('job_seeker_id', $jobSeeker->id)->where('status', 'pending')->count();
        $shortlistedApplications = $this->applicationService->repository->model->where('job_seeker_id', $jobSeeker->id)->whereIn('status', ['shortlisted', 'hired'])->count();

        return view('jobseeker.dashboard', compact(
            'jobSeeker',
            'recentApplications',
            'totalApplications',
            'pendingApplications',
            'shortlistedApplications'
        ));
    }

    /**
     * Show the form for creating a job seeker profile.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function createProfile()
    {
        // Check if user already has a job seeker profile
        $existingProfile = $this->jobSeekerService->getByUserId(Auth::id());
        
        if ($existingProfile) {
            return redirect()->route('jobseeker.profile.edit')
                ->with('info', 'You already have a profile.');
        }

        return view('jobseeker.profile.create');
    }

    /**
     * Store a newly created job seeker profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProfile(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birth_date' => 'required|date|before:today',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date|before:today',
            'phone' => 'required|string|max:20',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'summary' => 'required|string',
            'current_position' => 'nullable|string|max:255',
            'current_position' => 'nullable|string|max:255',
        $validated['user_id'] = Auth::id();

        $jobSeeker = $this->jobSeekerService->createJobSeeker($validated);

        return redirect()->route('jobseeker.education.create')
            ->with('success', 'Profile created successfully! Now add your education details.');
    }

    /**
     * Show the form for editing the job seeker profile.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function editProfile()
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please create your profile first.');
        }

        return view('jobseeker.profile.edit', compact('jobSeeker'));
    }

    /**
     * Update the job seeker profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please create your profile first.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birth_date' => 'required|date|before:today',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'current_position' => 'nullable|string|max:255',
            'summary' => 'required|string',
            'current_position' => 'nullable|string|max:255',
        ]);
        return redirect()->route('jobseeker.profile.edit')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Show the job seeker's public profile.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please create your profile first.');
        }

        $educations = $this->educationService->getByJobSeekerId($jobSeeker->id);
        $experiences = $this->experienceService->getByJobSeekerId($jobSeeker->id);
        $skills = $this->skillService->getByJobSeekerId($jobSeeker->id);

        return view('jobseeker.profile.show', compact('jobSeeker', 'educations', 'experiences', 'skills'));
    }
}