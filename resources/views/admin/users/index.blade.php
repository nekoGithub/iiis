<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Usuarios',
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
  
]">
    @livewire('users.show-users')
</x-admin-layout>
