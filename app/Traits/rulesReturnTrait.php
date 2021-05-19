<?php

namespace App\Traits;

use PhpParser\Builder\Trait_;

trait rulesReturnTrait
{

    // Start user Form Rules
    public function userRegisterRules()
    {

        return [

            'first_name' => 'required|string|max:50',
            'last_name' => 'string|max:50',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'avatar' => 'image',
            'tags.*' => 'string'

        ];
    }
    public function userLoginRules()
    {

        return [


            'email' => 'required|string',
            'password' => 'required|string'

        ];
    }
    // End user Form Rules
    // Start Company Form Rules

    public function companyRegisterRules()
    {

        return [

            'name' => 'required|string|max:50',
            'email' => 'required|string|unique:companies,email',
            'password' => 'required|string|confirmed',
            'description' => 'required|string|max:50'

        ];
    }

    public function companyLoginRules()
    {

        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    // End Company Form Rules

}
