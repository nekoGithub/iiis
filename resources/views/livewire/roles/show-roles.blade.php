<div wire:init="loadRoles">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="px-6 py-4 flex items-center">

            <div class="flex items-center dark:text-white">
                <span>Mostrar</span>

                <select wire:model.live="cantidad"
                    class="mx-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <span>Entradas</span>
            </div>

            <x-input type="text" class="flex-1 mx-5" wire:model.live="search"
                placeholder="🔎 Escriba lo que esta buscando..." />
            {{-- @can('admin.peoples.create') --}}
            @livewire('roles.create-roles')
            {{-- @endcan --}}
        </div>
        @if (count($roles))
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('id')">
                            Nro.
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-1-9 float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-up-9-1 float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('name')">
                            Roles
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('created_at')">
                            Fecha de Creación
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->created_at }}
                            </td>
                            <td class="px-6 py-4 flex">
                                {{-- @can('admin.peoples.edit') --}}
                                <a class="btn bg-indigo-600" wire:click="edit({{ $item }})">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                {{-- @endcan
                                @can('admin.peoples.destroy') --}}
                                <a class="btn btn-red ml-2" onclick="confirmDeleteRole({{ $item->id }})">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                                {{-- @endcan --}}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if ($roles->hasPages())
                <div class="px-6 py-3">
                    {{ $roles->links() }}
                </div>
            @endif
        @else
            <div class="text-red-400 px-6 py-4">
                No existe ningun registro coincidente!!!
            </div>
        @endif


    </div>

    <x-dialog-modal wire:model="openEdit" maxWidth="2xl">
        <x-slot name="title">
            <h3 class="font-semibold mb-3 text-xl text-center">FORMULARIO DE EDICIÓN DE ROL</h3>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre del Rol" />
                <x-input type="text" wire:model.lazy="name" placeholder="Ingrese el nombre aquí..." class="w-full" />
                <x-input-error for="name" />
            </div>

            <div class="mb-4">
                <x-label value="Permisos organizados por módulo" class="mb-2" />
                @foreach ($permissions as $group => $perms)
                    <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-800 rounded shadow-sm">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-white uppercase mb-2">
                            {{ $groupLabels[$group] ?? ucfirst(str_replace('-', ' ', $group)) }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                            @foreach ($perms as $permission)
                                <label class="inline-flex items-start space-x-2 text-sm text-gray-700 dark:text-white">
                                    <input type="checkbox" value="{{ $permission->name }}" wire:model="rolePermissions"
                                        class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring focus:ring-indigo-200">
                                    <span>
                                        {{ $permission->description ?? \Illuminate\Support\Str::after($permission->name, $group . '.') }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cancelEdit" class="mr-3">Cancelar</x-secondary-button>
            <x-danger-button wire:click="update" wire:loading.attr="disabled">Actualizar Rol</x-danger-button>
            <div wire:loading wire:target="update" class="text-center">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60" />
            </div>
        </x-slot>
    </x-dialog-modal>
</div>

@push('js')
    <script>
        function confirmDeleteRole(role_id) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, bórralo!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteRole', role_id);
                }
            });
        }

        Livewire.on('roleDeleted', () => {
            Swal.fire({
                icon: "success",
                title: "Rol eliminado exitosamente",
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endpush

</div>
