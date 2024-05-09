<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use App\Models\User;
use App\Models\Department;
use App\Models\Question;
use App\Models\AcademicSession;
use App\Models\SoftwareVersion;
use App\Models\ExamType;
use App\Models\ExamSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.user-dashboard');
    }

    public function indexAdmin()
    {
        $students = StudentAdmission::all();
        $users = User::all();
        $departments = Department::all();
        $questions = Question::all();
        $softwareVersion = SoftwareVersion::first();

        return view('dashboard.admin-dashboard', compact('students', 'users', 'departments', 'questions',
    'softwareVersion'));
    }

    public function examSetting()
    {
        $softwareVersion = SoftwareVersion::first();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examtype = ExamType::orderBy('exam_type')->get();
        $examSetting = ExamSetting::first();
        return view('dashboard.exam-setting', compact('softwareVersion', 'dept', 'acad_sessions', 
        'examtype','examSetting'));
    }

    public function examType()
    {
        $examType = ExamType::Paginate(10);
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.exam-type', compact('softwareVersion', 'examType'));
    }

    public function examTypeAction(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'exam_type' => 'required|string',                
            ]);                        

            // Check if the exam type already exists
        $existingExamType = ExamType::where('exam_type', $validatedData['exam_type'])->first();
        
        if ($existingExamType) {
            // If the exam type already exists, redirect back with an error message
            return redirect()->route('exam-type')->with('error', 'Exam type already exists');
        }

            $examType = ExamType::create([
                'exam_type' => $validatedData['exam_type'],                              
            ]);

            return redirect()->route('exam-type')->with('success', 'Exam type has been created successfully.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during user registration: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during adding exam type. Please try again.');
        }
    }

    public function examSettingAction(Request $request)
    {
        try {
            // Validate form input
            $validatedData = $request->validate([
                'exam_category' => 'required',
                'exam_type' => 'required',
                'department' => 'required',
                'session1' => 'required',
                'semester' => 'required',
                'class' => 'required',
                'no_of_qst' => 'required',
                'time_limit' => 'required',
            ]);

            // Find the exam setting to update
            $examSetting = ExamSetting::first();

            // Update the exam setting with the validated data
            $examSetting->update($validatedData);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Exam setting updated successfully.');
            }catch (ValidationException $e) {
                // Validation failed. Redirect back with validation errors.
                return redirect()->back()->withErrors($e->errors())->withInput();
            } catch (Exception $e) {
                // Log the error
                Log::error('Error during user registration: ' . $e->getMessage());
    
                return redirect()->back()->with('error', 'An error occurred during exam settings update. Please try again.');
            }
    }

    public function Users()
    {
        try {
            $users = User::paginate(10);
            $softwareVersion = SoftwareVersion::first();
            
            return view('dashboard.users', compact('users', 'softwareVersion'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
         

    }

    public function addUser()
    {
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.add-user', compact('softwareVersion'));
    }

    public function addUserAction(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $email_token =Str::random(40);            

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),                
                'email_verified_status' => 1,
                'login_attempts' => 0,
                'remember_token' => $email_token,
                // 'user_picture' => 'profile_pictures/blank.jpg',
                'user_type' => 'admin',                
            ]);

            // $email_message = "We have sent instructions to verify your email, kindly follow instructions to continue, 
            // please check both your inbox and spam folder.";
            // session(['email' => $validatedData['email']]);
            // session(['full_name' => $validatedData['first_name']]);
            // session(['email_token' => $email_token]);
            // session(['email_message' => $email_message]);


            return redirect()->route('users')->with('success', 'User has been created successfully.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during user registration: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }

    public function changeCourse()
    {
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.change-course', compact('softwareVersion'));
    }

    public function changeCourseView(Request $request)
    {
        try{
            $validatedData = $request->validate([
            'admission_no' => 'required|string',
        ]);
        $admission_no = $validatedData['admission_no'];
        $dept = Department::orderBy('department')->get();
        $softwareVersion = SoftwareVersion::first();
        $checkAdmission = StudentAdmission::where('admission_no', $admission_no)->get();
        if(!$checkAdmission){
            return redirect()->route('change-course')->with('error', 'Invalid Reg No/Matric No.');
        }

        return view('dashboard.change-course-view', compact('softwareVersion','checkAdmission', 'dept'));
        
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during change of course: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during change of course. Please try again.');
        }

    }

    public function changeCourseAction(Request $request, $id)
    {
        try {
            // Validate the request data as needed
            $validatedData = $request->validate([                
                'department' => 'required|string',                
            ]);

            // Retrieve the user skill based on the $id
            $changeCourse = StudentAdmission::findOrFail($id);

            // Update the user skill attributes based on the request data
            $changeCourse->update([
                'department' => $validatedData['department'],                
            ]);

            // Redirect to the user's skill list or another appropriate page
            return redirect()->route('change-course')->with('success', 'Course updated successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-update course: ' . $e->getMessage();
            Log::error($errorMessage);
            // Handle any exceptions or errors here
            return back()->with('error', 'An error occurred while updating the course. Please try again.');
        }
    }

    public function addCourse()
    {
        $courses = Department::paginate(10);
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.add-course', compact('courses', 'softwareVersion'));
    }

    public function addCourseAction(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'department' => 'required|string',
            ]);       

            $dept = Department::create([
                'department' => $validatedData['department'],                     
            ]);

            return redirect()->route('add-course')->with('success', 'Department has been created successfully.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during department registration: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during department. Please try again.');
        }
    }

    public function loginStatus()
    {
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.student-login-status', compact('softwareVersion'));
    }

    public function loginStatusView(Request $request)
    {
        try{
            $validatedData = $request->validate([
            'admission_no' => 'required|string',
        ]);
        $admission_no = $validatedData['admission_no'];
        $dept = Department::orderBy('department')->get();
        $softwareVersion = SoftwareVersion::first();
        $checkAdmission = StudentAdmission::where('admission_no', $admission_no)->get();
        if(!$checkAdmission){
            return redirect()->route('login-status')->with('error', 'Invalid Reg No/Matric No.');
        }

        return view('dashboard.student-login-status-view', compact('softwareVersion','checkAdmission', 'dept'));
        
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during change of course: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during change of course. Please try again.');
        }

    }

    public function loginStatusAction(Request $request, $id)
    {
        try {
            // Validate the request data as needed
            $validatedData = $request->validate([                
                'login_status' => 'required|integer',                
            ]);

            // Retrieve the user skill based on the $id
            $changeStatus = StudentAdmission::findOrFail($id);

            // Update the user skill attributes based on the request data
            $changeStatus->update([
                'login_status' => $validatedData['login_status'],                
            ]);

            // Redirect to the user's skill list or another appropriate page
            return redirect()->route('login-status')->with('success', 'Login Status updated successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-update course: ' . $e->getMessage();
            Log::error($errorMessage);
            // Handle any exceptions or errors here
            return back()->with('error', 'An error occurred while updating the course. Please try again.');
        }
    }

    public function collegeSetup()
    {
        $softwareVersion = SoftwareVersion::first();
        $courses = Department::paginate(10);
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.college-setup', compact('courses', 'softwareVersion'));
        
    }

}
