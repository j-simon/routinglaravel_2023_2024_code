<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Aktivierung bei 
        // php artisan migrate
        // php artisan migrate:fresh
        echo "up-Methode wird aufgerufen";
        Schema::create('benutzer', function (Blueprint $table) {
            $table->id();
            // string(..,100) entspricht VARCHAR(100)
            $table->string("bezeichnung",100);// ->unique(); // UNIQUE macht das Feld eindeutig inhaltlich
            $table->decimal("kommazahl",8,6);
            $table->timestamps(); // created_at und updated_at Felder , TIMESTAMPS ohne Automatik Füllung
        });


        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Aktivierung bei 
        // php artisan rollback
        // php artisan migrate:fresh
        // php artisan migrate:reset
        echo "down-Methode wird aufgerufen";
        Schema::dropIfExists('benutzer');
    }
};
