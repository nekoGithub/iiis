<?php

namespace App\Http\Controllers;

use App\Models\RfidCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RfidCardController extends Controller
{
    public function index()
    {
        $rfidCards = RfidCard::all();
        return view('admin.rfidCards.index', compact('rfidCards'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo_rfid' => 'required|string|unique:rfid_cards,codigo_rfid',
        ]);

        // Verificamos si hay una tarjeta en espera
        $idTarjeta = Cache::pull('rfid_waiting'); // Tomar y eliminar de caché

        if ($idTarjeta) {
            $tarjeta = RfidCard::find($idTarjeta);
            $tarjeta->codigo_rfid = $data['codigo_rfid'];
            $tarjeta->fecha_emision = Carbon::now();
            $tarjeta->estado = 'activa';
            $tarjeta->save();

            return response()->json(['message' => 'Tarjeta asignada exitosamente']);
        }

        return response()->json(['error' => 'No hay una asignación activa'], 400);
    }
    public function assignWaiting(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:rfid_cards,id'
        ]);

        Cache::put('rfid_waiting', $data['id'], now()->addMinutes(2)); // Guardar ID en caché 2 minutos
        return response()->json(['message' => 'Esperando tarjeta RFID']);
    }
    public function verificarEstadoRFID($id)
    {
        $tarjeta = RfidCard::find($id);

        if ($tarjeta && $tarjeta->codigo_rfid !== null) {
            return response()->json([
                'asignado' => true,
                'codigo_rfid' => $tarjeta->codigo_rfid
            ]);
        }

        return response()->json(['asignado' => false]);
    }
}
