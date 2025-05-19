<div>
    <a class="btn btn-amber" wire:click="$set('open','true')">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar el usuario {{ $user->name }}
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre" />
                <x-input wire:model="userEdit.name" type="text" class="w-full" />
                <x-input-error for="userEdit.name" />
            </div>
            <div class="mb-4">
                <x-label value="Correo electronico" />
                <x-input wire:model="userEdit.email" type="email" class="w-full" />
                <x-input-error for="userEdit.email" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open','false')">
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
</div>
