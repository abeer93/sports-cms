<?php

namespace Database\Factories;

use App\Models\Match;
use App\Models\SeasonWeek;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MatchFactory extends Factory
{
    /**
     * @inheritdoc
     */
    protected $model = Match::class;

    /**
     * @inheritdoc
     */
    public function definition()
    {
        $title = [
            'en' => $this->faker->title,
            'ar' => $this->faker->title,
        ];
        $description = [
            'en' => $this->faker->text,
            'ar' => $this->faker->text,
        ];

        return [
            'title'       => $title,
            'description' => $description, 
            'image'       => $this->faker->imageUrl(), 
            'video'       => $this->faker->imageUrl(),  
            'week_id'     => (SeasonWeek::factory()->create())->id,
        ];
    }
}
