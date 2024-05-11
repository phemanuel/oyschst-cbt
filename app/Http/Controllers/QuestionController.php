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

class QuestionController extends Controller
{
    //
    public function question()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::Paginate(20);

        return view('questions.question', compact('softwareVersion','collegeSetup','questionSetting'));
    }

    public function questionUpload()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();        
        return view('questions.question-upload', compact('softwareVersion','collegeSetup'));

    }

    public function questionUploadObj()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $class = CbtClass::orderBy('class')->get();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examType = ExamType::Paginate(10);
        return view('questions.question-upload-obj', compact('softwareVersion','collegeSetup','class',
    'dept','acad_sessions', 'examType'));

    }

    public function questionUploadObjAction(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'session' => 'required|string',
                'department' => 'required|string',
                'level' => 'required|string',
                'exam_category' => 'required|string',
                'exam_type' => 'required|string',   
                'duration' => 'required|string',
                'exam_date' => 'required|string', 
                'no_of_qst' => 'required|integer',     
            ]);                        

            // Check if the exam type already exists
        $existingQuestion = QuestionSetting::where('exam_type', $validatedData['exam_type'])
                                            ->where('exam_category', $validatedData['exam_category'])
                                            ->where('exam_mode', 'OBJECTIVES')
                                            ->where('department', $validatedData['department'])
                                            ->where('session1', $validatedData['session1'])
                                            ->where('no_of_qst', $validatedData['no_of_qst'])
                                            ->get();
        
        if ($existingQuestion) {
            // If the question already exists, redirect back with an error message
            return redirect()->route('question-upload-obj')->with('error', 'question already exists, you can edit.');
        }

            $questionSetting = QuestionSetting::create([
                'session1' => $validatedData['session1'],
                'department' => $validatedData['department'],
                'level' => $validatedData['level'],
                'exam_category' => $validatedData['exam_category'],
                'exam_type' => $validated['exam_type'],
                'exam_mode' => 'OBJECTIVES',
                'exam_status' => 'Inactive',
                'duration' => $validatedData['duration'],
                'exam_date' => $validatedData['exam_date'],                                            
            ]);

            $collegeSetup = CollegeSetup::first();
            $softwareVersion = SoftwareVersion::first();
        
            return view('questions.question-upload-obj-view', compact('softwareVersion','collegeSetup'));
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during question Upload: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during question Upload. Please try again.');
        }        
        
    }
}
