<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
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
        'qualification' => new QualificationResource($this->qualification),
        'instituation_name'=> $this->instituation_name,
        'study_field' => $this->study_field,
        'start_date' => $this->start_date,
        'end_date' => $this->end_field

        ];
    }
}
