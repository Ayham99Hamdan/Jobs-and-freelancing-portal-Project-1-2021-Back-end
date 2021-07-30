<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobRoleResource;
use App\Models\JobRole;
use Illuminate\Http\Request;

class JobRoleController extends apiController
{
    public function index(){
        $jobRoles = JobRole::all();
        if(count($jobRoles) != 0)
            return $this->apiResponse(JobRoleResource::collection($jobRoles) , self::STATUS_OK , 'Job Roles returned successfully');
        return $this->apiResponse([], self::STATUS_NO_CONTENT , 'there are no data');
    }
}
