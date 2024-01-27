<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use App\Models\Season;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::all();
    
        return view('competitions.index', compact('competitions'));
    }

    public function create(Request $request)
    {
        $season_id = $request->query('season_id');
        return view('competitions.create', ['season_id' => $season_id]);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'season_id' => 'required|integer|exists:seasons,id', 
            'competitions_name' => 'required|string|max:255',
            'comp_winner' => 'string|max:255',
            'comp_second' => 'string|max:255',
        ]);
    
       // dd($validatedData);

        $competition = Competition::create($validatedData);
    
        return redirect()->route('seasons.index', $competition->id)->with('success', 'Competition created successfully');
    }
    


    public function show(Competition $competition)
    {
        return view('competitions.show', compact('competition'));
    }


    public function edit($seasonId, $competitionId)
    {
        $season = Season::findOrFail($seasonId);
        $competition = Competition::findOrFail($competitionId);
    
        return view('competitions.edit', compact('season', 'competition'));
    }
    

    public function update(Request $request, $seasonId, $competitionId)
{
    $season = Season::findOrFail($seasonId);
    $competition = Competition::findOrFail($competitionId);

    // Validate and update competition details
    $request->validate([
        'competitions_name' => 'required|string|max:255',
        // Add other validation rules for your fields
    ]);

    $competition->update($request->all());

    return redirect()->route('seasons.show', ['season' => $season->id])
        ->with('success', 'Competition updated successfully');
}

public function destroy($seasonId, $competitionId)
{
    $season = Season::findOrFail($seasonId);
    $competition = Competition::findOrFail($competitionId);

    // Delete the competition
    $competition->delete();

    return redirect()->route('seasons.show', ['season' => $season->id])
        ->with('success', 'Competition deleted successfully');
}

}
