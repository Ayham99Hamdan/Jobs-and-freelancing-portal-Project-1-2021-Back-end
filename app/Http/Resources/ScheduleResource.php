<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'day' => $this->day,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'interview_period' => $this->interview_period,
            'rest_period' => $this->rest_period,
            'interviews' => InterviewResource::collection($this->whenLoaded('interviews'))
        ];
    }
}
