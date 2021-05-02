<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\responseTrait;

class getUserProfileController extends Controller
{   
    use responseTrait;
    public function getUserProfile(){

        
        $user = auth('user')->user();
        return $this->returnData('user' , new UserResource(User::findOrFail($user->id)) , __('site.user'));
        
        

    }

    
}
