<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterMenuController extends Controller
{
    //
    public function gibImpressumAus()
    {

        return "Impressum";
    }

    public function gibAgbAus()
    {
        //

        // Variante 1 für Datenübergabe von der Logik-Seite in einer Closure-Route aus einer action in einem Controller
        $a = "<b>Jens</b>";
        $b = "Simon";

        $daten = [
            'vorname' => $a,
            'nachname' => $b
        ];

        echo $daten['vorname'];
        echo $daten['nachname'];
        //dd($daten);

        // return view("footermenue.agb",$daten); // uebergabeprozess von beliebigen Daten an View
        //return view("footermenue.agb")->with($daten); // uebergabeprozess von beliebigen Daten an View
        return view("footermenue.agb", compact("daten")); // uebergabeprozess von beliebigen Daten an View

    }

    public function gibDatenschutzAus()
    {
    }
}
