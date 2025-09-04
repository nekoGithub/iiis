<div>
    <x-button class="bg-indigo-700 hover:bg-indigo-500 dark:bg-indigo-700 dark:text-white dark:hover:bg-indigo-500 focus:bg-indigo-700 dark:focus:bg-indigo-700 " wire:click="$set('open', true)">
        Crear Usuario
    </x-button>

    <x-dialog-modal wire:model="open" maxWidth="2xl">
        <x-slot name="title">
            Crear un Usuario
        </x-slot>
        <x-slot name="content">
            <div class="mb-6">
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="Nombre del usuario" />
                        <x-input type="text" class="w-full" wire:model="name" placeholder="Ingrese su nombre completo" />
                        <x-input-error for="name" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Email del usuario" />
                        <x-input type="email" class="w-full" wire:model="email" placeholder="Ingrese el usuario" />
                        <x-input-error for="email" />
                    </div>
                </div>

                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="Contraseña del usuario" />
                        <x-input type="password" class="w-full" wire:model="password" placeholder="Ingrese su contraseña" />
                        <x-input-error for="password" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Confirmar contraseña del usuario" />
                        <x-input type="password" class="w-full" wire:model="password_confirmation" placeholder="Vuelva a ingresar su contraseña" />
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mr-3">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="bg-indigo-700 hover:bg-indigo-500" wire:click="save" wire:loading.remove wire:target="save">
                Crear Usuario
            </x-danger-button>
            <div wire:loading wire:target="save" style="text-align: center;">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60">
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
