<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qualification(){

        return $this->hasOne(Qualification::class);

    }
}
