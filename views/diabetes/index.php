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
            <span>Personaliza tu seguimiento glucémico completando tu perfil y condición:</span>
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
             1. HERO PRINCIPAL: Portal de Diabetes
             ========================================== -->
        <section class="relative bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-12 shadow-sm border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-teal-500/10 dark:bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center relative z-10">
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 dark:bg-teal-950/60 border border-teal-200 dark:border-teal-800 text-xs font-semibold text-teal-800 dark:text-teal-300">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        PROGRAMA DE CONTROL INTEGRAL DE DIABETES
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        Tu espacio de <span class="text-teal-600 dark:text-teal-400">control glucémico, salud y bienestar</span>
                    </h1>

                    <p class="text-slate-600 dark:text-slate-300 text-base sm:text-lg leading-relaxed">
                        Bienvenido, <strong class="text-slate-900 dark:text-white"><?= htmlspecialchars($nombreUsuario) ?></strong>. Te acompañamos en cada paso de tu cuidado: pautas clínicas para el monitoreo de glucosa, nutrición metabólica personalizada, cuidado de pies, apoyo psicoemocional y respaldo legal para garantizar tus medicamentos e insulinas.
                    </p>

                    <!-- Acciones Principales -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="/public/citas" 
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white font-semibold text-sm shadow-lg shadow-teal-600/25 hover:shadow-teal-600/40 hover:-translate-y-0.5 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Agendar Cita Médica
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
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Atención Médica & Nutricional</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Apoyo en Fatiga por Diabetes</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Protección y Cobertura de Medicamentos</span>
                        </div>
                    </div>
                </div>

                <!-- Ilustración / Tarjeta Destacada -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="w-full max-w-sm bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-slate-800 dark:to-slate-850 p-6 rounded-3xl border border-teal-100 dark:border-slate-700 shadow-inner space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-teal-100 dark:border-slate-700">
                            <span class="text-xs font-bold uppercase tracking-wider text-teal-800 dark:text-teal-300">Regla Clave de Oro</span>
                            <span class="text-[11px] px-2 py-0.5 rounded-full bg-teal-600 text-white font-semibold">Salud Diaria</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            "Llevar un registro constante de tus niveles en ayunas y postprandiales (2h después de comer) te empodera para tomar mejores decisiones nutricionales y prevenir complicaciones a largo plazo."
                        </p>
                        <div class="pt-2 flex items-center justify-between">
                            <div class="flex items-center -space-x-2">
                                <img class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-800 object-cover" src="/public/build/img/perfil1.webp" alt="Especialista">
                                <img class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-800 object-cover" src="/public/build/img/perfil2.webp" alt="Especialista">
                                <img class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-800 object-cover" src="/public/build/img/perfil3.webp" alt="Especialista">
                            </div>
                            <a href="/public/medico" class="text-xs font-bold text-teal-600 dark:text-teal-400 hover:underline">
                                Conocer el equipo &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================
             2. SEMÁFORO CLÍNICO GLUCÉMICO
             ========================================== -->
        <section aria-label="Semáforo Glucémico">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-teal-600 dark:text-teal-400">Guía de Niveles Glucémicos</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">¿Cómo están tus niveles hoy?</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                    Conoce los rangos objetivo de glucosa en sangre y las pautas de acción inmediata ante variaciones.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tarjeta Verde: Rango Objetivo -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-t-4 border-t-emerald-500 border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-lg">
                                🟢
                            </span>
                            <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300">
                                Rango Objetivo
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Control Glucémico Óptimo</h3>
                        <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-2.5">
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500 font-bold">&check;</span>
                                <span><strong>En ayunas:</strong> 70 a 130 mg/dL según guías médicas.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500 font-bold">&check;</span>
                                <span><strong>Postprandial (2h):</strong> Menor a 180 mg/dL.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500 font-bold">&check;</span>
                                <span>Energía estable, visión clara y ausencia de mareos o temblores.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 text-[11px] text-slate-500 dark:text-slate-400">
                        Excelente trabajo. Mantén tu plan de alimentación y actividad física regular.
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
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Variaciones Glucémicas</h3>
                        <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-2.5">
                            <li class="flex items-start gap-2">
                                <span class="text-amber-500 font-bold">&bull;</span>
                                <span><strong>Hipoglucemia leve (55 - 69 mg/dL):</strong> Sudor frío, temblor, hambre súbita. Aplicar regla de 15g carbohidrato simple.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-amber-500 font-bold">&bull;</span>
                                <span><strong>Hiperglucemia moderada (180 - 250 mg/dL):</strong> Sed excesiva, aumento de micción, cansancio.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/citas" class="text-[11px] font-bold text-amber-600 dark:text-amber-400 hover:underline flex items-center justify-between">
                            <span>Ajustar pautas con tu médico o nutricionista</span>
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
                                Alerta Inmediata
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Consulta de Urgencia</h3>
                        <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-2.5">
                            <li class="flex items-start gap-2">
                                <span class="text-red-500 font-bold">&excl;</span>
                                <span><strong>Hipoglucemia grave (&lt; 54 mg/dL):</strong> Desorientación, dificultad para hablar o pérdida de conciencia.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500 font-bold">&excl;</span>
                                <span><strong>Hiperglucemia severa (&gt; 250 mg/dL persistente):</strong> Náuseas, vómitos, dolor abdominal o aliento cetónico frutal.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 text-[11px] font-bold text-red-600 dark:text-red-400">
                        Acude a un centro de urgencias o contacta inmediatamente a tu servicio de salud.
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================
             3. PILARES DE ATENCIÓN Y ACOMPAÑAMIENTO
             ========================================== -->
        <section aria-label="Servicios Asistenciales">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-teal-600 dark:text-teal-400">Atención Multidisciplinaria</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Servicios Especializados para Diabetes</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                    Accede a orientación médica especializada, asesoría nutricional, apoyo psicológico y protección legal de tus tratamientos.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- 1. Atención Médica & Control Glucémico -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700/80 hover:border-teal-500/50 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                            Atención Médica & Control
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Interpretación de hemoglobina glicosilada (HbA1c), ajuste de esquemas de insulina o fármacos orales y chequeos preventivos.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/citas" class="inline-flex items-center justify-between w-full text-xs font-bold text-teal-600 dark:text-teal-400 hover:underline">
                            <span>Agendar Consulta Médica</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 2. Apoyo Psicoemocional & Fatiga por Diabetes -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700/80 hover:border-blue-500/50 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            Salud Emocional & Fatiga
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Manejo del agotamiento por monitoreo continuo, ansiedad frente a hipoglucemias y adaptación psicológica a hábitos saludables.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/psicologico" class="inline-flex items-center justify-between w-full text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">
                            <span>Ver Asesoría Psicológica</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 3. Respaldo Jurídico & Medicamentos EPS -->
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
                            Orientación legal para garantizar la entrega ininterrumpida de insulinas, tiras reactivas, sensores continuos y lancetas por tu EPS.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/juridico" class="inline-flex items-center justify-between w-full text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                            <span>Ver Asesoría Jurídica</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 4. Comunidad, Nutrición y Blog -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700/80 hover:border-emerald-500/50 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            Nutrición & Artículos
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Recetas con bajo índice glucémico, método del plato, guías para el ejercicio seguro y avances científicos en diabetes.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <a href="/public/blogplantilla" class="inline-flex items-center justify-between w-full text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
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
                <span class="text-xs font-bold uppercase tracking-wider text-teal-600 dark:text-teal-400">Hábitos Saludables Diarios</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Pautas Prácticas para el Día a Día</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                    Pilares clínicos recomendados por educadores en diabetes para mantener tu estabilidad metabólica y prevenir complicaciones.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Paso 1 -->
                <div class="space-y-3">
                    <div class="w-8 h-8 rounded-full bg-teal-100 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 font-extrabold text-sm flex items-center justify-center">
                        1
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Monitoreo Constante & Registro</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Mide tu glucosa antes del desayuno y 2 horas tras las comidas principales. Anota tus lecturas junto con lo que comiste para comprender cómo responde tu organismo a distintos alimentos.
                    </p>
                </div>

                <!-- Paso 2 -->
                <div class="space-y-3">
                    <div class="w-8 h-8 rounded-full bg-teal-100 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 font-extrabold text-sm flex items-center justify-center">
                        2
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">El Método del Plato Saludable</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Divide tu plato: 50% verduras sin almidón (espinaca, brócoli, ensaladas), 25% proteínas de calidad (pescado, pollo, huevo, tofu) y 25% carbohidratos integrales ricos en fibra (lentejas, quinua, arroz integral).
                    </p>
                </div>

                <!-- Paso 3 -->
                <div class="space-y-3">
                    <div class="w-8 h-8 rounded-full bg-teal-100 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 font-extrabold text-sm flex items-center justify-center">
                        3
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Inspección Diaria de Pies</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Revisa tus pies cada noche en busca de cortes, ampollas o cambios de coloración. Usa calzado cómodo sin costuras rígidas, hidrata la piel evitando el espacio entre los dedos y nunca camines descalzo.
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
                    <span class="text-xs font-bold uppercase tracking-wider text-teal-600 dark:text-teal-400">Evidencia Médica y Ciencia</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Investigaciones en Diabetes</h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Estudios clínicos y avances científicos recientes en metabolismo y diabetes publicados por nuestra comunidad médica.
                    </p>
                </div>
                <a href="/public/investigaciones" class="inline-flex items-center gap-1.5 text-xs font-bold text-teal-600 dark:text-teal-400 hover:underline">
                    <span>Ver todas las investigaciones</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Listado centralizado de investigaciones -->
            <?php include __DIR__ . '/../paginas/listadoInvestigaciones.php'; ?>
        </section>

    </div>
</main>