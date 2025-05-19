<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\RfidCard;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * Buscar acceso por RFID
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /*  public function buscarAccesoPorRfid(Request $request)
    {
        $request->validate([
            //'codigo_rfid' => 'required|string|size:10' // O el tamaño adecuado del RFID
            'codigo_rfid' => 'required' // O el tamaño adecuado del RFID
        ]);

        // Buscar el card_id que coincida con el RFID proporcionado
        $rfidCard = RfidCard::where('codigo_rfid', $request->codigo_rfid)->first();

        if ($rfidCard) {
            return response()->json([
                'message' => 'RFID encontrado',
                'people_id' => $rfidCard->people_id,
                'card_id' => $rfidCard->id
            ]);
        }

        return response()->json(['message' => 'RFID no encontrado'], 404);
    } */
    /**
     * Registrar acceso (entrada/salida) de una persona.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /* public function registrarAcceso(Request $request)
    {
        $request->validate([
            'people_id' => 'required|exists:peoples,id',
            'card_id' => 'required|exists:rfid_cards,id',
            'ubicacion' => 'required|string'
        ]);

        $hoy = now()->toDateString();

        // Buscar último acceso de hoy sin salida
        $accesoPendiente = Access::where('people_id', $request->people_id)
            ->whereDate('fecha_acceso', $hoy)
            ->whereNull('hora_salida')
            ->latest()
            ->first();

        if ($accesoPendiente) {
            // Registrar salida
            $accesoPendiente->hora_salida = now()->toTimeString();
            $accesoPendiente->save();

            return response()->json([
                'message' => 'Salida registrada',
                'total_ingresos_hoy' => Access::where('people_id', $request->people_id)
                    ->whereDate('fecha_acceso', $hoy)
                    ->count()
            ]);
        } else {
            // Registrar entrada
            Access::create([
                'people_id' => $request->people_id,
                'card_id' => $request->card_id,
                'fecha_acceso' => now(),
                'hora_entrada' => now()->toTimeString(),
                'ubicacion' => $request->ubicacion,
            ]);

            return response()->json([
                'message' => 'Entrada registrada',
                'total_ingresos_hoy' => Access::where('people_id', $request->people_id)
                    ->whereDate('fecha_acceso', $hoy)
                    ->count()
            ]);
        }
    } */
   public function index(){
    return view('admin.access.index');
   }

    public function procesarAccesoPorRfid(Request $request)
    {
        $request->validate([
            'codigo_rfid' => 'required'
        ]);

        // Buscar tarjeta RFID
        $rfidCard = RfidCard::where('codigo_rfid', $request->codigo_rfid)->first();

        if (!$rfidCard) {
            return response()->json(['message' => 'RFID no registrado'], 404);
        }

        $people_id = $rfidCard->people_id;
        $card_id = $rfidCard->id;
        $ubicacion = 'Torre A'; // Ubicación por defecto
        $hoy = now()->toDateString();

        // Buscar acceso pendiente (sin salida) del día
        $accesoPendiente = Access::where('people_id', $people_id)
            ->whereDate('fecha_acceso', $hoy)
            ->whereNull('hora_salida')
            ->latest()
            ->first();

        if ($accesoPendiente) {
            // Registrar salida
            $accesoPendiente->hora_salida = now()->toTimeString();
            $accesoPendiente->save();

            return response()->json([
                'message' => 'Salida registrada',
                'people_id' => $people_id,
                'card_id' => $card_id,
                'ubicacion' => $ubicacion,
                'tipo' => 'salida',
                'total_ingresos_hoy' => Access::where('people_id', $people_id)
                    ->whereDate('fecha_acceso', $hoy)
                    ->count()
            ]);
        } else {
            // Registrar entrada
            Access::create([
                'people_id' => $people_id,
                'card_id' => $card_id,
                'fecha_acceso' => now(),
                'hora_entrada' => now()->toTimeString(),
                'ubicacion' => $ubicacion,
            ]);

            return response()->json([
                'message' => 'Entrada registrada',
                'people_id' => $people_id,
                'card_id' => $card_id,
                'ubicacion' => $ubicacion,
                'tipo' => 'entrada',
                'total_ingresos_hoy' => Access::where('people_id', $people_id)
                    ->whereDate('fecha_acceso', $hoy)
                    ->count()
            ]);
        }
    }
}
