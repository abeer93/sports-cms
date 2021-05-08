<?php

namespace App\Services;

use App\Repositories\SeasonWeekRepository;

class SeasonWeekService
{
    public $weekRepo;

    /**
     * __construct
     *
     * @param SeasonWeekRepository $weekRepo
     */
    public function __construct(SeasonWeekRepository $weekRepo)
    {
        $this->weekRepo = $weekRepo;
    }

    public function listWeeks($relations = [])
    {
        return $this->weekRepo->with($relations)->get();
    }

    public function addNewWeek($weekData)
    {
        return $this->weekRepo->create($weekData);
    }

    public function editWeek($week, $weekData)
    {
        return $week->update($weekData);
    }
}
