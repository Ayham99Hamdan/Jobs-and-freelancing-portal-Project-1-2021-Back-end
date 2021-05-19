<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\apiController;
use App\Models\Company;
use App\Traits\RestfulTrait;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\rulesReturnTrait;


class CompanyController extends apiController
{
    use RestfulTrait, rulesReturnTrait;

    protected $model = Company::class;


    public function register(Request $request)
    {
        $validate = $this->apiValidation($request , $this->companyRegisterRules());

        if($validate instanceof Response) return $validate;

        $request['password'] = bcrypt($request->password);

        $user = $this->model::create($request->all());

        $token = $user->createToken('key')->plainTextToken; // shoule to change this or resee it
        return $this->apiResponse(['user' => $user , 'token' => $token], self::STATUS_CREATED, 'Company Account has been registerd successfully');
    }

    public function login(Request $request)
    {

        $validate = $this->apiValidation($request , $this->companyLoginRules());
        if($validate instanceof Response) return $validate;

        $user = $this->model::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return $this->apiResponse([], self::STATUS_NOT_AUTHENTICATED, __('auth.password_error'));
        }

        $token = $user->createToken('key')->plainTextToken; // shoule to change this or resee it

        return $this->apiResponse(['user' => $user, 'token' => $token], self::STATUS_OK,__('auth.success'));
    }

    public function logout()
    {

        auth('company')->user()->tokens()->delete();

        return $this->apiResponse([], self::STATUS_OK, __('auth.success'));
    }
}
