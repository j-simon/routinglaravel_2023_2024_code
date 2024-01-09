<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
      //
      protected $fillable = ['title'];

      public function getTitleAttribute($value)
      {
          return ucfirst($value);
      }
  
  
      public function article()
      {
          return $this->belongsTo('App\Article');
      }
}
