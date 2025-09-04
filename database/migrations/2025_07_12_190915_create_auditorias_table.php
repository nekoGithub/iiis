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
        Schema::create('auditorias', function (Blueprint $table) {
            $table->id();

            // Relación polimórfica con cualquier modelo
            $table->unsignedBigInteger('modelo_id');
            $table->string('modelo_tipo'); // Ejemplo: App\Models\User, App\Models\People

            // Usuario que realizó la acción
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();

            // Acción realizada: eliminado, creado, actualizado
            $table->string('accion');

            // Fecha de la acción
            $table->timestamp('fecha')->useCurrent();

            // Información del entorno
            $table->ipAddress('ip')->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditorias');
        Schema::dropIfExists('users');
    }
};
