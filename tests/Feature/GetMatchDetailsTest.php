<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Match;

class GetMatchDetailsTest extends TestCase
{
    use RefreshDatabase;
    
    public function testGetMatchDetailsWithIdNotExistWillReturnNotFound()
    {
        $response = $this->getJson('/api/matches/1');

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Model not exist!.']);
    }

    public function testGetMatchDetailsWithValidIdWillReturnDataSuccessfully()
    {
        $match = Match::factory()->create();

        $response = $this->getJson('/api/matches/' . $match->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
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
        ]);

        $match->refresh();
        $responseData = ($response->getOriginalContent())['data'];

        $this->assertEquals($match->title, $responseData->title);
        $this->assertEquals($match->description, $responseData->description);
        $this->assertEquals($match->image, $responseData->image);
        $this->assertEquals($match->week_id, $responseData->week_id);
    }
}
