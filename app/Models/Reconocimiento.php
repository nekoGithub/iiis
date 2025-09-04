<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reconocimiento extends Model
{
    use HasFactory;

     protected $table = 'reconocimientos';

    protected $connection = 'mysql2'; // conexión secundaria

    public $timestamps = false; // porque no hay campos created_at, updated_at

    protected $fillable = [
        'fecha_hora',
        'emocion',
        'probabilidad',
        'nombre_archivo',
        'imagen_path',
    ];
}
