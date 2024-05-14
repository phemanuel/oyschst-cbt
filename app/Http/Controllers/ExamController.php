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

class ExamController extends Controller
{
    //
    public function cbtCheck($id)
    {
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
                                         

        return response()->json([
            'status' => 'success',
            'Student Dept' => $studentDept,
            'Exam Dept' => $examDept,
            'Student Level' => $studentLevel,
            'Exam Level' => $examLevel,
        ]);

    }
}
