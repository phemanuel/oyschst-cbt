<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OSCEAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Example condition: user not logged in for OSCE session
        // You can replace this with your own logic
        if (!$request->session()->has('osce_user')) {
            return redirect('/osce')->with('error', 'Please login to access OSCE.');
        }

        return $next($request);
    }
}
