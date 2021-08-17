<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Company extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'avatar' , 'description', 'job_role_id'
    ];

    protected $appends = ['avatar_path'];
    public function jobRole(){

        return $this->belongsTo(JobRole::class , 'job_role_id');

    }

    public function posts(){

        return $this->hasMany(Post::class);

    }
    
    public function getAvatarPathAttribute(){
        return asset('uploads/company_images/' . $this->avatar);
    }
}
