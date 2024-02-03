<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use App\Models\Season;
use App\Models\Fixture;
use App\Models\Team;

use Illuminate\Http\Request;

class FixtureController extends Controller
{


    public function index($competitionId)
    {
        $teams = Team::pluck('team_name', 'id');
        $fixtures = Fixture::where('competition_id', $competitionId)->get();
        return view('fixtures.index', compact('fixtures', 'competitionId', 'teams'));

    }




}
