<x-admin-layout class="dark:text-gray-100" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Usuarios',
        'route' => route('admin.users.index'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Roles',
        'route' => route('admin.roles.index'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Personal',
        'route' => route('admin.peoples.index'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Tarejtas RFID',
        'route' => route('admin.rfidCards.index'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Accesos RFID',
        'route' => route('admin.access.index'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Reportes RFID',
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 dark:text-white">Historial de Auditoría</h1>

        <div class="overflow-x-auto rounded-lg shadow-md p-4 bg-white dark:bg-gray-900">
            <table id="tabla-auditorias"
                class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-gray-900 dark:text-white text-sm pt-4">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Modelo</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            ID Modelo</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Acción</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Usuario</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Fecha</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            IP</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Navegador</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($auditorias as $audit)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $audit->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ class_basename($audit->modelo_tipo) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $audit->modelo_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $audit->accion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $audit->usuario ? $audit->usuario->name : 'Sistema' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $audit->fecha }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $audit->ip }}</td>
                            <td class="px-6 py-4 max-w-xs truncate" title="{{ $audit->user_agent }}">
                                {{ $audit->user_agent }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No hay registros de auditoría.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                $('#tabla-auditorias').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json' // Traducción al español
                    },
                    order: [
                        [0, 'desc']
                    ],
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                    searching: true,
                    paging: true,
                    info: true,
                    ordering: true,

                    dom: `
                        <"flex justify-start mb-4"B>
                        <"flex flex-col md:flex-row justify-between items-center"
                            <"flex items-center mb-2 md:mb-0"l>
                            <"flex items-center"f>
                        >
                        rt
                        <"flex flex-col md:flex-row justify-between items-center mt-4"
                            <"text-sm text-gray-700 dark:text-gray-300"i>
                            <"pagination"p>
                        >
                        `, // Personalización del DOM para botones y búsqueda
                    buttons: [{
                            extend: 'copy',
                            text: 'Copiar',
                            title: 'Historial de Auditoría',
                            filename: 'historial_auditoria',
                            exportOptions: {
                                modifier: {
                                    search: 'applied'
                                }
                            }
                        },
                        {
                            extend: 'csv',
                            text: 'Exportar CSV',
                            title: 'Historial de Auditoría',
                            filename: 'historial_auditoria',
                            exportOptions: {
                                modifier: {
                                    search: 'applied'
                                }
                            }
                        },
                        {
                            extend: 'excel',
                            text: 'Exportar Excel',
                            title: 'Historial de Auditoría',
                            filename: 'historial_auditoria',
                            exportOptions: {
                                modifier: {
                                    search: 'applied'
                                }
                            }
                        },
                        {
                            extend: 'pdf',
                            text: 'Exportar PDF',
                            title: 'Historial de Auditoría',
                            filename: 'historial_auditoria',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                modifier: {
                                    search: 'applied'
                                }
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Imprimir',
                            title: 'Historial de Auditoría',
                            messageTop: 'Este es el historial de acciones del sistema.',
                            exportOptions: {
                                modifier: {
                                    search: 'applied'
                                }
                            }
                        }
                    ],


                    initComplete: function() {
                        // Estilo para el select de filas por página
                        $('div.dataTables_length select').addClass(
                            'w-20 bg-gray-800 text-white border border-gray-600 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white'
                        );

                        // Estilo para el label "Mostrar"
                        $('div.dataTables_length label').addClass('dark:text-white text-gray-700');
                        // Botón Copiar
                        $("button.buttons-copy").removeClass().addClass(
                            'bg-blue-600 text-white font-semibold rounded px-3 py-1 mr-2 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800'
                        );

                        // Botón CSV
                        $("button.buttons-csv").removeClass().addClass(
                            'bg-green-600 text-white font-semibold rounded px-3 py-1 mr-2 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800'
                        );

                        // Botón Excel
                        $("button.buttons-excel").removeClass().addClass(
                            'bg-emerald-600 text-white font-semibold rounded px-3 py-1 mr-2 hover:bg-emerald-700 dark:bg-emerald-700 dark:hover:bg-emerald-800'
                        );

                        // Botón PDF
                        $("button.buttons-pdf").removeClass().addClass(
                            'bg-red-600 text-white font-semibold rounded px-3 py-1 mr-2 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800'
                        );

                        // Botón Imprimir
                        $("button.buttons-print").removeClass().addClass(
                            'bg-indigo-600 text-white font-semibold rounded px-3 py-1 mr-2 hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-800'
                        );

                        // Input búsqueda
                        $('div.dataTables_filter input').addClass(
                            'bg-gray-800 text-white border border-gray-600 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white'
                        );

                        // Texto "Buscar"
                        $('div.dataTables_filter label').addClass('dark:text-white text-gray-700');

                        // Select de filas por página
                        $('div.dataTables_length select').addClass(
                            'bg-gray-800 text-white border border-gray-600 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white'
                        );

                        // Info tabla
                        $('.dataTables_info').addClass('text-gray-900 dark:text-white');

                        // Paginación
                        $('.dataTables_paginate').addClass('dark:text-white');
                        $('.dataTables_paginate a').addClass(
                            'text-white bg-gray-700 rounded px-3 py-1 hover:bg-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white'
                        );
                        $('.dataTables_paginate .paginate_button.current').removeClass('bg-gray-700')
                            .addClass('bg-indigo-600');
                    }






                });
            });
        </script>
    @endpush

</x-admin-layout>
