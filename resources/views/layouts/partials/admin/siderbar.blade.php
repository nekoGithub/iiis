@php
    $links = [
        [
            'icon' => 'fa-solid fa-gauge-high',
            'name' => 'Panel Control',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
            'can' => 'admin.dashboard',
        ],
        [
            'icon' => 'fa-solid fa-users',
            'name' => 'Usuarios',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
            'can' => 'admin.users.index',
        ],
        [
            'icon' => 'fa-solid fa-user-shield',
            'name' => 'Roles',
            'route' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*'),
            'can' => 'admin.roles.index',
        ],
        [
            'icon' => 'fa-solid fa-person-walking',
            'name' => 'Personal',
            'route' => route('admin.peoples.index'),
            'active' => request()->routeIs('admin.peoples.*'),
            'can' => 'admin.peoples.index',
        ],
        [
            'icon' => 'fa-solid fa-address-card',
            'name' => 'Tarjetas RFID',
            'route' => route('admin.rfidCards.index'),
            'active' => request()->routeIs('admin.rfidCards.*'),
            'can' => 'admin.rfid-cards.index',
        ],
        [
            'icon' => 'fa-solid fa-fingerprint',
            'name' => 'Accesos RFID',
            'route' => route('admin.access.index'),
            'active' => request()->routeIs('admin.access.*'),
            'can' => 'admin.access.index',
        ],
        [
            'icon' => 'fa-solid fa-desktop',
            'name' => 'Visualización RFID',
            'route' => route('admin.screns.index'),
            'active' => request()->routeIs('admin.screns.index'),
            'can' => 'admin.screens.index',
        ],
        [
            'icon' => 'fa-solid fa-desktop',
            'name' => 'Visualización Emociones',
            'route' => route('admin.vistas.index'),
            'active' => request()->routeIs('admin.vistas.index'),
            'can' => 'admin.vistas.index',
        ],
        [
            'icon' => 'fa-solid fa-file-export',
            'name' => 'Reportes RFID',
            'route' => route('admin.reports.index'),
            'active' => request()->routeIs('admin.reports.*'),
            'can' => 'admin.reports.index',
        ],
        [
            'icon' => 'fa-solid fa-clipboard-list',            
            'name' => 'Auditoría',
            'route' => route('admin.auditorias.index'),
            'active' => request()->routeIs('admin.auditorias.*'),
            'can' => 'admin.auditorias.index',
        ],
        [
            'icon' => 'fa-solid fa-person-walking-dashed-line-arrow-right',
            'name' => 'Salir',
            'logout' => true,
        ],
    ];
@endphp
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': siderbarOpen,
        '-translate-x-full ease-in': !siderbarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                @if (isset($link['logout']) && $link['logout'] === true)
                    <li>
                        <button onclick="confirmLogout()"
                            class="w-full flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="inline-flex w-6 h-6 justify-center items-center">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="ms-3">{{ $link['name'] }}</span>
                        </button>
                    </li>
                @else
                    @can($link['can'] ?? null)
                        <li>
                            <a href="{{ $link['route'] }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                <span class="inline-flex w-6 h-6 justify-center items-center">
                                    <i class="{{ $link['icon'] }}"></i>
                                </span>
                                <span class="ms-3">{{ $link['name'] }}</span>
                            </a>
                        </li>
                    @endcan
                @endif
            @endforeach



        </ul>
    </div>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

    @push('js')
        <script>
            function confirmLogout() {
                Swal.fire({
                    title: "¿Cerrar sesión?",
                    text: "¿Estás seguro que deseas salir de la aplicacion web?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, salir",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        </script>
    @endpush

</aside>
