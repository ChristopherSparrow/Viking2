<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class SeasonController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('permission:view season', ['only' => ['index']]);
        $this->middleware('permission:create season', ['only' => ['create','store']]);
        $this->middleware('permission:update season', ['only' => ['update','edit']]);
        $this->middleware('permission:delete season', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $seasons = Season::orderBy('season_start_date', 'desc')->get();
        return view('seasons.index', compact('seasons'));
    }

    public function create()
    {
        return view('seasons.create');
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



    public function show(Season $seasonId)
    {
        return view('seasons.show', compact('seasonId'));
    }

}
