<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::all();
    
        return view('competitions.index', compact('competitions'));
    }
}
