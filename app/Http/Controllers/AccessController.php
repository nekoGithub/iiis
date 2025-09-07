<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\RfidCard;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AccessController extends Controller
{
    public function registrarAcceso(Request $request)
    {
        $codigo = $request->input('codigo_rfid');
        $ubicacion = $request->input('ubicacion', 'Desconocido');

        if (!$codigo) {
            return response()->json(['error' => 'Código RFID faltante'], 400);
        }

        $card = RfidCard::where('codigo_rfid', $codigo)->first();

        if (!$card) {
            return response()->json(['error' => 'Tarjeta no registrada'], 404);
        }

        $people = $card->people;

        if (!$people) {
            return response()->json(['error' => 'Tarjeta sin persona asociada'], 404);
        }

        $fechaHoy = Carbon::now()->toDateString();
        $ahora = Carbon::now();
        $horaLimiteSalida = Carbon::createFromTime(18, 0, 0); // Hora oficial de salida

        // Buscar último acceso del día
        $ultimoAcceso = Access::where('card_id', $card->id)
            ->whereDate('fecha_acceso', $fechaHoy)
            ->orderBy('fecha_acceso', 'desc')
            ->first();

        // ✅ Si NO hay registro hoy → ENTRADA
        if (!$ultimoAcceso) {
            Access::create([
                'people_id'   => $people->id,
                'card_id'     => $card->id,
                'fecha_acceso' => $ahora->toDateTimeString(),
                'hora_entrada' => $ahora->toTimeString(),
                'ubicacion'   => $ubicacion,
            ]);

            return response()->json([
                'message' => 'Hora de entrada registrada',
                'tipo'    => 'entrada',
                'hora'    => $ahora->toTimeString()
            ]);
        }

        // ✅ Si ya hay entrada pero sin salida → actualizar salida
        if ($ultimoAcceso && !$ultimoAcceso->hora_salida) {
            if ($ahora->greaterThanOrEqualTo($horaLimiteSalida)) {
                // Salida definitiva (después de hora oficial)
                $ultimoAcceso->hora_salida = $ahora->toTimeString();
                $ultimoAcceso->estado_salida = 'definitiva';
                $ultimoAcceso->save();

                return response()->json([
                    'message' => 'Hora de salida registrada (definitiva)',
                    'tipo'    => 'salida_definitiva',
                    'hora'    => $ahora->toTimeString()
                ]);
            } else {
                // Salida provisional (antes de hora oficial) → SE ACTUALIZA SIEMPRE
                $ultimoAcceso->hora_salida = $ahora->toTimeString();
                $ultimoAcceso->estado_salida = 'provisional';
                $ultimoAcceso->save();

                return response()->json([
                    'message' => 'Salida provisional actualizada',
                    'tipo'    => 'salida_provisional',
                    'hora'    => $ahora->toTimeString()
                ]);
            }
        }

        // ✅ Si ya tiene salida registrada → permitir actualizar mientras sea provisional
        if ($ultimoAcceso && $ultimoAcceso->estado_salida === 'provisional') {
            if ($ahora->greaterThanOrEqualTo($horaLimiteSalida)) {
                // Convertimos a definitiva al pasar el límite
                $ultimoAcceso->hora_salida = $ahora->toTimeString();
                $ultimoAcceso->estado_salida = 'definitiva';
                $ultimoAcceso->save();

                return response()->json([
                    'message' => 'Salida provisional convertida en definitiva',
                    'tipo'    => 'salida_definitiva',
                    'hora'    => $ahora->toTimeString()
                ]);
            } else {
                // Actualizamos la hora de salida provisional
                $ultimoAcceso->hora_salida = $ahora->toTimeString();
                $ultimoAcceso->save();

                return response()->json([
                    'message' => 'Salida provisional actualizada',
                    'tipo'    => 'salida_provisional',
                    'hora'    => $ahora->toTimeString()
                ]);
            }
        }

        // ✅ Si ya tiene entrada y salida definitiva → ignoramos más marcas
        return response()->json([
            'message' => 'Ya se registró entrada y salida definitiva hoy',
            'tipo'    => 'completo',
            'hora'    => $ahora->toTimeString()
        ]);
    }



    public function ultimoAccess()
    {
        $acceso = Access::with('people', 'card')
            ->orderBy('updated_at', 'desc')
            ->first();

        return response()->json($acceso);
    }

    public function index()
    {
        return view('admin.access.index');
    }
}
