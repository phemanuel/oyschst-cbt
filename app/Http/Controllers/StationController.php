<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use Illuminate\Support\Facades\Log;

class StationController extends Controller
{
    //

    public function index()
    {
        $stations = Station::latest()->get();
        return view('osce.stations.index', compact('stations'));
    }

    public function create()
    {
        return view('osce.stations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'practical_question' => 'required'
        ]);

        Station::create([
            'title' => $request->title,
            'practical_question' => $request->practical_question,
        ]);

        return redirect()->route('stations.index')
            ->with('success', 'Station created successfully.');
    }

    // Show the edit modal data
    public function edit(Station $station)
    {
        // For AJAX modal, return JSON
        return response()->json([
            'id' => $station->id,
            'title' => $station->title,
            'practical_question' => $station->practical_question,
        ]);
    }

    // Update the station (from modal)
    public function update(Request $request, Station $station)
    {
        Log::info('Update route hit for station ID: '.$station->id);
        $request->validate([
            'title' => 'required|string|max:255',
            'practical_question' => 'required|string',
        ]);

        $station->update([
            'title' => $request->title,
            'practical_question' => $request->practical_question,
        ]);

        // Return JSON to update table row
        return response()->json([
            'id' => $station->id,
            'title' => $station->title,
            'practical_question' => $station->practical_question,
        ]);
    }

    // Delete station via AJAX
    public function destroy(Station $station)
    {
        $station->delete();

        return response()->json([
            'message' => 'Station deleted successfully',
            'id' => $station->id,
        ]);
    }
}
