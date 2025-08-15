<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\JobSeekerService;
use App\Services\SkillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    protected $jobSeekerService;
    protected $skillService;

    /**
     * SkillController constructor.
     *
     * @param JobSeekerService $jobSeekerService
     * @param SkillService $skillService
     */
    public function __construct(
        JobSeekerService $jobSeekerService,
        SkillService $skillService
    ) {
        $this->jobSeekerService = $jobSeekerService;
        $this->skillService = $skillService;
        $this->middleware('auth');
        $this->middleware('role:job_seeker');
    }

    /**
     * Show the form for adding skills.
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

        $skills = $this->skillService->getByJobSeekerId($jobSeeker->id);
        $popularSkills = $this->skillService->getPopularSkills(20);

        return view('jobseeker.skill.create', compact('jobSeeker', 'skills', 'popularSkills'));
    }

    /**
     * Store skills for the job seeker.
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
            'skills' => 'required|array|min:1',
            'skills.*' => 'required|string|max:100',
            'proficiency' => 'required|array|min:1',
            'proficiency.*' => 'required|in:beginner,intermediate,advanced,expert',
        ]);

        // Prepare skills with proficiency
        $skillsWithProficiency = [];
        foreach ($validated['skills'] as $index => $skillName) {
            $skillsWithProficiency[] = [
                'name' => $skillName,
                'proficiency' => $validated['proficiency'][$index] ?? 'beginner',
            ];
        }

        // Create skills and attach to job seeker
        $this->jobSeekerService->updateJobSeekerSkills($jobSeeker->id, $skillsWithProficiency);

        return redirect()->route('jobseeker.dashboard')
            ->with('success', 'Skills added successfully! Your profile is now complete.');
    }

    /**
     * Show the form for editing skills.
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

        $skills = $this->skillService->getByJobSeekerId($jobSeeker->id);
        $popularSkills = $this->skillService->getPopularSkills(20);

        return view('jobseeker.skill.edit', compact('jobSeeker', 'skills', 'popularSkills'));
    }

    /**
     * Update skills for the job seeker.
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
            'skills' => 'required|array|min:1',
            'skills.*' => 'required|string|max:100',
            'proficiency' => 'required|array|min:1',
            'proficiency.*' => 'required|in:beginner,intermediate,advanced,expert',
        ]);

        // Prepare skills with proficiency
        $skillsWithProficiency = [];
        foreach ($validated['skills'] as $index => $skillName) {
            $skillsWithProficiency[] = [
                'name' => $skillName,
                'proficiency' => $validated['proficiency'][$index] ?? 'beginner',
            ];
        }

        // Update skills for job seeker
        $this->jobSeekerService->updateJobSeekerSkills($jobSeeker->id, $skillsWithProficiency);

        return redirect()->route('jobseeker.profile.show')
            ->with('success', 'Skills updated successfully!');
    }

    /**
     * Search for skills by name (AJAX).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $skills = $this->skillService->searchByName($query);

        return response()->json($skills);
    }
}