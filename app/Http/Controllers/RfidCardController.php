<?php

namespace App\Http\Controllers;

use App\Models\RfidCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RfidCardController extends Controller
{
    /* public function __construct()
    {        
        $this->middleware('can:admin.rfid-cards.index')->only('index');  
        $this->middleware('can:admin.rfid-cards.asignar')->only('verificar');  
    } */

    public function index()
    {
        $rfidCards = RfidCard::all();
        return view('admin.rfidCards.index', compact('rfidCards'));
    }

    public function verificar($id)
    {
        $rfidCard = RfidCard::find($id);

        if (!$rfidCard) {
            return response()->json([
                'error' => 'Registro no encontrado',
            ], 404);
        }

        return response()->json([
            'asignado' => !empty($rfidCard->codigo_rfid),
        ]);
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $codigo_rfid = $request->input('codigo_rfid');

        if (!$id || !$codigo_rfid) {
            return response()->json(['error' => 'Faltan datos'], 400);
        }

        $card = RfidCard::find($id);
        if (!$card) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        $card->codigo_rfid = $codigo_rfid;
        $card->fecha_emision = now();
        $card->estado = 'Activa';
        $card->save();

        return response()->json(['success' => true, 'message' => "Asignado $codigo_rfid al ID $id"]);
    }
}
