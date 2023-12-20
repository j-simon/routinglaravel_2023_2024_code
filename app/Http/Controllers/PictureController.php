<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PictureController extends Controller
{
    //
    public function download()
    {
        //echo "download!";
        return response()->download("bild_gross.jpg");
    }
    public function show(Request $request,)
    {
        //echo "download!";
        if ($request->size === "large")
            return response()->file("bild_gross.jpg");
        if ($request->size === "small")
            return response()->file("bild_klein.jpg");
    }
}
