<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use App\Models\Season;
use App\Models\Fixture;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class CupController extends Controller
{
    public function index($seasonId, $competitionId)
    {
        $competitions = Competition::pluck('competitions_name', 'id');
        $comp_type = Competition::pluck('comp_type', 'id');

        $teams = Team::orderBy('team_name')->pluck('team_name', 'id');
        $players = Player::orderBy('player_name')->pluck('player_name', 'id');

        $seasons = Season::where('id', $seasonId)->first();
        $fixtures = Fixture::where('competition_id', $competitionId)->get();
        return view('cups.index', compact('fixtures', 'competitionId', 'teams', 'competitions', 'seasons','comp_type','players'));
    }

    public function create($seasonId, $competitionId)
{
        $teams = Team::orderBy('team_name')->pluck('team_name', 'id');
        $players = Player::orderBy('player_name')->pluck('player_name', 'id');
        $date = today();
        $competition = Competition::findorfail($competitionId);
        $season = Season::findOrFail($seasonId);
        return view('cups.create', compact('season', 'competition', 'competitionId', 'teams', 'date', 'players'));
}

    public function store(Request $request, $seasonId, $competitionId)
    {
        $fixture = new Fixture();
        $fixture->season_id = $seasonId;
        $fixture->competition_id = $competitionId;
        $fixture->date = $request->input('date');
        $fixture->home_player_1 = $request->input('home_player_1');
        $fixture->away_player_1 = $request->input('away_player_1');
        $fixture->home_score = $request->input('home_score');
        $fixture->away_score = $request->input('away_score');
        $fixture->location = $request->input('location');
        
        $fixture->save();

        return redirect()->route('cups.index', ['seasonId' => $seasonId, 'competitionId' => $competitionId]);
    }

    public function edit($seasonId, $competitionId, $date)
    {
        $competitions = Competition::pluck('competitions_name', 'id');
        $seasons = Season::where('id', $seasonId)->first();
        $teams = Team::orderBy('team_name')->pluck('team_name', 'id');
        $players = Player::orderBy('player_name')->pluck('player_name', 'id');
        $fixtures = Fixture::where('competition_id', $competitionId)
                        ->where('date', $date)
                        ->get();

        return view('cups.edit', compact('fixtures', 'competitionId', 'date', 'teams', 'seasons', 'competitions','players'));
    }
    
    public function update(Request $request, $seasonId, $competitionId, $date)
    {
        // Assuming you have a Fixture model
        foreach ($request->input('fixtures') as $fixtureId => $fixtureData) {
            $fixture = Fixture::findOrFail($fixtureId);
    
            $fixture->update([
                'home_player_1' => $fixtureData['home_player_1'],
                'home_score' => $fixtureData['home_score'],
                'away_score' => $fixtureData['away_score'],
                'away_player_1' => $fixtureData['away_player_1'],
                'location' => $fixtureData['location'],
                // Add other fields as needed
            ]);
        }
    
        // Redirect back or to a specific page after updating
        return redirect()->route('cups.index', ['seasonId' => $seasonId, 'competitionId' => $competitionId]);
    }
    
    public function destroy($seasonId, $competitionId, $date)
    {
        Fixture::where('competition_id', $competitionId)
                ->where('date', $date)
                ->delete();
        return redirect()->route('cups.index', ['seasonId' => $seasonId, 'competitionId' => $competitionId]);
    }
}
