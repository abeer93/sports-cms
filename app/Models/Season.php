<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $table = 'seasons';

    protected $fillable = ['name', 'year'];

    public function week()
    {
        return $this->hasMany(SeasonWeek::class, 'season_id');
    }
}
