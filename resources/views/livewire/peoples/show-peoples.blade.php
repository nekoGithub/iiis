<div wire:init="loadPeoples">
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
            @can('admin.peoples.create')
                @livewire('peoples.create-peoples')
            @endcan
        </div>
        @if (count($peoples))
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
                            wire:click="order('last_name')">
                            Apellidos
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
                            wire:click="order('phone')">
                            Telefono
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('birthdate')">
                            Fecha de Nacimiento
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('gender')">
                            Genero
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('photo')">
                            Foto
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            wire:click="order('registration_date')">
                            Fecha de registro
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
                                <img src="{{ asset('storage/' . $item->photo) }}" alt="Foto"
                                    class="w-16 h-16 rounded-full object-cover">
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->registration_date }}
                            </td>
                            <td class="px-6 py-4 flex">
                                @can('admin.peoples.edit')
                                    <a class="btn bg-indigo-600" wire:click="edit({{ $item }})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endcan
                                @can('admin.peoples.destroy')
                                    <a class="btn btn-red ml-2" onclick="confirmDeletePeople({{ $item->id }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                @endcan
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
    <x-dialog-modal wire:model="openEdit" maxWidth="2xl">
        <x-slot name="title">
            <h3 class="font-semibold mb-3 text-xl text-center">FORMULARIO DE EDICIÓN</h3>
        </x-slot>

        <x-slot name="content">
            <!-- Datos Personales -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Datos Personales</h3>
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="Nombres" />
                        <x-input type="text" wire:model.lazy="peopleEdit.name" class="w-full" />
                        <x-input-error for="peopleEdit.name" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Apellidos" />
                        <x-input type="text" wire:model.lazy="peopleEdit.last_name" class="w-full" />
                        <x-input-error for="peopleEdit.last_name" />
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="CI / Documento de identidad" />
                        <x-input type="text" wire:model.lazy="peopleEdit.ci" class="w-full" />
                        <x-input-error for="peopleEdit.ci" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Fecha de nacimiento" />
                        <x-input type="date" wire:model.lazy="peopleEdit.birthdate" class="w-full" />
                        <x-input-error for="peopleEdit.birthdate" />
                    </div>
                </div>
                <div class="flex gap-4 mb-4 items-end">
                    <div class="w-1/2">
                        <x-label value="Género" />
                        <div class="flex space-x-4 mt-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model.lazy="peopleEdit.gender" value="masculino"
                                    class="text-indigo-600" />
                                <span>Masculino</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model.lazy="peopleEdit.gender" value="femenino"
                                    class="text-indigo-600" />
                                <span>Femenino</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model.lazy="peopleEdit.gender" value="otro"
                                    class="text-indigo-600" />
                                <span>Otro</span>
                            </label>
                        </div>
                        <x-input-error for="peopleEdit.gender" />
                    </div>
                </div>
            </div>

            <!-- Fotografía -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Fotografía
                    <h2 class="text-sm mb-3 text-indigo-700 dark:text-white">
                        Carga archivos en formato .png o .jpg
                    </h2>
                </h3>
                <div class="flex flex-col items-center justify-center gap-3">
                    <x-input type="file" wire:model="peopleEdit.photo" class="w-1/2 cursor-pointer"
                        accept=".png, .jpg" />
                    <x-input-error for="peopleEdit.photo" />
                    @if (isset($peopleEdit['photo']) && is_object($peopleEdit['photo']))
                        <div class="mt-2 text-center">
                            <span class="text-sm text-gray-600 dark:text-white">Vista previa:</span>
                            <img src="{{ $peopleEdit['photo']->temporaryUrl() }}"
                                class="mt-1 rounded shadow-md w-32 h-32 object-cover" />
                        </div>
                    @elseif ($people?->photo)
                        <div class="mt-2 text-center">
                            <span class="text-sm text-gray-600 dark:text-white">Foto actual:</span>
                            <img src="{{ Storage::url($people->photo) }}"
                                class="mt-1 rounded shadow-md w-32 h-32 object-cover" />
                        </div>
                    @endif
                </div>
            </div>

            <!-- Separador -->
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
                <div class="mx-4 w-3 h-3 bg-indigo-600 rounded-full dark:bg-indigo-400"></div>
                <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
            </div>

            <!-- Contacto -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Contacto</h3>
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="Correo Electrónico" />
                        <x-input type="email" wire:model.lazy="peopleEdit.email" class="w-full" />
                        <x-input-error for="peopleEdit.email" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Teléfono" />
                        <x-input type="text" wire:model.lazy="peopleEdit.phone" class="w-full" />
                        <x-input-error for="peopleEdit.phone" />
                    </div>
                </div>
                <div class="mb-4">
                    <x-label value="Dirección" />
                    <x-input type="text" wire:model.lazy="peopleEdit.address" class="w-full" />
                    <x-input-error for="peopleEdit.address" />
                </div>
            </div>

            <!-- Tipo de persona -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Tipo de Persona</h3>
                <div class="flex space-x-6">
                    <label class="flex items-center space-x-2">
                        <input type="radio" wire:model.live="peopleEdit.type" value="estudiante"
                            class="text-indigo-600" />
                        <span>Estudiante</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" wire:model.live="peopleEdit.type" value="docente"
                            class="text-indigo-600" />
                        <span>Docente</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" wire:model.live="peopleEdit.type" value="administrativo"
                            class="text-indigo-600" />
                        <span>Administrativo</span>
                    </label>
                </div>
                <x-input-error for="peopleEdit.type" />
            </div>

            <!-- Datos Estudiantiles -->
            @if ($isStudent)
                <div class="mb-6">
                    <h3 class="font-semibold mb-3 text-lg">Datos Estudiantiles</h3>
                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <x-label value="Semestre" />
                            <select wire:model.lazy="studentFields.semester"
                                class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Seleccione semestre...</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}º semestre</option>
                                @endfor
                            </select>
                            <x-input-error for="studentFields.semester" />
                        </div>
                        <div class="w-1/2">
                            <x-label value="Número de Matrícula" />
                            <x-input type="text" wire:model.lazy="studentFields.enrollment_number"
                                class="w-full" />
                            <x-input-error for="studentFields.enrollment_number" />
                        </div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <x-label value="Nombre del Tutor o Apoderado" />
                            <x-input type="text" wire:model.lazy="studentFields.guardian_name" class="w-full" />
                            <x-input-error for="studentFields.guardian_name" />
                        </div>
                        <div class="w-1/2">
                            <x-label value="Teléfono del Tutor" />
                            <x-input type="text" wire:model.lazy="studentFields.guardian_phone" class="w-full" />
                            <x-input-error for="studentFields.guardian_phone" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-label value="Estado del Estudiante" />
                        <div class="flex space-x-4 mt-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model.lazy="studentFields.status" value="activo" />
                                <span>Activo</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model.lazy="studentFields.status" value="retirado" />
                                <span>Retirado</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model.lazy="studentFields.status" value="egresado" />
                                <span>Egresado</span>
                            </label>
                        </div>
                        <x-input-error for="studentFields.status" />
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cancelEdit" class="mr-3">Cancelar</x-secondary-button>
            <x-danger-button class="bg-indigo-700 hover:bg-indigo-500" wire:click="update" wire:loading.remove
                wire:target="update">Actualizar</x-danger-button>
            <div wire:loading wire:target="update" class="text-center">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60" />
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
