<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_name',
        'season_start_date',
        'season_end_date',
    ];

    public function competitions()
    {
    return $this->hasMany(Competition::class);
}   
    public function teams()
    {
    return $this->hasMany(Team::class);
    }

    public function players()
    {
    return $this->hasMany(Player::class);
    }

    public function fixtures()
    {
    return $this->hasMany(Fixture::class);
    }
}
