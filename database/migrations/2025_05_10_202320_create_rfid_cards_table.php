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
        Schema::create('rfid_cards', function (Blueprint $table) {
            $table->id();

            $table->foreignId('people_id')->unique()->constrained('peoples')->onDelete('cascade');
            $table->string('codigo_rfid')->unique()->nullable();
            $table->timestamp('fecha_emision')->nullable();
            $table->enum('estado', ['Activa','Inactiva'])->default('Inactiva');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfid_cards');
    }
};
