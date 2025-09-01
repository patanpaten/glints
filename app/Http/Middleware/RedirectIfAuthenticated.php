<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Handle company guard specifically
                if ($guard === 'company') {
                    return redirect()->route('company.dashboard');
                }
                
                // Redirect based on user role for default guard
                $user = Auth::guard($guard)->user();
                if ($user && isset($user->role)) {
                    switch (strtolower($user->role->slug)) {
                        case 'admin':
                            return redirect()->route('admin.dashboard');
                        case 'company':
                            return redirect()->route('company.dashboard');
                        case 'job-seeker':
                            return redirect()->route('jobseeker.dashboard');
                        default:
                            return redirect(RouteServiceProvider::HOME);
                    }
                }
                
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}