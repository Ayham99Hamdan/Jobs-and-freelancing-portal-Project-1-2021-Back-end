<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualificationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name' , 'locale' , 'qualification_id'];
}
