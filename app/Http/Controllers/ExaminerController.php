<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Station;
use App\Models\Procedure;
use App\Models\StudentAdmission;

class ExaminerController extends Controller
{
    // List all examiners
    public function index()
    {
        $examiners = User::where('user_type', 'examiner')->get(); 
        return view('osce.examiners.index', compact('examiners'));
    }

    // Store new examiner
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'user_status' => 'nullable|in:active,inactive',
        ]);

        $examiner = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'examiner',
            'user_status' => $request->user_status ?? 'active',
            'email_verified_status' => 1,
            'login_attempts' => 0,

            // ---- Default all extra fields to 0 ----
            'exam_setting' => 0,
            'edit_exam_setting' => 0,
            'qst_bank' => 0,
            'create_question_bank' => 0,
            'edit_question_bank' => 0,
            'std_list' => 0,
            'create_std_list' => 0,
            'edit_std_list' => 0,
            'delete_std_list' => 0,
            'std_login_status' => 0,
            'edit_std_login_status' => 0,
            'change_course' => 0,
            'edit_change_course' => 0,
            'user_create' => 0,
            'create_user_create' => 0,
            'edit_user_create' => 0,
            'status_user_create' => 0,
            'college_setup' => 0,
            'create_college_setup' => 0,
            'edit_college_setup' => 0,
            'delete_college_setup' => 0,
            'report' => 0,
            'check_report' => 0,
            'export_report' => 0,
            'grading_report' => 0,
        ]);

        return response()->json([
            'success' => 'Examiner added successfully!',
            'examiner' => $examiner
        ]);
    }

    // Update examiner
    public function update(Request $request, User $examiner)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users')->ignore($examiner->id)],
            'password' => 'nullable|string|min:6',
            'user_status' => 'nullable|in:active,inactive',
        ]);

        $examiner->name = $request->name;
        $examiner->email = $request->email;
        if($request->password){
            $examiner->password = Hash::make($request->password);
        }
        $examiner->user_status = $request->user_status ?? $examiner->user_status;
        $examiner->save();

        return response()->json([
            'success' => 'Examiner updated successfully!',
            'examiner' => $examiner
        ]);
    }

    // Delete examiner
    public function destroy(User $examiner)
    {
        $examiner->delete();

        return response()->json([
            'success' => 'Examiner deleted successfully!',
        ]);
    }

    // Show all stations as cards
    public function dashboard()
    {
        $stations = Station::all();
        return view('osce.examiners.dashboard', compact('stations'));
    }

    // Return students for a station (modal)
    public function stationStudents(Station $station)
    {
        $students = StudentAdmission::all();
        return response()->json([
            'station' => $station,
            'students' => $students
        ]);
    }

    // Return procedures for selected student and station
    public function studentProcedures(Station $station, StudentAdmission $student)
    {
        $procedures = $station->procedures()->get();
        return response()->json([
            'student' => $student,
            'station' => $station,
            'procedures' => $procedures
        ]);
    }
}
