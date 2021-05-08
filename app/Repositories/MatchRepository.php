<?php

namespace App\Repositories;

use App\Models\Match;

class MatchRepository extends BaseRepository
{
    /**
     * __constructor
     *
     * @param Match $matchModel
     */
    public function __construct(Match $matchModel)
    {
        parent::__construct($matchModel);
    }

    public function filterMatches($filters = [])
    {
        $matchesQuery = $this->model->select('matches.*')->with([
                                                'week:id,title,season_id,week_number',
                                                'week.season:id,name,year'
                                            ]);

        if(isset($filters['week_id']) && !empty($filters['week_id'])) {
            $matchesQuery = $matchesQuery->where('week_id', $filters['week_id']);
        }

        if(isset($filters['year']) && !empty($filters['year'])) {
            $matchesQuery = $matchesQuery->join('seasons_weeks as sw', 'sw.id', '=', 'matches.week_id')
                                        ->join('seasons as s', 's.id', '=', 'sw.season_id')
                                        ->where('year', $filters['year']);
                                        
        }
        
        return $matchesQuery->get();
    }
}
