<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\JobSeekerService;
use App\Services\ExperienceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    protected $jobSeekerService;
    protected $experienceService;

    /**
     * ExperienceController constructor.
     *
     * @param JobSeekerService $jobSeekerService
     * @param ExperienceService $experienceService
     */
    public function __construct(
        JobSeekerService $jobSeekerService,
        ExperienceService $experienceService
    ) {
        $this->jobSeekerService = $jobSeekerService;
        $this->experienceService = $experienceService;
        $this->middleware('auth');
        $this->middleware('role:job_seeker');
    }

    /**
     * Show the form for creating experience entries.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $experiences = $this->experienceService->getByJobSeekerId($jobSeeker->id);

        return view('jobseeker.experience.create', compact('jobSeeker', 'experiences'));
    }

    /**
     * Store experience entries for the job seeker.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $validated = $request->validate([
            'experiences' => 'required|array',
            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.position' => 'required|string|max:255',
            'experiences.*.location' => 'required|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',
            'experiences.*.is_current' => 'nullable|boolean',
            'experiences.*.description' => 'nullable|string',
        ]);

        // Process is_current field
        foreach ($validated['experiences'] as $key => $experience) {
            if (isset($experience['is_current']) && $experience['is_current']) {
                $validated['experiences'][$key]['end_date'] = null;
            } elseif (!isset($experience['end_date']) || empty($experience['end_date'])) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['experiences.' . $key . '.end_date' => 'End date is required if not currently working.']);
            }
        }

        $this->experienceService->createMultiple($jobSeeker->id, $validated['experiences']);

        return redirect()->route('jobseeker.skill.create')
            ->with('success', 'Work experience added successfully! Now add your skills.');
    }

    /**
     * Show the form for editing experience entries.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit()
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $experiences = $this->experienceService->getByJobSeekerId($jobSeeker->id);

        return view('jobseeker.experience.edit', compact('jobSeeker', 'experiences'));
    }

    /**
     * Update experience entries for the job seeker.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Please complete your profile first.');
        }

        $validated = $request->validate([
            'experiences' => 'required|array',
            'experiences.*.id' => 'nullable|exists:experiences,id',
            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.position' => 'required|string|max:255',
            'experiences.*.location' => 'required|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',
            'experiences.*.is_current' => 'nullable|boolean',
            'experiences.*.description' => 'nullable|string',
        ]);

        // Process is_current field
        foreach ($validated['experiences'] as $key => $experience) {
            if (isset($experience['is_current']) && $experience['is_current']) {
                $validated['experiences'][$key]['end_date'] = null;
            } elseif (!isset($experience['end_date']) || empty($experience['end_date'])) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['experiences.' . $key . '.end_date' => 'End date is required if not currently working.']);
            }
        }

        $this->experienceService->updateMultiple($jobSeeker->id, $validated['experiences']);

        return redirect()->route('jobseeker.profile.show')
            ->with('success', 'Work experience updated successfully!');
    }
}