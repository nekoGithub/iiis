<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'card_id',
        'fecha_acceso',
        'hora_entrada',
        'hora_salida',
        'ubicacion',
    ];

    // Relación: un acceso pertenece a una persona
    public function people()
    {
        return $this->belongsTo(People::class);
    }

    // Relación: un acceso pertenece a una tarjeta
    public function card()
    {
        return $this->belongsTo(RfidCard::class);
    }
}
