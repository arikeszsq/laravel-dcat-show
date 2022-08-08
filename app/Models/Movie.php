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
}
