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
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">
    @livewire('access.show-access')
</x-admin-layout>
