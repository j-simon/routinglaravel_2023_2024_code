<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Parent Model
    public function posts() // plural
    {
        return $this->hasMany('App\Post'); 
    }
}
