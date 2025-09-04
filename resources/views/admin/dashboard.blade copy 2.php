<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">


    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="brand">
                <div class="brand-logo">UA</div>
                <div class="brand-text">
                    <h1>Control de Acceso</h1>
                    <p>Sistema Universitario</p>
                </div>
            </div>
            <div class="header-info">
                <div id="live-time">Loading...</div>
                <div id="live-date">Loading...</div>
            </div>
        </header>

        <!-- Main Layout -->
        <div class="main-layout">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-photo-container">
                    <img id="foto"
                        src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxjaXJjbGUgY3g9Ijc1IiBjeT0iNzUiIHI9Ijc1IiBmaWxsPSIjNjM2NmYxIi8+CjxzdmcgeD0iNDUiIHk9IjQ1IiB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPgo8cGF0aCBkPSJNMjAgMjFWMTlhNCA0IDAgMCAwLTQtNEg4YTQgNCAwIDAgMC00IDR2MiIvPgo8Y2lyY2xlIGN4PSIxMiIgY3k9IjciIHI9IjQiLz4KPC9zdmc+Cjwvc3ZnPgo="
                        alt="Foto del usuario" class="profile-photo">
                </div>

                <h2 id="nombre" class="profile-name">Brayan Sonco Machaca</h2>

                <div class="profile-details">
                    <div class="profile-item">
                        <div class="profile-icon">🏢</div>
                        <div class="profile-content">
                            <div class="profile-label">Edificio</div>
                            <div class="profile-value">Torre A</div>
                        </div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-icon">🎓</div>
                        <div class="profile-content">
                            <div class="profile-label">Carrera</div>
                            <div class="profile-value">Ingeniería de Sistemas</div>
                        </div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-icon">📧</div>
                        <div class="profile-content">
                            <div class="profile-label">Email</div>
                            <div class="profile-value" id="email">brayan.sonco@universidad.edu</div>
                        </div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-icon">📱</div>
                        <div class="profile-content">
                            <div class="profile-label">Teléfono</div>
                            <div class="profile-value" id="telefono">+591 123 456 789</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Access Dashboard -->
            <div class="access-dashboard">
                <!-- Progreso del equipo -->
                <div class="status-card" style="height: auto; padding: 20px;">
                    <div class="flex justify-between mb-3">
                        <h5 class="text-lg font-bold text-white">Total de Registrados</h5>
                    </div>

                    <div class="bg-gray-800 rounded-lg p-4">
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <dl class="bg-gray-700 rounded-lg flex flex-col items-center justify-center h-[80px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-orange-500 text-white text-sm font-medium flex items-center justify-center mb-1">
                                    {{ $datosPie[0] ?? 0 }}
                                </dt>
                                <dd class="text-orange-300 text-sm font-medium">
                                    {{ ucfirst($tipos[0] ?? 'To do') }}
                                </dd>
                            </dl>
                            <dl class="bg-gray-700 rounded-lg flex flex-col items-center justify-center h-[80px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-teal-500 text-white text-sm font-medium flex items-center justify-center mb-1">
                                    {{ $datosPie[1] ?? 0 }}
                                </dt>
                                <dd class="text-teal-300 text-sm font-medium">
                                    {{ ucfirst($tipos[1] ?? 'In progress') }}
                                </dd>
                            </dl>
                            <dl class="bg-gray-700 rounded-lg flex flex-col items-center justify-center h-[80px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-blue-500 text-white text-sm font-medium flex items-center justify-center mb-1">
                                    {{ $datosPie[2] ?? 0 }}
                                </dt>
                                <dd class="text-blue-300 text-sm font-medium">
                                    {{ ucfirst($tipos[2] ?? 'Done') }}
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="flex justify-between mb-3 mt-4">
                        <h5 class="text-md font-bold text-indigo-400">Cantidad de accesos HOY</h5>
                    </div>

                    <!-- Radial Chart -->
                    <div id="radial-chart" class="w-full"></div>
                </div>

                <!-- Status Card -->
                <div id="statusCard" class="status-card status-authorized">
                    <div class="status-icon">🔓</div>
                    <div id="statusText" class="status-text">Acceso Autorizado</div>
                    <div class="status-subtitle">Bienvenido al campus universitario</div>
                </div>

                <!-- Time & Date Grid -->
                <div class="time-date-grid">
                    <div class="time-card">
                        <div class="time-icon">📅</div>
                        <div class="time-label">Fecha</div>
                        <div class="time-value" id="fecha">13 JUL 2025</div>
                    </div>

                    <div class="time-card">
                        <div class="time-icon">🕐</div>
                        <div class="time-label">Entrada</div>
                        <div class="time-value" id="hora_ingreso">08:30 AM</div>
                    </div>

                    <div class="time-card">
                        <div class="time-icon">🕓</div>
                        <div class="time-label">Salida</div>
                        <div class="time-value" id="hora_salida">-- : --</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>Sistema de Control de Acceso — <span class="footer-brand">UNIVERSIDAD AUTÓNOMA</span></p>
        </footer>
    </div>


    @push('css')
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', 'Segoe UI', sans-serif;
                background: #0a0a0a;
                color: #ffffff;
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            /* Background Animation */
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at 20% 30%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(255, 119, 198, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 80%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);
                z-index: -1;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
                min-height: 100vh;
            }

            /* Header */
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                margin-bottom: 40px;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .brand-logo {
                width: 50px;
                height: 50px;
                background: linear-gradient(45deg, #6366f1, #8b5cf6, #ec4899);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 900;
                font-size: 20px;
                color: white;
                position: relative;
            }

            .brand-logo::after {
                content: '';
                position: absolute;
                inset: -2px;
                background: linear-gradient(45deg, #6366f1, #8b5cf6, #ec4899);
                border-radius: 14px;
                z-index: -1;
                filter: blur(8px);
                opacity: 0.5;
            }

            .brand-text h1 {
                font-size: 20px;
                font-weight: 700;
                background: linear-gradient(45deg, #6366f1, #ec4899);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .brand-text p {
                font-size: 12px;
                color: #94a3b8;
                margin-top: 2px;
            }

            .header-info {
                text-align: right;
                font-size: 14px;
                color: #94a3b8;
            }

            /* Main Layout */
            .main-layout {
                display: grid;
                grid-template-columns: 350px 1fr;
                gap: 30px;
                margin-bottom: 30px;
            }

            /* Profile Section */
            .profile-section {
                background: rgba(15, 15, 15, 0.8);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 20px;
                padding: 30px;
                backdrop-filter: blur(20px);
                position: relative;
                overflow: hidden;
            }

            .profile-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);
            }

            .profile-photo-container {
                position: relative;
                width: 150px;
                height: 150px;
                margin: 0 auto 25px;
            }

            .profile-photo {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid rgba(255, 255, 255, 0.1);
            }

            .profile-photo-container::after {
                content: '';
                position: absolute;
                inset: -3px;
                background: linear-gradient(45deg, #6366f1, #8b5cf6, #ec4899);
                border-radius: 50%;
                z-index: -1;
                filter: blur(10px);
                opacity: 0.6;
            }

            .profile-name {
                text-align: center;
                font-size: 22px;
                font-weight: 700;
                margin-bottom: 30px;
                background: linear-gradient(45deg, #ffffff, #94a3b8);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .profile-details {
                display: flex;
                flex-direction: column;
                gap: 18px;
            }

            .profile-item {
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 15px;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s ease;
            }

            .profile-item:hover {
                background: rgba(255, 255, 255, 0.08);
                transform: translateY(-2px);
            }

            .profile-icon {
                font-size: 18px;
                width: 24px;
                text-align: center;
            }

            .profile-content {
                flex: 1;
            }

            .profile-label {
                font-size: 12px;
                color: #94a3b8;
                text-transform: uppercase;
                font-weight: 600;
                margin-bottom: 4px;
            }

            .profile-value {
                font-size: 14px;
                color: #ffffff;
                font-weight: 500;
            }

            /* Access Dashboard */
            .access-dashboard {
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .status-card {
                background: rgba(15, 15, 15, 0.8);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 20px;
                padding: 30px;
                backdrop-filter: blur(20px);
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .status-authorized {
                border-color: rgba(34, 197, 94, 0.3);
            }

            .status-denied {
                border-color: rgba(239, 68, 68, 0.3);
            }

            .status-authorized::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #10b981, #059669);
            }

            .status-denied::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #ef4444, #dc2626);
            }

            .status-icon {
                font-size: 48px;
                margin-bottom: 15px;
            }

            .status-text {
                font-size: 24px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 10px;
            }

            .status-authorized .status-text {
                color: #10b981;
            }

            .status-denied .status-text {
                color: #ef4444;
            }

            .status-subtitle {
                font-size: 14px;
                color: #94a3b8;
            }

            /* Time & Date Grid */
            .time-date-grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 20px;
            }

            .time-card {
                background: rgba(15, 15, 15, 0.8);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 16px;
                padding: 25px;
                backdrop-filter: blur(20px);
                text-align: center;
                position: relative;
                transition: all 0.3s ease;
            }

            .time-card:hover {
                transform: translateY(-5px);
                border-color: rgba(99, 102, 241, 0.3);
            }

            .time-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 30px;
                height: 3px;
                background: linear-gradient(90deg, #6366f1, #8b5cf6);
                border-radius: 0 0 3px 3px;
            }

            .time-icon {
                font-size: 24px;
                margin-bottom: 10px;
                color: #6366f1;
            }

            .time-label {
                font-size: 12px;
                color: #94a3b8;
                text-transform: uppercase;
                font-weight: 600;
                margin-bottom: 8px;
            }

            .time-value {
                font-size: 18px;
                font-weight: 700;
                color: #ffffff;
            }

            /* Footer */
            .footer {
                text-align: center;
                padding: 20px 0;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                color: #94a3b8;
                font-size: 14px;
            }

            .footer-brand {
                background: linear-gradient(45deg, #6366f1, #ec4899);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: 700;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .main-layout {
                    grid-template-columns: 1fr;
                }

                .time-date-grid {
                    grid-template-columns: 1fr;
                }

                .header {
                    flex-direction: column;
                    gap: 20px;
                    text-align: center;
                }

                .profile-section {
                    order: 2;
                }

                .access-dashboard {
                    order: 1;
                }
            }

            /* Animations */
            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .profile-section,
            .access-dashboard>*,
            .footer {
                animation: slideUp 0.6s ease-out forwards;
            }

            .profile-section {
                animation-delay: 0.1s;
            }

            .status-card {
                animation-delay: 0.2s;
            }

            .time-date-grid {
                animation-delay: 0.3s;
            }

            .footer {
                animation-delay: 0.4s;
            }

            /* Pulse animation for authorized status */
            .status-authorized .status-icon {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            
        </style>
    @endpush


    @push('js')
        <script>
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

            const options = getRadialChartOptions(accesosHoyPorTipo);

            if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
                const radialChart = new ApexCharts(document.getElementById("radial-chart"), options);
                radialChart.render();
            }

            // Función para actualizar la hora actual
            function updateLiveTime() {
                const now = new Date();
                const timeOptions = {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                };
                const dateOptions = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                };

                document.getElementById('live-time').textContent = now.toLocaleTimeString('es-PE', timeOptions);
                document.getElementById('live-date').textContent = now.toLocaleDateString('es-PE', dateOptions).toUpperCase();
            }

            // Función para actualizar la pantalla con datos del servidor
            function actualizarPantalla() {
                // Simulación de datos - reemplaza con tu fetch real
                const data = {
                    people: {
                        name: 'Brayan',
                        last_name: 'Sonco Machaca',
                        email: 'brayan.sonco@universidad.edu',
                        phone: '+591 123 456 789',
                        photo: 'default-avatar.jpg'
                    },
                    fecha_acceso: '2025-07-13',
                    hora_entrada: '08:30 AM',
                    hora_salida: null,
                    card: {
                        estado: true
                    }
                };

                // Procesar fecha
                const fecha = new Date(data.fecha_acceso);
                const opciones = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                };
                const fechaFormateada = fecha
                    .toLocaleDateString('es-PE', opciones)
                    .toUpperCase();

                // Actualizar elementos
                document.getElementById('nombre').textContent = data.people.name + ' ' + data.people.last_name;
                document.getElementById('email').textContent = data.people.email;
                document.getElementById('telefono').textContent = data.people.phone;
                document.getElementById('fecha').textContent = fechaFormateada;
                document.getElementById('hora_ingreso').textContent = data.hora_entrada;
                document.getElementById('hora_salida').textContent = data.hora_salida || '-- : --';

                // Actualizar estado
                const statusCard = document.getElementById('statusCard');
                const statusText = document.getElementById('statusText');

                if (data.card.estado) {
                    statusCard.className = 'status-card status-authorized';
                    statusText.textContent = 'Acceso Autorizado';
                    statusCard.querySelector('.status-icon').textContent = '🔓';
                } else {
                    statusCard.className = 'status-card status-denied';
                    statusText.textContent = 'Acceso Denegado';
                    statusCard.querySelector('.status-icon').textContent = '🔒';
                }

                // Aquí puedes actualizar la foto si tienes la URL
                // document.getElementById('foto').src = `/storage/${data.people.photo}`;
            }

            // Función real para conectar con tu API
            function actualizarPantallaReal() {
                fetch('/api/ultimo-acceso')
                    .then(response => response.json())
                    .then(data => {
                        const fecha = new Date(data.fecha_acceso);
                        const opciones = {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        };
                        const fechaFormateada = fecha
                            .toLocaleDateString('es-PE', opciones)
                            .toUpperCase();

                        document.getElementById('nombre').textContent = data.people.name + ' ' + data.people.last_name;
                        document.getElementById('email').textContent = data.people.email;
                        document.getElementById('telefono').textContent = data.people.phone;
                        document.getElementById('fecha').textContent = fechaFormateada;
                        document.getElementById('hora_ingreso').textContent = data.hora_entrada;
                        document.getElementById('hora_salida').textContent = data.hora_salida || '-- : --';

                        const statusCard = document.getElementById('statusCard');
                        const statusText = document.getElementById('statusText');

                        if (data.card.estado) {
                            statusCard.className = 'status-card status-authorized';
                            statusText.textContent = 'Acceso Autorizado';
                            statusCard.querySelector('.status-icon').textContent = '🔓';
                        } else {
                            statusCard.className = 'status-card status-denied';
                            statusText.textContent = 'Acceso Denegado';
                            statusCard.querySelector('.status-icon').textContent = '🔒';
                        }

                        document.getElementById('foto').src = `/storage/${data.people.photo}`;
                    })
                    .catch(error => {
                        console.error('Error al obtener datos:', error);
                    });
            }

            // Inicializar
            updateLiveTime();
            actualizarPantalla();

            // Actualizar cada segundo la hora
            setInterval(updateLiveTime, 1000);

            // Actualizar datos cada 5 segundos
            // setInterval(actualizarPantallaReal, 5000);

            // Cargar datos al iniciar
            // window.onload = actualizarPantallaReal;
        </script>
    @endpush

</x-admin-layout>
