<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{

    protected $table = 'job_roles';

    protected $fillable=[
        'name','updated_at','created_at',
    ];

}
