<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;
    protected $fillable = [

    'season_id',
    'competition_id',
    'date',
    'home_team',
    'away_team',
    'home_player_1',
    'home_player_2',
    'away_player_1',
    'away_player_2',
    'home_score',
    'away_score',
    'location',
    'comp_round',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }


    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team');
    }

    public function round()
    {
    return $this->hasMany(Round::class);
    }

}
