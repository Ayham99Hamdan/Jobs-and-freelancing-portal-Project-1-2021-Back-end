<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function getGenderAttribute($value){

        if ($value == 1){

            return 'male';

        }else if($value == 0){

            return 'female';

        }else {

            return 'Null';

        }

    }
    public function experiences(){

        return $this->hasMany(Experience::class);

    }// end of experiences relation

    public function educations(){

        return $this->hasMany(Education::class);

    }// end of educations relation

    public function reactions(){

        return $this->belongsToMany(Post::class, Reaction::class);

    }// end of reactions relation
}
