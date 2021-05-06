<?php

namespace App\Http\Controllers\auth;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\responseTrait;
use App\Traits\rulesReturnTrait;
use App\Http\Controllers\Controller;


class CompanyController extends Controller
{
    use responseTrait, rulesReturnTrait;

    protected $model = Company::class;
    

    public function register(Request $request)
    {

        $fields = $request->validate($this->companyRegisterRules());

        $fields['password'] = bcrypt($fields['password']);

        $user = $this->model::create($fields);

        $token = $user->createToken('key')->plainTextToken; // shoule to change this or resee it

        return $this->returnData('data', ['user' => $user, 'token' => $token], __('auth.success'));
    }

    public function login(Request $request)
    {

        $fields = $request->validate($this->companyLoginRules());

        $user = $this->model::where('email', $fields['email'])->first();
        
        if (!$user || !Hash::check($fields['password'], $user->password)) {

            return $this->returnError(201, __('auth.password_error'));
        }

        $token = $user->createToken('key')->plainTextToken; // shoule to change this or resee it

        return $this->returnData('data', ['user' => $user, 'token' => $token], __('auth.success'));
    }

    public function logout()
    {

        auth('company')->user()->tokens()->delete();

        return $this->returnSuccess(__('auth.success'));
    }
}
