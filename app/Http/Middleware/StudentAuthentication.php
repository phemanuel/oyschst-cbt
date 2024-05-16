<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class StudentAuthentication
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and is a student
        if (Auth::check() && Auth::user()->isStudent()) {
            // Check if the session is still valid
            if (! $request->session()->has('lastActivity') || 
                time() - $request->session()->get('lastActivity') > config('session.lifetime')) {
                // If the session has expired, log out the user and redirect to login page
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your session has expired. Please login again.');
            }

            // Update last activity time to refresh session timeout
            $request->session()->put('lastActivity', time());
        }

        return $next($request);
    }
}
