<div>
    <x-button wire:click="$set('open', true)">
        Crear Usuario
    </x-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear un Usuario
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre del usuario" />
                <x-input type="text" class="w-full" wire:model="name" />
                <x-input-error for="name" />
            </div>
            <div class="mb-4">
                <x-label value="Email del usuario" />
                <x-input type="email" class="w-full" wire:model="email" />
                <x-input-error for="email" />
            </div>
            <div class="mb-4">
                <x-label value="Contraseña del usuario" />
                <x-input type="password" class="w-full" wire:model="password" />
                <x-input-error for="password" />
            </div>
            <div class="mb-4">
                <x-label value="Confirmar contraseña del usuario" />
                <x-input type="password" class="w-full" wire:model="password_confirmation" />
            </div>
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
