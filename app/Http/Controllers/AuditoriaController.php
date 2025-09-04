<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:admin.auditorias.index'])->only('index'); 
    }

    public function index()
    {
        $auditorias = Auditoria::with('usuario')->latest()->get();

        return view('admin.auditorias.index', compact('auditorias'));
    }
}
