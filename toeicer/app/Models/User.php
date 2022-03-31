<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    protected $table = 'Users';

    protected $fillable = [
        'email',
        'password',
        'name'
    ];
    const UPDATED_AT = null;

    public function books(){
        return $this->hasMany('App\Models\Book');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
}
