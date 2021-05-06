<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Traits\responseTrait;
use App\Models\Post;

class UserPostsController extends Controller
{
    use  responseTrait;
    public function getMatchedPosts(Request $request){

        $user = auth('user')->user();
        
        return $this->returnData('posts' , PostResource::collection(Post::where('job_role_id' , $user->job_role_id)->get()), ' ');

    }
}
