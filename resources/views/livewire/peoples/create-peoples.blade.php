<div>
    <x-button class="bg-indigo-700 hover:bg-indigo-500 dark:bg-indigo-700 dark:text-white dark:hover:bg-indigo-500 focus:bg-indigo-700 dark:focus:bg-indigo-700 " wire:click="$set('open', true)">Crear Personal</x-button>

    <x-dialog-modal wire:model="open" maxWidth="2xl">
        <x-slot name="title">
            <h3 class="font-semibold mb-3 text-xl text-center">FORMULARIO DE REGISTRO</h3>
        </x-slot>

        <x-slot name="content">
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Datos Personales</h3>

                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="Nombres" />
                        <x-input type="text" wire:model="name" placeholder="Ingrese sus nombres" class="w-full" />
                        <x-input-error for="name" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Apellidos" />
                        <x-input type="text" wire:model="last_name" placeholder="Ingrese sus apellidos"
                            class="w-full" />
                        <x-input-error for="last_name" />
                    </div>
                </div>

                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="CI / Documento de identidad" />
                        <x-input type="text" wire:model="ci" placeholder="Ingrese número de CI" class="w-full" />
                        <x-input-error for="ci" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Fecha de nacimiento" />
                        <x-input type="date" wire:model="birthdate" class="w-full" />
                        <x-input-error for="birthdate" />
                    </div>
                </div>

                <div class="flex gap-4 mb-4 items-end">
                    <div class="w-1/2">
                        <x-label value="Género" />
                        <div class="flex space-x-4 mt-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model="gender" value="masculino" class="text-indigo-600" />
                                <span>Masculino</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model="gender" value="femenino" class="text-indigo-600" />
                                <span>Femenino</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model="gender" value="otro" class="text-indigo-600" />
                                <span>Otro</span>
                            </label>
                        </div>
                        <x-input-error for="gender" />
                    </div>
                </div>
                <div class="mb-6">
                    <h3 class="font-semibold mb-3 text-lg">Fotografía <h2 class="text-sm mb-3 text-indigo-700 dark:text-white">Carga archivos en formato .png o .jpg</h2></h3>

                    <div class="flex flex-col items-center justify-center gap-3">
                        <x-input type="file" wire:model="photo" class="w-1/2 cursor-pointer" accept=".png, .jpg" />
                        <x-input-error for="photo" />

                        @if ($photo)
                            <div class="mt-2 text-center">
                                <span class="text-sm text-gray-600 dark:text-white">Vista previa:</span>
                                <div class="mt-1">
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Vista previa"
                                        class="rounded shadow-md w-32 h-32 object-cover" />
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Separador visual -->
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
                        <x-input type="email" wire:model="email" placeholder="Ingrese su correo" class="w-full" />
                        <x-input-error for="email" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Teléfono" />
                        <x-input type="text" wire:model="phone" placeholder="Ingrese su teléfono o celular"
                            class="w-full" />
                        <x-input-error for="phone" />
                    </div>
                </div>

                <div class="mb-4">
                    <x-label value="Dirección" />
                    <x-input type="text" wire:model="address" placeholder="Ingrese su dirección" class="w-full" />
                    <x-input-error for="address" />
                </div>
            </div>

            <!-- Tipo de persona -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Tipo de Persona</h3>

                <div class="flex space-x-6">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" wire:model.live="type" value="estudiante" class="text-indigo-600" />
                        <span>Estudiante</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" wire:model.live="type" value="docente" class="text-indigo-600" />
                        <span>Docente</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" wire:model.live="type" value="administrativo"
                            class="text-indigo-600" />
                        <span>Administrativo</span>
                    </label>
                </div>
                <x-input-error for="type" />
            </div>

            <!-- Datos Estudiantiles -->
            @if ($type === 'estudiante')
                <div class="mb-6">
                    <h3 class="font-semibold mb-3 text-lg">Datos Estudiantiles</h3>

                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <x-label value="Semestre" />
                            <select wire:model="semester"
                                class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Seleccione semestre...</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}º semestre</option>
                                @endfor
                            </select>
                            <x-input-error for="semester" />
                        </div>

                        <div class="w-1/2">
                            <x-label value="Número de Matrícula" />
                            <x-input type="text" wire:model="enrollment_number" placeholder="Ej. 200036492"
                                class="w-full" />
                            <x-input-error for="enrollment_number" />
                        </div>
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <x-label value="Nombre del Tutor o Apoderado" />
                            <x-input type="text" wire:model="guardian_name" placeholder="Nombre del responsable"
                                class="w-full" />
                            <x-input-error for="guardian_name" />
                        </div>
                        <div class="w-1/2">
                            <x-label value="Teléfono del Tutor" />
                            <x-input type="text" wire:model="guardian_phone" placeholder="Ej. 76543210"
                                class="w-full" />
                            <x-input-error for="guardian_phone" />
                        </div>
                    </div>

                    <div class="mb-4">

                        <x-label value="Estado" />
                        <div class="flex space-x-4 mt-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model="status" value="activo" class="text-indigo-600" checked/>
                                <span>Activo</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model="status" value="retirado"
                                    class="text-indigo-600" />
                                <span>Retirado</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" wire:model="status" value="egresado"
                                    class="text-indigo-600" />
                                <span>Egresado</span>
                            </label>
                        </div>
                        <x-input-error for="status" />
                    </div>

                </div>
            @endif

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mr-3">Cancelar</x-secondary-button>
            <x-danger-button class="bg-indigo-700 hover:bg-indigo-500"  wire:click="save" wire:loading.remove wire:target="save">Crear Usuario</x-danger-button>
            <div wire:loading wire:target="save" class="text-center">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60" />
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
