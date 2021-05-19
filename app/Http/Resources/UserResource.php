<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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

            'id' => $this->id,
            'name' => $this->first_name . " " . $this->last_name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'educations' => EducationResource::collection($this->whenLoaded('educations')),
            'experiences' => ExperienceResource::collection($this->whenLoaded('experiences'))

        ];
    }
}
