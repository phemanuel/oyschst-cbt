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

class QuestionController extends Controller
{
    //
    public function question()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $questionSetting = QuestionSetting::orderBy('created_at', 'desc')->Paginate(20)
        ;

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
        $level = CbtClass::orderBy('level')->get();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examType = ExamType::Paginate(10);
        return view('questions.question-upload-obj', compact('softwareVersion','collegeSetup','level',
    'dept','acad_sessions', 'examType'));

    }

    public function questionUploadObjAction(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'department' => 'required|string',
                'level' => 'required|string',
                'exam_category' => 'required|string',
                'exam_type' => 'required|string',   
                'duration' => 'required|string',
                'exam_date' => 'required|string', 
                'no_of_qst' => 'required|integer',  
                'course' => 'required|string',    
            ]);                        

            // Check if the exam type already exists
        $existingQuestion = QuestionSetting::where('exam_type', $validatedData['exam_type'])
                                            ->where('exam_category', $validatedData['exam_category'])
                                            ->where('exam_mode', 'OBJECTIVES')
                                            ->where('department', $validatedData['department'])
                                            ->where('level', $validatedData['level'])
                                            ->where('session1', $validatedData['session1'])
                                            ->where('course', $validatedData['course'])
                                            ->where('no_of_qst', $validatedData['no_of_qst'])
                                            ->first();
        
        if ($existingQuestion) {
            // If the question already exists, redirect back with an error message
            return redirect()->route('question')->with('error', 'Question already exists, you can only edit.');
        }
            //---Create a record for the question in the questionsetting table----
            $questionSetting = QuestionSetting::create([
                'session1' => $validatedData['session1'],
                'department' => $validatedData['department'],
                'level' => $validatedData['level'],
                'exam_category' => $validatedData['exam_category'],
                'exam_type' => $validatedData['exam_type'],
                'exam_mode' => 'OBJECTIVE',
                'exam_status' => 'Inactive',
                'no_of_qst' => $validatedData['no_of_qst'],
                'duration' => $validatedData['duration'],
                'exam_date' => date("Y-m-d", strtotime($validatedData['exam_date'])),  
                'course' => $validatedData['course'],  
                'check_result' => 1,                                         
            ]);

            //--Create a dummy question for the said no of question selected in the question table
            $num_questions = $validatedData['no_of_qst'];
            for ($i = 1; $i <= $num_questions; $i++) {
                Question::create([
                    'question_no' => $i,
                    'question' => "Question".$i,
                    'exam_mode' => 'OBJECTIVE',
                    'exam_type' => $validatedData['exam_type'],
                    'exam_category' => $validatedData['exam_category'],
                    'session1' => $validatedData['session1'],
                    'department' => $validatedData['department'],
                    'level' => $validatedData['level'],
                    'course' => $validatedData['course'],
                    'no_of_qst' => $validatedData['no_of_qst'],
                    'upload_no_of_qst' => $validatedData['no_of_qst'],
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
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;
        $course = $questionSetting->course;

        $question = Question::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('session1', $session1)
        ->where('course', $course)
        ->where('no_of_qst', $no_of_qst)
        ->where('question_no', 1)
        ->first();

        if (!$question){
            return view('question')->with('error', 'An error occurred. Please try again.');   
        }
        return view('questions.question-view', compact('softwareVersion', 'collegeSetup'
        ,'question','questionSetting'));
    }

    public function questionSave(Request $request , $id)
    {
        $action = $request->input('action');
        $question = $request->input('question');
        $answer = $request->input('answer');
        $currentQuestionNo = $request->input('currentQuestionNo');
        $file = $request->input('file');

        $question = strip_tags($question);
        
        //---Keep Question and Answer data
        Session::put('question', $question);
        Session::put('answer', $answer);
        Session::put('currentQuestionNo', $currentQuestionNo);        
    
        if ($action == 'previous') {
            // Call the function to handle previous action
            return $this->questionPrevious($id);
        } elseif ($action == 'next') {
            // Call the function to handle next action
            return $this->questionNext($id);
        } elseif ($action == 'upload') {
            //---Upload question image
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = now() . "_" . $currentQuestionNo . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('questions'), $imageName);  
                Session::put('imageName', $imageName);                           
            }
            // Call the function to handle next action
            return $this->uploadQuestionImage($id);
        } else {
            // Handle other actions or default behavior
            // For example, return a response indicating an invalid action
            return response()->json(['error' => 'Invalid action'], 400);
        }
    }

    public function uploadQuestionImage($id)
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
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;        
        $currentQuestionNo = Session::get('currentQuestionNo');  
        $imageName = Session::get('imageName');      
        $course = $questionSetting->course;

        //----Update Current Question --------------------------------
        $questionUpdate = Question::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('session1', $session1)
        ->where('course', $course)
        ->where('no_of_qst', $no_of_qst)
        ->where('question_no', $currentQuestionNo)
        ->first();         

        $questionUpdate->update([
            'question_type' => "text-image",
            'graphic' => $imageName,
        ]);
        
        return redirect()->route('question-view', ['questionId' => $id])
        ->with('success', 'Image added successfully.');
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
        $no_of_qst = $questionSetting->no_of_qst;
        $level = $questionSetting->level;
        $question = Session::get('question');
        $answer = Session::get('answer');
        $currentQuestionNo = Session::get('currentQuestionNo');
        $course = $questionSetting->course;

        // Check if current question number is less than total questions
        if ($currentQuestionNo < $no_of_qst) { 
            
            //----Update Current Question --------------------------------
            $questionUpdate = Question::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('session1', $session1)
            ->where('course', $course)
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
                ->where('session1', $session1)
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
            ->where('session1', $session1)
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
        $question = Session::get('question');
        $answer = Session::get('answer');
        $currentQuestionNo = Session::get('currentQuestionNo');
        $course = $questionSetting->course;

        // Check if current question number is greater than 1
        if ($currentQuestionNo > 1) {  

            //----Update Current Question --------------------------------
            $questionUpdate = Question::where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('session1', $session1)
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
                ->where('session1', $session1)
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
            ->where('session1', $session1)
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
        $currentQuestionNo = $validatedData['qst_search'];
        $course = $questionSetting->course;

        // Retrieve search question
        $question = Question::where('exam_type', $exam_type)
        ->where('exam_category', $exam_category)
        ->where('exam_mode', $exam_mode)
        ->where('department', $department)
        ->where('level', $level)
        ->where('session1', $session1)
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
            return redirect()->route('question')->with('error', 'Question setting not found.');
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
            'course' => $questionSetting->course,
            'session1' => $questionSetting->session1,
            'department' => $questionSetting->department,
            'exam_type' => $questionSetting->exam_type,
            'exam_category' => $questionSetting->exam_category,
            'exam_mode' => $questionSetting->exam_mode,
            'no_of_qst' => $questionSetting->no_of_qst,
            'duration' => $questionSetting->duration,
            'check_result' => $questionSetting->check_result,
        ]);

        if($currentExamStatus == 'Active') {
            return redirect()->route('question')->with('success', 'Question disabled successfully.');
        }
        return redirect()->route('question')->with('success', 'Question enabled successfully.');
    }

    public function downloadQuestionCsv()
    {
        $filePath = public_path('sample/question.csv');

        return Response::download($filePath, 'question_sample.csv', ['Content-Type' => 'text/csv']);
    }    
    
    public function questionUploadObjImportAction(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'session1' => 'required|string',
                'department' => 'required|string',
                'level' => 'required|string',
                'exam_category' => 'required|string',
                'exam_type' => 'required|string',   
                'duration' => 'required|string',
                'exam_date' => 'required', 
                'no_of_qst' => 'required|integer',  
                'course' => 'required|string',    
            ]);                        

            // Check if the exam type already exists
        $existingQuestion = QuestionSetting::where('exam_type', $validatedData['exam_type'])
                                            ->where('exam_category', $validatedData['exam_category'])
                                            ->where('exam_mode', 'OBJECTIVES')
                                            ->where('department', $validatedData['department'])
                                            ->where('level', $validatedData['level'])
                                            ->where('session1', $validatedData['session1'])
                                            ->where('course', $validatedData['course'])
                                            ->where('no_of_qst', $validatedData['no_of_qst'])
                                            ->first();
        
        if ($existingQuestion) {
            // If the question already exists, redirect back with an error message
            return redirect()->route('question')->with('error', 'Question already exists, you can only edit.');
        }
            //---Create a record for the question in the questionsetting table----
            $questionSetting = QuestionSetting::create([
                'session1' => $validatedData['session1'],
                'department' => $validatedData['department'],
                'level' => $validatedData['level'],
                'exam_category' => $validatedData['exam_category'],
                'exam_type' => $validatedData['exam_type'],
                'exam_mode' => 'OBJECTIVE',
                'exam_status' => 'Inactive',
                'no_of_qst' => $validatedData['no_of_qst'],
                'duration' => $validatedData['duration'],
                'exam_date' => date("Y-m-d", strtotime($validatedData['exam_date'])),  
                'course' => $validatedData['course'],   
                'check_result' => 1,                                       
            ]);

            //--Import all question for the said no of question selected in the question table
            $num_questions = $validatedData['no_of_qst'];
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
                                'exam_category' => $validatedData['exam_category'],
                                'exam_type' => $validatedData['exam_type'],
                                'exam_mode' => 'OBJECTIVE',
                                'course' => $validatedData['course'],
                                'no_of_qst' => $validatedData['no_of_qst'],
                                'upload_no_of_qst' => $validatedData['no_of_qst'],
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
                    return redirect()->back()->with('error', 'Student list import not successful.');
                    }  
                } else {
            
                    return redirect()->back()->with('error', 'No file was uploaded.');
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

}
