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
use App\Models\CollegeSetup;
use App\Models\CbtClass;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\QuestionSetting;
use Illuminate\Support\Facades\Session;
use App\Models\Courses;

class DashboardController extends Controller
{
    //
    public function index($admission_no)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $examSetting = ExamSetting::first();       

        $studentData = StudentAdmission::where('admission_no', $admission_no)
                        //->where('department', $department)
                        ->first();

        return view('student.pages.dashboard', compact('softwareVersion', 'collegeSetup', 'studentData',
    'examSetting'));
    }

    public function indexAdmin()
    {
        $collegeSetup = CollegeSetup::first(); 
        $students = StudentAdmission::all();
        $users = User::all();
        $departments = Department::all();
        $questions = QuestionSetting::all();
        $softwareVersion = SoftwareVersion::first();

        return view('dashboard.admin-dashboard', compact('students', 'users', 'departments', 'questions',
    'softwareVersion', 'collegeSetup'));
    }

    public function examSetting()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examtype = ExamType::orderBy('exam_type')->get();
        $examSetting = ExamSetting::first();
        $level = CbtClass::orderBy('level')->get();
        $courseData = Courses::orderBy('course')->get();
        return view('dashboard.exam-setting', compact('softwareVersion', 'dept', 'acad_sessions', 
        'examtype','examSetting', 'collegeSetup', 'level','courseData'));
    }

    public function examType()
    {
        $collegeSetup = CollegeSetup::first();
        $examType = ExamType::Paginate(10);
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.exam-type', compact('softwareVersion', 'examType', 'collegeSetup'));
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
                'exam_mode' => 'required',
                'exam_category' => 'required',
                'exam_type' => 'required',
                'department' => 'required',
                'session1' => 'required',
                'semester' => 'required',
                'level' => 'required',
                'no_of_qst' => 'required',
                'time_limit' => 'required',
                'duration' => 'required',
                'check_result' => 'required',
                'course' => 'required',
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
            $collegeSetup = CollegeSetup::first();
            $users = User::paginate(10);
            $softwareVersion = SoftwareVersion::first();
            
            return view('dashboard.users', compact('users', 'softwareVersion', 'collegeSetup'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
         

    }

    public function addUser()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.add-user', compact('softwareVersion', 'collegeSetup'));
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

    public function addCourse()
    {
        $collegeSetup = CollegeSetup::first();
        $courses = Department::paginate(10);
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.add-course', compact('courses', 'softwareVersion', 'collegeSetup'));
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

    public function collegeSetup()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $courses = Department::paginate(9);
        $classes = CbtClass::paginate(10);
        $courseData = Courses::paginate(10);
        return view('dashboard.college-setup', compact('courses', 'softwareVersion','collegeSetup',
    'classes', 'courseData'));
        
    }    

    public function addClassAction(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'level' => 'required|string',
            ]);    
            
            //----Check for duplicates
            $checkClass = CbtClass::where('level', $validatedData['level'])->first();
            if($checkClass){
                return redirect()->back()->with('error-class', 'Class/Level has already been created.');
            }

            $level = CbtClass::create([
                'level' => $validatedData['level'],                     
            ]);

            return redirect()->route('college-setup')->with('success-class', 'Class/Level has been created successfully.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during class registration: ' . $e->getMessage());

            return redirect()->back()->with('error-class', 'An error occurred during department. Please try again.');
        }
    }

    public function deleteClassAction($id)
    {
        try {
            $class = cbtClass::findOrFail($id);
            $class->delete();

            return redirect()->route('college-setup')->with('success-class', 'Class/Level deleted successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-delete class: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->route('college-setup')->with('error-class', 'There was a problem deleting class.');
        }
    }

    public function addSubjectAction(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'subject' => 'required|string',
            ]);    
            
            //---Check for duplicates
            $checkSubject = Courses::where('course', $validatedData['subject'])->first();
            if($checkSubject){
                return redirect()->back()->with('error-subject', 'Subject/Course has already been created.');
            }

            $subject = Courses::create([
                'course' => $validatedData['subject'],                     
            ]);

            return redirect()->route('college-setup')->with('success-subject', 'Subject/Course has been created successfully.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during subject registration: ' . $e->getMessage());

            return redirect()->back()->with('error-subject', 'An error occurred during subject/course creation. Please try again.');
        }
    }

    public function deleteSubjectAction($id)
    {
        try {
            $subject = Courses::findOrFail($id);
            $subject->delete();

            return redirect()->route('college-setup')->with('success-subject', 'Subject/Course deleted successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-delete subject: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->route('college-setup')->with('error-subject', 'There was a problem deleting subject/course.');
        }
    }

    public function addCourseCollegeAction(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'department' => 'required|string',
            ]);       

            $dept = Department::create([
                'department' => $validatedData['department'],                     
            ]);

            return redirect()->route('college-setup')->with('success-dept', 'Programme has been created successfully.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during Programme registration: ' . $e->getMessage());

            return redirect()->back()->with('error-dept', 'An error occurred during Programme. Please try again.');
        }
    }

    public function deleteDeptAction($id)
    {
        try {
            $dept = Department::findOrFail($id);
            $dept->delete();

            return redirect()->route('college-setup')->with('success-dept', 'Programme deleted successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-delete Programme: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->route('college-setup')->with('error-dept', 'There was a problem deleting programme.');
        }
    }

    public function collegeSetupAction(Request $request)
    {
        try {
            // Validate form input
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'web_url' => 'required',
                'file'  => 'nullable',
            ]);

            $collegeSetup = CollegeSetup::first();

            if ($request->hasFile('file')) {   
                $userCertificateFile = $request->file('file');
                $fileId = uniqid();                
                // Generate filenames                 
                $userCertificateFilename = $fileId . '_avatar' . $userCertificateFile->getClientOriginalExtension();
                // Store file
                $certificatePath = $userCertificateFile->storeAs('college', $userCertificateFilename, 'public');
                $collegeSetup->avatar = $certificatePath  ;           
            }    

            // Update the exam setting with the validated data
            $collegeSetup->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'web_url' => $validatedData['web_url'],
            ]);

            // Redirect back with success message
            return redirect()->back()->with('success-college', 'College setup updated successfully.');
            }catch (ValidationException $e) {
                // Validation failed. Redirect back with validation errors.
                return redirect()->back()->withErrors($e->errors())->withInput();
            } catch (Exception $e) {
                // Log the error
                Log::error('Error during college setting: ' . $e->getMessage());
    
                return redirect()->back()->with('error-college', 'An error occurred during exam settings update. Please try again.');
            }
    }

     

}
