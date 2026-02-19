<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Department;
use App\Models\CourseStudyAll;

class OSCEStudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = StudentAdmission::all();
         $departments = Department::all();
        return view('osce.students.index', compact('students','departments'));
    }

    // Store new student
    public function store(Request $request)
    {
        $request->validate([
            'admission_no' => 'required|unique:student_admissions,admission_no',
            'first_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            // 'email' => 'nullable|email|unique:student_admissions,email',
            'password' => 'required|string|min:6',
        ]);

        $student = StudentAdmission::create([
            'admission_no' => $request->admission_no,
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'other_name' => $request->other_name ?? null,
            'department' => $request->department ?? null,
            'department1' => $request->department1 ?? null,
            'phone_no' => $request->phone_no ?? null,
            'phone_no1' => $request->phone_no1 ?? null,
            'state' => $request->state ?? null,
            'level' => $request->level ?? null,
            'sex' => $request->sex ?? null,
            'user_name' => $request->user_name ?? null,
            'picture_name' => $request->picture_name ?? null,
            'session1' => $request->session1 ?? null,
            'login_status' => $request->login_status ?? 0,            
            'user_type' => 'student',
            'password' => Hash::make($request->password),
            'login_attempts' => 0,
        ]);

        return response()->json([
            'success' => 'Student added successfully!',
            'student' => $student
        ]);
    }

    // Update student
    public function update(Request $request, StudentAdmission $student)
    {
        $request->validate([
            'admission_no' => ['required', Rule::unique('student_admissions')->ignore($student->id)],
            'first_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',           
            'password' => 'nullable|string|min:6',
        ]);

        $student->admission_no = $request->admission_no;
        $student->first_name = $request->first_name;
        $student->surname = $request->surname;
        $student->other_name = $request->other_name ?? $student->other_name;
        $student->department = $request->department ?? $student->department;
        $student->department1 = $request->department1 ?? $student->department1;
        $student->phone_no = $request->phone_no ?? $student->phone_no;
        $student->phone_no1 = $request->phone_no1 ?? $student->phone_no1;
        $student->state = $request->state ?? $student->state;
        $student->level = $request->level ?? $student->level;
        $student->sex = $request->sex ?? $student->sex;
        $student->user_name = $request->user_name ?? $student->user_name;
        $student->picture_name = $request->picture_name ?? $student->picture_name;
        $student->session1 = $request->session1 ?? $student->session1;
        $student->login_status = $request->login_status ?? $student->login_status;        
        if($request->password){
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return response()->json([
            'success' => 'Student updated successfully!',
            'student' => $student
        ]);
    }

    // Delete student
    public function destroy(StudentAdmission $student)
    {
        $student->delete();

        return response()->json([
            'success' => 'Student deleted successfully!',
        ]);
    }
}
