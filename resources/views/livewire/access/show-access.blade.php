<div wire:poll.2s>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="px-6 py-4 flex items-center">

            <div class="flex items-center dark:text-white">
                <span>Mostrar</span>

                <select wire:model.live="cantidad"
                    class="mx-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <span>Entradas</span>
            </div>

            <x-input type="text" class="flex-1 mx-5" wire:model.live="search"
                placeholder="🔎 Escriba lo que esta buscando..." />
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Nro.
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Personal
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Tarjeta RFID
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Fecha de Asignación
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Hora de Entrada
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Hora de Salida
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Ubicación
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Acciones
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
                            <span
                                class="inline-flex items-center px-2 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                                {{ $item->hora_entrada }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->hora_salida)
                                @if ($item->estado_salida === 'definitiva')
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                                        {{ $item->hora_salida }} (Definitiva)
                                    </span>
                                @elseif ($item->estado_salida === 'provisional')
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-300">
                                        {{ $item->hora_salida }} (Provisional)
                                    </span>
                                @endif
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-1 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                    No se registró
                                </span>
                            @endif
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
        window.addEventListener('load', () => {
            setInterval(() => {
                Livewire.dispatch('actualizar-datos');
            }, 5000);
        });
    </script>
@endpush
