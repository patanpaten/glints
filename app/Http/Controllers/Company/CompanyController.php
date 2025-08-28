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

        // Cek apakah perusahaan sudah memiliki nomor WhatsApp sebelumnya
        $hadWhatsappBefore = !empty($company->phone);

        // Handle logo upload - pass the file object to service
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo');
        }

        $this->companyService->updateCompany($company->id, $validated);

        // Logika redirect berdasarkan kondisi nomor WhatsApp
        // Jika sudah punya nomor WA sebelumnya (update dari dashboard) -> redirect ke dashboard
        if ($hadWhatsappBefore) {
            return redirect()->route('company.dashboard')
                ->with('success', 'Company profile updated successfully!');
        } else {
            // Jika belum punya nomor WA sebelumnya (pertama kali daftar) -> redirect ke dashboard langsung
            // karena nomor WA sudah diisi di form edit
            return redirect()->route('company.dashboard')
                ->with('success', 'Company profile updated successfully!');
        }
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

        return redirect()->route('company.dashboard')
            ->with('success', 'Nomor WhatsApp berhasil disimpan!');
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
}
