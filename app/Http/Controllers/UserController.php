<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Traits\responseTrait;


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
        
        return $this->returnData('data', [$user, $token], 'success');
    }
}
