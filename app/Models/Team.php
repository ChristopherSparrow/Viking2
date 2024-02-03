<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_name',
        'season_id',
        'team_captain',
        'team_vice_captain',
        'team_captain_no',
        'team_vice_captain_no',
    ];



    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function players()
    {
    return $this->hasMany(Player::class);
    }
}
