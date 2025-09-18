<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\JobSeekerService;
use App\Services\SkillService;
use App\Services\EducationService;
use App\Services\ExperienceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $jobSeekerService;
    protected $skillService;
    protected $educationService;
    protected $experienceService;

    public function __construct(
        JobSeekerService $jobSeekerService,
        SkillService $skillService,
        EducationService $educationService,
        ExperienceService $experienceService
    ) {
        $this->jobSeekerService = $jobSeekerService;
        $this->skillService = $skillService;
        $this->educationService = $educationService;
        $this->experienceService = $experienceService;
    }

    /**
     * Display the job seeker profile.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Anda belum memiliki profil. Silakan buat profil terlebih dahulu.');
        }

        $educations = $this->educationService->getByJobSeekerId($jobSeeker->id);
        $experiences = $this->experienceService->getByJobSeekerId($jobSeeker->id);
        $skills = $this->skillService->getByJobSeekerId($jobSeeker->id);

        return view('jobseeker.profile.index', compact('jobSeeker', 'educations', 'experiences', 'skills'));
    }

    /**
     * Show the form for creating a new profile.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        // Check if user already has a job seeker profile
        $existingProfile = $this->jobSeekerService->getByUserId(Auth::id());
        
        if ($existingProfile) {
            return redirect()->route('jobseeker.profile.edit')
                ->with('info', 'Anda sudah memiliki profil.');
        }

        return view('jobseeker.profile.create');
    }

    /**
     * Store a newly created profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birth_date' => 'required|date|before:today',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'summary' => 'required|string',
            'current_position' => 'nullable|string|max:255',
            'expected_salary' => 'nullable|string|max:50',
        ]);

        $validated['user_id'] = Auth::id();

        $jobSeeker = $this->jobSeekerService->createJobSeeker($validated);

        return redirect()->route('jobseeker.profile.index')
            ->with('success', 'Profil berhasil dibuat!');
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit()
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Anda belum memiliki profil. Silakan buat profil terlebih dahulu.');
        }

        return view('jobseeker.profile.edit', compact('jobSeeker'));
    }

    /**
     * Update the specified profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker) {
            return redirect()->route('jobseeker.profile.create')
                ->with('error', 'Anda belum memiliki profil. Silakan buat profil terlebih dahulu.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birth_date' => 'required|date|before:today',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'summary' => 'required|string',
            'current_position' => 'nullable|string|max:255',
            'expected_salary' => 'nullable|string|max:50',
        ]);

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($jobSeeker->profile_picture) {
                Storage::delete('public/' . $jobSeeker->profile_picture);
            }
            
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $this->jobSeekerService->updateJobSeeker($jobSeeker->id, $validated);

        return redirect()->route('jobseeker.profile.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Remove the specified profile picture.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProfilePicture()
    {
        $jobSeeker = $this->jobSeekerService->getByUserId(Auth::id());
        
        if (!$jobSeeker || !$jobSeeker->profile_picture) {
            return redirect()->route('jobseeker.profile.edit')
                ->with('error', 'Tidak ada foto profil untuk dihapus.');
        }

        // Delete profile picture
        Storage::delete('public/' . $jobSeeker->profile_picture);
        
        // Update jobseeker record
        $this->jobSeekerService->updateJobSeeker($jobSeeker->id, ['profile_picture' => null]);

        return redirect()->route('jobseeker.profile.edit')
            ->with('success', 'Foto profil berhasil dihapus.');
    }
}