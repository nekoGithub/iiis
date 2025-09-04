<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PeopleController extends Controller
{

    public function esperarAsignacion($id)
    {
        Cache::put('rfid_waiting', $id, 300); // Guarda el ID por 5 minutos
        return redirect()->back()->with('mensaje', 'Acerca la tarjeta RFID al lector para asignar.');
    }
    
    public function index()
    {
        return view('admin.peoples.index');
    }
}
