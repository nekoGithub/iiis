<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">

    <div class="flex flex-col lg:flex-row gap-4">
        <!-- Gráfico 1: Accesos por tipo (línea) -->
        <div class="w-full lg:w-3/5">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-5 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                            Acceso del personal (últimos 6 días)
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Estudiantes, Docentes y Administrativos
                        </p>
                    </div>
                </div>

                <div id="line-chart" class="w-full min-h-[280px] sm:min-h-[320px] md:min-h-[350px]"></div>
            </div>
        </div>

        <!-- Gráfico 2: Personal Registrado (pastel) -->
        <div class="w-full lg:w-2/5">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 md:p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h5 class="text-xl font-bold text-gray-900 dark:text-white mb-2 flex items-center">
                            Total personal registrado
                            <svg data-popover-target="chart-info" data-popover-placement="bottom"
                                class="w-3.5 h-3.5 text-gray-500 hover:text-gray-900 dark:hover:text-white ms-1"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Z" />
                            </svg>
                        </h5>
                    </div>
                    <button id="widgetDropdownButton" data-dropdown-toggle="widgetDropdown" type="button"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 3">
                            <path
                                d="M2 0a1.5 1.5 0 1 1 0 3A1.5 1.5 0 0 1 2 0ZM8 0a1.5 1.5 0 1 1 0 3A1.5 1.5 0 0 1 8 0ZM14 0a1.5 1.5 0 1 1 0 3A1.5 1.5 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
                <div class="py-6 h-[320px] md:h-[380px]" id="pie-chart"></div>
                <div class="grid grid-cols-1 border-t border-gray-200 dark:border-gray-700 pt-5">
                    <div class="flex justify-between items-center">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                            class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white inline-flex items-center">
                            Últimos 7 días
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

    <!-- Fila 1: Otros gráficos -->
    <div class="flex flex-col md:flex-row w-full gap-6 p-6 max-w-full mx-auto">

        <!-- Gráfico 3: Usuarios últimos 7 días (columnas) -->
        <div
            class="w-full md:flex-1 bg-white rounded-lg shadow-lg dark:bg-gray-800 p-4 h-[320px] sm:h-[360px] md:h-[400px]">
            <h2 class="text-lg font-semibold mb-5 text-gray-900 dark:text-white">Usuarios registrados en la semana</h2>
            <div id="column-chart" class="w-full h-full"></div>
        </div>

        <!-- Gráfico 4: Accesos últimos 6 meses (barra horizontal) -->
        <div
            class="w-full md:flex-1 bg-white rounded-lg shadow-lg dark:bg-gray-800 p-4 h-[360px] sm:h-[400px] md:h-[420px] mb-8">
            <h2 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Accesos de personal (últimos 6 meses)</h2>
            <div id="bar-chart" class="w-full h-full"></div>
        </div>

        <!-- Progreso del equipo (radial chart) -->
        <div
            class="w-full md:w-[300px] bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6 h-[480px] sm:h-[500px] md:h-[520px] overflow-y-auto mt-5">

            <div class="flex justify-between mb-3">
                <div class="flex items-center">
                    <div class="flex justify-center items-center">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Numero de
                            registrados</h5>
                        <!-- Icono info -->
                        <svg data-popover-target="chart-info" data-popover-placement="bottom"
                            class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                <div class="grid grid-cols-3 gap-3 mb-2">
                    <dl
                        class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                            {{ $datosPie[0] ?? 0 }}
                        </dt>
                        <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">
                            {{ ucfirst($tipos[0] ?? 'To do') }}
                        </dd>
                    </dl>
                    <dl
                        class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                            {{ $datosPie[1] ?? 0 }}
                        </dt>
                        <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">
                            {{ ucfirst($tipos[1] ?? 'In progress') }}
                        </dd>
                    </dl>
                    <dl
                        class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                            {{ $datosPie[2] ?? 0 }}
                        </dt>
                        <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">
                            {{ ucfirst($tipos[2] ?? 'Done') }}
                        </dd>
                    </dl>
                </div>

            </div>
            <div class="flex justify-center mb-3">
                <div class="flex items-center">
                    <div class="flex justify-center items-center">
                        <h5 class="text-md font-bold leading-none text-gray-900 dark:text-white pe-1 text-indigo-700">
                            Carrera de registros</h5>

                    </div>
                </div>
            </div>
            <div class="flex justify-center mb-3">
                <div class="flex items-center">
                    <div class="flex justify-center items-center">
                        <h5 class="text-xs font-bold leading-none text-gray-900 dark:text-white pe-1 text-indigo-700">
                            Cantidad de accesos HOY</h5>

                    </div>
                </div>
            </div>
            <!-- Radial Chart -->
            <div class="py-4" id="radial-chart"></div>
        </div>
    </div>

    @push('js')
        <script>
            // ------------------- Gráfico 3: Usuarios últimos 7 días (columnas) -------------------
            const usersPorDia = @json($usersPorDia);

            // Función para formatear fechas en etiquetas del gráfico de usuarios por día
            function obtenerEtiqueta(fechaStr) {
                const dias = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
                const f = new Date(fechaStr + 'T12:00:00');
                return `${dias[f.getDay()]} ${String(f.getDate()).padStart(2, '0')}/${String(f.getMonth() + 1).padStart(2, '0')}`;
            }

            // Preparar datos para gráfico de usuarios por día (columnas)
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

            if (document.getElementById("column-chart")) {
                new ApexCharts(document.getElementById("column-chart"), optionsColumn).render();
            }
        </script>

        <script>
            // ------------------- Gráfico 4: Accesos últimos 6 meses (barra horizontal) -------------------
            const accesosPorMes = @json($accesosPorMes);

            // Extraer datos para entradas, salidas y meses
            const entradas = accesosPorMes.map(item => item.entradas);
            const salidas = accesosPorMes.map(item => item.salidas);
            const meses = accesosPorMes.map(item => item.mes);

            const optionsBar = {
                series: [
                    {
                        name: "Entradas",
                        data: entradas,
                        color: "#31C48D" // Verde
                    },
                    {
                        name: "Salidas",
                        data: salidas,
                        color: "#F05252" // Rojo
                    }
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
                        formatter: val => `${val} accesos`
                    }
                },
                legend: {
                    show: true,
                    position: "bottom"
                },
                xaxis: {
                    categories: meses,
                    labels: {
                        style: {
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
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

            if (document.getElementById("bar-chart")) {
                new ApexCharts(document.getElementById("bar-chart"), optionsBar).render();
            }
        </script>

        <script>
            // ------------------- Gráfico 1: Accesos por tipo (línea) -------------------
            const etiquetasLinea = @json($etiquetas);
            const datosLinea = @json($datosLinea);

            const optionsLine = {
                chart: {
                    type: "line",
                    height: "100%",
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    width: 4,
                    curve: "smooth"
                },
                dataLabels: {
                    enabled: false
                },
                series: [
                    {
                        name: "Estudiante",
                        data: datosLinea.estudiante,
                        color: "#1C64F2"
                    },
                    {
                        name: "Docente",
                        data: datosLinea.docente,
                        color: "#7E3AF2"
                    },
                    {
                        name: "Administrativo",
                        data: datosLinea.administrativo,
                        color: "#FDBA8C"
                    }
                ],
                xaxis: {
                    categories: etiquetasLinea,
                    labels: {
                        rotate: -45,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif',
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    tickPlacement: 'on'
                },
                grid: {
                    padding: {
                        bottom: 20
                    }
                },
                tooltip: {
                    shared: true,
                    y: {
                        formatter: val => `${val} accesos`
                    }
                },
                legend: {
                    show: true,
                    position: "bottom"
                }
            };

            if (document.getElementById("line-chart")) {
                new ApexCharts(document.getElementById("line-chart"), optionsLine).render();
            }
        </script>

        <script>
            // ------------------- Gráfico 2: Personal Registrado (pastel) -------------------
            const tipos = @json($tipos);
            const datosPie = @json($datosPie);

            const etiquetasPie = tipos.map(t => t.charAt(0).toUpperCase() + t.slice(1));
            const coloresPie = ["#FDBA8C", "#16BDCA", "#1C64F2"]; // naranja, verde, azul

            const getPieChartOptions = () => ({
                series: datosPie,
                colors: coloresPie,
                chart: {
                    height: 420,
                    width: "100%",
                    type: "pie"
                },
                stroke: {
                    colors: ["white"]
                },
                labels: etiquetasPie,
                dataLabels: {
                    enabled: true,
                    formatter: (val, opts) => datosPie[opts.seriesIndex], // muestra cantidad no porcentaje
                    style: {
                        fontFamily: "Inter, sans-serif"
                    }
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                tooltip: {
                    y: {
                        formatter: val => `${val} personas`
                    }
                }
            });

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const pieChart = new ApexCharts(document.getElementById("pie-chart"), getPieChartOptions());
                pieChart.render();
            }
        </script>

        <script>
            // ------------------- Gráfico Progreso del equipo (radial chart) -------------------
            const accesosHoyPorTipo = @json(array_values($accesosHoyPorTipo));

            const getRadialChartOptions = (seriesData) => ({
                series: seriesData,
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
                labels: ["Estudiante", "Docente", "Administrativo"],
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
                        formatter: (value) => value + ' accesos'
                    }
                },
            });

            if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
                const radialChart = new ApexCharts(document.getElementById("radial-chart"), getRadialChartOptions(accesosHoyPorTipo));
                radialChart.render();
            }
        </script>
    @endpush

</x-admin-layout>
