<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonWeek extends Model
{
    use HasFactory;

    protected $table = 'seasons_weeks';

    protected $fillable = ['title', 'week_number', 'season_id'];

    public function match()
    {
        return $this->hasOne(Match::class, 'week_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }
}
