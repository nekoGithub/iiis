<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Reconocimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.vistas.index')->only('show');
        $this->middleware('can:admin.dashboard')->only('index');
    }

    public function index()
    {
        // ------------------- Datos para Gráfico 3: Usuarios últimos 7 días (barras verticales) -------------------

        // Generar lista de fechas de los últimos 7 días (desde hace 6 días hasta hoy)
        $fechas = collect();
        for ($i = 0; $i < 7; $i++) {
            $fecha = now()->subDays(6 - $i)->format('Y-m-d');
            $fechas->push($fecha);
        }

        // Consultar la cantidad de usuarios creados por día en ese rango
        $usuariosPorFecha = DB::table('users')
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as cantidad')
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('fecha')
            ->pluck('cantidad', 'fecha');

        // Mapear fechas para asegurar que haya un registro para cada día, inclusive 0
        $usersPorDia = $fechas->map(function ($fecha) use ($usuariosPorFecha) {
            return [
                'fecha' => $fecha,
                'cantidad' => $usuariosPorFecha[$fecha] ?? 0
            ];
        });

        // ------------------- Datos para Gráfico 4: Accesos últimos 6 meses (barras horizontales) -------------------

        $fechaInicio = now()->subMonths(5)->startOfMonth();
        $fechaFin = now()->endOfMonth();

        // Consulta para entradas y salidas agrupadas por mes
        $accesos = DB::table('accesses')
            ->selectRaw("
                DATE_FORMAT(fecha_acceso, '%b') AS mes,
                MONTH(fecha_acceso) AS num_mes,
                COUNT(*) AS total_accesos,
                SUM(CASE WHEN hora_salida IS NOT NULL THEN 1 ELSE 0 END) AS salidas
            ")
            ->whereNotNull('hora_entrada')
            ->whereBetween('fecha_acceso', [$fechaInicio, $fechaFin])
            ->groupBy('mes', 'num_mes')
            ->orderBy('num_mes')
            ->get();

        // Formatear datos para la vista
        $accesosPorMes = $accesos->map(function ($item) {
            return [
                'mes' => ucfirst($item->mes),
                'entradas' => $item->total_accesos,
                'salidas' => $item->salidas,
            ];
        });

        // ------------------- Datos para Gráfico 2: Personal Registrado (pastel) -------------------

        $tipos = ['estudiante', 'docente', 'administrativo'];

        // Obtener conteo por tipo desde tabla 'peoples'
        $personasPorTipo = DB::table('peoples')
            ->select('type', DB::raw('COUNT(*) as total'))
            ->whereIn('type', $tipos)
            ->groupBy('type')
            ->pluck('total', 'type');

        // Asegurar orden y valores para el pie chart
        $datosPie = collect($tipos)->map(fn($tipo) => $personasPorTipo[$tipo] ?? 0);

        // ------------------- Datos para Gráfico 1: Accesos por tipo (línea) -------------------

        // Últimos 6 días, desde hoy hacia atrás
        $ultimos6Dias = collect(range(0, 5))
            ->map(fn($i) => Carbon::now()->subDays($i)->toDateString())
            ->reverse();

        // Accesos por fecha y tipo (estudiante, docente, administrativo)
        $accesosPorTipo = DB::table('accesses')
            ->join('rfid_cards', 'accesses.card_id', '=', 'rfid_cards.id')
            ->join('peoples', 'rfid_cards.people_id', '=', 'peoples.id')
            ->select(
                DB::raw('DATE(accesses.fecha_acceso) as fecha'),
                'peoples.type as tipo',
                DB::raw('COUNT(*) as cantidad')
            )
            ->whereIn(DB::raw('DATE(accesses.fecha_acceso)'), $ultimos6Dias)
            ->groupBy(DB::raw('DATE(accesses.fecha_acceso)'), 'peoples.type')
            ->orderBy('fecha')
            ->get();

        $tipos2 = ['estudiante', 'docente', 'administrativo'];
        $datosLinea = [];

        // Normalizar para que haya datos para todos los días y tipos, inclusive 0
        foreach ($ultimos6Dias as $fecha) {
            foreach ($tipos2 as $tipo) {
                $registro = $accesosPorTipo->first(fn($r) => $r->fecha === $fecha && $r->tipo === $tipo);
                $datosLinea[$tipo][] = $registro ? $registro->cantidad : 0;
            }
        }

        // Etiquetas para eje X formateadas para la vista (ejemplo: '24 Jul')
        $etiquetas = array_values(
            $ultimos6Dias->map(fn($f) => Carbon::parse($f)->format('d M'))->toArray()
        );

        // ------------------- Datos para Gráfico radial: Accesos hoy por tipo -------------------

        $hoy = Carbon::today();

        $accesosHoyPorTipo = Access::selectRaw('peoples.type, COUNT(accesses.id) as total')
            ->join('peoples', 'accesses.people_id', '=', 'peoples.id')
            ->whereDate('fecha_acceso', $hoy)
            ->groupBy('peoples.type')
            ->pluck('total', 'type')
            ->toArray();

        // Asegurar que todas las categorías están presentes, incluso si no hay accesos
        $accesosHoyPorTipo = array_merge(array_fill_keys($tipos, 0), $accesosHoyPorTipo);

        // ------------------- Retornar datos a la vista -------------------

        return view('admin.dashboard', compact(
            'usersPorDia',      // Gráfico 3: usuarios últimos 7 días
            'accesosPorMes',    // Gráfico 4: accesos últimos 6 meses
            'datosPie',         // Gráfico 2: personal registrado
            'tipos',            // Para etiquetas en pie y radial
            'datosLinea',       // Gráfico 1: accesos por tipo (línea)
            'etiquetas',        // Etiquetas fechas para gráfico línea
            'tipos2',           // Tipos para gráfico línea
            'accesosHoyPorTipo' // Gráfico radial: accesos hoy
        ));
    }

    public function show()
    {
        Carbon::setLocale('es');

        // Grafico 1 Obtener los últimos 6 días + hoy
        $dias = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dias->push(Carbon::today()->subDays($i)->format('Y-m-d'));
        }

        // Obtener emociones distintas
        $emociones = DB::connection('mysql2')
            ->table('reconocimientos')
            ->select('emocion')
            ->distinct()
            ->pluck('emocion');

        // Contar cuántos reconocimientos hay por emoción y por día
        $datos = DB::connection('mysql2')
            ->table('reconocimientos')
            ->selectRaw('DATE(fecha_hora) as fecha, emocion, COUNT(*) as cantidad')
            ->whereIn(DB::raw('DATE(fecha_hora)'), $dias)
            ->groupBy('fecha', 'emocion')
            ->get();

        // Preparar la estructura de datos para el gráfico
        $series = [];

        foreach ($emociones as $emocion) {
            $data = [];
            foreach ($dias as $dia) {
                $registro = $datos->first(fn($d) => $d->fecha === $dia && $d->emocion === $emocion);
                $data[] = $registro ? (int) $registro->cantidad : 0;
            }
            $series[] = [
                'name' => ucfirst($emocion),
                'data' => $data,
            ];
        }

        // Formatear etiquetas de fechas al formato "d M", ej: "26 jul"
        $labels = $dias->map(fn($d) => Carbon::parse($d)->translatedFormat('d M'))->values();

        // Grafico 2 - Obtener total de registros por emoción
        $datos = DB::connection('mysql2')
            ->table('reconocimientos')
            ->select('emocion', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('emocion')
            ->orderByDesc('cantidad')
            ->get();

        $tipos = $datos->pluck('emocion');
        $datosPie = $datos->pluck('cantidad');

        // 1. Grafico 3 Accesos HOY - por emoción
        $emociones = ['asco', 'alegría', 'miedo', 'tristeza', 'sorpresa', 'neutral', 'ira'];
        $accesosHoyPorTipo = [];

        foreach ($emociones as $emocion) {
            $accesosHoyPorTipo[$emocion] = Reconocimiento::whereDate('fecha_hora', now())
                ->where('emocion', $emocion)
                ->count();
        }

        // 2. Grafico 4 Últimos 6 meses - por mes        
        $ultimos6Meses = Reconocimiento::selectRaw("DATE_FORMAT(fecha_hora, '%Y-%m') as mes, COUNT(*) as total")
            ->where('fecha_hora', '>=', now()->startOfMonth()->subMonths(5))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $meses = $ultimos6Meses->pluck('mes')->map(function ($m) {
            return Carbon::parse($m . '-01')->isoFormat('MMM YYYY');
        })->toArray(); // ✅ Asegura que sea un array plano

        $datosBarra = $ultimos6Meses->pluck('total')->toArray(); // ✅ También aquí

        // 3. Grafico 5 Últimos 7 días - conteo diario
        $hoy = Carbon::today();

        $ultimos7dias = collect();
        for ($i = 6; $i >= 0; $i--) {
            $fecha = $hoy->copy()->subDays($i)->format('Y-m-d');
            $ultimos7dias->push($fecha);
        }

        $fechasEtiquetas = [];
        $conteosMaximos = [];
        $emocionMaxPorDia = [];

        foreach ($ultimos7dias as $fecha) {
            // Obtenemos conteos por emoción para la fecha
            $conteosPorEmocion = Reconocimiento::select('emocion')
                ->selectRaw('COUNT(*) as total')
                ->whereDate('fecha_hora', $fecha)
                ->groupBy('emocion')
                ->orderByDesc('total')
                ->get();

            if ($conteosPorEmocion->isEmpty()) {
                // Si no hay registros, poner cero y emoción vacía
                $conteosMaximos[] = 0;
                $emocionMaxPorDia[] = 'Ninguna';
            } else {
                // Tomamos la emoción con mayor conteo (primer elemento)
                $maxEmocion = $conteosPorEmocion->first();
                $conteosMaximos[] = $maxEmocion->total;
                $emocionMaxPorDia[] = ucfirst($maxEmocion->emocion);
            }

            // Formateamos la fecha para etiquetas (ejemplo: Lun 21 Jul)
            $fechasEtiquetas[] = Carbon::parse($fecha)->isoFormat('ddd D MMM');
        }
        $totalUltimos7dias = array_sum($conteosMaximos);
        $coloresPorDia = ['#1A56DB', '#FDBA8C', '#10B981', '#EF4444', '#8B5CF6', '#F59E0B', '#3B82F6']; // 7 colores para 7 días




        return view('admin.vistas.index', [
            'series' => $series,
            'labels' => $labels,
            'tipos' => $tipos,
            'datosPie' => $datosPie,
            // gráfico columnas
            'fechasEtiquetas' => $fechasEtiquetas,
            'conteosMaximos' => $conteosMaximos,
            'emocionMaxPorDia' => $emocionMaxPorDia,
            'totalUltimos7dias' => $totalUltimos7dias,
            'coloresPorDia' => $coloresPorDia,

            // gráfico barras horizontal
            'meses' => $meses,
            'datosBarra' => $datosBarra,


            // gráfico radial
            'accesosHoyPorTipo' => $accesosHoyPorTipo,
        ]);
    }
}
