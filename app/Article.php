<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text'];



    //Mutator aaa => AAA
    public function setTitleAttribute($title)
    {
        //echo "setTitleAttribute - aufgerufen";
        $this->attributes['title'] = strtoupper($title);
    }
    //Accessor AAA => aaa
    public function getTitleAttribute()
    {
       // echo "getTitleAttribute - aufgerufen";
        return strtolower($this->attributes['title']);
    }
}
