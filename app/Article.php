<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'content'];

    //for soft delete functionality
    protected $dates = ['deleted_at']; 

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment')->latest();
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
}
