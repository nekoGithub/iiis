<x-admin-layout :breadcrumbs="[
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
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],  
]">
  @livewire('peoples.show-peoples')  
</x-admin-layout>
