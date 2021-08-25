<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\apiController;
use App\Http\Resources\EducationResource;
use App\Http\Resources\ExperienceResource;
use App\Http\Resources\UserResource;
use App\Models\UserTag;
use App\Traits\RestfulTrait;
use App\Traits\rulesReturnTrait;
use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use PDF;

class UserProfileController extends apiController
{
    use RestfulTrait , rulesReturnTrait;


    public function addEducation(Request $request)
    {

        $user = auth('user')->user();
        $validate = $this->apiValidation($request , [
            'qualification_id' => 'required|exists:qualifications,id',
            'instituation_name' => 'required|string',
            'study_field' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date'
        ]);
        if($validate instanceof Response) return $validate;
        $education = User::find($user->id)->educations()->create($request->all());
        return $this->apiResponse(new EducationResource($education), self::STATUS_CREATED, 'Your Education has been added to your profile');
    }// end of addEducation method

    public function updateEducation(Request $request , $id){
        $user_id = auth('user')->user()->id;
        $validate = $this->apiValidation($request ,[
            'qualification_id' => 'exists:qualifications,id',
            'instituation_name' => 'string',
            'study_field' => 'string',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);
        if($validate instanceof Response) return $validate;
        User::find($user_id)->educations()->where('id' ,$id)->update($request->all());
        $education = Education::findOrFail($id);
        return $this->apiResponse(new EducationResource($education), self::STATUS_OK, __('auth.success'));
    }// end of updateEducation

    public function addExperience(Request $request)
    {

        $user = auth('user')->user();
        $validate = $this->apiValidation($request ,[
            'job_title' => 'required|string',
            'company_name' => 'required',
            'job_role_id' => 'required|exists:job_roles,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date'
        ]);
        if($validate instanceof Response) return $validate;
        $experience = User::find($user->id)->experiences()->create($request->all());
        return $this->apiResponse(new ExperienceResource($experience), self::STATUS_OK, __('auth.success'));
    }//end of addExperience

    public function updateExperience(Request $request , $id){

        $user_id = auth('user')->user()->id;
        $validate = $this->apiValidation($request ,[
            'job_title' => 'string',
            'company_name' => 'string',
            'job_role_id' => 'string',
            'start_date' => 'date',
            'end_date' => 'nullable|date'
        ]);
        if($validate instanceof Response) return $validate;
        User::find($user_id)->experiences()->where('id' , $id)->update($request->all());
        $experience = Experience::findOrFail($id);
        return $this->apiResponse(new ExperienceResource($experience), self::STATUS_OK, __('auth.success'));

    }//update user profile

    public function updateUserProfile(Request $request){

        $user = auth('user')->user();
        $validate = $this->apiValidation($request, [

            'first_name' => 'string|max:50',
            'last_name' => 'string|max:50',
            'avatar' => 'image',
            'tags.*' => 'string'
        ]);
        if($validate instanceof Response) return $validate;

        if ($request->avatar) {
            if($request->avatar != 'default.jpg'){
                Storage::disk('public_uploads')->delete('/user_images' .'/'. $user->avatar);
            }

            Image::make($request->avatar)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/') . $request->avatar->hashName());
            $data = $request->all();
            $data['avatar'] = $request->avatar->hashName();

        }
        User::find($user->id)->update($request->all());
        $user = User::find($user->id);
        $user->tags()->delete();
        if(count($request->tags) != 0)
            foreach ($request->tags as $tag){
                UserTag::create([
                    'user_id' => $user->id,
                    'tag' => $tag
                ]);
            }
        return $this->apiResponse(new UserResource($user), self::STATUS_OK, 'User Data has been updataed successfully');
    }// end of update main user data

    
}
