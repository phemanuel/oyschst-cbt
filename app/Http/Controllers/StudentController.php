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

class StudentController extends Controller
{
    //
    public function changeCourse()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.change-course', compact('softwareVersion', 'collegeSetup'));
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
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.student-login-status', compact('softwareVersion','collegeSetup'));
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
        $collegeSetup = CollegeSetup::first();
        $checkAdmission = StudentAdmission::where('admission_no', $admission_no)->get();
        if(!$checkAdmission){
            return redirect()->route('login-status')->with('error', 'Invalid Reg No/Matric No.');
        }

        return view('dashboard.student-login-status-view', compact('softwareVersion','checkAdmission', 
        'dept', 'collegeSetup'));
        
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

    public function student()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $student = StudentAdmission::Paginate(20);
        return view('dashboard.student', compact('softwareVersion','collegeSetup','student'));
    }

    public function studentCreate()
    {
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
                'picture_name' => $imageName,
                             
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

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Perform search query
        $results = StudentAdmission::where('admission_no', 'LIKE', "%{$searchTerm}%")
            ->orWhere('Surname', 'LIKE', "%{$searchTerm}%")
            ->paginate(20);
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $student = StudentAdmission::Paginate(20);
        return view('dashboard.student-search', compact('softwareVersion','collegeSetup','student',
    'results'));
    }

    public function studentEdit($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $class = CbtClass::orderBy('class')->get();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();      
        $studentData = StudentAdmission::where('id', $id)->get();

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
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $acad_sessions = AcademicSession::orderBy('session1')->get(); 
        
        return view('dashboard.student-import', compact('softwareVersion','collegeSetup','acad_sessions',
    ));
    }

    public function studentImportAction(Request $request)
    {
         // Validate the uploaded file
        //  $validatedData = $request->validate([
        //     'session1' => 'required|string',
        //     'file' => 'required|mimes:csv|max:10240', // Max 10MB, only Excel files allowed
        // ]);

        // Process the uploaded Excel file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getRealPath();            
            $session1 =  $request->get('session1');

            if (($handle = fopen($fileName, "r")) !== FALSE) {
                $headers = fgetcsv($handle, 10000, ","); // Read headers
                while (($column = fgetcsv($handle, 10000, ",")) !== FALSE) {
                    $data = array_combine($headers, $column); // Combine headers with data

                    // Insert data into database
                    DB::table('student_admissions')->insert([
                        'admission_no' => $data['admission_no'],                    
                        'surname' => $data['surname'],
                        'first_name' => $data['first_name'],
                        'other_name' => $data['other_name'],
                        'department' => $data['department'],
                        'phone_no' => $data['phone_no'],
                        'phone_no1' => $data['phone_no'],
                        'state' => $data['state'],
                        'level' => $data['level'],
                        'sex' => $data['sex'],
                        'user_name' => $data['phone_no'],
                        'password' => $data['phone_no'],
                        'session1' => $session1,
                        'user_type' => 'student',
                        'picture_name' => 'blank.jpg',
                        'login_status' => 0,
                        'login_attempts' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                fclose($handle);
                // $type = "success";
                // $message = "CSV Data Imported into the Database";
                // Redirect back with success message
            return redirect()->back()->with('success', 'Student list imported successfully.');
            } else {
                // Log or handle missing data
            Log::warning('Missing data in row: ' . json_encode($row));
            return redirect()->back()->with('error', 'Student list import not successful.');
            }  
        } else {
           
           return redirect()->back()->with('error', 'No file was uploaded.');
        }  
    }

    public function downloadStudentCsv()
    {
        $filePath = public_path('sample/student.csv');

        return Response::download($filePath, 'student_sample.csv', ['Content-Type' => 'text/csv']);
    }
}
