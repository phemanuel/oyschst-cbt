<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Exports\PastQuestionsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PastQuestionDownloadController extends Controller
{
    // Change this value privately on your server before deploying.
    private const DOWNLOAD_PASSWORD = 'Admin@1933';

    private const FILTER_FIELDS = ['programme', 'level', 'exam_type', 'semester', 'session', 'course'];

    private function selectedTable(string $type): string
    {
        return $type === 'multipage' ? 'questions' : 'question_singles';
    }

    /**
     * Existing form calls the programme field "department" and the session field "session1".
     * Both Question and QuestionSingle models share these filter columns.
     */
    private function columnMap(string $table): array
    {
        return [
            'programme' => 'department',
            'level' => 'level',
            'exam_type' => 'exam_type',
            'semester' => 'semester',
            'session' => 'session1',
            'course' => 'course',
        ];
    }

    private function assertSchema(string $table, array $map): void
    {
        foreach ($map as $column) {
            if (!Schema::hasColumn($table, $column)) {
                abort(500, "Question download configuration needs correction for $table.$column");
            }
        }
    }

    private function authorized(Request $request): void
    {
        $unlockedAt = (int) $request->session()->get('past_questions_unlocked_at', 0);
        abort_unless($unlockedAt > 0 && (time() - $unlockedAt) < 900, 403, 'Download access expired. Verify the password again.');
    }

    public function verify(Request $request)
    {
        $request->validate(['password' => ['required', 'string']]);
        $key = 'past-question-download:' . $request->user()->getAuthIdentifier();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json(['message' => 'Too many attempts. Try again later.'], 429);
        }
        if (!hash_equals(self::DOWNLOAD_PASSWORD, $request->input('password'))) {
            RateLimiter::hit($key, 300);
            return response()->json(['message' => 'Incorrect password.'], 422);
        }
        RateLimiter::clear($key);
        $request->session()->put('past_questions_unlocked_at', time());
        return response()->json(['message' => 'Access granted.']);
    }

    /**
     * Populate selections from master tables / allowed fixed values.
     * The final download always searches the selected question table.
     */
    public function filters(Request $request)
    {
        $this->authorized($request);
        $values = $request->validate([
            'question_type' => 'required|in:multipage,singlepage',
            'programme' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'exam_type' => 'nullable|string|max:255',
            'semester' => 'nullable|string|max:255',
            'session' => 'nullable|string|max:255',
        ]);

        $nextField = null;
        foreach (self::FILTER_FIELDS as $field) {
            if (!$request->filled($field)) {
                $nextField = $field;
                break;
            }
        }

        switch ($nextField) {
            case 'programme':
                $options = DB::table('departments')
                    ->whereNotNull('department')->where('department', '<>', '')
                    ->distinct()->orderBy('department')->pluck('department')->all();
                break;
            case 'level':
                $options = ['100', '200', '300', 'NDI', 'NDII', 'HNDI', 'HNDII'];
                break;
            case 'exam_type':
                $options = DB::table('exam_types')
                    ->whereNotNull('exam_type')->where('exam_type', '<>', '')
                    ->distinct()->orderBy('exam_type')->pluck('exam_type')->all();
                break;
            case 'semester':
                $options = ['First', 'Second'];
                break;
            case 'session':
                $options = [];
                for ($year = 2018; $year <= (int) date('Y'); $year++) {
                    $options[] = $year . '/' . ($year + 1);
                }
                $options = array_reverse($options);
                break;
            case 'course':
                $options = DB::table('courses')
                    ->whereNotNull('course')->where('course', '<>', '')
                    ->distinct()->orderBy('course')->pluck('course')->all();
                break;
            default:
                $options = [];
        }
        return response()->json(['options' => $options]);
    }

    public function download(Request $request)
    {
        $this->authorized($request);
        $values = $request->validate([
            'question_type' => 'required|in:multipage,singlepage',
            'programme' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'exam_type' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'session' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'format' => 'required|in:pdf,xlsx,csv',
        ]);

        $table = $this->selectedTable($values['question_type']);
        $map = $this->columnMap($table);
        $this->assertSchema($table, $map);
        $query = DB::table($table);
        foreach (self::FILTER_FIELDS as $field) {
            $query->where($map[$field], $values[$field]);
        }
        if (!(clone $query)->exists()) {
            return back()->with('error', 'No questions were found for those criteria.');
        }

        $base = 'past_questions_' . $values['question_type'] . '_' . date('Ymd_His');
        if ($values['format'] === 'pdf') {
            // Bound the printable PDF to avoid exhausting server memory.
            $total = (clone $query)->count();
            if ($total > 1000) {
                return back()->with('error', 'More than 1,000 questions matched. Narrow your filters or use Excel/CSV.');
            }
            $questions = $query->orderBy('question_no')->get();
            return Pdf::loadView('admin.past-questions-print', [
                'questions' => $questions,
                'filters' => $values,
                'isSinglePage' => $values['question_type'] === 'singlepage',
            ])->setPaper('a4')->download($base . '.pdf');
        }

        $columns = Schema::getColumnListing($table);
        $export = new PastQuestionsExport($table, $map, $values, $columns);
        if ($values['format'] === 'xlsx') {
            return Excel::download($export, $base . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
        return Excel::download($export, $base . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
