<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\McqQuestion;
use App\Models\McqOption;
use App\Models\Station;
use Illuminate\Support\Facades\Log;

class MCQController extends Controller
{
    //

    public function index()
    {
        $stations = Station::with('mcqQuestions.options')->get();
        return view('osce.mcqs.index', compact('stations'));
    }

    
    // ---------------- ADD MCQ ----------------
    public function store(Request $request)
    {
        $request->validate([
            'station_id' => 'required|exists:stations,id',
            'question' => 'required|string',
             'mark' => 'required|numeric|between:0.25,9.9',
            'options.*.option_text' => 'required|string',
           
        ]);

        // Ensure at least one correct option
        $hasCorrect = false;
        foreach ($request->options as $opt){
            if(isset($opt['is_correct']) && $opt['is_correct']){
                $hasCorrect = true;
                break;
            }
        }

        if(!$hasCorrect){
            return response()->json([
                'errors' => ['options' => ['At least one option must be marked as correct.']]
            ], 422);
        }

        // Create MCQ
        $mcq = McqQuestion::create([
            'station_id' => $request->station_id,
            'question' => $request->question,
            'mark' => $request->mark,
           
        ]);

        // Create options
        foreach ($request->options as $opt){
            $mcq->options()->create([
                'option_text' => $opt['option_text'],
                'is_correct' => isset($opt['is_correct']) ? 1 : 0,
            ]);
        }

        return response()->json(['success' => 'MCQ added successfully.']);
    }

    // ---------------- EDIT MCQ ----------------
    public function update(Request $request, MCQQuestion $mcq)
    {
        $request->validate([
            'question' => 'required|string',            
            'mark' => 'required|numeric|between:0.25,9.9',
            'options.*.option_text' => 'required|string',
        ]);

        // Ensure at least one correct option
        $hasCorrect = false;
        foreach ($request->options as $opt){
            if(isset($opt['is_correct']) && $opt['is_correct']){
                $hasCorrect = true;
                break;
            }
        }

        if(!$hasCorrect){
            return response()->json([
                'errors' => ['options' => ['At least one option must be marked as correct.']]
            ], 422);
        }

        $mcq->update([
            'question' => $request->question,
            'mark' => $request->mark,           
        ]);

        // Update existing or create new options
        foreach ($request->options as $key => $opt){
            if(isset($opt['id'])){
                // Update existing option
                $mcq->options()->where('id', $opt['id'])->update([
                    'option_text' => $opt['option_text'],
                    'is_correct' => isset($opt['is_correct']) ? 1 : 0,
                ]);
            } else {
                // Create new option
                $mcq->options()->create([
                    'option_text' => $opt['option_text'],
                    'is_correct' => isset($opt['is_correct']) ? 1 : 0,
                ]);
            }
        }

        return response()->json(['success' => 'MCQ updated successfully.']);
    }

    // ---------------- DELETE MCQ ----------------
    public function destroy($id)
    {
        $mcq = McqQuestion::withCount('studentAnswers')->findOrFail($id);

        // If students have answered, block delete
        if ($mcq->student_answers_count > 0) {
            return response()->json([
                'error' => 'Cannot delete. Students have already answered this MCQ.'
            ], 400);
        }

        // Safe delete
        $mcq->options()->delete();
        $mcq->delete();

        return response()->json([
            'success' => 'MCQ deleted successfully.'
        ]);
    }

}
