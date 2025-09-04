<div class="space-y-6">
    {{-- Encabezado --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Búsqueda de Personas y Accesos
            </h2>
            
            @if($personaSeleccionada)
                <button 
                    wire:click="limpiarBusqueda"
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200 flex items-center"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Limpiar
                </button>
            @endif
        </div>

        {{-- Mensajes flash --}}
        @if (session()->has('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{-- Formulario de búsqueda --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Buscar por nombre, apellido o email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text"
                    wire:model.debounce.300ms="search"
                    placeholder="Escribe al menos 2 caracteres..."
                    class="w-full p-3 rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('search') border-red-500 @enderror"
                />
                @error('search')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Período de consulta
                </label>
                <select 
                    wire:model="periodo" 
                    class="w-full p-3 rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="dia">Hoy</option>
                    <option value="semana">Esta Semana</option>
                    <option value="mes">Este Mes</option>
                    <option value="año">Este Año</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button 
                    wire:click="buscarPersona"
                    wire:loading.attr="disabled"
                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-lg transition-colors duration-200 disabled:opacity-50 flex items-center justify-center"
                >
                    <svg wire:loading.remove wire:target="buscarPersona" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <svg wire:loading wire:target="buscarPersona" class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="buscarPersona">Buscar</span>
                    <span wire:loading wire:target="buscarPersona">Buscando...</span>
                </button>

                @if($personaSeleccionada && !empty($accesosDetallados))
                    <button 
                        wire:click="descargarPdf"
                        wire:loading.attr="disabled"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-lg transition-colors duration-200 disabled:opacity-50 flex items-center"
                    >
                        <svg wire:loading.remove wire:target="descargarPdf" class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <svg wire:loading wire:target="descargarPdf" class="w-4 h-4 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="descargarPdf">PDF</span>
                        <span wire:loading wire:target="descargarPdf">...</span>
                    </button>
                @endif
            </div>
        </div>

        {{-- Loading indicator --}}
        <div wire:loading.flex wire:target="search,periodo" class="justify-center items-center py-4 mt-4">
            <svg class="animate-spin h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="ml-2 text-gray-600 dark:text-gray-400">Buscando...</span>
        </div>
    </div>

    {{-- Información de la persona --}}
    @if ($personaSeleccionada)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4">
                        {{ substr($personaSeleccionada->name, 0, 1) }}{{ substr($personaSeleccionada->last_name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $personaSeleccionada->name }} {{ $personaSeleccionada->last_name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ $estadisticas['rango_periodo'] ?? '' }}
                        </p>
                    </div>
                </div>
                
                @if(!empty($accesosDetallados))
                    <div class="text-right">
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalAccesos }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">accesos totales</div>
                    </div>
                @endif
            </div>

            {{-- Información personal --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <strong>Email:</strong>
                    </div>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $personaSeleccionada->email ?? 'No registrado' }}</p>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <strong>Teléfono:</strong>
                    </div>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $personaSeleccionada->phone ?? 'No registrado' }}</p>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        <strong>RFID:</strong>
                    </div>
                    <p class="mt-1">
                        @if($personaSeleccionada->card && $personaSeleccionada->card->codigo_rfid)
                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded text-sm font-mono">
                                {{ $personaSeleccionada->card->codigo_rfid }}
                            </span>
                        @else
                            <span class="text-gray-500 dark:text-gray-400">Sin tarjeta asignada</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Estadísticas --}}
            @if(!empty($estadisticas))
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold">{{ $estadisticas['accesos_completos'] }}</div>
                        <div class="text-sm opacity-90">Accesos Completos</div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold">{{ $estadisticas['dias_con_acceso'] }}</div>
                        <div class="text-sm opacity-90">Días con Acceso</div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold">{{ $estadisticas['promedio_diario'] }}</div>
                        <div class="text-sm opacity-90">Promedio Diario</div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold">{{ $estadisticas['tiempo_total'] }}</div>
                        <div class="text-sm opacity-90">Tiempo Total</div>
                    </div>
                </div>
            @endif

            {{-- Toggle detalles --}}
            @if(!empty($accesosDetallados))
                <div class="flex justify-center mb-4">
                    <button 
                        wire:click="toggleDetalles"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200 flex items-center"
                    >
                        <svg class="w-4 h-4 mr-2 transform transition-transform duration-200 {{ $mostrarDetalles ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        {{ $mostrarDetalles ? 'Ocultar' : 'Ver' }} Detalles de Accesos
                    </button>
                </div>
            @endif
        </div>

        {{-- Tabla de accesos detallados --}}
        @if($mostrarDetalles && !empty($accesosDetallados))
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Registro Detallado de Accesos
                        <span class="ml-2 px-2 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full text-xs">
                            {{ count($accesosDetallados) }} registros
                        </span>
                    </h4>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                <th class="p-4 text-left border-b border-gray-200 dark:border-gray-600 font-medium">Fecha</th>
                                <th class="p-4 text-left border-b border-gray-200 dark:border-gray-600 font-medium">Código RFID</th>
                                <th class="p-4 text-left border-b border-gray-200 dark:border-gray-600 font-medium">Entrada</th>
                                <th class="p-4 text-left border-b border-gray-200 dark:border-gray-600 font-medium">Salida</th>
                                <th class="p-4 text-left border-b border-gray-200 dark:border-gray-600 font-medium">Duración</th>
                                <th class="p-4 text-left border-b border-gray-200 dark:border-gray-600 font-medium">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accesosDetallados as $acceso)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="p-4 border-b border-gray-200 dark:border-gray-600">
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $acceso['fecha'] }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $acceso['fecha_completa'] }}</div>
                                        </div>
                                    </td>
                                    <td class="p-4 border-b border-gray-200 dark:border-gray-600">
                                        @if($acceso['codigo_rfid'] !== 'N/A')
                                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded text-xs font-mono">
                                                {{ $acceso['codigo_rfid'] }}
                                            </span>
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="p-4 border-b border-gray-200 dark:border-gray-600">
                                        @if($acceso['hora_entrada'])
                                            <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">
                                                {{ $acceso['hora_entrada'] }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">—</span>
                                        @endif
                                    </td>
                                    <td class="p-4 border-b border-gray-200 dark:border-gray-600">
                                        @if($acceso['hora_salida'])
                                            <span class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-sm font-medium">
                                                {{ $acceso['hora_salida'] }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">—</span>
                                        @endif
                                    </td>
                                    <td class="p-4 border-b border-gray-200 dark:border-gray-600">
                                        @if($acceso['duracion'])
                                            <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded text-sm font-medium">
                                                {{ $acceso['duracion'] }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">—</span>
                                        @endif
                                    </td>
                                    <td class="p-4 border-b border-gray-200 dark:border-gray-600">
                                        @switch($acceso['tipo_acceso'])
                                            @case('completo')
                                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs font-medium flex items-center w-fit">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    Completo
                                                </span>
                                                @break
                                            @case('solo_entrada')
                                                <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-xs font-medium flex items-center w-fit">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    Solo Entrada
                                                </span>
                                                @break
                                            @case('solo_salida')
                                                <span class="px-3 py-1 bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 rounded-full text-xs font-medium flex items-center w-fit">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    Solo Salida
                                                </span>
                                                @break
                                            @default
                                                <span class="px-3 py-1 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 rounded-full text-xs font-medium flex items-center w-fit">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                    </svg>
                                                    Incompleto
                                                </span>
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- Estado sin accesos --}}
        @if($personaSeleccionada && empty($accesosDetallados))
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Sin accesos registrados</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ $personaSeleccionada->name }} {{ $personaSeleccionada->last_name }} no tiene accesos registrados en {{ strtolower($estadisticas['rango_periodo'] ?? 'el período seleccionado') }}.
                    </p>
                    <div class="mt-6">
                        <button 
                            wire:click="$set('periodo', 'mes')"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200"
                        >
                            Ver este mes
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @elseif($search && strlen($search) >= 2)
        {{-- Estado sin resultados --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No se encontraron resultados</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    No se encontró ninguna persona que coincida con "<strong>{{ $search }}</strong>".
                </p>
                <div class="mt-6">
                    <p class="text-xs text-gray-400 dark:text-gray-500">
                        Intenta buscar por nombre, apellido o email. La búsqueda debe tener al menos 2 caracteres.
                    </p>
                </div>
            </div>
        </div>
    @else
        {{-- Estado inicial --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Busca una persona</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Ingresa el nombre, apellido o email de la persona para ver sus accesos y estadísticas.
                </p>
                <div class="mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-md mx-auto">
                        <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Búsqueda inteligente
                        </div>
                        <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Estadísticas detalladas
                        </div>
                        <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Descarga en PDF
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>