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
    'description'];
    public function usersReations(){

        return $this->belongsToMany(user::class, Reaction::class);

    }// end of usersReations that return who user is reacting post

    public function company(){

        return $this->belongsTo(Company::class);

    }
}
