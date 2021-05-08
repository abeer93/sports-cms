<?php

namespace App\Repositories;

use App\Models\Season;

class SeasonRepository extends BaseRepository
{
    /**
     * __constructor
     *
     * @param Season $seasonModel
     */
    public function __construct(Season $seasonModel)
    {
        parent::__construct($seasonModel);
    }
}
