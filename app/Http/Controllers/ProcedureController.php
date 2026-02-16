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
            'station_id' => 'required|exists:stations,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'marks' => 'required|numeric|between:0.25,9.9',
        ]);

        $procedure = Procedure::create($request->all());

        return response()->json($procedure);
    }

    // Update procedure
    
    public function update(Request $request, Procedure $procedure)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'marks' => 'required|numeric|between:0.25,9.9',
        ]);

        // Update model
        $procedure->update([
            'name' => $request->name,
            'description' => $request->description,
            'marks' => $request->marks,
        ]);

        // Refresh the model to get latest values
        $procedure->refresh();

        return response()->json([
            'message' => 'Procedure updated successfully',
            'procedure' => $procedure
        ]);
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
