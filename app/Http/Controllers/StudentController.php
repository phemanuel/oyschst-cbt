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
use Illuminate\Support\Facades\DB;
use App\Models\CollegeSetup;
use App\Models\CbtClass;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\QuestionSetting;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\CbtEvaluation;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentController extends Controller
{
    //
    public function changeCourse()
    {
        //--Check for permission---
        $userStatus = auth()->user()->change_course;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access the CHANGE COURSE module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.change-course', compact('softwareVersion', 'collegeSetup'));
    }

    public function changeCourseView(Request $request)
    {
        //--Check for permission---
        $userStatus = auth()->user()->edit_change_course;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            EDIT the CHANGE COURSE module, contact the Administrator to grant access.');
        }

        try{
            $validatedData = $request->validate([
            'admission_no' => 'required|string',
        ]);
        $admission_no = $validatedData['admission_no'];
        $dept = Department::orderBy('department')->get();
        $softwareVersion = SoftwareVersion::first();
        $collegeSetup = CollegeSetup::first();
        $checkAdmission = StudentAdmission::where('admission_no', $admission_no)->get();
        if(!$checkAdmission){
            return redirect()->route('change-course')->with('error', 'Invalid Reg No/Matric No.');
        }

        return view('dashboard.change-course-view', compact('softwareVersion','checkAdmission', 'dept', 
        'collegeSetup'));
        
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

    public function loginStatus()
    {
        //--Check for permission---
        $userStatus = auth()->user()->std_login_status;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access the STUDENT LOGIN/EXAM STATUS module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.student-login-status', compact('softwareVersion','collegeSetup'));
    }

    public function loginStatusView(Request $request)
    {
        //--Check for permission---
        $userStatus = auth()->user()->edit_std_login_status;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            EDIT students in the STUDENT LOGIN/EXAM STATUS module, contact the Administrator to grant access.');
        }

        try {
            // Validate the request
            $validatedData = $request->validate([
                'admission_no' => 'required|string',
            ]);

            $admission_no = $validatedData['admission_no'];
            $dept = Department::orderBy('department')->get();
            $softwareVersion = SoftwareVersion::first();
            $collegeSetup = CollegeSetup::first();            

            // Fetch student admission
            $checkAdmission = StudentAdmission::where('admission_no', $admission_no)->first();
            // $examSetting = ExamSetting::where('department', $checkAdmission->department)
            // ->where('level', $checkAdmission->level)
            // ->first();

            // Check if student is found
            if (!$checkAdmission) {
                return redirect()->route('login-status')->with('error', 'Invalid Reg No/Matric No.');
            }           

            // Return the view with the required data
            return view('dashboard.student-login-status-view', compact(
                'softwareVersion', 'checkAdmission','dept','collegeSetup'
            ));
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during login status view: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during login status view. Please try again.');
        }
    }

    public function examStatusView(Request $request)
    {
        //--Check for permission---
        $userStatus = auth()->user()->edit_std_login_status;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            EDIT students in the STUDENT LOGIN/EXAM STATUS module, contact the Administrator to grant access.');
        }

        try {
            // Validate the request
            $validatedData = $request->validate([
                'admission_no' => 'required|string',
            ]);

            $admission_no = $validatedData['admission_no'];
            $dept = Department::orderBy('department')->get();
            $softwareVersion = SoftwareVersion::first();
            $collegeSetup = CollegeSetup::first();            

            // Fetch student admission
            $checkAdmission = StudentAdmission::where('admission_no', $admission_no)->first();
            $examSetting = ExamSetting::where('department', $checkAdmission->department)
            ->where('level', $checkAdmission->level)
            ->first();

            // Check if student is found
            if (!$checkAdmission) {
                return redirect()->route('login-status')->with('error-exam', 'Invalid Reg No/Matric No.');
            }

            // Fetch exam data
            $checkExamData = CbtEvaluation::where('studentno', $admission_no)
                ->where('session1', $examSetting->session1)
                ->where('department', $examSetting->department)
                ->where('level', $examSetting->level)
                ->where('semester', $examSetting->semester)
                ->where('course', $examSetting->course)
                ->where('exam_mode', $examSetting->exam_mode)
                ->where('exam_type', $examSetting->exam_type)
                ->where('exam_category', $examSetting->exam_category)
                ->where('noofquestion', $examSetting->no_of_qst)
                ->first();

            // Check if student has exam record
            if (!$checkExamData) {
                return redirect()->route('login-status')->with('error-exam', 'Exam record not found.');
            }

            // Return the view with the required data
            return view('dashboard.student-exam-status-view', compact(
                'softwareVersion', 'checkAdmission','dept','collegeSetup','checkExamData'
            ));
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during login status view: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during login status view. Please try again.');
        }
    }


    public function loginStatusAction(Request $request, $id)
    {
        try {
            // Validate the request data as needed
            // $validatedData = $request->validate([                
            //     'login_status' => 'required|integer',  
            //     //'exam_status' => 'required|integer',              
            // ]);

            // Retrieve the user  based on the $id
            $changeStatus = StudentAdmission::findOrFail($id);
            // $examSetting = ExamSetting::where('department', $changeStatus->department)
            // ->where('level', $changeStatus->level)
            // ->first();
            $admission_no = $changeStatus->admission_no;
            
            if(!$changeStatus){
                return redirect()->back()->with('error', 'Student no cannot be found.');
            }
            // Update the user login status
            $changeStatus->update([
                'login_status' => 0,                
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

    public function examStatusAction(Request $request, $id)
    {
        try {
            // Validate the request data as needed
            $validatedData = $request->validate([ 
                'exam_status' => 'required|integer',              
            ]);

            // Retrieve the user skill based on the $id
            $changeStatus = StudentAdmission::findOrFail($id);
            $examSetting = ExamSetting::where('department', $changeStatus->department)
            ->where('level', $changeStatus->level)
            ->first();
            $admission_no = $changeStatus->admission_no;
            $examStatus = $cbtEvaluation = CbtEvaluation::where('studentno', $admission_no)
            ->where('session1', $examSetting->session1)
            ->where('department', $examSetting->department)
            ->where('level', $examSetting->level)
            ->where('course', $examSetting->course)
            ->where('exam_mode', $examSetting->exam_mode)
            ->where('exam_type', $examSetting->exam_type)
            ->where('exam_category', $examSetting->exam_category)
            ->where('noofquestion' , $examSetting->no_of_qst)
            ->first();
            
            if(!$changeStatus){
                return redirect()->back()->with('error', 'Student no cannot be found.');
            }

            $examStatus->update([
                'examstatus' => 1,                
            ]);

            // Redirect to the user's skill list or another appropriate page
            return redirect()->route('login-status')->with('success-exam', 'Exam Status updated successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-update course: ' . $e->getMessage();
            Log::error($errorMessage);
            // Handle any exceptions or errors here
            return back()->with('error', 'An error occurred while updating the exam status. Please try again.');
        }
    }

    public function student()
    {
        //--Check for permission---
        $userStatus = auth()->user()->std_list;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access the STUDENT LIST/UPLOAD module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $students = StudentAdmission::paginate(20);
        return view('dashboard.student', compact('softwareVersion','collegeSetup','students'));
    }

    public function search(Request $request)
    {
        $query = StudentAdmission::query();

        if ($request->filled('matricno')) {
            $query->where('admission_no', 'like', '%' . $request->matricno . '%');
        }

        if ($request->filled('studentname')) {
            $query->where('surname', 'like', '%' . $request->studentname . '%');
        }

        if ($request->filled('programme')) {
            $query->where('department', 'like', '%' . $request->programme . '%');
        }

        if ($request->filled('level')) {
            $query->where('level', 'like', '%' . $request->level . '%');
        }

        $students = $query->orderBy('admission_no')->paginate(20);

        if ($request->ajax()) {
            // Return the rendered partial view for AJAX
            return view('partials.student-table', compact('students'))->render();
        }

        return view('students-layout', compact('students'));
    }


    public function studentCreate()
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_std_list;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE students in the STUDENT LIST/UPLOAD module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $level = CbtClass::orderBy('level')->get();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        return view('dashboard.student-create', compact('softwareVersion','collegeSetup','level',
    'dept','acad_sessions'));
    }

    public function studentCreateAction(Request $request)
    {
        
        try {
            // Validate form input
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'admission_no' => 'required|string',
                'surname' => 'required|string',
                'first_name' => 'required|string',
                'other_name' => 'required|string',
                'department' => 'required|string',
                'sex' => 'required|string',
                'level' => 'required|string',
                'phone_no' => 'required|string',
                'state' => 'required|string',
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = $validatedData['admission_no'] . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);                             
            }            
            
            //===Create student
            $studentCreate = StudentAdmission::create([
                'session1' => $validatedData['session1'],
                'admission_no' => $validatedData['admission_no'], 
                'surname' => $validatedData['surname'], 
                'first_name' => $validatedData['first_name'],
                'other_name' => $validatedData['other_name'],
                'department' => $validatedData['department'], 
                'sex'        => $validatedData['sex'],  
                'level'      => $validatedData['level'],  
                'phone_no'   => $validatedData['phone_no'], 
                'phone_no1'   => $validatedData['phone_no'],
                'user_name'   => $validatedData['phone_no'],
                'password'   => $validatedData['phone_no'],
                'user_type'   => "student",
                'login_status' => 0,
                'login_attempts' => 0,
                'state'      => $validatedData['state'], 
                'picture_name' => $validatedData['admission_no'],
                             
            ]);

            return redirect()->back()->with('success', 'Student admission record created successfully.');

        }catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during student registration: ' . $e->getMessage());

            return redirect()->back()->with('error-college', 'An error occurred during student registration. Please try again.');
        }
    }

    // public function search(Request $request)
    // {
    //     $searchTerm = $request->input('search');

    //     return redirect()->route('search-list', ['searchTerm' => $searchTerm]);
    // }

    public function searchList($searchTerm)
    {

        // Perform search query
        $results = StudentAdmission::where('admission_no', 'LIKE', "%{$searchTerm}%")
            ->orWhere('surname', 'LIKE', "%{$searchTerm}%")
            ->paginate(20);
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $student = StudentAdmission::Paginate(20);
        return view('dashboard.student-search', compact('softwareVersion','collegeSetup','student',
    'results'));
    }

    public function studentEdit($id)
    {
        //--Check for permission---
        $userStatus = auth()->user()->edit_std_list;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            EDIT students in the STUDENT LIST/UPLOAD module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $class = CbtClass::orderBy('level')->get();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();      
        $studentData = StudentAdmission::where('id', $id)->first();

        if(!$studentData){
            return redirect()->route('student')->with('error', 'A problem ocurred while processing student data.');
        }

        return view('dashboard.student-edit', compact('softwareVersion','collegeSetup','class',
        'dept','acad_sessions', 'studentData'));
    }

    public function studentEditAction(Request $request ,$id)
    {
        try {
            // Validate form input
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'admission_no' => 'required|string',
                'surname' => 'required|string',
                'first_name' => 'required|string',
                'other_name' => 'required|string',
                'department' => 'required|string',
                'sex' => 'required|string',
                'level' => 'required|string',
                'phone_no' => 'required|string',
                'state' => 'required|string',
                'file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $studentData = StudentAdmission::where('id', $id)->first();

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = $validatedData['admission_no'] . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName); 
                $studentData->picture_name = $imageName;
            }            
                        
            //===Update student
            $studentData->update([
                'session1' => $validatedData['session1'],
                'admission_no' => $validatedData['admission_no'], 
                'surname' => $validatedData['surname'], 
                'first_name' => $validatedData['first_name'],
                'other_name' => $validatedData['other_name'],
                'department' => $validatedData['department'], 
                'sex'        => $validatedData['sex'],  
                'level'      => $validatedData['level'],  
                'phone_no'   => $validatedData['phone_no'], 
                'phone_no1'   => $validatedData['phone_no'],
                'user_name'   => $validatedData['phone_no'],
                'password'   => $validatedData['phone_no'],
                'state'      => $validatedData['state'], 
                
                             
            ]);

            return redirect()->back()->with('success', 'Student data updated successfully.');

        }catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during student edit: ' . $e->getMessage());

            return redirect()->back()->with('error-college', 'An error occurred during student data update. Please try again.');
        }
    }

    public function studentDelete($id)
    {
        //--Check for permission---
        $userStatus = auth()->user()->delete_std_list;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            DELETE students in the STUDENT LIST/UPLOAD module, contact the Administrator to grant access.');
        }

        try {
            $studentData = StudentAdmission::findOrFail($id);
            $studentData->delete();

            return redirect()->route('student')->with('success', 'Student data deleted successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Error-delete student data: ' . $e->getMessage();
            Log::error($errorMessage);
            return redirect()->route('student')->with('error', 'There was a problem deleting student.');
        }
    }

    public function studentImport()
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_std_list;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE students in the STUDENT LIST/UPLOAD module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $acad_sessions = AcademicSession::orderBy('session1')->get(); 
        
        return view('dashboard.student-import', compact('softwareVersion','collegeSetup','acad_sessions',
    ));
    }


    public function studentImportAction(Request $request)
    {
        // 1️⃣ Validate request
        $request->validate([
            'file'     => 'required|file|mimes:csv,xlsx,xls,txt',
            'session1' => 'required|string',
        ]);

        $file     = $request->file('file');
        $session1 = $request->get('session1');
        $filePath = $file->getRealPath();

        $rows = [];

        // 2️⃣ Read Excel or CSV file
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet   = $spreadsheet->getActiveSheet();
            $rows        = $worksheet->toArray(null, true, true, true); // preserve columns
        } catch (\Throwable $e) {
            Log::error('File read failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to read uploaded file.');
        }

        if (empty($rows)) {
            return redirect()->back()->with('error', 'The file is empty.');
        }

        // 3️⃣ Extract headers (first row)
        $headerRow = array_shift($rows);
        $headers = array_map(fn($h) => strtolower(trim($h)), array_values($headerRow));

        $expectedHeaders = [
            'admission_no',
            'surname',
            'first_name',
            'other_name',
            'department',
            'department1',
            'phone_no',
            'state',
            'level',
            'sex',
        ];

        // 4️⃣ Validate headers (order-independent)
        if (array_diff($expectedHeaders, $headers) || array_diff($headers, $expectedHeaders)) {
            return redirect()->back()->with(
                'error',
                'Invalid file headers. Expected exactly: ' . implode(', ', $expectedHeaders)
            );
        }

        DB::beginTransaction();

        try {
            foreach ($rows as $rowNumber => $row) {

                $values = array_values($row);

                if (count($values) !== count($headers)) {
                    Log::warning("Row " . ($rowNumber + 2) . " skipped: column count mismatch");
                    continue; // skip malformed row
                }

                $data = array_combine($headers, $values);

                if (empty($data['admission_no'])) {
                    continue; // skip empty admission_no
                }

                // 5️⃣ Normalize admission number (remove slashes)
                $normalizedAdmissionNo = $this->normalizeAdmissionNo($data['admission_no']);

                // 6️⃣ Prevent duplicate
                $exists = DB::table('student_admissions')
                    ->where('admission_no', $normalizedAdmissionNo)
                    ->where('department', trim($data['department']))
                    ->exists();

                if ($exists) {
                    continue; // skip duplicates
                }

                // 7️⃣ Insert student
                DB::table('student_admissions')->insert([
                    'admission_no'   => $normalizedAdmissionNo,
                    'surname'        => trim($data['surname']),
                    'first_name'     => trim($data['first_name']),
                    'other_name'     => trim($data['other_name']),
                    'department'     => trim($data['department']),
                    'department1'    => trim($data['department']),
                    'phone_no'       => trim($data['phone_no']),
                    'phone_no1'      => trim($data['phone_no']),
                    'state'          => trim($data['state']),
                    'level'          => trim($data['level']),
                    'sex'            => trim($data['sex']),
                    'picture_name'   => 'blank',
                    'user_name'      => trim($data['phone_no']),
                    'password'       => bcrypt(trim($data['phone_no'])),
                    'session1'       => $session1,
                    'user_type'      => 'student',
                    'login_status'   => 0,
                    'login_attempts' => 0,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Student list imported successfully.');

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::error('Student import failed', ['error' => $e->getMessage()]);

            return redirect()->back()->with(
                'error',
                'Student list import failed. Please check your file.'
            );
        }
    }

    private function normalizeAdmissionNo(string $admissionNo): string
    {
        return strtoupper(
            preg_replace('/[^A-Z0-9]/i', '', trim($admissionNo))
        );
    }

    public function downloadStudentCsv()
    {
        $filePath = public_path('sample/student.csv');

        return Response::download($filePath, 'student_sample.csv', ['Content-Type' => 'text/csv']);
    }

    public function loginStatusAll()
    {
        //--Check for permission---
        $userStatus = auth()->user()->edit_std_login_status;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            EDIT students in the STUDENT LOGIN/EXAM STATUS module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        
        $students = StudentAdmission::all();

        foreach ($students as $student) {
            $student->login_status = 0;
            $student->save();
        }

        return redirect()->route('login-status')->with('success-all', 'Login status reset successful.');
    }

    public function studentMigrate()
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_college_setup;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access STUDENT MIGRATION module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        
        return view('layout.student-migrate', compact( 'softwareVersion','collegeSetup' ));
        
    }  

    public function migrateStudents()
    {        
        // Fetch all students
        $students = DB::table('student_admissions')->get();

        foreach ($students as $student) {

            // Fetch programme info
            $programme = DB::table('course_study_all')
                ->where('department', $student->department)
                ->first();

            if (!$programme) {
                continue;
            }

            $currentLevel = $student->level;
            $startLevel   = $programme->start_level;
            $duration     = (int) $programme->duration;

            $nextLevel = $this->getNextLevel(
                $currentLevel,
                $startLevel,
                $duration
            );

            // Skip if no change
            if ($nextLevel === null) {
                continue;
            }

            DB::table('student_admissions')
                ->where('id', $student->id)
                ->update([
                    'previous_level' => $currentLevel, // store previous level
                    'level'      => $nextLevel,
                ]);
        }

        return back()->with('success', 'Students migrated successfully');
    }

    /**
     * Reset students back to previous level
     */
    public function resetMigration()
    {
        DB::table('student_admissions')
            ->whereNotNull('previous_level')
            ->update([
                'level' => DB::raw('previous_level'),
                'previous_level' => null,
            ]);

        return back()->with('success', 'Student migration reset successfully');
    }

    /**
     * Determine next level
     */
    private function getNextLevel($currentLevel, $startLevel, $duration)
    {
        // Numeric levels (100, 200, 300 ...)
        if (is_numeric($currentLevel)) {

            $endLevel = $startLevel + (($duration - 1) * 100);

            if ($currentLevel < $endLevel) {
                return $currentLevel + 100;
            }

            if ($currentLevel == $endLevel) {
                return 'GRAD';
            }
        }

        // ND / HND cases
        $map = [
            'NDI'  => 'NDII',
            'NDII' => 'GRAD',
            'HNDI' => 'HNDII',
            'HNDII'=> 'GRAD',
        ];

        return $map[$currentLevel] ?? null;
    }

    
}
