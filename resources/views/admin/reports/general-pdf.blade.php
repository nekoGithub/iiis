<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Accesos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .report-title {
            font-size: 16px;
            color: #666;
            margin-top: 5px;
        }

        .info-section {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #007bff;
        }

        .info-row {
            margin: 3px 0;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #343a40;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }

        td {
            padding: 6px 8px;
            border-bottom: 1px solid #dee2e6;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .status-badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-ongoing {
            background-color: #fff3cd;
            color: #856404;
        }

        .rfid-code {
            font-family: 'Courier New', monospace;
            background-color: #e9ecef;
            padding: 2px 4px;
            border-radius: 2px;
        }

        .location-badge {
            background-color: #cce7ff;
            color: #004085;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #6c757d;
            font-style: italic;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-name">Sistema de Control de Accesos</div>
        <div class="report-title">Reporte General de Accesos</div>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Período:</span>
            @if ($periodo === 'dia')
                Hoy ({{ Carbon\Carbon::now()->format('d/m/Y') }})
            @elseif($periodo === 'semana')
                Esta semana ({{ Carbon\Carbon::now()->startOfWeek()->format('d/m/Y') }} -
                {{ Carbon\Carbon::now()->endOfWeek()->format('d/m/Y') }})
            @else
                Este mes ({{ Carbon\Carbon::now()->format('m/Y') }})
            @endif
        </div>
        @if (!empty($search))
            <div class="info-row">
                <span class="info-label">Filtro aplicado:</span> "{{ $search }}"
            </div>
        @endif
        <div class="info-row">
            <span class="info-label">Total de registros:</span> {{ $accesos->count() }}
        </div>
        <div class="info-row">
            <span class="info-label">Fecha de generación:</span> {{ $fecha_generacion }}
        </div>
    </div>

    @if ($accesos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 25%">Nombre Completo</th>
                    <th style="width: 12%">RFID</th>
                    <th style="width: 10%">Fecha</th>
                    <th style="width: 10%">Entrada</th>
                    <th style="width: 10%">Salida</th>
                    <th style="width: 18%">Ubicación</th>
                    <th style="width: 10%">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accesos as $index => $acceso)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $acceso->people->name ?? 'N/A' }}</strong>
                            {{ $acceso->people->last_name ?? '' }}
                        </td>
                        <td>
                            <span class="rfid-code">
                                {{ $acceso->card->codigo_rfid ?? 'N/A' }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($acceso->fecha_acceso)->format('d/m/Y') }}</td>
                        <td style="color: #28a745; font-weight: bold;">{{ $acceso->hora_entrada }}</td>
                        <td style="color: #dc3545; font-weight: bold;">
                            {{ $acceso->hora_salida ?? '—' }}
                        </td>
                        <td>
                            <span class="location-badge">{{ $acceso->ubicacion }}</span>
                        </td>
                        <td>
                            @if ($acceso->hora_salida)
                                <span class="status-badge status-completed">Completado</span>
                            @else
                                <span class="status-badge status-ongoing">En curso</span>
                            @endif
                        </td>
                    </tr>
                    @if (($index + 1) % 35 === 0 && !$loop->last)
            </tbody>
        </table>
        <div class="page-break"></div>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 25%">Nombre Completo</th>
                    <th style="width: 12%">RFID</th>
                    <th style="width: 10%">Fecha</th>
                    <th style="width: 10%">Entrada</th>
                    <th style="width: 10%">Salida</th>
                    <th style="width: 18%">Ubicación</th>
                    <th style="width: 10%">Estado</th>
                </tr>
            </thead>
            <tbody>
    @endif
    @endforeach
    </tbody>
    </table>
@else
    <div class="no-data">
        <h3>Sin datos para mostrar</h3>
        <p>No se encontraron registros de accesos para los criterios seleccionados.</p>
    </div>
    @endif

    <div class="footer">
        <p>
            Este reporte fue generado automáticamente el {{ $fecha_generacion }}
            <br>
            Sistema de Control de Accesos - Página <span class="pagenum"></span>
        </p>
    </div>    
        <script type="text/php">
            if (isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(520, 800, "Página $PAGE_NUM de $PAGE_COUNT", $font, 8);
                ');
            }
        </script>    
</body>

</html>
