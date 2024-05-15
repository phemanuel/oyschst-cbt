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
use App\Models\CbtEvaluation;
use App\Models\CbtEvaluation1;
use App\Models\CbtEvaluation2;



class ExamController extends Controller
{
    //
    public function cbtCheck($id)
    {
        try {
            $examSetting = ExamSetting::first();
            $studentData = StudentAdmission::where('id', $id)->first();
            $examSetting = ExamSetting::first();
            // Check if the question for current exam setting is available
            $existingQuestion = Question::where('exam_type', $examSetting->exam_type)
                                                ->where('exam_category', $examSetting->exam_category)
                                                ->where('exam_mode', $examSetting->exam_mode)
                                                ->where('department', $examSetting->department)
                                                ->where('level', $examSetting->level)
                                                ->where('session1', $examSetting->session1)
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

    public function cbtContinue($admission_no)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $examSetting = ExamSetting::first(); 

        $studentData = StudentAdmission::where('admission_no', $admission_no)
                        //->where('department', $department)
                        ->first();

        $cbtEvaluation = CbtEvaluation::where('studentno', $admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $examSetting->department)
                        ->where('level', $examSetting->level)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $examStatus = $cbtEvaluation->examstatus;
        $pageNo = $cbtEvaluation->pageno;
        If($examStatus == 2){
            return redirect()->back()->with('error', 'You have completed the computer based test.');
        }      

        return view('student.pages.cbt-continue', compact('softwareVersion', 'collegeSetup', 'studentData',
        'examSetting','pageNo'));
    }

    public function cbtProcess($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        //--setup student cbt data
            $noOfQuestions = $examSetting->no_of_qst;
            $studentName = $studentData->surname . " " . $studentData->first_name . " " . $studentData->other_name;
            $studentNo = $studentData->admission_no;
            $department = $studentData->department;
            $level = $studentData->level;
            $course = $examSetting->course;
            $examCategory = $examSetting->exam_category;
            $examMode = $examSetting->exam_mode;
            $examType = $examSetting->exam_type;
            $semester = $examSetting->semester;
            $session1 = $examSetting->session1;  
            $noOfQuestions  = $examSetting->no_of_qst;          

            // Generate a random set of numbers representing the questions
            $questionNumbers = range(1, $noOfQuestions);
            shuffle($questionNumbers);
            $randomizedQuestions = array_slice($questionNumbers, 0, $noOfQuestions);

            $studentDataExist = CbtEvaluation::where('studentno', $studentData->admission_no)
            ->where('exam_mode', $examMode)
            ->where('exam_type', $examType)
            ->where('exam_category', $examCategory)
            ->where('department', $department)
            ->where('level', $level)
            ->where('course', $course)
            ->where('noofquestion', $noOfQuestions)
            ->first();
            if($studentDataExist){
                return redirect()->route('cbt-continue', ['admission_no' => $studentData->admission_no]);
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
                'hour' => 0,
                'minute' => 0,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => date('Y-m-d H:i:s'),
                'endtime' => date('Y-m-d H:i:s'),
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
                'hour' => 0,
                'minute' => 0,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => date('Y-m-d H:i:s'),
                'endtime' => date('Y-m-d H:i:s'),
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
                'hour' => 0,
                'minute' => 0,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => date('Y-m-d H:i:s'),
                'endtime' => date('Y-m-d H:i:s'),
                'noofquestion' => $noOfQuestions,
            ]);

            foreach ($randomizedQuestions as $index => $questionNumber) {
                $field = 'OK' . ($index + 1); // Generate field name like A1, A2, A3, etc.
                $student2->{$field} = "Nill";
            }
            // Save the changes in CbtEvaluation1 model
            $student2->save();
            $pageNo = 1;
            return redirect()->to(route('cbt-page1', ['id' => $studentData->id]));
    }

    //--Page 1
    public function cbtPage1($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        if($examSetting->no_of_qst < 10){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
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
            'q9' => 9, 'q10' => 10,
            'a1' => 1, 'a2' => 2, 'a3' => 3, 'a4' => 4, 'a5' => 5, 'a6' => 6, 'a7' => 7, 'a8' => 8,
            'a9' => 9, 'a10' => 10
        ];
        $pageNo = 1;
        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','question1','question2','question3','question4','question5','question6','question7',
        'question8','question9','question10', 'questionNo','studentAnswer','pageNo'));
    
    }

    //--Page 2
    public function cbtPage2($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        if($examSetting->no_of_qst < 20){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
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
            'q9' => 19, 'q10' => 20,
            'a1' => 11, 'a2' => 12, 'a3' => 13, 'a4' => 14, 'a5' => 15, 'a6' => 16, 'a7' => 17, 'a8' => 18,
            'a9' => 19, 'a10' => 20
        ];
        $pageNo = 2;
        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','question1','question2','question3','question4','question5','question6','question7',
        'question8','question9','question10', 'questionNo','studentAnswer','pageNo'));
    
    }    

    //---Page3
    public function cbtPage3($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        if($examSetting->no_of_qst < 30){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
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
            'q9' => 29, 'q10' => 30,
            'a1' => 21, 'a2' => 22, 'a3' => 23, 'a4' => 24, 'a5' => 25, 'a6' => 26, 'a7' => 27, 'a8' => 28,
            'a9' => 29, 'a10' => 30
        ];
        $pageNo = 2;
        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','question1','question2','question3','question4','question5','question6','question7',
        'question8','question9','question10', 'questionNo','studentAnswer','pageNo'));
    
    }    

    //---Page 4
    public function cbtPage4($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        if($examSetting->no_of_qst < 40){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
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
            'q9' => 39, 'q10' => 40,
            'a1' => 41, 'a2' => 42, 'a3' => 43, 'a4' => 44, 'a5' => 45, 'a6' => 46, 'a7' => 47, 'a8' => 48,
            'a9' => 49, 'a10' => 50
        ];
        $pageNo = 1;
        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','question1','question2','question3','question4','question5','question6','question7',
        'question8','question9','question10', 'questionNo','studentAnswer','pageNo'));
    
    }
    //----Page5-----
    public function cbtPage5($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        if($examSetting->no_of_qst < 50){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
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
            'q9' => 49, 'q10' => 50,
            'a1' => 41, 'a2' => 42, 'a3' => 43, 'a4' => 44, 'a5' => 45, 'a6' => 46, 'a7' => 47, 'a8' => 48,
            'a9' => 49, 'a10' => 50
        ];
        $pageNo = 1;
        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','question1','question2','question3','question4','question5','question6','question7',
        'question8','question9','question10', 'questionNo','studentAnswer','pageNo'));
    
    }

    // public function checkPage(Request $request , $id)
    // {
    //     $pageNo = $request->get('pageNo');
    //     //$q1 = $request->get('q1'); session::put('q1', $q1);        

    //     if ($pageNo == 1) {
    //         return $this->page1Answer($request, $id); // Pass the $request object to page1Answer
    //     } elseif ($pageNo == 2) {
    //         return $this->page2Answer($request, $id);
    //     } elseif ($pageNo == 3) {
    //         return $this->page3Answer($request, $id);
    //     } elseif ($pageNo == 4) {
    //         return $this->page4Answer($request, $id);
    //     } elseif ($pageNo == 5) {
    //         return $this->page5Answer($request, $id);
    //     } elseif ($pageNo == 6) {
    //         return $this->page2Answer($request, $id); // This should probably be page6Answer
    //     } elseif ($pageNo == 7) {
    //         return $this->page7Answer($request, $id);
    //     } elseif ($pageNo == 8) {
    //         return $this->page8Answer($request, $id);
    //     } elseif ($pageNo == 9) {
    //         return $this->page9Answer($request, $id);
    //     } elseif ($pageNo == 10) {
    //         return $this->page10Answer($request, $id);
    //     }
    // }    

    public function updateAnswersForPage(Request $request, $id, $pageNo)
    {
        $examSetting = ExamSetting::first();
        $studentData = StudentAdmission::find($id);

        // Calculate the start and end index based on the page number
        $startIndex = ($pageNo - 1) * 10 + 1;
        $endIndex = $startIndex + 9;

        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
            ->where('session1', $examSetting->session1)
            ->where('department', $examSetting->department)
            ->where('level', $examSetting->level)
            ->where('course', $examSetting->course)
            ->where('exam_mode', $examSetting->exam_mode)
            ->where('exam_type', $examSetting->exam_type)
            ->where('exam_category', $examSetting->exam_category)
            ->where('noofquestion', $examSetting->no_of_qst)
            ->first();

        // Update answers based on the form inputs
        $options = [];
        for ($i = $startIndex; $i <= $endIndex; $i++) {
            $option = null;
            $optionLetters = ['A', 'B', 'C', 'D'];
            foreach ($optionLetters as $letter) {
                $optionKey = "option{$i}{$letter}";
                if ($request->has($optionKey)) {
                    $option = $letter;
                    break;
                }
            }
            $optionFieldName = "OK{$i}";
            $options[$optionFieldName] = $option ?? $studentAnswer->{$optionFieldName};
        }

        $studentAnswer->update($options);

        // Redirect back to the corresponding page
        return call_user_func_array([$this, "cbtPage{$pageNo}"], ['id' => $id]);

    }

}
