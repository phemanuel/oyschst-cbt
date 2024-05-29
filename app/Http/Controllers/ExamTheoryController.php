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
use Carbon\Carbon;
use App\Models\TheoryQuestion;
use App\Models\TheoryAnswer;

class ExamTheoryController extends Controller
{
    //
    public function cbtTheory($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        // Setup student CBT data
        $uploadNoOfQuestions = $examSetting->upload_no_of_qst;
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
        $semester = $examSetting->semester;

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

        if ($studentDataExist) {
            return response()->json([
                'data' => $studentDataExist,
            ]);
            // return redirect()->route('cbt-continue', ['admission_no' => $studentData->admission_no]);
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

        // Fetch the questions and create TheoryAnswer records
        foreach ($randomizedQuestions as $index => $questionNumber) {
            $question = TheoryQuestion::where('course', $course)
                ->where('exam_mode', $examMode)
                ->where('exam_type', $examType)
                ->where('exam_category', $examCategory)
                ->where('department', $department)
                ->where('level', $level)
                ->where('semester', $semester)
                ->where('no_of_qst', $noOfQuestions)
                ->where('upload_no_of_qst', $uploadNoOfQuestions)
                ->where('question_no', $questionNumber)
                ->first();

            if ($question) {
                TheoryAnswer::create([
                    'examstatus' => 1,
                    'studentname' => $studentName,
                    'no_of_qst' => $noOfQuestions,
                    'session1' => $session1,
                    'department' => $department,
                    'upload_no_of_qst' => $uploadNoOfQuestions,
                    'level' => $level,
                    'exam_type' => $examType,
                    'exam_mode' => $examMode,
                    'exam_category' => $examCategory,                    
                    'studentno' => $studentNo,
                    'course' => $course,
                    'question_type' => $question->question_type,
                    'question_no' => $questionNumber,
                    'question' => $question->question,
                    'answer' => '', 
                    'score' => 0, 
                    'graphic' => $question->graphic,
                    'course' => $course,
                    'semester' => $semester,
                ]);
            }
        }

        
        return redirect()->to(route('cbt-theory-page', ['id' => $studentData->id]));
    }

    public function cbtTheoryPage($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();

        $examSetting = ExamSetting::first();       
        
        //--get variables
        $exam_type = $examSetting->exam_type;
        $exam_category = $examSetting->exam_category;
        $exam_mode = $examSetting->exam_mode;
        $department = $examSetting->department;
        $session1 = $examSetting->session1;
        $upload_no_of_qst = $examSetting->upload_no_of_qst;
        $no_of_qst = $examSetting->no_of_qst;
        $level = $examSetting->level;
        $course = $examSetting->course;
        $semester = $examSetting->semester;

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
        $studentMin = $cbtEvaluation->minute;

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

        $pageNo = 1;
        if (!$question){
            return redirect()->back()->with('error', 'An error occurred. Please try again.');     
        }
        return view('student.pages.cbt-theory-page', compact('softwareVersion', 'collegeSetup'
        ,'question', 'studentData','examSetting','pageNo','studentMin'));
    }
}
