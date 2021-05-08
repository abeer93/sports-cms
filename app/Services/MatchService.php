<?php

namespace App\Services;

use App\Repositories\MatchRepository;
use App\Http\Resources\MatchResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MatchService
{
    public $matchRepo;

    /**
     * __construct
     *
     * @param MatchRepository $matchRepo
     */
    public function __construct(MatchRepository $matchRepo)
    {
        $this->matchRepo = $matchRepo;
    }

    public function listMatches()
    {
        return $this->matchRepo->with('week')->get();
    }

    public function addNewMatch($matchData)
    {
        $match = $this->prepareMatchData($matchData);
        return $this->matchRepo->create($match);
    }

    public function editMatch($match, $matchData)
    {
        $preparedData = $this->prepareMatchData($matchData);
        return $match->update($preparedData);
    }

    public function groupMatchesByYear()
    {
        $data = $this->matchRepo->with([
                                        'week:id,title,season_id,week_number',
                                        'week.season:id,name,year'
                                    ])->get();
        $resourceData = MatchResource::collection($data);
        return collect($resourceData)->groupBy('season_year');
    }

    public function filterMatches($filters = [])
    {
        $matches = $this->matchRepo->filterMatches($filters);
        return MatchResource::collection($matches);
    }

    public function getMatchDetails($matchId)
    {
        $match = $this->matchRepo->with([
                                            'week:id,title,season_id,week_number',
                                            'week.season:id,name,year'
                                        ])->find($matchId);
        if($match) {
            return new MatchResource($match);
        }

        return null;
    }

    private function prepareMatchData($matchData)
    {
        $title = [
            'en' => $matchData['title_en'],
            'ar' => $matchData['title_ar']
        ];
        $description = [
            'en' => $matchData['description_en'],
            'ar' => $matchData['description_ar']
        ];
        $image = $this->uploadFile($matchData['image']);

        $match = [
            'title'       => $title,
            'description' => $description,
            'week_id'     => $matchData['week_id'],
            'image'       => $image
        ];

        if(isset($matchData['video'])) {
            $match['video'] = $matchData['video'];
        }

        return $match;
    }

    /**
     * Upload file to specific folder
     * 
     * @param file $file
     * @return string
     */
    private function uploadFile($file)
    {
        $fileName = $this->generateFileName($file);

        $folderName = 'images/matches';
       
        $file->move($folderName, $fileName);

        return $folderName . '/' . $fileName;
    }

    /**
     * Genarate name for file
     * 
     * @param $file
     * @return string
     */
    private function generateFileName($file)
    {
        $fileExtension = $file->getClientOriginalExtension();
        $name = Str::snake(basename($file->getClientOriginalName(), "." . $fileExtension));

        $fileName = $name . '_' . time() . '.' . $fileExtension;

        return $fileName;
    }
}
