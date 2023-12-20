<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () { // / Startseite

    return view("welcome");
});


Route::get("/seite2", function () { // seite2
    return view("seite2");
});

Route::get("/impressum", function () { // impressum
    //return "Impressum";    
    echo "Impressum einfach so mit echo ausgegeben!";
});

/*
/itm/195620068777    
/itm/266560833825
*/

// Teil parametrisierte Route(relative Webadresse)
// z.B. ebay.de oder otto.de
// https://www.ebay.de   /itm/266560833825     ?_trkparms=amclksrc%3DITM%26aid%3D777008%26algo%3DPERSONAL.TOPIC%26ao%3D1%26asc%3D20230823115209%26meid%3Db7f1719369274cfba400ff4c58d0c258%26pid%3D101800%26rk%3D1%26rkt%3D1%26sd%3D266560833825%26itm%3D266560833825%26pmt%3D0%26noa%3D1%26pg%3D4375194%26algv%3DRecentlyViewedItemsV2SignedOut&_trksid=p4375194.c101800.m5481&_trkparms=parentrq%3A7cc4d56f18c0a126e6b2556ffffefa5a%7Cpageci%3Adc5f9fbd-9d9b-11ee-9106-e668de7c6bc4%7Ciid%3A1%7Cvlpname%3Avlp_homepage
// https://otto.de       /p/home-affaire-relaxsessel-paris-set-2-st-bestehend-aus-sessel-und-hocker-mit-passendem-hocker-506530251/

// product_nummer? erlaubt entweder eine beliebige nummer oder auch nicgts nach /itm
Route::get("/itm/{product_nummer?}", function (Request $request, $product_nummer = null) {
    // die Produktnummer hinter dem /itm/.. kann über die Variable $product_nummer weiterverarbeitet werden
    // der Begriff product_nummer und $product_nummer kann beliebig als parameter erfunden werden!

    //echo "Seite: ".$product_nummer;

    //print_r($_GET); // in Laravel keine $_ Variablen beutzen! 

    //echo $request->vorname."<br>"; //jens // ?vorname=jens

    if (!$request->has("vorname"))
        return "hacking Versuch, vorname fehlt ";
    else {

        if ($request->filled("vorname"))
            $vorname = $request->input("vorname");
        else
            $vorname = "unbekannt";
    }
    echo $vorname;

    //echo app('url')->full();

});

Route::get("/sport/fussball/{fussball_verein}", function ($fussball_vereinsname) {
    // die Produktnummer hinter dem /itm/.. kann über die Variable $product_nummer weiterverarbeitet werden
    // der Begriff product_nummer und $product_nummer kann beliebig als parameter erfunden werden!

    echo "Seite: " . $fussball_vereinsname;
});

// relaunch url neu zuordnen

// /impressum   => /imprint 
// redirecting von nach
Route::redirect("/imprint", "/impressum");


Route::get("/formular", function () {
    return "
<html>
<body>
<form action='/warum_ist_das_schwierig_aufzurufen' method='POST'>

<input type='submit'>
</form>
</body>
</html>
    ";
});

Route::post("/warum_ist_das_schwierig_aufzurufen", function () {
    echo "geschafft!";
});

// Route::get("/{vorname}/{nachname}",function($vorname,$nachname){
//     // die Produktnummer hinter dem /itm/.. kann über die Variable $product_nummer weiterverarbeitet werden
//     // der Begriff product_nummer und $product_nummer kann beliebig als parameter erfunden werden!
// echo "Vorname.".$vorname."<br>";
// echo "Nachname: ".$nachname;
// });

// Separation of Concerns
// => nutze einen Controller, dieser ist das C in MVC,dem sogenanten LifeCyle, einer Anfrage ans System und dessen Antwort 

// uebung_01
Route::get("/helloworld", function () {

    return "Hallo Welt wie geht es dir?";
});

// uebung_02
Route::get("/name/{name}/nachname/{nachname}", function ($name, $vorname) {

    return "es wurde übergeben: " . $name . " " . $vorname;
});

// uebung_03
Route::get("/user/{name?}", function ($name = "unknown user") {

    return "es wurde übergeben: " . $name;
})->name("uebung3"); // Nickname


// beide nachfolgenden routes zeigen eine gewollte Fehlermeldung,
// da hat jemand etwas vorbereitet , aber noch nicht gewusst was getan werden soll! 
Route::get("/testroute"); // Route ohne 2.ten Parameter => default null
Route::get("/testroute2", null); // Route mit 2.ten Parameter =>  null

/*Route::get("/testroute3",function ($id){
//hier soll nicht mehr gecodet werden! keine Closure-Route mit der callback-function ausser zu testzwecken
 echo "hallo, hier ist die Antworte auf die Route";
});*/

// verschiedene Aufruf Codeing-Sytles für Controller-Actions

//                       // Klassename des Controllers @ methodenname / action
//Route::get("/testroute4/{id}", "App\Http\Controllers\TestController@hierWirdDieRouteAusgecodet");

// hierfür muss der namespace injiziert werden, siehe: app\Providers\RouteServiceProvider.php
Route::get("/testroute5/{id}", "TestController@hierWirdDieRouteAusgecodet"); // unser Kurs!

Route::get("/testroute6/{id}", [App\Http\Controllers\TestController::class, "hierWirdDieRouteAusgecodet"]);

Route::get("/testroute7","Test2Controller"); // invokable / nur eine Methode, die ohen speziellen Namen aufgerufen wird

//
Route::get("/impressum", "FooterMenuController@gibImpressumAus"); // Standard-Controller
Route::get("/agb", "FooterMenuController@gibAgbAus");
Route::get("/datenschutz", "FooterMenuController@gibDatenschutzAus");


// 7 Methoden muessen mit routes aktiviert 
// immer mit php artisan route:list die routes kontrollieren!

// für das testen von put/patch/delete muss die csrf-protection deaktiviert werden in app\Http\Middleware\VerifyCsrfToken.php
// und als Testtool, Postman oder eine Browser Extension z.B. rested genutzt werden!

/*
  GET|HEAD        meetings ..................................... meetings.index › MeetingController@index  
  POST            meetings ..................................... meetings.store › MeetingController@store  
  GET|HEAD        meetings/create ............................ meetings.create › MeetingController@create  
  GET|HEAD        meetings/{meeting} ............................. meetings.show › MeetingController@show  
  PUT|PATCH       meetings/{meeting} ......................... meetings.update › MeetingController@update  
  DELETE          meetings/{meeting} ....................... meetings.destroy › MeetingController@destroy  
  GET|HEAD        meetings/{meeting}/edit ........................ meetings.edit › MeetingController@edit 
*/
Route::resource("/meetings", "MeetingController"); // Anpasssung durch Positivliste

// alternative Einschränkungen der 7 definierten REST-Routen

//Route::resource("/meetings","MeetingController")->only("index","destroy"); // Anpasssung durch Positivliste
//Route::resource("/meetings","MeetingController")->except("index","destroy"); // Anpasssung durch Negativliste

// uebung_04
Route::get("/helloworld", "TestController@printMessage");

// uebung_05
// http://routinglaravel.test/name/Jens/nachname/Simon
Route::get('/name/{name}/nachname/{nachname}', 'TestController@showName');
Route::get('/users/{id}', 'TestController@showUsername')->name('username');

// uebung_06
// create, store, show und destroy
Route::resource('certificates', 'CertificateController')->except(['index', 'edit', 'update'])
    ->names(['create' => 'certifikates.certify']);

Route::get("/a/{a}/b/{b}", "TestController@ab");


Route::get("download_picture","PictureController@download");
Route::get("show_picture","PictureController@show");