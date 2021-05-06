<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Traits\responseTrait;

class CompanyManageController extends Controller
{
    use responseTrait;
    public function createPost(Request $request){
        return $request->header();
        $company = auth('company')->user();
        $rules = [

            'job_role_id' => 'required',
            'title' => 'required',
            'job_type' => 'required',
            'start_salary' => 'required',
            'experience_years' => 'required',
            'description' => 'required'
        ];
        $fields = $request->validate($rules);
        $fields['company_id'] = $company->id;
        Post::create($fields);

        return $this->returnSuccess(__('auth.success'));

    }
    public function updatePost(Request $request){

        $company = auth('company')->user();
        $rules = [
            'id' => 'required',
            'job_role_id' => 'required',
            'title' => 'required',
            'job_type' => 'required',
            'start_salary' => 'required',
            'experience_years' => 'required',
            'description' => 'required'
        ];
        $fields = $request->validate($rules);
        $post = Post::findOrFail($fields['id'])->update($fields);
        if($post){

            return $this->returnSuccess(__('auth.success'));

        } else {

            return $this->returnError(404 , 'Unkown Error');

        }
        

    }
    public function deletePost(Request $request){

        $company = auth('company')->user();

        $rules = [

            'id' => 'required'
        ];
        $fields = $request->validate($rules);

        $status = Post::where('company_id' , $company->id)->where('id', $request->id)->delete();
        if($status){

            return $this->returnSuccess(__('auth.success'));

        } else {

            return $this->returnError('404' , 'Unkown Error');

        }
        
    }

    public function getAllPosts(Request $request){

        $user = auth('company')->user();
        
        return $this->returnData('posts' ,  PostResource::collection(Post::where('company_id' , $user->id)->get()), __('auth.success'));

    }
}
