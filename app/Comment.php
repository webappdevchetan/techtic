<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['blog_id','comment','user_id'];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
}
