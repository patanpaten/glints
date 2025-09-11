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

        $isModalLogin = $request->input('login_from') === 'modal';

        if ($validator->fails()) {
            if ($isModalLogin) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = $user->role?->slug; // aman kalau role null

            $redirectUrl = '';
            if ($role === 'admin') {
                $redirectUrl = route('admin.dashboard');
            } elseif ($role === 'company') {
                $redirectUrl = route('company.dashboard');
            } else {
                // default ke jobseeker/dashboard
                $redirectUrl = route('jobseeker.dashboard');
            }

            if ($isModalLogin) {
                return response()->json([
                    'success' => true,
                    'redirect_url' => $redirectUrl
                ]);
            }

            return redirect()->intended($redirectUrl);
        }

        $errorMessage = 'Email atau kata sandi tidak cocok.';
        if ($isModalLogin) {
            return response()->json([
                'success' => false,
                'errors' => ['email' => [$errorMessage]]
            ], 422);
        }

        return back()
            ->withErrors(['email' => $errorMessage])
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
