<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\StationResult;
use App\Models\StudentAdmission;
use App\Models\StudentMcqAnswer;
use App\Models\ExaminerScore;

class StudentExamController extends Controller
{
    public function studentDashboard(Request $request)
    {
        $studentId = $request->session()->get('osce_student');

        if (!$studentId) {
            return redirect()->route('osce-home')
                ->with('error', 'Please login as a student to access this page.');
        }

        $student = StudentAdmission::find($studentId);

        $stations = Station::orderBy('id')->get();

        $stationStatus = [];

        foreach ($stations as $station) {

            // Procedure completed?
            $procedureDone = \DB::table('examiner_scores')
                ->where('student_id', $studentId)
                ->where('station_id', $station->id)
                ->exists();

            // MCQ submitted?
            $stationResult = \DB::table('station_results')
                ->where('student_id', $studentId)
                ->where('station_id', $station->id)
                ->first();

            $mcqDone = $stationResult && $stationResult->mcq_submitted;

            if (!$procedureDone) {
                $stationStatus[$station->id] = 'locked';
            } elseif ($procedureDone && !$mcqDone) {
                $stationStatus[$station->id] = 'available';
            } else {
                $stationStatus[$station->id] = 'completed';
            }
        }

        return view('osce.students.dashboard', compact('stations', 'stationStatus'));
    }


    public function loadStation(Request $request, Station $station)
    {
        $studentId = $request->session()->get('osce_student');

        if (!$studentId) {
            return redirect()->route('osce-home')
                ->with('error', 'Please login as a student to access this page.');
        }

        $student = StudentAdmission::find($studentId);

        if (!$student) {
            return redirect()->route('osce-home')
                ->with('error', 'Invalid student session.');
        }

        // Get all stations ordered
        $allStations = Station::orderBy('id')->get();

        // Find current station index
        $stationIndex = $allStations->search(function ($s) use ($station) {
            return $s->id == $station->id;
        });

        /*
        |--------------------------------------------------------------------------
        | 1️⃣ CHECK PREVIOUS STATION REQUIREMENTS
        |--------------------------------------------------------------------------
        */
        if ($stationIndex > 0) {

            $previousStationId = $allStations[$stationIndex - 1]->id;

            // Check previous station MCQ submitted
            $prevMCQSubmitted = StationResult::where('student_id', $studentId)
                ->where('station_id', $previousStationId)
                ->where('mcq_submitted', true)
                ->exists();

            if (!$prevMCQSubmitted) {
                return redirect()->route('student.dashboard')
                    ->with('error', 'You must complete the MCQ of the previous station before attempting this one.');
            }

            // Check previous station procedure completed
            $prevProcedureDone = \DB::table('examiner_scores')
                ->where('student_id', $studentId)
                ->where('station_id', $previousStationId)
                ->exists();

            if (!$prevProcedureDone) {
                return redirect()->route('student.dashboard')
                    ->with('error', 'You must complete the procedure of the previous station before attempting this one.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 2️⃣ CHECK CURRENT STATION PROCEDURE COMPLETED
        |--------------------------------------------------------------------------
        */
        $currentProcedureDone = \DB::table('examiner_scores')
            ->where('student_id', $studentId)
            ->where('station_id', $station->id)
            ->exists();

        if (!$currentProcedureDone) {
            return redirect()->route('student.dashboard')
                ->with('error', 'You must complete the procedure before accessing this station MCQ.');
        }

        /*
        |--------------------------------------------------------------------------
        | 3️⃣ LOAD MCQ QUESTIONS
        |--------------------------------------------------------------------------
        */
        $questions = $station->mcqQuestions()->with('options')->get();

        $noMcqs = $questions->isEmpty();

        /*
        |--------------------------------------------------------------------------
        | 4️⃣ CREATE OR LOAD STATION RESULT
        |--------------------------------------------------------------------------
        */
        $stationResult = StationResult::firstOrCreate(
            [
                'student_id' => $studentId,
                'station_id' => $station->id
            ],
            [
                'mcq_score' => 0,
                'total_score' => 0,
                'mcq_time_left' => $station->duration,
                'mcq_submitted' => false
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 5️⃣ LOAD PREVIOUS ANSWERS
        |--------------------------------------------------------------------------
        */
        $answers = StudentMCQAnswer::where('student_id', $studentId)
            ->where('station_id', $station->id)
            ->pluck('option_id', 'mcq_id');

        /*
        |--------------------------------------------------------------------------
        | 6️⃣ RETURN VIEW
        |--------------------------------------------------------------------------
        */
        return view('osce.students.cbt', compact(
            'student',
            'station',
            'questions',
            'answers',
            'stationResult',
            'noMcqs'
        ));
    }

    // ---------------- Save individual answer ----------------
    public function saveAnswer(Request $request)
    {
        $studentId = $request->session()->get('osce_student');
        if (!$studentId) {
            return response()->json(['success' => false, 'message' => 'Student not logged in']);
        }

        $mcq_id = $request->mcq_id;
        $option_id = $request->option_id;
        $station_id = $request->station_id;

        // Fetch mark from MCQQuestion model
        $question = \App\Models\MCQQuestion::find($mcq_id);
        $score = 0;

        if ($question) {
            $option = $question->options()->find($option_id);
            if ($option && $option->is_correct) {
                $score = $question->mark;
            }
        }

        // Save or update answer
        StudentMCQAnswer::updateOrCreate(
            [
                'student_id' => $studentId,
                'station_id' => $station_id,
                'mcq_id' => $mcq_id
            ],
            [
                'option_id' => $option_id,                
                'score' => $score
            ]
        );

        return response()->json(['success' => true]);
    }    

    // ---------------- Submit station ----------------
    public function submitStation(Request $request, Station $station)
{
    $studentId = session('osce_student');

    if (!$studentId) {
        return response()->json(['success' => false], 403);
    }

    // ----------------------------
    // 1️⃣ Get MCQ total (already stored per answer)
    // ----------------------------
    $mcqScore = \DB::table('student_mcq_answers')
        ->where('student_id', $studentId)
        ->where('station_id', $station->id)
        ->sum('score');

    // ----------------------------
    // 2️⃣ Get Examiner Score
    // ----------------------------
    $examinerScore = \DB::table('examiner_scores')
        ->where('student_id', $studentId)
        ->where('station_id', $station->id)
        ->sum('score');

    // Avoid null issues
    $mcqScore = $mcqScore ?? 0;
    $examinerScore = $examinerScore ?? 0;

    $totalScore = $mcqScore + $examinerScore;

    // ----------------------------
    // 3️⃣ Single Update (No firstOrCreate here)
    // ----------------------------
    \DB::table('station_results')
        ->where('student_id', $studentId)
        ->where('station_id', $station->id)
        ->update([
            'mcq_score'      => $mcqScore,
            'total_score'    => $totalScore,
            'mcq_submitted' => true
        ]);

    return response()->json(['success' => true]);
}



    // ---------------- Save remaining time ----------------
    public function saveTime(Request $request, Station $station)
    {
        $studentId = $request->session()->get('osce_student');
        if (!$studentId) {
            return response()->json(['success' => false]);
        }

        $timeLeft = $request->time_left; // in minutes

    //         \Log::info('Saving time', [
    //     'student_id' => $studentId,
    //     'station_id' => $station->id,
    //     'time_left' => $timeLeft
    // ]);

        StationResult::updateOrCreate(
            ['student_id' => $studentId, 'station_id' => $station->id],
            ['mcq_time_left' => $timeLeft]
        );

        return response()->json(['success' => true]);
    }

    // Display all stations with "Preview" buttons

    public function resultsPage()
    {
        $stations = Station::orderBy('id')->get();
        return view('osce.results.index', compact('stations'));
    }

    // Fetch all students who submitted MCQ for a station
    public function getStationResults(Station $station)
    {
        $results = StationResult::with('student')
            ->where('station_id', $station->id)
            ->where('mcq_submitted', 1)
            ->get();

        return response()->json($results);
    }

    // Fetch detailed student exam preview
    public function previewStudentResult($studentId, \App\Models\Station $station)
    {
        $student = StudentAdmission::findOrFail($studentId);

        // Procedures
        $procedures = ExaminerScore::with('procedure')
            ->where('student_id', $studentId)
            ->where('station_id', $station->id)
            ->get();

        // MCQs
        $mcqs = $station->mcqQuestions()->with('options')->get();

        $studentAnswers = \DB::table('student_mcq_answers')
            ->where('student_id', $studentId)
            ->whereIn('mcq_id', $mcqs->pluck('id'))
            ->pluck('option_id', 'mcq_id');

        return response()->json([
            'student' => $student,
            'procedures' => $procedures,
            'mcqs' => $mcqs,
            'studentAnswers' => $studentAnswers,
        ]);
    }

    public function summary()
    {
        $students = StudentAdmission::all();
        $stations = Station::all();

        $results = StationResult::all()
                    ->groupBy(function ($item) {
                        return $item->student_id . '-' . $item->station_id;
                    });

        $summary = [];

        foreach ($students as $student) {

            $studentData = [
                'student' => $student,
                'stations' => [],
                'overall_total' => 0
            ];

            foreach ($stations as $station) {

                $key = $student->id . '-' . $station->id;
                $result = $results->get($key)?->first();

                if ($result) {

                    $studentData['overall_total'] += $result->total_score;

                    $studentData['stations'][] = [
                        'station_id'     => $station->id,
                        'title'          => $station->title,
                        'completed'      => true,
                        'examiner_score' => $result->examiner_score,
                        'mcq_score'      => $result->mcq_score,
                        'total_score'    => $result->total_score,
                    ];
                } else {

                    $studentData['stations'][] = [
                        'station_id'     => $station->id,
                        'title'          => $station->title,
                        'completed'      => false,
                        'examiner_score' => 0,
                        'mcq_score'      => 0,
                        'total_score'    => 0,
                    ];
                }
            }

            $summary[] = $studentData;
        }

        return response()->json([
            'stations' => $stations,
            'students' => $summary
        ]);
    }

    public function fullSummary(StudentAdmission $student)
    {
        // Get stations where student has examiner scores
        $stationIds = ExaminerScore::where('student_id', $student->id)
            ->distinct()
            ->pluck('station_id');

        $stations = Station::whereIn('id', $stationIds)
            ->with(['procedures', 'mcqQuestions.options'])
            ->get();

        $data = [];

        foreach ($stations as $station) {

            // ===============================
            // PROCEDURES WITH SCORES
            // ===============================
            $procedures = $station->procedures->map(function($procedure) use ($student) {

                $score = ExaminerScore::where([
                    'student_id' => $student->id,
                    'procedure_id' => $procedure->id
                ])->first();

                return [
                    'name' => $procedure->name,
                    'marks' => $procedure->marks,
                    'score' => $score->score ?? 0,
                ];
            });

            // ===============================
            // MCQs WITH ANSWERS
            // ===============================
            $mcqs = $station->mcqQuestions->map(function($mcq) use ($student) {

                $studentAnswer = StudentMcqAnswer::where([
                    'student_id' => $student->id,
                    'mcq_id' => $mcq->id
                ])->first();

                return [
                    'question' => $mcq->question,
                    'mark' => $mcq->mark,
                    'options' => $mcq->options->map(function($opt) use ($studentAnswer){
                        return [
                            'text' => $opt->option_text,
                            'is_correct' => $opt->is_correct,
                            'is_selected' => $studentAnswer 
                                ? $studentAnswer->option_id == $opt->id 
                                : false
                        ];
                    })
                ];
            });

            $data[] = [
                'station_title' => $station->title,
                'procedures' => $procedures,
                'mcqs' => $mcqs
            ];
        }

        return response()->json([
            'student' => $student,
            'stations' => $data
        ]);
    }



}
