<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use App\Models\User;
use App\Models\Department;
use App\Models\CourseStudyAll;
use App\Models\Question;
use App\Models\AcademicSession;
use App\Models\SoftwareVersion;
use App\Models\ExamType;
use App\Models\Station;
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
use App\Models\Courses;
use Carbon\Carbon;

class OSCEDashboardController extends Controller
{
    //
    public function dashboard()
    {
        
       $collegeSetup = CollegeSetup::first(); 
        $students = StudentAdmission::all();
        $users = User::where('user_type', 'examiner')->get();
        $stations = Station::all();
        $departments = Department::all();
        $questions = QuestionSetting::all();
        $softwareVersion = SoftwareVersion::first();

        return view('osce.admin-dashboard', compact('students', 'users', 'stations'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/osce');


    }

    public function dashboardCheck()
    {
        $user = auth()->user();

        if(empty($user)){
            return redirect()->route('osce.home')->with('error', 'You need to login to gain access.');
        }
        
        $userType = $user->user_type;

        if($userType === 'superadmin'){
            return redirect()->route('osce.dashboard');
        }
        elseif($userType === 'admin'){
            return redirect()->route('osce.dashboard');
        }
        else{
            return redirect()->route('examiner.dashboard');
        }
    }
}
