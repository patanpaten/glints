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

        // Pastikan company login dengan guard company
        $this->middleware('auth:company');
        $this->middleware('role:company');
    }

    /**
     * Dashboard perusahaan
     */
    public function dashboard()
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        // Check if profile is complete
        if (empty($company->name) || empty($company->industry) || empty($company->city)) {
            return redirect()->route('company.profile.edit')
                ->with('info', 'Please complete your company profile first.');
        }

        $recentJobs = $this->jobService->getByCompanyId($company->id)->take(5);
        $totalJobs = $this->jobService->countByCompany($company->id);
        $activeJobs = $this->jobService->countActiveByCompany($company->id);
        $totalApplications = $this->applicationService->countByCompany($company->id);

        return view('company.dashboard', compact(
            'company',
            'recentJobs',
            'totalJobs',
            'activeJobs',
            'totalApplications'
        ));
    }



    /**
     * Simpan profile perusahaan baru
     */
    public function store(Request $request)
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'brandName'       => 'nullable|string|max:255',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'employees_count' => 'required|string|max:50',
            'industry'        => 'required|string|max:100',
            'province'        => 'required|string|max:100',
            'city'            => 'required|string|max:100',
            'address'         => 'required|string',
        ]);

        $companyData = [
            'name'         => $validated['name'],
            'industry'     => $validated['industry'],
            'province'     => $validated['province'],
            'city'         => $validated['city'],
            'address'      => $validated['address'],
            'company_size' => $validated['employees_count'],
        ];

        // Handle logo upload - pass the file object to service
        if ($request->hasFile('logo')) {
            $companyData['logo'] = $request->file('logo');
        }

        if (!empty($validated['brandName'])) {
            $companyData['description'] = $validated['brandName'];
        }

        $this->companyService->updateCompany($company->id, $companyData);

        return redirect()->route('company.whatsapp.form')
            ->with('success', 'Company profile updated successfully!');
    }

    /**
     * Edit profile perusahaan
     */
    public function edit()
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        return view('company.profile.edit', compact('company'));
    }

    /**
     * Update profile perusahaan
     */
    public function update(Request $request)
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'logo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brand'        => 'required|string|max:255',
            'address'      => 'required|string',
            'city'         => 'required|string|max:100',
            'province'     => 'required|string|max:100',
            'industry'     => 'required|string|max:100',
            'company_size' => 'required|string|max:50',
        ]);

        // Prepare data for update
        $updateData = [
            'name'         => $validated['name'],
            'description'  => $validated['brand'], // brand name disimpan di field description
            'address'      => $validated['address'],
            'city'         => $validated['city'],
            'province'     => $validated['province'],
            'industry'     => $validated['industry'],
            'company_size' => $validated['company_size'],
        ];

        // Handle logo upload - pass the file object to service
        if ($request->hasFile('logo')) {
            $updateData['logo'] = $request->file('logo');
        }

        $this->companyService->updateCompany($company->id, $updateData);

        // Redirect ke halaman WhatsApp setelah berhasil simpan
        return redirect()->route('company.whatsapp.form')
            ->with('success', 'Company profile updated successfully!');
    }

    /**
     * Tampilkan form nomor WhatsApp
     */
    public function whatsappForm()
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        // Jika sudah ada nomor WhatsApp, redirect ke dashboard
        if ($company->phone) {
            return redirect()->route('company.dashboard')
                ->with('info', 'WhatsApp sudah terhubung dengan nomor: ' . $company->phone);
        }

        return view('company.terhubung_wa', compact('company'));
    }

    /**
     * Simpan nomor WhatsApp perusahaan
     */
    public function saveWhatsapp(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        $this->companyService->updateCompany($company->id, [
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('company.jobs.create')
            ->with('success', 'Nomor WhatsApp berhasil disimpan! Silakan buat lowongan kerja pertama Anda.');
    }

    /**
     * Upload logo perusahaan secara dinamis
     */
    public function uploadLogo(Request $request)
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Update logo menggunakan service
            $this->companyService->updateCompany($company->id, [
                'logo' => $request->file('logo')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Logo berhasil diupload!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload logo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Edit profil perusahaan (edit2) - akses dari dashboard
     */
    public function edit2()
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        return view('company.profile.edit2', compact('company'));
    }

    /**
     * Update profil perusahaan (update2) - redirect ke dashboard
     */
    public function update2(Request $request)
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.register')
                ->with('error', 'Please register first.');
        }

        $validated = $request->validate([
            'short_description' => 'required|string|max:500',
            'office_address' => 'required|string|max:1000',
            'industry' => 'required|string|max:100',
            'website' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'description' => 'required|string|max:2000',
            'culture' => 'nullable|string|max:2000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $updateData = [
            'short_description' => $validated['short_description'],
            'office_address' => $validated['office_address'],
            'industry' => $validated['industry'],
            'website' => $validated['website'],
            'instagram' => $validated['instagram'],
            'facebook' => $validated['facebook'],
            'linkedin' => $validated['linkedin'],
            'twitter' => $validated['twitter'],
            'description' => $validated['description'],
            'culture' => $validated['culture'],
        ];

        // Handle file uploads
        if ($request->hasFile('logo')) {
            $updateData['logo'] = $request->file('logo');
        }

        if ($request->hasFile('banner')) {
            $updateData['banner'] = $request->file('banner');
        }

        if ($request->hasFile('photo')) {
            $updateData['photo'] = $request->file('photo');
        }

        $this->companyService->updateCompany($company->id, $updateData);

        return redirect()->route('company.dashboard')
            ->with('success', 'Profil perusahaan berhasil diperbarui!');
    }

    public function timPerusahaan()
    {
        $company = Auth::guard('company')->user();
        $applications = collect(); // Placeholder
        return view('company.profile.tim_perusahaan', compact('company', 'applications'));
    }
}
