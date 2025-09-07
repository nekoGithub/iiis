

<x-reconigtion-layout>


    <!-- Notificación Toast -->
    <div id="toast-notification"
        class="fixed top-6 right-6 z-50 transform translate-x-full opacity-0 transition-all duration-500 ease-in-out">
        <div id="toast-content"
            class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-8 py-6 rounded-2xl shadow-2xl border-l-4 border-white flex items-center gap-4 min-w-[320px]">
            <div id="toast-icon" class="text-3xl">✅</div>
            <div>
                <div id="toast-title" class="font-bold text-lg">Entrada Registrada</div>
                <div id="toast-message" class="text-sm opacity-90">Hora de entrada: 08:30 AM</div>
            </div>
        </div>
    </div>

    <!-- Fondo con efectos de partículas mejorado -->
    <div
        class="fixed inset-0 h-full w-full bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 -z-10 overflow-hidden">
        <!-- Efectos de luces animadas -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-cyan-400/5 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-1/3 right-1/3 w-80 h-80 bg-violet-400/5 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 1.5s;"></div>
            <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-blue-400/5 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 3s;"></div>
            <div class="absolute top-10 right-10 w-32 h-32 bg-emerald-400/5 rounded-full blur-2xl animate-pulse"
                style="animation-delay: 0.5s;"></div>
        </div>

        <!-- Patrón de puntos decorativo -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-20 w-2 h-2 bg-cyan-400 rounded-full animate-ping"></div>
            <div class="absolute top-40 right-32 w-1 h-1 bg-violet-400 rounded-full animate-ping"
                style="animation-delay: 2s;"></div>
            <div class="absolute bottom-32 left-40 w-1.5 h-1.5 bg-blue-400 rounded-full animate-ping"
                style="animation-delay: 4s;"></div>
        </div>
    </div>

    <!-- Contenedor principal con glassmorphism -->
    <div class="min-h-screen p-4 md:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            <div
                class="bg-slate-900/40 backdrop-blur-2xl border border-slate-700/30 rounded-3xl p-6 md:p-8 shadow-2xl shadow-black/50 hover:shadow-cyan-500/10 transition-all duration-700">

                <!-- Header mejorado -->
                <header
                    class="flex flex-col lg:flex-row justify-between items-center border-b border-gradient-to-r from-transparent via-slate-600/30 to-transparent pb-8 mb-8">
                    <div class="flex items-center gap-6">
                        <!-- Logo con efectos -->
                        <div class="relative group">
                            <div
                                class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500 via-blue-600 to-violet-600 flex items-center justify-center font-black text-white shadow-2xl shadow-blue-500/30 group-hover:scale-105 transition-transform duration-300">
                                UA
                            </div>
                            <div
                                class="absolute -inset-1 bg-gradient-to-br from-cyan-500 via-blue-600 to-violet-600 rounded-2xl blur-lg opacity-30 group-hover:opacity-50 transition-opacity duration-300">
                            </div>
                        </div>

                        <div class="text-left">
                            <h1
                                class="text-3xl md:text-4xl font-black bg-gradient-to-r from-cyan-400 via-blue-400 to-violet-400 bg-clip-text text-transparent drop-shadow-sm">
                                Control de Acceso
                            </h1>
                            <p class="text-slate-400 font-medium tracking-wide mt-1">Sistema Universitario Inteligente
                            </p>
                        </div>
                    </div>

                    <!-- Reloj en tiempo real mejorado -->
                    <div class="text-right mt-6 lg:mt-0 bg-slate-800/50 p-4 rounded-2xl border border-slate-600/30">
                        <div id="live-time"
                            class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
                            Loading...</div>
                        <div id="live-date" class="text-slate-300 text-sm font-medium mt-1">Loading...</div>
                    </div>
                </header>

                <!-- Layout principal -->
                <div class="grid lg:grid-cols-[400px_1fr] gap-8">

                    <!-- Perfil del usuario mejorado -->
                    <section
                        class="relative bg-gradient-to-br from-slate-800/60 to-slate-900/60 backdrop-blur-xl border border-slate-600/30 rounded-3xl p-8 group hover:border-cyan-500/50 transition-all duration-500 shadow-xl">
                        <!-- Borde superior decorativo -->
                        <div
                            class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 via-blue-500 to-violet-500 rounded-t-3xl">
                        </div>

                        <!-- Foto de perfil con efectos -->
                        <div class="w-40 h-40 mx-auto mb-8 relative group">
                            <img id="foto"
                                class="rounded-full w-full h-full object-cover border-4 border-slate-600/50 group-hover:border-cyan-400/70 transition-all duration-300 shadow-2xl"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop&crop=face"
                                alt="Foto del usuario">
                            <div
                                class="absolute -inset-2 bg-gradient-to-r from-cyan-500 via-blue-500 to-violet-500 rounded-full blur-xl opacity-20 group-hover:opacity-40 transition-opacity duration-300">
                            </div>
                        </div>

                        <!-- Nombre del usuario -->
                        <h2 id="nombre" class="text-center text-2xl font-bold text-white mb-8 tracking-wide">
                            Brayan Sonco Machaca
                        </h2>

                        <!-- Información del usuario con iconos mejorados -->
                        <div class="space-y-4">
                            <div
                                class="group/item bg-gradient-to-r from-slate-700/30 to-slate-800/30 p-5 rounded-2xl border border-slate-600/30 hover:border-cyan-400/50 hover:from-slate-700/50 hover:to-slate-800/50 transition-all duration-300 cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-white text-xl shadow-lg">
                                        🏢
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Edificio
                                        </p>
                                        <p
                                            class="text-lg font-semibold text-white group-hover/item:text-cyan-400 transition-colors">
                                            Torre A</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="group/item bg-gradient-to-r from-slate-700/30 to-slate-800/30 p-5 rounded-2xl border border-slate-600/30 hover:border-violet-400/50 hover:from-slate-700/50 hover:to-slate-800/50 transition-all duration-300 cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-violet-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-xl shadow-lg">
                                        🎓
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Carrera
                                        </p>
                                        <p
                                            class="text-lg font-semibold text-white group-hover/item:text-violet-400 transition-colors">
                                            Ingeniería de Sistemas</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="group/item bg-gradient-to-r from-slate-700/30 to-slate-800/30 p-5 rounded-2xl border border-slate-600/30 hover:border-emerald-400/50 hover:from-slate-700/50 hover:to-slate-800/50 transition-all duration-300 cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center text-white text-xl shadow-lg">
                                        📧
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Email</p>
                                        <p id="email"
                                            class="text-sm font-medium text-white group-hover/item:text-emerald-400 transition-colors break-all">
                                            brayan.sonco@universidad.edu</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="group/item bg-gradient-to-r from-slate-700/30 to-slate-800/30 p-5 rounded-2xl border border-slate-600/30 hover:border-yellow-400/50 hover:from-slate-700/50 hover:to-slate-800/50 transition-all duration-300 cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center text-white text-xl shadow-lg">
                                        📱
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Teléfono
                                        </p>
                                        <p id="telefono"
                                            class="text-lg font-semibold text-white group-hover/item:text-yellow-400 transition-colors">
                                            +591 123 456 789</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Dashboard principal -->
                    <section class="space-y-8">
                        <!-- Estado de acceso mejorado -->
                        <div id="statusCard"
                            class="relative text-center p-10 rounded-3xl border border-emerald-500/40 bg-gradient-to-br from-emerald-900/20 to-green-900/20 backdrop-blur-xl shadow-2xl group hover:scale-[1.02] transition-all duration-500">
                            <div
                                class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-400 via-green-400 to-emerald-500 rounded-t-3xl">
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-green-500/5 rounded-3xl">
                            </div>

                            <div class="relative z-10">
                                <div
                                    class="text-8xl mb-6 status-icon animate-pulse group-hover:scale-110 transition-transform duration-300">
                                    🔓</div>
                                <h3 id="statusText"
                                    class="text-4xl font-black text-emerald-400 uppercase tracking-widest drop-shadow-lg mb-3">
                                    Acceso Autorizado
                                </h3>
                                <p class="text-slate-300 text-lg font-medium">Bienvenido al campus universitario</p>
                            </div>
                        </div>

                        <!-- Tarjetas de tiempo mejoradas -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div
                                class="group text-center p-8 rounded-3xl border border-slate-600/30 bg-gradient-to-br from-blue-900/20 to-cyan-900/20 backdrop-blur-xl hover:border-blue-400/50 hover:shadow-2xl hover:shadow-blue-500/20 hover:-translate-y-2 transition-all duration-500">
                                <div
                                    class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center text-3xl text-white shadow-xl group-hover:scale-110 transition-transform duration-300">
                                    📅
                                </div>
                                <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-2">Fecha de
                                    Acceso</p>
                                <p id="fecha"
                                    class="text-2xl font-black text-white group-hover:text-blue-400 transition-colors">
                                    13 JUL 2025</p>
                            </div>

                            <div id="entrada-card"
                                class="group text-center p-8 rounded-3xl border border-slate-600/30 bg-gradient-to-br from-violet-900/20 to-purple-900/20 backdrop-blur-xl hover:border-violet-400/50 hover:shadow-2xl hover:shadow-violet-500/20 hover:-translate-y-2 transition-all duration-500">
                                <div
                                    class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-violet-500 to-purple-500 rounded-2xl flex items-center justify-center text-3xl text-white shadow-xl group-hover:scale-110 transition-transform duration-300">
                                    🕐
                                </div>
                                <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-2">Hora de
                                    Entrada</p>
                                <p id="hora_ingreso"
                                    class="text-2xl font-black text-white group-hover:text-violet-400 transition-colors">
                                    08:30 AM</p>
                                <!-- Indicador de nuevo registro -->
                                <div id="entrada-indicator"
                                    class="hidden mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white animate-pulse">
                                    ✓ REGISTRADO
                                </div>
                            </div>

                            <div id="salida-card"
                                class="group text-center p-8 rounded-3xl border border-slate-600/30 bg-gradient-to-br from-emerald-900/20 to-teal-900/20 backdrop-blur-xl hover:border-emerald-400/50 hover:shadow-2xl hover:shadow-emerald-500/20 hover:-translate-y-2 transition-all duration-500">
                                <div
                                    class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center text-3xl text-white shadow-xl group-hover:scale-110 transition-transform duration-300">
                                    🕓
                                </div>
                                <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-2">Hora de
                                    Salida</p>
                                <p id="hora_salida"
                                    class="text-2xl font-black text-white group-hover:text-emerald-400 transition-colors">
                                    -- : --</p>
                                <!-- Indicador de nuevo registro -->
                                <div id="salida-indicator"
                                    class="hidden mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-500 text-white animate-pulse">
                                    ✓ REGISTRADO
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Footer mejorado -->
                <footer
                    class="text-center border-t border-gradient-to-r from-transparent via-slate-600/30 to-transparent pt-8 mt-12">
                    <p class="text-slate-400 text-lg">
                        Sistema de Control de Acceso —
                        <span
                            class="font-black bg-gradient-to-r from-cyan-400 via-blue-400 to-violet-400 bg-clip-text text-transparent">
                            UNIVERSIDAD AUTÓNOMA
                        </span>
                    </p>
                    <div class="mt-4 flex justify-center gap-2">
                        <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                        <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse" style="animation-delay: 0.5s;">
                        </div>
                        <div class="w-2 h-2 bg-violet-400 rounded-full animate-pulse" style="animation-delay: 1s;">
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            @keyframes slideInFromRight {
                0% {
                    transform: translateX(100%);
                    opacity: 0;
                }

                100% {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideInFromLeft {
                0% {
                    transform: translateX(-100%);
                    opacity: 0;
                }

                100% {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes bounceIn {
                0% {
                    transform: scale(0.3);
                    opacity: 0;
                }

                50% {
                    transform: scale(1.05);
                }

                70% {
                    transform: scale(0.9);
                }

                100% {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            @keyframes pulseGlow {

                0%,
                100% {
                    box-shadow: 0 0 20px rgba(34, 197, 94, 0.4);
                }

                50% {
                    box-shadow: 0 0 40px rgba(34, 197, 94, 0.8);
                }
            }

            @keyframes shake {

                0%,
                100% {
                    transform: translateX(0);
                }

                10%,
                30%,
                50%,
                70%,
                90% {
                    transform: translateX(-5px);
                }

                20%,
                40%,
                60%,
                80% {
                    transform: translateX(5px);
                }
            }

            .slide-in-right {
                animation: slideInFromRight 0.8s ease-out;
            }

            .slide-in-left {
                animation: slideInFromLeft 0.8s ease-out;
            }

            .bounce-in {
                animation: bounceIn 0.6s ease-out;
            }

            .pulse-glow {
                animation: pulseGlow 2s infinite;
            }

            .shake-animation {
                animation: shake 0.5s ease-in-out;
            }
        </style>
    @endpush

    @push('js')
        <script>
            let previousData = {
                hora_entrada: null,
                hora_salida: null
            };

            function showToast(type, title, message, duration = 4000) {
                const toast = document.getElementById('toast-notification');
                const toastContent = document.getElementById('toast-content');
                const toastIcon = document.getElementById('toast-icon');
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');

                // Configurar el contenido del toast según el tipo
                if (type === 'entrada') {
                    toastContent.className =
                        'bg-gradient-to-r from-green-500 to-emerald-500 text-white px-8 py-6 rounded-2xl shadow-2xl border-l-4 border-white flex items-center gap-4 min-w-[320px]';
                    toastIcon.textContent = '🔓';
                    toastTitle.textContent = 'Entrada Registrada';
                } else if (type === 'salida') {
                    toastContent.className =
                        'bg-gradient-to-r from-red-500 to-rose-500 text-white px-8 py-6 rounded-2xl shadow-2xl border-l-4 border-white flex items-center gap-4 min-w-[320px]';
                    toastIcon.textContent = '🔒';
                    toastTitle.textContent = 'Salida Registrada';
                }

                toastMessage.textContent = message;

                // Mostrar el toast
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');

                // Ocultar automáticamente
                setTimeout(() => {
                    toast.classList.remove('translate-x-0', 'opacity-100');
                    toast.classList.add('translate-x-full', 'opacity-0');
                }, duration);
            }

            function animateCard(cardId, indicatorId) {
                const card = document.getElementById(cardId);
                const indicator = document.getElementById(indicatorId);

                // Agregar animación de rebote y brillo
                card.classList.add('bounce-in', 'pulse-glow');

                // Mostrar indicador
                indicator.classList.remove('hidden');
                indicator.classList.add('slide-in-right');

                // Remover animaciones después de un tiempo
                setTimeout(() => {
                    card.classList.remove('bounce-in', 'pulse-glow');
                    indicator.classList.remove('slide-in-right');
                }, 3000);

                // Ocultar indicador después de 5 segundos
                setTimeout(() => {
                    indicator.classList.add('slide-in-left');
                    setTimeout(() => {
                        indicator.classList.add('hidden');
                        indicator.classList.remove('slide-in-left');
                    }, 500);
                }, 5000);
            }

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

            function actualizarPantalla() {
                fetch('/api/ultimo-acceso')
                    .then(response => response.json())
                    .then(data => {
                        const fecha = new Date(data.fecha_acceso);
                        const opciones = {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        };
                        const fechaFormateada = fecha.toLocaleDateString('es-PE', opciones).toUpperCase();

                        // Actualizar información del usuario
                        document.getElementById('nombre').textContent = `${data.people.name} ${data.people.last_name}`;
                        document.getElementById('email').textContent = data.people.email;
                        document.getElementById('telefono').textContent = data.people.phone;
                        document.getElementById('fecha').textContent = fechaFormateada;
                        document.getElementById('foto').src = `/storage/${data.people.photo}`;

                        // Verificar cambios en hora de entrada
                        if (data.hora_entrada && data.hora_entrada !== previousData.hora_entrada) {
                            document.getElementById('hora_ingreso').textContent = data.hora_entrada;

                            // Solo mostrar animación si no es la primera carga
                            if (previousData.hora_entrada !== null) {
                                showToast('entrada', 'Entrada Registrada', `Hora de entrada: ${data.hora_entrada}`);
                                animateCard('entrada-card', 'entrada-indicator');
                            }

                            previousData.hora_entrada = data.hora_entrada;
                        }

                        // Verificar cambios en hora de salida
                        if (data.hora_salida && data.hora_salida !== previousData.hora_salida) {
                            document.getElementById('hora_salida').textContent = data.hora_salida;

                            // Solo mostrar animación si no es la primera carga
                            if (previousData.hora_salida !== null) {
                                showToast('salida', 'Salida Registrada', `Hora de salida: ${data.hora_salida}`);
                                animateCard('salida-card', 'salida-indicator');
                            }

                            previousData.hora_salida = data.hora_salida;
                        } else if (!data.hora_salida) {
                            document.getElementById('hora_salida').textContent = '-- : --';
                        }

                        // Actualizar estado de acceso
                        const statusCard = document.getElementById('statusCard');
                        const statusText = document.getElementById('statusText');
                        const statusIcon = statusCard.querySelector('.status-icon');

                        if (data.card.estado) {
                            statusCard.className =
                                'relative text-center p-10 rounded-3xl border border-emerald-500/40 bg-gradient-to-br from-emerald-900/20 to-green-900/20 backdrop-blur-xl shadow-2xl group hover:scale-[1.02] transition-all duration-500';
                            statusText.textContent = 'Acceso Autorizado';
                            statusText.className =
                                'text-4xl font-black text-emerald-400 uppercase tracking-widest drop-shadow-lg mb-3';
                            statusIcon.textContent = '🔓';
                        } else {
                            statusCard.className =
                                'relative text-center p-10 rounded-3xl border border-red-500/40 bg-gradient-to-br from-red-900/20 to-rose-900/20 backdrop-blur-xl shadow-2xl group hover:scale-[1.02] transition-all duration-500';
                            statusText.textContent = 'Acceso Denegado';
                            statusText.className =
                                'text-4xl font-black text-red-400 uppercase tracking-widest drop-shadow-lg mb-3';
                            statusIcon.textContent = '🔒';

                            // Animación de shake para acceso denegado
                            statusCard.classList.add('shake-animation');
                            setTimeout(() => {
                                statusCard.classList.remove('shake-animation');
                            }, 500);
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los datos del acceso:', error);
                    });
            }

            // Inicializar la aplicación
            function initializeApp() {
                // Cargar datos iniciales sin animaciones
                fetch('/api/ultimo-acceso')
                    .then(response => response.json())
                    .then(data => {
                        previousData.hora_entrada = data.hora_entrada;
                        previousData.hora_salida = data.hora_salida;
                        actualizarPantalla();
                    })
                    .catch(error => {
                        console.error('Error al inicializar:', error);
                    });
            }

            // Eventos de inicio
            document.addEventListener('DOMContentLoaded', function() {
                initializeApp();
                updateLiveTime();
                setInterval(updateLiveTime, 1000);
                setInterval(actualizarPantalla, 3000); // Verificar cada 3 segundos para mayor responsividad
            });
        </script>
    @endpush

</x-reconigtion-layout>
