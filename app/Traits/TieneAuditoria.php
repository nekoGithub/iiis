<?php

namespace App\Traits;

use App\Models\Auditoria;

trait TieneAuditoria
{
    public static function bootTieneAuditoria()
    {
        static::created(function ($modelo) {
            Auditoria::create([
                'modelo_id'   => $modelo->id,
                'modelo_tipo' => get_class($modelo),
                'usuario_id'  => auth()->id(),
                'accion'      => 'creado',
                'fecha'       => now(),
                'ip'          => request()->ip(),
                'user_agent'  => request()->userAgent(),
            ]);
        });

        static::updated(function ($modelo) {
            Auditoria::create([
                'modelo_id'   => $modelo->id,
                'modelo_tipo' => get_class($modelo),
                'usuario_id'  => auth()->id(),
                'accion'      => 'actualizado',
                'fecha'       => now(),
                'ip'          => request()->ip(),
                'user_agent'  => request()->userAgent(),
            ]);
        });

        static::deleting(function ($modelo) {
            if (method_exists($modelo, 'isForceDeleting') && !$modelo->isForceDeleting()) {
                Auditoria::create([
                    'modelo_id'   => $modelo->id,
                    'modelo_tipo' => get_class($modelo),
                    'usuario_id'  => auth()->id(),
                    'accion'      => 'eliminado',
                    'fecha'       => now(),
                    'ip'          => request()->ip(),
                    'user_agent'  => request()->userAgent(),
                ]);
            }
        });
    }
}
