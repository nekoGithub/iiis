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
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('people_id')->constrained('peoples')->onDelete('cascade');
            $table->foreignId('card_id')->constrained('rfid_cards')->onDelete('cascade');
            $table->timestamp('fecha_acceso'); 
            $table->time('hora_entrada');
            $table->time('hora_salida')->nullable(); 
            $table->string('ubicacion'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accesses');
    }
};
