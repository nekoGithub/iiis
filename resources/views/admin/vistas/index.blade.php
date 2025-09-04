<x-reconigtion-layout>
    <div class="my-5">
        <div class="text-center">
            <button onclick="location.reload()"
                class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v6h6M20 20v-6h-6M4 14a8 8 0 0114-5.292M20 10a8 8 0 01-14 5.292" />
                </svg>
                Actualizar
            </button>

        </div>

        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Gráfico de líneas por emoción -->
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">
                        Reconocimientos por emoción (últimos 7 días)
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Cada línea representa una emoción detectada diariamente
                    </p>
                    <div id="line-chart" class="w-full min-h-[320px]"></div>
                </div>
            </div>
            <!-- Gráfico de torta por emoción -->
            <div class="w-full lg:w-2/5">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 md:p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h5 class="text-xl font-bold text-gray-900 dark:text-white mb-2 flex items-center">
                                Total de Emociones registradas
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

        <div class="flex flex-col md:flex-row w-full gap-6 p-6 max-w-full mx-auto">

            <!-- Progreso del equipo (radial chart) -->
            {{-- Colocar Carrera de emociones de bajo de Cantidad de reconcocimiento hoy --}}
            <div
                class="w-full md:w-[300px] bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6 h-[480px] sm:h-[500px] md:h-[520px] overflow-y-auto mt-5">

                <div class="flex justify-between mb-3">
                    <div class="flex items-center">
                        <div class="flex justify-center items-center">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Cantidad Emociones con Mayor Frecuencia</h5>
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
                            <h5
                                class="text-md font-bold leading-none text-gray-900 dark:text-white pe-1 text-indigo-700">
                                Carrera de emociones</h5>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mb-3">
                    <div class="flex items-center">
                        <div class="flex justify-center items-center">
                            <h6
                                class="text-xs font-bold leading-none text-gray-900 dark:text-white pe-1 text-indigo-700">
                                Cantidad de emociones por día</h6>
                        </div>
                    </div>
                </div>
                <!-- Radial Chart -->
                <div class="py-4" id="radial-chart"></div>
            </div>

            <!-- Gráfico 4: Accesos últimos 6 meses (barra horizontal) -->
            <div
                class="w-full md:flex-1 bg-white rounded-lg shadow-lg dark:bg-gray-800 p-4 h-[360px] sm:h-[400px] md:h-[420px] mb-8">
                <h2 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Reconocimientos de los últimos 6
                    meses
                </h2>
                <div id="bar-chart" class="w-full h-full"></div>
            </div>

            <!-- Gráfico 3: Usuarios últimos 7 días (columnas) -->
            {{-- Colocalr como titulo cantidad emociones por dia  --}}
            <div class="max-w-sm w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                <path
                                    d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                <path
                                    d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                {{ number_format($totalUltimos7dias) }}</h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Cantidad de emociones por los ultimos 7 días
                            </p>
                        </div>
                    </div>
                </div>

                <div id="column-chart"></div>


            </div>
        </div>
    </div>



    @push('js')
        // start Graficos
        <script>
            const series = @json($series);
            const labels = @json($labels);

            const optionsLine = {
                chart: {
                    type: 'line',
                    height: "100%",
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false
                    },
                },
                series: series,
                stroke: {
                    width: 5,
                    curve: 'smooth'
                },
                xaxis: {
                    categories: {!! json_encode($labels) !!},
                    labels: {
                        style: {
                            fontSize: '12px',
                            colors: "#6B7280",
                        }
                    },
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px',
                            colors: "#6B7280",
                        }
                    },
                },
                colors: ['#1A56DB', '#10B981', '#F59E0B', '#EF4444',
                    '#8B5CF6'
                ], // puedes agregar más colores si hay más emociones
                legend: {
                    position: 'bottom',
                    labels: {
                        colors: "#6B7280",
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                },
                grid: {
                    borderColor: "#E5E7EB",
                    strokeDashArray: 5,
                },
            };

            new ApexCharts(document.querySelector("#line-chart"), optionsLine).render();
        </script>
        <script>
            const tipos = @json($tipos);
            const datosPie = @json($datosPie);
            const total = datosPie.reduce((a, b) => a + b, 0);

            const etiquetasPie = tipos.map(t => t.charAt(0).toUpperCase() + t.slice(1));
            const coloresPie = [
                "#1C64F2", "#16BDCA", "#FDBA8C",
                "#FACC15", "#EF4444", "#A855F7", "#10B981"
            ];

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
                    formatter: (val, opts) => {
                        const cantidad = datosPie[opts.seriesIndex];
                        const porcentaje = Math.round(val); // ✅ porcentaje entero
                        return `${cantidad} (${porcentaje}%)`;
                    },
                    style: {
                        fontFamily: "Inter, sans-serif",
                        fontWeight: "bold"
                    }
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif"
                },
                tooltip: {
                    y: {
                        formatter: function(val, opts) {
                            const porcentaje = Math.round((val / total) * 100); // ✅ porcentaje entero
                            const label = etiquetasPie[opts.seriesIndex];
                            return `${label}: ${val} registros (${porcentaje}%)`;
                        }
                    }
                }
            });

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const pieChart = new ApexCharts(document.getElementById("pie-chart"), getPieChartOptions());
                pieChart.render();
            }
        </script>
        <script>
            const accesosHoyPorTipo = @json(array_values($accesosHoyPorTipo));
            const emociones = @json(array_keys($accesosHoyPorTipo));

            const optionsRadial = {
                series: accesosHoyPorTipo,
                colors: ["#F59E0B", "#3B82F6", "#EF4444", "#10B981", "#8B5CF6"], // asigna colores para cada emoción
                chart: {
                    height: 350,
                    type: "radialBar",
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: "30%"
                        },
                        dataLabels: {
                            name: {
                                fontSize: "16px",
                                color: undefined,
                                offsetY: 10
                            },
                            value: {
                                fontSize: "14px",
                                color: undefined,
                                offsetY: 5,
                                formatter: val => val.toString()
                            }
                        }
                    }
                },
                labels: emociones,
                legend: {
                    show: true,
                    position: "bottom",
                    fontFamily: "Inter, sans-serif"
                },
                tooltip: {
                    y: {
                        formatter: val => `${val} registros hoy`
                    }
                }
            };

            if (document.getElementById("radial-chart")) {
                new ApexCharts(document.getElementById("radial-chart"), optionsRadial).render();
            }
        </script>
        <script>
            const meses = @json($meses); // ["mar. 2025", "abr. 2025", ...]
            const datosBarra = @json($datosBarra); // [186, 180, 186, ...]
            const coloresBarra = ['#1E40AF', '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899', '#14B8A6'];

            const datosConColor = datosBarra.map((valor, i) => ({
                x: meses[i],
                y: valor,
                fillColor: coloresBarra[i % coloresBarra.length]
            }));

            const optionsBarChart = {
                series: [{
                    name: "Reconocimientos",
                    data: datosConColor
                }],
                chart: {
                    type: "bar",
                    height: 400,
                    toolbar: {
                        show: false
                    },
                    fontFamily: "Inter, sans-serif"
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        columnWidth: "100%",
                        borderRadiusApplication: "end",
                        borderRadius: 6,
                        dataLabels: {
                            position: "center"
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: val => val.toString(),
                    style: {
                        fontSize: '12px',
                        colors: ['#ffffff'],


                    }
                },
                tooltip: {
                    y: {
                        formatter: val => val + " registros"
                    }
                },
                xaxis: {
                    categories: meses,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
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
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    }
                },
                legend: {
                    show: false
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -20
                    }
                }
            };

            if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("bar-chart"), optionsBarChart);
                chart.render();
            }
        </script>
        <script>
            const etiquetas = @json($fechasEtiquetas);
            const datos = @json($conteosMaximos);
            const colores = @json($coloresPorDia);

            // Construimos el array para la serie con objeto { x: etiqueta, y: dato, fillColor: color }
            const seriesData = etiquetas.map((etiqueta, i) => ({
                x: etiqueta,
                y: datos[i],
                fillColor: colores[i]
            }));

            const options = {
                chart: {
                    type: 'bar',
                    height: 320,
                    fontFamily: 'Inter, sans-serif',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        borderRadius: 8,
                        distributed: true, // <-- esto hace que cada barra tome su color individual
                    }
                },
                colors: colores,
                series: [{
                    name: 'Máximo reconocimiento',
                    data: datos
                }],
                xaxis: {
                    categories: etiquetas,
                    labels: {
                        style: {
                            fontFamily: 'Inter, sans-serif',
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
                tooltip: {
                    y: {
                        formatter: val => `${val} reconocimientos`
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                grid: {
                    show: false
                }
            };

            if (document.getElementById('column-chart') && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById('column-chart'), options);
                chart.render();
            }
        </script>
        // end graficos
        // recargar la pagina
        <script>
            setInterval(() => {
                location.reload();
            }, 5000); // 60,000 ms = 60 segundos
        </script>
    @endpush
</x-reconigtion-layout>
