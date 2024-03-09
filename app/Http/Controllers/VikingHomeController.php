<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use App\Models\Season;
use App\Models\Fixture;
use App\Models\Team;
use App\Models\Round;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use Illuminate\Http\Request;

class VikingHomeController extends Controller
{

    
    public function index()
    {
        $seasonId = 1;
        $competitionId = 1;
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









        $allFixtures = Fixture::where('date', '>=', Carbon::now()->subDays(3))
        ->where('date', '<=', Carbon::now()->addDays(7))
        ->whereHas('competition', function ($query) use ($seasonId) {
            $query->where('season_id', $seasonId);
        })
        ->join('competitions as comp_name', 'fixtures.competition_id', '=','comp_name.id')
        
        ->leftjoin('teams as home_team', 'fixtures.home_team', '=', 'home_team.id')
        ->leftjoin('teams as away_team', 'fixtures.away_team', '=', 'away_team.id')
        ->leftjoin('players as home_player', 'fixtures.home_player_1', '=', 'home_player.id')
        ->leftjoin('players as away_player', 'fixtures.away_player_1', '=', 'away_player.id')
        ->leftjoin('rounds as comp_rounds', 'fixtures.comp_round', '=', 'comp_rounds.id')

        ->orderBy('date')
        ->orderBy('competition_id')
        ->select('fixtures.*', 'home_team.team_name as home_team_name', 'away_team.team_name as away_team_name', 'home_player.player_name as home_player_name_1', 'away_player.player_name as away_player_name_1', 'comp_name.competitions_name as competition_name', 'comp_rounds.round_name as round')
        ->get();
    





        return view('VikingHome', compact('standings', 'allFixtures'));
    }

}
