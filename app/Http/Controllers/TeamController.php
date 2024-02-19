<?php

namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\Season;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view team', ['only' => ['index']]);
        $this->middleware('permission:create team', ['only' => ['create','store']]);
        $this->middleware('permission:update team', ['only' => ['update','edit']]);
        $this->middleware('permission:delete team', ['only' => ['destroy']]);
    }
    public function index($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        $teams = Team::where('season_id', $season->id)->get();
        return view('teams.index', compact('season', 'teams'));
    }

    public function create($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        return view('teams.create', compact('season'));
    }

    public function store(Request $request, $seasonId)
    {
        //dd($request, $seasonId);    
        $validatedData = $request->validate([
            'team_name' => 'required|string|max:255',
            'team_captain' => 'required|string|max:255',
            'team_captain_no'=> 'required|string|max:255',
            'team_vice_captain'=> 'string|max:255',
            'team_vice_captain_no'=> 'string|max:255',
            // Add other validation rules for your fields
        ]);

       // dd($validatedData);

        $validatedData['season_id'] = $seasonId;
        Team::create($validatedData);

        return redirect()->route('seasons.show', ['seasonId' => $seasonId])->with('success', 'Team created successfully');
    }

    public function show($seasonId, $teamId)
    {
        $season = Season::findOrFail($seasonId);
        $team = Team::findOrFail($teamId);
        return view('teams.show', compact('season', 'team'));
    }

    public function edit($seasonId, $teamId)
    {
        $season = Season::findOrFail($seasonId);
        $team = Team::findOrFail($teamId);
        return view('teams.edit', compact('season', 'team'));
    }

    public function update(Request $request, $seasonId, $teamId)
    {
        $season = Season::findOrFail($seasonId);
        $team = Team::findOrFail($teamId);

        // Validate and update team details
        $request->validate([
            'team_name' => 'required|string|max:255',
            'team_captain' => 'required|string|max:255',
            'team_vice_captain' => 'required|string|max:255',
            'team_captain_no'=> 'required|string|max:255',
            'team_vice_captain_no' => 'required|string|max:255',
            // Add other validation rules for your fields
        ]);

        $team->update($request->all());

        return redirect()->route('teams.index', ['seasonId' => $seasonId])->with('success', 'Team updated successfully');
    }

    public function destroy($seasonId, $teamId)
    {
        $season = Season::findOrFail($seasonId);
        $team = Team::findOrFail($teamId);

        // Delete the team
        $team->delete();

        return redirect()->route('teams.index', ['seasonId' => $seasonId])->with('success', 'Team deleted successfully');
    }
}
