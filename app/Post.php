<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name', 'pw', 'subject', 'content',
    ];

    protected $hidden = [
        'pw',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
