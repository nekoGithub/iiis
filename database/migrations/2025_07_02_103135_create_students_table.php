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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('people_id')->constrained('peoples')->onDelete('cascade');

            $table->string('semester'); // Ej: "3er semestre", o puedes usar ENUM si está fijo
            $table->enum('status', ['activo', 'retirado', 'egresado'])->default('activo');

            $table->string('enrollment_number')->unique(); // Matrícula
            $table->string('guardian_name')->nullable(); // Responsable (padre, tutor)
            $table->string('guardian_phone')->nullable(); // Teléfono del tutor

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
