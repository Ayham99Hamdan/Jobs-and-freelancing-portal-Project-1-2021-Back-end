<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'user_id' ,
        'post_id' ,
        'time_from' ,
        'time_to' ,
    ];

    public function user(){

        return $this->belongsTo(User::class, 'user_id');

    }

    public function schedule(){

        return $this->belongsTo(Schedule::class, 'schedule_id');

    }
}
