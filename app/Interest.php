<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    // Parent Model
    public function posts() // plural
    {
        return $this->hasMany('App\Post'); 
    }
}
