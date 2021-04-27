<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [

        'user_id',
        'job_title',
        'company_name',
        'job_role_id'
    ];


    public function user(){

        return $this->belongsTo(User::class);
            
    }

    public function jobRole(){

        $this->hasOne(JobRole::class);

    }
}
