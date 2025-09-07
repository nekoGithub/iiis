<div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
        Reporte de Accesos RFID
    </h2>

    {{-- Mensajes flash --}}
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Filtros --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Fecha Inicio <span class="text-red-500">*</span>
            </label>
            <input 
                type="date" 
                wire:model.lazy="fechaInicio"
                class="w-full rounded dark:bg-gray-700 dark:text-white dark:border-gray-600
                       @error('fechaInicio') border-red-500 @enderror"
                max="{{ now()->format('Y-m-d') }}"
            />
            @error('fechaInicio')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Fecha Fin <span class="text-red-500">*</span>
            </label>
            <input 
                type="date" 
                wire:model.lazy="fechaFin"
                class="w-full rounded dark:bg-gray-700 dark:text-white dark:border-gray-600
                       @error('fechaFin') border-red-500  @enderror"
                min="{{ $fechaInicio }}"
                max="{{ now()->format('Y-m-d') }}"
            />
            @error('fechaFin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Registros por página
            </label>
            <select wire:model="perPage" 
                    class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button 
                wire:click="limpiarFiltros"
                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded transition-colors duration-200"
            >
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Limpiar
            </button>
            
            @if($hayFiltros && $registros->count() > 0)
                <button 
                    wire:click="descargarPdf"
                    wire:loading.attr="disabled"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded transition-colors duration-200 disabled:opacity-50"
                >
                    <svg wire:loading.remove wire:target="descargarPdf" class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <svg wire:loading wire:target="descargarPdf" class="w-4 h-4 inline mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="descargarPdf">Descargar PDF</span>
                    <span wire:loading wire:target="descargarPdf">Generando...</span>
                </button>
            @endif
        </div>
    </div>

    {{-- Loading indicator --}}
    <div wire:loading.flex wire:target="fechaInicio,fechaFin,perPage" class="justify-center items-center py-4">
        <svg class="animate-spin h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="ml-2 text-gray-600 dark:text-gray-400">Cargando...</span>
    </div>

    {{-- Tabla de resultados --}}
    @if ($hayFiltros)
        @if ($registros->count() > 0)
            {{-- Información de resultados --}}
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Mostrando {{ $registros->firstItem() }} - {{ $registros->lastItem() }} de {{ $registros->total() }} registros
                @if($fechaInicio && $fechaFin)
                    (del {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }})
                @endif
            </div>

            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <th class="p-3 text-left border border-gray-300 dark:border-gray-600 font-medium">ID</th>
                            <th class="p-3 text-left border border-gray-300 dark:border-gray-600 font-medium">Nombre</th>
                            <th class="p-3 text-left border border-gray-300 dark:border-gray-600 font-medium">RFID</th>
                            <th class="p-3 text-left border border-gray-300 dark:border-gray-600 font-medium">Fecha</th>
                            <th class="p-3 text-left border border-gray-300 dark:border-gray-600 font-medium">Entrada</th>
                            <th class="p-3 text-left border border-gray-300 dark:border-gray-600 font-medium">Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                            <tr class="border-b dark:border-gray-600 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="p-3 border border-gray-300 dark:border-gray-600">{{ $registro->id }}</td>
                                <td class="p-3 border border-gray-300 dark:border-gray-600">
                                    {{ $registro->people->name ?? 'N/A' }} {{ $registro->people->last_name ?? '' }}
                                </td>
                                <td class="p-3 border border-gray-300 dark:border-gray-600">
                                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded text-xs font-mono">
                                        {{ $registro->card->codigo_rfid ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="p-3 border border-gray-300 dark:border-gray-600">
                                    {{ \Carbon\Carbon::parse($registro->fecha_acceso)->format('d/m/Y') }}
                                </td>
                                <td class="p-3 border border-gray-300 dark:border-gray-600">
                                    @if($registro->hora_entrada)
                                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded text-xs">
                                            {{ $registro->hora_entrada }}
                                        </span>
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="p-3 border border-gray-300 dark:border-gray-600">
                                    @if($registro->hora_salida)
                                        <span class="px-2 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded text-xs">
                                            {{ $registro->hora_salida }}
                                        </span>
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-6">
                {{ $registros->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No hay registros</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    No se encontraron accesos en el rango de fechas seleccionado.
                </p>
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 6v6m-6-6h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona un rango de fechas</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Elige las fechas de inicio y fin para generar el reporte de accesos.
            </p>
        </div>
    @endif
</div>