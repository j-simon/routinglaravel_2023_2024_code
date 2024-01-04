<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use HasFactory;

    use SoftDeletes; // aktiviere Softdeleting, also nicht wirklich löschen


    //protected $fillable = ['title','text',"id"]; // Schutz gegen Massen Zuweisung Hack/Versuch von GET/POSt Request Werten
    protected $guarded = ['interest_id', 'created_at', "updated_at"];

    public function scopeZeigeNurFuenf($query)
    {

        return $query->limit(5);
    }


    // Child Model
    public function interest()  //singular 
    {
        return $this->belongsTo('App\Interest');
    }

    
}
