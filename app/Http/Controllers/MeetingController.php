<?php

namespace App\Http\Controllers;
use \App\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // alle Meetings aus der Database anzeigen
        
        // einmalige Vorarbeiten:
        // Migrations-Datei mit artisan erstellen, gewünschte Tabellenfelder einfügen und migrieren
        // ein Model Meeting erstellen

        //  jetzt mit Eloquent alle Meeting Models einlesen (alle Datensätze)
              
        $meetings = Meeting::all();

        // View mit parent-layout einmalig vorbereiten und die index-blade bekommt inhalt
        return view("meetings.index",compact("meetings"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //echo "jau, hat geklappt! wir sind per Get hier hin gekommen , es ist /create";
        return view("meetings.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'ueberschrift' => 'required|max:100',
            'datum' => ['required', 'max:10'],
        ]);

        $formularWerte=$request->all();
        //dd($formularWerte);
        
        $meeting = new Meeting();
        $meeting->ueberschrift=$formularWerte['ueberschrift'];
        $meeting->datum=$formularWerte['datum'];
        $meeting->save();

        return view("meetings.store");
    }

   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        // Display the specified resource.
        $meeting=Meeting::find($id);
        
        return view("meetings.show",compact("meeting")); 
               
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
       $meeting = Meeting::find($id);
       return view("meetings.edit",compact("meeting"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        echo "$id soll geupdated werden<br>";
        echo "jau, hat geklappt! wir sind per Put hier hin gekommen";

        $formularWerte=$request->all();
        //dd($formularWerte);
        
        $meeting = Meeting::find($id);
        $meeting->ueberschrift=$formularWerte['ueberschrift'];
        $meeting->datum=$formularWerte['datum'];
        $meeting->save();

        return view("meetings.update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meeting=Meeting::find($id);
        $meeting->delete(); 
        
        return view("meetings.delete");       

    }
}
