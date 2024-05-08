<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the student is authenticated
        if (!auth()->guard('student')->check()) {
            // If not authenticated, redirect to login page
            return redirect()->route('login')->with('error', 'You must be logged in to access the student dashboard.');
        }

        // If authenticated, allow access to the dashboard
        return $next($request);
    }
}
