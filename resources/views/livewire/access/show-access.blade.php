<div wire:poll ="2">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="cursor-pointer px-6 py-3">
                        Nro.
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3">
                        Personal
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3">
                        Tarjeta RFID
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3">
                        Fecha de Asignación
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3">
                        Hora de Entrada
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3">
                        Hora de Salida
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3">
                        Ubicación
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($access as $item)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->people->name }} {{ $item->people->last_name }} 
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->card->codigo_rfid }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->fecha_acceso }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->hora_entrada }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->hora_salida ?? 'No se registro' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->ubicacion }}
                        </td>
                        <td class="px-6 py-4 flex">
                            No hay acciones
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        @if ($access->hasPages())
            <div class="px-6 py-3">
                {{ $access->links() }}
            </div>
        @endif
    </div>
</div>
@push('js')
    <script>
        // Este script puede ir en tu layout o directamente en la vista que carga Livewire
        window.addEventListener('load', () => {
            // Escucha eventos desde el backend (usando Echo o WebSockets si tienes)
            // O simplemente lanza el evento manualmente si sabes que ya se guardó
            setInterval(() => {
                Livewire.dispatch('actualizar-datos');
            }, 5000); // cada 5 segundos, por ejemplo
        });
    </script>
@endpush
