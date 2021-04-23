<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'phone' , 'image' , 'gender'
    ];
    
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

    public function jobRole(){

        return $this->hasOne(JobRole::class);

    }
}
