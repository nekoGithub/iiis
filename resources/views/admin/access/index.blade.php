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
        'name' => 'Tarejtas RFID',
        'route' => route('admin.rfidCards.index'),
    ], 
    [
        'name' => 'Accesos RFID',
    ], 
]">
  @livewire('access.show-access')
</x-admin-layout>
