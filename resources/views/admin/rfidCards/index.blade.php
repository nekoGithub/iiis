<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'route' => route('admin.users.index'),
    ],
    [
        'name' => 'Personal',
        'route' => route('admin.peoples.index'),
    ],
    [
        'name' => 'Tarjetas RFID',
    ],
]">
    @livewire('rfid-cards.show-rfid-cards')



    @push('js')
        {{-- <script>
            function asignarRFID(idTarjeta) {
                fetch('/api/rfid-assign-waiting', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id_tarjeta: idTarjeta
                    })
                }).then(res => res.json()).then(data => {
                    alert("Esperando tarjeta RFID...");
                });

                return false; // evitar que se envíe el form
            }
        </script> --}}
 {{--        <script>
            function asignarRFID(idTarjeta) {
                const button = event.target.closest('form').querySelector('button');
                const originalText = button.innerText;
        
                button.classList.remove('bg-amber-500');
                button.classList.add('bg-blue-500');
                button.innerText = 'Esperando...';
        
                // Establecer un timeout de 2 minutos (120000 ms)
                const timeout = setTimeout(() => {
                    button.classList.remove('bg-blue-500');
                    button.classList.add('bg-red-500');
                    button.innerText = 'Tiempo agotado';
                }, 120000);
        
                fetch('/api/rfid-assign-waiting', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        id_tarjeta: idTarjeta
                    })
                })
                .then(res => res.json())
                .then(data => {
                    clearTimeout(timeout); // Cancelar el timeout si se recibe respuesta antes de 2 minutos
        
                    if (data.success) {
                        button.classList.remove('bg-blue-500');
                        button.classList.add('bg-green-500');
                        button.innerText = 'Asignado ✔';
                    } else {
                        button.classList.remove('bg-blue-500');
                        button.classList.add('bg-yellow-500');
                        button.innerText = 'No asignado';
                    }
                })
                .catch(err => {
                    clearTimeout(timeout);
                    console.error(err);
                    button.classList.remove('bg-blue-500');
                    button.classList.add('bg-red-500');
                    button.innerText = 'Error';
                });
        
                return false;
            }
        </script> --}}
        
        
    @endpush
</x-admin-layout>
