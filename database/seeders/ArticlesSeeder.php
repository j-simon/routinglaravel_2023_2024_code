<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // run Methode aktivieren - wodurch?
        // php artisan db:seed
        // echo "run()-Methode von ArticlesSeeder aktiviert";

        // etwas tun?

        // Article Database Datensatz
        // 1. RAW-SQL
        // DB::insert
        
        //DB::insert("INSERT INTO articles (id,title,text,likes,interest_id,created_at,updated_at) VALUES(1,'Fussball','schöner Fussball',0,NULL,NOW(),NOW())");
        // 2. new Article()
        // ->save()
/*
        DB::table('articles')->insert([
            'title' => Str::random(10),
            'text' => Str::random(15)
        ]);*/

        // Sinn des Seeder ist die Anzahl der zu erzeugenden Datensaätze festlegen
        // Die Inhalte eines Datensatzes werden werden über Factory gesteuert
         
         \App\Article::factory()->count(5)->create();
    }
}
