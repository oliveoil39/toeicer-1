<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $table = 'Books';

    protected $fillable = [
        'name',
        'user_id',
        'image',
        'level',
        'part',
        'period',
        'review',
        'url',
        'price'
    ];
    const UPDATED_AT = null;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function isLikedBy($user_id, $book_id){
        return Like::where('user_id', $user_id)->where('book_id', $book_id)->first() !==null;
    }
}
