<?php

namespace Database\Factories;

use App\Models\Season;
use App\Models\SeasonWeek;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonWeekFactory extends Factory
{
    /**
     * @inheritdoc
     */
    protected $model = SeasonWeek::class;

    /**
     * @inheritdoc
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->title, 
            'week_number' => $this->faker->numberBetween(1, 4), 
            'season_id'   => (Season::factory()->create())->id
        ];
    }
}
