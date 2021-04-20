<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\responseTrait;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    use responseTrait;

    public function register(Request $request){

        $fields = $request->validate([

            'name'=> 'required|string|max:50',
            'email'=> 'required|string|unique:users,email',
            'password'=> 'required|string|confirmed'

        ]);

        $user = User::create([
            'first_name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('key')->plainTextToken;// shoule to change this or resee it
        
        return $this->returnData('data', [$user, $token], __('auth.success'));
    }
    
    public function login(Request $request){

        $fields = $request->validate([
            'email'=> 'required|string',
            'password'=> 'required|string'
        ]);

        $user = User::where('email',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){

            return $this->returnError(201, __('auth.password_error'));

        }
        
            

        
        $token = $user->createToken('key')->plainTextToken;// shoule to change this or resee it
        
        return $this->returnData('data', [$user, $token], __('auth.success'));
    }

    public function logout(){

        auth('user')->user()->tokens()->delete();

        return $this->returnSuccess(__('auth.success'));

    }
}
