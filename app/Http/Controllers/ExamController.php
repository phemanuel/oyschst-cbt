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

            // Generate a random set of numbers representing the questions
            $questionNumbers = range(1, $noOfQuestions);
            shuffle($questionNumbers);
            $randomizedQuestions = array_slice($questionNumbers, 0, $noOfQuestions);

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
            
            return redirect()->to(route('cbt-page1', ['id' => $studentData->id]));
    }

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
            'q1' => 1, 'q2' => 2, 'q3' => 3, 'q4' => 4, 'q5' => 5, 'q6' => 6, 'q7' => 7, 'q8' => 8,'q9' => 9, 'q10' => 10
        ];
        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','question1','question2','question3','question4','question5','question6','question7',
        'question8','question9','question10', 'questionNo','studentAnswer'));
    
    }
}
