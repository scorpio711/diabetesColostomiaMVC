<?php
$versionJs = time();
$script = "<script src='/public/build/js/bookings.js?v={$versionJs}'></script>";
?>

<main class="min-h-screen bg-slate-50 dark:bg-slate-900 py-10 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- ==========================================
             1. HEADER PRINCIPAL Y ESTADO DEL PACIENTE
             ========================================== -->
        <div
            class="relative bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">
            <div
                class="absolute -right-20 -top-20 w-80 h-80 bg-teal-500/10 dark:bg-teal-500/5 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-3 max-w-2xl">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-50 dark:bg-teal-950/60 border border-teal-200 dark:border-teal-800 text-xs font-semibold text-teal-800 dark:text-teal-300">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        CENTRO DE ATENCIÓN MULTIDISCIPLINARIA
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Agenda tu <span class="text-teal-600 dark:text-teal-400">Cita Médica o Especializada</span>
                    </h1>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Bienvenido, <strong
                            class="text-slate-900 dark:text-white"><?= htmlspecialchars($nombre) ?></strong>. Completa
                        los 4 sencillos pasos a continuación para seleccionar tu especialidad, elegir a tu profesional y
                        reservar tu horario de atención.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="/public/misCitas"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-xs font-bold border border-slate-200 dark:border-slate-600 transition-colors">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Ver Mis Citas Agendadas
                    </a>
                </div>
            </div>

            <!-- Banner informativo si tiene una cita próxima activa -->
            <?php if ($ocupado && $citaActiva): ?>
                <div
                    class="mt-6 p-4 rounded-2xl bg-teal-50/80 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800 flex items-start gap-3.5">
                    <span class="p-2 rounded-xl bg-teal-100 dark:bg-teal-900/60 text-teal-700 dark:text-teal-300 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <div class="text-xs text-teal-950 dark:text-teal-200 space-y-1">
                        <div class="font-bold text-sm">Ya tienes una cita programada próximamente:</div>
                        <p class="leading-relaxed">
                            Cita con
                            <strong><?= htmlspecialchars(trim(($citaActiva->prof_nombre ?? '') . ' ' . ($citaActiva->prof_apellido ?? ''))) ?></strong>
                            el día <strong><?= htmlspecialchars($citaActiva->fecha ?? '') ?></strong> a las
                            <strong><?= htmlspecialchars(substr($citaActiva->hora ?? '', 0, 5)) ?></strong>.
                            Si deseas reprogramarla o cancelarla, visita <a href="/public/misCitas"
                                class="underline font-bold text-teal-800 dark:text-teal-100">Mis Citas</a>.
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- ==========================================
             2. STEPPER DE NAVEGACIÓN (4 PASOS)
             ========================================== -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-4 sm:p-6 shadow-sm border border-slate-200/80 dark:border-slate-700/80"
            aria-label="Progreso de agendamiento">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="stepper-nav">
                <!-- Paso 1 -->
                <button type="button" data-step="1"
                    class="step-btn group flex items-center gap-3 p-3 rounded-2xl transition-all text-left w-full border border-teal-500 bg-teal-50/60 dark:bg-teal-950/40">
                    <div
                        class="step-circle w-9 h-9 rounded-xl bg-teal-600 text-white font-bold text-sm flex items-center justify-center shrink-0 shadow-sm">
                        1
                    </div>
                    <div class="min-w-0">
                        <div class="text-[10px] uppercase font-bold text-teal-600 dark:text-teal-400 tracking-wider">
                            Paso 1</div>
                        <div class="text-xs font-bold text-slate-900 dark:text-white truncate">Servicio</div>
                    </div>
                </button>

                <!-- Paso 2 -->
                <button type="button" data-step="2"
                    class="step-btn group flex items-center gap-3 p-3 rounded-2xl transition-all text-left w-full border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/60 opacity-60 cursor-not-allowed">
                    <div
                        class="step-circle w-9 h-9 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm flex items-center justify-center shrink-0">
                        2
                    </div>
                    <div class="min-w-0">
                        <div class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">
                            Paso 2</div>
                        <div class="text-xs font-bold text-slate-700 dark:text-slate-300 truncate">Profesional</div>
                    </div>
                </button>

                <!-- Paso 3 -->
                <button type="button" data-step="3"
                    class="step-btn group flex items-center gap-3 p-3 rounded-2xl transition-all text-left w-full border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/60 opacity-60 cursor-not-allowed">
                    <div
                        class="step-circle w-9 h-9 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm flex items-center justify-center shrink-0">
                        3
                    </div>
                    <div class="min-w-0">
                        <div class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">
                            Paso 3</div>
                        <div class="text-xs font-bold text-slate-700 dark:text-slate-300 truncate">Fecha y Hora</div>
                    </div>
                </button>

                <!-- Paso 4 -->
                <button type="button" data-step="4"
                    class="step-btn group flex items-center gap-3 p-3 rounded-2xl transition-all text-left w-full border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/60 opacity-60 cursor-not-allowed">
                    <div
                        class="step-circle w-9 h-9 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm flex items-center justify-center shrink-0">
                        4
                    </div>
                    <div class="min-w-0">
                        <div class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">
                            Paso 4</div>
                        <div class="text-xs font-bold text-slate-700 dark:text-slate-300 truncate">Confirmación</div>
                    </div>
                </button>
            </div>
        </div>

        <!-- ==========================================
             3. CONTENIDO DE LOS PASOS
             ========================================== -->

        <!-- PASO 1: Selección de Servicio -->
        <section id="step-content-1"
            class="step-content bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80 dark:border-slate-700/80 space-y-6">
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100 dark:border-slate-700/60">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Selecciona el Servicio
                        Médico o Asistencial</h2>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">Elige el área de consulta que
                        requieres para desplegar los especialistas disponibles.</p>
                </div>
                <span
                    class="inline-flex items-center text-xs font-bold px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 self-start sm:self-auto">
                    Paso 1 de 4
                </span>
            </div>

            <!-- Loader de Servicios -->
            <div id="loader-servicios" class="py-12 flex flex-col items-center justify-center gap-3 text-slate-400">
                <svg class="animate-spin h-8 w-8 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span class="text-xs font-semibold">Cargando catálogo de servicios clínicos...</span>
            </div>

            <!-- Grid de Servicios -->
            <div id="grid-servicios" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 hidden"></div>
        </section>

        <!-- PASO 2: Selección de Profesional -->
        <section id="step-content-2"
            class="step-content hidden bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80 dark:border-slate-700/80 space-y-6">
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100 dark:border-slate-700/60">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Selecciona a tu Profesional
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Especialistas disponibles para el servicio: <strong id="servicio-seleccionado-nombre"
                            class="text-teal-600 dark:text-teal-400"></strong>
                    </p>
                </div>
                <span
                    class="inline-flex items-center text-xs font-bold px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 self-start sm:self-auto">
                    Paso 2 de 4
                </span>
            </div>

            <!-- Loader de Profesionales -->
            <div id="loader-profesionales" class="py-12 flex flex-col items-center justify-center gap-3 text-slate-400">
                <svg class="animate-spin h-8 w-8 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span class="text-xs font-semibold">Buscando especialistas disponibles...</span>
            </div>

            <!-- Grid de Profesionales -->
            <div id="grid-profesionales" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 hidden"></div>
        </section>

        <!-- PASO 3: Selección de Fecha y Horario en Chips -->
        <section id="step-content-3"
            class="step-content hidden bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80 dark:border-slate-700/80 space-y-6">
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100 dark:border-slate-700/60">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Fecha y Horario de Consulta
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Atención con <strong id="profesional-seleccionado-nombre"
                            class="text-teal-600 dark:text-teal-400"></strong>
                    </p>
                </div>
                <span
                    class="inline-flex items-center text-xs font-bold px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 self-start sm:self-auto">
                    Paso 3 de 4
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Selector de Fecha -->
                <div
                    class="lg:col-span-5 space-y-4 bg-slate-50 dark:bg-slate-850 p-6 rounded-3xl border border-slate-200 dark:border-slate-700">
                    <label for="fecha-input" class="block text-sm font-bold text-slate-900 dark:text-white">
                        1. Elige el día de tu consulta:
                    </label>
                    <input type="date" id="fecha-input" min="<?= date('Y-m-d') ?>"
                        class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-white font-medium text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors shadow-sm cursor-pointer">

                    <div class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed space-y-1">
                        <p class="flex items-center gap-1.5 font-semibold text-slate-700 dark:text-slate-300">
                            <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Disponibilidad en tiempo real
                        </p>
                        <p>Al seleccionar una fecha, el sistema verificará automáticamente el horario laboral
                            configurado del especialista y las horas libres.</p>
                    </div>
                </div>

                <!-- Chips de Horarios Disponibles -->
                <div class="lg:col-span-7 space-y-4">
                    <label class="block text-sm font-bold text-slate-900 dark:text-white">
                        2. Horarios disponibles para ese día:
                    </label>

                    <!-- Estado Inicial (Sin Fecha Seleccionada) -->
                    <div id="slots-placeholder"
                        class="p-8 text-center rounded-3xl border border-dashed border-slate-300 dark:border-slate-700 text-slate-400 space-y-2">
                        <svg class="w-10 h-10 mx-auto text-slate-300 dark:text-slate-600" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-xs font-medium">Por favor selecciona una fecha en el calendario para consultar
                            los horarios libres.</p>
                    </div>

                    <!-- Loader de Slots -->
                    <div id="slots-loader"
                        class="hidden p-8 text-center rounded-3xl border border-slate-200 dark:border-slate-700 space-y-3">
                        <svg class="animate-spin h-7 w-7 text-teal-600 mx-auto" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <p class="text-xs text-slate-500 font-semibold">Consultando disponibilidad en la agenda...</p>
                    </div>

                    <!-- Mensaje de No Disponibilidad -->
                    <div id="slots-vacio"
                        class="hidden p-6 rounded-3xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-amber-900 dark:text-amber-200 text-xs space-y-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="font-bold text-sm" id="slots-vacio-titulo">Sin turnos disponibles para este
                                día</span>
                        </div>
                        <p id="slots-vacio-mensaje">Todos los turnos de este día ya pasaron o no hay atención
                            programada.</p>
                        <button type="button" id="btn-proximo-dia"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 active:scale-95 text-white font-bold rounded-xl shadow-xs transition cursor-pointer text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Consultar próximo día hábil con turnos libres &rarr;</span>
                        </button>
                    </div>

                    <!-- Grilla de Chips de Horarios -->
                    <div id="slots-grid" class="hidden grid grid-cols-2 sm:grid-cols-3 gap-3"></div>

                    <!-- Confirmación Visual de Hora Seleccionada -->
                    <div id="slot-seleccionado-card"
                        class="hidden p-4 sm:p-5 rounded-2xl bg-teal-50/80 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm">
                        <div class="flex items-center gap-3">
                            <span
                                class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <div>
                                <span
                                    class="text-[11px] font-bold uppercase tracking-wider text-teal-700 dark:text-teal-300">Horario
                                    de Consulta Seleccionado</span>
                                <p class="text-sm sm:text-base font-extrabold text-slate-800 dark:text-white"
                                    id="slot-seleccionado-texto">
                                    --:--
                                </p>
                            </div>
                        </div>
                        <button type="button" id="btn-continuar-paso4"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-teal-600 hover:bg-teal-700 active:scale-95 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-teal-600/20 transition cursor-pointer shrink-0">
                            <span>Continuar al Resumen</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- PASO 4: Resumen y Confirmación -->
        <section id="step-content-4"
            class="step-content hidden bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80 dark:border-slate-700/80 space-y-8">
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100 dark:border-slate-700/60">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Resumen y Confirmación de
                        la Cita</h2>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">Revisa los detalles antes de
                        confirmar tu reserva.</p>
                </div>
                <span
                    class="inline-flex items-center text-xs font-bold px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 self-start sm:self-auto">
                    Paso 4 de 4
                </span>
            </div>

            <!-- Ficha de Consulta -->
            <div
                class="bg-gradient-to-br from-teal-50/60 to-emerald-50/40 dark:from-slate-850 dark:to-slate-800 rounded-3xl p-6 sm:p-8 border border-teal-200/80 dark:border-slate-700 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Detalle Paciente -->
                    <div class="space-y-1">
                        <span
                            class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Paciente</span>
                        <div class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                            <?= htmlspecialchars($nombre) ?>
                        </div>
                    </div>

                    <!-- Detalle Servicio -->
                    <div class="space-y-1">
                        <span
                            class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Servicio
                            Solicitado</span>
                        <div id="resumen-servicio" class="text-base font-bold text-slate-900 dark:text-white">---</div>
                    </div>

                    <!-- Detalle Profesional -->
                    <div class="space-y-1">
                        <span
                            class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Especialista
                            Asignado</span>
                        <div id="resumen-profesional" class="text-base font-bold text-slate-900 dark:text-white">---
                        </div>
                    </div>

                    <!-- Detalle Fecha y Hora -->
                    <div class="space-y-1">
                        <span
                            class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Fecha
                            y Hora Programada</span>
                        <div class="text-base font-bold text-teal-700 dark:text-teal-300 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span id="resumen-fechahora">---</span>
                        </div>
                    </div>
                </div>

                <!-- Aviso Legal / Pautas Previas -->
                <div
                    class="pt-4 border-t border-teal-200/60 dark:border-slate-700 text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                    <strong>Recomendaciones para tu consulta:</strong> Conéctate o preséntate puntual 5 minutos antes.
                    Ten a mano tus exámenes clínicos o fórmulas médicas recientes para un aprovechamiento óptimo de tu
                    cita.
                </div>
            </div>

            <!-- Botón de Confirmación -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-4">
                <button type="button" id="btn-confirmar-cita"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-2xl bg-teal-600 hover:bg-teal-700 active:scale-95 text-white font-extrabold text-sm shadow-xl shadow-teal-600/30 hover:shadow-teal-600/40 transition-all cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    Confirmar y Reservar Cita
                </button>
            </div>
        </section>

        <!-- ==========================================
             4. BARRA DE CONTROL INFERIOR (ANTERIOR / SIGUIENTE)
             ========================================== -->
        <div
            class="bg-white dark:bg-slate-800 rounded-3xl p-4 sm:p-5 shadow-sm border border-slate-200/80 dark:border-slate-700/80 flex items-center justify-between gap-4">
            <button type="button" id="btn-anterior"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-bold text-xs border border-slate-200 dark:border-slate-600 transition-all disabled:opacity-40 disabled:cursor-not-allowed"
                disabled>
                &larr; Paso Anterior
            </button>

            <span id="step-indicator-text" class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                Paso 1 de 4
            </span>

            <button type="button" id="btn-siguiente"
                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs shadow-md shadow-teal-600/20 transition-all disabled:opacity-40 disabled:cursor-not-allowed"
                disabled>
                Continuar &rarr;
            </button>
        </div>

    </div>
</main>