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
use App\Models\Courses;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\QuestionSetting;
use Illuminate\Support\Facades\Session;
use App\Models\CbtEvaluation;
use App\Models\CbtEvaluation1;
use App\Models\CbtEvaluation2;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function index()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        return view('dashboard.report', compact('softwareVersion','collegeSetup'));
    }

    public function reportObjective()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();        
        $questionSetting = QuestionSetting::where('exam_mode', 'OBJECTIVE')
        ->orderBy('created_at', 'desc')
        ->Paginate(20);


        return view('dashboard.report-objective', compact('softwareVersion','collegeSetup', 'questionSetting'));
    }

    public function reportObjectiveView($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        $questionSetting = QuestionSetting::where('id', $id)->first();

        $student = CbtEvaluation::where('session1', $questionSetting->session1)
        ->where('department', $questionSetting->department)
        ->where('level', $questionSetting->level)
        ->where('semester', $questionSetting->semester)
        ->where('course', $questionSetting->course)
        ->where('exam_mode', $questionSetting->exam_mode)
        ->where('exam_type', $questionSetting->exam_type)
        ->where('exam_category', $questionSetting->exam_category)
        ->where('noofquestion', $questionSetting->no_of_qst)
        ->paginate(20);

        if(!$student){
            return redirect()->back()->with('error', 'Result is not available for exam you selected.');
        }

        return view('dashboard.report-objective-view', compact('softwareVersion','collegeSetup','student'));
    }

    public function studentResult($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        $studentResult = CbtEvaluation::where('id',$id)->first();

        if (!$studentResult){
            return redirect()->back()->with('error', 'Result not found.');
        }

        return view('dashboard.student-result', compact('softwareVersion','collegeSetup','studentResult'));
    }

    public function resultSearch(Request $request)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        $searchTerm = $request->input('search');

        // Perform search query
        $student = CbtEvaluation::where('studentno', 'LIKE', "%{$searchTerm}%")
            ->orWhere('studentname', 'LIKE', "%{$searchTerm}%")
            ->paginate(20);

        if (!$student){
            return redirect()->back()->with('error', 'Result not found.');
        }

        return view('dashboard.result-search', compact('softwareVersion','collegeSetup','student'));
    }

    public function reportSearch(Request $request)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        $searchTerm = $request->input('search');

        // Perform search query
        $reportData = QuestionSetting::where('session1', 'LIKE', "%{$searchTerm}%")
            ->orWhere('department', 'LIKE', "%{$searchTerm}%")
            ->orWhere('exam_type', 'LIKE', "%{$searchTerm}%")
            ->paginate(20);

        if (!$reportData){
            return redirect()->back()->with('error', 'Exam not found.');
        }

        return view('dashboard.report-search', compact('softwareVersion','collegeSetup','reportData'));
    }

    public function examSheetPage1($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A1;$qst2 = $cbtEvaluation->A2;$qst3 = $cbtEvaluation->A3;
        $qst4 = $cbtEvaluation->A4;$qst5 = $cbtEvaluation->A5;$qst6 = $cbtEvaluation->A6;
        $qst7 = $cbtEvaluation->A7;$qst8 = $cbtEvaluation->A8;$qst9 = $cbtEvaluation->A9;
        $qst10 = $cbtEvaluation->A10;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 1, 'q2' => 2, 'q3' => 3, 'q4' => 4, 'q5' => 5, 'q6' => 6, 'q7' => 7, 'q8' => 8,
            'q9' => 9, 'q10' => 10,
            'a1' => 1, 'a2' => 2, 'a3' => 3, 'a4' => 4, 'a5' => 5, 'a6' => 6, 'a7' => 7, 'a8' => 8,
            'a9' => 9, 'a10' => 10
        ];
        $pageNo = 1; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK1, 'a2' => $studentAnswer->OK2, 'a3' => $studentAnswer->OK3,
            'a4' => $studentAnswer->OK4, 'a5' => $studentAnswer->OK5, 'a6' => $studentAnswer->OK6,
            'a7' => $studentAnswer->OK7, 'a8' => $studentAnswer->OK8, 'a9' => $studentAnswer->OK9, 
            'a10' => $studentAnswer->OK10
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK1, 'c2' => $correctAnswer->OK2, 'c3' => $correctAnswer->OK3,
            'c4' => $correctAnswer->OK4, 'c5' => $correctAnswer->OK5, 'c6' => $correctAnswer->OK6,
            'c7' => $correctAnswer->OK7, 'c8' => $correctAnswer->OK8, 'c9' => $correctAnswer->OK9, 
            'c10' => $correctAnswer->OK10
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage2($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A11;$qst2 = $cbtEvaluation->A12;$qst3 = $cbtEvaluation->A13;
        $qst4 = $cbtEvaluation->A14;$qst5 = $cbtEvaluation->A15;$qst6 = $cbtEvaluation->A16;
        $qst7 = $cbtEvaluation->A17;$qst8 = $cbtEvaluation->A18;$qst9 = $cbtEvaluation->A19;
        $qst10 = $cbtEvaluation->A20;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 11, 'q2' => 12, 'q3' => 13, 'q4' => 14, 'q5' => 15, 'q6' => 16, 'q7' => 17, 'q8' => 18,
            'q9' => 19, 'q10' => 20,
            'a1' => 11, 'a2' => 12, 'a3' => 13, 'a4' => 14, 'a5' => 15, 'a6' => 16, 'a7' => 17, 'a8' => 18,
            'a9' => 19, 'a10' => 20
        ];
        $pageNo = 2; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK11, 'a2' => $studentAnswer->OK12, 'a3' => $studentAnswer->OK13,
            'a4' => $studentAnswer->OK14, 'a5' => $studentAnswer->OK15, 'a6' => $studentAnswer->OK16,
            'a7' => $studentAnswer->OK17, 'a8' => $studentAnswer->OK18, 'a9' => $studentAnswer->OK19, 
            'a10' => $studentAnswer->OK20
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK11, 'c2' => $correctAnswer->OK12, 'c3' => $correctAnswer->OK13,
            'c4' => $correctAnswer->OK14, 'c5' => $correctAnswer->OK15, 'c6' => $correctAnswer->OK16,
            'c7' => $correctAnswer->OK17, 'c8' => $correctAnswer->OK18, 'c9' => $correctAnswer->OK19, 
            'c10' => $correctAnswer->OK20
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage3($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A21;$qst2 = $cbtEvaluation->A22;$qst3 = $cbtEvaluation->A23;
        $qst4 = $cbtEvaluation->A24;$qst5 = $cbtEvaluation->A25;$qst6 = $cbtEvaluation->A26;
        $qst7 = $cbtEvaluation->A27;$qst8 = $cbtEvaluation->A28;$qst9 = $cbtEvaluation->A29;
        $qst10 = $cbtEvaluation->A30;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 21, 'q2' => 22, 'q3' => 23, 'q4' => 24, 'q5' => 25, 'q6' => 26, 'q7' => 27, 'q8' => 28,
            'q9' => 29, 'q10' => 30,
            'a1' => 21, 'a2' => 22, 'a3' => 23, 'a4' => 24, 'a5' => 25, 'a6' => 26, 'a7' => 27, 'a8' => 28,
            'a9' => 29, 'a10' => 30
        ];
        $pageNo = 3; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK21, 'a2' => $studentAnswer->OK22, 'a3' => $studentAnswer->OK23,
            'a4' => $studentAnswer->OK24, 'a5' => $studentAnswer->OK25, 'a6' => $studentAnswer->OK26,
            'a7' => $studentAnswer->OK27, 'a8' => $studentAnswer->OK28, 'a9' => $studentAnswer->OK29, 
            'a10' => $studentAnswer->OK30
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK21, 'c2' => $correctAnswer->OK22, 'c3' => $correctAnswer->OK23,
            'c4' => $correctAnswer->OK24, 'c5' => $correctAnswer->OK25, 'c6' => $correctAnswer->OK26,
            'c7' => $correctAnswer->OK27, 'c8' => $correctAnswer->OK28, 'c9' => $correctAnswer->OK29, 
            'c10' => $correctAnswer->OK30
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage4($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A31;$qst2 = $cbtEvaluation->A32;$qst3 = $cbtEvaluation->A33;
        $qst4 = $cbtEvaluation->A34;$qst5 = $cbtEvaluation->A35;$qst6 = $cbtEvaluation->A36;
        $qst7 = $cbtEvaluation->A37;$qst8 = $cbtEvaluation->A38;$qst9 = $cbtEvaluation->A39;
        $qst10 = $cbtEvaluation->A40;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 31, 'q2' => 32, 'q3' => 33, 'q4' => 34, 'q5' => 35, 'q6' => 36, 'q7' => 37, 'q8' => 38,
            'q9' => 39, 'q10' => 40,
            'a1' => 31, 'a2' => 32, 'a3' => 33, 'a4' => 34, 'a5' => 35, 'a6' => 36, 'a7' => 37, 'a8' => 38,
            'a9' => 39, 'a10' => 40
        ];
        $pageNo = 4; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK31, 'a2' => $studentAnswer->OK32, 'a3' => $studentAnswer->OK33,
            'a4' => $studentAnswer->OK34, 'a5' => $studentAnswer->OK35, 'a6' => $studentAnswer->OK36,
            'a7' => $studentAnswer->OK37, 'a8' => $studentAnswer->OK38, 'a9' => $studentAnswer->OK39, 
            'a10' => $studentAnswer->OK40
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK31, 'c2' => $correctAnswer->OK32, 'c3' => $correctAnswer->OK33,
            'c4' => $correctAnswer->OK34, 'c5' => $correctAnswer->OK35, 'c6' => $correctAnswer->OK36,
            'c7' => $correctAnswer->OK37, 'c8' => $correctAnswer->OK38, 'c9' => $correctAnswer->OK39, 
            'c10' => $correctAnswer->OK40
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage5($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A41;$qst2 = $cbtEvaluation->A42;$qst3 = $cbtEvaluation->A43;
        $qst4 = $cbtEvaluation->A44;$qst5 = $cbtEvaluation->A45;$qst6 = $cbtEvaluation->A46;
        $qst7 = $cbtEvaluation->A47;$qst8 = $cbtEvaluation->A48;$qst9 = $cbtEvaluation->A49;
        $qst10 = $cbtEvaluation->A50;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 41, 'q2' => 42, 'q3' => 43, 'q4' => 44, 'q5' => 45, 'q6' => 46, 'q7' => 47, 'q8' => 48,
            'q9' => 49, 'q10' => 50,
            'a1' => 41, 'a2' => 42, 'a3' => 43, 'a4' => 44, 'a5' => 45, 'a6' => 46, 'a7' => 47, 'a8' => 48,
            'a9' => 49, 'a10' => 50
        ];
        $pageNo = 5; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK41, 'a2' => $studentAnswer->OK42, 'a3' => $studentAnswer->OK43,
            'a4' => $studentAnswer->OK44, 'a5' => $studentAnswer->OK45, 'a6' => $studentAnswer->OK46,
            'a7' => $studentAnswer->OK47, 'a8' => $studentAnswer->OK48, 'a9' => $studentAnswer->OK49, 
            'a10' => $studentAnswer->OK50
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK41, 'c2' => $correctAnswer->OK42, 'c3' => $correctAnswer->OK43,
            'c4' => $correctAnswer->OK44, 'c5' => $correctAnswer->OK45, 'c6' => $correctAnswer->OK46,
            'c7' => $correctAnswer->OK47, 'c8' => $correctAnswer->OK48, 'c9' => $correctAnswer->OK49, 
            'c10' => $correctAnswer->OK50
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage6($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A51;$qst2 = $cbtEvaluation->A52;$qst3 = $cbtEvaluation->A53;
        $qst4 = $cbtEvaluation->A54;$qst5 = $cbtEvaluation->A55;$qst6 = $cbtEvaluation->A56;
        $qst7 = $cbtEvaluation->A57;$qst8 = $cbtEvaluation->A58;$qst9 = $cbtEvaluation->A59;
        $qst10 = $cbtEvaluation->A60;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 51, 'q2' => 52, 'q3' => 53, 'q4' => 54, 'q5' => 55, 'q6' => 56, 'q7' => 57, 'q8' => 58,
            'q9' => 59, 'q10' => 60,
            'a1' => 51, 'a2' => 52, 'a3' => 53, 'a4' => 54, 'a5' => 55, 'a6' => 56, 'a7' => 57, 'a8' => 58,
            'a9' => 59, 'a10' => 60
        ];
        $pageNo = 6; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK51, 'a2' => $studentAnswer->OK52, 'a3' => $studentAnswer->OK53,
            'a4' => $studentAnswer->OK54, 'a5' => $studentAnswer->OK55, 'a6' => $studentAnswer->OK56,
            'a7' => $studentAnswer->OK57, 'a8' => $studentAnswer->OK58, 'a9' => $studentAnswer->OK59, 
            'a10' => $studentAnswer->OK60
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK51, 'c2' => $correctAnswer->OK52, 'c3' => $correctAnswer->OK53,
            'c4' => $correctAnswer->OK54, 'c5' => $correctAnswer->OK55, 'c6' => $correctAnswer->OK56,
            'c7' => $correctAnswer->OK57, 'c8' => $correctAnswer->OK58, 'c9' => $correctAnswer->OK59, 
            'c10' => $correctAnswer->OK60
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage7($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A61;$qst2 = $cbtEvaluation->A62;$qst3 = $cbtEvaluation->A63;
        $qst4 = $cbtEvaluation->A64;$qst5 = $cbtEvaluation->A65;$qst6 = $cbtEvaluation->A66;
        $qst7 = $cbtEvaluation->A67;$qst8 = $cbtEvaluation->A68;$qst9 = $cbtEvaluation->A69;
        $qst10 = $cbtEvaluation->A70;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 61, 'q2' => 62, 'q3' => 63, 'q4' => 64, 'q5' => 65, 'q6' => 66, 'q7' => 67, 'q8' => 68,
            'q9' => 69, 'q10' => 70,
            'a1' => 61, 'a2' => 62, 'a3' => 63, 'a4' => 64, 'a5' => 65, 'a6' => 66, 'a7' => 67, 'a8' => 68,
            'a9' => 69, 'a10' => 70
        ];
        $pageNo = 7; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK61, 'a2' => $studentAnswer->OK62, 'a3' => $studentAnswer->OK63,
            'a4' => $studentAnswer->OK64, 'a5' => $studentAnswer->OK65, 'a6' => $studentAnswer->OK66,
            'a7' => $studentAnswer->OK67, 'a8' => $studentAnswer->OK68, 'a9' => $studentAnswer->OK69, 
            'a10' => $studentAnswer->OK70
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK61, 'c2' => $correctAnswer->OK62, 'c3' => $correctAnswer->OK63,
            'c4' => $correctAnswer->OK64, 'c5' => $correctAnswer->OK65, 'c6' => $correctAnswer->OK66,
            'c7' => $correctAnswer->OK67, 'c8' => $correctAnswer->OK68, 'c9' => $correctAnswer->OK69, 
            'c10' => $correctAnswer->OK70
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage8($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A71;$qst2 = $cbtEvaluation->A72;$qst3 = $cbtEvaluation->A73;
        $qst4 = $cbtEvaluation->A74;$qst5 = $cbtEvaluation->A75;$qst6 = $cbtEvaluation->A76;
        $qst7 = $cbtEvaluation->A77;$qst8 = $cbtEvaluation->A78;$qst9 = $cbtEvaluation->A79;
        $qst10 = $cbtEvaluation->A80;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 71, 'q2' => 72, 'q3' => 73, 'q4' => 74, 'q5' => 75, 'q6' => 76, 'q7' => 77, 'q8' => 78,
            'q9' => 79, 'q10' => 80,
            'a1' => 71, 'a2' => 72, 'a3' => 73, 'a4' => 74, 'a5' => 75, 'a6' => 76, 'a7' => 77, 'a8' => 78,
            'a9' => 79, 'a10' => 80
        ];
        $pageNo = 8; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK71, 'a2' => $studentAnswer->OK72, 'a3' => $studentAnswer->OK73,
            'a4' => $studentAnswer->OK74, 'a5' => $studentAnswer->OK75, 'a6' => $studentAnswer->OK76,
            'a7' => $studentAnswer->OK77, 'a8' => $studentAnswer->OK78, 'a9' => $studentAnswer->OK79, 
            'a10' => $studentAnswer->OK80
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK71, 'c2' => $correctAnswer->OK72, 'c3' => $correctAnswer->OK73,
            'c4' => $correctAnswer->OK74, 'c5' => $correctAnswer->OK75, 'c6' => $correctAnswer->OK76,
            'c7' => $correctAnswer->OK77, 'c8' => $correctAnswer->OK78, 'c9' => $correctAnswer->OK79, 
            'c10' => $correctAnswer->OK80
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage9($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A81;$qst2 = $cbtEvaluation->A82;$qst3 = $cbtEvaluation->A83;
        $qst4 = $cbtEvaluation->A84;$qst5 = $cbtEvaluation->A85;$qst6 = $cbtEvaluation->A86;
        $qst7 = $cbtEvaluation->A87;$qst8 = $cbtEvaluation->A88;$qst9 = $cbtEvaluation->A89;
        $qst10 = $cbtEvaluation->A90;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 81, 'q2' => 82, 'q3' => 83, 'q4' => 84, 'q5' => 85, 'q6' => 86, 'q7' => 87, 'q8' => 88,
            'q9' => 89, 'q10' => 90,
            'a1' => 81, 'a2' => 82, 'a3' => 83, 'a4' => 84, 'a5' => 85, 'a6' => 86, 'a7' => 87, 'a8' => 88,
            'a9' => 89, 'a10' => 90
        ];
        $pageNo = 9; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK81, 'a2' => $studentAnswer->OK82, 'a3' => $studentAnswer->OK83,
            'a4' => $studentAnswer->OK84, 'a5' => $studentAnswer->OK85, 'a6' => $studentAnswer->OK86,
            'a7' => $studentAnswer->OK87, 'a8' => $studentAnswer->OK88, 'a9' => $studentAnswer->OK89, 
            'a10' => $studentAnswer->OK90
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK81, 'c2' => $correctAnswer->OK82, 'c3' => $correctAnswer->OK83,
            'c4' => $correctAnswer->OK84, 'c5' => $correctAnswer->OK85, 'c6' => $correctAnswer->OK86,
            'c7' => $correctAnswer->OK87, 'c8' => $correctAnswer->OK88, 'c9' => $correctAnswer->OK89, 
            'c10' => $correctAnswer->OK90
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function examSheetPage10($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first(); 

        // Retrieve shuffled question numbers from CbtEvaluation model
        $qstData = CbtEvaluation::where('id', $id)->first();
        $cbtEvaluation = CbtEvaluation::where('studentno',$qstData->studentno)
                        ->where('session1', $qstData->session1)
                        ->where('department', $qstData->department)
                        ->where('level', $qstData->level)
                        ->where('semester', $qstData->semester)
                        ->where('course', $qstData->course)
                        ->where('exam_mode', $qstData->exam_mode)
                        ->where('exam_type', $qstData->exam_type)
                        ->where('exam_category', $qstData->exam_category)
                        ->where('noofquestion' , $qstData->noofquestion)
                        ->first();
        $noOfQst = $qstData->noofquestion;

        $qst1 = $cbtEvaluation->A91;$qst2 = $cbtEvaluation->A92;$qst3 = $cbtEvaluation->A93;
        $qst4 = $cbtEvaluation->A94;$qst5 = $cbtEvaluation->A95;$qst6 = $cbtEvaluation->A96;
        $qst7 = $cbtEvaluation->A97;$qst8 = $cbtEvaluation->A98;$qst9 = $cbtEvaluation->A99;
        $qst10 = $cbtEvaluation->A100;

        //--Student answer
        $studentAnswer = CbtEvaluation2::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();

        $correctAnswer = CbtEvaluation1::where('studentno',$qstData->studentno)
                                    ->where('session1', $qstData->session1)
                                    ->where('department', $qstData->department)
                                    ->where('level', $qstData->level)
                                    ->where('semester', $qstData->semester)
                                    ->where('course', $qstData->course)
                                    ->where('exam_mode', $qstData->exam_mode)
                                    ->where('exam_type', $qstData->exam_type)
                                    ->where('exam_category', $qstData->exam_category)
                                    ->where('noofquestion' , $qstData->noofquestion)
                                     ->first();
                        
        //---Qst1
        $question1 = Question::where('session1', $qstData->session1)
                    ->where('department', $qstData->department)
                    ->where('level', $qstData->level)
                    ->where('course', $qstData->course)
                    ->where('exam_mode', $qstData->exam_mode)
                    ->where('exam_type', $qstData->exam_type)
                    ->where('exam_category', $qstData->exam_category)
                    ->where('no_of_qst', $qstData->noofquestion)
                    ->where('semester', $qstData->semester)
                    ->where('question_no', $qst1)
                    ->first();    
            
        //---Qst2
        $question2 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst2)
        ->first();   
        //---Qst3
        $question3 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst3)
        ->first();   
        //---Qst4
        $question4 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst4)
        ->first();   
        //---Qst5
        $question5 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst5)
        ->first();   
        //---Qst6
        $question6 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst6)
        ->first();   
        //---Qst7
        $question7 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst7)
        ->first();   
        //---Qst8
        $question8 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst8)
        ->first();   
        //---Qst9
        $question9 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst9)
        ->first();   
        //---Qst10
        $question10 = Question::where('session1', $qstData->session1)
        ->where('department', $qstData->department)
        ->where('level', $qstData->level)
        ->where('course', $qstData->course)
        ->where('exam_mode', $qstData->exam_mode)
        ->where('exam_type', $qstData->exam_type)
        ->where('exam_category', $qstData->exam_category)
        ->where('no_of_qst', $qstData->noofquestion)
        ->where('semester', $qstData->semester)
        ->where('question_no', $qst10)
        ->first();   

        $questionNo = [
            'q1' => 91, 'q2' => 92, 'q3' => 93, 'q4' => 94, 'q5' => 95, 'q6' => 96, 'q7' => 97, 'q8' => 98,
            'q9' => 99, 'q10' => 100,
            'a1' => 91, 'a2' => 92, 'a3' => 93, 'a4' => 94, 'a5' => 95, 'a6' => 96, 'a7' => 97, 'a8' => 98,
            'a9' => 99, 'a10' => 100
        ];
        $pageNo = 10; 
        $studentAnswerData  = [
            'a1' => $studentAnswer->OK91, 'a2' => $studentAnswer->OK92, 'a3' => $studentAnswer->OK93,
            'a4' => $studentAnswer->OK94, 'a5' => $studentAnswer->OK95, 'a6' => $studentAnswer->OK96,
            'a7' => $studentAnswer->OK97, 'a8' => $studentAnswer->OK98, 'a9' => $studentAnswer->OK99, 
            'a10' => $studentAnswer->OK100
        ];
        $correctAnswerData = [
            'c1' => $correctAnswer->OK91, 'c2' => $correctAnswer->OK92, 'c3' => $correctAnswer->OK93,
            'c4' => $correctAnswer->OK94, 'c5' => $correctAnswer->OK95, 'c6' => $correctAnswer->OK96,
            'c7' => $correctAnswer->OK97, 'c8' => $correctAnswer->OK98, 'c9' => $correctAnswer->OK99, 
            'c10' => $correctAnswer->OK100
        ];

        
        return view('dashboard.exam-sheet', compact('pageNo', 'collegeSetup', 'softwareVersion',
        'questionNo', 'question1','question2', 'question3', 'question4', 'question5', 'question6'
        , 'question7', 'question8', 'question9', 'question10', 'studentAnswerData', 'correctAnswerData',
    'studentAnswer', 'correctAnswer','qstData', 'noOfQst'));
    }

    public function reportObjCsv($id)
    {        
        $questionSetting = QuestionSetting::where('id', $id)->first();                 
        
        //--get variables
        $exam_type = $questionSetting->exam_type;
        $exam_category = $questionSetting->exam_category;
        $exam_mode = $questionSetting->exam_mode;
        $department = $questionSetting->department;
        $level = $questionSetting->level;
        $session1 = $questionSetting->session1;
        $upload_no_of_qst = $questionSetting->no_of_qst;
        $course = $questionSetting->course;
        $semester = $questionSetting->semester;

        // Create SQL query with parameter binding
        $rows = DB::table('cbt_evaluations')
            ->select('studentno', 'studentname', 'correct')
            ->where('exam_type', $exam_type)
            ->where('exam_category', $exam_category)
            ->where('exam_mode', $exam_mode)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('session1', $session1)
            ->where('noofquestion', $upload_no_of_qst)
            ->where('course', $course)
            ->orderBy('studentno')
            ->get()
            ->toArray();
        
            // Check if rows are empty
        if (empty($rows)) {
            return redirect()->back()->with('error' , 'No results found .');
        }

        // Convert stdClass objects to arrays
        $rows = array_map(function($row) {
            return (array) $row;
        }, $rows);

        // Get the column names
        $columnNames = [];
        if (!empty($rows)) {
            $columnNames = array_keys($rows[0]);
        }

        $date1 = date('d-m-Y');
        $fileName = "{$session1}_{$exam_mode}_{$exam_type}_{$department}_{$date1}.csv";

        // Create a callback function to generate the CSV data
        $callback = function() use ($rows, $columnNames) {
            $file = fopen('php://output', 'w');
            // Write the column names
            fputcsv($file, $columnNames);

            // Write the rows
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        // Return the CSV as a streamed response
        return response()->stream($callback, 200, [
            'Content-Type' => 'application/excel',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]); 
    }


}
