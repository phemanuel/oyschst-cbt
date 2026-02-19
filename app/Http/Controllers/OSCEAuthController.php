<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\StudentAdmission;
use App\Models\User;
use App\Models\FailedLogins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\CollegeSetup;
use App\Models\SoftwareVersion;
use App\Models\ExamSetting;

class OSCEAuthController extends Controller
{
    //

    public function osceHome()    
    {   
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $dept = Department::orderBy('department')->get();
        return view('osce.home', compact('collegeSetup','softwareVersion','dept'));

    }

    public function studentLogin(Request $request)
    {
        try {
            // 1️⃣ Validate input
            $request->validate([
                'admission_no' => 'required|string',
                'department'   => 'required|string',
            ]);

            // 2️⃣ Normalize admission number (remove spaces, slashes, backslashes)
            $normalizedAdmissionNo = $this->normalizeAdmissionNo($request->admission_no);

            // 3️⃣ Fetch student by normalized admission number and department
            $student = StudentAdmission::where('admission_no', $normalizedAdmissionNo)
                ->where('department', $request->department)
                ->first();

            if (!$student) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid admission number or programme.');
            }
            
            $request->session()->regenerate();
            $request->session()->put('osce_student', $student->id);

            // 8️⃣ Redirect to student dashboard
            return redirect()->route('student.dashboard', ['id' => $student->id]);

        } catch (\Throwable $e) {
            // 9️⃣ Log error for debugging
            Log::error('Student CBT Login Error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->with('error', 'A system error occurred. Please contact the administrator.');
        }
    }



    private function normalizeAdmissionNo(string $admissionNo): string
    {
        return strtoupper(
            preg_replace('/[^A-Z0-9]/i', '', trim($admissionNo))
        );
    }


    public function examinerLogin(Request $request)
    {
        try {

            // 1. Validate request
            $request->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            // 2. Fetch user
            $user = User::where('email', $request->email)->first();

            // 3. If user does not exist
            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            }

            // ✅ 3b. Check if user is examiner or superadmin
            if (!in_array($user->user_type, ['examiner', 'superadmin'])) {
                throw ValidationException::withMessages([
                    'email' => 'You are not authorized to access the examiner portal.',
                ]);
            }

            // 4. Check if user is active
            if ($user->user_status === 'Inactive') {
                return redirect()->back()
                    ->with('error', 'You have been deactivated from using the application.');
            }

            // 5. Check login attempts
            if ($user->login_attempts >= 5) {
                return redirect()->route('user-locked')->with('seconds', 60);
            }

            // 6. Attempt authentication
            if (!Auth::attempt(
                $request->only('email', 'password'),
                $request->boolean('remember')
            )) {

                $user->increment('login_attempts');

                FailedLogins::create([
                    'ip_address' => $request->ip(),
                    'email'      => $request->email,
                ]);

                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            }

            // 7. Successful login
            $request->session()->regenerate();

            $request->session()->put('osce_user', $user->id);

            $user->update([
                'login_attempts' => 0,
            ]);

            // 8. Email verification check
            if ($user->email_verified_status == 1) {
                return redirect()->route('examiner.dashboard');
            }

            $request->session()->forget('osce_user');
            Auth::logout();
            return view('auth.email-not-verify');

        } catch (ValidationException $e) {

            return redirect()->route('osce-home')
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Throwable $e) {

            Log::error('Examiner Login Error', [
                'message' => $e->getMessage(),
                'ip'      => $request->ip(),
            ]);

            return redirect()->route('osce-home')
                ->with('error', 'A system error occurred. Please try again.');
        }
    }


    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // User not found
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login credentials'
            ], 401);
        }

        // Attempt authentication
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login credentials'
            ], 401);
        }

        // Refresh user instance after login
        $user = Auth::user();

        // ✅ ROLE CHECK
        if (!in_array($user->user_type, ['superadmin', 'admin'])) {

            Auth::logout();

            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access. Admins only.'
            ], 403);
        }

        $request->session()->regenerate();
        $request->session()->put('osce_user', $user->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'redirect' => route('osce.dashboard')
        ]);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');


    }

    public function studentLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');


    }

}
