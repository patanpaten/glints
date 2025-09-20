<?php

namespace App\Http\Controllers;

use App\Models\PremiumFeature;
use App\Models\CompanySubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumFeatureController extends Controller
{
    /**
     * Display available premium features.
     */
    public function index()
    {
        $features = PremiumFeature::where('is_active', true)->get();
        
        $userSubscriptions = collect();
        if (Auth::user()->isCompany() && Auth::user()->company) {
            $userSubscriptions = CompanySubscription::where('company_id', Auth::user()->company->id)
                ->with('premiumFeature')
                ->get();
        }

        return view('premium-features.index', compact('features', 'userSubscriptions'));
    }

    /**
     * Show a specific premium feature.
     */
    public function show(PremiumFeature $feature)
    {
        $hasActiveSubscription = false;
        if (Auth::user()->isCompany() && Auth::user()->company) {
            $hasActiveSubscription = $feature->hasActiveSubscription(Auth::user()->company->id);
        }

        return view('premium-features.show', compact('feature', 'hasActiveSubscription'));
    }

    /**
     * Subscribe to a premium feature.
     */
    public function subscribe(Request $request, PremiumFeature $feature)
    {
        if (!Auth::user()->isCompany() || !Auth::user()->company) {
            abort(403, 'Only companies can subscribe to premium features.');
        }

        // Check if already has active subscription
        if ($feature->hasActiveSubscription(Auth::user()->company->id)) {
            return redirect()->back()->with('error', 'You already have an active subscription to this feature.');
        }

        // Create subscription
        CompanySubscription::create([
            'company_id' => Auth::user()->company->id,
            'premium_feature_id' => $feature->id,
            'start_date' => now(),
            'end_date' => now()->addDays($feature->duration_days),
            'status' => 'active',
            'amount_paid' => $feature->price,
        ]);

        return redirect()->back()->with('success', 'Successfully subscribed to ' . $feature->name . '!');
    }

    /**
     * Cancel a subscription.
     */
    public function cancel(CompanySubscription $subscription)
    {
        if (!Auth::user()->isCompany() || !Auth::user()->company || $subscription->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        $subscription->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Subscription cancelled successfully.');
    }

    /**
     * Show company's subscription history.
     */
    public function history()
    {
        if (!Auth::user()->isCompany() || !Auth::user()->company) {
            abort(403);
        }

        $subscriptions = CompanySubscription::where('company_id', Auth::user()->company->id)
            ->with('premiumFeature')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('premium-features.history', compact('subscriptions'));
    }

    /**
     * Show admin premium features management.
     */
    public function adminIndex()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $features = PremiumFeature::withCount('subscriptions')->get();
        $totalRevenue = CompanySubscription::sum('amount_paid');
        $activeSubscriptions = CompanySubscription::where('status', 'active')->count();

        return view('admin.premium-features.index', compact('features', 'totalRevenue', 'activeSubscriptions'));
    }

    /**
     * Create a new premium feature (admin only).
     */
    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('admin.premium-features.create');
    }

    /**
     * Store a new premium feature (admin only).
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'features' => 'required|array',
        ]);

        PremiumFeature::create($request->all());

        return redirect()->route('admin.premium-features.index')->with('success', 'Premium feature created successfully.');
    }

    public function pricing()
    {
        // untuk halaman paket/upgrade plan
        return view('premium-features.paket-premium');
    }
}
