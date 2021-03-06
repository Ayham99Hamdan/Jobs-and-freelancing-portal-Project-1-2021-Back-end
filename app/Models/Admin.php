<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;

    protected $guard_name = 'admin';

    protected $fillable = [
        'first_name' ,
        'last_name' ,
        'email' ,
        'password',
        'avatar'
    ];

    protected $appends = ['avatar_path'];

    public function getAvatarPathAttribute(){
        return asset('uploads/admin_images/' . $this->avatar);
    }



}
