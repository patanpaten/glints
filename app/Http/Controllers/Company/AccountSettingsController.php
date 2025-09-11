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
        return view('company.account-settings.index', compact('company'));
    }

    /**
     * Update company account information.
     */
    public function updateAccount(Request $request)
    {
        $company = Auth::guard('company')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $company->user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        // Update company info
        $company->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
        
        // Update user email
        $company->user->update([
            'email' => $request->email,
        ]);

        return redirect()->route('company.account-settings.index')
            ->with('success', 'Informasi akun berhasil diperbarui.');
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
}