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
        $softwareVersion = SoftwareVersion::first();
        return view('dashboard.exam-type', compact('softwareVersion'));
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

}
