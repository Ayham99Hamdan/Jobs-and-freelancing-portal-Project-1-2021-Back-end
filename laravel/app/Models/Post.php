<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function usersReations(){

        return $this->belongsToMany(user::class, Reaction::class);

    }// end of usersReations that return who user is reacting post
}
