@php
    $links = [
        [
            'icon' => 'fa-solid fa-gauge-high',
            'name' => 'Panel Control',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'icon' => 'fa-solid fa-users',
            'name' => 'Usuarios',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
        ],
        [
            'icon' => 'fa-solid fa-person-walking',
            'name' => 'Personal',
            'route' => route('admin.peoples.index'),
            'active' => request()->routeIs('admin.peoples.*'),
        ],
        [
            'icon' => 'fa-solid fa-address-card',
            'name' => 'Tarjetas RFID',
            'route' => route('admin.rfidCards.index'),
            'active' => request()->routeIs('admin.rfidCards.*'),
        ],
        [
            'icon' => 'fa-solid fa-fingerprint',
            'name' => 'Accesos RFID',
            'route' => route('admin.access.index'),
            'active' => request()->routeIs('admin.access.*'),
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
                <li>
                    <a href="{{ $link['route'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-200' : '' }}">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                            <i class="{{ $link['icon'] }}"></i>
                        </span>
                        <span class="ms-3">{{ $link['name'] }}</span>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</aside>
