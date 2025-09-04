<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReconocimientoController extends Controller
{
    public function index()
    {
        $emociones = ['feliz', 'triste', 'enojado', 'sorpresa', 'neutral'];
        $dataEmociones = [];

        foreach ($emociones as $emocion) {
            $conteo = DB::connection('mysql2') // conexión a segunda BD
                ->table('reconocimientos')
                ->whereDate('fecha_hora', Carbon::today())
                ->where('emocion', $emocion)
                ->count();

            $dataEmociones[$emocion] = $conteo;
        }

        return view('admin.reconocimientos.index', compact('dataEmociones'));
    }
}
