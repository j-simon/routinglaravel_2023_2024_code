<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        echo "jau, hat geklappt! wir sind per Get hier hin gekommen";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        echo "jau, hat geklappt! wir sind per Get hier hin gekommen , es ist /create";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        echo "jau, hat geklappt! wir sind per Post hier hin gekommen";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        echo "hai, von show!, du hast $id übergeben<br>";
        // etwas sinnvolles gecodet
        
        // Display the specified resource.
        
        $db = new \PDO("mysql:host=localhost;dbname=test", "root", "root");
        $sqlBefehl = "SELECT * FROM  meetings WHERE id=".$id;
        echo $sqlBefehl."<br>";
        $stmt = $db->query($sqlBefehl);
        $datensaetze=$stmt->fetchAll();
        var_dump($datensaetze);

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        echo "hai, von edit!, du hast $id übergeben";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        echo "jau, hat geklappt! wir sind per Put hier hin gekommen";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        echo "jau, hat geklappt! wir sind per Delete hier hin gekommen";
    }
}
