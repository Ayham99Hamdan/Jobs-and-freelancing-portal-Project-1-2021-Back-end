<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\apiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Company;
use App\Models\PostTag;
use App\Traits\RestfulTrait;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Traits\responseTrait;
use Illuminate\Http\Response;

class CompanyManageController extends apiController
{
    use RestfulTrait;

    public function index(){

        $user = auth('company')->user();
        $posts = Post::where('company_id', $user->id)->get()->load('jobRoles' , 'userReaction');
        return $this->apiResponse(PostResource::collection($posts), self::STATUS_OK,__('auth.success'));

    }
    public function store(Request $request){
        $validate = $this->apiValidation($request , [
            'job_role_id' => 'required|exists:job_roles,id',
            'title' => 'required',
            'job_type' => 'required',
            'start_salary' => 'required',
            'experience_years' => 'required',
            'description' => 'required',
            'tags.*' => 'string'
        ]);
        if($validate instanceof Response) return $validate;
        $company = auth('company')->user();
        $post = Company::find($company->id)->posts()->create($request->all());
        if(count($request->tags) != 0)
            foreach ($request->tags as $tag){
                PostTag::create([
                    'post_id' => $post->id,
                    'tag' => $tag
                ]);
            }
        return $this->apiResponse(new PostResource($post->load('jobRoles')), self::STATUS_CREATED, 'Post has been created successfully');

    }
    public function update(Request $request , $id){

        $company = auth('company')->user();
        $validate = $this->apiValidation($request, [
            'job_role_id' => 'exists:job_roles,id',
            'title' => 'string',
            'job_type' => 'string',

        ]);
        if($validate instanceof Response) return $validate;
        $post = Post::findOrFail($id)->update($request->all());
        $post = Post::find($id);
        $post->tags()->delete();
        if(count($request->tags) != 0)
            foreach ($request->tags as $tag){
                PostTag::create([
                    'post_id' => $post->id,
                    'tag' => $tag
                ]);
            }
        if($post){

            return $this->apiResponse(new PostResource($post->load('jobRoles')), self::STATUS_OK, "post has been updated successfully");

        } else {

            return $this->apiResponse([],self::STATUS_NO_CONTENT, "Unkown Error");

        }


    }
    public function destroy($id){
        $status = Post::where('id' , $id)->delete();
        if($status){

            return $this->apiResponse([],self::STATUS_OK, 'Post deleted successfully');

        } else {

            return $this->apiResponse([], self::STATUS_NO_CONTENT, 'Unkown Error');

        }

    }
//
//    public function getAllPosts(){
//
//        $user = auth('company')->user();
//        return $this->returnData('posts' ,  PostResource::collection(Post::where('company_id' , $user->id)->get()->load('userReaction')), __('auth.success'));
//
//    }

    public function approve(Request $request){

        $validate = $this->apiValidation($request , [
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id'

        ]);

        if($validate instanceof Response) return $validate;
        $approve_or_not = Post::find($request->post_id)->approvedUser()->where('user_id' , $request->user_id)->get();
        if(count($approve_or_not) == 0)
            Post::find($request->post_id)->approvedUser()->attach($request->user_id);
        else
        Post::find($request->post_id)->approvedUser()->detach($request->user_id);
        return $this->apiResponse([], self::STATUS_OK , 'approved successfully');

    }
}
