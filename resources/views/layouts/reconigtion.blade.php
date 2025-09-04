<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Carga Tailwind CSS y tu CSS/JS con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles (si usas Livewire) -->
    @livewireStyles

    <!-- Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- ApexCharts para los gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0"></script>

    <!-- Carga adicional de CSS que hayas apilado -->
    @stack('css')
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-800">

    {{ $slot }}

    <!-- Livewire Scripts (si usas Livewire) -->
    @livewireScripts
    <!-- Carga adicional de JS que hayas apilado -->
    @stack('css')
    @stack('js')

</body>

</html>
