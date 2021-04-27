<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\responseTrait;
use App\Traits\rulesReturnTrait;
use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

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


        ]);



        return $education = Education::create([

            'user_id' => $user->id,
            'qualification_id' => $fields['qualification_id'],
            'instituation_name' => $fields['instituation_name'],
            'study_field' => $fields['instituation_name'],

        ]);
    }// end of addEducation method 

    public function updateEducation(Request $request){

        $user_id = auth('user')->user()->id;

        $fields = $request->validate([
            'id' => 'required',
            'qualification_id' => 'required',
            'instituation_name' => 'required|string',
            'study_field' => 'required|string',
        ]);
        
        return User::find($user_id)->educations()->where('id' , $fields['id'])->update([

            'qualification_id' => $fields['qualification_id'],
            'instituation_name' => $fields['instituation_name'],
            'study_field' => $fields['instituation_name'],

        ]);

    }// end of updateEducation

    public function addExperience(Request $request)
    {

        $user = auth('user')->user();

        $fields = $request->validate([

            'job_title' => 'required|string',
            'company_name' => 'required',
            'job_role_id' => 'required',
            //'start_date' => 'required|date'

        ]);

            

        return $experience = Experience::create([

            'user_id' => $user->id,
            'job_title' => $fields['job_title'],
            'company_name' => $fields['company_name'],
            'job_role_id' => $fields['job_role_id'],
            //'start_date'   => strtotime($fields['start_date'])

        ]);
    }//end of addExperience

    public function updateExperience(Request $request){

        $user_id = auth('user')->user()->id;
        
        $fields = $request->validate([
            'id'=>'required',
            'job_title' => 'required|string',
            'company_name' => 'required',
            'job_role_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        $experience = User::find($user_id)->experiences()->where('id', $fields['id'])->update([

            'job_title' => $fields['job_title'],
            'company_name' => $fields['company_name'],
            'job_role_id' => $fields['job_role_id'],
            'start_date'   => $fields['start_date'],
            'end_date'   => $fields['end_date'],
        ]);       
        
        if($experience){    

            return $this->returnData('date', User::find($user_id)->experiences()->get(), 'thos');

        }

    }//update user profile

    public function updateUserProfile(Request $request){

        $user = auth('user')->user();
        $rules = $this->userRegisterRules();

        $fields = $request->validate($rules);

    }
}
