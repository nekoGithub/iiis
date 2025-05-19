<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        
    ],
  
]">
    @livewire('users.show-users')
</x-admin-layout>
