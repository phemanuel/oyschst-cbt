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

class AuthController extends Controller
{
    //----landing page
    public function home()    
    {   
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        return view('home', compact('collegeSetup','softwareVersion'));

    }

    public function testBlink()    
    {   
        
        return view('test-blink');

    }

    public function login()
    {
        $dept = Department::orderBy('department')->get();
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        return view('auth.user-login', compact('dept','collegeSetup','softwareVersion'));

    }

    public function adminLogin()
    {   
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        return view('auth.admin-login',compact('collegeSetup','softwareVersion'));

    }

    public function loginAction(Request $request)
    {
        try {

            // 1. Validate input
            $credentials = $request->validate([
                'admission_no' => 'required|string',
                'department'   => 'required|string',
            ]);

            $normalizedAdmissionNo = $this->normalizeAdmissionNo(
                $credentials['admission_no']
            );

            $student = StudentAdmission::where('admission_no', $normalizedAdmissionNo)
                ->where('department', $credentials['department'])
                ->first();

            // 3. Check if student exists
            if (!$student) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid admission number or programme.');
            }

            $studentId   = $student->id;
            $loginStatus = $student->login_status;

            // 4. Handle login status
            switch ($loginStatus) {

                case 1:
                    return redirect()->back()
                        ->with('error', 'You are already logged in on another system.');

                case 2:
                    return redirect()->back()
                        ->with('error', 'You have already completed this test.');

                case 0:

                    // 5. Check exam availability
                    $examSetting = ExamSetting::where('department', $student->department)
                        ->where('level', $student->level)
                        ->first();

                    if (!$examSetting) {
                        return redirect()->back()
                            ->with('error', 'The exam is not available for your programme.');
                    }

                    // 6. Check if exam is locked
                    if ($examSetting->lock_status == 1) {
                        return redirect()->back()
                            ->with('error', 'The exam has been locked by the examiner.');
                    }

                    // 7. Update login status
                    $student->update([
                        'login_status' => 1,
                        'last_login_at' => now(), // optional but useful
                    ]);

                    // 8. Redirect to dashboard
                    return redirect()->route('dashboard', ['id' => $studentId]);

                default:
                    return redirect()->back()
                        ->with('error', 'Invalid login state detected.');
            }

        } catch (\Throwable $e) {

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


        public function adminLoginAction(Request $request)
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

                // Increment login attempts
                $user->increment('login_attempts');

                // Log failed login
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

            // Reset login attempts
            $user->update([
                'login_attempts' => 0,
                'last_login_at'  => now(),
                'last_login_ip'  => $request->ip(),
            ]);

            // 8. Email verification check
            if ($user->email_verified_status == 1) {
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => auth()->user()->name . ' Logged in. ' ,
                        'activity_date' => now(),
                    ]);
                }
                return redirect()->route('admin-dashboard');
            }

            // Email not verified
            Auth::logout();
            return view('auth.email-not-verify');

        } catch (ValidationException $e) {

            return redirect()->route('admin-login')
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Throwable $e) {

            Log::error('Admin Login Error', [
                'message' => $e->getMessage(),
                'ip'      => $request->ip(),
            ]);

            return redirect()->route('admin-login')
                ->with('error', 'A system error occurred. Please try again.');
        }
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
