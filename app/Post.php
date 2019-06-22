<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','title','file_name'];

    public function comments(){

    	return $this->hasMany('App\Comment');

    }

    public function likes(){

    	return $this->hasMany('App\Like');

    }

    public function  User()
    {

    	return $this->belongsTo('App\User');

    }
}
