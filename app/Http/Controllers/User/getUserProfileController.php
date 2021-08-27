<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\apiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\responseTrait;
use PDF;

class getUserProfileController extends apiController
{
    use responseTrait;
    public function getUserProfile(){

        $user = auth('user')->user();
        $user = new UserResource(User::findOrFail($user->id)->load(['educations' , 'experiences']));
        return $this->apiResponse(new UserResource($user) , self::STATUS_OK, 'User Information');

    }
    public function getCV(){
        $user_id = auth('user')->user()->id;
        $user = User::find($user_id);
        $user->load('educations' , 'experiences' , 'jobRole');
        $user = $user->toArray();
        //dd($user);
        $pdf = PDF::loadView('CV_template.CV' , $user);
        return $pdf->stream();

    }

    public function getuserProfileById($id){
        $user = new UserResource(User::findOrFail($id)->load(['educations' , 'experiences']));
        return $this->apiResponse(new UserResource($user) , self::STATUS_OK, 'User Information');
    }


}
