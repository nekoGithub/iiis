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
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">
    @livewire('roles.show-roles')
</x-admin-layout>
