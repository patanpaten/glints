<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // atau Company kalau tabelnya beda
use Illuminate\Support\Facades\Auth;

class CompanyRegisterEmailController extends Controller
{
    public function showRegisterForm()
    {
        return view('company.auth.register-email'); // pastikan view ini ada
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('company.dashboard')->with('success', 'Registrasi dengan email berhasil!');
    }
}
