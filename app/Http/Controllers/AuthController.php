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
            // Validate request data
            $credentials = $request->validate([
                'admission_no' => 'required|string',
                'department' => 'required|string',
            ]);

            $admission_no = $credentials['admission_no'];

            // Attempt to find the student using the admission number and department
            $student = StudentAdmission::where('admission_no', $admission_no)
                ->where('department', $credentials['department'])
                ->first();
            
            $studentId = $student->id;

            // Check if student exists
            if (!$student) {
                // If student doesn't exist, return error
                return redirect()->back()->with('error', 'Invalid admission number or department');                 
            }

            // Fetch login status
            $loginStatus = $student->login_status;

            // Check login status
            switch ($loginStatus) {
                case 1:
                    return redirect()->back()->with('error', 'You are already logged in.');

                case 2:
                    return redirect()->back()->with('error', 'You have completed the test.');

                case 0:
                    // Check if the exam is available
                    $examSetting = ExamSetting::where('department', $student->department)
                        ->where('level', $student->level)
                        ->first();

                    // If no exam is available for the student’s department/level
                    if (!$examSetting) {
                        return redirect()->back()->with('error', 'The exam is not available.');
                    }

                    // Check if the exam has been locked
                    if ($examSetting->lock_status == 1) {
                        return redirect()->back()->with('error', 'The exam has been locked by the tutor in charge.');
                    }

                    // Update login status to "logged in"
                    $student->login_status = 1;
                    $student->save();

                    // Encode the admission number to handle slashes or special characters
                    $encoded_admission_no = urlencode($admission_no);

                    // Authentication successful, redirect to student dashboard with encoded admission number
                    return redirect()->route('dashboard', ['id' => $studentId]);

                default:
                    return redirect()->back()->with('error', 'Invalid login status.');
            }

        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error during student login: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
    }


        public function adminLoginAction(Request $request)
        {
            try {
                validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required'
                ])->validate();
                    
                $userLog = User::where('email', $request->input('email'))->first();
                //---Check if user is active-----
                $userStatus = $userLog->user_status;
                if($userStatus == 'Inactive'){
                    return redirect()->back()->with('error', 'You have been deactivated from using the application.');
                }
                
                if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
                    //---check the no of attempts=====
                    if($userLog->login_attempts < 5){
                        //--increment the number of attempts
                        $userLog->increment('login_attempts');
                        // Log the failed login attempt into the failed_logins table.
                        FailedLogins::create([
                        'ip_address' => $request->ip(),
                        'admission_no' => $request->input('email'),
                    ]);
                    }
                    elseif($userLog->login_attempts >= 5){
                        return redirect()->route('user-locked')->with('seconds', '60');
                    }                
                    throw ValidationException::withMessages([
                        'email' => trans('auth.failed')
                    ]);
                }            

                // User is authenticated at this point
                $user = Auth::user();
                //---reset the user login attempts----
                Auth::user()->update(['login_attempts' => 0]);
            
                if ($user->email_verified_status == 1) {
                    // Email is verified, proceed with login
                    $request->session()->regenerate();
                    return redirect()->route('admin-dashboard');
                } else {                    
                    // Email is not verified, return a flash message
                    //Auth::logout(); // Log the user out since the email is not verified                    
                    $email_address = $request->email;         
                    return view('auth.email-not-verify');
                    
                }
            } catch (ValidationException $e) {
                // Handle the validation exception
                // You can redirect back with errors or do other appropriate error handling
                return redirect()->route('admin-login')->withErrors($e->errors())->withInput();
            } catch (Exception $e) {
                // Handle other exceptions, log them, and redirect to an error page
                Log::error('Error during login: ' . $e->getMessage());
                return redirect()->route('admin-login');
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
