<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('company.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        // Get company role
        $companyRole = Role::where('slug', 'company')->first();
        if (!$companyRole) {
            return back()->withErrors(['error' => 'Company role not found']);
        }

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $companyRole->id,
        ]);

        // Create company profile
        $company = Company::create([
            'user_id' => $user->id,
            'name' => $data['name'],
        ]);

        // Login as company
        Auth::guard('company')->login($company);

        return redirect()->route('company.profile.edit');
    }
}
