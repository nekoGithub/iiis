<div>
    <x-button
        class="bg-indigo-700 hover:bg-indigo-500 dark:bg-indigo-700 dark:text-white dark:hover:bg-indigo-500 focus:bg-indigo-700 dark:focus:bg-indigo-700"
        wire:click="$set('open', true)">Crear Rol</x-button>

    <x-dialog-modal wire:model="open" maxWidth="2xl">
        <x-slot name="title">
            <h3 class="font-semibold mb-3 text-xl text-center">FORMULARIO DE REGISTRO DE ROLES</h3>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre del Rol" />
                <x-input type="text" wire:model="name" placeholder="Ingrese el nombre aqui..." class="w-full" />
                <x-input-error for="name" />
            </div>

            <div class="mb-4">
                <x-label value="Permisos organizados por módulo" class="mb-2" />

                @foreach ($permissions as $group => $perms)
                    <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-800 rounded shadow-sm">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-white uppercase mb-4">
                            {{ $groupLabels[$group] ?? ucfirst(str_replace('-', ' ', $group)) }}
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                            @foreach ($perms as $permission)
                                <label class="inline-flex items-start space-x-2 text-sm text-gray-700 dark:text-white">
                                    <input type="checkbox" value="{{ $permission->name }}" wire:model="userRoles"
                                        class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring focus:ring-indigo-200" />
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
            <x-secondary-button wire:click="$set('open', false)" class="mr-3">Cancelar</x-secondary-button>
            <x-danger-button class="bg-indigo-700 hover:bg-indigo-500" wire:click="save" wire:loading.remove wire:target="save">
                Crear Rol
            </x-danger-button>
            <div wire:loading wire:target="save" class="text-center">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60" />
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
