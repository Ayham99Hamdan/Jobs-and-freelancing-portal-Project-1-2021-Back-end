<?php

namespace App\Http\Resources;

use App\Models\Reaction;
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
        $reaction = false;
        if(auth('user')->check()) {
            $user = auth('user')->user();
            $react = Reaction::where('user_id', $user->id)->where('post_id', $this->id)->first();
            if (isset($react)) $reaction = true;
        }
        return [

            'id' => $this->id,
            'title' => $this->title,
            'job_type' => $this->job_type,
            'job_role_id' => new JobRoleResource($this->whenLoaded('jobRoles')),
            'start_salary' => $this->start_salary,
            'end_salary' => $this->end_salary,
            'reactions_1' => UserReactionResource::collection($this->whenLoaded('userReaction')),
            'reactions' => $reaction,
            'experience_years' => $this->experience_years,
            'description' => $this->description,
            'create_date' => $this->created_at,
        ];
    }
}
