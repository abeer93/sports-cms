<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'week_id'     => $this->week_id,
            'week_title'  => $this->week? $this->week->title : "",
            'season_id'   => $this->week? $this->week->season_id : null,
            'season_name' => ($this->week && $this->week->season) ? $this->week->season->name : null,
            'season_year' => ($this->week && $this->week->season) ? $this->week->season->year : null,
            'image'       => asset('/') . $this->image,
            'video'       => $this->video
        ];
    }
}
