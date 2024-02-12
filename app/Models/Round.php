<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [

        'round_name',
        ];



    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }
}
