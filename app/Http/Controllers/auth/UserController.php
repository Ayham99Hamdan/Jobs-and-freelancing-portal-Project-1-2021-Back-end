<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\apiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserTag;
use App\Traits\RestfulTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\rulesReturnTrait;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;



class UserController extends apiController
{
    use RestfulTrait, rulesReturnTrait;

    protected $model = User::class;


    public function register(Request $request)
    {

        $validate = $this->apiValidation($request, $this->userRegisterRules());
        if($validate instanceof Response) return $validate;
        $request_data = $request->except('password', 'password_confirmation', 'avatar');
        $request_data['password'] = bcrypt($request->password);
        if ($request->avatar) {

            Image::make($request->avatar)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/') . $request->avatar->hashName());

            $request_data['avatar'] = $request->avatar->hashName();
        }
        $user = $this->model::create($request_data);
        $token = $user->createToken('key')->plainTextToken; // shoule to change this or resee it
        if(count($request->tags) != 0)
            foreach ($request->tags as $tag){
                UserTag::create([
                    'user_id' => $user->id,
                    'tag' => $tag
                ]);
        }
        return $this->apiResponse(['user' => new UserResource($user), 'token' =>  $token], self::STATUS_CREATED,__('auth.success'));
    }

    public function login(Request $request)
    {
        $validate = $this->apiValidation($request, $this->userLoginRules());
        if($validate instanceof Response) return $validate;

        $user = $this->model::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return $this->apiResponse([], self::STATUS_NOT_AUTHENTICATED, __('auth.password_error'));
        }

        $token = $user->createToken('key')->plainTextToken; // shoule to change this or resee it

        return $this->apiResponse(['user' => new UserResource($user), 'token' => $token], self::STATUS_OK,__('auth.success'));
    }

    public function logout()
    {

        auth('user')->user()->tokens()->delete();

        return $this->apiResponse([], self::STATUS_OK,__('auth.success'));
    }
}
