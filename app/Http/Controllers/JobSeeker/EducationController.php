<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\JobSeekerService;
use App\Services\EducationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    protected $jobSeekerService;
    protected $educationService;

    /**
     * EducationController constructor.
     *
     * @param JobSeekerService $jobSeekerService
     * @param EducationService $educationService
     */
    public function __construct(
        JobSeekerService $jobSeekerService,
        EducationService $educationService
    ) {
        $this->jobSeekerService = $jobSeekerService;
        $this->educationService = $educationService;
        $this->middleware('auth');
        $this->middleware('role:job-seeker');
    }

    /**
     * Show the form for creating education entries.
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

        $educations = $this->educationService->getByJobSeekerId($jobSeeker->id);

        return view('jobseeker.education.create', compact('jobSeeker', 'educations'));
    }

    /**
     * Store education entries for the job seeker.
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
            'educations' => 'required|array|min:1',
            'educations.*.institution' => 'required|string|max:255',
            'educations.*.degree' => 'required|string|max:255',
            'educations.*.field_of_study' => 'required|string|max:255',
            'educations.*.start_date' => 'required|date',
            'educations.*.end_date' => 'nullable|date|after_or_equal:educations.*.start_date',
            'educations.*.is_current' => 'nullable|boolean',
        ]);

        // Process is_current field
        foreach ($validated['educations'] as $key => $education) {
            if (isset($education['is_current']) && $education['is_current']) {
                $validated['educations'][$key]['end_date'] = null;
            } elseif (!isset($education['end_date']) || empty($education['end_date'])) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['educations.' . $key . '.end_date' => 'End date is required if not currently studying.']);
            }
        }

        $this->educationService->createMultiple($jobSeeker->id, $validated['educations']);

        return redirect()->route('jobseeker.experience.create')
            ->with('success', 'Education details added successfully! Now add your work experience.');
    }

    /**
     * Show the form for editing education entries.
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

        $educations = $this->educationService->getByJobSeekerId($jobSeeker->id);

        return view('jobseeker.education.edit', compact('jobSeeker', 'educations'));
    }

    /**
     * Update education entries for the job seeker.
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
            'educations' => 'required|array|min:1',
            'educations.*.id' => 'nullable|exists:educations,id',
            'educations.*.institution' => 'required|string|max:255',
            'educations.*.degree' => 'required|string|max:255',
            'educations.*.field_of_study' => 'required|string|max:255',
            'educations.*.start_date' => 'required|date',
            'educations.*.end_date' => 'nullable|date|after_or_equal:educations.*.start_date',
            'educations.*.is_current' => 'nullable|boolean',
        ]);

        // Process is_current field
        foreach ($validated['educations'] as $key => $education) {
            if (isset($education['is_current']) && $education['is_current']) {
                $validated['educations'][$key]['end_date'] = null;
            } elseif (!isset($education['end_date']) || empty($education['end_date'])) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['educations.' . $key . '.end_date' => 'End date is required if not currently studying.']);
            }
        }

        $this->educationService->updateMultiple($jobSeeker->id, $validated['educations']);

        return redirect()->route('jobseeker.profile.show')
            ->with('success', 'Education details updated successfully!');
    }
}