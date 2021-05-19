<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InterviewResource extends JsonResource
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
            'id'=> $this->id,
            'schedule_id' => $this->schedule_id,
            //'schedule' =>  $this-,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
        ];
    }
}
