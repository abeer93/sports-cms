<?php

namespace App\Services;

use App\Repositories\SeasonRepository;
use Exception;

class SeasonService
{
    /**@var SeasonRepository $seasonRepo instance of season repository*/
    public $seasonRepo;

    /**
     * Undocumented function
     *
     * @param SeasonRepository $seasonRepo
     */
    public function __construct(SeasonRepository $seasonRepo)
    {
        $this->seasonRepo = $seasonRepo;
    }

    public function listSeasons()
    {
        return $this->seasonRepo->all();
    }

    public function addNewSeason($seasonData)
    {
        $createdSeason = $this->seasonRepo->create($seasonData);
        return $createdSeason;
    }

    public function editSeason($season, $seasonData)
    {
        try {
            return $season->update($seasonData);
        } catch(Exception $e) {
            dd($e->getMessage());
        }
    }
}
