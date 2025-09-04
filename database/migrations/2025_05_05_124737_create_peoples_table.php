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
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('ci')->unique();
            
            $table->enum('type',['administrativo','docente','estudiante'])->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthdate');

            $table->enum('gender',['masculino','femenino','otro'])->nullable();
            $table->string('photo')->nullable();
            
            $table->timestamp('registration_date');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peoples');
    }
};
