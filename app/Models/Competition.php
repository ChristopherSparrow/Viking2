<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $fillable = [
        'competitions_name',
        'comp_winner',
        'comp_second',
        'comp_type',
        'season_id',
    ];
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
