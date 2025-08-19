<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompaniesController extends Controller
{
    /**
     * Display a listing of companies for public view.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Company::query()->with(['jobs' => function($q) {
            $q->where('is_active', true);
        }]);

        // Search by company name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by industry
        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }

        // Filter by location/city
        if ($request->filled('location')) {
            $query->where('city', 'like', '%' . $request->location . '%');
        }

        // Filter by company size
        if ($request->filled('company_size')) {
            $query->where('company_size', $request->company_size);
        }

        $companies = $query->paginate(20);

        // Get unique industries for filter
        $industries = Company::distinct('industry')
            ->whereNotNull('industry')
            ->pluck('industry')
            ->sort();

        // Get unique cities for filter
        $cities = Company::distinct('city')
            ->whereNotNull('city')
            ->pluck('city')
            ->sort();

        // Company size options
        $companySizes = [
            '1-10' => '1-10 employees',
            '11-50' => '11-50 employees', 
            '51-200' => '51-200 employees',
            '201-500' => '201-500 employees',
            '501-1000' => '501-1000 employees',
            '1000+' => '1000+ employees'
        ];

        return view('companies.index', compact(
            'companies',
            'industries', 
            'cities',
            'companySizes'
        ));
    }

    /**
     * Display the specified company.
     *
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        $company->load(['jobs' => function($q) {
            $q->where('is_active', true)->latest();
        }]);

        $activeJobs = $company->jobs;
        $totalJobs = $company->jobs()->count();

        // Get related companies (same industry, excluding current company)
        $relatedCompanies = Company::where('industry', $company->industry)
            ->where('id', '!=', $company->id)
            ->withCount(['jobs' => function($q) { 
                $q->where('is_active', true); 
            }])
            ->limit(3)
            ->get();

        return view('companies.show', compact('company', 'activeJobs', 'totalJobs', 'relatedCompanies'));
    }
}