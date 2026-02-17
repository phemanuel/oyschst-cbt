<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\MCQQuestion;
use App\Models\MCQOption;
use App\Models\StudentMCQAnswer;
use App\Models\StudentAdmission;
use App\Models\StationResult;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    public function studentDashboard(Request $request)
    {
        $studentId = $request->session()->get('osce_student');
        if (!$studentId) {
            return redirect()->route('osce-home')
        ->with('error', 'Please login as a student to access this page.');
        }

        $student = StudentAdmission::find($studentId); // or your StudentAdmission model
        $stations = Station::all();
        $completedStations = StationResult::where('student_id', $student->id)
        ->pluck('station_id')
        ->toArray();

        return view('osce.students.dashboard', compact('stations', 'completedStations'));
    }


    public function loadStation(Request $request, Station $station)
    {
        $studentId = $request->session()->get('osce_student');
        $student = StudentAdmission::find($studentId);

        if (!$studentId || !$student) {
            return redirect()->route('osce-home')
                ->with('error', 'Please login as a student to access this page.');
        }

        // Fetch all stations ordered by ID
        $allStations = Station::orderBy('id')->get();

        // Check which stations have been completed procedurally (examiner_scores)
        $completedProcedures = \DB::table('examiner_scores')
            ->where('student_id', $studentId)
            ->pluck('station_id')
            ->toArray();

        // Check which stations' MCQs have been done
        $completedMCQs = StationResult::where('student_id', $studentId)
            ->where('mcq_score', '>=', 0)
            ->pluck('station_id')
            ->toArray();

        // Find the index of the station the student wants to access
        $stationIndex = $allStations->search(fn($s) => $s->id == $station->id);

        // Check if previous station's MCQ is done (enforce MCQ sequence)
        if ($stationIndex > 0) {
            $previousStationId = $allStations[$stationIndex - 1]->id;
            if (!in_array($previousStationId, $completedMCQs)) {
                return redirect()->route('student.dashboard')
                    ->with('error', 'You must complete the MCQ of the previous station before attempting this one.');
            }
        }

        // Check if the current station procedure is completed (unlocking condition)
        if (!in_array($station->id, $completedProcedures)) {
            return redirect()->route('student.dashboard')
                ->with('error', 'You must complete the procedure before accessing this station.');
        }

        // Load MCQ questions
        $questions = $station->mcqQuestions()->with('options')->get();

        // Get or create station result to track time (without overwriting existing scores)
        $stationResult = StationResult::firstOrNew(
            ['student_id' => $studentId, 'station_id' => $station->id]
        );

        if (!$stationResult->exists) {
            $stationResult->mcq_score = 0;
            $stationResult->mcq_time_left = $station->duration; // seconds
            $stationResult->save();
        }

        // Get previous answers for the MCQs
        $answers = StudentMCQAnswer::where('student_id', $studentId)
            ->whereIn('mcq_id', $questions->pluck('id'))
            ->pluck('option_id', 'mcq_id');

        return view('osce.students.cbt', compact('student', 'station', 'questions', 'answers', 'stationResult'));
    }


    public function saveAnswer(Request $request)
    {
        $studentId = $request->session()->get('osce_student');
        if (!$studentId) {
           return redirect()->route('osce-home')
            ->with('error', 'Please login as a student to access this page.');
        }

        $mcq_id = $request->mcq_id;
        $option_id = $request->option_id;

        $answer = StudentMCQAnswer::updateOrCreate(
            [
                'student_id' => $studentId,
                'mcq_id' => $mcq_id
            ],
            ['option_id' => $option_id]
        );

        return response()->json(['success' => true]);
    }

    public function submitStation(Request $request, Station $station)
    {
        $studentId = $request->session()->get('osce_student');
        if (!$studentId) {
           return redirect()->route('osce-home')
        ->with('error', 'Please login as a student to access this page.');
        }

        $questions = $station->mcqQuestions()->with('options')->get();

        $totalScore = 0;

        foreach ($questions as $question) {
            $answer = StudentMCQAnswer::where('student_id', $studentId)
                        ->where('mcq_id', $question->id)
                        ->first();
            if ($answer && $answer->selectedOption && $answer->selectedOption->is_correct) {
                $totalScore += $question->mark;
            }
        }

        // Update station result
        $stationResult = StationResult::updateOrCreate(
            ['student_id' => $student->id, 'station_id' => $station->id],
            ['mcq_score' => $totalScore, 'total_score' => $totalScore] // Update only MCQ part
        );

        return redirect()->route('student.dashboard')->with('success', 'Station completed!');
    }

    public function saveTime(Request $request, Station $station)
    {
        $studentId = $request->session()->get('osce_student');
        if (!$studentId) {
            return redirect()->route('osce-home')
        ->with('error', 'Please login as a student to access this page.');
        }

        $timeLeft = $request->time_left;

        StationResult::updateOrCreate(
            ['student_id' => $studentId, 'station_id' => $station->id],
            ['mcq_time_left' => $timeLeft]
        );

        return response()->json(['success' => true]);
    }

}
