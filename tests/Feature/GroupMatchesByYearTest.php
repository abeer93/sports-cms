<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Match;
use App\Models\Season;
use App\Models\SeasonWeek;

class GroupMatchesByYearTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedDB();
    }

    public function testGroupMatchesBySeasonYearGroupDataSuccessfully()
    {
        $response = $this->getJson('/api/matches/year');
        $responseData = ($response->getOriginalContent())['data'];

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
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
            ]
        ]);
        $this->assertEquals(2, count($responseData));
        $this->assertEquals(2, count($responseData[2015]));
        $this->assertEquals(1, count($responseData[2016]));
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