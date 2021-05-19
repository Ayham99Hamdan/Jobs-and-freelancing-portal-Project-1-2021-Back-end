<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\apiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\ScheduleResource;
use App\Models\Interview;
use App\Models\Reaction;
use App\Traits\RestfulTrait;
use Illuminate\Http\Request;
use App\Traits\responseTrait;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserPostsController extends apiController
{
    use  RestfulTrait;
    public function getMatchedPosts(Request $request){

        $user = auth('user')->user();
        $posts = Post::where('job_role_id' , $user->job_role_id)->get();

        return $this->apiResponse(PostResource::collection($posts->load('userReaction' , 'jobRoles')), self::STATUS_OK,'Posts data has been returned successfully');

    }
    public function reaction($id){
        $user = auth('user')->user();
        $user = User::findOrFail($user->id);
        $react_or_not = $user->reactions()->where('post_id', $id)->get();
        if(count($react_or_not) == 0){
            $user->reactions()->attach($id);

        } else{
            $user->reactions()->detach($id);
        }

        return $this->apiResponse([], self::STATUS_OK, 'Post reacted successfully');

    }
    public function viewSchedule(Request $request){

        $user = auth('user')->user();
        $validate = $this->apiValidation($request , [
            'post_id' => 'required|exists:posts,id'
        ]);
        if($validate instanceof Response) return $validate;

        $Approved = Post::find($request->post_id)->approvedUser()->where('user_id' , $user->id)->get();
        if(count($Approved) > 0){
        $schedules = Post::find($request->post_id)->Schedules()->get()->load('interviews');
        return $this->apiResponse(ScheduleResource::collection($schedules) , self::STATUS_OK, "You can select Your Interview");
        } else {

            return $this->apiResponse([], self::STATUS_UNAUTHORIZED , 'Sorry! You not approved for this job');

        }
        return $this->apiResponse([], self::STATUS_NO_CONTENT , 'Sorry! You not approved for this job');

    }

    public function selectInterviewTime(Request $request){
        $user = auth('user')->user();
        $validate = $this->apiValidation($request , [
            'interview_id' => 'required|exists:interviews,id'
        ]);
        if($validate instanceof Response) return $validate;
        $interview = Interview::where('id',$request->interview_id)->whereNull('user_id')->first();
        if($interview){
            $interview->update([
                'user_id' => $user->id,
            ]);
            return $this->apiResponse(new InterviewResource($interview) , self::STATUS_OK, 'selecting interview successfully');
        }
        return $this->apiResponse([] , self::STATUS_NOT_FOUND , 'Unknown Error');
    }

    public function deselectInterviewTime(Request $request){
        $user = auth('user')->user();
        $validate = $this->apiValidation($request , [
            'interview_id' => 'required|exists:interviews,id'
        ]);
        if($validate instanceof Response) return $validate;
        $interview = Interview::where('id',$request->interview_id)->where('user_id' , $user->id)->first();
        if($interview){
            $interview->update([
                'user_id' => null,
            ]);
            return $this->apiResponse(new InterviewResource($interview) , self::STATUS_OK, 'selecting interview successfully');
        }
        return $this->apiResponse([] , self::STATUS_NOT_FOUND , 'Unknown Error');
    }

    public function getPostByTag(){
        $user = auth('user')->user();
//        $posts = Post::where('job_role_id' , $user->job_role_id)->get();
//        $end_posts = null;
//        $tags = User::where('id' , $user->id)->first()->tags()->get();
//        foreach($tags as $tag){
//            foreach($posts as $post){
//
//                $select = $post->with(['tags'=>function($q) use ($tag){
//
//                    return $q->where('tag' , $tag);
//
//                }]);
//                return $select->first();
//                if($select){
//
//                    $end_posts = $select;
//
//                }
//
//            }
//
//
//        }
//        return $end_posts->get();


        $posts = DB::table('user_tags')->where('user_id' , $user->id)->join('post_tags' , function($q) use ($user){

            $q->on('user_tags.tag' , 'like' ,'post_tags.tag');

        })->get();

        $ids = [];

        foreach ($posts as $post){

        array_push($ids , $post->post_id);

        }
        $posts = Post::findMany($ids);

        if(count($posts) != 0)
            return $this->apiResponse(PostResource::collection($posts->load('userReaction')), self::STATUS_OK , 'posts returned successfully');
        return $this->apiResponse([], self::STATUS_NO_CONTENT, 'there are no data');

    }
}
