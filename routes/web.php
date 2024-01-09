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
Route::resource("/meetings", "MeetingController");


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
    } else if ($request->has(["question", "id"])) {
        // 4 soll ein kleiner individueller Text wiedergegeben werden. Dieser soll bestätigen, dass die Frage gespeichert wurde.
        // Der Statuscode soll 200 sein.
        return "Frage wurde gespeichert";
    }
});



Route::get("/impressum2", function () {

    return view("footermenue.impressum");
});

Route::get("/daten_ausgeben", function () {

    // Daten
    $daten = [
        [
            'id' => 1,
            'vorname' => "Jens",
            'nachname' => "Simon"
        ],
        [
            'id' => 2,
            'vorname' => "Anne",
            'nachname' => "Schmidt"
        ],
        [
            'id' => 3,
            'vorname' => "Tim",
            'nachname' => "Müller"
        ],
    ];


    return view("daten_ausgeben", compact("daten"));
});

// uebung_09 + uebung_10
Route::get("/names", "CertificateController@nameList");

// uebung_11
Route::get("/users", "CertificateController@showUser");

// teste seite 1 für blade inheritance / nutzung einer vorlage
Route::get("/seite_1", function () {
    return view('seite1_aus_vorlage');
});

Route::get("/seite_2", function () {
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
    return view('seite2_aus_vorlage', compact('users'));
});

// PDO einheitliche Schnittstelle für DBMS (MySql,...)
// klassisches PHP für PDO, Laravel bebötigt das nicht!
//$db = new PDO('mysql:host=localhost;dbname=routinglaravel;port=3306');
//$db2 = new PDO('mysql:host=localhost;dbname=te_db_fuer_laravel;port=3306');

use Illuminate\Support\Facades\DB;

Route::get("/raw_sql_insert", function () {

    // RAW SQL-Befehl
    // CRUD muss möglich sein
    // DML-SQL

    // Create
    echo "<br>Benutzer mit id 1 eintragen<br>";
    DB::insert('INSERT INTO benutzer (bezeichnung,created_at,updated_at) 
                VALUES (?,?,?)', ["Die Anne", "2024-01-02", "2024-01-02"]);

    // Read
    echo "<br>";
    $benutzer = DB::select('SELECT * FROM benutzer');
    foreach ($benutzer as $data) {
        echo $data->id, " ", $data->bezeichnung, " ", $data->created_at, " ", $data->updated_at . "<br>";
    }

    echo "<br>Benutzer mit id 2 eintragen<br>";
    DB::insert('INSERT INTO benutzer (bezeichnung,created_at,updated_at) 
                VALUES (?,?,?)', ["Der Jens", "2024-01-02", "2024-01-02"]);

    // Read
    echo "<br>";
    $benutzer = DB::select('SELECT * FROM benutzer');
    foreach ($benutzer as $data) {
        echo $data->id, " ", $data->bezeichnung, " ", $data->created_at, " ", $data->updated_at . "<br>";
    }

    // Delete
    echo "<br>Benutzer mit id 2 wieder löschen<br>";
    DB::delete('DELETE FROM benutzer WHERE id = ?', [2]);

    // Read
    echo "<br>";
    $benutzer = DB::select('SELECT * FROM benutzer');
    foreach ($benutzer as $data) {
        echo $data->id, " ", $data->bezeichnung, " ", $data->created_at, " ", $data->updated_at . "<br>";
    }

    // Update
    echo "<br>Benutzer mit id 1 bezeichnung ändern<br>";
    DB::update('UPDATE benutzer SET bezeichnung = "Der Niclas" WHERE id = ?', [1]);

    // Read
    echo "<br>";
    $benutzer = DB::select('SELECT * FROM benutzer');
    foreach ($benutzer as $data) {
        echo $data->id, " ", $data->bezeichnung, " ", $data->created_at, " ", $data->updated_at . "<br>";
    }



    // DDL
    echo "<br>geburtstag Feld hinzufügen<br>";
    DB::statement('ALTER TABLE benutzer ADD geburtstag DATE');
});



/* 
	uebung_17
	
	URL:
	http://routinglaravel.test/interests
	
	http://routinglaravel.test/interests/create/1/Programmieren
	http://routinglaravel.test/interests/create/2/Chillen
	
	http://routinglaravel.test/delete/2
*/

Route::get('interests', 'InterestController@index');
Route::get('interests/create/{id}/{text}', 'InterestController@create');
Route::get('interests/delete/{id}', 'InterestController@delete');










/*
Übung 17: Interessen, Datenbank und Controller

    OK - Erstelle einen Controller, um unsere Tabelle interests mit Daten zu befüllen.
    Erstelle eine Action, die mit einer Abfrage alle Interessen wiedergibt.
    Erstelle eine Action samt Raw SQL Query, mit der sich Interessen anhand der Route-Parameter erstellen lassen.
    Erstelle eine Action samt Raw SQL Query, um einzelne Interessen zu löschen.
    Registriere die drei Actions in Routes.
*/
Route::get("/zeigeAlles", "InterestController@zeigeAlleInteressen");
Route::get("/erstelleInteresse/{interesse}", "InterestController@erstelleInteresse");
Route::get("/loescheInteresse/{id}", "InterestController@loescheInteresse");


















Route::get("uebung_18", function () {



    $interestdata = [
        [
            'id' => 1,
            'text' => 'Coding',
        ],
        [
            'id' => 2,
            'text' => 'Kochen',
        ],
        [
            'id' => 3,
            'text' => 'Singen',
        ],
        [
            'id' => 4,
            'text' => 'Fußball',
        ],
    ];

    foreach ($interestdata as $interest) {
        $interest = (object) $interest;
        DB::table('interests')->insert(
            ['text' => $interest->text, 'id' => $interest->id]
        );
    }

    $postdata = [
        [
            'id' => 1,
            'title' => 'Montag',
            'text' => 'Montag ist schön zum Fußball spielen',
            'interest_id' => 4,
        ],
        [
            'id' => 2,
            'title' => 'jeder Tag',
            'text' => null,
            'interest_id' => 1,
        ],
        [
            'id' => 3,
            'title' => 'Dienstag',
            'text' => 'Dienstag koche ich.',
            'interest_id' => 2,
        ],
        [
            'id' => 4,
            'title' => 'Mittwoch',
            'text' => 'Mittwoch singe ich',
            'interest_id' => 3,
        ],
        [
            'id' => 5,
            'title' => 'Mittwoch',
            'text' => 'Mittwoch ist schlechtes Wetter',
            'interest_id' => null,
        ],
        [
            'id' => 6,
            'title' => 'Donnerstag',
            'text' => 'Donnerstag lerne ich den Query Builder',
            'interest_id' => 1,
        ],
        [
            'id' => 7,
            'title' => 'Essen',
            'text' => 'Ich bin hungrig.',
            'interest_id' => null,
        ],
        [
            'id' => 8,
            'title' => 'Freitag',
            'text' => null,
            'interest_id' => 1,
        ],
        [
            'id' => 9,
            'title' => 'Samstag',
            'text' => 'Samstag koche ich.',
            'interest_id' => 2,
        ],
        [
            'id' => 10,
            'title' => 'Fußball',
            'text' => null,
            'interest_id' => 4,
        ],
        [
            'id' => 11,
            'title' => 'Coding',
            'text' => 'Laravel macht Spaß',
            'interest_id' => null,
        ],
    ];

    foreach ($postdata as $post) {
        $post = (object) $post;

        DB::table('posts')->insert(
            [
                'id' => $post->id,
                'title' => $post->title,
                'text' => $post->text,
                'interest_id' => $post->interest_id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        );
    }
});

Route::get("/kapitel15", function () {

    // 15.1 Debugging
    // $wert=DB::table('interests');
    // dump($wert);

    // dump(DB::table('interests')->toSql());

    //DB::enableQueryLog(); // Enable query log


    // 15.2 INSERT INTO über Query-Builder
    // DB::table('interests')->insert(['text'=>'LARAVEL','id'=>7]);
    // INSERT INTO interests (id,text) VALUES ('6','PHP');

    // multiple insert mit einem Methodenaufruf
    // DB::table('interests')->insert(
    //     [
    //         ['text' => 'coding'],
    //         ['text' => 'sport'],
    //     ]
    // );
    // // mit einem SQL - Befehle ????
    // INSERT INTO interests (text) VALUES ("coding"), ("php"), ("sport")



    // 15.4 Daten ansehen - SELECT über Query-Builder
    $interestsSql = DB::table('interests');
    $interests = $interestsSql->get(); // fetchAll() Rückgabedatentyp? object/array nummerisch und assoziativ gemischt
    dump($interests); // Datentyp? Illuminate\Support\Collection

    $interests =   DB::table('interests')->get(); // Chaining - aneinanderketten von Methoden
    // PHP
    echo $interests[4]->text; // der 5.te array inhalt und von dem das attribut text

    foreach ($interests as $interest) {
        // echo $interest->id . " " . $interest->text . "<br>";
    }

    //dump(DB::getQueryLog()); // Show results of log

    // 15.4 Daten ansehen
    // first() anstelle von get() , LIMIT 1
    $interest =   DB::table('interests')->first(); // object
    dump($interest);
    echo $interest->text;

    // $interest =   DB::table('interests')->first(['text','id']); // object
    // dump($interest);
    // echo $interest->text;

    // find()
    $interest =   DB::table('interests')->find(2); //(( id=2 suchen!))
    dump($interest);


    // value()
    echo "<br>value()";
    $interest =   DB::table('interests')->value('text');
    // select `text` from `interests` limit 1

    dump($interest); // String

    // pluck()
    echo "<br>value()";
    $interest =   DB::table('interests')->pluck('text');
    // select `text` from `interests` 

    dump($interest); // array


    // select()
    echo "<br>select()";
    $interest =   DB::table('interests')->select(['text AS txt', 'id', 'text'])->get();
    dump($interest); // array
    $interest =   DB::table('interests')
        ->select('text AS txt')
        ->addSelect("id")
        ->addSelect("text")
        ->get();
    // select `text` from `interests` 

    dump($interest); // array


    //  // where()
    $interest =   DB::table('interests')
        ->where("id", "<", "4")
        ->where("id", ">", "2")
        ->select('text AS txt')
        ->addSelect("id")
        ->addSelect("text")
        ->get();
    // select `text` from `interests` 

    dump($interest); // array


    $alles = DB::table('interests')
        ->select(["interests.text as itext", "interests.*", "posts.*"])
        ->join('posts', 'interests.id', '=', 'posts.interest_id')
        ->get();
    dump($alles);
    return "<br>OK";
});


Route::get("kap15_teste_posts_interests_query_builder_methoden", function () {

    echo "Übungen bis 18 muessen vorher gemacht worden sein, post und interest Tabelle müssen vorhanden und befüllt sein!";

    // 15.1 Debugging
    //  globaler Listener für SQL-Queries mit Dump-Ouput bei Bedarf aktivieren
    DB::listen(function ($sql) {
        dump("Automatischer Dump über den listener:");
        dump($sql);
    });

    echo "<br>Das Object des QueryBuilders<br>";
    $wert = DB::table('interests'); // es wird noch kein SQL Statement ausgeführt 
    dump($wert);

    dump(DB::table('interests')->toSql());

    DB::enableQueryLog(); // Enable query log



    // 15.2 Insert
    echo "<br>15.2 und 15.3 insert() - Methode mit und ohne Query-Chaining<br>";

    DB::table('interests')->insert(
        ['text' => 'test1 ohne chaining']
    );
    dump(DB::getQueryLog()); // Show results of log


    $interests = DB::table('interests');
    $interests->insert(
        ['text' => 'test2 mit chaining']
    );
    echo "<br>Ergebnis in der interest Tabelle<br>";
    dump(DB::table('interests')->get());

    // 15.4 Daten abrufen
    echo "<br>15.4 get() - Methode<br>";
    dump(DB::table('interests')->get());
    $interests = DB::table('interests')->get();
    dump($interests);
    dump($interests[1]);

    echo "<br>15.4 first() - Methode<br>";
    dump(DB::table('interests')->first());

    echo "<br>15.4 find(1) - Methode , Datensatz mit id 1 suchen<br>";
    dump(DB::table('interests')->find(1)); // sucht Datensatz mmit der id = 1

    echo "<br>15.4 value() - Methode für Spalte 'text' <br>";
    dump(DB::table('interests')->value("text")); // ohne where wird der 1.Datensatz gewählt, und nur dessen Feld 'text'

    echo "<br>15.4 pluck() - Methode für Spalte 'text'<br>";
    dump(DB::table('interests')->pluck("text")); // alle Datensätze gewählt, und nur dessen Feld 'text', also eine Spalte

    // 15.5 Select — Daten auswählen
    echo "<br>15.5 Select — Daten auswählen text und created_at mit select() und die id noch mit addSelect()<br>";
    //$query     = DB::table('interests')->select('text', 'created_at');
    $query     = DB::table('interests')->select(['text as a', 'created_at']); // mit alias Umbennung
    $interests = $query->addSelect('id')->get();
    dump($interests);

    // 15.6 where-Abfragen — Bedingungen festlegen
    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier whereId(1) <br>";
    $interests = DB::table('interests')->whereId(1)->get();
    dump($interests);
    //erhalte alle Interessen, wo die ID gleich 1 ist.     

    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier id=1 <br>";
    $interests = DB::table('interests')->where('id', 1)->get();
    dump($interests);
    //erhalte alle Interessen, wo die ID gleich 1 ist.  

    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier id<3 <br>";
    $interests = DB::table('interests')->where('id', "<", 3)->get();
    dump($interests);

    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier between 2 and 5<br>";
    $interests = DB::table('interests')->whereBetween('id', [2, 5])->get();
    dump($interests);


    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier whereIn('id',[1,2,4,7])<br>";
    $interests = DB::table('interests')->whereIn('id', [1, 2, 4, 7])->get();
    dump($interests);

    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier whereNotNull('text')<br>";
    $interests = DB::table('interests')->whereNotNull('text')->get();
    dump($interests);

    echo "<br>15.6.2 where-Closures<br>";
    $id   = 6;
    $date = \Carbon\Carbon::now();

    $interests = DB::table('interests')
        ->where('text', '=', 'test2 mit chaining')
        ->where(function ($query) use ($id, $date) {
            $query->where('id', '=', $id);
            $query->whereNULL('created_at'); //, '=', $date); // besser ;-)
        })
        ->get();
    dump($interests);

    echo "<br>15.7 when - Abfragen, when z.B. kein Sortierparameter gegeben ist, wird dieses erkannt und dann unsortiert ausgegeben<br>";
    $sortBy = null;

    $interests = DB::table('interests')
        ->when($sortBy, function ($query, $sortBy) {
            return $query->select($sortBy);
        }, function ($query) {
            return $query->select('text');
        })
        ->get();
    dump($interests);

    echo "<br>15.8 Inhalte aktualisieren — Update<br>";
    $interests = DB::table('interests')
        ->where('id', 1)
        ->update(['text' => "neues Hobby"]);
    dump(DB::table('interests')->get());


    echo "<br>15.8 Inhalte aktualisieren — updateOrInsert<br>";
    $interests = DB::table('interests')
        ->where('id', 99)
        ->updateOrInsert(['text' => "insert99"]); // wird angelegt, mit autoid
    dump(DB::table('interests')->get());

    echo "<br>15.9 Inhalte löschen - Delete<br>";
    DB::table('interests')->where('id', 1)->delete();
    dump(DB::table('interests')->get());

    echo "<br>15.10 Datenbankwerte sortiert ausgeben mit orderBy() <br>";
    $interests = DB::table('interests')
        ->orderBy('id', 'desc') // von hoch nach tief
        ->get();
    dump($interests);

    echo "<br>15.11 Chuncking - Stückelung hier 5 Stück<br>";
    $posts = DB::table('posts')->orderBy('id')->chunk(5, function ($posts) {
        foreach ($posts as $post) {
            //tu irgendwas mit den posts z.B. löschen oder bearbeiten
            dump($post);
            //aktion bis zur id 13 durchführen und dann das chunking abbrechen
            if ($post->id === 13) {
                return false;
            }
        }
    });
    dump($posts);

    echo "<br>15.12 Aggregatfunktionen<br>";
    $post_count = DB::table('posts')->count();
    dump($post_count);

    $highest_id = DB::table('posts')->max('id');
    dump($highest_id);

    $average_id = DB::table('posts')->avg('id');
    dump($average_id);

    echo "<br>15.13 Joins<br>";
    $alles = DB::table('posts')

        ->join('interests', 'interests.id', '=', 'posts.interest_id')
        ->get();

    dump($alles);

    echo "<br>15.14 Unions<br>";
    $first = DB::table('interests')->where('id', '<=', 4);

    $second = DB::table('interests')
        ->where('id', '>', 4)
        ->union($first);

    dump($first->get());
    dump($second->get());

    echo "<br>15.15 Raw Expressions<br>";
    $interests = DB::table('interests')
        ->select(DB::raw('count(*) as interest_count'))
        ->get();
    dump($interests); // Anzahl der Datensätze in interests-Tabelle

    echo "<br>ENDE<br>";
    return "";
});


Route::get("kap15_teste_posts_interests_query_builder_methoden", function () {

    echo "Übungen bis 18 muessen vorher gemacht worden sein, post und interest Tabelle müssen vorhanden und befüllt sein!";

    // 15.1 Debugging
    //  globaler Listener für SQL-Queries mit Dump-Ouput bei Bedarf aktivieren
    DB::listen(function ($sql) {
        dump("Automatischer Dump über den listener:");
        dump($sql);
    });

    echo "<br>Das Object des QueryBuilders<br>";
    $wert = DB::table('interests'); // es wird noch kein SQL Statement ausgeführt 
    dump($wert);

    dump(DB::table('interests')->toSql());

    DB::enableQueryLog(); // Enable query log



    // 15.2 Insert
    echo "<br>15.2 und 15.3 insert() - Methode mit und ohne Query-Chaining<br>";

    DB::table('interests')->insert(
        ['text' => 'test1 ohne chaining']
    );
    dump(DB::getQueryLog()); // Show results of log


    $interests = DB::table('interests');
    $interests->insert(
        ['text' => 'test2 mit chaining']
    );
    echo "<br>Ergebnis in der interest Tabelle<br>";
    dump(DB::table('interests')->get());

    // 15.4 Daten abrufen
    echo "<br>15.4 get() - Methode<br>";
    dump(DB::table('interests')->get());
    $interests = DB::table('interests')->get();
    dump($interests);
    dump($interests[1]);

    echo "<br>15.4 first() - Methode<br>";
    dump(DB::table('interests')->first());

    echo "<br>15.4 find(1) - Methode , Datensatz mit id 1 suchen<br>";
    dump(DB::table('interests')->find(1)); // sucht Datensatz mmit der id = 1

    echo "<br>15.4 value() - Methode für Spalte 'text' <br>";
    dump(DB::table('interests')->value("text")); // ohne where wird der 1.Datensatz gewählt, und nur dessen Feld 'text'

    echo "<br>15.4 pluck() - Methode für Spalte 'text'<br>";
    dump(DB::table('interests')->pluck("text")); // alle Datensätze gewählt, und nur dessen Feld 'text', also eine Spalte

    // 15.5 Select — Daten auswählen
    echo "<br>15.5 Select — Daten auswählen text und created_at mit select() und die id noch mit addSelect()<br>";
    //$query     = DB::table('interests')->select('text', 'created_at');
    $query     = DB::table('interests')->select(['text as a', 'created_at']); // mit alias Umbennung
    $interests = $query->addSelect('id')->get();
    dump($interests);

    // 15.6 where-Abfragen — Bedingungen festlegen
    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier whereId(1) <br>";
    $interests = DB::table('interests')->whereId(1)->get();
    dump($interests);
    //erhalte alle Interessen, wo die ID gleich 1 ist.     

    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier id=1 <br>";
    $interests = DB::table('interests')->where('id', 1)->get();
    dump($interests);
    //erhalte alle Interessen, wo die ID gleich 1 ist.  

    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier id<3 <br>";
    $interests = DB::table('interests')->where('id', "<", 3)->get();
    dump($interests);

    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier between 2 and 5<br>";
    $interests = DB::table('interests')->whereBetween('id', [2, 5])->get();
    dump($interests);


    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier whereIn('id',[1,2,4,7])<br>";
    $interests = DB::table('interests')->whereIn('id', [1, 2, 4, 7])->get();
    dump($interests);

    echo "<br>15.6 where-Abfragen — Bedingungen festlegen, hier whereNotNull('text')<br>";
    $interests = DB::table('interests')->whereNotNull('text')->get();
    dump($interests);

    echo "<br>15.6.2 where-Closures<br>";
    $id   = 6;
    $date = \Carbon\Carbon::now();

    $interests = DB::table('interests')
        ->where('text', '=', 'test2 mit chaining')
        ->where(function ($query) use ($id, $date) {
            $query->where('id', '=', $id);
            $query->whereNULL('created_at'); //, '=', $date); // besser ;-)
        })
        ->get();
    dump($interests);

    echo "<br>15.7 when - Abfragen, when z.B. kein Sortierparameter gegeben ist, wird dieses erkannt und dann unsortiert ausgegeben<br>";
    $sortBy = null;

    $interests = DB::table('interests')
        ->when($sortBy, function ($query, $sortBy) {
            return $query->select($sortBy);
        }, function ($query) {
            return $query->select('text');
        })
        ->get();
    dump($interests);

    echo "<br>15.8 Inhalte aktualisieren — Update<br>";
    $interests = DB::table('interests')
        ->where('id', 1)
        ->update(['text' => "neues Hobby"]);
    dump(DB::table('interests')->get());


    echo "<br>15.8 Inhalte aktualisieren — updateOrInsert<br>";
    $interests = DB::table('interests')
        ->where('id', 99)
        ->updateOrInsert(['text' => "insert99"]); // wird angelegt, mit autoid
    dump(DB::table('interests')->get());

    echo "<br>15.9 Inhalte löschen - Delete<br>";
    DB::table('interests')->where('id', 1)->delete();
    dump(DB::table('interests')->get());

    echo "<br>15.10 Datenbankwerte sortiert ausgeben mit orderBy() <br>";
    $interests = DB::table('interests')
        ->orderBy('id', 'desc') // von hoch nach tief
        ->get();
    dump($interests);

    echo "<br>15.11 Chuncking - Stückelung hier 5 Stück<br>";
    $posts = DB::table('posts')->orderBy('id')->chunk(5, function ($posts) {
        foreach ($posts as $post) {
            //tu irgendwas mit den posts z.B. löschen oder bearbeiten
            dump($post);
            //aktion bis zur id 13 durchführen und dann das chunking abbrechen
            if ($post->id === 13) {
                return false;
            }
        }
    });
    dump($posts);

    echo "<br>15.12 Aggregatfunktionen<br>";
    $post_count = DB::table('posts')->count();
    dump($post_count);

    $highest_id = DB::table('posts')->max('id');
    dump($highest_id);

    $average_id = DB::table('posts')->avg('id');
    dump($average_id);

    echo "<br>15.13 Joins<br>";
    $alles = DB::table('posts')

        ->join('interests', 'interests.id', '=', 'posts.interest_id')
        ->get();

    dump($alles);

    echo "<br>15.14 Unions<br>";
    $first = DB::table('interests')->where('id', '<=', 4);

    $second = DB::table('interests')
        ->where('id', '>', 4)
        ->union($first);

    dump($first->get());
    dump($second->get());

    echo "<br>15.15 Raw Expressions<br>";
    $interests = DB::table('interests')
        ->select(DB::raw('count(*) as interest_count'))
        ->get();
    dump($interests); // Anzahl der Datensätze in interests-Tabelle

    echo "<br>ENDE<br>";
    return "";
});


/* 
	uebung_19
	
	Verschiedenen Unteraufgaben durchführen:

	nicht im InterestController das ist unschön ;-)
*/
Route::get('uebung_19', function () {

    //Aufgabe 1
    $posts = DB::table('posts');
    dump($posts);

    //Aufgabe 2
    // $count_posts = $posts->count();
    // dump($count_posts);

    //Aufgabe 3

    // RAW-Query-Insert
    //DB::insert('insert into posts (title, text) value (?,?)', ['uebungsaufgabe', 'das ist schoen']);
    // QB-Insert
    // $title='mit QB-Insert eingefügt';
    // $postsGegenDoppleteTitle=$posts->where("title","=",$title)->get(); // Array

    // $anzahlDoppelte=count($postsGegenDoppleteTitle); // Zähle Array Inhalte

    // if ($anzahlDoppelte===0) {
    //     $posts->insert(['title'=>$title,'text'=>'hoffentlch funktioniert das!']);  
    // }


    //Aufgabe 4
    // Aktualisiere den Text eines Posts, dessen »id« zwischen 6 und 10 ist 
    // und keine »interest_id« hat, auf "neuer Text".
    /*	$update = $posts->whereBetween('id', [6, 10])
                    ->whereNull('interest_id')
                    ->update(['text' => 'neuer Text']);*/

    // update `posts` set `text` = 'neuer Text' where `id` between 6 and 10 and `interest_id` is null

    // update `posts` set `text` = 'neuer Text' where `id` >= '6' and `id` <= '10' and `interest_id` is null

    /*  $update = $posts->where('id',">=", '6')
    ->where('id',"<=", '10')
    ->where('interest_id',"=", null)
    ->update(['text' => 'neuer Text']);

    var_dump($update);
*/

    //Aufgabe 5
    // Gib für den Post mit der »id« 1 das Erstelldatum aus.
    /*$created = $posts->whereId(1)->value('created_at'); // einzelwert als string
    dump($created);

    $created = $posts->where("id","=",1)->select('created_at')->get(); // eine array von objekten ,ein objekt
	dump($created); 
*/


    //Aufgabe 6
    //$order_posts = $posts->whereNotNull(['text', 'interest_id'])->orderBy('id', 'desc')->get();
    //dump($order_posts);


    //Aufgabe 7
    $deleted = $posts->whereNull('text')->orWhereNull('interest_id')->delete();
    dump($deleted);
});

// der Ordner Models aus dem Ordner app wurde gelöscht
// vorher wurde die User.php in den app Ordner verschoben
use App\Post;

Route::get("/teste_modell", function (Request $request) {

        // CRUD
    ;
    // Eloquent Alternative 1
    // Create / INSERT INTO
    $post = new Post; // der sucht nach der table "posts"
    $post->title = "Post hat mich erstellt";
    $post->text = "Dies ist ein Post mit dem Post-Model erstellt";

    $post->save();

    // Eloquent Alternative 2
    // Create / INSERT INTO

    // Mass Assigment - Massenzuweisung
    // Add [title] to fillable property to allow mass assignment on [App\Post]
    //$datenAusEinemFormular=;
    Post::create($request->all());
    /* [
        'title'=>'über create erzeugt',
        'text'=>'na geht das?'
       ]*/
    /*

    // Read
    $posts = Post::all();
    dump($posts);
    foreach ($posts as $post) {
        echo $post->id, " ", $post->title, " ", $post->text, "<br>";
    }

    // U
    $post = Post::find(18);
    if ($post != null) {
        $post->title = "Post1 hat mich erstellt";
        $post->text = "Dies ist ein Post mit dem Post-Model erstellt";

        $post->save();
    }
    $posts = Post::all();
    foreach ($posts as $post) {
        echo $post->id, " ", $post->title, " ", $post->text, "<br>";
    }
*/
    // D
    $post = Post::find(1);
    if ($post != null)
        $post->delete(); // je nachdem ob softdelete aktiviert ist wird gelöscht oder der deleted_at timestamp auf den akteullen Zeitstempel
    echo "<br><br>";
    $posts = Post::zeigeNurFuenf()->get(); // all reagiert auf evtuelles softdelet, es nur datebsätze geziegt, die delete_at auf NULL
    foreach ($posts as $post) {
        echo $post->id, " ", $post->title, " ", $post->text, "<br>";
    }
    echo "<br><br>";
    $posts = Post::onlyTrashed()->get(); // all reagiert auf evtuelles softdelet, es nur datebsätze geziegt, die delete_at auf NULL
    foreach ($posts as $post) {
        echo $post->id, " ", $post->title, " ", $post->text, "<br>";
    }
});


Route::get("eloquent_one_to_many_beziehung", function () {

    echo "<h3>1:n Beziehung zwischen posts und interests</h3>";

    echo "<br>Lösung mit Join RAW oder per QueryBuilder<br>";

    $alles = DB::table('interests')
        ->select(["interests.text AS itext", "interests.*", "posts.*"])
        ->join('posts', 'interests.id', '=', 'posts.interest_id')
        ->orderBy("posts.id", "asc")
        ->get();
    dump($alles);
    foreach ($alles as $datensatz) {
        echo $datensatz->id, " - ", $datensatz->title, " - ", $datensatz->text, "  -> ", $datensatz->itext, "<br>";
    }



    echo "<br>Lösung mit Eloquent<br>";

    //$posts = Post::with('interest')->get(); // mit eager loading
    $posts = Post::get(); // ohne eager loading, lazy loading
    dump($posts);

    foreach ($posts as $post) {
        echo $post->id . " - ";
        echo $post->title . " - ";
        echo $post->text . " -> ";
        echo $post->interest->text; // magic
        echo "<br>";
    }
});



/*
	uebung_21
	
	URLs zum Eintragen der Datensätze:

	http://routinglaravel.test/interest/create/Programmieren
	http://routinglaravel.test/interest/create/Lesen
	http://routinglaravel.test/interest/create/Politik
	http://routinglaravel.test/interest/create/Sport
	http://routinglaravel.test/interest/create/Gaming

	http://routinglaravel.test/article/create/LaravelCRUD/CreateReadUpdateDelete/1
	http://routinglaravel.test/article/create/Politik/Umwelt ist toll Wirtschaft aber auch/3
	http://routinglaravel.test/article/create/Formel1/Autorennen macht viel Spa? beim Zusehen/4

	URLs zum Ansehen der Datensätze:

	http://routinglaravel.test/articles
	http://routinglaravel.test/interests

	
	
*/

use App\Interest;
use App\Article;

// Artikel erstellen
Route::get('article/create/{title}/{text}/{interest_id}/', function ($title, $text, $interest_id) {

    $article = new Article;

    $article->title = $title;
    $article->text = $text;
    $article->interest_id = $interest_id;

    $article->save();
});

// Interessen erstellen
Route::get('interest/create/{text}', function ($text) {
    $interest = new Interest;

    $interest->text = $text;

    $interest->save();
});

// Artikel anzeigen
Route::get('articles', function () {
    $articles = Article::all();

    dump($articles[10]->title);
    dump($articles);
});





// Interessen anzeigen
Route::get('interests', function () {

    /* // suchen , finden und loeschen (dauerhaft!!!/ richtiges DELETE FROM ....)
     $interest = Interest::whereId(4)->first();
     $interest->delete(); // softdelete!
     dump($interest);
     */
    $interests = Interest::all();
    dump($interests);


    /*
    // suchen nach ID
    $interests = Interest::findOrFail(1); // wird gefunden!
    //$interests = Interest::findOrFail(3443543); // wird nicht gefunden! 404
    var_dump($interests);
    */

    /*
    // suchen nach exaktem Text 
    $interests = Interest::whereText("Politik")->get(); // wird gefunden!
    // oder nur erstes, wenn mehrere!
    //$interests = Interest::whereText("Politik")->first();
    var_dump($interests);
    */

    /*
    // suchen , finden und Text aendern
    $interest = Interest::whereText("Politik")->first(); // geht nur einmal!! dann Fehler!
    $interest->text="Chillen";
    $interest->save();
    var_dump($interest);
    */

    /*
    // suchen , finden und loeschen (dauerhaft!!!/ richtiges DELETE FROM ....)
    $interest = Interest::whereId(3)->first();
    $interest->delete();
    var_dump($interest);
    */
});
Route::get('interest/delete/{id}', function ($id) {
    $interest = Interest::whereId($id)->first();
    $interest->delete();
    var_dump($interest);
});

// http://routinglaravel.test/interests/with_trashed

Route::get('interests/with_trashed', function () {
    $interests_trashed = Interest::withTrashed()->get();
    dump($interests_trashed);
});

// http://routinglaravel.test/interests/with_trashed

Route::get('interests/only_trashed', function () {
    $interests_trashed = Interest::onlyTrashed()->get();
    dump($interests_trashed);
});

Route::get('article/create_ma/{title}/{text}', function ($title, $text) {

    //Post::create( ['title' => 'Test', 'text' => 'text']);
    Article::create(['title' => $title, 'text' => $text]);
});


Route::get('subquery', function () {

    $articles = Article::addSelect(['interest' => Interest::select('text')->whereColumn('id', 'interest_id')->limit(1)])->get();  
	dd($articles);
});


Route::get("collection_filtern", function () {

    // array erstellen 
    $array = [];
    for ($i = 0; $i < 10000; $i++) {
        $array[] = random_int(1, 100);
    }

    $collection = collect($array);

    dump($collection);

    $collection = $collection->filter(function ($value, $key) {
        return $key % 5 == 0;
    });
    dump($collection);
});


Route::get("/collection_datenbankanbfrage", function () {

    // 1. SQL Datenbank Verarbeitungszeit und Geld
    $articles = \App\Article::select(["id", "title"])->where("id", ">", 1)->get(); //es wird eine Datenbankanfrage ausgeführt
    dump($articles);

    // optische Ausgabe
    foreach ($articles as $article) {
        echo $article->id, " - ", $article->title . "<br>";
    }
    echo "<br>Output der iterierenden filter()-Methode<br>";

    // Nachverarbeitung
    // 2. PHP Interpreter Verarbeitungzeit und Abrechnung
    $articles = $articles->filter(function ($value, $key) { // filter iteriert über alle Elemente
        echo $key . " - " . $value . "-" . $value->title . " --- ";

        if ($value->title === "neuer artikel") {
            echo "gefunden!<br>";
            return 0;
        } else {
            echo "nicht gefunden!<br>";
            return 1;
        }
        // return 1;
    }); //keine Datenbankanfrage
    dump($articles);

    // optische Ausgabe
    // foreach($articles as $article)
    // {
    //     echo $article->id," - " ,$article->title."<br>";
    // }
    return "Und?";
});


Route::get("collection_test", function () {
    $vornamen = ['Jens', "Tim", "Anne"]; // Array
    dump($vornamen);

    $vornamen = collect($vornamen); // Object / Collection
    dump($vornamen);

});

// uebung_22

// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\DB;
use App\Page;
// use App\Post;
use App\Tag;


Route::get('test_m_n', function () {

	$article = Article::create(
		[
			'title' => 'Bilderrahmen',
			'text' => ' Dies ist ein schöner Bilderrahmen'
		],
	);

	$interest = Interest::create(
		[
			'text' => 'Malen',
		],
	);

	$article->interests()->attach($interest); // Beziehung in der pivot-Tavelle herstellen
	//$article->interests()->detach($interest); // Beziehung in der pivot-Tavelle loeschen
	
	echo "<h2>Artikel 1 und alle Interessen</h2>";
	$article = Article::first();
	dump($article);
	foreach ($article->interests as $interest) {
		dump($interest);
	}

	// Tag
    	$article->tags()->create(['title' => 'geheim']);

	echo "<h2>Artikel 1 und alle Tags</h2>";
	
	//$article = Article::first(); // lazy loading
	$article = Article::with('tags')->first(); // eager loading
	
	dump($article);
	foreach ($article->tags as $tag) {
		dump($tag);
	}
});

Route::get('uebung_23', function () {
   
    // Das Array wird in eine Collection überführt
    $collect = collect([1,2,3,4,5,6,7,8,9]);
    dump($collect);
    
    // Die neue Ergbnis Collection wird in 2 Schritten gebildet:
    //
    // 1.Schritt: filter (where Bedingung)
    // hier: wähle alle Elemente deren Modulus 3 Wert 0 ist.
    //
    // das sind : 3,6 und 9
    //
    // 2.Schritt: neue Zuordnung der verbliebenen Elemente mit map (update mit einer Zuordnungslogik)
    // hier: ändere die verbliebenen Elemente mit *9
    //
    // das sind : 9,54 und 81
    //
    
    $ergebnis = $collect->filter( function ($item) {
            return $item % 3 === 0;
        }
    
    ) ->map(
    
    
        function ($item) {
            return $item * 9;
        }
    
    );
    
    dump($ergebnis);
    /*
    object(Illuminate\Support\Collection)#3710 (1) {
      ["items":protected]=>
      array(3) {
        [2]=>
        int(27)
        [5]=>
        int(54)
        [8]=>
        int(81)
      }
    }
    */
    
});

Route::get('uebung_24', function () {

    $collect = collect(['eloquent','laravel','laravel','collection','collection','model','migration','eloquent','collection','php','php','php']);
    
    dump($collect);
    
    $ergebnis = $collect->unique();//->map(function($item){ return strtoupper($item);}  ) ;  
    dump($ergebnis);
    
    // Das Ergebnis entsteht in 2 Schritten:
    //
    // 1.Schritt: entfernen der doppleten Einträge(unique)
    //
    // 'eloquent','laravel','collection','model','migration','php'
    //
    // 2.Schritt: neue Zuordnung der verbliebenen Elemente mit map (update mit einer Zuordnungslogik)
    // hier: ändere die verbliebenen Elemente mit strtoupper(), also GROSSBUCHSTABEN 
    //
    // das sind :
    
    /*
    Illuminate\Support\Collection {#4337
         all: [
           0 => "ELOQUENT",
           1 => "LARAVEL",
           3 => "COLLECTION",
           5 => "MODEL",
           6 => "MIGRATION",
           9 => "PHP",
         ],
       }
    */
});


// uebung_25 
// article Controller existiert jetzt alle routen erlauben!
Route::resource('article', 'ArticleController');

Route::get("zahlen_kollektion",function() {

    $zahlen = ['jens','tim']; //['one' => 1, 2,3,4,5,6,7,8,9];
    dump($zahlen);
    
    $zahlenKollektion=collect($zahlen);
    dump($zahlenKollektion);

    $zahlenKollektion=$zahlenKollektion->filter(function ($value, $key) {
        echo "value = ".$value." -  key = ".$key."<br>";   // schauen in den Schritt der Iteration
        
        if( $key!=="one") return true; // ja 
    });
    dump($zahlenKollektion);

    $zahlenKollektion=$zahlenKollektion->map(function ($value, $key) {
        echo "value = ".$value." -  key = ".$key."<br>";  
        return strtoupper($value);
    });
    dump($zahlenKollektion);

});
