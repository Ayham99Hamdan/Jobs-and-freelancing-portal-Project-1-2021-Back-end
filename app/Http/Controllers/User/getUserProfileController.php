<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\apiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\responseTrait;

class getUserProfileController extends apiController
{
    use responseTrait;
    public function getUserProfile(){

        $user = auth('user')->user();
        $user = new UserResource(User::findOrFail($user->id)->load(['educations' , 'experiences']));
        return $this->apiResponse(new UserResource($user) , self::STATUS_OK, 'User Information');

    }


}
