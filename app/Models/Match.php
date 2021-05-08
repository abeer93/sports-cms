<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = ['title', 'description', 'image', 'video', 'week_id'];

    protected $casts = [
        'title'       => 'array',
        'description' => 'array',
    ];

    public function week()
    {
        return $this->belongsTo(SeasonWeek::class, 'week_id');
    }
}
