<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterestController extends Controller
{
     // uebung_17
     public function index() { 
        //dump(DB::table('interests')->dump());
        //dump(DB::table('interests')->dd());
	    //dump(DB::table('interests')->toSql());
        
		$interests = DB::select('select * from interests '); 
		
        return var_dump($interests); 
	}
	
	public function create($id, $text)  {
		DB::insert('insert into interests (id, text) values (:id, :text)' , ['id' => $id, 'text' => $text]);
	} 
	
	public function delete($id) {
		$removed = DB::delete('delete from interests where id = ?', [$id]); 
		return dd($removed); 
	}	
    //
    public function zeigeAlleInteressen(){

        $interests = DB::select('SELECT * FROM interests');

        foreach($interests as $interest) {
            echo $interest->id." ".$interest->text." ".$interest->updated_at."<br>";
          }    
        return "OK - hier sind alle Interessen";
    }


    public function erstelleInteresse($interesse){

        DB::insert('INSERT INTO interests (text) VALUES (:text)', ['text' => $interesse]);

        return "OK - Interesse erstellt";
    }

    
    public function loescheInteresse($id){

        $removed = DB::delete('DELETE FROM interests where id = ?',[$id]); 

        return "OK - Interesse geloescht";
    }
}
