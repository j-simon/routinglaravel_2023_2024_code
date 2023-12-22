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
      return view("welcome"); // im ordner resources/views/welcome.blade.php
  });


Route::get("/seite2", function () { // seite2
    echo "hallo das 2. /seite"; //return view("seite2");
});


Route::get("/seite2", function () { // seite2
    echo "hallo das 2. /seite";
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

Route::get("/testroute7", "Test2Controller"); // invokable / nur eine Methode, die ohen speziellen Namen aufgerufen wird

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


Route::get("download_picture", "PictureController@download");
Route::get("show_picture", "PictureController@show");


/* 
	uebung_07
	
*/

use Symfony\Component\HttpFoundation\Response;


Route::get('question', function (Request $request) {

    if (!$request->filled('id')) { // keine id! url 1.

        return response('Ein Fehler ist aufgetreten, da keine id übergeben wurde', Response::HTTP_NOT_FOUND);
    } elseif ($request->filled(['id', 'question']) && $request->file === "true") { // id, questeion file=true url 2.

        $id = $request->id;
        $newname = $id . ".png";

        return response()->download('assets/image/Success.png', $newname);
    } elseif ($request->has('id') && !$request->filled('question')) { // id, keine question url 3.

        return redirect()->away('https://www.webmasters-fernakademie.de');
    } elseif ($request->filled(['id', 'question']) && $request->file !== "true") { // id,question, file=false url 4.

        return "Ihre Frage wurde erfolgreich gespeichert.";
    }
});


// Dependency Injection
Route::get("/request_test", function (Request $request) {
    // $vorname = "jens";
    // dump($vorname);

    $vornamen = ["Jens", "Tim", "Anne"];
    //dd($vornamen); // dump und die // dd
    echo "hier gehts weiter";
    //var_dump($vornamen);

    //dump($request);
});

// Loesung Aufbau 7


/*

    1 Wenn keine »id« vorhanden ist oder die »id« null ist, 
            soll eine Fehlermeldung mit einem HTTP-Statuscode 404 zurückgegeben werden.
    2 Wenn der Parameter »file« true ist, also nicht null oder false, 
            soll das Bild Success.png heruntergeladen werden. Der Name der Datei soll der Wert des »id«-Parameters + die Endung .png sein. Die Parameter »question« und »id« dürfen ebenfalls nicht null sein.
    3 Wenn die »question« nicht vorhanden ist, 
            soll auf die Seite der Akademie "https://www.webmasters-fernakademie.de/" weitergeleitet werden. Die »id« soll aber vorhanden sein.
    4 Wenn die »question« sowie die »id« vorhanden sind, 
            soll ein kleiner individueller Text wiedergegeben werden. Dieser soll bestätigen, dass die Frage gespeichert wurde. Der Statuscode soll 200 sein.



    anforderung 4 : http://routinglaravel.test/question?question=Warum%20ist%20die%20Erde%20rund?&id=3&file=false
    
    anforderung 1 : http://routinglaravel.test/question  ? question=Warum%20ist%20die%20Erde%20rund?
    
    anforderung 2 : http://routinglaravel.test/question  ? question=Warum%20ist%20die%20Erde%20rund?&id=3&file=true
    
    anforderung 3: http://routinglaravel.test/question ?  id=3&file=false
*/

Route::get("/question", function (Request $request) {
    echo "funktioniert!<br>";

    // 1 soll Fehlermeldung mit einem HTTP-Statuscode 404 zurückgegeben
    if (!$request->has('id')   || !$request->filled('id')) {
        return response('Hallo Welt', 404);
    } else if ($request->input("file") === "true" && filled(['id', 'questions'])) {
        // 2 soll das Bild Success.png heruntergeladen werden. 
        // Der Name der Datei soll der Wert des »id«-Parameters + die Endung .png sein.
        return response()->download("assets/image/Success.png", $request->id . ".png"); //   8779787.png
    } else if ($request->missing('question')) {
    // 3 soll auf die Seite der Akademie "https://www.webmasters-fernakademie.de/" weitergeleitet werden
        return redirect()->away('https://www.webmasters-fernakademie.de/');   
    } else if ($request->has(["question","id"])) {
    // 4 soll ein kleiner individueller Text wiedergegeben werden. Dieser soll bestätigen, dass die Frage gespeichert wurde.
    // Der Statuscode soll 200 sein.
        return "Frage wurde gespeichert";
    }
});



Route::get("/impressum2",function(){

    return view("footermenue.impressum");
});

Route::get("/daten_ausgeben",function(){

    // Daten
    $daten=[
        [
            'id'=> 1,
            'vorname' => "Jens",
            'nachname' => "Simon"
        ],
        [
            'id'=> 2,
            'vorname' => "Anne",
            'nachname' => "Schmidt"
        ],
        [
            'id'=> 3,
            'vorname' => "Tim",
            'nachname' => "Müller"
        ],
    ];
    

    return view("daten_ausgeben",compact("daten"));
});

// uebung_09 + uebung_10
Route::get("/names","CertificateController@nameList");

// uebung_11
Route::get("/users","CertificateController@showUser");

// teste seite 1 für blade inheritance / nutzung einer vorlage
Route::get("/seite_1",function(){
    return view('seite1_aus_vorlage');
});

Route::get("/seite_2",function(){
    $users = [
        [
        'name' => 'Cathy Gleichner',
        'email' => 'Cristobal_Volkman89@hotmail.com',
        'phone' => '1-102-339-0647 x06086',
        'age' => '14',
      ],
      [
        'name' => 'Rashad Bartoletti',
        'email' => 'Josephine70@gmail.com',
        'age' => '23',
      ],
      [
        'name' => 'Anabel Crooks',
        'email' => 'Lambert.Braun38@hotmail.com',
        'phone' => '1-455-074-9861 x97241',
        'age' => '56',
      ],
      [
        'name' => 'Ova Howe',
        'email' => 'Diego_Turner@yahoo.com',
        'age' => '4',
      ],
      [
        'name' => 'Loy Balistreri',
        'email' => 'Emily.Senger68@hotmail.com',
        'age' => '87',
      ],
      [
        'name' => 'Tamia Parisian',
        'email' => 'Arlie77@gmail.com',
        'phone' => '633.048.2602',
        'age' => '13',
      ],
      [
        'name' => 'Demario Boehm',
        'email' => 'Annie.MacGyver@yahoo.com',
        'phone' => '258.282.8669 x9776',
        'age' => '35',
      ],
      [
        'name' => 'Tianna Jacobi I',
        'email' => 'Elliot32@hotmail.com',
        'age' => '43',
      ],
      [
        'name' => 'Rosemary Heidenreich',
        'email' => 'Cornelius.King23@hotmail.com',
        'phone' => '638-129-2815 x184',
        'age' => '54',
      ],
      [
        'name' => 'Jonas Gaylord',
        'email' => 'Wilburn14@yahoo.com',
        'phone' => '(348) 253-3467 x129',
        'age' => '49',
      ],
      [
        'name' => 'Juanita Luettgen PhD',
        'email' => 'Kaelyn_Predovic@hotmail.com',
        'phone' => '(229) 085-6914',
        'age' => '27',
      ],
      
   
   
     
    ];
    return view('seite2_aus_vorlage',compact('users'));
});