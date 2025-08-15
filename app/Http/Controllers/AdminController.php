<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\JobService;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $userService;
    protected $jobService;
    protected $companyService;

    /**
     * AdminController constructor.
     *
     * @param UserService $userService
     * @param JobService $jobService
     * @param CompanyService $companyService
     */
    public function __construct(
        UserService $userService,
        JobService $jobService,
        CompanyService $companyService
    ) {
        $this->userService = $userService;
        $this->jobService = $jobService;
        $this->companyService = $companyService;
        
        // Ensure only admin users can access these routes
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Get counts for dashboard statistics
        $userCount = $this->userService->getUserCount();
        $companyCount = $this->companyService->getCompanyCount();
        $jobSeekerCount = $this->userService->getUserCountByRole('job_seeker');
        $activeJobCount = $this->jobService->getActiveJobCount();
        
        // Get recent companies and jobs for dashboard tables
        $recentCompanies = $this->companyService->getRecentCompanies(5);
        $recentJobs = $this->jobService->getRecentJobs(5);
        
        return view('admin.dashboard', compact(
            'userCount',
            'companyCount',
            'jobSeekerCount',
            'activeJobCount',
            'recentCompanies',
            'recentJobs'
        ));
    }
}