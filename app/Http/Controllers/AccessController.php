<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\RfidCard;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        // Verificar si ya existe un acceso sin hora_salida hoy
        $ultimoAcceso = Access::where('card_id', $card->id)
            ->whereDate('fecha_acceso', $fechaHoy)
            ->whereNull('hora_salida')
            ->orderBy('fecha_acceso', 'desc')
            ->first();

        if ($ultimoAcceso) {
            // Registrar salida
            $ultimoAcceso->hora_salida = $ahora->toTimeString();
            $ultimoAcceso->save();

            return response()->json([
                'message' => 'Hora de salida registrada',
                'tipo' => 'salida'
            ]);
        } else {
            // Registrar entrada
            Access::create([
                'people_id' => $people->id,
                'card_id' => $card->id,
                'fecha_acceso' => $ahora->toDateTimeString(),
                'hora_entrada' => $ahora->toTimeString(),
                'ubicacion' => $ubicacion,
            ]);

            return response()->json([
                'message' => 'Hora de entrada registrada',
                'tipo' => 'entrada'
            ]);
        }
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
