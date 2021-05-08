<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMatchRequest;
use App\Services\MatchService;
use App\Services\SeasonWeekService;
use App\Models\Match;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MatchController extends Controller
{
    /**@var MatchService $matchService instance of match service */
    public $matchService;

    /**@var SeasonWeekService $weekService instance of season week service*/
    public $weekService;
    
    /**
     * __constructor
     *
     * @param MatchService      $matchService  instance of match service
     * @param SeasonWeekService $weekService   instance of season service
     */
    public function __construct(MatchService $matchService, SeasonWeekService $weekService)
    {
        $this->matchService = $matchService;
        $this->weekService  = $weekService;
    }

    /**
     * List all seasons weeks
     */
    public function index()
    {
        $matches = $this->matchService->listMatches();
        return view('matches.index', compact('matches'));
    }

    /**
     * Show the form for creating a new week.
     */
    public function create()
    {
        $weeks = $this->weekService->listWeeks();
        return view('matches.create', compact('weeks'));
    }

    /**
     * Store new week into DB.
     *
     * @param  \Illuminate\Http\CreateMatchRequest $request
     */
    public function store(CreateMatchRequest $request)
    {
        $this->matchService->addNewMatch($request->only('title_ar', 'title_en', 'description_ar', 'description_en', 'week_id', 'image', 'video'));
     
        return redirect()->route('matches.index')->with('success','Match created successfully.');
    }

    /**
     * Edit Match data view
     * 
     * @param Match $match
     */
    public function edit(Match $match)
    {
        $weeks = $this->weekService->listWeeks();
        return view('matches.edit', compact('match', 'weeks'));
    }

    /**
     * Update match data
     * 
     * @param  \Illuminate\Http\CreateMatchRequest $request
     * @param Match $match
     */
    public function update(CreateMatchRequest $request, Match $match)
    {
        $updated = $this->matchService->editMatch($match, $request->only('title_ar', 'title_en', 'description_ar', 'description_en', 'week_id', 'image', 'video'));
        if($updated) {
            return redirect()->route('matches.index')->with('success','Match updated successfully');
        }

        return redirect()->route('matches.index')->with('error','Something Wrong!');
    }

    /**
     * Delete match
     * 
     * @param Match $match
     */
    public function destroy(Match $match)
    {
        $match->delete();
        return redirect()->route('matches.index')->with('success','Match deleted successfully');
    }

    /**
     * List all matches grouped by season year
     */
    public function groupMatchesByYear()
    {
        $matches = $this->matchService->groupMatchesByYear();
        return response()->json(['message' => 'Retrieved Successfully', 'data' => $matches], Response::HTTP_OK);
    }

    /**
     * Get match details by match id
     * 
     * @param int $id
     */
    public function getMatchById($id)
    {
        $match = $this->matchService->getMatchDetails($id);
        if($match) {
            return response()->json(['message' => 'Retrieved Successfully', 'data' => $match], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Model not exist!.'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Filter matches by week or by season year
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function filterMatches(Request $request)
    {
        $matches = $this->matchService->filterMatches($request->all());
        return response()->json(['message' => 'Retrieved Successfully', 'data' => $matches], Response::HTTP_OK);
    }
}
