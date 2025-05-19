<div wire:init="loadPeoples">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="px-6 py-4 flex items-center">

            <div class="flex items-center">
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
            @livewire('peoples.create-peoples')
        </div>
        @if (count($peoples))
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('id')">
                            Nro.
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-1-9 float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-up-9-1 float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('name')">
                            Nombre
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('last_name')">
                            Apellidos
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('email')">
                            Correo
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('phone')">
                            Telefono
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('birthdate')">
                            Fecha de Nacimiento
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('gender')">
                            Genero
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('photo')">
                            Foto
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('registration_date')">
                            Fecha de registro
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach ($peoples as $item)
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
                                {{ $item->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->phone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->birthdate }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->gender }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $item->photo) }}" alt="Foto" class="w-16 h-16 rounded-full object-cover">
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->registration_date }}
                            </td>
                            <td class="px-6 py-4 flex">
                                {{-- @livewire('users.edit-users', ['user' => $user], key($user->id)) --}}
                                <a class="btn btn-amber" wire:click="edit({{ $item }})">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <a class="btn btn-red ml-2" onclick="confirmDeletePeople({{ $item->id }})">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if ($peoples->hasPages())
                <div class="px-6 py-3">
                    {{ $peoples->links() }}
                </div>
            @endif
        @else
            <div class="text-red-400 px-6 py-4">
                No existe ningun registro coincidente!!!
            </div>
        @endif


    </div>

    <x-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            Editar 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombres" />
                <x-input type="text" class="w-full" wire:model.defer="peopleEdit.name" />
                <x-input-error for="peopleEdit.name" />
            </div>
            
            <div class="mb-4">
                <x-label value="Apellidos" />
                <x-input type="text" class="w-full" wire:model="peopleEdit.last_name" />
                <x-input-error for="peopleEdit.last_name" />
            </div>
            
            <div class="mb-4">
                <x-label value="Correo Electrónico" />
                <x-input type="email" class="w-full" wire:model="peopleEdit.email" />
                <x-input-error for="peopleEdit.email" />
            </div>
            
            <div class="mb-4">
                <x-label value="Teléfono" />
                <x-input type="text" class="w-full" wire:model="peopleEdit.phone" />
                <x-input-error for="peopleEdit.phone" />
            </div>
            
            <div class="mb-4">
                <x-label value="Fecha de Nacimiento" />
                <x-input type="date" class="w-full" wire:model="peopleEdit.birthdate" />
                <x-input-error for="peopleEdit.birthdate" />
            </div>
            
            <div class="mb-4">
                <x-label value="Género" />
                <select wire:model="peopleEdit.gender"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Seleccione</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
                <x-input-error for="peopleEdit.gender" />
            </div>
            
            <div class="mb-4">
                <x-label value="Fotografía" />
                <x-input type="file" class="w-full" wire:model="peopleEdit.photo" />
                <x-input-error for="peopleEdit.photo" />
            </div>
            
            @if (isset($peopleEdit['photo']) && is_object($peopleEdit['photo']))
                <div class="mt-2">
                    <span class="text-sm text-gray-600">Vista previa:</span>
                    <img src="{{ $peopleEdit['photo']->temporaryUrl() }}" alt="Vista previa de la foto" class="mt-1 rounded shadow-md"
                        style="max-width: 200px;">
                </div>
            @elseif ($people && $people->photo)
                <div class="mt-2">
                    <span class="text-sm text-gray-600">Foto actual:</span>
                    <img src="{{ Storage::url($people->photo) }}" alt="Foto actual" class="mt-1 rounded shadow-md"
                        style="max-width: 200px;">
                </div>
            @endif
            
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cancelEdit">
                Cancelar
            </x-secondary-button>
            <x-danger-button wire:click="update" class="ml-4" wire:loading.remove wire:target="update">
                Actualizar
            </x-danger-button>
            <div wire:loading wire:target="update" style="text-align: center;">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60">
            </div>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDeletePeople(people_id) {
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
                        @this.call('deletePeople', people_id);
                    }
                });
            }

            Livewire.on('peopleDeleted', () => {
                Swal.fire({
                    icon: "success",
                    title: "Personal eliminado exitosamente",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endpush

</div>

