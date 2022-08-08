<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $table = 'movie';

    public function user()
    {
        return $this->hasOne(User::class,'id','director');
    }

    public function comments()
    {
        return $this->hasMany(MovieComment::class,'movie_id','id');
    }
}
