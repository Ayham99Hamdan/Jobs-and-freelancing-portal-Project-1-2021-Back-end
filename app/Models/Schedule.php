<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'post_id' ,
        'day' ,
        'open_time' ,
        'close_time' ,
        'interview_period' ,
        'rest_period'
    ];
    public function post(){

        return $this->belongsTo('posts' , 'post_id');

    }

    public function interviews(){

        return $this->hasMany(Interview::class , 'schedule_id');

    }
}
