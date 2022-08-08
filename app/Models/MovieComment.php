<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MovieComment extends Model
{
    protected $fillable=[
        'content','creator'
    ];

    protected $table = 'movie_comment';

//    public function getActorsAttribute($actors)
//    {
//        return $actors ? json_decode($actors, true) : [];
//    }

}
