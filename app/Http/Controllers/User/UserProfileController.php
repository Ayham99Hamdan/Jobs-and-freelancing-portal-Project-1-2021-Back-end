<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\responseTrait;
use App\Traits\rulesReturnTrait;
use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    use responseTrait , rulesReturnTrait;

    
    public function addEducation(Request $request)
    {

        $user = auth('user')->user();

        $fields = $request->validate([

            'qualification_id' => 'required',
            'instituation_name' => 'required|string',
            'study_field' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date'


        ]);



        $education = Education::create([

            'user_id' => $user->id,
            'qualification_id' => $fields['qualification_id'],
            'instituation_name' => $fields['instituation_name'],
            'study_field' => $fields['instituation_name'],
            'start_date'   => $fields['start_date'],
            'end_date'   => $fields['end_date'],    
        ]);

        return $this->returnSuccess(__('auth.success'));
    }// end of addEducation method 

    public function updateEducation(Request $request){

        $user_id = auth('user')->user()->id;

        $fields = $request->validate([
            'id' => 'required',
            'qualification_id' => 'required',
            'instituation_name' => 'required|string',
            'study_field' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date'
        ]);
        
        User::find($user_id)->educations()->where('id' , $fields['id'])->update([

            'qualification_id' => $fields['qualification_id'],
            'instituation_name' => $fields['instituation_name'],
            'study_field' => $fields['instituation_name'],
            'start_date'   => $fields['start_date'],
            'end_date'   => $fields['end_date'],

        ]);
        return $this->returnSuccess(__('auth.success'));
    }// end of updateEducation

    public function addExperience(Request $request)
    {

        $user = auth('user')->user();

        $fields = $request->validate([

            'job_title' => 'required|string',
            'company_name' => 'required',
            'job_role_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date'

        ]);

            

        return $experience = Experience::create([

            'user_id' => $user->id,
            'job_title' => $fields['job_title'],
            'company_name' => $fields['company_name'],
            'job_role_id' => $fields['job_role_id'],
            'start_date'   => $fields['start_date'],

        ]);

        return $this->returnSuccess(__('auth.success'));
    }//end of addExperience

    public function updateExperience(Request $request){

        $user_id = auth('user')->user()->id;
        
        $fields = $request->validate([
            'id'=>'required',
            'job_title' => 'required|string',
            'company_name' => 'required',
            'job_role_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date'
        ]);

        $experience = User::find($user_id)->experiences()->where('id', $fields['id'])->update([

            'job_title' => $fields['job_title'],
            'company_name' => $fields['company_name'],
            'job_role_id' => $fields['job_role_id'],
            'start_date'   => $fields['start_date'],
            'end_date'   => $fields['end_date'],
        ]);       
        
        return $this->returnSuccess(__('auth.success'));

    }//update user profile

    public function updateUserProfile(Request $request){

        $user = auth('user')->user();
        $rules = $this->userRegisterRules();
        unset($rules['email']);
        unset($rules['password']);

        $fields = $request->validate($rules);
        
        if ($fields['avatar']) {

            if($fields['avatar'] != 'default.jpg'){
                
                
                Storage::disk('public_uploads')->delete('/user_images' .'/'. $user->avatar);
                
            }

            Image::make($request->avatar)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/') . $fields['avatar']->hashName());

            $fields['avatar'] = $fields['avatar']->hashName();
        }
        
        User::find($user->id)->update($fields);
        return $this->returnSuccess(__('auth.success'));
    }// end of update main user data
}
