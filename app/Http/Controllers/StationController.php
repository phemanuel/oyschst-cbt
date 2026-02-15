<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

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
}
