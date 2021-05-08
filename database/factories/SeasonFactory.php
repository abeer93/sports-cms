<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    /**
     * @inheritdoc
     */
    protected $model = Season::class;

    /**
     * @inheritdoc
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'year' => $this->faker->year
        ];
    }
}
