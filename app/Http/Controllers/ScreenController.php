<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScreenController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.screens.index')->only('index');
    }
    
    public function index()
    {
        $emociones = ['feliz', 'triste', 'enojado', 'sorpresa', 'neutral', 'disgustado', 'miedo'];
        $dataEmociones = [];

        foreach ($emociones as $emocion) {
            $conteo = DB::connection('mysql2')
                ->table('reconocimientos')
                ->whereDate('fecha_hora', Carbon::today())
                ->where('emocion', $emocion)
                ->count();

            $dataEmociones[$emocion] = $conteo;
        }

        return view('admin.screens.index', compact('dataEmociones'));
    }
}
