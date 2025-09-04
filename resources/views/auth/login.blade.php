{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
 --}}
 <x-guest-layout>
    <style>
        html,
        body,
        #app {
            height: 100vh;
            margin: 0;
            padding: 0;
        }
    </style>

    <div class="w-screen h-screen flex flex-col md:flex-row items-center justify-center bg-white dark:bg-gray-900">

        <!-- Imagen -->
        <div
            class="w-full md:w-1/2 h-1/2 md:h-full flex justify-center items-center bg-gray-100 dark:bg-gray-800 p-4 mb-10 md:mb-0">
            <img src="{{ asset('img/undraw_remotely_2j6y.svg') }}" alt="Image"
                class="max-w-full max-h-full object-contain">
        </div>

        <!-- Formulario -->
        <div class="w-full md:w-1/2 h-1/2 md:h-full flex items-center justify-center px-4">
            <div class="w-full max-w-md">

                {{-- Validación --}}
                <x-validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 text-green-600 dark:text-green-400 text-sm font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-6 text-center">
                    <h3 class="text-3xl font-semibold mb-2 text-gray-900 dark:text-white">Iniciar sesión</h3>
                    <p class="text-gray-600 dark:text-gray-300">Ingresa a tu cuenta para continuar.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Correo Electrónico
                        </label>
                        <input type="email" id="email" name="email" required autofocus
                            value="{{ old('email') }}" placeholder="Ingrese su correo electrónico"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6c64fc] focus:border-[#6c64fc] dark:bg-gray-800 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Contraseña
                        </label>
                        <input type="password" id="password" name="password" required
                            placeholder="Ingrese su contraseña"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6c64fc] focus:border-[#6c64fc] dark:bg-gray-800 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center text-sm text-gray-700 dark:text-gray-300">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-[#6c64fc] shadow-sm focus:ring-[#6c64fc]" />
                            <span class="ml-2">Recordarme</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-[#6c64fc] hover:underline dark:text-blue-400">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-[#6c64fc] hover:bg-[#584ed9] text-white font-semibold py-3 rounded-md transition">
                            Iniciar sesión
                        </button>
                    </div>

                    <div class="text-center text-gray-500 dark:text-gray-400 my-6">
                        &mdash; o ingresa con &mdash;
                    </div>

                    <div class="flex justify-center space-x-6">
                        <!-- Iconos sociales -->
                        <a href="#"
                            class="text-[#6c64fc] hover:text-[#584ed9] dark:text-blue-400 dark:hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22 12a10 10 0 10-11.6 9.8v-6.9H8v-2.9h2.4V9.9c0-2.4 1.4-3.8 3.6-3.8 1 0 2 .1 2 .1v2.2h-1.1c-1.1 0-1.4.7-1.4 1.3v1.7h2.5l-.4 2.9H14v6.9A10 10 0 0022 12z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="text-[#6c64fc] hover:text-[#584ed9] dark:text-blue-400 dark:hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14.86 5.48 5.48 0 002.4-3.02 10.93 10.93 0 01-3.46 1.33 5.44 5.44 0 00-9.26 4.95A15.42 15.42 0 012 4.8a5.43 5.43 0 001.68 7.26 5.38 5.38 0 01-2.46-.68v.07a5.44 5.44 0 004.37 5.34 5.41 5.41 0 01-2.45.09 5.43 5.43 0 005.06 3.78A10.9 10.9 0 013 19.54 15.34 15.34 0 0010.29 21c7.54 0 11.68-6.25 11.68-11.67 0-.18 0-.35-.01-.53A8.3 8.3 0 0023 3z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="text-[#6c64fc] hover:text-[#584ed9] dark:text-blue-400 dark:hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M21.35 11.1h-9.18v2.99h5.5c-.23 1.38-1.42 4.05-5.5 4.05-3.31 0-6-2.73-6-6.1 0-3.37 2.7-6.1 6-6.1 1.88 0 3.15.8 3.88 1.48l2.65-2.55C16.67 5.46 14.62 4.5 12 4.5 6.49 4.5 2 8.96 2 14.5c0 5.52 4.48 10 10 10 5.8 0 9.62-4.06 9.62-9.79 0-.66-.07-1.15-.27-1.61z" />
                            </svg>
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-guest-layout>
