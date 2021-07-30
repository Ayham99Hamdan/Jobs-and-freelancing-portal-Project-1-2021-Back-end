<?php

namespace App\Http\Controllers;

use App\Http\Resources\QualificationResource;
use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends apiController
{
    public function index(){
        $qualifications = Qualification::all();
        if(count($qualifications) != 0)
            return $this->apiResponse(QualificationResource::collection($qualifications) , self::STATUS_OK , 'Job Roles returned successfully');
        return $this->apiResponse([], self::STATUS_NO_CONTENT , 'there are no data');
    }
}
