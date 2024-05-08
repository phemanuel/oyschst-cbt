<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\StudentAdmission;
use App\Models\FailedLogins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //----landing page
    public function home()
    {
        $dept = Department::orderBy('department')->get();
        return view('auth.user-login', compact('dept'));

    }

    public function login()
    {
        $dept = Department::orderBy('department')->get();
        return view('auth.user-login', compact('dept'));

    }

    public function loginAction(Request $request)
    {       
        
        try {
            // Validate request data
            $credentials = $request->validate([
                'admission_no' => 'required|string',
                'department' => 'required|string',
            ]);
        
            // Attempt to authenticate the student
            $student = StudentAdmission::where('admission_no', $credentials['admission_no'])
                ->where('department', $credentials['department'])
                ->first();
        
            if ($student) {
                // Authentication successful, redirect to student dashboard
                return redirect()->route('dashboard');
            } else {
                // Authentication failed, redirect back with error message
                return redirect()->back()->with('error', 'Invalid admission number or department');
            }
        } catch (Exception $e) {
            // Handle any exceptions
            // Log the error if needed
            Log::error('Error during student login: ' . $e->getMessage());
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
            
    }
}
