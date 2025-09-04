<div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
        Reporte General de Accesos
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <div>
            <label class="text-sm text-gray-700 dark:text-gray-300">Periodo</label>
            <select wire:model.live="periodo" class="w-full rounded p-2 dark:bg-gray-700 dark:text-white border-gray-300">
                <option value="dia">Hoy</option>
                <option value="semana">Esta semana</option>
                <option value="mes">Este mes</option>
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-700 dark:text-gray-300">Buscar</label>
            <input type="text" 
                   wire:model.live.debounce.500ms="search" 
                   placeholder="Nombre, RFID, ubicación..."
                   class="w-full rounded p-2 dark:bg-gray-700 dark:text-white border-gray-300">
        </div>

        <div>
            <label class="text-sm text-gray-700 dark:text-gray-300">Por página</label>
            <select wire:model.live="perPage" class="w-full rounded p-2 dark:bg-gray-700 dark:text-white border-gray-300">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button wire:click="buscar"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded flex-1">
                <i class="fas fa-search mr-2"></i>Buscar
            </button>
            <button wire:click="exportarPDF"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded flex-1"
                    wire:loading.attr="disabled"
                    wire:target="exportarPDF">
                <i class="fas fa-file-pdf mr-2"></i>
                <span wire:loading.remove wire:target="exportarPDF">PDF</span>
                <span wire:loading wire:target="exportarPDF">Generando...</span>
            </button>
        </div>
    </div>

    <!-- Información del filtro actual -->
    <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg mb-4">
        <div class="flex items-center justify-between text-sm">
            <span class="text-blue-700 dark:text-blue-300">
                <i class="fas fa-info-circle mr-2"></i>
                Mostrando registros de: 
                <strong>
                    @if($periodo === 'dia') 
                        Hoy ({{ Carbon\Carbon::now()->format('d/m/Y') }})
                    @elseif($periodo === 'semana')
                        Esta semana ({{ Carbon\Carbon::now()->startOfWeek()->format('d/m/Y') }} - {{ Carbon\Carbon::now()->endOfWeek()->format('d/m/Y') }})
                    @else
                        Este mes ({{ Carbon\Carbon::now()->format('m/Y') }})
                    @endif
                </strong>
                @if(!empty($search))
                    | Filtrado por: "<em>{{ $search }}</em>"
                @endif
            </span>
            <span class="text-blue-700 dark:text-blue-300">
                Total: <strong>{{ $accesos->total() }}</strong> registros
            </span>
        </div>
    </div>

    <div class="overflow-auto">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <th class="p-2 border text-left">#</th>
                    <th class="p-2 border text-left">Nombre Completo</th>
                    <th class="p-2 border text-left">RFID</th>
                    <th class="p-2 border text-left">Fecha</th>
                    <th class="p-2 border text-left">Entrada</th>
                    <th class="p-2 border text-left">Salida</th>
                    <th class="p-2 border text-left">Ubicación</th>
                    <th class="p-2 border text-left">Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accesos as $acceso)
                    <tr class="border-b dark:border-gray-600 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="p-2">{{ ($accesos->currentPage() - 1) * $accesos->perPage() + $loop->iteration }}</td>
                        <td class="p-2 font-medium">
                            {{ $acceso->people->name ?? 'N/A' }} {{ $acceso->people->last_name ?? '' }}
                        </td>
                        <td class="p-2">
                            <span class="bg-gray-100 dark:bg-gray-600 px-2 py-1 rounded text-xs font-mono">
                                {{ $acceso->card->codigo_rfid ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($acceso->fecha_acceso)->format('d/m/Y') }}</td>
                        <td class="p-2">
                            <span class="text-green-600 dark:text-green-400">
                                {{ $acceso->hora_entrada }}
                            </span>
                        </td>
                        <td class="p-2">
                            @if($acceso->hora_salida)
                                <span class="text-red-600 dark:text-red-400">
                                    {{ $acceso->hora_salida }}
                                </span>
                            @else
                                <span class="text-yellow-600 dark:text-yellow-400">—</span>
                            @endif
                        </td>
                        <td class="p-2">
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-2 py-1 rounded text-xs">
                                {{ $acceso->ubicacion }}
                            </span>
                        </td>
                        <td class="p-2">
                            @if($acceso->hora_salida)
                                <span class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 px-2 py-1 rounded text-xs">
                                    Completado
                                </span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 px-2 py-1 rounded text-xs">
                                    En curso
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-gray-500 dark:text-gray-400 p-8">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-search text-4xl mb-2"></i>
                                <p>No hay accesos en este período.</p>
                                @if(!empty($search))
                                    <p class="text-sm mt-1">Intenta con otros términos de búsqueda.</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    @if($accesos->hasPages())
        <div class="mt-4">
            {{ $accesos->links() }}
        </div>
    @endif

    <!-- Loading overlay -->
    <div wire:loading wire:target="buscar,exportarPDF" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-indigo-600"></div>
                <span class="text-gray-700 dark:text-gray-300">Procesando...</span>
            </div>
        </div>
    </div>
</div>