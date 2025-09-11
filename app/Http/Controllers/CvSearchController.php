<?php

namespace App\Http\Controllers;

use App\Models\CvSearch;
use App\Models\CvSearchResult;
use App\Models\JobSeeker;
use App\Models\Skill;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CvSearchController extends Controller
{
    /**
     * Show CV search interface.
     */
    public function index()
    {
        if (!Auth::user()->isCompany()) {
            abort(403, 'Only companies can search CVs.');
        }

        $skills = Skill::orderBy('name')->get();
        $categories = JobCategory::orderBy('name')->get();
        
        // Get recent searches
        $company = Auth::user()->company;
        $recentSearches = collect();
        
        if ($company) {
            $recentSearches = CvSearch::where('company_id', $company->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('cv-search.index', compact('skills', 'categories', 'recentSearches'));
    }

    /**
     * Perform CV search.
     */
    public function search(Request $request)
    {
        if (!Auth::user()->isCompany()) {
            abort(403, 'Only companies can search CVs.');
        }

        $request->validate([
            'search_query' => 'required|string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'experience_min' => 'nullable|integer|min:0',
            'experience_max' => 'nullable|integer|min:0|gte:experience_min',
            'education_level' => 'nullable|string',
            'location' => 'nullable|string',
            'category_id' => 'nullable|exists:job_categories,id',
        ]);

        $company = Auth::user()->company;
        
        // Check if company has premium access for CV search
        if (!$this->hasCvSearchAccess($company)) {
            return redirect()->route('premium-features.index')
                ->with('error', 'CV search is a premium feature. Please upgrade your subscription.');
        }

        // Build search query
        $query = JobSeeker::with(['user', 'skills', 'educations', 'experiences'])
            ->where('is_profile_complete', true);

        // Apply search filters
        if ($request->filled('search_query')) {
            $searchQuery = $request->search_query;
            $query->where(function ($q) use ($searchQuery) {
                $q->whereHas('user', function ($userQuery) use ($searchQuery) {
                    $userQuery->where('name', 'like', "%{$searchQuery}%");
                })
                ->orWhere('headline', 'like', "%{$searchQuery}%")
                ->orWhere('summary', 'like', "%{$searchQuery}%");
            });
        }

        // Filter by skills
        if ($request->filled('skills')) {
            $query->whereHas('skills', function ($skillQuery) use ($request) {
                $skillQuery->whereIn('skills.id', $request->skills);
            });
        }

        // Filter by experience
        if ($request->filled('experience_min') || $request->filled('experience_max')) {
            $query->whereHas('experiences', function ($expQuery) use ($request) {
                if ($request->filled('experience_min')) {
                    $expQuery->where('years_of_experience', '>=', $request->experience_min);
                }
                if ($request->filled('experience_max')) {
                    $expQuery->where('years_of_experience', '<=', $request->experience_max);
                }
            });
        }

        // Filter by education
        if ($request->filled('education_level')) {
            $query->whereHas('educations', function ($eduQuery) use ($request) {
                $eduQuery->where('level', $request->education_level);
            });
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Filter by job category
        if ($request->filled('category_id')) {
            $query->whereHas('experiences', function ($expQuery) use ($request) {
                $expQuery->where('job_category_id', $request->category_id);
            });
        }

        $results = $query->get();

        // Calculate match scores
        $scoredResults = $this->calculateMatchScores($results, $request);

        // Store search
        $cvSearch = CvSearch::create([
            'company_id' => $company ? $company->id : null,
            'search_query' => $request->search_query,
            'filters' => $request->only(['skills', 'experience_min', 'experience_max', 'education_level', 'location', 'category_id']),
            'results_count' => count($scoredResults),
        ]);

        // Store search results
        foreach ($scoredResults as $result) {
            CvSearchResult::create([
                'cv_search_id' => $cvSearch->id,
                'job_seeker_id' => $result['job_seeker']->id,
                'match_score' => $result['score'],
                'matched_criteria' => $result['matched_criteria'],
            ]);
        }

        return view('cv-search.results', compact('scoredResults', 'cvSearch'));
    }

    /**
     * Show search results.
     */
    public function results(CvSearch $cvSearch)
    {
        $company = Auth::user()->company;
        if (!Auth::user()->isCompany() || !$company || $cvSearch->company_id !== $company->id) {
            abort(403);
        }

        $results = CvSearchResult::where('cv_search_id', $cvSearch->id)
            ->with(['jobSeeker.user', 'jobSeeker.skills', 'jobSeeker.educations', 'jobSeeker.experiences'])
            ->orderByDesc('match_score')
            ->get();

        return view('cv-search.results', compact('results', 'cvSearch'));
    }

    /**
     * Show job seeker profile from search results.
     */
    public function showProfile(CvSearchResult $result)
    {
        $company = Auth::user()->company;
        if (!Auth::user()->isCompany() || !$company || $result->cvSearch->company_id !== $company->id) {
            abort(403);
        }

        $jobSeeker = $result->jobSeeker;
        
        return view('cv-search.profile', compact('jobSeeker', 'result'));
    }

    /**
     * Get search suggestions.
     */
    public function suggestions(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = Skill::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->take(10)
            ->pluck('name');

        return response()->json($suggestions);
    }

    /**
     * Check if company has CV search access.
     */
    private function hasCvSearchAccess($company)
    {
        // Check if company has active premium subscription with CV search feature
        return $company->subscriptions()
            ->whereHas('premiumFeature', function ($query) {
                $query->whereJsonContains('features', 'cv_search');
            })
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->exists();
    }

    /**
     * Calculate match scores for search results.
     */
    private function calculateMatchScores($jobSeekers, $request)
    {
        $scoredResults = [];

        foreach ($jobSeekers as $jobSeeker) {
            $score = 0;
            $matchedCriteria = [];

            // Base score for profile completeness
            $score += 20;
            $matchedCriteria[] = 'Profile Complete';

            // Skills match
            if ($request->filled('skills')) {
                $requestedSkills = $request->skills;
                $jobSeekerSkills = $jobSeeker->skills->pluck('id')->toArray();
                $matchingSkills = array_intersect($requestedSkills, $jobSeekerSkills);
                
                if (count($matchingSkills) > 0) {
                    $skillScore = (count($matchingSkills) / count($requestedSkills)) * 30;
                    $score += $skillScore;
                    $matchedCriteria[] = 'Skills: ' . count($matchingSkills) . '/' . count($requestedSkills) . ' matched';
                }
            }

            // Experience match
            if ($request->filled('experience_min') || $request->filled('experience_max')) {
                $totalExperience = $jobSeeker->experiences->sum('years_of_experience');
                
                if ($request->filled('experience_min') && $totalExperience >= $request->experience_min) {
                    $score += 20;
                    $matchedCriteria[] = 'Experience: ' . $totalExperience . ' years';
                }
                
                if ($request->filled('experience_max') && $totalExperience <= $request->experience_max) {
                    $score += 10;
                }
            }

            // Education match
            if ($request->filled('education_level')) {
                $hasEducation = $jobSeeker->educations->where('level', $request->education_level)->count() > 0;
                if ($hasEducation) {
                    $score += 15;
                    $matchedCriteria[] = 'Education: ' . $request->education_level;
                }
            }

            // Location match
            if ($request->filled('location')) {
                if (stripos($jobSeeker->location, $request->location) !== false) {
                    $score += 10;
                    $matchedCriteria[] = 'Location: ' . $jobSeeker->location;
                }
            }

            // Category match
            if ($request->filled('category_id')) {
                $hasCategoryExperience = $jobSeeker->experiences->where('job_category_id', $request->category_id)->count() > 0;
                if ($hasCategoryExperience) {
                    $score += 15;
                    $matchedCriteria[] = 'Category Experience: Yes';
                }
            }

            // Additional score for profile quality
            if ($jobSeeker->resume) {
                $score += 5;
                $matchedCriteria[] = 'Resume Available';
            }

            $scoredResults[] = [
                'job_seeker' => $jobSeeker,
                'score' => min(100, $score),
                'matched_criteria' => $matchedCriteria,
            ];
        }

        // Sort by score descending
        usort($scoredResults, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $scoredResults;
    }
}
