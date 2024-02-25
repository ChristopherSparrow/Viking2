<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Team;
use App\Models\Season;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view player', ['only' => ['index']]);
        $this->middleware('permission:create player', ['only' => ['create','store']]);
        $this->middleware('permission:update player', ['only' => ['update','edit']]);
        $this->middleware('permission:delete player', ['only' => ['destroy']]);
    }
    public function index($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        $players = Player::where('season_id', $season->id)->get();
        $teams = Team::where('season_id', $season->id)->get();
    
        return view('players.index', compact('season', 'players','teams'));
    }
 

    public function create($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        $teams = Team::orderBy('team_name')->pluck('team_name', 'id');
        return view('players.create', compact('season','teams'));
    }

    public function store(Request $request, $seasonId)
    {
        $validatedData = $request->validate([
            'player_name' => 'required|string|max:255',
            'team_id' =>'required|integer',
        ]);

       
        $validatedData['season_id'] = $seasonId;
        Player::create($validatedData);

        return redirect()->route('players.index', ['seasonId' => $seasonId])->with('success', 'Player created successfully');
    }

    public function show($seasonId, $playerId)
    {
        $season = Season::findOrFail($seasonId);
        $player = Team::findOrFail($playerId);
        return view('players.show', compact('season', 'player'));
    }

    public function edit($seasonId, $playerId)
    {
        $season = Season::findOrFail($seasonId);
        $player = Player::findOrFail($playerId);
        $teams = Team::pluck('team_name', 'id');

        return view('players.edit', compact('season', 'player', 'teams'));
    }
    public function update(Request $request, $seasonId, $playerId)
    {
        $season = Season::findOrFail($seasonId);
        $player = Player::findOrFail($playerId);

        // Validate and update team details
        $request->validate([
            'player_name' => 'required|string|max:255',
        ]);
        $player->update($request->all());
       
        return redirect()->route('players.index', ['seasonId' => $seasonId])->with('success', 'Team updated successfully');
   
    }

    public function destroy($seasonId, $playerId)
    {
        $season = Season::findOrFail($seasonId);
        $player = Player::findOrFail($playerId);

        // Delete the team
        $player->delete();

        return redirect()->route('players.index', ['seasonId' => $seasonId])->with('success', 'Team deleted successfully');
    }
}
