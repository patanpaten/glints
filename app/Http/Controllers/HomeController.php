<?php

namespace App\Http\Controllers;

use App\Services\JobService;
use App\Services\CompanyService;
use App\Services\JobCategoryService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $jobService;
    protected $companyService;
    protected $jobCategoryService;

    /**
     * HomeController constructor.
     *
     * @param JobService $jobService
     * @param CompanyService $companyService
     * @param JobCategoryService $jobCategoryService
     */
    public function __construct(
        JobService $jobService,
        CompanyService $companyService,
        JobCategoryService $jobCategoryService
    ) {
        $this->jobService = $jobService;
        $this->companyService = $companyService;
        $this->jobCategoryService = $jobCategoryService;
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $featuredJobs = $this->jobService->getLatestJobs(8);
        $latestJobs = $this->jobService->getLatestJobs(10);
        $featuredCompanies = $this->companyService->getFeaturedCompanies(6);
        $popularCategories = $this->jobCategoryService->getPopularCategories(8);

        return view('pages.home', compact(
            'featuredJobs',
            'latestJobs',
            'featuredCompanies',
            'popularCategories'
        ));
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Process contact form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Here you would typically send an email or store the contact message
        // For now, we'll just redirect with a success message

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}