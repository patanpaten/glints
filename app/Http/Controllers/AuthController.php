<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $userService;

    /**
     * AuthController constructor.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = $user->role?->slug; // aman kalau role null

            if ($role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            if ($role === 'company') {
                return redirect()->intended(route('company.dashboard'));
            }

            // default ke jobseeker/dashboard
            return redirect()->intended(route('jobseeker.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Email atau kata sandi tidak cocok.'])
            ->withInput($request->except('password'));
    }

    /**
     * Show registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Kirim password mentah ke service, model akan hash otomatis
        $user = $this->userService->createUser([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'role_id'  => $request->role_id,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // Redirect sesuai role
        if ($user->isCompany()) {
            return redirect()->route('company.profile.create');
        }

        if ($user->isJobSeeker()) {
            return redirect()->route('jobseeker.profile.create');
        }

        return redirect()->route('home');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
