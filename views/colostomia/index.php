<?php
$usuarioActualizado = !empty($_SESSION["actualizado"]);
$nombreUsuario = $_SESSION["nombre"] ?? "Paciente";
?>

<!-- Banner de Perfil Pendiente si no ha completado sus datos -->
<?php if (!$usuarioActualizado): ?>
    <div id="sticky-banner" tabindex="-1"
        class="fixed top-0 start-0 z-40 flex justify-between items-center w-full px-4 py-3 bg-amber-50 dark:bg-amber-950/80 border-b border-amber-200 dark:border-amber-800 text-amber-900 dark:text-amber-200 transition-all shadow-sm">
        <div class="flex items-center mx-auto text-xs sm:text-sm font-medium gap-2">
            <span class="inline-flex p-1 bg-amber-100 dark:bg-amber-900/60 rounded-full text-amber-700 dark:text-amber-300">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </span>
            <span>Personaliza tu experiencia clínica completando tu perfil y condición:</span>
            <a href="/public/perfil" class="font-bold underline hover:no-underline text-amber-800 dark:text-amber-100">
                Actualizar Perfil aquí &rarr;
            </a>
        </div>
        <button data-dismiss-target="#sticky-banner" type="button"
            class="text-amber-600 dark:text-amber-400 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg p-1.5 inline-flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
    </div>
<?php endif; ?>

<main class="min-h-screen bg-slate-50 dark:bg-slate-900 py-10 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto space-y-16">

        <!-- ==========================================
             1. HERO PRINCIPAL: Portal de Ostomía
             ========================================== -->
        <section class="relative bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-12 shadow-sm border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-emerald-500/10 dark:bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center relative z-10">
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-xs font-semibold text-emerald-800 dark:text-emerald-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        PROGRAMA DE ACOMPAÑAMIENTO EN OSTOMÍAS
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        Tu espacio de <span class="text-emerald-600 dark:text-emerald-400">cuidado, seguridad y autonomía</span>
                    </h1>

                    <p class="text-slate-600 dark:text-slate-300 text-base sm:text-lg leading-relaxed">
                        Bienvenido, <strong class="text-slate-900 dark:text-white"><?= htmlspecialchars($nombreUsuario) ?></strong>. Diseñamos este portal para acompañarte paso a paso: pautas profesionales de enfermería para el cuidado de tu estoma, recomendaciones de nutrición, acompañamiento psicoemocional y respaldo jurídico para garantizar tus insumos médicos.
                    </p>

                    <!-- Acciones Principales -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="/public/citas" 
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Agendar Cita con Especialista
                        </a>
                        <a href="/public/encuestaSalud" 
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-semibold text-sm border border-slate-200 dark:border-slate-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Autoevaluación de Salud
                        </a>
                    </div>

                    <!-- Insignias de Confianza Clínica -->
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-700/60 flex flex-wrap items-center gap-6 text-xs text-slate-500 dark:text-slate-400">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Enfermería Estomaterapeuta</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Atención Confidencial</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Protección Jurídica de Insumos</span>
                        </div>
                    </div>
                </div>

                <!-- Ilustración / Tarjeta Destacada -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="w-full max-w-sm bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-slate-800 dark:to-slate-850 p-6 rounded-3xl border border-emerald-100 dark:border-slate-700 shadow-inner space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-emerald-100 dark:border-slate-700">
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 dark:text-emerald-300">Kit de Bienestar Diario</span>
                            <span class="text-[11px] px-2 py-0.5 rounded-full bg-emerald-600 text-white font-semibold">Consejo Clave</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            "Recuerda que la piel periestomal debe lucir igual de sana que la piel del resto de tu abdomen. Medir el estoma antes de cada cambio evita que el efluente entre en contacto directo con tu piel."
                        </p>
                        <div class="pt-2 flex items-center justify-between">
                            <div class="flex items-center -space-x-2">
                                <img class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-800 object-cover" src="/public/build/img/perfil1.webp" alt="Especialista">
                                <img class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-800 object-cover" src="/public/build/img/perfil2.webp" alt="Especialista">
                                <img class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-800 object-cover" src="/public/build/img/perfil3.webp" alt="Especialista">
                            </div>
                            <a href="/public/medico" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                                Conocer el equipo &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================
             2. SEMÁFORO CLÍNICO: Autoevaluación del Estoma
             ========================================== -->
        <section aria-label="Semáforo Clínico">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Guía Visual de Monitoreo</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">¿Cómo está tu estoma hoy?</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                    Usa esta guía rápida para identificar signos saludables y saber con exactitud cuándo acudir a una consulta médica de urgencia.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tarjeta Verde: Estado Normal -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-t-4 border-t-emerald-500 border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-lg">
                                🟢
                            </span>
                            <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300">
                                Estado Óptimo
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Evolución Saludable</h3>
                        <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-2.5">
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500 font-bold">&check;</span>
                                <span>Estoma de color rojo vivo o rosado, húmedo y brillante.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500 font-bold">&check;</span>
                                <span>Piel alrededor lisa, sin irritación, ardor ni dolor persistente.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500 font-bold">&check;</span>
                                <span>Adherencia segura de la placa entre 3 y 5 días continuos.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 text-[11px] text-slate-500 dark:text-slate-400">
                        Continúa con tu rutina habitual de higiene y cambio de bolsa.
                    </div>
                </div>

                <!-- Tarjeta Amarilla: Atención y Prevención -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-t-4 border-t-amber-500 border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-2xl bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-lg">
                                🟡
                            </span>
                            <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300">
                                Signos de Atención
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Cuidados Específicos</h3>
                        <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-2.5">
                            <li class="flex items-start gap-2">
                                <span class="text-amber-500 font-bold">&bull;</span>
                                <span>Enrojecimiento leve o comezón al despegar el adhesivo.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-amber-500 font-bold">&bull;</span>
                                <span>Fugas tempranas antes de las 48 horas de colocado el dispositivo.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-amber-500 font-bold">&bull;</span>
                                <span>Exceso de gas o cambio temporal en la consistencia de las heces.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/citas" class="text-[11px] font-bold text-amber-600 dark:text-amber-400 hover:underline flex items-center justify-between">
                            <span>Consultar con enfermería estomaterapeuta</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Tarjeta Roja: Alerta Médica -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-t-4 border-t-red-500 border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-2xl bg-red-100 dark:bg-red-950/60 text-red-600 dark:text-red-400 flex items-center justify-center font-bold text-lg">
                                🔴
                            </span>
                            <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-red-100 text-red-800 dark:bg-red-950/60 dark:text-red-300">
                                Alerta / Urgencia
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Consulta Médica Urgente</h3>
                        <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-2.5">
                            <li class="flex items-start gap-2">
                                <span class="text-red-500 font-bold">&excl;</span>
                                <span>Coloración violácea, grisácea o negra (isquemia del estoma).</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500 font-bold">&excl;</span>
                                <span>Ausencia total de evacuación y gases por más de 24 horas con cólico o vómito.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500 font-bold">&excl;</span>
                                <span>Sangrado profuso que no cesa al hacer presión suave con gasa.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 text-[11px] font-bold text-red-600 dark:text-red-400">
                        Acude al servicio de urgencias médicas de tu hospital más cercano.
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================
             3. PILARES DE ACOMPAÑAMIENTO INTEGRAL
             ========================================== -->
        <section aria-label="Servicios Asistenciales">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Atención Multidisciplinaria</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Servicios Diseñados para Ti</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                    Accede a orientación médica especializada, apoyo psicológico, defensa de tus derechos y contenido de la comunidad.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- 1. Atención Médica & Estomaterapia -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700/80 hover:border-emerald-500/50 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            Atención Médica & Estomas
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Resuelve dudas sobre corte de placa, barreras convexas o planas, tratamiento de dermatitis y cuidado periestomal.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/citas" class="inline-flex items-center justify-between w-full text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                            <span>Agendar Consulta</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 2. Apoyo Psicoemocional -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700/80 hover:border-blue-500/50 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            Acompañamiento Emocional
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Espacio seguro y confidencial para superar miedos, reconstruir tu imagen corporal y retomar tu vida social y de pareja.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/psicologico" class="inline-flex items-center justify-between w-full text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">
                            <span>Ver Asesoría Psicológica</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 3. Respaldo Jurídico y Derechos EPS -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700/80 hover:border-indigo-500/50 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Derechos y Amparo en Salud
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Orientación legal y plantillas de derecho de petición / tutela para garantizar la entrega mensual de tus bolsas e insumos.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/juridico" class="inline-flex items-center justify-between w-full text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                            <span>Ver Asesoría Jurídica</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 4. Comunidad y Blog -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700/80 hover:border-rose-500/50 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                            Blog y Guías Prácticas
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Historias reales, consejos para viajar en avión, pautas de vestimenta, hidratación y cómo hacer deporte con total tranquilidad.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/blogplantilla" class="inline-flex items-center justify-between w-full text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline">
                            <span>Leer Publicaciones</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================
             4. GUÍAS ESENCIALES DE AUTOCUIDADO DIARIO
             ========================================== -->
        <section class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 border border-slate-200/80 dark:border-slate-700/80 shadow-sm" aria-label="Pautas Diarias">
            <div class="max-w-2xl mb-8">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Autonomía y Confort</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Pautas Prácticas para el Día a Día</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                    Principios esenciales recomendados por estomaterapeutas para mantener tu piel sana y vivir con plenitud.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Paso 1 -->
                <div class="space-y-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-extrabold text-sm flex items-center justify-center">
                        1
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Higiene y Cambio Seguro</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Limpia con agua tibia y jabón suave. Seca a toques suaves con gasa sin frotar. Mide periódicamente el estoma con una guía milimétrica para recortar la barrera a la medida exacta sin dejar piel expuesta.
                    </p>
                </div>

                <!-- Paso 2 -->
                <div class="space-y-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-extrabold text-sm flex items-center justify-center">
                        2
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Alimentación y Control de Gases</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Mastica despacio cada bocado e hidrátate con 1.5 a 2 litros de líquido al día. Alimentos como arroz, plátano y manzana ayudan a espesar el efluente; modera las bebidas gaseosas y legumbres en reuniones sociales.
                    </p>
                </div>

                <!-- Paso 3 -->
                <div class="space-y-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-extrabold text-sm flex items-center justify-center">
                        3
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Actividad Física y Vida Social</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Puedes caminar, nadar y ejercitarte sin restricciones de impacto. El uso de fundas de tela y fajas abdominales elásticas proporciona firmeza, discreción total y evita la formación de hernias paraestomales.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==========================================
             5. INVESTIGACIONES Y EVIDENCIA CIENTÍFICA
             ========================================== -->
        <section aria-label="Investigaciones Médicas">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Evidencia Médica y Ciencia</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Investigaciones en Ostomías</h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Estudios clínicos y avances científicos recientes publicados por nuestra comunidad médica.
                    </p>
                </div>
                <a href="/public/investigaciones" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                    <span>Ver todas las investigaciones</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Listado centralizado de investigaciones -->
            <?php include __DIR__ . '/../paginas/listadoInvestigaciones.php'; ?>
        </section>

    </div>
</main>