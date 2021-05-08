<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeasonWeekRequest;
use App\Models\SeasonWeek;
use App\Services\SeasonService;
use App\Services\SeasonWeekService;

class SeasonWeekController extends Controller
{
    /**@var SeasonWeekService $weekService instance of season week service*/
    public $weekService;

    /**@var SeasonService $seasonService instance of season service*/
    public $seasonService;
    
    /**
     * __constructor
     *
     * @param SeasonWeekService $weekService   instance of season service
     * @param SeasonService     $seasonService instance of season service
     */
    public function __construct(SeasonWeekService $weekService, SeasonService $seasonService)
    {
        $this->weekService   = $weekService;
        $this->seasonService = $seasonService;
    }

    /**
     * List all seasons weeks
     */
    public function index()
    {
        $weeks = $this->weekService->listWeeks(['season']);
        return view('seasons-weeks.index', compact('weeks'));
    }

    /**
     * Show the form for creating a new week.
     */
    public function create()
    {
        $seasons = $this->seasonService->listSeasons();
        return view('seasons-weeks.create', compact('seasons'));
    }

    /**
     * Store new week into DB.
     *
     * @param  \Illuminate\Http\CreateSeasonWeekRequest  $request
     */
    public function store(CreateSeasonWeekRequest $request)
    {
        $this->weekService->addNewWeek($request->only('title', 'week_number', 'season_id'));
     
        return redirect()->route('seasons-weeks.index')->with('success','Season week created successfully.');
    }

    public function edit(SeasonWeek $seasonsWeek)
    {
        $seasons = $this->seasonService->listSeasons();
        return view('seasons-weeks.edit', compact('seasons', 'seasonsWeek'));
    }

    public function update(CreateSeasonWeekRequest $request, SeasonWeek $seasonsWeek)
    {
    
        $updated = $this->weekService->editWeek($seasonsWeek, $request->only('title', 'week_number', 'season_id'));
        if($updated) {
            return redirect()->route('seasons-weeks.index')->with('success','Season week updated successfully');
        }

        return redirect()->route('seasons-weeks.index')->with('error','Something Wrong!');
    }

    public function destroy(SeasonWeek $seasonsWeek)
    {
        $seasonsWeek->delete();
        return redirect()->route('seasons-weeks.index')->with('success','Season week deleted successfully');
    }
}
