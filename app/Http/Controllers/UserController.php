<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\responseTrait;
use App\Traits\rulesReturnTrait;
use Ramsey\Uuid\Guid\Fields;

class UserController extends Controller
{
    use responseTrait, rulesReturnTrait;

    protected $model = User::class;
    

    public function register(Request $request)
    {

        $fields = $request->validate($this->userRegisterRules());

        $fields['password'] = bcrypt($fields['password']);


        $user = $this->model::create($fields);

        $token = $user->createToken('key')->plainTextToken; // shoule to change this or resee it

        return $this->returnData('data', [$user, $token], __('auth.success'));
    }

    public function login(Request $request)
    {

        $fields = $request->validate($this->userLoginRules());

        $user = $this->model::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {

            return $this->returnError(201, __('auth.password_error'));
        }

        $token = $user->createToken('key')->plainTextToken; // shoule to change this or resee it

        return $this->returnData('data', ['user' => $user, 'token' => $token], __('auth.success'));
    }

    public function logout()
    {

        auth('user')->user()->tokens()->delete();

        return $this->returnSuccess(__('auth.success'));
    }
}
