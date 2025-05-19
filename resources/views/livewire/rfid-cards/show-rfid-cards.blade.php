<div>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-6 py-3">Nro.</th>
                <th class="px-6 py-3">Personal</th>
                <th class="px-6 py-3">Código RFID</th>
                <th class="px-6 py-3">Fecha de emisión</th>
                <th class="px-6 py-3">Estado</th>
                <th class="px-6 py-3">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rfidCards as $item)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $item->id }}</td>
                    <td class="px-6 py-4">{{ $item->people->name }} {{ $item->people->last_name }}</td>
                    <td class="px-6 py-4">{{ $item->codigo_rfid }}</td>
                    <td class="px-6 py-4">{{ $item->fecha_emision }}</td>
                    <td class="px-6 py-4">{{ $item->estado }}</td>
                    <td class="px-6 py-4">
                        <form method="POST" onsubmit="return asignarRFID({{ $item->id }}, event);">
                            @csrf
                            <button type="submit"
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('js')
    <script>
        function asignarRFID(idTarjeta, event) {
            event.preventDefault();

            const button = event.target.closest('form').querySelector('button');
            button.disabled = true;
            button.classList.remove('bg-amber-500');
            button.classList.add('bg-blue-500');
            button.innerText = 'Esperando...';

            fetch('/api/rfid-assign-waiting', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    id: idTarjeta
                })
            });

            let attempts = 0;
            const maxAttempts = 10;
            const interval = 2000;
            let timerInterval;

            Swal.fire({
                title: "Esperando código RFID...",
                html: "Tiempo restante: <b></b> ms",
                timer: maxAttempts * interval,
                timerProgressBar: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector('b');
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft();
                    }, 100);

                    verificarRFID(); // Empieza a verificar
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });

            function verificarRFID() {
                if (attempts >= maxAttempts) {
                    button.disabled = false;
                    button.classList.remove('bg-blue-500');
                    button.classList.add('bg-amber-500');
                    button.innerText = 'Asignar';
                    Swal.fire('No se detectó el código RFID', '', 'warning');
                    return;
                }

                fetch(`/api/rfid-status/${idTarjeta}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.asignado) {
                            Swal.close();
                            Livewire.dispatch('refreshComponent');
                            button.classList.remove('bg-blue-500');
                            button.classList.add('bg-green-500');
                            button.innerText = 'Asignado ✔';
                        } else {
                            attempts++;
                            setTimeout(verificarRFID, interval);
                        }
                    })
                    .catch(() => {
                        attempts++;
                        setTimeout(verificarRFID, interval);
                    });
            }

            return false;
        }
    </script>
@endpush
