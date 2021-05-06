<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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

            
            'title' => $this->title,
            'job_type' => $this->job_type,
            'job_role_id' => $this->job_role_id,
            'start_salary' => $this->start_salary,
            'end_salary' => $this->end_salary,
            'experience_years' => $this->experience_years,
            'description' => $this->description,
            'create_date' => $this->created_at 

        ];
    }
}
