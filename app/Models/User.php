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
        'first_name','last_name', 'email', 'password', 'phone' , 'avatar' , 'gender'
    ];
    protected $appends = ['avatar_url'];

    public function experiences(){

        return $this->hasMany(Experience::class , 'user_id');

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

    public function getGenderAttribute($value){

        if ($value == 1){

            return 'male';

        }else if($value == 0){

            return 'female';

        }else {

            return 'Null';

        }

    }// end of get gender
    public function setGenderAttribute($value){

        if($value === "male"){

            $this->attributes['gender'] = 1;

        } else{

            $this->attributes['gender'] = 0;

        }

    } // end of set gender

    public function getAvatarUrlAttribute(){

        return asset('uploads/user_images/' . $this->avatar);

    }// end of get path of user's avatar
}
