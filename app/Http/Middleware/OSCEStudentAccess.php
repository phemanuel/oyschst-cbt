<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class OSCEStudentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {        
        // Check if student is authenticated using student guard
        if (!$request->session()->has('osce_student')) {
            return redirect('/osce')->with('error', 'Please login to access OSCE.');
        }

        return $next($request);
    }
}
