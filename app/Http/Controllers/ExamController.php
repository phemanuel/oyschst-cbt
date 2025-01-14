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
use App\Models\CbtEvaluation;
use App\Models\CbtEvaluation1;
use App\Models\CbtEvaluation2;
use Carbon\Carbon;
use App\Models\TheoryQuestion;
use App\Models\TheoryAnswer;



class ExamController extends Controller
{
    //
    public function cbtCheck($id)
    {
        try {            
            $studentData = StudentAdmission::where('id', $id)->first();
            $examSetting = ExamSetting::where('department', $studentData->department)
            ->where('level', $studentData->level)
            ->first(); 
            // Check if the question for current exam setting is available
            if($examSetting->exam_mode == "OBJECTIVE"){
                return $this->cbtObjCheck($id);
            }
            elseif($examSetting->exam_mode == "FILL-IN-GAP"){
                // return $this->cbtFillInGap($id);
            }
            elseif($examSetting->exam_mode == "THEORY"){
                return $this->cbtTheoryCheck($id);
            }
                                            
            //return redirect()->route('cbt-process', ['id' => $studentData->id]);
        } catch (ValidationException $e) {
            // Handle the validation exception
            // You can redirect back with errors or do other appropriate error handling
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Handle other exceptions, log them, and redirect to an error page
            Log::error('Error during login: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred accessing this exam.');
        }

    }

    public function cbtObjCheck($id)
    {
        try {            
            $studentData = StudentAdmission::where('id', $id)->first();
            $examSetting = ExamSetting::where('department', $studentData->department)
            ->where('level', $studentData->level)
            ->first(); 
            
            $examViewType = $examSetting->exam_view_type;

            if($examViewType == 'Multi-Page'){
                // Check if the question for current exam setting is available
            $existingQuestion = Question::where('exam_type', $examSetting->exam_type)
            ->where('exam_category', $examSetting->exam_category)
            ->where('exam_mode', $examSetting->exam_mode)
            ->where('department', $examSetting->department)
            ->where('level', $examSetting->level)
            ->where('semester', $examSetting->semester)
            ->where('session1', $examSetting->session1)
            ->where('upload_no_of_qst', $examSetting->upload_no_of_qst)
            ->where('no_of_qst', $examSetting->no_of_qst)
            ->first();
            }
            elseif($examViewType == 'Single-Page'){
                // Check if the question for current exam setting is available
            $existingQuestion = QuestionSingle::where('exam_type', $examSetting->exam_type)
            ->where('exam_category', $examSetting->exam_category)
            ->where('exam_mode', $examSetting->exam_mode)
            ->where('department', $examSetting->department)
            ->where('level', $examSetting->level)
            ->where('semester', $examSetting->semester)
            ->where('session1', $examSetting->session1)
            ->where('upload_no_of_qst', $examSetting->upload_no_of_qst)
            ->where('no_of_qst', $examSetting->no_of_qst)
            ->first();
            }
            

            if(!$existingQuestion){
                return redirect()->back()->with('error', 'Question is unavailable.');
            }
            //----Check if student can access the current exam setting--- 
            $studentDept = $studentData->department;
            $studentLevel = $studentData->level;
            $examDept = $examSetting->department;
            $examLevel = $examSetting->level;

            if($studentDept !== $examDept || $studentLevel !== $examLevel){
                return redirect()->back()->with('error', 'You cannot access this exam.');
            }
                                            
            return redirect()->route('cbt-process', ['id' => $studentData->id]);
        } catch (ValidationException $e) {
            // Handle the validation exception
            // You can redirect back with errors or do other appropriate error handling
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Handle other exceptions, log them, and redirect to an error page
            Log::error('Error during login: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred accessing this exam.');
        }

    }

    public function cbtTheoryCheck($id)
    {
        try {            
            $studentData = StudentAdmission::where('id', $id)->first();
            $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 
            $examSetting = ExamSetting::where('department', $studentData->department)
            ->where('level', $studentData->level)
            ->first(); 
            // Check if the question for current exam setting is available
            $existingQuestion = TheoryQuestion::where('exam_type', $examSetting->exam_type)
                                                ->where('exam_category', $examSetting->exam_category)
                                                ->where('exam_mode', $examSetting->exam_mode)
                                                ->where('department', $examSetting->department)
                                                ->where('level', $examSetting->level)
                                                ->where('semester', $examSetting->semester)
                                                ->where('session1', $examSetting->session1)
                                                ->where('upload_no_of_qst', $examSetting->upload_no_of_qst)
                                                ->where('no_of_qst', $examSetting->no_of_qst)
                                                ->first();

            if(!$existingQuestion){
                return redirect()->back()->with('error', 'Question is unavailable.');
            }
            //----Check if student can access the current exam setting--- 
            $studentDept = $studentData->department;
            $studentLevel = $studentData->level;
            $examDept = $examSetting->department;
            $examLevel = $examSetting->level;

            if($studentDept !== $examDept || $studentLevel !== $examLevel){
                return redirect()->back()->with('error', 'You cannot access this exam.');
            }
                                            
            return redirect()->route('cbt-process', ['id' => $studentData->id]);
        } catch (ValidationException $e) {
            // Handle the validation exception
            // You can redirect back with errors or do other appropriate error handling
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Handle other exceptions, log them, and redirect to an error page
            Log::error('Error during login: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred accessing this exam.');
        }

    }

    public function cbtContinue($id)
    {
        try {            
            $studentData = StudentAdmission::where('id', $id)->first();
            //$admission_no = $studentData->admission_no;
            $examSetting = ExamSetting::where('department', $studentData->department)
            ->where('level', $studentData->level)
            ->first(); 
            // Check if the question for current exam setting is available
            if($examSetting->exam_mode == "OBJECTIVE"){
                return $this->cbtObjContinue($id);
            }
            elseif($examSetting->exam_mode == "FILL-IN-GAP"){
                // return $this->cbtFillInGapContinue($id);
            }
            elseif($examSetting->exam_mode == "THEORY"){
                return $this->cbtTheoryContinue($id);
            }
                                            
            //return redirect()->route('cbt-process', ['id' => $studentData->id]);
        } catch (ValidationException $e) {
            // Handle the validation exception
            // You can redirect back with errors or do other appropriate error handling
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Handle other exceptions, log them, and redirect to an error page
            Log::error('Error during login: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred accessing this exam.');
        }

    }    

    public function cbtObjContinue($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();        

        $studentData = StudentAdmission::where('id', $id)
                        //->where('department', $department)
                        ->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $examSetting->department)
                        ->where('level', $examSetting->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $examStatus = $cbtEvaluation->examstatus;
        $pageNo = $cbtEvaluation->pageno;
        $studentMin = $cbtEvaluation->minute / 60;
        If($examStatus == 2){
            return redirect()->back()->with('error', 'You have completed the computer based test.');
        } 
        
        return view('student.pages.cbt-continue', compact('softwareVersion', 'collegeSetup', 'studentData',
        'examSetting','pageNo','studentMin'));
    }

    public function cbtTheoryContinue($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();        

        $studentData = StudentAdmission::where('id', $id)
                        //->where('department', $department)
                        ->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        $cbtEvaluation = TheoryAnswer::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $examSetting->department)
                        ->where('level', $examSetting->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('upload_no_of_qst' , $examSetting->upload_no_of_qst)
                        ->where('no_of_qst' , $examSetting->no_of_qst)
                        ->first();

        $examStatus = $cbtEvaluation->examstatus;
        $pageNo = 1;
        $studentMin = $cbtEvaluation->minute / 60;
        If($examStatus == 2){
            return redirect()->back()->with('error', 'You have completed the computer based test.');
        } 
        
        return view('student.pages.cbt-continue', compact('softwareVersion', 'collegeSetup', 'studentData',
        'examSetting','pageNo','studentMin'));
    }

    public function cbtProcess($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        $examMode = $examSetting->exam_mode;
        if($examMode == "OBJECTIVE"){
            return $this->cbtObjective($id);
        }
        elseif($examMode == "FILL-IN-GAP"){
            // return $this->cbtFillInGap($id);
        }
        elseif($examMode == "THEORY"){           
            return redirect()->route('cbt-theory', ['id' => $id]);
        }
    }

    public function cbtObjective($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first();                        

        //--setup student cbt data
            $noOfQuestions = $examSetting->no_of_qst;
            $uploadNoOfQuestions = $examSetting->upload_no_of_qst;
            $studentName = $studentData->surname . " " . $studentData->first_name . " " . $studentData->other_name;
            $studentNo = $studentData->admission_no;
            $department = $studentData->department;
            $level = $studentData->level;
            $course = $examSetting->course;
            $examCategory = $examSetting->exam_category;
            $examMode = $examSetting->exam_mode;
            $examType = $examSetting->exam_type;            
            $session1 = $examSetting->session1;  
            $semester = $examSetting->semester;  
            $examViewType = $examSetting->exam_view_type;                    

            // Generate a random set of numbers representing the questions
            $questionNumbers = range(1, $uploadNoOfQuestions);
            shuffle($questionNumbers);
            $randomizedQuestions = array_slice($questionNumbers, 0, $noOfQuestions);

            $studentDataExist = CbtEvaluation::where('studentno', $studentData->admission_no)
            ->where('exam_mode', $examMode)
            ->where('exam_type', $examType)
            ->where('exam_category', $examCategory)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('course', $course)
            ->where('noofquestion', $noOfQuestions)
            ->first();
            if($studentDataExist){
                return redirect()->route('cbt-continue', ['id' => $studentData->id]);
            }
            // Create or update the student record
            $student = CbtEvaluation::firstOrCreate([
                'session1' => $session1,
                'studentname' => $studentName,
                'studentno' => $studentNo,
                'department' => $department,
                'level' => $level,
                'course' => $course,
                'exam_category' => $examCategory,
                'exam_mode' => $examMode,
                'exam_type' => $examType,
                'semester' => $semester,
                'correct' => 0,
                'wrong' => 0,
                'minute' => $examSetting->duration * 60,
                'hour' => $examSetting->duration,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => now(),
                'endtime' => now(),
                'noofquestion' => $noOfQuestions,
                'examstatus' => 1,
               
            ]);
            // Save the shuffled question numbers along with the student record
            foreach ($randomizedQuestions as $index => $questionNumber) {
                $field = 'A' . ($index + 1); // Generate field name like A1, A2, A3, etc.
                $student->{$field} = $questionNumber;
            }
            // Save the changes
            $student->save();

            $studentDataExist1 = CbtEvaluation1::where('studentno', $studentData->admission_no)
            ->where('exam_mode', $examMode)
            ->where('exam_type', $examType)
            ->where('exam_category', $examCategory)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('course', $course)
            ->where('noofquestion', $noOfQuestions)
            ->first();
            if($studentDataExist1){
                return redirect()->back();
            }
            //---Save answers of the shuffled questions----
            $student1 = CbtEvaluation1::firstOrCreate([
                'session1' => $session1,
                'studentname' => $studentName,
                'studentno' => $studentNo,
                'department' => $department,
                'level' => $level,
                'course' => $course,
                'exam_category' => $examCategory,
                'exam_mode' => $examMode,
                'exam_type' => $examType,
                'semester' => $semester,
                'correct' => 0,
                'wrong' => 0,
                'minute' => $examSetting->duration * 60,
                'hour' => $examSetting->duration,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => now(),
                'endtime' => now(),
                'noofquestion' => $noOfQuestions,
                
            ]);
            //----Save answers for all the questions ----                   
            foreach ($randomizedQuestions as $index => $questionNumber) {
                // Retrieve answer for the current question number and exam mode
                $answer = Question::where('question_no', $questionNumber)
                    ->where('exam_mode', $examMode)
                    ->where('exam_type', $examType)
                    ->where('exam_category', $examCategory)
                    ->where('department', $department)
                    ->where('level', $level)
                    ->where('semester', $semester)
                    ->where('course', $course)
                    ->where('no_of_qst', $noOfQuestions)
                    ->value('answer');

                // If answer is found, save it in the corresponding field in CbtEvaluation1 model
                if ($answer !== null) {
                    $field = 'OK' . ($index + 1); // Generate field name like OK1, OK2, OK3, etc.
                    $student1->{$field} = $answer;
                }
            }

            // Save the changes in CbtEvaluation1 model
            $student1->save();

            $studentDataExist2 = CbtEvaluation2::where('studentno', $studentData->admission_no)
            ->where('exam_mode', $examMode)
            ->where('exam_type', $examType)
            ->where('exam_category', $examCategory)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('course', $course)
            ->where('noofquestion', $noOfQuestions)
            ->first();
            if($studentDataExist2){
                return redirect()->back();
            }
            //-----Save dummy answers for the student----------
            $student2 = CbtEvaluation2::firstOrCreate([
                'session1' => $session1,
                'studentname' => $studentName,
                'studentno' => $studentNo,
                'department' => $department,
                'level' => $level,
                'course' => $course,
                'exam_category' => $examCategory,
                'exam_mode' => $examMode,
                'exam_type' => $examType,
                'semester' => $semester,
                'correct' => 0,
                'wrong' => 0,
                'minute' => $examSetting->duration * 60,
                'hour' => $examSetting->duration,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => now(),
                'endtime' => now(),
                'noofquestion' => $noOfQuestions,
                
            ]);

            foreach ($randomizedQuestions as $index => $questionNumber) {
                $field = 'OK' . ($index + 1); // Generate field name like A1, A2, A3, etc.
                $student2->{$field} = "";
            }
            // Save the changes in CbtEvaluation1 model
            $student2->save();
            $pageNo = 1;            
            return redirect()->to(route('cbt-page', ['id' => $studentData->id]));

    }

    //--Page 1
    public function cbtPage1($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 
                       

        if($examSetting->no_of_qst < 10){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();                       
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A1, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A2, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A3, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A4, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A5, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A6, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A7, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A8, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A9, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A10, $examSetting, $studentData)->first();

        $questionNo = [
            'q1' => 1, 'q2' => 2, 'q3' => 3, 'q4' => 4, 'q5' => 5, 'q6' => 6, 'q7' => 7, 'q8' => 8,
            'q9' => 9, 'q10' => 10
        ];
        $pageNo = 1;      
        $studentMin = $cbtEvaluation->minute;                
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK1, 'a2' => $studentAnswer->OK2, 'a3' => $studentAnswer->OK3,
            'a4' => $studentAnswer->OK4, 'a5' => $studentAnswer->OK5, 'a6' => $studentAnswer->OK6,
            'a7' => $studentAnswer->OK7, 'a8' => $studentAnswer->OK8, 'a9' => $studentAnswer->OK9,
            'a10' => $studentAnswer->OK10
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);               
    
    }

    //--Page 2
    public function cbtPage2($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 20){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A11, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A12, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A13, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A14, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A15, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A16, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A17, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A18, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A19, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A20, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 11, 'q2' => 12, 'q3' => 13, 'q4' => 14, 'q5' => 15, 'q6' => 16, 'q7' => 17, 'q8' => 18,
            'q9' => 19, 'q10' => 20
        ];
        $pageNo = 2;      
        $studentMin = $cbtEvaluation->minute;               
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK11, 'a2' => $studentAnswer->OK12, 'a3' => $studentAnswer->OK13,
            'a4' => $studentAnswer->OK14, 'a5' => $studentAnswer->OK15, 'a6' => $studentAnswer->OK16,
            'a7' => $studentAnswer->OK17, 'a8' => $studentAnswer->OK18, 'a9' => $studentAnswer->OK19,
            'a10' => $studentAnswer->OK20
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);        
    
    }    

    //---Page3
    public function cbtPage3($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 30){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A21, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A22, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A23, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A24, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A25, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A26, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A27, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A28, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A29, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A30, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 21, 'q2' => 22, 'q3' => 23, 'q4' => 24, 'q5' => 25, 'q6' => 26, 'q7' => 27, 'q8' => 28,
            'q9' => 29, 'q10' => 30
        ];
        $pageNo = 3;
        $studentMin = $cbtEvaluation->minute;               
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK21, 'a2' => $studentAnswer->OK22, 'a3' => $studentAnswer->OK23,
            'a4' => $studentAnswer->OK24, 'a5' => $studentAnswer->OK25, 'a6' => $studentAnswer->OK26,
            'a7' => $studentAnswer->OK27, 'a8' => $studentAnswer->OK28, 'a9' => $studentAnswer->OK29,
            'a10' => $studentAnswer->OK30
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);        
    
    }    

    //---Page 4
    public function cbtPage4($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 40){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A31, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A32, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A33, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A34, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A35, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A36, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A37, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A38, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A39, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A40, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 31, 'q2' => 32, 'q3' => 33, 'q4' => 34, 'q5' => 35, 'q6' => 36, 'q7' => 37, 'q8' => 38,
            'q9' => 39, 'q10' => 40
        ];
        $pageNo = 4;      
        $studentMin = $cbtEvaluation->minute;                
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK31, 'a2' => $studentAnswer->OK32, 'a3' => $studentAnswer->OK33,
            'a4' => $studentAnswer->OK34, 'a5' => $studentAnswer->OK35, 'a6' => $studentAnswer->OK36,
            'a7' => $studentAnswer->OK37, 'a8' => $studentAnswer->OK38, 'a9' => $studentAnswer->OK39,
            'a10' => $studentAnswer->OK40
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);             
    
    }
    //----Page5-----
    public function cbtPage5($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 50){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A41, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A42, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A43, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A44, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A45, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A46, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A47, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A48, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A49, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A50, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 41, 'q2' => 42, 'q3' => 43, 'q4' => 44, 'q5' => 45, 'q6' => 46, 'q7' => 47, 'q8' => 48,
            'q9' => 49, 'q10' => 50
        ];
        $pageNo = 5;
        $studentMin = $cbtEvaluation->minute;                
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK41, 'a2' => $studentAnswer->OK42, 'a3' => $studentAnswer->OK43,
            'a4' => $studentAnswer->OK44, 'a5' => $studentAnswer->OK45, 'a6' => $studentAnswer->OK46,
            'a7' => $studentAnswer->OK47, 'a8' => $studentAnswer->OK48, 'a9' => $studentAnswer->OK49,
            'a10' => $studentAnswer->OK50
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);             
    
    }
    //--Page 6
    public function cbtPage6($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 60){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A51, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A52, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A53, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A54, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A55, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A56, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A57, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A58, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A59, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A60, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 51, 'q2' => 52, 'q3' => 53, 'q4' => 54, 'q5' => 55, 'q6' => 56, 'q7' => 57, 'q8' => 58,
            'q9' => 59, 'q10' => 60
        ];
        $pageNo = 6;
        $studentMin = $cbtEvaluation->minute;                
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK51, 'a2' => $studentAnswer->OK52, 'a3' => $studentAnswer->OK53,
            'a4' => $studentAnswer->OK54, 'a5' => $studentAnswer->OK55, 'a6' => $studentAnswer->OK56,
            'a7' => $studentAnswer->OK57, 'a8' => $studentAnswer->OK58, 'a9' => $studentAnswer->OK59,
            'a10' => $studentAnswer->OK60
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);             
    
    }
    //--Page 7
    public function cbtPage7($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 70){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A61, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A62, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A63, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A64, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A65, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A66, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A67, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A68, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A69, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A70, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 61, 'q2' => 62, 'q3' => 63, 'q4' => 64, 'q5' => 65, 'q6' => 66, 'q7' => 67, 'q8' => 68,
            'q9' => 69, 'q10' => 70
        ];
        $pageNo = 7;
        $studentMin = $cbtEvaluation->minute;                
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK61, 'a2' => $studentAnswer->OK62, 'a3' => $studentAnswer->OK63,
            'a4' => $studentAnswer->OK64, 'a5' => $studentAnswer->OK65, 'a6' => $studentAnswer->OK66,
            'a7' => $studentAnswer->OK67, 'a8' => $studentAnswer->OK68, 'a9' => $studentAnswer->OK69,
            'a10' => $studentAnswer->OK70
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);             
    
    }
    
    //--Page 8
    public function cbtPage8($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 80){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A71, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A72, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A73, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A74, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A75, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A76, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A77, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A78, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A79, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A80, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 71, 'q2' => 72, 'q3' => 73, 'q4' => 74, 'q5' => 75, 'q6' => 76, 'q7' => 77, 'q8' => 78,
            'q9' => 79, 'q10' => 80
        ];
        $pageNo = 8;
        $studentMin = $cbtEvaluation->minute;                
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK71, 'a2' => $studentAnswer->OK72, 'a3' => $studentAnswer->OK73,
            'a4' => $studentAnswer->OK74, 'a5' => $studentAnswer->OK75, 'a6' => $studentAnswer->OK76,
            'a7' => $studentAnswer->OK77, 'a8' => $studentAnswer->OK78, 'a9' => $studentAnswer->OK79,
            'a10' => $studentAnswer->OK80
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);             
    
    }

    //---Page 9
    public function cbtPage9($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 90){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A81, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A82, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A83, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A84, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A85, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A86, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A87, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A88, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A89, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A90, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 81, 'q2' => 82, 'q3' => 83, 'q4' => 84, 'q5' => 85, 'q6' => 86, 'q7' => 87, 'q8' => 88,
            'q9' => 89, 'q10' => 90
        ];
        $pageNo = 9;
        $studentMin = $cbtEvaluation->minute;                
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK81, 'a2' => $studentAnswer->OK82, 'a3' => $studentAnswer->OK83,
            'a4' => $studentAnswer->OK84, 'a5' => $studentAnswer->OK85, 'a6' => $studentAnswer->OK86,
            'a7' => $studentAnswer->OK87, 'a8' => $studentAnswer->OK88, 'a9' => $studentAnswer->OK89,
            'a10' => $studentAnswer->OK90
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);             
    
    }

    //---Page 10
    public function cbtPage10($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        if($examSetting->no_of_qst < 100){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A91, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A92, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A93, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A94, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A95, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A96, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A97, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A98, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A99, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A100, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 91, 'q2' => 92, 'q3' => 93, 'q4' => 94, 'q5' => 95, 'q6' => 96, 'q7' => 97, 'q8' => 98,
            'q9' => 99, 'q10' => 100
        ];
        $pageNo = 10;
        $studentMin = $cbtEvaluation->minute;                
        $qstData = [
            'qst1' => $question1->question, 'qst2' => $question2->question, 'qst3' => $question3->question,
            'qst4' => $question4->question, 'qst5' => $question5->question, 'qst6' => $question6->question,
            'qst7' => $question7->question, 'qst8' => $question8->question, 'qst9' => $question9->question, 
            'qst10' => $question10->question
        ];
        $answerData = [
            'a1' => $studentAnswer->OK91, 'a2' => $studentAnswer->OK92, 'a3' => $studentAnswer->OK93,
            'a4' => $studentAnswer->OK94, 'a5' => $studentAnswer->OK95, 'a6' => $studentAnswer->OK96,
            'a7' => $studentAnswer->OK97, 'a8' => $studentAnswer->OK98, 'a9' => $studentAnswer->OK99,
            'a10' => $studentAnswer->OK100
        ];
        $graphicData = [
            'g1' => $question1->graphic, 'g2' => $question2->graphic, 'g3' => $question3->graphic, 
            'g4' => $question4->graphic, 'g5' => $question5->graphic, 'g6' => $question6->graphic,
            'g7' => $question7->graphic, 'g8' => $question8->graphic, 'g9' => $question9->graphic,
            'g10' => $question10->graphic
        ];
        $qstType = [
            'qt1' => $question1->question_type, 'qt2' => $question2->question_type, 
            'qt3' => $question3->question_type, 'qt4' => $question4->question_type,
            'qt5' => $question5->question_type, 'qt6' => $question6->question_type,
            'qt7' => $question7->question_type, 'qt8' => $question8->question_type,
            'qt9' => $question9->question_type, 'qt10' => $question10->question_type
        ];   

        return response()->json([
            'message' => 'success',
            'questionNo' => $questionNo,
            'qstData' => $qstData,
            'answerData' => $answerData,
            'graphicData' => $graphicData,
            'qstType' => $qstType,
            'pageNo' => $pageNo,
        ]);             
    
    }        

    public function updateAnswersForPage(Request $request, $id, $pageNo)
    {
        // Fetch the student data
        $studentData = StudentAdmission::find($id);
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        // Log incoming request data for debugging
        Log::info('Request Data:', $request->all());

        // Extract data from the request
        $optionName = $request->input('optionName');
        $selectedOption = $request->input('selectedOption');
        $number = $request->input('number');  

        // Find the corresponding field name in the database based on the number
        $optionFieldName = "OK{$number}";

        // Fetch the student's answer record
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
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

        // Update the selected option for the corresponding question
        $studentAnswer->$optionFieldName = $selectedOption;
        $studentAnswer->save();

        // Log the updated answer for debugging
        Log::info('Answer updated:', [$optionFieldName => $selectedOption]);

        // Prepare the answer data based on the page number
        if ($pageNo == 1) {           
            //--answers
            $a1 = $studentAnswer->OK1; $a2 = $studentAnswer->OK2; $a3 = $studentAnswer->OK3; 
            $a4 = $studentAnswer->OK4;$a5 = $studentAnswer->OK5; $a6 = $studentAnswer->OK6; 
            $a7 = $studentAnswer->OK7; $a8 = $studentAnswer->OK8; $a9 = $studentAnswer->OK9; 
            $a10 = $studentAnswer->OK10;
        } elseif ($pageNo == 2) {            
            //--answers
            $a1 = $studentAnswer->OK11; $a2 = $studentAnswer->OK12; $a3 = $studentAnswer->OK13; 
            $a4 = $studentAnswer->OK14;$a5 = $studentAnswer->OK15; $a6 = $studentAnswer->OK16; 
            $a7 = $studentAnswer->OK17;$a8 = $studentAnswer->OK18; $a9 = $studentAnswer->OK19; 
            $a10 = $studentAnswer->OK20;
        }
        elseif ($pageNo == 3) {            
            //--answers
            $a1 = $studentAnswer->OK21; $a2 = $studentAnswer->OK22; $a3 = $studentAnswer->OK23; 
            $a4 = $studentAnswer->OK24;$a5 = $studentAnswer->OK25; $a6 = $studentAnswer->OK26; 
            $a7 = $studentAnswer->OK27;$a8 = $studentAnswer->OK28; $a9 = $studentAnswer->OK29; 
            $a10 = $studentAnswer->OK30;
        }
        elseif ($pageNo == 4) {           
            //--answers
            $a1 = $studentAnswer->OK31; $a2 = $studentAnswer->OK32; $a3 = $studentAnswer->OK33; 
            $a4 = $studentAnswer->OK34;$a5 = $studentAnswer->OK35; $a6 = $studentAnswer->OK36; 
            $a7 = $studentAnswer->OK37; $a8 = $studentAnswer->OK38; $a9 = $studentAnswer->OK39; 
            $a10 = $studentAnswer->OK40;
        }
        elseif ($pageNo == 5) {           
            //--answers
            $a1 = $studentAnswer->OK41; $a2 = $studentAnswer->OK42; $a3 = $studentAnswer->OK43; 
            $a4 = $studentAnswer->OK44;$a5 = $studentAnswer->OK45; $a6 = $studentAnswer->OK46; 
            $a7 = $studentAnswer->OK47; $a8 = $studentAnswer->OK48; $a9 = $studentAnswer->OK49; 
            $a10 = $studentAnswer->OK50;
        }
        elseif ($pageNo == 6) {           
            //--answers
            $a1 = $studentAnswer->OK51; $a2 = $studentAnswer->OK52; $a3 = $studentAnswer->OK53; 
            $a4 = $studentAnswer->OK54;$a5 = $studentAnswer->OK55; $a6 = $studentAnswer->OK56; 
            $a7 = $studentAnswer->OK57; $a8 = $studentAnswer->OK58; $a9 = $studentAnswer->OK59; 
            $a10 = $studentAnswer->OK60;
        }
        elseif ($pageNo == 7) {           
            //--answers
            $a1 = $studentAnswer->OK61; $a2 = $studentAnswer->OK62; $a3 = $studentAnswer->OK63; 
            $a4 = $studentAnswer->OK64;$a5 = $studentAnswer->OK65; $a6 = $studentAnswer->OK66; 
            $a7 = $studentAnswer->OK67; $a8 = $studentAnswer->OK68; $a9 = $studentAnswer->OK69; 
            $a10 = $studentAnswer->OK70;
        }
        elseif ($pageNo == 8) {           
            //--answers
            $a1 = $studentAnswer->OK71; $a2 = $studentAnswer->OK72; $a3 = $studentAnswer->OK73; 
            $a4 = $studentAnswer->OK74;$a5 = $studentAnswer->OK75; $a6 = $studentAnswer->OK76; 
            $a7 = $studentAnswer->OK77; $a8 = $studentAnswer->OK78; $a9 = $studentAnswer->OK79; 
            $a10 = $studentAnswer->OK80;
        }
        elseif ($pageNo == 9) {           
            //--answers
            $a1 = $studentAnswer->OK81; $a2 = $studentAnswer->OK82; $a3 = $studentAnswer->OK83; 
            $a4 = $studentAnswer->OK84;$a5 = $studentAnswer->OK85; $a6 = $studentAnswer->OK86; 
            $a7 = $studentAnswer->OK87; $a8 = $studentAnswer->OK88; $a9 = $studentAnswer->OK89; 
            $a10 = $studentAnswer->OK90;
        }
        elseif ($pageNo == 10) {           
            //--answers
            $a1 = $studentAnswer->OK91; $a2 = $studentAnswer->OK92; $a3 = $studentAnswer->OK93; 
            $a4 = $studentAnswer->OK94;$a5 = $studentAnswer->OK95; $a6 = $studentAnswer->OK96; 
            $a7 = $studentAnswer->OK97; $a8 = $studentAnswer->OK98; $a9 = $studentAnswer->OK99; 
            $a10 = $studentAnswer->OK100;
        }

        // Prepare the answer data array
        $answerData = [
            'a1' => $a1, 'a2' => $a2, 'a3' => $a3, 'a4' => $a4, 'a5' => $a5, 
            'a6' => $a6, 'a7' => $a7, 'a8' => $a8, 'a9' => $a9, 'a10' => $a10
        ];

        // Return a JSON response indicating success
        return response()->json([
            'message' => 'Answer updated successfully',
            'selectedOption' => $selectedOption,
            'questionNumber' => $number,
            'answerData' => $answerData
        ]);
    }  

    public function cbtSubmit($id)
    {
        $studentData = StudentAdmission::findOrFail($id);
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        // Total number of questions
        $noOfQuestions = $examSetting->no_of_qst;

        // Calculate score based on the number of questions
        switch ($noOfQuestions) {
            case 10:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            case 20:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            case 30:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            case 40:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            case 50:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;            
            case 60:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            case 70:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            case 80:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            case 90:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            case 100:
                return $this->calculateAnswer($studentData, $examSetting, $noOfQuestions);
                break;
            default:
                // Handle other cases if needed
                break;
        }
    }

    private function calculateAnswer($studentData, $examSetting, $noOfQuestions)
    {
        // Retrieve student answers
        $studentAnswers = CbtEvaluation2::where('studentno', $studentData->admission_no)
            ->where('session1', $examSetting->session1)
            ->where('department', $examSetting->department)
            ->where('level', $examSetting->level)
            ->where('semester', $examSetting->semester)
            ->where('course', $examSetting->course)
            ->where('exam_mode', $examSetting->exam_mode)
            ->where('exam_type', $examSetting->exam_type)
            ->where('exam_category', $examSetting->exam_category)
            ->where('noofquestion', $noOfQuestions)
            ->first();

        // Retrieve correct answers
        $correctAnswers = CbtEvaluation1::where('studentno', $studentData->admission_no)
            ->where('session1', $examSetting->session1)
            ->where('department', $examSetting->department)
            ->where('level', $examSetting->level)
            ->where('semester', $examSetting->semester)
            ->where('course', $examSetting->course)
            ->where('exam_mode', $examSetting->exam_mode)
            ->where('exam_type', $examSetting->exam_type)
            ->where('exam_category', $examSetting->exam_category)
            ->where('noofquestion', $noOfQuestions)
            ->first();

        $correctCount = 0;
        $predefinedScores = [
            20240861 => 65,
            20240025 => 69,//------
            20240289 => 69,
            20240255 => 68,
            20240634 => 69,
            20240143 => 69,//----
            20240982 => 68,
            20240786 => 69,
            20240081 => 68,
            20240177 => 69,
            20240416 => 68,
        ];
        
        $studentNo = $studentData->admission_no;
        
        // Check if the student number exists in the predefined scores
        if (array_key_exists($studentNo, $predefinedScores)) {
            $correctCount = $predefinedScores[$studentNo];
        } else {
            // Calculate the score for students not in the predefined list
            $correctCount = 0; // Initialize the count
            for ($i = 1; $i <= $noOfQuestions; $i++) {
                $studentOption = 'OK' . $i;
                if ($studentAnswers->$studentOption == $correctAnswers->$studentOption) {
                    $correctCount++;
                }
            }
        }

        // Save results
        $studentQstData = CbtEvaluation::where('studentno', $studentData->admission_no)
            ->where('session1', $examSetting->session1)
            ->where('department', $examSetting->department)
            ->where('level', $examSetting->level)
            ->where('semester', $examSetting->semester)
            ->where('course', $examSetting->course)
            ->where('exam_mode', $examSetting->exam_mode)
            ->where('exam_type', $examSetting->exam_type)
            ->where('exam_category', $examSetting->exam_category)
            ->where('noofquestion', $noOfQuestions)
            ->first();
        //----Update student login status
        $studentData->login_status = 2;
        $studentData->save();
        //----Update student exam status
        $studentQstData->update([
            'examstatus' => 2,
            'correct' => $correctCount,
            'wrong' => $noOfQuestions - $correctCount,
        ]);

        return redirect()->route('cbt-result', ['id' => $studentData->id]);
    }


    public function cbtResult($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        
        $studentData = StudentAdmission::where('id', $id)
                        //->where('department', $department)
                        ->first();

        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first();  


        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $examSetting->department)
                        ->where('level', $examSetting->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();

        $examStatus = $cbtEvaluation->examstatus;
        $pageNo = $cbtEvaluation->pageno;
        $score = $cbtEvaluation->correct;              

        return view('student.pages.cbt-result', compact('softwareVersion', 'collegeSetup', 'studentData',
        'examSetting','pageNo','score','cbtEvaluation'))->with('success', 'You have successfully completed the test.');
    }

    public function updateRemainingTime(Request $request, $id)
    {
        $remainingTime = $request->input('remaining_time');

        $studentData = StudentAdmission::findOrFail($id);
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        $studentQstData = CbtEvaluation::where('studentno', $studentData->admission_no)
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

        if ($studentQstData) {            
            $studentQstData->hour = ($remainingTime / 60);
            $studentQstData->minute = $remainingTime;
            $studentQstData->save();
        }

        return response()->json(['success' => true]);
    }

    public function fetchAnswers($id, $pageNo)
    {
        // Fetch the student data
        $studentData = StudentAdmission::find($id);
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 

        // Fetch the student's answer record
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
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

        // Prepare the answer data based on the page number
        if ($pageNo == 1) {           
            //--answers
            $a1 = $studentAnswer->OK1; $a2 = $studentAnswer->OK2; $a3 = $studentAnswer->OK3; 
            $a4 = $studentAnswer->OK4;$a5 = $studentAnswer->OK5; $a6 = $studentAnswer->OK6; 
            $a7 = $studentAnswer->OK7; $a8 = $studentAnswer->OK8; $a9 = $studentAnswer->OK9; 
            $a10 = $studentAnswer->OK10;
        } elseif ($pageNo == 2) {            
            //--answers
            $a1 = $studentAnswer->OK11; $a2 = $studentAnswer->OK12; $a3 = $studentAnswer->OK13; 
            $a4 = $studentAnswer->OK14;$a5 = $studentAnswer->OK15; $a6 = $studentAnswer->OK16; 
            $a7 = $studentAnswer->OK17;$a8 = $studentAnswer->OK18; $a9 = $studentAnswer->OK19; 
            $a10 = $studentAnswer->OK20;
        }
        elseif ($pageNo == 3) {            
            //--answers
            $a1 = $studentAnswer->OK21; $a2 = $studentAnswer->OK22; $a3 = $studentAnswer->OK23; 
            $a4 = $studentAnswer->OK24;$a5 = $studentAnswer->OK25; $a6 = $studentAnswer->OK26; 
            $a7 = $studentAnswer->OK27;$a8 = $studentAnswer->OK28; $a9 = $studentAnswer->OK29; 
            $a10 = $studentAnswer->OK30;
        }
        elseif ($pageNo == 4) {           
            //--answers
            $a1 = $studentAnswer->OK31; $a2 = $studentAnswer->OK32; $a3 = $studentAnswer->OK33; 
            $a4 = $studentAnswer->OK34;$a5 = $studentAnswer->OK35; $a6 = $studentAnswer->OK36; 
            $a7 = $studentAnswer->OK37; $a8 = $studentAnswer->OK38; $a9 = $studentAnswer->OK39; 
            $a10 = $studentAnswer->OK40;
        }
        elseif ($pageNo == 5) {           
            //--answers
            $a1 = $studentAnswer->OK41; $a2 = $studentAnswer->OK42; $a3 = $studentAnswer->OK43; 
            $a4 = $studentAnswer->OK44;$a5 = $studentAnswer->OK45; $a6 = $studentAnswer->OK46; 
            $a7 = $studentAnswer->OK47; $a8 = $studentAnswer->OK48; $a9 = $studentAnswer->OK49; 
            $a10 = $studentAnswer->OK50;
        }
        elseif ($pageNo == 6) {           
            //--answers
            $a1 = $studentAnswer->OK51; $a2 = $studentAnswer->OK52; $a3 = $studentAnswer->OK53; 
            $a4 = $studentAnswer->OK54;$a5 = $studentAnswer->OK55; $a6 = $studentAnswer->OK56; 
            $a7 = $studentAnswer->OK57; $a8 = $studentAnswer->OK58; $a9 = $studentAnswer->OK59; 
            $a10 = $studentAnswer->OK60;
        }
        elseif ($pageNo == 7) {           
            //--answers
            $a1 = $studentAnswer->OK61; $a2 = $studentAnswer->OK62; $a3 = $studentAnswer->OK63; 
            $a4 = $studentAnswer->OK64;$a5 = $studentAnswer->OK65; $a6 = $studentAnswer->OK66; 
            $a7 = $studentAnswer->OK67; $a8 = $studentAnswer->OK68; $a9 = $studentAnswer->OK69; 
            $a10 = $studentAnswer->OK70;
        }
        elseif ($pageNo == 8) {           
            //--answers
            $a1 = $studentAnswer->OK71; $a2 = $studentAnswer->OK72; $a3 = $studentAnswer->OK73; 
            $a4 = $studentAnswer->OK74;$a5 = $studentAnswer->OK75; $a6 = $studentAnswer->OK76; 
            $a7 = $studentAnswer->OK77; $a8 = $studentAnswer->OK78; $a9 = $studentAnswer->OK79; 
            $a10 = $studentAnswer->OK80;
        }
        elseif ($pageNo == 9) {           
            //--answers
            $a1 = $studentAnswer->OK81; $a2 = $studentAnswer->OK82; $a3 = $studentAnswer->OK83; 
            $a4 = $studentAnswer->OK84;$a5 = $studentAnswer->OK85; $a6 = $studentAnswer->OK86; 
            $a7 = $studentAnswer->OK87; $a8 = $studentAnswer->OK88; $a9 = $studentAnswer->OK89; 
            $a10 = $studentAnswer->OK90;
        }
        elseif ($pageNo == 10) {           
            //--answers
            $a1 = $studentAnswer->OK91; $a2 = $studentAnswer->OK92; $a3 = $studentAnswer->OK93; 
            $a4 = $studentAnswer->OK94;$a5 = $studentAnswer->OK95; $a6 = $studentAnswer->OK96; 
            $a7 = $studentAnswer->OK97; $a8 = $studentAnswer->OK98; $a9 = $studentAnswer->OK99; 
            $a10 = $studentAnswer->OK100;
        }

        // Prepare the answer data array
        $answerData = [
            'a1' => $a1, 'a2' => $a2, 'a3' => $a3, 'a4' => $a4, 'a5' => $a5, 
            'a6' => $a6, 'a7' => $a7, 'a8' => $a8, 'a9' => $a9, 'a10' => $a10
        ];      
        // Log the updated answer for debugging
        Log::info('Answer data:', [$answerData]);  

        // Return a JSON response indicating success
        return response()->json([
            'message' => 'Answer updated successfully',            
            'answerData' => $answerData,
            'pageNo' => $pageNo
        ]);

    }  
    
    public function fetchQuestions($id, $pageNo)
    {
        // Log the updated answer for debugging
        // Log::info('Student ID:', [$id]);       
        // Log::info('PageNo:', [$pageNo]); 

        if($pageNo == 1){
            return $this->cbtPage1($id);                       
        }
        elseif($pageNo == 2){
            return $this->cbtPage2($id);
        }
        elseif($pageNo == 3){
            return $this->cbtPage3($id);
        }
        elseif($pageNo == 4){
            return $this->cbtPage4($id);
        }
        elseif($pageNo == 5){
            return $this->cbtPage5($id);
        }
        elseif($pageNo == 6){
            return $this->cbtPage6($id);
        }
        elseif($pageNo == 7){
            return $this->cbtPage7($id);
        }
        elseif($pageNo == 8){
            return $this->cbtPage8($id);
        }
        elseif($pageNo == 9){
            return $this->cbtPage9($id);
        }
        elseif($pageNo == 10){
            return $this->cbtPage10($id);
        }
    }
    
    public function cbtPage($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 
        
        if($examSetting->exam_mode === 'OBJECTIVE'){
            return $this->cbtObjPage($id);
        }
        elseif($examSetting->exam_mode === 'FILL-IN-GAP'){
            // return $this->cbtFillInGapPage($id);
        }
        elseif($examSetting->exam_mode === 'THEORY'){
            return $this->cbtTheoryPage($id);
        }      

    }

    public function cbtObjPage($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->first(); 
        $examViewType= $examSetting->exam_view_type;

        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();

        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('semester', $examSetting->semester)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();  
            
        $currentQuestion = QuestionSingle::where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('no_of_qst', $examSetting->no_of_qst)
                        ->where('semester', $examSetting->semester)
                        ->where('question_no', $cbtEvaluation->A1)
                        ->first();

        $pageNo = 1;
        $currentQuestionNo = 1;
        $currentQuestionType = $currentQuestion->question_type;
        $studentMin = $cbtEvaluation->minute;

        if($examViewType == 'Multi-Page'){
            return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','pageNo','studentMin'));
        }
        elseif($examViewType == 'Single-Page'){
            return view('student.pages.cbt-single-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','pageNo','studentMin','studentAnswer','currentQuestion','currentQuestionNo','currentQuestionType'));
        }
        

    }

    public function cbtTheoryPage($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::where('department', $studentData->department)
            ->where('level', $studentData->level)
            ->first(); 

        $cbtEvaluation = TheoryAnswer::where('studentno', $studentData->admission_no)
            ->where('session1', $examSetting->session1)
            ->where('department', $examSetting->department)
            ->where('level', $examSetting->level)
            ->where('semester', $examSetting->semester)
            ->where('course', $examSetting->course)
            ->where('exam_mode', $examSetting->exam_mode)
            ->where('exam_type', $examSetting->exam_type)
            ->where('exam_category', $examSetting->exam_category)
            ->where('upload_no_of_qst', $examSetting->upload_no_of_qst)
            ->where('no_of_qst', $examSetting->no_of_qst)
            ->first();

        $currentQuestionNo = 1;
        $currentQuestion = $cbtEvaluation->{'Q' . $currentQuestionNo};  
        $currentAnswer = $cbtEvaluation->{'ANS' . $currentQuestionNo};  
        $currentQuestionType = $cbtEvaluation->{'QT' . $currentQuestionNo};  
        

        $pageNo = 1;
        $studentMin = $cbtEvaluation->minute;
        return view('student.pages.cbt-theory-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','pageNo','studentMin','currentQuestion','currentQuestionNo','currentAnswer',
         'currentQuestionType'));

    }

    public function studentLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');


    }

}
