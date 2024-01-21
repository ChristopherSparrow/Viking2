<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $fillable = [
        'competitions_name',
    ];
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
