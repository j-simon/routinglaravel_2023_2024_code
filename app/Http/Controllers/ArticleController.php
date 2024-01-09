<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // uebung_25
        return view('article');
    }

    /**
     * Store a newly created resource in storage.
     */

    
/*
    public function store(ArticleRequest $request)
    {
        // uebung_25
		\App\Article::create($request->all());
		
		return "success - alles OK!";
		
		
    }

*/
    
    public function store(Request $request)
	{
        // uebung_25
		
		// simple Variante, hier deaktiviert
		//  $request->validate(
		//  [
        //     'title' => 'required',
        //     'text' => 'required'

        // ]
		
		// ); 
		
		// komplexere Variante!
		// $request->validate([
		// 	'title' => [ 
		// 		'required',
		// 		function($attribute, $value, $fail) {
		// 			if (strpos($value,'Laravel') === false) {
		// 				$fail($attribute.' enthält nicht den Text Laravel');
		// 			}
		// 		}
		// 	],
		// 	'text' => 'required'
		// ]);	
		
        // mit Rule
        $request->validate([
			'title' => [ 	'required',new \App\Rules\CheckLaravelInText() ], //'Laravel'//	$fail($attribute.' enthält nicht den Text Laravel');
			'text' => 'required'
		]);	
		\App\Article::create($request->all());
		
		return "success - alles OK!";
		
		
    }
	

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
