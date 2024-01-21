<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class SeasonController extends Controller
{
    public function index()
    {
        $seasons = Season::orderBy('season_start_date', 'desc')->get();
        return view('seasons.index', compact('seasons'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'season_name' => 'required|string|max:255',
            'season_start_date' => 'required|date',
            'season_end_date' => 'required|date|after:season_start_date',
        ]);

        // Create a new season with the validated data
        $season = Season::create($validatedData);

        // Redirect to the newly created season or wherever you want
        return redirect()->route('seasons.show', $season->id)->with('success', 'Season created successfully');
    }

    public function create()
    {
        return view('seasons.create');
    }

    public function show(Season $season)
    {
        return view('seasons.show', compact('season'));
    }

}
