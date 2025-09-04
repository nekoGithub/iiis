<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Accesos RFID</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            color: #333;
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
        
        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .info-left, .info-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        .info-right {
            text-align: right;
        }
        
        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 4px;
        }
        
        .info-box strong {
            color: #2c3e50;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table th {
            background-color: #34495e;
            color: white;
            padding: 12px 8px;
            text-align: left;
            border: 1px solid #2c3e50;
            font-weight: bold;
            font-size: 11px;
        }
        
        table td {
            padding: 10px 8px;
            border: 1px solid #dee2e6;
            font-size: 11px;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        table tbody tr:hover {
            background-color: #e9ecef;
        }
        
        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            min-width: 60px;
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
        
        .rfid-code {
            font-family: 'Courier New', monospace;
            background-color: #e3f2fd;
            color: #0d47a1;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
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
        
        .summary {
            background-color: #e8f4f8;
            border-left: 4px solid #17a2b8;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
        }
        
        .summary h3 {
            margin: 0 0 10px 0;
            color: #0c5460;
            font-size: 16px;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
        
        @page {
            margin: 1cm;
            @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
            }
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Accesos RFID</h1>
        <p class="subtitle">Sistema de Control de Acceso</p>
    </div>

    <div class="info-section">
        <div class="info-left">
            <div class="info-box">
                <strong>Período del Reporte:</strong><br>
                Desde: {{ $fechaInicio }}<br>
                Hasta: {{ $fechaFin }}
            </div>
        </div>
        <div class="info-right">
            <div class="info-box">
                <strong>Fecha de Generación:</strong><br>
                {{ $fechaGeneracion }}<br>
                <strong>Total de Registros:</strong> {{ $registros->count() }}
            </div>
        </div>
    </div>

    @if($registros->count() > 0)
        <div class="summary">
            <h3>Resumen del Período</h3>
            <p><strong>Total de Accesos:</strong> {{ $registros->count() }}</p>
            <p><strong>Personas Únicas:</strong> {{ $registros->pluck('people.id')->unique()->count() }}</p>
            <p><strong>Accesos con Entrada:</strong> {{ $registros->whereNotNull('hora_entrada')->count() }}</p>
            <p><strong>Accesos con Salida:</strong> {{ $registros->whereNotNull('hora_salida')->count() }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">ID</th>
                    <th style="width: 25%;">Nombre Completo</th>
                    <th style="width: 15%;">Código RFID</th>
                    <th style="width: 12%;">Fecha</th>
                    <th style="width: 15%;">Hora Entrada</th>
                    <th style="width: 15%;">Hora Salida</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $index => $registro)
                    <tr>
                        <td>{{ $registro->id }}</td>
                        <td>
                            {{ $registro->people->name ?? 'N/A' }}
                            {{ $registro->people->last_name ?? '' }}
                        </td>
                        <td>
                            @if($registro->card && $registro->card->codigo_rfid)
                                <span class="rfid-code">{{ $registro->card->codigo_rfid }}</span>
                            @else
                                <span style="color: #999;">N/A</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($registro->fecha_acceso)->format('d/m/Y') }}</td>
                        <td>
                            @if($registro->hora_entrada)
                                <span class="status-badge entrada">{{ $registro->hora_entrada }}</span>
                            @else
                                <span style="color: #999;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($registro->hora_salida)
                                <span class="status-badge salida">{{ $registro->hora_salida }}</span>
                            @else
                                <span style="color: #999;">—</span>
                            @endif
                        </td>
                    </tr>
                    
                    {{-- Salto de página cada 30 registros --}}
                    @if(($index + 1) % 30 === 0 && !$loop->last)
                        </tbody>
                        </table>
                        <div class="page-break"></div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 8%;">ID</th>
                                    <th style="width: 25%;">Nombre Completo</th>
                                    <th style="width: 15%;">Código RFID</th>
                                    <th style="width: 12%;">Fecha</th>
                                    <th style="width: 15%;">Hora Entrada</th>
                                    <th style="width: 15%;">Hora Salida</th>
                                    <th style="width: 10%;">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <h3>No se encontraron registros</h3>
            <p>No hay accesos registrados en el período seleccionado ({{ $fechaInicio }} - {{ $fechaFin }}).</p>
        </div>
    @endif

    <div class="footer">
        <p>
            <strong>Reporte generado el:</strong> {{ $fechaGeneracion }} | 
            <strong>Sistema de Control de Acceso RFID</strong>
        </p>
    </div>
</body>
</html>