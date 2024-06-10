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
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Courses;
use App\Models\TheoryQuestion;

class QuestionController extends Controller
{
    //
    public function question()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();        

        return view('questions.question', compact('softwareVersion','collegeSetup'));        
    }

    public function questionObjUpload()
    {        
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('exam_mode', 'OBJECTIVE')
                         ->orderBy('created_at', 'desc')->Paginate(20);

        return view('questions.question-obj-upload', compact('softwareVersion','collegeSetup','questionSetting'));
    }

    public function questionUploadObj()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $level = CbtClass::orderBy('level')->get();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examType = ExamType::Paginate(10);
        $courseData = Courses::orderBy('course')->get();
        return view('questions.question-upload-obj', compact('softwareVersion','collegeSetup','level',
    'dept','acad_sessions', 'examType','courseData'));

    }

    public function questionUploadObjAction(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'department' => 'required|string',
                'level' => 'required|string',
                // 'exam_category' => 'required|string',
                'exam_type' => 'required|string',   
                'duration' => 'required|string',
                'exam_date' => 'required|string', 
                'upload_no_of_qst' => 'required|integer', 
                'no_of_qst' => 'required|integer',  
                'course' => 'required|string',   
                'semester' => 'required|string',
            ]);                        

            // Check if the exam type already exists
        $existingQuestion = QuestionSetting::where('exam_type', $validatedData['exam_type'])
                                            ->where('exam_category', 'GENERAL')
                                            ->where('exam_mode', 'OBJECTIVES')
                                            ->where('department', $validatedData['department'])
                                            ->where('level', $validatedData['level'])
                                            ->where('semester', $validatedData['semester'])
                                            ->where('session1', $validatedData['session1'])
                                            ->where('course', $validatedData['course'])
                                            ->where('upload_no_of_qst', $validatedData['upload_no_of_qst'])
                                            ->where('no_of_qst', $validatedData['no_of_qst'])
                                            ->first();
        
        if ($existingQuestion) {
            // If the question already exists, redirect back with an error message
            return redirect()->route('question-obj-upload')->with('error', 'Question already exists, you can only edit.');
        }
            //---Create a record for the question in the questionsetting table----
            $questionSetting = QuestionSetting::create([
                'session1' => $validatedData['session1'],
                'department' => $validatedData['department'],
                'level' => $validatedData['level'],
                'semester' => $validatedData['semester'],
                'exam_category' => 'GENERAL',
                'exam_type' => $validatedData['exam_type'],
                'exam_mode' => 'OBJECTIVE',
                'exam_status' => 'Inactive',
                'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                'no_of_qst' => $validatedData['no_of_qst'],
                'duration' => $validatedData['duration'],
                'exam_date' => date("Y-m-d", strtotime($validatedData['exam_date'])),  
                'course' => $validatedData['course'],  
                'check_result' => 1,                                         
            ]);

            //--Create a dummy question for the said no of question selected in the question table
            $num_questions = $validatedData['upload_no_of_qst'];
            for ($i = 1; $i <= $num_questions; $i++) {
                Question::create([
                    'question_no' => $i,
                    'question' => '<p style="font-size: 24px; font-family: Arial;">' .'Question'. $i . '</p>',
                    'exam_mode' => 'OBJECTIVE',
                    'exam_type' => $validatedData['exam_type'],
                    'exam_category' => 'GENERAL',
                    'session1' => $validatedData['session1'],
                    'department' => $validatedData['department'],
                    'level' => $validatedData['level'],
                    'semester' => $validatedData['semester'],
                    'course' => $validatedData['course'],
                    'no_of_qst' => $validatedData['no_of_qst'],
                    'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                    'question_type' => 'text',
                    'answer' => 'E',
                    'graphic' => 'blank.jpg',
                ]);
            }            
            
            $questionId = $questionSetting->id;
        
            return redirect()->route('question-view', ['questionId' => $questionId])->with('success', 'You can start to enter your questions.');
            
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during question Upload: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during question Upload. Please try again.');
        }        
        
    }

    public function questionView($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();

        $questionSetting = QuestionSetting::where('id', $id)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        $question = Question::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('semester', $semester)
        ->where('session1', $session1)
        ->where('course', $course)
        ->where('upload_no_of_qst', $upload_no_of_qst)
        ->where('no_of_qst', $no_of_qst)
        ->where('question_no', 1)
        ->first();

        if (!$question){
            return redirect()->back()->with('error', 'An error occurred. Please try again.');   
        }
        return view('questions.question-view', compact('softwareVersion', 'collegeSetup'
        ,'question','questionSetting'));
    }

    public function questionSave(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|string|in:previous,next,upload',
            'question' => 'nullable|string',
            'answer' => 'nullable|string',
            'currentQuestionNo' => 'required|integer',                
        ]);       

        $action = $request->input('action');     
        $question = $request->input('question');
        $answer = $request->input('answer');
        $currentQuestionNo = $request->input('currentQuestionNo');
        // Strip HTML tags from the question input
        $question = strip_tags($question);

        // Store question and answer data in the session
        Session::put('question', $question);
        Session::put('answer', $answer);
        Session::put('currentQuestionNo', $currentQuestionNo);        

        if ($action === 'previous') {            
            // Handle the previous action
            return $this->questionPrevious($id);
        } elseif ($action === 'next') {            
            // Handle the next action
            return $this->questionNext($id);
        }else {
            // Handle invalid action
            return response()->json(['error' => 'Invalid action'], 400);
        }
    }

    public function uploadQuestionImage(Request $request, $id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('id', $id)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;
        $semester = $questionSetting->semester;
        $course = $questionSetting->course;
        $currentQuestionNo = $request->input('currentQuestionNo');

        //----Update Current Question --------------------------------
        $questionUpdate = Question::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('semester', $semester)
        ->where('session1', $session1)
        ->where('course', $course)
        ->where('upload_no_of_qst', $upload_no_of_qst)
        ->where('no_of_qst', $no_of_qst)
        ->where('question_no', $currentQuestionNo)
        ->first();

        
        //Handle file upload
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = now()->timestamp . "_OBJ_" . $currentQuestionNo . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('questions'), $imageName);            

            $questionUpdate->update([
                'question_type' => "text-image",
                'graphic' => $imageName,
            ]);
            
            return redirect()->route('question-view', ['questionId' => $id])
            ->with('success', 'Image added successfully.');
        } else {
            return redirect()->route('question-view', ['questionId' => $id])
            ->with('error', 'please select a file to upload.');
        }

    }  


    public function questionNext($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('id', $id)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;
        $semester = $questionSetting->semester;
        $question = Session::get('question');
        $answer = Session::get('answer');
        $currentQuestionNo = Session::get('currentQuestionNo');
        $course = $questionSetting->course;

        // Check if current question number is less than total questions
        if ($currentQuestionNo < $upload_no_of_qst) { 
            
            //----Update Current Question --------------------------------
            $questionUpdate = Question::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('course', $course)
            ->where('upload_no_of_qst', $upload_no_of_qst)
            ->where('no_of_qst', $no_of_qst)
            ->where('question_no', $currentQuestionNo)
            ->first();

            $questionUpdate->update([
                'question' => '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>',
                'answer' => $answer,
            ]);

            // Increment question number
            $nextQuestionNo = $currentQuestionNo + 1;

            // Retrieve next question
            $question = Question::where('exam_type', $exam_type)
                ->where('exam_category', $exam_category)
                ->where('exam_mode', $exam_mode)
                ->where('department', $department)
                ->where('level', $level)
                ->where('semester', $semester)
                ->where('session1', $session1)
                ->where('upload_no_of_qst', $upload_no_of_qst)
                ->where('no_of_qst', $no_of_qst)
                ->where('course', $course)
                ->where('question_no', $nextQuestionNo)
                ->first();

            if (!$question) {
                return redirect()->route('question-view')->with('error', 'Next question not found.');
            }            

            return view('questions.question-view', compact('question','softwareVersion', 'collegeSetup',
        'questionSetting'));
        } else {
            //----Update Current Question --------------------------------
            $questionUpdate = Question::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('upload_no_of_qst', $upload_no_of_qst)
            ->where('no_of_qst', $no_of_qst)
            ->where('course', $course)
            ->where('question_no', $currentQuestionNo)
            ->first();

            $questionUpdate->update([
                'question' => '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>',
                'answer' => $answer,
            ]);
            return redirect()->route('question-view', ['questionId' => $id])->with('error', 'You have reached the last question.');
        }
    }

    public function questionPrevious($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('id', $id)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $level = $questionSetting->level;
        $session1 = $questionSetting->session1;
        $no_of_qst = $questionSetting->no_of_qst;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $question = Session::get('question');
        $answer = Session::get('answer');
        $currentQuestionNo = Session::get('currentQuestionNo');
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        // Check if current question number is greater than 1
        if ($currentQuestionNo > 1) {  

            //----Update Current Question --------------------------------
            $questionUpdate = Question::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('upload_no_of_qst', $upload_no_of_qst)
            ->where('no_of_qst', $no_of_qst)
            ->where('course', $course)
            ->where('question_no', $currentQuestionNo)
            ->first();

            $questionUpdate->update([
                'question' => '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>',
                'answer' => $answer,
            ]);

            // Decrement question number
            $previousQuestionNo = $currentQuestionNo - 1;

            // Retrieve previous question
            $question = Question::where('exam_type', $exam_type)
                ->where('exam_category', $exam_category)
                ->where('exam_mode', $exam_mode)
                ->where('department', $department)
                ->where('level', $level)
                ->where('semester', $semester)
                ->where('session1', $session1)
                ->where('upload_no_of_qst', $upload_no_of_qst)
                ->where('no_of_qst', $no_of_qst)
                ->where('course', $course)
                ->where('question_no', $previousQuestionNo)
                ->first();

            if (!$question) {
                return redirect()->route('question-view')->with('error', 'Previous question not found.');
            }

            return view('questions.question-view', compact('question','softwareVersion', 'collegeSetup',
            'questionSetting'));
        } else {
            //----Update Current Question --------------------------------
            $questionUpdate = Question::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('upload_no_of_qst', $upload_no_of_qst)
            ->where('no_of_qst', $no_of_qst)
            ->where('course', $course)
            ->where('question_no', $currentQuestionNo)
            ->first();

            $questionUpdate->update([
                'question' => '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>',
                'answer' => $answer,
            ]);
            return redirect()->route('question-view', ['questionId' => $id])->with('error', 'You are already at the first question.');
        }
    }

    public function questionSearch(Request $request, $id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('id', $id)->first();    
        
        $validatedData = $request->validate([                
            'qst_search' => 'required|integer',          
        ]);        
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $level = $questionSetting->level;
        $session1 = $questionSetting->session1;
        $no_of_qst = $questionSetting->no_of_qst;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $currentQuestionNo = $validatedData['qst_search'];
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        // Retrieve search question
        $question = Question::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('semester', $semester)
        ->where('session1', $session1)
        ->where('upload_no_of_qst', $upload_no_of_qst)
        ->where('no_of_qst', $no_of_qst)
        ->where('course', $course)
        ->where('question_no', $currentQuestionNo)
        ->first();

        if (!$question) {           
            return redirect()->route('question-view', [
                'id' => $id,
                // 'currentQuestionNo' => $currentQuestionNo
            ])->with('error', 'Search question not found.');
        }

        return view('questions.question-view', compact('question','softwareVersion', 'collegeSetup',
        'questionSetting'));        
    }

    public function questionSettingSearch(Request $request)
    {
        $searchTerm = $request->input('search');

        // Perform search query
        $questionSetting = QuestionSetting::where('session1', 'LIKE', "%{$searchTerm}%")
            ->orWhere('department', 'LIKE', "%{$searchTerm}%")
            ->orWhere('exam_mode', 'LIKE', "%{$searchTerm}%")
            ->orWhere('exam_type', 'LIKE', "%{$searchTerm}%")
            ->paginate(20);
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();        
        return view('questions.question-search', compact('softwareVersion','collegeSetup',
    'questionSetting'));
    }

    public function questionEnable($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve the question setting by ID
        $questionSetting = QuestionSetting::find($id);
        $currentExamStatus = $questionSetting->exam_status;

        // Check if the question setting exists
        if (!$questionSetting) {
            return redirect()->route('question-obj-upload')->with('error', 'Question setting not found.');
        }

        // Retrieve all records except the one with the given ID
        $inactiveQuestionSettings = QuestionSetting::where('id', '!=', $id)
            ->get();

        // Update all other records to be inactive
        foreach ($inactiveQuestionSettings as $inactiveQuestionSetting) {
            $inactiveQuestionSetting->update(['exam_status' => 'Inactive']);
        }

        // Update the specific record to be active
        $questionSetting->update(['exam_status' => 'Active']);

        //----Update current exam settings---
        $examSetting = ExamSetting::first();
        $examSetting->update([
            'level' => $questionSetting->level,
            'semester' => $questionSetting->semester,
            'course' => $questionSetting->course,
            'session1' => $questionSetting->session1,
            'department' => $questionSetting->department,
            'exam_type' => $questionSetting->exam_type,
            'exam_category' => $questionSetting->exam_category,
            'exam_mode' => $questionSetting->exam_mode,
            'upload_no_of_qst' => $questionSetting->upload_no_of_qst,
            'no_of_qst' => $questionSetting->no_of_qst,
            'duration' => $questionSetting->duration,
            'check_result' => $questionSetting->check_result,
        ]);

        if($currentExamStatus == 'Active') {
            return redirect()->route('question-obj-upload')->with('success', 'Question disabled successfully.');
        }
        return redirect()->route('question-obj-upload')->with('success', 'Question enabled successfully.');
    }

    public function deleteObjImage(Request $request, $id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionId = $request->input('questionId');
        $questionNo = $request->input('questionNo');
        $questionSetting = QuestionSetting::where('id', $questionId)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $level = $questionSetting->level;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst  = $questionSetting->no_of_qst;        
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        //----Update Current Question --------------------------------
        $questionUpdate = Question::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('semester', $semester)
        ->where('session1', $session1)
        ->where('course', $course)
        ->where('upload_no_of_qst', $upload_no_of_qst)
        ->where('no_of_qst', $no_of_qst)
        ->where('question_no', $questionNo)
        ->first();        

        $question_type = $questionUpdate->question_type;
        if($question_type === 'text'){
            return redirect()->route('question-view', ['questionId' => $questionId])->with('error', 'There is no image to delete.');
        }
        else{
        $questionUpdate->question_type = 'text';
        $questionUpdate->save();

        return redirect()->route('question-view', ['questionId' => $questionId])->with('success', 'Image deleted successfully.');
        }

        
    }

    public function downloadQuestionCsv()
    {
        $filePath = public_path('sample/question_objective.csv');

        return Response::download($filePath, 'question_objective_sample.csv', ['Content-Type' => 'text/csv']);
    }    
    
    public function questionUploadObjImportAction(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'department' => 'required|string',
                'level' => 'required|string',
                // 'exam_category' => 'required|string',
                'exam_type' => 'required|string',   
                'duration' => 'required|string',
                'exam_date' => 'required', 
                'upload_no_of_qst' => 'required|integer', 
                'no_of_qst' => 'required|integer',  
                'course' => 'required|string',   
                'semester' => 'required|string',
            ]);                        

            // Check if the exam type already exists
        $existingQuestion = QuestionSetting::where('exam_type', $validatedData['exam_type'])
                                            ->where('exam_category', 'GENERAL')
                                            ->where('exam_mode', 'OBJECTIVES')
                                            ->where('department', $validatedData['department'])
                                            ->where('level', $validatedData['level'])
                                            ->where('semester', $validatedData['semester'])
                                            ->where('session1', $validatedData['session1'])
                                            ->where('course', $validatedData['course'])
                                            ->where('upload_no_of_qst', $validatedData['upload_no_of_qst'])
                                            ->where('no_of_qst', $validatedData['no_of_qst'])
                                            ->first();
        
        if ($existingQuestion) {
            // If the question already exists, redirect back with an error message
            return redirect()->route('question-obj-upload')->with('error', 'Question already exists, you can only edit.');
        }
            //---Create a record for the question in the questionsetting table----
            $questionSetting = QuestionSetting::create([
                'session1' => $validatedData['session1'],
                'department' => $validatedData['department'],
                'level' => $validatedData['level'],
                'semester' => $validatedData['semester'],
                'exam_category' => 'GENERAL',
                'exam_type' => $validatedData['exam_type'],
                'exam_mode' => 'OBJECTIVE',
                'exam_status' => 'Inactive',
                'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                'no_of_qst' => $validatedData['no_of_qst'],
                'duration' => $validatedData['duration'],
                'exam_date' => date("Y-m-d", strtotime($validatedData['exam_date'])),  
                'course' => $validatedData['course'],   
                'check_result' => 1,                                       
            ]);

            //--Import all question for the said no of question selected in the question table
            $num_questions = $validatedData['upload_no_of_qst'];
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = $file->getRealPath();        
                    if (($handle = fopen($fileName, "r")) !== FALSE) {
                        $headers = fgetcsv($handle, 10000, ","); // Read headers
                        $question_no = 1;
                        while (($column = fgetcsv($handle, 10000, ",")) !== FALSE && $question_no <= $num_questions) {
                            $data = array_combine($headers, $column); // Combine headers with data                            
                            $data['question'] = mb_convert_encoding($data['question'], 'UTF-8', 'UTF-8');
                            // Insert data into database
                            $questionText = '<p style="font-size: 24px; font-family: Arial;">' . $data['question'] . '</p>';

                            // Now insert into the database with modified question text
                            DB::table('questions')->insert([
                                'question_no' => $question_no,
                                'question' => $questionText,
                                'answer' => $data['answer'],                    
                                'session1' => $validatedData['session1'],
                                'department' => $validatedData['department'],
                                'level' => $validatedData['level'],
                                'semester' => $validatedData['semester'],
                                'exam_category' => 'GENERAL',
                                'exam_type' => $validatedData['exam_type'],
                                'exam_mode' => 'OBJECTIVE',
                                'course' => $validatedData['course'],
                                'no_of_qst' => $validatedData['no_of_qst'],
                                'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                                'question_type' => 'text',
                                'graphic' => 'blank.jpg',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            
                            $question_no++; 
                        }
                        fclose($handle);
                    } else {
                        // Log or handle missing data
                    Log::warning('Missing data in row: ' . json_encode($row));
                    return redirect()->back()->with('error', 'Question import not successful.');
                    }  
                } else {
            
                    return redirect()->back()->with('error', 'No file was uploaded.');
                } 
                         
            
            $questionId = $questionSetting->id;
        
            return redirect()->route('question-view', ['questionId' => $questionId])->with('success', 'You can start editing your questions.');
            
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during question Upload: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during question Upload. Please try again.');
        }        
        
    }

    public function questionTheoryUpload()
    {        
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('exam_mode', 'THEORY')
                         ->orderBy('created_at', 'desc')->Paginate(20);

        return view('questions.question-theory-upload', compact('softwareVersion','collegeSetup','questionSetting'));
    }

    public function questionUploadTheory()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $level = CbtClass::orderBy('level')->get();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examType = ExamType::Paginate(10);
        $courseData = Courses::orderBy('course')->get();
        return view('questions.question-upload-theory', compact('softwareVersion','collegeSetup','level',
    'dept','acad_sessions', 'examType','courseData'));

    }

    public function questionUploadTheoryAction(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'department' => 'required|string',
                'level' => 'required|string',
                // 'exam_category' => 'required|string',
                'exam_type' => 'required|string',   
                'duration' => 'required|string',
                'exam_date' => 'required|string', 
                'upload_no_of_qst' => 'required|integer',  
                'no_of_qst' => 'required|integer', 
                'course' => 'required|string',   
                'semester' => 'required|string',
            ]);                        

            // Check if the exam type already exists
        $existingQuestion = QuestionSetting::where('exam_type', $validatedData['exam_type'])
                                            ->where('exam_category', 'GENERAL')
                                            ->where('exam_mode', 'THEORY')
                                            ->where('department', $validatedData['department'])
                                            ->where('level', $validatedData['level'])
                                            ->where('semester', $validatedData['semester'])
                                            ->where('session1', $validatedData['session1'])
                                            ->where('course', $validatedData['course'])                                            
                                            ->where('upload_no_of_qst', $validatedData['upload_no_of_qst'])
                                            ->where('no_of_qst', $validatedData['no_of_qst'])
                                            ->first();
        
        if ($existingQuestion) {
            // If the question already exists, redirect back with an error message
            return redirect()->route('question-theory-upload')->with('error', 'Question already exists, you can only edit.');
        }
            //---Create a record for the question in the questionsetting table----
            $questionSetting = QuestionSetting::create([
                'session1' => $validatedData['session1'],
                'department' => $validatedData['department'],
                'level' => $validatedData['level'],
                'semester' => $validatedData['semester'],
                'exam_category' => 'GENERAL',
                'exam_type' => $validatedData['exam_type'],
                'exam_mode' => 'THEORY',
                'exam_status' => 'Inactive',
                'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                'no_of_qst' => $validatedData['no_of_qst'],
                'duration' => $validatedData['duration'],
                'exam_date' => date("Y-m-d", strtotime($validatedData['exam_date'])),  
                'course' => $validatedData['course'],  
                'check_result' => 1,                                         
            ]);

            //--Create a dummy question for the said no of question selected in the question table
            $num_questions = $validatedData['upload_no_of_qst'];
            for ($i = 1; $i <= $num_questions; $i++) {
                TheoryQuestion::create([
                    'question_no' => $i,
                    'question' => '<p style="font-size: 24px; font-family: Arial;">' .'Question'. $i . '</p>',
                    'exam_mode' => 'THEORY',
                    'exam_type' => $validatedData['exam_type'],
                    'exam_category' => 'GENERAL',
                    'session1' => $validatedData['session1'],
                    'department' => $validatedData['department'],
                    'level' => $validatedData['level'],
                    'semester' => $validatedData['semester'],
                    'course' => $validatedData['course'],
                    'no_of_qst' => $validatedData['no_of_qst'],
                    'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                    'question_type' => 'text',
                    'graphic' => 'blank.jpg',
                ]);
            }            
            
            $questionId = $questionSetting->id;
        
            return redirect()->route('question-theory-view', ['questionId' => $questionId])->with('success', 'You can start to enter your questions.');
            
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during question Upload: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during question Upload. Please try again.');
        }        
        
    }

    public function downloadQuestionTheoryCsv()
    {
        $filePath = public_path('sample/question_theory.csv');

        return Response::download($filePath, 'question_theory_sample.csv', ['Content-Type' => 'text/csv']);
    }  

    public function questionTheoryView($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();

        $questionSetting = QuestionSetting::where('id', $id)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        $question = TheoryQuestion::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('semester', $semester)
        ->where('session1', $session1)
        ->where('course', $course)
        ->where('upload_no_of_qst', $upload_no_of_qst)
        ->where('no_of_qst', $no_of_qst)
        ->where('question_no', 1)
        ->first();        

        if (!$question){
            return redirect()->back()->with('error', 'An error occurred. Please try again.');     
        }
        return view('questions.question-theory-view', compact('softwareVersion', 'collegeSetup'
        ,'question','questionSetting'));
    }

    public function questionTheorySave(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|string|in:previous,next,upload',
            'question' => 'nullable|string',
            'currentQuestionNo' => 'required|integer',                
        ]);       

        $action = $request->input('action');     
        $question = $request->input('question');
        $currentQuestionNo = $request->input('currentQuestionNo');
        // Strip HTML tags from the question input
        $question = strip_tags($question);

        // Store question and answer data in the session
        Session::put('question', $question);
        Session::put('currentQuestionNo', $currentQuestionNo);        

        if ($action === 'previous') {            
            // Handle the previous action
            return $this->questionTheoryPrevious($id);
        } elseif ($action === 'next') {            
            // Handle the next action
            return $this->questionTheoryNext($id);
        } elseif ($action === 'delete') {            
            // Handle the next action
            return $this->deleteTheoryImage($id);
        }else {
            // Handle invalid action
            return response()->json(['error' => 'Invalid action'], 400);
        }
    }


    public function uploadQuestionTheoryImage(Request $request, $id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('id', $id)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;
        $semester = $questionSetting->semester;
        $course = $questionSetting->course;
        $currentQuestionNo = $request->input('currentQuestionNo');

        //----Update Current Question --------------------------------
        $questionUpdate = TheoryQuestion::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('semester', $semester)
        ->where('session1', $session1)
        ->where('course', $course)
        ->where('upload_no_of_qst', $upload_no_of_qst)
        ->where('no_of_qst', $no_of_qst)
        ->where('question_no', $currentQuestionNo)
        ->first();

        
        //Handle file upload
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = now()->timestamp . "_THEORY_" . $currentQuestionNo . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('questions'), $imageName);            

            $questionUpdate->update([
                'question_type' => "text-image",
                'graphic' => $imageName,
            ]);
            
            return redirect()->route('question-theory-view', ['questionId' => $id])
            ->with('success', 'Image added successfully.');
        } else {
            return redirect()->route('question-theory-view', ['questionId' => $id])
            ->with('error', 'please select a file to upload.');
        }

    }  


    public function questionTheoryNext($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('id', $id)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;
        $semester = $questionSetting->semester;
        $question = Session::get('question');
        $currentQuestionNo = Session::get('currentQuestionNo');
        $course = $questionSetting->course;

        // Check if current question number is less than total questions
        if ($currentQuestionNo < $upload_no_of_qst) { 
            
            //----Update Current Question --------------------------------
            $questionUpdate = TheoryQuestion::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('course', $course)
            ->where('upload_no_of_qst', $upload_no_of_qst)
            ->where('no_of_qst', $no_of_qst)
            ->where('question_no', $currentQuestionNo)
            ->first();

            $questionUpdate->update([
                'question' => '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>',
                
            ]);

            // Increment question number
            $nextQuestionNo = $currentQuestionNo + 1;

            // Retrieve next question
            $question = TheoryQuestion::where('exam_type', $exam_type)
                ->where('exam_category', $exam_category)
                ->where('exam_mode', $exam_mode)
                ->where('department', $department)
                ->where('level', $level)
                ->where('semester', $semester)
                ->where('session1', $session1)
                ->where('upload_no_of_qst', $upload_no_of_qst)
                ->where('no_of_qst', $no_of_qst)
                ->where('course', $course)
                ->where('question_no', $nextQuestionNo)
                ->first();

            if (!$question) {
                return redirect()->route('question-theory-view')->with('error', 'Next question not found.');
            }            

            return view('questions.question-theory-view', compact('question','softwareVersion', 'collegeSetup',
        'questionSetting'));
        } else {
            //----Update Current Question --------------------------------
            $questionUpdate = TheoryQuestion::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('upload_no_of_qst', $upload_no_of_qst)
            ->where('no_of_qst', $no_of_qst)
            ->where('course', $course)
            ->where('question_no', $currentQuestionNo)
            ->first();

            $questionUpdate->update([
                'question' => '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>',
                
            ]);
            return redirect()->route('question-theory-view', ['questionId' => $id])->with('error', 'You have reached the last question.');
        }
    }

    public function questionTheoryPrevious($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('id', $id)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $level = $questionSetting->level;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst = $questionSetting->no_of_qst;
        $question = Session::get('question');
        $currentQuestionNo = Session::get('currentQuestionNo');
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        // Check if current question number is greater than 1
        if ($currentQuestionNo > 1) {  

            //----Update Current Question --------------------------------
            $questionUpdate = TheoryQuestion::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('upload_no_of_qst', $upload_no_of_qst)
            ->where('no_of_qst', $no_of_qst)
            ->where('course', $course)
            ->where('question_no', $currentQuestionNo)
            ->first();

            $questionUpdate->update([
                'question' => '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>',
                
            ]);

            // Decrement question number
            $previousQuestionNo = $currentQuestionNo - 1;

            // Retrieve previous question
            $question = TheoryQuestion::where('exam_type', $exam_type)
                ->where('exam_category', $exam_category)
                ->where('exam_mode', $exam_mode)
                ->where('department', $department)
                ->where('level', $level)
                ->where('semester', $semester)
                ->where('session1', $session1)
                ->where('upload_no_of_qst', $upload_no_of_qst)
                ->where('no_of_qst', $no_of_qst)
                ->where('course', $course)
                ->where('question_no', $previousQuestionNo)
                ->first();

            if (!$question) {
                return redirect()->route('question-theory-view')->with('error', 'Previous question not found.');
            }

            return view('questions.question-theory-view', compact('question','softwareVersion', 'collegeSetup',
            'questionSetting'));
        } else {
            //----Update Current Question --------------------------------
            $questionUpdate = TheoryQuestion::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('upload_no_of_qst', $upload_no_of_qst)
            ->where('no_of_qst', $no_of_qst)
            ->where('course', $course)
            ->where('question_no', $currentQuestionNo)
            ->first();

            $questionUpdate->update([
                'question' => '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>',
                
            ]);
            return redirect()->route('question-theory-view', ['questionId' => $id])->with('error', 'You are already at the first question.');
        }
    }

    public function deleteTheoryImage(Request $request, $id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionId = $request->input('questionId');
        $questionNo = $request->input('questionNo');
        $questionSetting = QuestionSetting::where('id', $questionId)->first();       
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $level = $questionSetting->level;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;  
        $no_of_qst = $questionSetting->no_of_qst;
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        //----Update Current Question --------------------------------
        $questionUpdate = TheoryQuestion::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('semester', $semester)
        ->where('session1', $session1)
        ->where('course', $course)
        ->where('upload_no_of_qst', $upload_no_of_qst)
        ->where('no_of_qst', $no_of_qst)
        ->where('question_no', $questionNo)
        ->first();        

        $question_type = $questionUpdate->question_type;
        if($question_type === 'text'){
            return redirect()->route('question-theory-view', ['questionId' => $questionId])->with('error', 'There is no image to delete.');
        }
        else{
        $questionUpdate->question_type = 'text';
        $questionUpdate->save();

        return redirect()->route('question-theory-view', ['questionId' => $questionId])->with('success', 'Image deleted successfully.');
        }

        
    }

    public function questionTheorySearch(Request $request, $id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('id', $id)->first();    
        
        $validatedData = $request->validate([                
            'qst_search' => 'required|integer',          
        ]);        
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $level = $questionSetting->level;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->upload_no_of_qst;
        $no_of_qst = $questionSetting->no_of_qst;
        $currentQuestionNo = $validatedData['qst_search'];
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        // Retrieve search question
        $question = TheoryQuestion::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('semester', $semester)
        ->where('session1', $session1)
        ->where('upload_no_of_qst', $upload_no_of_qst)
        ->where('no_of_qst', $no_of_qst)
        ->where('course', $course)
        ->where('question_no', $currentQuestionNo)
        ->first();

        if (!$question) {           
            return redirect()->route('question-theory-view', [
                'questionId' => $id,
                // 'currentQuestionNo' => $currentQuestionNo
            ])->with('error', 'Search question not found.');
        }

        return view('questions.question-theory-view', compact('question','softwareVersion', 'collegeSetup',
        'questionSetting'));        
    }

    public function questionTheoryEnable($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve the question setting by ID
        $questionSetting = QuestionSetting::find($id);
        $currentExamStatus = $questionSetting->exam_status;

        // Check if the question setting exists
        if (!$questionSetting) {
            return redirect()->route('question-theory-upload')->with('error', 'Question setting not found.');
        }

        // Retrieve all records except the one with the given ID
        $inactiveQuestionSettings = QuestionSetting::where('id', '!=', $id)
            ->get();

        // Update all other records to be inactive
        foreach ($inactiveQuestionSettings as $inactiveQuestionSetting) {
            $inactiveQuestionSetting->update(['exam_status' => 'Inactive']);
        }

        // Update the specific record to be active
        $questionSetting->update(['exam_status' => 'Active']);

        //----Update current exam settings---
        $examSetting = ExamSetting::first();
        $examSetting->update([
            'level' => $questionSetting->level,
            'semester' => $questionSetting->semester,
            'course' => $questionSetting->course,
            'session1' => $questionSetting->session1,
            'department' => $questionSetting->department,
            'exam_type' => $questionSetting->exam_type,
            'exam_category' => $questionSetting->exam_category,
            'exam_mode' => $questionSetting->exam_mode,
            'upload_no_of_qst' => $questionSetting->upload_no_of_qst,
            'no_of_qst' => $questionSetting->no_of_qst,
            'duration' => $questionSetting->duration,
            'check_result' => $questionSetting->check_result,
        ]);

        if($currentExamStatus == 'Active') {
            return redirect()->route('question-theory-upload')->with('success', 'Question disabled successfully.');
        }
        return redirect()->route('question-theory-upload')->with('success', 'Question enabled successfully.');
    }

    public function questionUploadTheoryImportAction(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'department' => 'required|string',
                'level' => 'required|string',
                // 'exam_category' => 'required|string',
                'exam_type' => 'required|string',   
                'duration' => 'required|string',
                'exam_date' => 'required', 
                'upload_no_of_qst' => 'required|integer', 
                'no_of_qst' => 'required|integer',  
                'course' => 'required|string',   
                'semester' => 'required|string',
            ]);                        

            // Check if the exam type already exists
        $existingQuestion = QuestionSetting::where('exam_type', $validatedData['exam_type'])
                                            ->where('exam_category', 'GENERAL')
                                            ->where('exam_mode', 'OBJECTIVES')
                                            ->where('department', $validatedData['department'])
                                            ->where('level', $validatedData['level'])
                                            ->where('semester', $validatedData['semester'])
                                            ->where('session1', $validatedData['session1'])
                                            ->where('course', $validatedData['course'])
                                            ->where('upload_no_of_qst', $validatedData['upload_no_of_qst'])
                                            ->where('no_of_qst', $validatedData['no_of_qst'])
                                            ->first();
        
        if ($existingQuestion) {
            // If the question already exists, redirect back with an error message
            return redirect()->route('question-theory-upload')->with('error', 'Question already exists, you can only edit.');
        }
            //---Create a record for the question in the questionsetting table----
            $questionSetting = QuestionSetting::create([
                'session1' => $validatedData['session1'],
                'department' => $validatedData['department'],
                'level' => $validatedData['level'],
                'semester' => $validatedData['semester'],
                'exam_category' => 'GENERAL',
                'exam_type' => $validatedData['exam_type'],
                'exam_mode' => 'THEORY',
                'exam_status' => 'Inactive',
                'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                'no_of_qst' => $validatedData['no_of_qst'],
                'duration' => $validatedData['duration'],
                'exam_date' => date("Y-m-d", strtotime($validatedData['exam_date'])),  
                'course' => $validatedData['course'],   
                'check_result' => 1,                                       
            ]);

            //--Import all question for the said no of question selected in the question table
            $num_questions = $validatedData['upload_no_of_qst'];
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = $file->getRealPath();        
                    if (($handle = fopen($fileName, "r")) !== FALSE) {
                        $headers = fgetcsv($handle, 10000, ","); // Read headers
                        $question_no = 1;
                        while (($column = fgetcsv($handle, 10000, ",")) !== FALSE && $question_no <= $num_questions) {
                            $data = array_combine($headers, $column); // Combine headers with data                            
                            $data['question'] = mb_convert_encoding($data['question'], 'UTF-8', 'UTF-8');
                            // Insert data into database
                            $questionText = '<p style="font-size: 24px; font-family: Arial;">' . $data['question'] . '</p>';

                            // Now insert into the database with modified question text
                            DB::table('theory_questions')->insert([
                                'question_no' => $question_no,
                                'question' => $questionText,                   
                                'session1' => $validatedData['session1'],
                                'department' => $validatedData['department'],
                                'level' => $validatedData['level'],
                                'semester' => $validatedData['semester'],
                                'exam_category' => 'GENERAL',
                                'exam_type' => $validatedData['exam_type'],
                                'exam_mode' => 'THEORY',
                                'course' => $validatedData['course'],
                                'no_of_qst' => $validatedData['no_of_qst'],
                                'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                                'question_type' => 'text',
                                'graphic' => 'blank.jpg',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            
                            $question_no++; 
                        }
                        fclose($handle);
                    } else {
                        // Log or handle missing data
                    Log::warning('Missing data in row: ' . json_encode($row));
                    return redirect()->back()->with('error', 'Question import not successful.');
                    }  
                } else {
            
                    return redirect()->back()->with('error', 'No file was uploaded.');
                } 
                         
            
            $questionId = $questionSetting->id;
        
            return redirect()->route('question-theory-view', ['questionId' => $questionId])->with('success', 'You can start editing your questions.');
            
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
