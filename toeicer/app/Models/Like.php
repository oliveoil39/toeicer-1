<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'Likes';

    protected $fillable = [
        'user_id',
        'book_id',
    ];
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function book(){
        return $this->belongsTo('App\Models\book');
    }

}
