<?php

namespace App\Repositories;

use App\Models\SeasonWeek;

class SeasonWeekRepository extends BaseRepository
{
    /**
     * __constructor
     *
     * @param SeasonWeek $weekModel
     */
    public function __construct(SeasonWeek $weekModel)
    {
        parent::__construct($weekModel);
    }
}