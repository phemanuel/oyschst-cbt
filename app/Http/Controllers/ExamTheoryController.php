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

class ExamTheoryController extends Controller
{
    //
    public function cbtTheory($id)
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
            $semester = $examSetting->semester;
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
            ->where('semester', $semester)
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
}
