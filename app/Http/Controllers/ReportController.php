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

class ReportController extends Controller
{
    //
    public function index()
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $dept = Department::orderBy('department')->get();
        $acad_sessions = AcademicSession::orderBy('session1')->get();
        $examtype = ExamType::orderBy('exam_type')->get();
        $examSetting = ExamSetting::first();
        $level = CbtClass::orderBy('level')->get();
        $courseData = Courses::orderBy('course')->get();


        return view('dashboard.report', compact('softwareVersion', 'dept', 'acad_sessions', 
        'examtype','examSetting', 'collegeSetup', 'level','courseData'));
    }

    public function reportView(Request $request)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();        

        $validatedData = $request->validate([
            'session1' => 'required|string',
            'department' => 'required|string',
            'level' => 'required|string',
            'exam_category' => 'required|string',
            'exam_type' => 'required|string',
            'no_of_qst' => 'required|integer',  
            'course' => 'required|string',   
            'semester' => 'required|string',
            'exam_mode' => 'required|string',
        ]);  

        $student = CbtEvaluation::where('session1', $validatedData['session1'])
        ->where('department', $validatedData['department'])
        ->where('level', $validatedData['level'])
        ->where('semester', $validatedData['semester'])
        ->where('course', $validatedData['course'])
        ->where('exam_mode', $validatedData['exam_mode'])
        ->where('exam_type', $validatedData['exam_type'])
        ->where('exam_category', $validatedData['exam_category'])
        ->where('noofquestion', $validatedData['no_of_qst'])
        ->paginate(20);

        return view('dashboard.report-view', compact('softwareVersion','collegeSetup','student'));
    }

    public function examSheet($id)
    {

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
}
