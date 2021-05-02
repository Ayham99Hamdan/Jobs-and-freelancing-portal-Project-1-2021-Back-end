<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    protected $fillable = [
        'user_id',
        'qualification_id',
        'instituation_name',
        'study_field',
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qualification()
    {

        return $this->belongsTo(Qualification::class);
    }
}
