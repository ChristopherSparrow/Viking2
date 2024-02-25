<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use App\Models\Season;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view competition', ['only' => ['index']]);
        $this->middleware('permission:create competition', ['only' => ['create','store']]);
        $this->middleware('permission:update competition', ['only' => ['update','edit']]);
        $this->middleware('permission:delete competition', ['only' => ['destroy']]);
    }
    public function index()
    {
        $competitions = Competition::all();
    
        return view('competitions.index', compact('competitions'));
    }

    public function create($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        return view('competitions.create', compact('season'));
    }
    
    public function store(Request $request, $seasonId)
    {
        $validatedData = $request->validate([
            'competitions_name' => 'required|string|max:255',
            'comp_type' => 'required|string|max:255',
            'comp_winner' => 'string|max:255',
            'comp_second' => 'string|max:255',
        ]);
    
        //dd($validatedData);

        $validatedData['season_id'] = $seasonId;
        Competition::create($validatedData);

        return redirect()->route('seasons.show', ['seasonId' => $seasonId])->with('success', 'Team created successfully');
   }
    
   public function show($seasonId, $competitionId)
   {
       $season = Season::findOrFail($seasonId);
       $competition = Competition::findOrFail($competitionId);
       return view('competitions.show', compact('season', 'competition'));
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
        'comp_winner' => 'string|max:255',
        'comp_second' => 'string|max:255',
        'comp_type' => 'string|max:255',

        // Add other validation rules for your fields
    ]);

    $request['season_id'] = $seasonId;
 $competition->update($request->only([
    'season_id',
    'competitions_name',
    'comp_winner',
    'comp_second',
    'comp_type',
    // Add other fields as needed
]));


    return redirect()->route('seasons.show', ['seasonId' => $season->id])
        ->with('success', 'Competition updated successfully');
}






public function destroy($season, $competitionId)
{
    $season = Season::findOrFail($season);
    $competition = Competition::findOrFail($competitionId);

    // Delete the competition
    $competition->delete();

    return redirect()->route('seasons.show', ['seasonId' => $season->id])
        ->with('success', 'Competition deleted successfully');
}

}
