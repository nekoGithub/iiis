<div wire:init="loadUsers">
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
            @can('admin.users.create')
                @livewire('users.create-users')
            @endcan
        </div>
        @if (count($users))
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
                            Nombre
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('email')">
                            Correo
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('created_at')">
                            Fecha Creación
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Roles
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Creado
                        </th>
                        <th scope="col"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Accciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
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
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->created_at }}
                            </td>
                            <td>
                                @foreach ($item->roles as $role)
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-indigo-600 rounded-full">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 flex">
                                @can('admin.users.edit')
                                    <a class="btn bg-indigo-600" wire:click="edit({{ $item }})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endcan

                                @can('admin.users.destroy')
                                    <a class="btn btn-red ml-2" onclick="confirmDeleteUser({{ $item->id }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if ($users->hasPages())
                <div class="px-6 py-3">
                    {{ $users->links() }}
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
            Editar el usuario {{ $userEdit['name'] ?? '' }}
        </x-slot>
        <x-slot name="content">
            <div class="mb-6">
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="Nombre" />
                        <x-input wire:model="userEdit.name" type="text" class="w-full" />
                        <x-input-error for="userEdit.name" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Correo electrónico" />
                        <x-input wire:model="userEdit.email" type="email" class="w-full" />
                        <x-input-error for="userEdit.email" />
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <x-label value="Roles del Usuario" />
                <div class="grid grid-cols-2 gap-3 mt-2">
                    @foreach ($roles as $role)
                        <label class="inline-flex items-center">
                            <input type="checkbox" value="{{ $role->name }}" wire:model="userRoles"
                                class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring focus:ring-indigo-200">
                            <span class="ml-2 text-sm text-gray-700 dark:text-white">{{ ucfirst($role->name) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>



        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cancelEdit">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="bg-indigo-700 hover:bg-indigo-500 ml-4" wire:click="update" wire:loading.remove
                wire:target="update">
                Actualizar
            </x-danger-button>
            <div wire:loading wire:target="update" style="text-align: center;">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60">
            </div>
        </x-slot>
    </x-dialog-modal>


    @push('js')
        <script>
            function confirmDeleteUser(user_id) {
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
                        @this.call('deleteUser', user_id);
                    }
                });
            }

            Livewire.on('userDeleted', () => {
                Swal.fire({
                    icon: "success",
                    title: "Usuario eliminado exitosamente",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endpush

</div>
