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
}
