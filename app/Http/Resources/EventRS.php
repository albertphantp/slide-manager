<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventRS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"    => $this->id,
            "name"  => $this->name,
            "slug"  => $this->slug,
            "date"  => $this->date,
            "organizer" => new OrganizerRS($this->organizer)
        ];
    }
}
