<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        $role = strtolower($role);

        // Get role from user's role relationship
        if (!$user->role || strtolower($user->role->name) !== $role) {
            // Redirect based on user's actual role
            if ($user->role) {
                switch (strtolower($user->role->name)) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'company':
                        return redirect()->route('company.dashboard');
                    case 'job_seeker':
                        return redirect()->route('jobseeker.dashboard');
                    default:
                        return redirect()->route('home');
                }
            }

            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}