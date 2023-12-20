<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// wie heisst die Klasse: App\Http\Controllers\TestController;
class TestController extends Controller
{
    // uebung 04
    public function printMessage() {
        echo "Hallo Welt, wie geht es dir?";

    }
    public function ab($a,$b) {
        echo "a=".$a." b=".$b ;

    }

     // uebung 05 a)
     public function showName($name,$nachname) {
        echo "Der name lautet: ".$name." der Nachname lautet: ".$nachname ;

    }

    // uebung 05 b)
    public function showUsername($id) {
        echo "Der username lautet: ".$id;

    }


    //
    public function hierWirdDieRouteAusgecodet($id) {
        echo "hallo, hier ist die Antworte auf die Route mit der id=".$id;
    }
}
