<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeasonRequest;
use App\Models\Season;
use App\Services\SeasonService;

class SeasonController extends Controller
{
    /**@var SeasonService $seasonService instance of season service*/
    public $seasonService;
    
    /**
     * __constructor
     *
     * @param SeasonService $seasonService instance of season service
     */
    public function __construct(SeasonService $seasonService)
    {
        $this->seasonService = $seasonService;
    }

    /**
     * List all seasons
     */
    public function index()
    {
        $seasons = $this->seasonService->listSeasons();
        return view('seasons.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new season.
     */
    public function create()
    {
        return view('seasons.create');
    }

    /**
     * Store new season into DB.
     *
     * @param  \Illuminate\Http\CreateSeasonRequest  $request
     */
    public function store(CreateSeasonRequest $request)
    {
        $this->seasonService->addNewSeason($request->only('name', 'year'));
     
        return redirect()->route('seasons.index')->with('success','Season created successfully.');
    }

    public function edit(Season $season)
    {
        return view('seasons.edit',compact('season'));
    }

    public function update(CreateSeasonRequest $request, Season $season)
    {
    
        $updated = $this->seasonService->editSeason($season, $request->only('name', 'year'));
        if($updated) {
            return redirect()->route('seasons.index')->with('success','Season updated successfully');
        }

        return redirect()->route('seasons.index')->with('error','Something Wrong!');
    }

    public function destroy(Season $season)
    {
        $season->delete();
        return redirect()->route('seasons.index')->with('success','Season deleted successfully');
    }
}
