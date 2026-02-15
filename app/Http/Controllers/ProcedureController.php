<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedure;
use App\Models\Station;
use Illuminate\Support\Facades\Log;

class ProcedureController extends Controller
{
    //

     // List procedures grouped by station
    public function index()
    {
        $stations = Station::with('procedures')->get();

        return view('osce.procedures.index', compact('stations'));
    }

    // Store new procedure
    public function store(Request $request)
    {
        $request->validate([
            'station_id'  => 'required|exists:stations,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'max_score'    => 'required|numeric|in:0.5,1,1.5',
        ]);

        try {
            $procedure = Procedure::create([
                'station_id'  => $request->station_id,
                'title'       => $request->title,
                'description' => $request->description,
                'max_score'   => $request->max_score,
            ]);

            return response()->json([
                'message'   => 'Procedure created successfully',
                'procedure' => $procedure
            ]);
        } catch (\Throwable $e) {
            Log::error('Procedure Store Error', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error creating procedure'], 500);
        }
    }

    // Update procedure
    public function update(Request $request, Procedure $procedure)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'max_score'   => 'required|integer|min:0',
        ]);

        try {
            $procedure->update([
                'title'       => $request->title,
                'description' => $request->description,
                'max_score'   => $request->max_score,
            ]);

            return response()->json([
                'message'   => 'Procedure updated successfully',
                'procedure' => $procedure
            ]);
        } catch (\Throwable $e) {
            Log::error('Procedure Update Error', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error updating procedure'], 500);
        }
    }

    // Delete procedure
    public function destroy(Procedure $procedure)
    {
        try {
            $procedure->delete();

            return response()->json([
                'message' => 'Procedure deleted successfully',
                'id'      => $procedure->id
            ]);
        } catch (\Throwable $e) {
            Log::error('Procedure Delete Error', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error deleting procedure'], 500);
        }
    }
    
}
