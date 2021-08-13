<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class JobRole extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'job_roles';
    public $translatedAttributes = ['name'];
    protected $fillable=[
        'updated_at','created_at',
    ];
    
}
