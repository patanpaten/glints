<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use App\Services\JobService;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    protected $companyService;
    protected $jobService;
    protected $applicationService;

    public function __construct(
        CompanyService $companyService,
        JobService $jobService,
        ApplicationService $applicationService
    ) {
        $this->companyService = $companyService;
        $this->jobService = $jobService;
        $this->applicationService = $applicationService;
        $this->middleware('auth');
        $this->middleware('role:company');
    }

    /**
     * Dashboard perusahaan
     */
    public function dashboard()
    {
        $company = $this->companyService->getByUserId(Auth::id());

        if (!$company) {
            // Kalau belum ada company profile, kasih data kosong ke view
            return view('company.dashboard', [
                'company' => null,
                'recentJobs' => collect([]),
                'totalJobs' => 0,
                'activeJobs' => 0,
                'totalApplications' => 0,
                'showProfileReminder' => true
            ]);
        }

        // Kalau sudah ada profile, tampilkan data normal
        $recentJobs = $this->jobService->getByCompanyId($company->id)->take(5);
        $totalJobs = $this->jobService->countByCompany($company->id);
        $activeJobs = $this->jobService->countActiveByCompany($company->id);
        $totalApplications = $this->applicationService->countByCompany($company->id);
        $totalApplications = $this->applicationService->repository->model
            ->whereHas('job', function($query) use ($company) {
                $query->where('company_id', $company->id);
            })
            ->count();
        return view('company.dashboard', compact(
            'company',
            'recentJobs',
            'totalJobs',
            'activeJobs',
            'totalApplications'
        ));
    }


    /**
     * Tampilkan form create profile
     */
    public function create()
    {
        $existingCompany = $this->companyService->getByUserId(Auth::id());

        if ($existingCompany) {
            return redirect()->route('company.profile.edit')
                ->with('info', 'You already have a company profile.');
        }

        return view('company.profile.create');
    }

    /**
     * Simpan profile perusahaan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'logo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'  => 'required|string',
            'address'      => 'required|string',
            'city'         => 'required|string|max:100',
            'province'     => 'required|string|max:100',
            'postal_code'  => 'required|string|max:20',
            'phone'        => 'required|string|max:20',
            'website'      => 'nullable|url|max:255',
            'industry'     => 'required|string|max:100',
            'company_size' => 'required|string|max:50',
        ]);

        $validated['user_id'] = Auth::id();

        $this->companyService->createCompany($validated);

        return redirect()->route('company.dashboard')
            ->with('success', 'Company profile created successfully!');
    }

    /**
     * Edit profile perusahaan
     */
    public function edit()
    {
        $company = $this->companyService->getByUserId(Auth::id());

        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please create your company profile first.');
        }

        return view('company.profile.edit', compact('company'));
    }

    /**
     * Update profile perusahaan
     */
    public function update(Request $request)
    {
        $company = $this->companyService->getByUserId(Auth::id());

        if (!$company) {
            return redirect()->route('company.profile.create')
                ->with('error', 'Please create your company profile first.');
        }

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'logo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'  => 'required|string',
            'address'      => 'required|string',
            'city'         => 'required|string|max:100',
            'province'     => 'required|string|max:100',
            'postal_code'  => 'required|string|max:20',
            'phone'        => 'required|string|max:20',
            'website'      => 'nullable|url|max:255',
            'industry'     => 'required|string|max:100',
            'company_size' => 'required|string|max:50',
        ]);

        $this->companyService->updateCompany($company->id, $validated);

        return redirect()->route('company.profile.edit')
            ->with('success', 'Company profile updated successfully!');
    }
}
