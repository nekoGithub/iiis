<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Accesos - {{ $persona->name }} {{ $persona->last_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }

        .header .subtitle {
            margin: 10px 0 0 0;
            font-size: 14px;
            color: #666;
        }

        .person-info {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 0 8px 8px 0;
        }

        .person-info h2 {
            margin: 0 0 15px 0;
            color: #2c3e50;
            font-size: 20px;
            display: flex;
            align-items: center;
        }

        .person-info .avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #3498db, #9b59b6);
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            margin-right: 15px;
        }

        .info-grid {
            display: table;
            width: 100%;
            margin-top: 15px;
        }

        .info-row {
            display: table-row;
        }

        .info-cell {
            display: table-cell;
            padding: 5px 10px 5px 0;
            vertical-align: top;
            width: 33.333%;
        }

        .info-cell strong {
            color: #2c3e50;
        }

        .stats-container {
            margin-bottom: 30px;
        }

        .stats-grid {
            display: table;
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px;
        }

        .stats-row {
            display: table-row;
        }

        .stat-box {
            display: table-cell;
            background: linear-gradient(135deg, #e8f4f8, #d4edda);
            border: 1px solid #17a2b8;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            width: 25%;
        }

        .stat-box.blue {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-color: #2196f3;
        }

        .stat-box.green {
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
            border-color: #4caf50;
        }

        .stat-box.purple {
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            border-color: #9c27b0;
        }

        .stat-box.orange {
            background: linear-gradient(135deg, #fff3e0, #ffcc80);
            border-color: #ff9800;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .period-info {
            background-color: #e8f4f8;
            border: 1px solid #17a2b8;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .period-info h3 {
            margin: 0 0 10px 0;
            color: #0c5460;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        table th {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: white;
            padding: 12px 8px;
            text-align: left;
            border: 1px solid #2c3e50;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table td {
            padding: 10px 8px;
            border: 1px solid #dee2e6;
            font-size: 11px;
            vertical-align: middle;
        }

        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        table tbody tr:hover {
            background-color: #e9ecef;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            min-width: 70px;
        }

        .entrada {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .salida {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .duracion {
            background-color: #e2e3e5;
            color: #383d41;
            border: 1px solid #d6d8db;
        }

        .completo {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .solo-entrada {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .solo-salida {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f1b0b7;
        }

        .rfid-code {
            font-family: 'Courier New', monospace;
            background-color: #e3f2fd;
            color: #0d47a1;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
            background-color: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
        }

        .summary-box {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px solid #dee2e6;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
        }

        .summary-box h3 {
            margin: 0 0 15px 0;
            color: #2c3e50;
            font-size: 16px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        @page {
            margin: 1.5cm;

            @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
            }
        }

        .page-break {
            page-break-after: always;
        }

        .highlight {
            background-color: #fff3cd;
            padding: 2px 4px;
            border-radius: 3px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            background-color: #4CAF50;
            /* Verde */
            color: white;
        }

        thead th {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
            color: #000000;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reporte Individual de Accesos RFID</h1>
        <p class="subtitle">Sistema de Control de Acceso</p>
    </div>

    {{-- Información de la persona --}}
    <div class="person-info">
        <h2>
            <div class="avatar">
                {{ substr($persona->name, 0, 1) }}{{ substr($persona->last_name, 0, 1) }}
            </div>
            {{ $persona->name }} {{ $persona->last_name }}
        </h2>

        <div class="info-grid">
            <div class="info-row">
                <div class="info-cell">
                    <strong>Email:</strong><br>
                    {{ $persona->email ?? 'No registrado' }}
                </div>
                <div class="info-cell">
                    <strong>Teléfono:</strong><br>
                    {{ $persona->phone ?? 'No registrado' }}
                </div>
                <div class="info-cell">
                    <strong>Código RFID:</strong><br>
                    @if ($persona->card && $persona->card->codigo_rfid)
                        <span class="rfid-code">{{ $persona->card->codigo_rfid }}</span>
                    @else
                        No asignado
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Información del período --}}
    <div class="period-info">
        <h3>Período de Consulta</h3>
        <p><strong>{{ $estadisticas['rango_periodo'] }}</strong></p>
        <p>Reporte generado el: {{ $fechaGeneracion }}</p>
    </div>

    {{-- Estadísticas --}}
    @if (!empty($estadisticas))
        <div class="summary-box">
            <h3>Resumen de Actividad</h3>
            <div class="stats-grid">
                <div class="stats-row">
                    <div class="stat-box blue">
                        <div class="stat-value">{{ $estadisticas['accesos_completos'] }}</div>
                        <div class="stat-label">Accesos Completos</div>
                    </div>
                    <div class="stat-box green">
                        <div class="stat-value">{{ $estadisticas['dias_con_acceso'] }}</div>
                        <div class="stat-label">Días con Acceso</div>
                    </div>
                    <div class="stat-box purple">
                        <div class="stat-value">{{ $estadisticas['promedio_diario'] }}</div>
                        <div class="stat-label">Promedio Diario</div>
                    </div>
                    <div class="stat-box orange">
                        <div class="stat-value">{{ $estadisticas['tiempo_total'] }}</div>
                        <div class="stat-label">Tiempo Total</div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 20px; text-align: center; font-size: 11px; color: #666;">
                <p><strong>Total de registros:</strong> {{ $estadisticas['total_accesos'] }} |
                    <strong>Solo entradas:</strong> {{ $estadisticas['solo_entradas'] }} |
                    <strong>Solo salidas:</strong> {{ $estadisticas['solo_salidas'] }}
                </p>
            </div>
        </div>
    @endif

    {{-- Tabla de accesos detallados --}}
    @if (count($accesos) > 0)
        <div style="margin-top: 30px;">
            <h3 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px;">
                Registro Detallado de Accesos ({{ count($accesos) }} registros)
            </h3>

            <table>
                <thead>
                    <tr>
                        <th style="width: 15%;">Fecha</th>
                        <th style="width: 15%;">Día de la Semana</th>
                        <th style="width: 15%;">Código RFID</th>
                        <th style="width: 12%;">Entrada</th>
                        <th style="width: 12%;">Salida</th>
                        <th style="width: 12%;">Duración</th>                        
                        <th style="width: 4%;">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accesos as $index => $acceso)
                        <tr>
                            <td>
                                <strong>{{ $acceso['fecha'] }}</strong>
                            </td>
                            <td style="font-size: 10px; color: #666;">
                                {{ \Carbon\Carbon::createFromFormat('d/m/Y', $acceso['fecha'])->locale('es')->dayName }}
                            </td>
                            <td>
                                @if ($acceso['codigo_rfid'] !== 'N/A')
                                    <span class="rfid-code">{{ $acceso['codigo_rfid'] }}</span>
                                @else
                                    <span style="color: #999; font-style: italic;">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if ($acceso['hora_entrada'])
                                    <span class="status-badge entrada">{{ $acceso['hora_entrada'] }}</span>
                                @else
                                    <span style="color: #999;">—</span>
                                @endif
                            </td>
                            <td>
                                @if ($acceso['hora_salida'])
                                    <span class="status-badge salida">{{ $acceso['hora_salida'] }}</span>
                                @else
                                    <span style="color: #999;">—</span>
                                @endif
                            </td>
                            <td>
                                @if ($acceso['duracion'])
                                    <span class="status-badge duracion">{{ $acceso['duracion'] }}</span>
                                @else
                                    <span style="color: #999;">—</span>
                                @endif
                            </td>
                            <td style="text-align: center; color: #999; font-size: 10px;">
                                #{{ $acceso['id'] }}
                            </td>
                        </tr>

                        {{-- Salto de página cada 25 registros para mejor legibilidad --}}
                        @if (($index + 1) % 25 === 0 && !$loop->last)
                </tbody>
            </table>
            <div class="page-break"></div>

            {{-- Repetir encabezado de la persona en nueva página --}}
            <div style="background-color: #f8f9fa; padding: 15px; margin-bottom: 20px; border-left: 4px solid #3498db;">
                <h4 style="margin: 0; color: #2c3e50;">
                    Continuación - {{ $persona->name }} {{ $persona->last_name }}
                </h4>
                <p style="margin: 5px 0 0 0; color: #666; font-size: 11px;">
                    {{ $estadisticas['rango_periodo'] }} | Página {{ ceil(($index + 1) / 25) + 1 }}
                </p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 15%;">Fecha</th>
                        <th style="width: 15%;">Día de la Semana</th>
                        <th style="width: 15%;">Código RFID</th>
                        <th style="width: 12%;">Entrada</th>
                        <th style="width: 12%;">Salida</th>
                        <th style="width: 12%;">Duración</th>
                        <th style="width: 15%;">Estado</th>
                        <th style="width: 4%;">ID</th>
                    </tr>
                </thead>
                <tbody>
    @endif
    @endforeach
    </tbody>
    </table>
    </div>

    {{-- Análisis adicional --}}
    @if (count($accesos) > 1)
        <div class="summary-box" style="margin-top: 30px;">
            <h3>Análisis del Período</h3>
            <div style="display: table; width: 100%;">
                <div style="display: table-row;">
                    <div style="display: table-cell; width: 50%; padding-right: 20px;">
                        <h4 style="color: #2c3e50; margin-bottom: 10px;">Patrones de Acceso:</h4>
                        <ul style="margin: 0; padding-left: 20px; font-size: 11px;">
                            <li>Accesos más frecuentes:
                                @php
                                    $diasFrecuentes = collect($accesos)
                                        ->groupBy('fecha')
                                        ->sortByDesc(function ($accesos) {
                                            return $accesos->count();
                                        })
                                        ->take(3)
                                        ->keys()
                                        ->join(', ');
                                @endphp
                                {{ $diasFrecuentes ?: 'Actividad uniforme' }}
                            </li>
                            <li>Promedio de permanencia por día:
                                @php
                                    $accesosDuracion = collect($accesos)->where('duracion', '!=', null);
                                    $promedioDuracion = $accesosDuracion->isNotEmpty()
                                        ? 'Calculado automáticamente'
                                        : 'No disponible';
                                @endphp
                                {{ $promedioDuracion }}
                            </li>
                            <li>Tipo de acceso predominante:
                                @php
                                    $tipoPredominate = collect($accesos)
                                        ->groupBy('tipo_acceso')
                                        ->map->count()
                                        ->sortDesc()
                                        ->keys()
                                        ->first();
                                    $tipoTexto = match ($tipoPredominate) {
                                        'completo' => 'Accesos completos (entrada + salida)',
                                        'solo_entrada' => 'Solo registros de entrada',
                                        'solo_salida' => 'Solo registros de salida',
                                        default => 'Accesos incompletos',
                                    };
                                @endphp
                                {{ $tipoTexto }}
                            </li>
                        </ul>
                    </div>
                    <div style="display: table-cell; width: 50%; padding-left: 20px; border-left: 2px solid #dee2e6;">
                        <h4 style="color: #2c3e50; margin-bottom: 10px;">Observaciones:</h4>
                        <ul style="margin: 0; padding-left: 20px; font-size: 11px;">
                            @if ($estadisticas['accesos_completos'] == $estadisticas['total_accesos'])
                                <li style="color: #28a745;">✓ Todos los accesos están completos</li>
                            @else
                                <li style="color: #ffc107;">⚠
                                    {{ $estadisticas['total_accesos'] - $estadisticas['accesos_completos'] }} accesos
                                    incompletos detectados</li>
                            @endif

                            @if ($estadisticas['dias_con_acceso'] >= 20)
                                <li style="color: #28a745;">✓ Alta frecuencia de acceso</li>
                            @elseif($estadisticas['dias_con_acceso'] >= 10)
                                <li style="color: #ffc107;">◦ Frecuencia moderada de acceso</li>
                            @else
                                <li style="color: #dc3545;">◦ Baja frecuencia de acceso</li>
                            @endif

                            @if ($estadisticas['promedio_diario'] > 2)
                                <li style="color: #17a2b8;">◦ Múltiples accesos por día (promedio:
                                    {{ $estadisticas['promedio_diario'] }})</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
@else
    <div class="no-data">
        <h3>Sin Registros de Acceso</h3>
        <p><strong>{{ $persona->name }} {{ $persona->last_name }}</strong> no registra accesos en el período
            consultado.</p>
        <p style="margin-top: 15px; font-size: 11px; color: #999;">
            Período: {{ $estadisticas['rango_periodo'] ?? 'No especificado' }}
        </p>
    </div>
    @endif

    <div class="footer">
        <p>
            <strong>Reporte Individual generado el:</strong> {{ $fechaGeneracion }} |
            <strong>Sistema de Control de Acceso RFID</strong> |
            <strong>Usuario:</strong> {{ $persona->name }} {{ $persona->last_name }}
        </p>
    </div>
</body>

</html>
