<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    protected $table = 'auditorias';

    protected $fillable = [
        'modelo_id',
        'modelo_tipo',
        'usuario_id',
        'accion',
        'fecha',
        'ip',
        'user_agent',
    ];

     // Relación con el modelo auditado
    public function modelo()
    {
        return $this->morphTo(null, 'modelo_tipo', 'modelo_id');
    }

    // Relación con el usuario que hizo la acción
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
