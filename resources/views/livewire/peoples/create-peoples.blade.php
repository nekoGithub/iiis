<div>
    <x-button wire:click="$set('open', true)">
        Crear Personal
    </x-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear Personal
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombres" />
                <x-input type="text" class="w-full" wire:model="name" />
                <x-input-error for="name" />
            </div>
            <div class="mb-4">
                <x-label value="Apellidos" />
                <x-input type="text" class="w-full" wire:model="last_name" />
                <x-input-error for="last_name" />
            </div>
            <div class="mb-4">
                <x-label value="Correo Electronico" />
                <x-input type="email" class="w-full" wire:model="email" />
                <x-input-error for="email" />
            </div>
            <div class="mb-4">
                <x-label value="Telefono" />
                <x-input type="text" class="w-full" wire:model="phone" />
                <x-input-error for="phone" />
            </div>
            <div class="mb-4">
                <x-label value="Fecha de Nacimiento" />
                <x-input type="date" class="w-full" wire:model="birthdate" />
                <x-input-error for="birthdate" />
            </div>
            <div class="mb-4">
                <x-label value="Fecha de Nacimiento" />
                <select wire:model="gender"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Selecccione aqui...</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
                <x-input-error for="gender" />
            </div>
            <div class="mb-4">
                <x-label value="Fotografia" />
                <x-input type="file" class="w-full" wire:model="photo" />
                <x-input-error for="photo" />
            </div>
            @if ($photo)
                <div class="mt-2">
                    <span class="text-sm text-gray-600">Vista previa:</span>
                    <img src="{{ $photo->temporaryUrl() }}" alt="Vista previa de la foto" class="mt-1 rounded shadow-md"
                        style="max-width: 200px;">
                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mr-3">
                Cancelar
            </x-secondary-button>
            <x-danger-button wire:click="save" wire:loading.remove wire:target="save">
                Crear Usuario
            </x-danger-button>
            <div wire:loading wire:target="save" style="text-align: center;">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60">
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
