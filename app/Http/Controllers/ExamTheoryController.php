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

        // Generate a random set of numbers representing the questions
        $questionNumbers = range(1, $uploadNoOfQuestions);
        shuffle($questionNumbers);
        $randomizedQuestions = array_slice($questionNumbers, 0, $noOfQuestions);

        $studentDataExist = TheoryAnswer::where('studentno', $studentData->admission_no)
            ->where('exam_mode', $examMode)
            ->where('exam_type', $examType)
            ->where('exam_category', $examCategory)
            ->where('department', $department)
            ->where('level', $level)
            ->where('semester', $semester)
            ->where('course', $course)
            ->where('upload_no_of_qst', $uploadNoOfQuestions)
            ->where('no_of_qst', $noOfQuestions)
            ->first();

        if ($studentDataExist) {
            return redirect()->route('cbt-continue', ['admission_no' => $studentData->admission_no]);
        }

        // Create or update the student record
        $student = TheoryAnswer::firstOrCreate([
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
            'minute' => $examSetting->duration * 60,
            'hour' => $examSetting->duration,
            'no_of_qst' => $noOfQuestions,
            'upload_no_of_qst' => $uploadNoOfQuestions,
            'examstatus' => 1,
            'exam_date' => now(),
            'total_score' => 0,
        ]);

        // Save the shuffled question numbers along with the student record
        foreach ($randomizedQuestions as $index => $questionNumber) {
            $field = 'A' . ($index + 1); // Generate field name like A1, A2, A3, etc.
            $student->{$field} = $questionNumber;
        }

        // Fetch the questions and update the same TheoryAnswer record
        foreach ($randomizedQuestions as $index => $questionNumber) {
            $question = TheoryQuestion::where('course', $course)
                ->where('exam_mode', $examMode)
                ->where('exam_type', $examType)
                ->where('exam_category', $examCategory)
                ->where('department', $department)
                ->where('level', $level)
                ->where('semester', $semester)
                ->where('question_no', $questionNumber)
                ->first();

            if ($question) {
                $questionField = 'Q' . ($index + 1);
                $questionTypeField = 'QT' . ($index + 1); 
                $questionTGraphicField = 'G' . ($index + 1);// Generate field name like Q1, Q2, Q3, etc.
                $student->{$questionField} = $question->question;
                $student->{$questionTGraphicField} = $question->graphic;
                $student->{$questionTypeField} = $question->question_type;
            }
        }

        // Save the changes
        $student->save();

        return redirect()->to(route('cbt-theory-page', ['id' => $studentData->id]));
    }


    public function cbtTheoryPage($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

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

        $currentQuestion = $cbtEvaluation->Q1;  
        $currentAnswer = $cbtEvaluation->ANS1;  
        $currentQuestionType = $cbtEvaluation->question_type;  
        $currentQuestionNo = 1;

        $pageNo = 1;
        $studentMin = $cbtEvaluation->minute;
        return view('student.pages.cbt-theory-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','pageNo','studentMin','currentQuestion','currentQuestionNo','currentAnswer',
    'currentQuestionType'));

    }
}
