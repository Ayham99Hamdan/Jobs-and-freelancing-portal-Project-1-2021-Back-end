<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
    'company_id',
    'job_role_id',
    'title',
    'job_type',
    'start_salary',
    'experience_years',
    'description',
    'is_approved'
];
    public function userReaction(){

        return $this->belongsToMany(user::class, 'reactions');

    }// end of usersReactions that return who user is reacting post

    public function company(){

        return $this->belongsTo(Company::class);

    }
    public function jobRoles(){

        return $this->belongsTo(JobRole::class , 'job_role_id');

    }

    public function schedules(){

        return $this->hasMany( Schedule::class, 'post_id' , 'id');

    }

    public function approvedUser(){

        return $this->belongsToMany(User::class ,'approved_users');

    }

    public function tags(){

        return $this->hasMany(PostTag::class , 'post_id');

    }

    public function scopeApproved($query){
        return $query->where('is_approved' , 1);
    }
}
