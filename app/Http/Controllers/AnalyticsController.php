<?php

namespace App\Http\Controllers;

use App\Models\JobAnalytics;
use App\Models\CompanyAnalytics;
use App\Models\Job;
use App\Models\Company;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Show company analytics dashboard.
     */
    public function companyDashboard()
    {
        if (!Auth::user()->isCompany()) {
            abort(403);
        }

        $company = Auth::user()->company;
        
        // Get analytics for the last 30 days
        $startDate = now()->subDays(30);
        $endDate = now();

        $jobAnalytics = JobAnalytics::whereIn('job_id', $company->jobs->pluck('id'))
            ->dateRange($startDate, $endDate)
            ->get();

        $totalViews = $jobAnalytics->sum('views');
        $totalApplications = $jobAnalytics->sum('applications');
        $totalSaves = $jobAnalytics->sum('saves');
        $totalShares = $jobAnalytics->sum('shares');

        // Get daily data for charts
        $dailyData = $jobAnalytics->groupBy('date')
            ->map(function ($items) {
                return [
                    'views' => $items->sum('views'),
                    'applications' => $items->sum('applications'),
                    'saves' => $items->sum('saves'),
                    'shares' => $items->sum('shares'),
                ];
            });

        // Get top performing jobs
        $topJobs = $company->jobs()
            ->withCount('applications')
            ->orderByDesc('applications_count')
            ->take(5)
            ->get();

        // Get application trends
        $applicationTrends = Application::whereIn('job_id', $company->jobs->pluck('id'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('analytics.company-dashboard', compact(
            'totalViews',
            'totalApplications',
            'totalSaves',
            'totalShares',
            'dailyData',
            'topJobs',
            'applicationTrends'
        ));
    }

    /**
     * Show job-specific analytics.
     */
    public function jobAnalytics(Job $job)
    {
        if (!Auth::user()->isCompany() || $job->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        // Get analytics for the last 30 days
        $startDate = now()->subDays(30);
        $endDate = now();

        $analytics = JobAnalytics::where('job_id', $job->id)
            ->dateRange($startDate, $endDate)
            ->orderBy('date')
            ->get();

        // Calculate conversion rates
        $totalViews = $analytics->sum('views');
        $totalApplications = $analytics->sum('applications');
        $conversionRate = $totalViews > 0 ? ($totalApplications / $totalViews) * 100 : 0;

        // Get daily trends
        $dailyTrends = $analytics->map(function ($item) {
            return [
                'date' => $item->date->format('M d'),
                'views' => $item->views,
                'applications' => $item->applications,
                'saves' => $item->saves,
                'shares' => $item->shares,
            ];
        });

        return view('analytics.job-analytics', compact(
            'job',
            'analytics',
            'totalViews',
            'totalApplications',
            'conversionRate',
            'dailyTrends'
        ));
    }

    /**
     * Show admin analytics dashboard.
     */
    public function adminDashboard()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        // Get overall statistics
        $totalJobs = Job::count();
        $activeJobs = Job::where('is_active', true)->count();
        $totalCompanies = Company::count();
        $totalApplications = Application::count();

        // Get monthly trends
        $monthlyStats = collect();
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyStats->push([
                'month' => $date->format('M Y'),
                'jobs' => Job::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'applications' => Application::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'companies' => Company::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ]);
        }

        // Get top performing companies
        $topCompanies = Company::withCount(['jobs', 'jobs as active_jobs' => function ($query) {
            $query->where('is_active', true);
        }])
        ->orderByDesc('jobs_count')
        ->take(10)
        ->get();

        // Get recent activity
        $recentJobs = Job::with('company')->latest()->take(5)->get();
        $recentApplications = Application::with(['job.company', 'jobSeeker.user'])->latest()->take(5)->get();

        return view('analytics.admin-dashboard', compact(
            'totalJobs',
            'activeJobs',
            'totalCompanies',
            'totalApplications',
            'monthlyStats',
            'topCompanies',
            'recentJobs',
            'recentApplications'
        ));
    }

    /**
     * Track job view (called via AJAX).
     */
    public function trackJobView(Request $request, Job $job)
    {
        $today = now()->toDateString();
        
        $analytics = JobAnalytics::firstOrCreate(
            ['job_id' => $job->id, 'date' => $today],
            [
                'views' => 0,
                'unique_views' => 0,
                'applications' => 0,
                'saves' => 0,
                'shares' => 0,
            ]
        );

        $analytics->increment('views');
        
        // Track unique views (simplified - in production you'd use session/IP tracking)
        if (!$request->session()->has("job_view_{$job->id}")) {
            $analytics->increment('unique_views');
            $request->session()->put("job_view_{$job->id}", true);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Export analytics data.
     */
    public function export(Request $request)
    {
        if (!Auth::user()->isCompany()) {
            abort(403);
        }

        $format = $request->get('format', 'csv');
        $startDate = $request->get('start_date', now()->subDays(30));
        $endDate = $request->get('end_date', now());

        $analytics = JobAnalytics::whereIn('job_id', Auth::user()->company->jobs->pluck('id'))
            ->dateRange($startDate, $endDate)
            ->with('job')
            ->get();

        if ($format === 'csv') {
            return $this->exportToCsv($analytics);
        }

        return response()->json($analytics);
    }

    /**
     * Export analytics to CSV.
     */
    private function exportToCsv($analytics)
    {
        $filename = 'analytics_' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($analytics) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['Date', 'Job Title', 'Views', 'Unique Views', 'Applications', 'Saves', 'Shares']);
            
            // Add data
            foreach ($analytics as $item) {
                fputcsv($file, [
                    $item->date->format('Y-m-d'),
                    $item->job->title,
                    $item->views,
                    $item->unique_views,
                    $item->applications,
                    $item->saves,
                    $item->shares,
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
