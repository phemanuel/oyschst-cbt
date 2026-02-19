<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Station;
use App\Models\StationResult;
use App\Models\ExaminerScore;
use App\Models\Procedure;
use App\Models\StudentAdmission;
use App\Models\StudentMcqAnswer;
use Illuminate\Support\Facades\DB;

class ExaminerController extends Controller
{
    // List all examiners
    public function index()
    {
        $examiners = User::whereIn('user_type', ['examiner', 'admin'])->get(); 
        $stations = Station::All();
        return view('osce.examiners.index', compact('examiners','stations'));
    }

    // Store new examiner
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'user_status' => 'nullable|in:Active,Inactive',
            'user_type' => 'nullable|in:admin,examiner',
        ]);

        $examiner = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
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
            'success' => 'Admin/Examiner added successfully!',
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
            'user_status' => 'nullable|in:Active,Inactive',
            'user_type' => 'nullable|in:admin,examiner',
        ]);

        $examiner->name = $request->name;
        $examiner->email = $request->email;
        $examiner->user_type = $request->user_type;
        if($request->password){
            $examiner->password = Hash::make($request->password);
        }
        $examiner->user_status = $request->user_status ?? $examiner->user_status;
        $examiner->save();

        return response()->json([
            'success' => 'Admin/Examiner updated successfully!',
            'examiner' => $examiner
        ]);
    }

    // Delete examiner
    public function destroy(User $examiner)
    {
        $examiner->delete();

        return response()->json([
            'success' => 'Admin/Examiner deleted successfully!',
        ]);
    }

    // Show all stations as cards
    public function dashboard()
    {
        $user = auth()->user();

        $stations = \App\Models\Station::with([
            'procedures',
            'mcqQuestions',
            'stationResults.student'
        ])
        ->where('id', $user->station_id) // 👈 filter by assigned station
        ->get();

        return view('osce.examiners.dashboard', compact('stations'));
    }



    // Return students for a station (modal)
    public function stationStudents(Request $request, $stationId)
    {
        // Start query, only students with admission_no
        $query = StudentAdmission::whereNotNull('admission_no');

        // Optional search query
        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('admission_no', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('surname', 'like', "%{$search}%");
            });
        }

        $students = $query->orderBy('surname')->limit(100)->get();

        // Add hasResult flag for each student
        $students->map(function($student) use ($stationId) {
            $student->hasResult = ExaminerScore::where('student_id', $student->id)
                ->where('station_id', $stationId)
                ->exists();
            return $student;
        });

        return response()->json([
            'students' => $students
        ]);
    }


    public function startProcedure(Station $station, StudentAdmission $student)
    {
        // Fetch procedures for this station
        $procedures = $station->procedures()->orderBy('id')->get();

        // Fetch existing examiner scores
        $examinerScores = ExaminerScore::where('station_id', $station->id)
            ->where('student_id', $student->id)
            ->pluck('score', 'procedure_id')
            ->toArray();

        // Check if already started/completed
        $hasResult = !empty($examinerScores);

        return view('osce.examiners.start_procedure', compact(
            'station',
            'student',
            'procedures',
            'examinerScores',
            'hasResult'
        ));
    }


    // Return procedures for selected student and station
 public function storeProcedureScores(Request $request, Station $station, StudentAdmission $student)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            $totalExaminerScore = 0;

            $proceduresScores = $request->input('procedures', []); // array [procedure_id => score]

            foreach ($proceduresScores as $procedureId => $score) {
                // Check score type
                info("Saving score: student={$student->id}, station={$station->id}, procedure={$procedureId}, score={$score}");

                ExaminerScore::updateOrCreate(
                    [
                        'student_id'   => $student->id,
                        'station_id'   => $station->id,
                        'procedure_id' => $procedureId,
                    ],
                    [
                        'score' => $score,
                    ]
                );

                $totalExaminerScore += $score;
            }

            // Update or create station result
            $stationResult = StationResult::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'station_id' => $station->id,
                ],
                [
                    'examiner_score' => $totalExaminerScore,
                    'mcq_time_left' => $station->duration,
                ]
            );

            $mcqScore = $stationResult->mcq_score ?? 0;

            $stationResult->update([
                'total_score' => $totalExaminerScore + $mcqScore
            ]);

            DB::commit();

            return redirect()->route('examiner.dashboard')
                ->with('success', 'Procedure Scores saved successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the exception so we can see it in storage/logs/laravel.log
            \Log::error('Error saving procedure scores: '.$e->getMessage(), [
                'student' => $student->id,
                'station' => $station->id,
                'request' => $request->all()
            ]);

            return back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function assignStation(Request $request, User $user)
    {
        $request->validate([
            'station_id' => 'nullable|exists:stations,id'
        ]);

        $user->update([
            'station_id' => $request->station_id
        ]);

        return response()->json([
            'success' => true
        ]);
    }



}
