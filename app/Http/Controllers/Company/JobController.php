<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\JobService;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $jobService;
    protected $companyService;

    public function __construct(JobService $jobService, CompanyService $companyService)
    {
        $this->middleware(['auth', 'role:company']);
        $this->jobService = $jobService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
    $company = $this->companyService->getByUserId(Auth::id());

    if (!$company) {
        return redirect()->route('company.profile.create')
            ->with('error', 'Lengkapi profil perusahaan dulu.');
    }

    $status = $request->get('status', 'all'); // default all
    $jobs   = $this->jobService->getByCompanyAndStatus($company->id, $status);

    // Statistik job
    $stats = [
        'all'      => $this->jobService->countByCompanyAndStatus($company->id, null),
        'active'   => $this->jobService->countByCompanyAndStatus($company->id, 'active'),
        'inactive' => $this->jobService->countByCompanyAndStatus($company->id, 'inactive'),
        'review'   => $this->jobService->countByCompanyAndStatus($company->id, 'review'),
        'draft'    => $this->jobService->countByCompanyAndStatus($company->id, 'draft'),
    ];

    return view('company.jobs.index', compact('company', 'jobs', 'status', 'stats'));
    }

}
