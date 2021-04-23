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

    public function job_role(){

        return $this->hasOne(JopRole::class);

    }

    public function posts(){

        return $this->hasMany(Post::class);

    }
    
}
