<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'likes'];

    protected $with = ['tags'];

    public function setLikesAttribute($value)
    {
        $this->attributes['likes'] = encrypt($value);
    }

    public function getLikesAttribute($value)
    {
        return decrypt($value);
    }


    public function interests()
    {
        return $this->belongsToMany('App\Interest');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }


    //Mutator aaa => AAA
    // public function setTitleAttribute($title)
    // {
    //     //echo "setTitleAttribute - aufgerufen";
    //     $this->attributes['title'] = strtoupper($title);
    // }
    // //Accessor AAA => aaa
    // public function getTitleAttribute()
    // {
    //    // echo "getTitleAttribute - aufgerufen";
    //     return strtolower($this->attributes['title']);
    // }


}
