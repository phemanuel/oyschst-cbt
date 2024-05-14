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
                                            
            return redirect()->route('cbt-page', ['id' => $studentData->id]);
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

    public function cbtPage($id)
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
            ]);

            // Save the shuffled question numbers along with the student record
            foreach ($randomizedQuestions as $index => $questionNumber) {
                $field = 'A' . ($index + 1); // Generate field name like A1, A2, A3, etc.
                $student->{$field} = $questionNumber;
            }

            // Save the changes
            $student->save();


        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
    'examSetting'));
    }
}
