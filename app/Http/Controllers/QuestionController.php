<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use App\Models\User;
use App\Models\Department;
use App\Models\Question;
use App\Models\QuestionSingle;
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
        //--Check for permission---
        $userStatus = auth()->user()->qst_bank;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access QUESTION BANK module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();

        return view('questions.question', compact('softwareVersion','collegeSetup'));        
    }

    public function questionObjUpload()
    {   
        //--Check for permission---
        $userStatus = auth()->user()->qst_bank;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access questions in the QUESTION BANK module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('exam_mode', 'OBJECTIVE')
                            ->orderBy('exam_status', 'asc')
                            ->orderBy('created_at', 'asc')
                            ->Paginate(20);        

        return view('questions.question-obj-upload', compact('softwareVersion','collegeSetup','questionSetting'));
    }

    public function questionUploadObj()
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_question_bank;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE questions in the QUESTION BANK module, contact the Administrator to grant access.');
        }

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
                'exam_view_type' => 'required|string',
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
                                            ->where('exam_view_type', $validatedData['exam_view_type'])
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
                'exam_view_type' => $validatedData['exam_view_type'],
                'exam_mode' => 'OBJECTIVE',
                'exam_status' => 'Inactive',
                'upload_no_of_qst' => $validatedData['upload_no_of_qst'],
                'no_of_qst' => $validatedData['no_of_qst'],
                'duration' => $validatedData['duration'],
                'exam_date' => date("Y-m-d", strtotime($validatedData['exam_date'])),  
                'course' => $validatedData['course'],  
                'check_result' => 1,   
                'lock_status' => 0,                                      
            ]);

            //check the exam vie type-----
            if($validatedData['exam_view_type'] == 'Multi-Page'){
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
            }
            elseif($validatedData['exam_view_type'] == 'Single-Page'){
                //--Create a dummy question for the said no of question selected in the question table
                $num_questions = $validatedData['upload_no_of_qst'];
                for ($i = 1; $i <= $num_questions; $i++) {
                    QuestionSingle::create([
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
                        'option_a' => '<p style="font-size: 20px; font-family: Arial;">' .'Option A'. $i . '</p>',
                        'option_b' => '<p style="font-size: 20px; font-family: Arial;">' .'Option B'. $i . '</p>',
                        'option_c' => '<p style="font-size: 20px; font-family: Arial;">' .'Option C'. $i . '</p>',
                        'option_d' => '<p style="font-size: 20px; font-family: Arial;">' .'Option D'. $i . '</p>',
                        'graphic' => 'blank.jpg',
                    ]);
                }            
                
                $questionId = $questionSetting->id;
            
                return redirect()->route('question-view', ['questionId' => $questionId])->with('success', 'You can start to enter your questions.');
            }
            
            
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
        //--Check for permission---
        $userStatus = auth()->user()->edit_question_bank;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            EDIT questions in the QUESTION BANK module, contact the Administrator to grant access.');
        }

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
        $examViewType = $questionSetting->exam_view_type;

        if($examViewType == 'Multi-Page'){
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
        }
        elseif($examViewType == 'Single-Page'){
            $question = QuestionSingle::where('exam_type', $exam_type)
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
        }
        

        if (!$question){
            return redirect()->back()->with('error', 'An error occurred. Please try again.');   
        }
        
        if($examViewType == 'Multi-Page'){
            return view('questions.question-view', compact('softwareVersion', 'collegeSetup'
            ,'question','questionSetting'));
        }
        elseif($examViewType == 'Single-Page'){
            return view('questions.question-view-single', compact('softwareVersion', 'collegeSetup'
            ,'question','questionSetting'));
        }
        
    }

    public function questionSave(Request $request, $id)
    {
        $questionSetting = QuestionSetting::where('id', $id)->first();

        if($questionSetting->exam_view_type == 'Multi-Page'){
            $request->validate([
                'action' => 'required|string|in:previous,next,upload',
                'question' => 'nullable|string',
                'answer' => 'nullable|string',
                'currentQuestionNo' => 'required|integer',                
            ]);       
    
            $action = $request->input('action');     
            $question = $request->input('question');
            $formattedQuestion = '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>';
            $answer = $request->input('answer');
            $currentQuestionNo = $request->input('currentQuestionNo');
            // Store question and answer data in the session   
            Session::put('question', $formattedQuestion);
            Session::put('answer', $answer);
            Session::put('currentQuestionNo', $currentQuestionNo); 
        }
        elseif($questionSetting->exam_view_type == 'Single-Page'){
            $request->validate([
                'action' => 'required|string|in:previous,next,upload',
                'question' => 'nullable|string',
                'answer' => 'nullable|string',
                'option_a' => 'required|string',
                'option_b' => 'required|string',
                'option_c' => 'required|string',
                'option_d' => 'required|string',
                'currentQuestionNo' => 'required|integer',                
            ]);       
    
            $action = $request->input('action');  
            $question = strip_tags($request->input('question')); 
            $formattedQuestion = '<p style="font-size: 24px; font-family: Arial;">' . $question . '</p>';
            // $question = $request->input('question');
            $answer = $request->input('answer'); 
            $formattedOptionA = '<p style="font-size: 20px; font-family: Arial;">' . $request->input('option_a') . '</p>';
            $formattedOptionB = '<p style="font-size: 20px; font-family: Arial;">' . $request->input('option_b') . '</p>';
            $formattedOptionC = '<p style="font-size: 20px; font-family: Arial;">' . $request->input('option_c') . '</p>';
            $formattedOptionD = '<p style="font-size: 20px; font-family: Arial;">' . $request->input('option_d') . '</p>';           
            $currentQuestionNo = $request->input('currentQuestionNo');
            // Store question and answer data in the session   
            Session::put('question', $formattedQuestion);
            Session::put('answer', $answer);
            Session::put('option_a', $formattedOptionA);
            Session::put('option_b', $formattedOptionB);
            Session::put('option_c', $formattedOptionC);
            Session::put('option_d', $formattedOptionD);
            Session::put('currentQuestionNo', $currentQuestionNo); 
        }        
        

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
        $examViewType = $questionSetting->exam_view_type;

        // Check if current question number is less than total questions
        if($examViewType == 'Multi-Page'){
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
                    'question' =>  $question,
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
                    return redirect()->route('question-view', ['questionId' => $id])->with('error', 'Next question not found.');
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
                    'question' => $question ,
                    'answer' => $answer,
                ]);
                return redirect()->route('question-view', ['questionId' => $id])->with('error', 'You have reached the last question.');
            }
        }
        elseif($examViewType == 'Single-Page') {
            if ($currentQuestionNo < $upload_no_of_qst) { 
            
                //----Update Current Question --------------------------------
                $questionUpdate = QuestionSingle::where('exam_type', $exam_type)
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
                    'question' => $question,
                    'answer' => $answer,
                    'option_a' => Session::get('option_a'),
                    'option_b' => Session::get('option_b'),
                    'option_c' => Session::get('option_c'),
                    'option_d' => Session::get('option_d'),
                ]);
    
                // Increment question number
                $nextQuestionNo = $currentQuestionNo + 1;
    
                // Retrieve next question
                $question = QuestionSingle::where('exam_type', $exam_type)
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
                    return redirect()->route('question-view', ['questionId' => $id])->with('error', 'Next question not found.');
                }            
    
                return view('questions.question-view-single', compact('question','softwareVersion', 'collegeSetup',
            'questionSetting'));
            } else {
                //----Update Current Question --------------------------------
                $questionUpdate = QuestionSingle::where('exam_type', $exam_type)
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
                    'question' => $question,
                    'answer' => $answer,
                    'option_a' => Session::get('option_a'),
                    'option_b' => Session::get('option_b'),
                    'option_c' => Session::get('option_c'),
                    'option_d' => Session::get('option_d'),
                ]);
                return redirect()->route('question-view', ['questionId' => $id])->with('error', 'You have reached the last question.');
            }
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
        $examViewType = $questionSetting->exam_view_type;

        // Check if current question number is greater than 1
        if($examViewType == 'Multi-Page'){
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
                    'question' => $question,
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
                    return redirect()->route('question-view', ['questionId' => $id])->with('error', 'Previous question not found.');
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
                    'question' => $question,
                    'answer' => $answer,
                ]);
                return redirect()->route('question-view', ['questionId' => $id])->with('error', 'You are already at the first question.');
            }
        }
        elseif($examViewType == 'Single-Page') {
            if ($currentQuestionNo > 1) {  

                //----Update Current Question --------------------------------
                $questionUpdate = QuestionSingle::where('exam_type', $exam_type)
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
                    'question' => $question,
                    'answer' => $answer,
                    'option_a' => Session::get('option_a'),
                    'option_b' => Session::get('option_b'),
                    'option_c' => Session::get('option_c'),
                    'option_d' => Session::get('option_d'),
                ]);
    
                // Decrement question number
                $previousQuestionNo = $currentQuestionNo - 1;
    
                // Retrieve previous question
                $question = QuestionSingle::where('exam_type', $exam_type)
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
                    return redirect()->route('question-view', ['questionId' => $id])->with('error', 'Previous question not found.');
                }
    
                return view('questions.question-view-single', compact('question','softwareVersion', 'collegeSetup',
                'questionSetting'));
            } else {
                //----Update Current Question --------------------------------
                $questionUpdate = QuestionSingle::where('exam_type', $exam_type)
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
                    'question' => $question,
                    'answer' => $answer,
                    'option_a' => Session::get('option_a'),
                    'option_b' => Session::get('option_b'),
                    'option_c' => Session::get('option_c'),
                    'option_d' => Session::get('option_d'),
                ]);
                return redirect()->route('question-view', ['questionId' => $id])->with('error', 'You are already at the first question.');
            }
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
        $examViewType = $questionSetting->exam_view_type;

        if($examViewType == 'Multi-Page'){
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
        elseif($examViewType == 'Single-Page'){
             // Retrieve search question
        $question = QuestionSingle::where('exam_type', $exam_type)
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

        return view('questions.question-view-single', compact('question','softwareVersion', 'collegeSetup',
        'questionSetting'));        
        }
       
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

        // Check if the question setting exists
        if (!$questionSetting) {
            return redirect()->route('question-obj-upload')->with('error', 'Question setting not found.');
        }

        // Update all other question settings with the same department and level to be inactive
        QuestionSetting::where('department', $questionSetting->department)
            ->where('level', $questionSetting->level)
            ->where('id', '!=', $id)
            ->update(['exam_status' => 'Inactive']);

        // Set the clicked question setting to active
        $questionSetting->update(['exam_status' => 'Active']);

        // Check if an exam setting already exists for the given department and level
        $existingExamSetting = ExamSetting::where('department', $questionSetting->department)
            ->where('level', $questionSetting->level)
            ->exists();

        if ($existingExamSetting) {
            // Update the existing exam setting with the provided variables
            ExamSetting::where('department', $questionSetting->department)
                ->where('level', $questionSetting->level)
                ->update([
                    'semester' => $questionSetting->semester,
                    'course' => $questionSetting->course,
                    'session1' => $questionSetting->session1,
                    'exam_type' => $questionSetting->exam_type,
                    'exam_category' => $questionSetting->exam_category,
                    'exam_mode' => $questionSetting->exam_mode,
                    'upload_no_of_qst' => $questionSetting->upload_no_of_qst,
                    'no_of_qst' => $questionSetting->no_of_qst,
                    'duration' => $questionSetting->duration,
                    'check_result' => $questionSetting->check_result,
                    'exam_date' => $questionSetting->exam_date,
                    'lock_status' => $questionSetting->lock_status,
                ]);
        } else {
            // Create a new exam setting with the provided variables
            ExamSetting::create([
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
                'time_limit' => 10,
                'lock_status' => $questionSetting->lock_status,
            ]);
        }

        return redirect()->route('question-obj-upload')->with('success', 'Exam setting enabled successfully.');
    }


    public function downloadQuestionCsv()
    {
        $filePath = public_path('sample/question_objective.csv');

        return Response::download($filePath, 'question_objective_sample.csv', ['Content-Type' => 'text/csv']);
    }  
    
    public function downloadQuestionSingleCsv()
    {
        $filePath = public_path('sample/question_objective_single.csv');

        return Response::download($filePath, 'question_objective_single_page_sample.csv', ['Content-Type' => 'text/csv']);
    }  
    
    public function questionUploadObjImportAction(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'department' => 'required|string',
                'level' => 'required|string',
                'exam_view_type' => 'required|string',
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
                                            ->where('exam_view_type', $validatedData['exam_view_type'])
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
                'exam_view_type' => $validatedData['exam_view_type'],
                'check_result' => 1,       
                'lock_status' => 0,                                
            ]);

            //----Check the exam view type------
            if ($validatedData['exam_view_type'] == 'Multi-Page') {
                 // Import all question for the said no of question selected in the question table
                $num_questions = $validatedData['upload_no_of_qst'];
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = $file->getRealPath();
                    if (($handle = fopen($fileName, "r")) !== FALSE) {
                        $headers = fgetcsv($handle, 10000, ","); // Read headers
                        $question_no = 1;
                        while (($column = fgetcsv($handle, 10000, ",")) !== FALSE && $question_no <= $num_questions) {
                            $data = array_combine($headers, $column); // Combine headers with data
    
                            // Clean up question text and maintain line breaks
                            $questionText = nl2br(mb_convert_encoding($data['question'], 'UTF-8', 'UTF-8'));
    
                            // Format the question text for better display
                            $formattedQuestion = '<p style="font-size: 24px; font-family: Arial;">' . $questionText . '</p>';
    
                            // Insert data into database
                            DB::table('questions')->insert([
                                'question_no' => $question_no,
                                'question' => $formattedQuestion,
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

                return redirect()->route('question-view', ['questionId' => $questionId])
                ->with('success', 'You can start editing your questions.');
            }
            elseif ($validatedData['exam_view_type'] == 'Single-Page') {
                 // Import all question for the said no of question selected in the question table
                $num_questions = $validatedData['upload_no_of_qst'];
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = $file->getRealPath();
                    if (($handle = fopen($fileName, "r")) !== FALSE) {
                        $headers = fgetcsv($handle, 10000, ","); // Read headers
                        $question_no = 1;
                        while (($column = fgetcsv($handle, 10000, ",")) !== FALSE && $question_no <= $num_questions) {
                            $data = array_combine($headers, $column); // Combine headers with data
    
                            // Clean up question text and maintain line breaks
                            $questionText = nl2br(mb_convert_encoding($data['question'], 'UTF-8', 'UTF-8'));
                            $optionA = nl2br(mb_convert_encoding($data['option_a'], 'UTF-8', 'UTF-8'));
                            $optionB = nl2br(mb_convert_encoding($data['option_b'], 'UTF-8', 'UTF-8'));
                            $optionC = nl2br(mb_convert_encoding($data['option_c'], 'UTF-8', 'UTF-8'));
                            $optionD = nl2br(mb_convert_encoding($data['option_d'], 'UTF-8', 'UTF-8'));

                            // Format the question text for better display
                            $formattedQuestion = '<p style="font-size: 24px; font-family: Arial;">' . $questionText . '</p>';
                            $formattedOptionA = '<p style="font-size: 20px; font-family: Arial;">' . $optionA . '</p>';
                            $formattedOptionB = '<p style="font-size: 20px; font-family: Arial;">' . $optionB . '</p>';
                            $formattedOptionC = '<p style="font-size: 20px; font-family: Arial;">' . $optionC . '</p>';
                            $formattedOptionD = '<p style="font-size: 20px; font-family: Arial;">' . $optionD . '</p>';
    
                            // Insert data into database
                            DB::table('question_singles')->insert([
                                'question_no' => $question_no,
                                'question' => $formattedQuestion,
                                'answer' => $data['answer'],
                                'option_a' => $formattedOptionA,
                                'option_b' => $formattedOptionB,
                                'option_c' => $formattedOptionC,
                                'option_d' => $formattedOptionD,
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
            }

            $questionId = $questionSetting->id;

            return redirect()->route('question-view', ['questionId' => $questionId])
            ->with('success', 'You can start editing your questions.');             
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
        //--Check for permission---
        $userStatus = auth()->user()->qst_bank;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            access questions in the QUESTION BANK module, contact the Administrator to grant access.');
        }

        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::where('exam_mode', 'THEORY')
                         ->orderBy('exam_status', 'asc')
                         ->orderBy('created_at', 'asc')
                         ->Paginate(20);

        return view('questions.question-theory-upload', compact('softwareVersion','collegeSetup','questionSetting'));
    }

    public function questionUploadTheory()
    {
        //--Check for permission---
        $userStatus = auth()->user()->create_question_bank;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            CREATE questions in the QUESTION BANK module, contact the Administrator to grant access.');
        }

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
                'lock_status' => 0,                                      
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
        //--Check for permission---
        $userStatus = auth()->user()->edit_question_bank;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            EDIT questions in the QUESTION BANK module, contact the Administrator to grant access.');
        }

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
        //$question = strip_tags($question);

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
                'question' =>  $question,
                
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
                'question' =>  $question,
                
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
                'question' => $question,
                
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
                'question' => $question,
                
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

        // Check if the question setting exists
        if (!$questionSetting) {
            return redirect()->route('question-theory-upload')->with('error', 'Question setting not found.');
        }

        // Update all other question settings with the same department and level to be inactive
        QuestionSetting::where('department', $questionSetting->department)
            ->where('level', $questionSetting->level)
            ->where('id', '!=', $id)
            ->update(['exam_status' => 'Inactive']);

        // Set the clicked question setting to active
        $questionSetting->update(['exam_status' => 'Active']);

        // Check if an exam setting already exists for the given department and level
        $existingExamSetting = ExamSetting::where('department', $questionSetting->department)
            ->where('level', $questionSetting->level)
            ->exists();

        if ($existingExamSetting) {
            // Update the existing exam setting with the provided variables
            ExamSetting::where('department', $questionSetting->department)
                ->where('level', $questionSetting->level)
                ->update([
                    'semester' => $questionSetting->semester,
                    'course' => $questionSetting->course,
                    'session1' => $questionSetting->session1,
                    'exam_type' => $questionSetting->exam_type,
                    'exam_category' => $questionSetting->exam_category,
                    'exam_mode' => $questionSetting->exam_mode,
                    'upload_no_of_qst' => $questionSetting->upload_no_of_qst,
                    'no_of_qst' => $questionSetting->no_of_qst,
                    'duration' => $questionSetting->duration,
                    'check_result' => $questionSetting->check_result,
                    'exam_date' => $questionSetting->exam_date,
                    'lock_status' => $questionSetting->lock_status,
                ]);
        } else {
            // Create a new exam setting with the provided variables
            ExamSetting::create([
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
                'time_limit' => 10,
                'lock_status' => $questionSetting->lock_status,
            ]);
        }

        return redirect()->route('question-theory-upload')->with('success', 'Exam setting enabled successfully.');
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
                'lock_status' => 0, 
                                                 
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
                             // Clean up question text and maintain line breaks
                            $questionText = nl2br(mb_convert_encoding($data['question'], 'UTF-8', 'UTF-8'));

                            // Format the question text for better display
                            $formattedQuestion = '<p style="font-size: 24px; font-family: Arial;">' . $questionText . '</p>';

                            // Now insert into the database with modified question text
                            DB::table('theory_questions')->insert([
                                'question_no' => $question_no,
                                'question' => $formattedQuestion,                   
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

    public function questionUploadFillGap()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $level = CbtClass::orderBy('level')->get();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examType = ExamType::Paginate(10);
        $courseData = Courses::orderBy('course')->get();

        //--Check for permission---
        $userStatus = auth()->user()->qst_bank;
        if($userStatus == 0){
            return redirect()->route('admin-dashboard')->with('error', 'You do not have permission, to 
            create questions in the QUESTION BANK module, contact the Administrator to grant access.');
        }

        return redirect()->back()->with('success', 'This module is under development.');
    }

}
