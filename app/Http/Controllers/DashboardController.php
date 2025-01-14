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
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();          

        $studentData = StudentAdmission::where('id', $id)
                        //->where('department', $department)
                        ->first();

        $examSetting = ExamSetting::where('department', $studentData->department)
        ->where('level', $studentData->level)
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
        //--Check for permission---
        $userStatus = auth()->user()->exam_setting;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to access 
            the EXAM SETTING module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();        
        $examSetting = ExamSetting::paginate(20);        
        
        return view('dashboard.exam-setting-view', compact('softwareVersion','examSetting', 'collegeSetup'));
    }

    public function examSettingEdit($id)
    {
        //--Check for permission---
        $userStatus = auth()->user()->edit_exam_setting;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            edit EXAM SETTING module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examtype = ExamType::orderBy('exam_type')->get();
        $examSetting = ExamSetting::findOrFail($id);
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

    public function examSettingAction(Request $request, $id)
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
                'upload_no_of_qst' => 'required',
                'time_limit' => 'required',
                'duration' => 'required',
                'check_result' => 'required',
                'course' => 'required',
                'exam_date' => 'required',
            ]);

            $examSetting = ExamSetting::findOrFail($id);
            // Find the exam setting to update           
            $examSettingUpdate = $examSetting->update([
                'session1' => $validatedData['session1'],
                'department' => $validatedData['department'],
                'level' => $validatedData['level'],
                'semester' => $validatedData['semester'],
                'exam_category' => $validatedData['exam_category'],
                'exam_type' => $validatedData['exam_type'],
                'exam_mode' => $validatedData['exam_mode'],
                'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                'no_of_qst' => $validatedData['no_of_qst'],
                'duration' => $validatedData['duration'],
                'exam_date' => date("Y-m-d", strtotime($validatedData['exam_date'])),  
                'course' => $validatedData['course'],   
                'check_result' => $validatedData['check_result'],                                       
            ]);
            
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
        //--Check for permission---
        $userStatus = auth()->user()->user_create;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access the USERS module, contact the Administrator to grant access.');
        }

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
        //--Check for permission---
        $userStatus = auth()->user()->create_user_create;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE users in the USERS module, contact the Administrator to grant access.');
        }

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
                'exam_setting' => 'nullable|boolean',
                'edit_exam_setting' => 'nullable|boolean',
                'qst_bank' => 'nullable|boolean',
                'create_question_bank' => 'nullable|boolean',
                'edit_question_bank' => 'nullable|boolean',
                'std_list' => 'nullable|boolean',
                'create_std_list' => 'nullable|boolean',
                'edit_std_list' => 'nullable|boolean',
                'delete_std_list' => 'nullable|boolean',
                'std_login_status' => 'nullable|boolean',
                'edit_std_login_status' => 'nullable|boolean',
                'change_course' => 'nullable|boolean',
                'edit_change_course' => 'nullable|boolean',
                'user_create' => 'nullable|boolean',
                'create_user_create' => 'nullable|boolean',
                'edit_user_create' => 'nullable|boolean', 
                'status_user_create' => 'nullable|boolean',
                'college_setup' => 'nullable|boolean',
                'create_college_setup' => 'nullable|boolean',
                'edit_college_setup' => 'nullable|boolean',
                'delete_college_setup' => 'nullable|boolean',
                'report' => 'nullable|boolean',
                'check_report' => 'nullable|boolean',
                'export_report' => 'nullable|boolean',
                'grading_report' => 'nullable|boolean',
            ]);

            $email_token = Str::random(40);            

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'email_verified_status' => 1,
                'login_attempts' => 0,
                'remember_token' => $email_token,
                'user_type' => 'admin',
                'exam_setting' => $request->has('exam_setting') ? 1 : 0,
                'edit_exam_setting' => $request->has('edit_exam_setting') ? 1 : 0,
                'qst_bank' => $request->has('qst_bank') ? 1 : 0,
                'create_question_bank' => $request->has('create_question_bank') ? 1 : 0,
                'edit_question_bank' => $request->has('edit_question_bank') ? 1 : 0,
                'std_list' => $request->has('std_list') ? 1 : 0,
                'create_std_list' => $request->has('create_std_list') ? 1 : 0,
                'edit_std_list' => $request->has('edit_std_list') ? 1 : 0,
                'delete_std_list' => $request->has('delete_std_list') ? 1 : 0,
                'std_login_status' => $request->has('std_login_status') ? 1 : 0,
                'edit_std_login_status' => $request->has('edit_std_login_status') ? 1 : 0,
                'change_course' => $request->has('change_course') ? 1 : 0,
                'edit_change_course' => $request->has('edit_change_course') ? 1 : 0,
                'user_create' => $request->has('user_create') ? 1 : 0,
                'create_user_create' => $request->has('create_user_create') ? 1 : 0,
                'edit_user_create' => $request->has('edit_user_create') ? 1 : 0,
                'status_user_create' => $request->has('status_user_create') ? 1 : 0,
                'college_setup' => $request->has('college_setup') ? 1 : 0,
                'create_college_setup' => $request->has('create_college_setup') ? 1 : 0,
                'edit_college_setup' => $request->has('edit_college_setup') ? 1 : 0,
                'delete_college_setup' => $request->has('delete_college_setup') ? 1 : 0,
                'report' => $request->has('report') ? 1 : 0,
                'check_report' => $request->has('check_report') ? 1 : 0,
                'export_report' => $request->has('export_report') ? 1 : 0,
                'grading_report' => $request->has('grading_report') ? 1 : 0,
            ]);

            return redirect()->route('users')->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to add user. ' . $e->getMessage()]);
        }
    }

    
    public function editUser($id)
    {
        //--Check for permission---
        $userStatus = auth()->user()->edit_user_create;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            EDIT users in the USERS module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $user = User::findOrFail($id);

        return view('dashboard.edit-user', compact('softwareVersion', 'collegeSetup','user'));
    }

    public function editUserAction(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'new-password' => 'nullable|string|min:8|confirmed',
                'exam_setting' => 'nullable|boolean',
                'edit_exam_setting' => 'nullable|boolean',
                'qst_bank' => 'nullable|boolean',
                'create_question_bank' => 'nullable|boolean',
                'edit_question_bank' => 'nullable|boolean',
                'std_list' => 'nullable|boolean',
                'create_std_list' => 'nullable|boolean',
                'edit_std_list' => 'nullable|boolean',
                'delete_std_list' => 'nullable|boolean',
                'std_login_status' => 'nullable|boolean',
                'edit_std_login_status' => 'nullable|boolean',
                'change_course' => 'nullable|boolean',
                'edit_change_course' => 'nullable|boolean',
                'user_create' => 'nullable|boolean',
                'create_user_create' => 'nullable|boolean',
                'edit_user_create' => 'nullable|boolean',
                'status_user_create' => 'nullable|boolean',
                'college_setup' => 'nullable|boolean',
                'create_college_setup' => 'nullable|boolean',
                'edit_college_setup' => 'nullable|boolean',
                'delete_college_setup' => 'nullable|boolean',
                'report' => 'nullable|boolean',
                'check_report' => 'nullable|boolean',
                'export_report' => 'nullable|boolean',
                'grading_report' => 'nullable|boolean',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->filled('new-password')) {
                $user->password = Hash::make($request->input('new-password'));
            }

            $user->exam_setting = $request->has('exam_setting') ? 1 : 0;
            $user->edit_exam_setting = $request->has('edit_exam_setting') ? 1 : 0;
            $user->qst_bank = $request->has('qst_bank') ? 1 : 0;
            $user->create_question_bank = $request->has('create_question_bank') ? 1 : 0;
            $user->edit_question_bank = $request->has('edit_question_bank') ? 1 : 0;
            $user->std_list = $request->has('std_list') ? 1 : 0;
            $user->create_std_list = $request->has('create_std_list') ? 1 : 0;
            $user->edit_std_list = $request->has('edit_std_list') ? 1 : 0;
            $user->delete_std_list = $request->has('delete_std_list') ? 1 : 0;
            $user->std_login_status = $request->has('std_login_status') ? 1 : 0;
            $user->edit_std_login_status = $request->has('edit_std_login_status') ? 1 : 0;
            $user->change_course = $request->has('change_course') ? 1 : 0;
            $user->edit_change_course = $request->has('edit_change_course') ? 1 : 0;
            $user->user_create = $request->has('user_create') ? 1 : 0;
            $user->create_user_create = $request->has('create_user_create') ? 1 : 0;
            $user->edit_user_create = $request->has('edit_user_create') ? 1 : 0;
            $user->status_user_create = $request->has('status_user_create') ? 1 : 0;
            $user->college_setup = $request->has('college_setup') ? 1 : 0;
            $user->create_college_setup = $request->has('create_college_setup') ? 1 : 0;
            $user->edit_college_setup = $request->has('edit_college_setup') ? 1 : 0;
            $user->delete_college_setup = $request->has('delete_college_setup') ? 1 : 0;
            $user->report = $request->has('report') ? 1 : 0;
            $user->check_report = $request->has('check_report') ? 1 : 0;
            $user->export_report = $request->has('export_report') ? 1 : 0;
            $user->grading_report = $request->has('grading_report') ? 1 : 0;
            

            $user->save();

            return redirect()->route('users')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update user. ' . $e->getMessage()]);
        }
    }


    public function addCourse()
    {
        $collegeSetup = CollegeSetup::first();
        $courses = Department::paginate(10);
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.add-course', compact('courses', 'softwareVersion', 'collegeSetup'));
    }

    public function addDepartment()
    {
        //--Check for permission---
        $userStatus = auth()->user()->college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access ADMIN SETUP module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $courses = Department::paginate(9);
        $classes = CbtClass::paginate(10);
        $courseData = Courses::paginate(10);
        return view('dashboard.add-department', compact('courses', 'softwareVersion','collegeSetup',
    'classes', 'courseData'));
        
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
        //--Check for permission---
        $userStatus = auth()->user()->college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access ADMIN SETUP module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $courses = Department::paginate(9);
        $classes = CbtClass::paginate(10);
        $courseData = Courses::paginate(10);
        return view('dashboard.college-setup', compact('courses', 'softwareVersion','collegeSetup',
    'classes', 'courseData'));
        
    }        

    public function adminSetup()
    {
        //--Check for permission---
        $userStatus = auth()->user()->college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access ADMIN SETUP module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $courses = Department::paginate(9);
        $classes = CbtClass::paginate(10);
        $courseData = Courses::paginate(10);
        return view('dashboard.admin-setup', compact('courses', 'softwareVersion','collegeSetup',
    'classes', 'courseData'));
        
    }   
    
    public function addClass()
    {
        //--Check for permission---
        $userStatus = auth()->user()->college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access ADMIN SETUP module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $courses = Department::paginate(9);
        $classes = CbtClass::paginate(10);
        $courseData = Courses::paginate(10);
        return view('dashboard.add-class', compact('courses', 'softwareVersion','collegeSetup',
    'classes', 'courseData'));
        
    }    

    public function addClassAction(Request $request)
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE in the COLLEGE SETUP module, contact the Administrator to grant access.');
        }

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

            return redirect()->route('add-class')->with('success-class', 'Class/Level has been created successfully.');
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
        //--Check for permission---
        $userStatus = auth()->user()->delete_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            DELETE in the COLLEGE SETUP module, contact the Administrator to grant access.');
        }

        try {
            $class = cbtClass::findOrFail($id);
            $class->delete();

            return redirect()->route('add-class')->with('success-class', 'Class/Level deleted successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-delete class: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->back()->with('error-class', 'There was a problem deleting class.');
        }
    }

    public function addSubject()
    {
        //--Check for permission---
        $userStatus = auth()->user()->college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access ADMIN SETUP module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $courses = Department::all();
        $classes = CbtClass::paginate(10);
        $courseData = Courses::paginate(10);
        return view('dashboard.add-subject', compact('courses', 'softwareVersion','collegeSetup',
    'classes', 'courseData'));
        
    }    

    public function addSubjectAction(Request $request)
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE in the COLLEGE SETUP module, contact the Administrator to grant access.');
        }

        try {
            $validatedData = $request->validate([
                'subject' => 'required|string',
                'programme' => 'required|string',
                'level' => 'required|string',
            ]);    
            
            //---Check for duplicates
            $checkSubject = Courses::where('course', $validatedData['subject'])
            ->where('programme', $validatedData['programme'])
            ->where('level', $validatedData['level'])
            ->first();
            if($checkSubject){
                return redirect()->back()->with('error-subject', 'Subject/Course has already been created.');
            }

            $subject = Courses::create([
                'course' => $validatedData['subject'],   
                'programme' => $validatedData['programme'], 
                'level' => $validatedData['level'],                  
            ]);

            return redirect()->route('add-subject')->with('success-subject', 'Subject/Course has been created successfully.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during subject registration: ' . $e->getMessage());

            return redirect()->back()->with('error-subject', 'An error occurred during subject/course creation. Please try again.');
        }
    }

    public function editSubject($id)
    {
        //--Check for permission---
        $userStatus = auth()->user()->college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access ADMIN SETUP module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $courses = Department::all();
        $classes = CbtClass::paginate(10);
        $courseData = Courses::where('id', '=', $id)->first();
        return view('dashboard.edit-subject', compact('courses', 'softwareVersion','collegeSetup',
    'classes', 'courseData'));
        
    } 

    public function editSubjectAction(Request $request, $id)
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE in the COLLEGE SETUP module, contact the Administrator to grant access.');
        }

        try {
            $validatedData = $request->validate([
                'subject' => 'required|string',
                'programme' => 'required|string',
                'level' => 'required|string',
            ]);    
            
            //---Check if it exists
            $checkSubject = Courses::where('id', $id)
            ->first();
            if(!$checkSubject){
                return redirect()->back()->with('error-subject', 'Subject/Course cannot be found.');
            }

            // update subject/course
            $checkSubject->course = $validatedData['subject'];
            $checkSubject->programme = $validatedData['programme'];
            $checkSubject->level = $validatedData['level'];

            $checkSubject->save();

            return redirect()->route('add-subject')->with('success-subject', 'Subject/Course has been updated successfully.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during subject edit: ' . $e->getMessage());

            return redirect()->back()->with('error-subject', 'An error occurred during subject/course edit. Please try again.');
        }
    }


    public function deleteSubjectAction($id)
    {
        //--Check for permission---
        $userStatus = auth()->user()->delete_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            DELETE in the COLLEGE SETUP module, contact the Administrator to grant access.');
        }

        try {
            $subject = Courses::findOrFail($id);
            $subject->delete();

            return redirect()->route('add-subject')->with('success-subject', 'Subject/Course deleted successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-delete subject: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->back()->with('error-subject', 'There was a problem deleting subject/course.');
        }
    }

    public function addCourseCollegeAction(Request $request)
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE in the COLLEGE SETUP module, contact the Administrator to grant access.');
        }

        try {
            $validatedData = $request->validate([
                'department' => 'required|string',
            ]);       

            $dept = Department::create([
                'department' => $validatedData['department'],                     
            ]);

            return redirect()->route('add-department')->with('success-dept', 'Programme has been created successfully.');
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
        //--Check for permission---
        $userStatus = auth()->user()->delete_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            DELETE in the COLLEGE SETUP module, contact the Administrator to grant access.');
        }

        try {
            $dept = Department::findOrFail($id);
            $dept->delete();

            return redirect()->route('add-department')->with('success-dept', 'Programme deleted successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-delete Programme: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->route('college-setup')->with('error-dept', 'There was a problem deleting programme.');
        }
    }

    public function collegeSetupAction(Request $request)
    {
        //--Check for permission---
        $userStatus = auth()->user()->edit_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            edit COLLEGE SETUP module, contact the Administrator to grant access.');
        }

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
                $userCertificateFilename = $fileId . '_avatar' . "." . $userCertificateFile->getClientOriginalExtension();
                // Store file
                $certificatePath = $userCertificateFile->move(public_path('college'), $userCertificateFilename); 
                //$certificatePath = $userCertificateFile->storeAs('college', $userCertificateFilename, 'public');
                $collegeSetup->avatar = "college/" . $userCertificateFilename  ;           
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

    public function getExamDates()
    {
        // Fetch exam dates from the QuestionSetting model
        $examDates = QuestionSetting::select('department', 'course', 'exam_date','exam_mode')
            ->get()
            ->map(function($exam) {
                // Format the exam date using Carbon
                $formattedDate = Carbon::parse($exam->exam_date)->format('F j, Y');

                return [
                    'title' => "{$exam->department} - {$exam->course}",
                    'start' => $exam->exam_date,
                    'backgroundColor' => '#3c8dbc', // You can customize the color as needed
                    'borderColor' => '#3c8dbc', // You can customize the color as needed
                    'description' => "Date: {$formattedDate}<br>Time: 8:00am <br>Venue: ICT 
                    <br>Department: {$exam->department}<br>Course: {$exam->course}<br>Exam Mode: {$exam->exam_mode}"
                ];
            });

        return response()->json($examDates);
    }

    public function deactivateUser($id)
    {
        //--Check for permission---
        $userStatus = auth()->user()->status_user_create;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            ACTIVATE/DEACTIVATE users in the USERS module, contact the Administrator to grant access.');
        }

        try {
            $user = User::findOrFail($id);
            $user->user_status = "Inactive";
            $user->save();

            return redirect()->route('users')->with('success', 'User deactivated successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-deactivating user: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->route('users')->with('error', 'There was a problem deactivating user.');
        }
    }

    public function activateUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->user_status = "Active";
            $user->save();

            return redirect()->route('users')->with('success', 'User activated successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-activating user: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->route('users')->with('error', 'There was a problem activating user.');
        }
    }

    public function userSearch(Request $request)
    {
        $searchTerm = $request->input('search');

        // Perform search query
        $users = User::where('name', 'LIKE', "%{$searchTerm}%") 
            ->orWhere('email', 'LIKE', "%{$searchTerm}%")           
            ->paginate(10);
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        
        return view('dashboard.users-search', compact('softwareVersion','collegeSetup',
    'users'));
    }

    public function lockExam(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'user_password' => 'required|string',
        ]);

        // Check if the provided password matches the logged-in user's password
        if (Hash::check($request->user_password, Auth::user()->password)) {
            // Proceed to lock the exam
            $questionSetting = QuestionSetting::findOrFail($id);
            $questionSetting->lock_status = 1;
            $questionSetting->save();

            $examSetting = ExamSetting::where('exam_type', $questionSetting->exam_type)
                ->where('exam_category', $questionSetting->exam_category)
                ->where('exam_mode', $questionSetting->exam_mode)
                ->where('department', $questionSetting->department)
                ->where('level', $questionSetting->level)
                ->where('semester', $questionSetting->semester)
                ->where('session1', $questionSetting->session1)
                ->where('upload_no_of_qst', $questionSetting->upload_no_of_qst)
                ->where('no_of_qst', $questionSetting->no_of_qst)
                ->first();

            if (!$examSetting) {
                // Redirect based on the exam type if no exam setting is found
                $successMessage = 'Exam locked successfully.';
                if ($questionSetting->exam_mode === 'OBJECTIVE') {
                    return redirect()->route('question-obj-upload')->with('success', $successMessage);
                } elseif ($questionSetting->exam_mode === 'THEORY') {
                    return redirect()->route('question-theory-upload')->with('success', $successMessage);
                } elseif ($questionSetting->exam_mode === 'FILL-IN-GAP') {
                    // Replace 'question-fill-in-gap-upload' with the correct route if available
                    //return redirect()->route('question-fill-in-gap-upload')->with('success', $successMessage);
                }
            } else {
                // Lock the exam setting if found
                $examSetting->lock_status = 1;
                $examSetting->save();
            }

            // Redirect based on the exam type after locking
            $successMessage = 'Exam locked successfully.';
            if ($questionSetting->exam_mode === 'OBJECTIVE') {
                return redirect()->route('question-obj-upload')->with('success', $successMessage);
            } elseif ($questionSetting->exam_mode === 'THEORY') {
                return redirect()->route('question-theory-upload')->with('success', $successMessage);
            } elseif ($questionSetting->exam_mode === 'FILL-IN-GAP') {
                // Replace 'question-fill-in-gap-upload' with the correct route if available
                //return redirect()->route('question-fill-in-gap-upload')->with('success', $successMessage);
            }
        } else {
            // If the password is incorrect, redirect back with an error message
            return redirect()->back()->with('error', 'Invalid password. Please try again.');
        }
    }


    public function unlockExam(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'user_password' => 'required|string',
        ]);

        // Check if the provided password matches the logged-in user's password
        if (Hash::check($request->user_password, Auth::user()->password)) {
            // Proceed to unlock the exam
            $questionSetting = QuestionSetting::findOrFail($id);
            $questionSetting->lock_status = 0;  // Assuming 0 means unlocked
            $questionSetting->save();

            $examSetting = ExamSetting::where('exam_type', $questionSetting->exam_type)
                ->where('exam_category', $questionSetting->exam_category)
                ->where('exam_mode', $questionSetting->exam_mode)
                ->where('department', $questionSetting->department)
                ->where('level', $questionSetting->level)
                ->where('semester', $questionSetting->semester)
                ->where('session1', $questionSetting->session1)
                ->where('upload_no_of_qst', $questionSetting->upload_no_of_qst)
                ->where('no_of_qst', $questionSetting->no_of_qst)
                ->first();

            if (!$examSetting) {
                // Redirect based on the exam type if no exam setting is found
                $successMessage = 'Exam unlocked successfully.';
                if ($questionSetting->exam_mode === 'OBJECTIVE') {
                    return redirect()->route('question-obj-upload')->with('success', $successMessage);
                } elseif ($questionSetting->exam_mode === 'THEORY') {
                    return redirect()->route('question-theory-upload')->with('success', $successMessage);
                } elseif ($questionSetting->exam_mode === 'FILL-IN-GAP') {
                    // Replace 'question-fill-in-gap-upload' with the correct route if available
                    //return redirect()->route('question-fill-in-gap-upload')->with('success', $successMessage);
                }
            } else {
                // Unlock the exam setting if found
                $examSetting->lock_status = 0;
                $examSetting->save();
            }

            // Redirect based on the exam type after unlocking
            $successMessage = 'Exam unlocked successfully.';
            if ($questionSetting->exam_mode === 'OBJECTIVE') {
                return redirect()->route('question-obj-upload')->with('success', $successMessage);
            } elseif ($questionSetting->exam_mode === 'THEORY') {
                return redirect()->route('question-theory-upload')->with('success', $successMessage);
            } elseif ($questionSetting->exam_mode === 'FILL-IN-GAP') {
                // Replace 'question-fill-in-gap-upload' with the correct route if available
                //return redirect()->route('question-fill-in-gap-upload')->with('success', $successMessage);
            }
        } else {
            // If the password is incorrect, redirect back with an error message
            return redirect()->back()->with('error', 'Invalid password. Please try again.');
        }
    }

}
