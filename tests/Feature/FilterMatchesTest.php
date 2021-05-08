<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Match;
use App\Models\Season;
use App\Models\SeasonWeek;

class FilterMatchesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedDB();
    }

    public function testFilterMatchesWithoutSendingAnyFiltersWillReturnAllDataSuccessfully()
    {
        $response = $this->getJson('/api/matches');
        $responseData = ($response->getOriginalContent())['data'];

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id', 
                    'title', 
                    'description', 
                    'week_id', 
                    'week_title', 
                    'season_id', 
                    'season_name', 
                    'season_year',
                    'image',
                    'video'
                ]
            ]
        ]);
        $this->assertEquals(3, count($responseData));
    }

    public function testFilterMatchesWithWeekIdFilterWillReturnFilteredDataSuccessfully()
    {
        $match = Match::first();
        $response = $this->getJson('/api/matches?week_id=' . $match->week_id);
        $responseData = ($response->getOriginalContent())['data'];

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id', 
                    'title', 
                    'description', 
                    'week_id', 
                    'week_title', 
                    'season_id', 
                    'season_name', 
                    'season_year',
                    'image',
                    'video'
                ]
            ]
        ]);
        $this->assertEquals(1, count($responseData));
        $this->assertEquals($responseData[0]->title, $match->title);
        $this->assertEquals($responseData[0]->week_id, $match->week_id);
    }

    public function testFilterMatchesWithYearFilterWillReturnFilteredDataSuccessfully()
    {
        $seasons = Season::select('id')->where('year', 2015)->pluck('id');
        $weeks = SeasonWeek::select('id')->whereIn('season_id', $seasons->toArray())->pluck('id');
        $matches = Match::whereIn('week_id', $weeks->toArray())->get();
        
        $response = $this->getJson('/api/matches?year=2015');
        $responseData = ($response->getOriginalContent())['data'];

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id', 
                    'title', 
                    'description', 
                    'week_id', 
                    'week_title', 
                    'season_id', 
                    'season_name', 
                    'season_year',
                    'image',
                    'video'
                ]
            ]
        ]);
        $this->assertEquals(2, count($responseData));
        $this->assertEquals($responseData[0]->title, $matches[0]->title);
        $this->assertEquals($responseData[0]->week_id, $matches[0]->week_id);
        $this->assertEquals($responseData[1]->title, $matches[1]->title);
        $this->assertEquals($responseData[1]->week_id, $matches[1]->week_id);
    }

    public function testFilterMatchesWithYearAndWeekIdWillReturnFilteredDataSuccessfully()
    {
        $match = Match::latest('id')->first();
        $response = $this->getJson('/api/matches?week_id='. $match->week_id . '&year=2016');
        $responseData = ($response->getOriginalContent())['data'];

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id', 
                    'title', 
                    'description', 
                    'week_id', 
                    'week_title', 
                    'season_id', 
                    'season_name', 
                    'season_year',
                    'image',
                    'video'
                ]
            ]
        ]);
        $this->assertEquals(1, count($responseData));
        $this->assertEquals($responseData[0]->title, $match->title);
        $this->assertEquals($responseData[0]->week_id, $match->week_id);
    }

    public function testFilterMatchesWithInvalieFiltersWillReturnEmptyData()
    {
        $response = $this->getJson('/api/matches?week_id=3&year=2016');
        $responseData = ($response->getOriginalContent())['data'];

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data'
        ]);
        $this->assertEquals(0, count($responseData));
    }

    private function seedDB()
    {
        $firstSeason = Season::factory()->create(['year' => 2015]);
        $week1       = SeasonWeek::factory()->create(['season_id' => $firstSeason->id]);
        $week2       = SeasonWeek::factory()->create(['season_id' => $firstSeason->id]);
        $match1      = Match::factory()->create(['week_id' => $week1->id]);
        $match2      = Match::factory()->create(['week_id' => $week2->id]);

        $secondSeason = Season::factory()->create(['year' => 2016]);
        $week3        = SeasonWeek::factory()->create(['season_id' => $secondSeason->id]);
        $match3       = Match::factory()->create(['week_id' => $week3->id]);
    }
}
