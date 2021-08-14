<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rules\In;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'phone' , 'avatar' , 'gender'
    ];
    protected $appends = ['avatar_url' , 'full_name'];

    public function experiences(){

        return $this->hasMany(Experience::class , 'user_id');

    }// end of experiences relation

    public function educations(){

        return $this->hasMany(Education::class);

    }// end of educations relation

    public function reactions(){

        return $this->belongsToMany(Post::class, 'reactions');

    }// end of reactions relation

    public function jobRole(){

        return $this->belongsTo(JobRole::class);

    }

    public function approvedPost(){

        return $this->belongsToMany(Post::class, 'approved_users');

    }

    public function interviews(){

        return $this->hasMany(Interview::class,'user_id');

    }

    public function tags(){

        return $this->hasMany(UserTag::class , 'user_id');

    }

    public function getGenderAttribute($value){
        
        if($value == 0){
            return __('site.female');
        } else {
            return __('site.male');
        }

    }// end of get gender
    public function setGenderAttribute($value){

        if($value === "male" || $value === 1){

            $this->attributes['gender'] = 1;

        } else{

            $this->attributes['gender'] = 0;

        }

    } // end of set gender

    public function getAvatarUrlAttribute(){

        return asset('uploads/user_images/' . $this->avatar);

    }// end of get path of user's avatar

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }
}
