<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyRegisterEmailController extends Controller
{
    public function showRegisterForm()
    {
        return view('company.auth.register-email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:20',
        ]);

        // Get company role
        $companyRole = Role::where('slug', 'company')->first();
        if (!$companyRole) {
            return back()->withErrors(['error' => 'Company role not found']);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $companyRole->id,
        ]);

        // Create company profile
        $company = Company::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        // Login as company
        Auth::guard('company')->login($company);

        return redirect()->route('company.profile.edit')->with('success', 'Registrasi dengan email berhasil!');
    }
}
