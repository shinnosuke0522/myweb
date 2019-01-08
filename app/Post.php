<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function favorites(){
        return $this->hasMany('App\favorite');
    }
    public function added_by(){
        return favorite::where('user_id', Auth::user()->id)->first();
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
