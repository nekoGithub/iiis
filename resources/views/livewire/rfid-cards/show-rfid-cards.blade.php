<div wire:init="loadRfidCards" wire:poll.5000ms>
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
        @if (count($rfidCards))
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Nro.</th>
                        <th class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Personal</th>
                        <th class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Código RFID
                        </th>
                        <th class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Fecha de
                            emisión
                        </th>
                        <th class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Estado</th>
                        <th class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rfidCards as $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->id }}</td>
                            <td class="px-6 py-4">{{ $item->people->name }} {{ $item->people->last_name }}</td>
                            <td class="px-6 py-4">
                                @if ($item->codigo_rfid)
                                    {{ $item->codigo_rfid }}
                                @else
                                    <span class="text-red-600 font-semibold">No existe RFID asignado</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->fecha_emision)
                                    {{ $item->fecha_emision }}
                                @else
                                    <span class="text-red-600 font-semibold">No hay una fecha de emsión</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->estado === 'Activa')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <i class="fa-solid fa-circle-check mr-1"></i> Activo
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        <i class="fa-solid fa-circle-xmark mr-1"></i> Inactivo
                                    </span>
                                @endif
                            </td>


                            <td class="px-6 py-4">
                                @can('admin.rfid-cards.asignar')
                                    <form method="POST" onsubmit="return asignarRFID({{ $item->id }}, event);">
                                        @csrf
                                        <button type="submit" id="boton-enviar-{{ $item->id }}"
                                            class="px-3 py-1 rounded text-white transition
                                            @if ($item->codigo_rfid) bg-green-500
                                            @elseif($item->esperando_asignacion)
                                                bg-blue-500
                                            @else
                                                bg-amber-500 @endif"
                                            @if ($item->codigo_rfid) disabled @endif>
                                            @if ($item->codigo_rfid)
                                                Asignado ✔
                                            @elseif($item->esperando_asignacion)
                                                Esperando...
                                            @else
                                                Asignar
                                            @endif
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($rfidCards->hasPages())
                <div class="px-6 py-3">
                    {{ $rfidCards->links() }}
                </div>
            @endif
        @else
            <div class="text-red-400 px-6 py-4">
                No existe ningun registro coincidente!!!
            </div>
        @endif
    </div>
</div>

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function asignarRFID(id, event) {
            event.preventDefault();

            $.get('/api/dispositivo/esp32rfid', function(device) {
                const ipArduino = `http://${device.ip}`;
                const url = `${ipArduino}/recibir-id?id=${id}`;
                const maxAttempts = 10;
                const interval = 4000;
                let attempts = 0;
                let verificarInterval;
                let timerInterval;

                const button = document.querySelector(`#boton-enviar-${id}`);
                if (button) {
                    button.disabled = true;
                    button.classList.remove('bg-amber-500');
                    button.classList.add('bg-blue-500');
                    button.innerText = 'Esperando...';
                }

                Swal.fire({
                    title: "Enviando ID al Arduino...",
                    html: "Esperando lectura de tarjeta...<br>Tiempo restante: <b id='timer-count'></b> ms",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();

                        // Control manual del timer
                        let tiempoRestante = maxAttempts * interval;
                        const b = Swal.getHtmlContainer().querySelector('b#timer-count');
                        if (b) b.textContent = tiempoRestante;

                        timerInterval = setInterval(() => {
                            tiempoRestante -= 100;
                            if (tiempoRestante < 0) tiempoRestante = 0;
                            if (b) b.textContent = tiempoRestante;
                        }, 100);

                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function(response) {

                                console.log("✅ Arduino respondió:", response);

                                const verificarRFID = () => {
                                    if (attempts >= maxAttempts) {
                                        clearInterval(verificarInterval);
                                        clearInterval(timerInterval);
                                        Swal.close();

                                        if (button) {
                                            button.disabled = false;
                                            button.classList.remove('bg-blue-500');
                                            button.classList.add('bg-amber-500');
                                            button.innerText = 'Asignar';
                                        }

                                        Swal.fire(
                                            'No se detectó la tarjeta',
                                            'Intenta acercar nuevamente la tarjeta al lector.',
                                            'warning'
                                        );

                                        return;
                                    }

                                    $.ajax({
                                        url: `/api/verificar-rfid/${id}`,
                                        method: 'GET',
                                        success: function(data) {
                                            console.log(
                                                "🔍 Verificando asignación:",
                                                data); // <---- Agrega esto
                                            console.log("✅ data.asignado:",
                                                data.asignado);
                                            if (data.asignado) {
                                                clearInterval(
                                                    verificarInterval);
                                                clearInterval(
                                                    timerInterval);
                                                Swal
                                                    .close(); // **Cerramos el swal de espera aquí**

                                                if (button) {
                                                    button.classList.remove(
                                                        'bg-blue-500');
                                                    button.classList.add(
                                                        'bg-green-500');
                                                    button.innerText =
                                                        'Registrado ✔';
                                                    button.disabled = true;
                                                }

                                                // Luego mostramos el swal de éxito
                                                Swal.fire(
                                                    '¡Tarjeta registrada!',
                                                    'El RFID se detectó correctamente.',
                                                    'success'
                                                );


                                                window.livewire.emit(
                                                    'refreshComponent');
                                                return;
                                            } else {
                                                attempts++;
                                            }
                                        },
                                        error: function() {
                                            attempts++;
                                        }
                                    });
                                };

                                verificarInterval = setInterval(verificarRFID, interval);
                            },
                            error: function(xhr, status, error) {
                                clearInterval(verificarInterval);
                                clearInterval(timerInterval);
                                Swal.close();

                                if (button) {
                                    button.disabled = false;
                                    button.classList.remove('bg-blue-500');
                                    button.classList.add('bg-amber-500');
                                    button.innerText = 'Asignar';
                                }
                                Swal.fire('Error',
                                    'No se pudo enviar al Arduino. Verifica que esté conectado.',
                                    'error');
                            }
                        });
                    },
                    willClose: () => {
                        clearInterval(verificarInterval);
                        clearInterval(timerInterval);
                    }
                });

                return false;
            });
        }
    </script>
@endpush
