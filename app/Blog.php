<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = ['title','description','slug','image','user_id'];

    public function comment(){
        return $this->hasMany('App\Comment','blog_id','id');
    }
}
