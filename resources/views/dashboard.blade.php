{{-- <x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6 dark:bg-gray-900">
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Bienvenido, {{ auth()->user()->name }}
                    </h2>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            class="text-sm text-gray-700 dark:text-white hover:text-blue-500 dark:hover:text-blue-400 transition-colors duration-200">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div
            class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-center dark:bg-gray-900">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                Número de tarjetas RFID | 206
            </h2>
        </div>
    </div>
</x-admin-layout> --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">

    <div class="flex flex-wrap lg:flex-nowrap gap-4">
        <!-- Componente 1: Clicks y CPC con gráfico de líneas -->
        <div class="w-full lg:w-[60%]">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 md:p-6">
                <div class="flex justify-between mb-5">
                    <div class="grid gap-4 grid-cols-2">
                        <div>
                            <h5
                                class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                Clicks
                                <!-- Tooltip -->
                                <svg data-popover-target="clicks-info" data-popover-placement="bottom"
                                    class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <div data-popover id="clicks-info" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                    <div class="p-3 space-y-2">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Clicks growth -
                                            Incremental</h3>
                                        <p>Report helps navigate cumulative growth of community activities...</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </h5>
                            <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">42,3k</p>
                        </div>
                        <div>
                            <h5
                                class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                CPC
                                <!-- Tooltip -->
                                <svg data-popover-target="cpc-info" data-popover-placement="bottom"
                                    class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <div data-popover id="cpc-info" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                    <div class="p-3 space-y-2">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">CPC growth - Incremental
                                        </h3>
                                        <p>Report helps navigate cumulative growth of community activities...</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </h5>
                            <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">$5.40</p>
                        </div>
                    </div>
                    <div>
                        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                            data-dropdown-placement="bottom" type="button"
                            class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Semana pasada
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="line-chart"></div>
                <div class="flex justify-end border-t border-gray-200 dark:border-gray-700 mt-2.5 pt-5">
                    <a href="#"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 inline-flex items-center">
                        <svg class="w-3.5 h-3.5 text-white me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 20">
                            <path
                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Z" />
                        </svg>
                        Ver el informe completo
                    </a>
                </div>
            </div>
        </div>


        <!-- Componente 2: Website traffic con gráfico de pastel -->
        <div class="w-full lg:w-[40%]">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 md:p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h5 class="text-xl font-bold text-gray-900 dark:text-white mb-2 flex items-center">
                            Tráfico del sitio web
                            <svg data-popover-target="chart-info" data-popover-placement="bottom"
                                class="w-3.5 h-3.5 text-gray-500 hover:text-gray-900 dark:hover:text-white ms-1"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Z" />
                            </svg>
                        </h5>
                    </div>
                    <button id="widgetDropdownButton" data-dropdown-toggle="widgetDropdown" type="button"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <!-- Icono -->
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 3">
                            <path
                                d="M2 0a1.5 1.5 0 1 1 0 3A1.5 1.5 0 0 1 2 0ZM8 0a1.5 1.5 0 1 1 0 3A1.5 1.5 0 0 1 8 0ZM14 0a1.5 1.5 0 1 1 0 3A1.5 1.5 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
                <div class="py-6 h-[420px]" id="pie-chart"></div>
                <div class="grid grid-cols-1 border-t border-gray-200 dark:border-gray-700 pt-5">
                    <div class="flex justify-between items-center">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                            class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white inline-flex items-center">
                            Ultimos 7 días
                            <svg class="w-2.5 h-2.5 ms-1.5" viewBox="0 0 10 6" fill="none">
                                <path d="M1 1l4 4 4-4" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" />
                            </svg>
                        </button>
                        <a href="#"
                            class="text-sm font-semibold text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 inline-flex items-center">
                            Análisis de tráfico
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" viewBox="0 0 6 10" fill="none">
                                <path d="M1 9l4-4-4-4" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Fila 1 -->
    <!-- Fila 1 -->
   <div class="flex flex-col md:flex-row w-full h-full gap-6 p-6 max-w-full mx-auto">

    <!-- Gráfico de usuarios -->
    <div class="flex-1 bg-white rounded-lg shadow-lg dark:bg-gray-800 p-6 h-[400px] flex flex-col">
        <!-- Encabezado -->
        <div class="flex justify-between items-start mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Usuarios últimos 7 días</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Leads generated per week</p>
            </div>
            <div>
                <span
                    class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                    <svg class="w-3 h-3 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 14" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    42.5%
                </span>
            </div>
        </div>

        <!-- Estadísticas pequeñas -->
        <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
            <div class="flex items-center">
                <dt class="text-gray-500 dark:text-gray-400 font-normal me-1">Money spent:</dt>
                <dd class="text-gray-900 dark:text-white font-semibold">$3,232</dd>
            </div>
            <div class="flex items-center justify-end">
                <dt class="text-gray-500 dark:text-gray-400 font-normal me-1">Conversion rate:</dt>
                <dd class="text-gray-900 dark:text-white font-semibold">1.2%</dd>
            </div>
        </div>

        <!-- Gráfico -->
        <div id="column-chart" class="flex-grow w-full"></div>

        <!-- Footer -->
        <div class="flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-3 mt-4 text-sm">
            <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                data-dropdown-placement="bottom"
                class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white inline-flex items-center"
                type="button">
                Last 7 days
                <svg class="w-3 h-3 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <a href="#"
                class="uppercase font-semibold text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded px-3 py-1 inline-flex items-center">
                Leads Report
                <svg class="w-3 h-3 ms-1 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m1 9 4-4-4-4" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Gráfico ingresos/egresos -->
    <div class="flex-1 bg-white rounded-lg shadow-lg dark:bg-gray-800 p-6 h-[400px] flex flex-col">
        <h2 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Ingresos y Gastos últimos 6 meses</h2>
        <div id="bar-chart" class="flex-grow w-full"></div>
    </div>

    <!-- Progreso del equipo -->
    <div class="w-full md:w-[300px] bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6 h-[520px] overflow-y-auto">
        <!-- Aquí permanece exactamente como lo tenías, sin cambios -->
        <!-- Progreso del equipo original completo sin modificaciones -->
        <!-- (No se incluye nuevamente aquí por espacio, pero no es necesario modificar nada) -->
        <!-- Puedes dejar igual tu tercer bloque tal cual lo tenías -->
        <!-- Solo asegúrate de mantener los paddings y el tamaño en md:w-[300px] -->
    </div>

</div>





    @push('js')
        <script>
            // ------------------- Gráfico 1: Columnas -------------------
            const usersPorDia = @json($usersPorDia);

            function obtenerEtiqueta(fechaStr) {
                const dias = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
                const f = new Date(fechaStr + 'T12:00:00');
                return `${dias[f.getDay()]} ${String(f.getDate()).padStart(2, '0')}/${String(f.getMonth() + 1).padStart(2, '0')}`;
            }
            const chartData = usersPorDia.map((u, i) => ({
                x: obtenerEtiqueta(u.fecha),
                y: u.cantidad === 0 ? 0.5 : u.cantidad,
                fillColor: i % 2 === 0 ? "#1A56DB" : "#FDBA8C"
            }));
            const optionsColumn = {
                series: [{
                    name: "Usuarios",
                    data: chartData
                }],
                chart: {
                    type: "bar",
                    height: "100%",
                    width: "100%",
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "70%",
                        borderRadiusApplication: "end",
                        borderRadius: 8,
                    },
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: (val, opts) => {
                            const cantidadReal = usersPorDia[opts.dataPointIndex].cantidad;
                            return cantidadReal === 0 ? 'Sin registros' : `${cantidadReal} usuarios`;
                        }
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    show: false
                },
                grid: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                fill: {
                    opacity: 1
                },
            };

            // ------------------- Gráfico 2: Barras -------------------
            const optionsBar = {
                series: [{
                        name: "Income",
                        color: "#31C48D",
                        data: ["1420", "1620", "1820", "1420", "1650", "2120"]
                    },
                    {
                        name: "Expense",
                        data: ["788", "810", "866", "788", "1100", "1200"],
                        color: "#F05252"
                    },
                ],
                chart: {
                    type: "bar",
                    height: '100%',
                    width: '100%',
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: false
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        columnWidth: "100%",
                        borderRadius: 6,
                        borderRadiusApplication: "end",
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: (val) => "$" + val
                    }
                },
                legend: {
                    show: true,
                    position: "bottom"
                },
                xaxis: {
                    categories: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    labels: {
                        style: {
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        },
                        formatter: (val) => "$" + val
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -20
                    }
                },
                fill: {
                    opacity: 1
                }
            };

            // ------------------- Gráfico 3: Líneas -------------------
            const optionsLine = {
                chart: {
                    height: "100%",
                    maxWidth: "100%",
                    type: "line",
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 6,
                    curve: 'smooth'
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -26
                    }
                },
                series: [{
                        name: "Clicks",
                        data: [6500, 6418, 6456, 6526, 6356, 6456],
                        color: "#1A56DB"
                    },
                    {
                        name: "CPC",
                        data: [6456, 6356, 6526, 6332, 6418, 6500],
                        color: "#7E3AF2"
                    },
                ],
                xaxis: {
                    categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb'],
                    labels: {
                        style: {
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    show: false
                },
                legend: {
                    show: false
                }
            };

            // Opciones para gráfico de pastel (pie)
            const getPieChartOptions = () => {
                return {
                    series: [52.8, 26.8, 20.4],
                    colors: ["#1C64F2", "#16BDCA", "#9061F9"],
                    chart: {
                        height: 420,
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -25
                            }
                        },
                    },
                    labels: ["Direct", "Organic search", "Referrals"],
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif"
                        },
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                };
            };

            // Opciones para gráfico radial (radialBar)
            const getRadialChartOptions = () => {
                return {
                    series: [90, 85, 70],
                    colors: ["#1C64F2", "#16BDCA", "#FDBA8C"],
                    chart: {
                        height: "350px",
                        width: "100%",
                        type: "radialBar",
                        sparkline: {
                            enabled: true
                        },
                    },
                    plotOptions: {
                        radialBar: {
                            track: {
                                background: '#E5E7EB'
                            },
                            dataLabels: {
                                show: false
                            },
                            hollow: {
                                margin: 0,
                                size: "32%"
                            },
                        },
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -23,
                            bottom: -20
                        },
                    },
                    labels: ["Done", "In progress", "To do"],
                    legend: {
                        show: true,
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                    tooltip: {
                        enabled: true,
                        x: {
                            show: false
                        }
                    },
                    yaxis: {
                        show: false,
                        labels: {
                            formatter: (value) => value + '%'
                        },
                    },
                };
            };

            // Renderizado de gráficos
            if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
                const radialChart = new ApexCharts(document.getElementById("radial-chart"), getRadialChartOptions());
                radialChart.render();
            }

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const pieChart = new ApexCharts(document.getElementById("pie-chart"), getPieChartOptions());
                pieChart.render();
            }

            // Renderizar los tres gráficos
            if (document.getElementById("column-chart")) new ApexCharts(document.getElementById("column-chart"), optionsColumn)
                .render();
            if (document.getElementById("bar-chart")) new ApexCharts(document.getElementById("bar-chart"), optionsBar).render();
            if (document.getElementById("line-chart")) new ApexCharts(document.getElementById("line-chart"), optionsLine)
                .render();
        </script>
    @endpush

</x-admin-layout>
