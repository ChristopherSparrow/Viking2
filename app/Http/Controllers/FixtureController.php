<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use App\Models\Season;
use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class FixtureController extends Controller
{


    public function index($seasonId, $competitionId)
    {
        $competitions = Competition::pluck('competitions_name', 'id');
        $comp_type = Competition::pluck('comp_type', 'id');

        $teams = Team::orderBy('team_name')->pluck('team_name', 'id');

        $seasons = Season::where('id', $seasonId)->first();
        $fixtures = Fixture::where('competition_id', $competitionId)->get();
        return view('fixtures.index', compact('fixtures', 'competitionId', 'teams', 'competitions', 'seasons','comp_type'));
    }
    
    public function table($seasonId, $competitionId)
    {
        $competitions = Competition::pluck('competitions_name', 'id');
        $teams = Team::orderBy('team_name')->pluck('team_name', 'id');
        $seasons = Season::where('id', $seasonId)->first();
        $fixtures = Fixture::where('competition_id', $competitionId)->get();

        $standings = DB::table(DB::raw('(SELECT id, home_team AS combinedStandings, 
        CASE WHEN home_score IS NOT NULL THEN 1 ELSE 0 END AS pl,
        CASE WHEN home_score > away_score THEN 1 ELSE 0 END AS win,
        CASE WHEN home_score < away_score THEN 1 ELSE 0 END AS loss,
        CASE WHEN home_score = away_score THEN 1 ELSE 0 END AS tie,
        home_score AS pts
        FROM fixtures 
        WHERE away_team != \'bye\' AND competition_id IN (
            SELECT id FROM competitions WHERE comp_type = 1
        )
        UNION
        SELECT id, away_team AS combinedStandings,
            CASE WHEN away_score IS NOT NULL THEN 1 ELSE 0 END AS pl,
            CASE WHEN away_score > home_score THEN 1 ELSE 0 END AS win,
            CASE WHEN away_score < home_score THEN 1 ELSE 0 END AS loss,
            CASE WHEN away_score = home_score THEN 1 ELSE 0 END AS tie,
            away_score AS pts
            FROM fixtures 
            WHERE home_team != \'bye\' AND competition_id IN (
                SELECT id FROM competitions WHERE comp_type = 1
            )
        ) as m'))

        ->join('teams', 'teams.id', '=', 'm.combinedStandings') // Join with teams table

        ->select('m.combinedStandings', 'teams.team_name',
            DB::raw('SUM(m.pl) as totalpl'),
            DB::raw('SUM(m.win) as totalwin'),
            DB::raw('SUM(m.loss) as totalloss'),
            DB::raw('SUM(m.tie) as totaltie'),
            DB::raw('SUM(m.pts) as totalpts'))
        ->groupBy('m.combinedStandings', 'teams.team_name')
        ->orderByDesc('totalpts')
        ->orderByDesc('totalwin')
        ->get();

        return view('fixtures.table', compact('fixtures', 'competitionId', 'teams', 'competitions', 'seasons', 'standings'));
    }



    public function edit($seasonId, $competitionId, $date)
    {
        $competitions = Competition::pluck('competitions_name', 'id');
        $seasons = Season::where('id', $seasonId)->first();
        $teams = Team::orderBy('team_name')->pluck('team_name', 'id');
        $fixtures = Fixture::where('competition_id', $competitionId)
                        ->where('date', $date)
                        ->get();
        //dd($fixtures);
        return view('fixtures.edit', compact('fixtures', 'competitionId', 'date', 'teams', 'seasons', 'competitions'));
    }
    
  

    public function update(Request $request, $seasonId, $competitionId, $date)
    {
        // Assuming you have a Fixture model
        foreach ($request->input('fixtures') as $fixtureId => $fixtureData) {
            $fixture = Fixture::findOrFail($fixtureId);
    
            
            // Update the fixture data
            $fixture->update([
                'home_team' => $fixtureData['home_team'],
                'home_score' => $fixtureData['home_score'],
                'away_score' => $fixtureData['away_score'],
                'away_team' => $fixtureData['away_team'],
                'location' => $fixtureData['location'],
                // Add other fields as needed
            ]);
        }
    
        // Redirect back or to a specific page after updating
        return redirect()->route('fixtures.index', ['seasonId' => $seasonId, 'competitionId' => $competitionId]);
    }
    
    public function destroy($seasonId, $competitionId, $date)
    {
        Fixture::where('competition_id', $competitionId)
                ->where('date', $date)
                ->delete();
        return redirect()->route('fixtures.index', ['seasonId' => $seasonId, 'competitionId' => $competitionId]);
    }

// FixtureController.php

public function create($seasonId, $competitionId)
{
    $teams = Team::orderBy('team_name')->pluck('team_name', 'id');
    $date = today();
    $competition = Competition::findorfail($competitionId);
    $season = Season::findOrFail($seasonId);
    return view('fixtures.create', compact('season', 'competition', 'competitionId', 'teams', 'date'));
}

public function store(Request $request, $seasonId, $competitionId)
{
    // Validation logic here if needed

    $fixture = new Fixture();
    $fixture->season_id = $seasonId;
    $fixture->competition_id = $competitionId;
    $fixture->date = $request->input('date');
    $fixture->home_team = $request->input('home_team');
    $fixture->away_team = $request->input('away_team');
    $fixture->home_score = $request->input('home_score');
    $fixture->away_score = $request->input('away_score');
    $fixture->location = $request->input('location');
    // Add other fields as needed
    
    $fixture->save();

    return redirect()->route('fixtures.index', ['seasonId' => $seasonId, 'competitionId' => $competitionId]);
}

}
