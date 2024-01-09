<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
    
    use HasFactory;
    use SoftDeletes;

protected $fillable =['text'];
    // Parent Model
    public function posts() // plural
    {
        return $this->hasMany('App\Post'); 
    }

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
