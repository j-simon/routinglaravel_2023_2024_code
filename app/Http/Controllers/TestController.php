<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// wie heisst die Klasse: App\Http\Controllers\TestController;
class TestController extends Controller
{
    //
    public function hierWirdDieRouteAusgecodet($id) {
        echo "hallo, hier ist die Antworte auf die Route mit der id=".$id;
    }
}
