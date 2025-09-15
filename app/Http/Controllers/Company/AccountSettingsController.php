<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountSettingsController extends Controller
{
    /**
     * Display the account settings page.
     */
    public function index()
    {
        $company = Auth::guard('company')->user();
        $user = $company->user; // Ambil data user yang terkait
        
        return view('company.account-settings.index', compact('company', 'user'));
    }

    /**
     * Update company account information.
     */
    public function updateAccount(Request $request)
    {
        $company = Auth::guard('company')->user();
        
        // Handle different form types
        $formType = $request->input('form_type', 'basic');
        
        if ($formType === 'email') {
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $company->user->id,
            ]);
            
            $company->user->update([
                'email' => $request->email,
            ]);
            
            return redirect()->route('company.account-settings.index')
                ->with('success', 'Email berhasil diperbarui.');
        }
        
        if ($formType === 'whatsapp') {
            $request->validate([
                'whatsapp' => 'nullable|string|max:20',
            ]);
            
            $company->update([
                'phone' => $request->whatsapp,
            ]);
            
            return redirect()->route('company.account-settings.index')
                ->with('success', 'Nomor WhatsApp berhasil diperbarui.');
        }
        
        // Default basic info update
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'preferred_language' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company-logos', 'public');
        }

        // Update user info (all fields in users table)
        $updateData = [
            'name' => $request->name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'city' => $request->city,
            'position' => $request->position,
            'nationality' => $request->nationality,
            'preferred_language' => $request->preferred_language,
        ];
        
        if ($logoPath) {
            $updateData['profile_picture'] = $logoPath;
        }
        
        $company->user->update($updateData);

        return redirect()->route('company.account-settings.index')
            ->with('success', 'Informasi dasar berhasil diperbarui.');
    }

    /**
     * Update company password.
     */
    public function updatePassword(Request $request)
    {
        $company = Auth::guard('company')->user();
        
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, $company->user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai.'
            ]);
        }

        // Update user password
        $company->user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('company.account-settings.index')
            ->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Update notification preferences.
     */
    public function updateNotifications(Request $request)
    {
        $company = Auth::guard('company')->user();

        $request->validate([
            'email_notifications' => 'boolean',
            'application_notifications' => 'boolean',
            'marketing_notifications' => 'boolean',
        ]);

        $company->update([
            'email_notifications' => $request->has('email_notifications'),
            'application_notifications' => $request->has('application_notifications'),
            'marketing_notifications' => $request->has('marketing_notifications'),
        ]);

        return redirect()->route('company.account-settings.index')
            ->with('success', 'Pengaturan notifikasi berhasil diperbarui.');
    }

    /**
     * Update social media accounts.
     */
    public function updateSocialMedia(Request $request)
    {
        $company = Auth::guard('company')->user();

        $request->validate([
            'facebook' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        $company->update([
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
        ]);

        return redirect()->route('company.account-settings.index')
            ->with('success', 'Akun media sosial berhasil diperbarui.');
    }
}