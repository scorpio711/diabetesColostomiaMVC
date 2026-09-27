<?php
$versionJs = time();
$script = "<script src='/public/build/js/misCitas.js?v={$versionJs}'></script>";
?>

<main class="min-h-screen bg-slate-50 dark:bg-slate-900 py-10 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- ==========================================
             1. HEADER Y ESTADÍSTICAS RÁPIDAS
             ========================================== -->
        <div class="relative bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-teal-500/10 dark:bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-3 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-50 dark:bg-teal-950/60 border border-teal-200 dark:border-teal-800 text-xs font-semibold text-teal-800 dark:text-teal-300">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        HISTORIAL Y AGENDA CLÍNICA DEL PACIENTE
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Mis <span class="text-teal-600 dark:text-teal-400">Citas Médicas</span>
                    </h1>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Bienvenido, <strong class="text-slate-900 dark:text-white"><?= htmlspecialchars($nombre ?? 'Paciente') ?></strong>. Revisa tus consultas programadas, los datos de contacto de tus especialistas y el historial de tus atenciones de salud.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <?php if (!empty($enfermedad) && $enfermedad === 'diabetes'): ?>
                        <a href="/public/diabetes" 
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-xs font-bold border border-slate-200 dark:border-slate-600 transition-colors">
                            &larr; Portal Diabetes
                        </a>
                    <?php elseif (!empty($enfermedad) && $enfermedad === 'colostomia'): ?>
                        <a href="/public/colostomia" 
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-xs font-bold border border-slate-200 dark:border-slate-600 transition-colors">
                            &larr; Portal Colostomía
                        </a>
                    <?php else: ?>
                        <a href="/public" 
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-xs font-bold border border-slate-200 dark:border-slate-600 transition-colors">
                            &larr; Inicio
                        </a>
                    <?php endif; ?>

                    <a href="/public/citas" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-teal-600 hover:bg-teal-700 active:scale-95 text-white text-xs font-bold shadow-md shadow-teal-600/20 transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Agendar Nueva Cita
                    </a>
                </div>
            </div>

            <!-- KPIs de Resumen -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8 pt-6 border-t border-slate-100 dark:border-slate-700/60">
                <div class="p-4 rounded-2xl bg-teal-50/60 dark:bg-teal-950/30 border border-teal-100 dark:border-teal-900/40 flex items-center gap-3.5">
                    <span class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <div>
                        <div class="text-[11px] font-bold uppercase tracking-wider text-teal-700 dark:text-teal-300">Citas Activas</div>
                        <div class="text-xl font-extrabold text-slate-900 dark:text-white"><?= (int)($totalProximas ?? 0) ?></div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 flex items-center gap-3.5">
                    <span class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <div>
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Atenciones Finalizadas</div>
                        <div class="text-xl font-extrabold text-slate-900 dark:text-white"><?= (int)($totalPasadas ?? 0) ?></div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 flex items-center gap-3.5">
                    <span class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center font-bold text-sm shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </span>
                    <div>
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Total Reservas</div>
                        <div class="text-xl font-extrabold text-slate-900 dark:text-white"><?= count($citas ?? []) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================================
             2. FILTROS Y BÚSQUEDA INTERACTIVA
             ========================================== -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-4 sm:p-6 shadow-sm border border-slate-200/80 dark:border-slate-700/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Barra de búsqueda rápida -->
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" 
                       id="input-busqueda-citas" 
                       placeholder="Buscar por especialista, servicio o fecha..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 text-xs sm:text-sm text-slate-900 dark:text-white focus:outline-hidden focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
            </div>

            <!-- Filtros por estado -->
            <div class="flex items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-700/60 rounded-2xl self-start md:self-auto overflow-x-auto max-w-full">
                <button type="button" 
                        data-filter="todas" 
                        class="tab-filtro px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all bg-white dark:bg-slate-800 text-teal-700 dark:text-teal-300 shadow-xs cursor-pointer">
                    Todas (<?= count($citas ?? []) ?>)
                </button>
                <button type="button" 
                        data-filter="proxima" 
                        class="tab-filtro px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 transition-all cursor-pointer">
                    Próximas (<?= (int)($totalProximas ?? 0) ?>)
                </button>
                <button type="button" 
                        data-filter="pasada" 
                        class="tab-filtro px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 transition-all cursor-pointer">
                    Finalizadas (<?= (int)($totalPasadas ?? 0) ?>)
                </button>
            </div>
        </div>

        <!-- ==========================================
             3. LISTADO DE TARJETAS DE CITAS
             ========================================== -->
        <?php if (empty($citas)): ?>
            <!-- Estado vacío: Sin citas registradas -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200/80 dark:border-slate-700/80 shadow-sm space-y-4">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="space-y-1 max-w-md mx-auto">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Aún no tienes citas agendadas</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Accede al centro de atención para elegir la especialidad que necesitas y reservar tu primera consulta con nuestros profesionales.
                    </p>
                </div>
                <div class="pt-2">
                    <a href="/public/citas" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-teal-600 hover:bg-teal-700 active:scale-95 text-white font-bold text-xs shadow-md shadow-teal-600/20 transition-all">
                        <span>Agendar mi primera cita</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div id="citas-grid" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <?php foreach ($citas as $cita): 
                    $esPasada = ($cita->estado === 'pasada');
                    $esHoy = ($cita->estado === 'hoy');
                    $imgSrc = !empty($cita->imagen_profesional) ? "/public/imagenesUsuarios/{$cita->imagen_profesional}" : "/public/build/img/avatar.webp";
                    
                    // Colores temáticos por disciplina
                    $profLower = strtolower($cita->profesion ?? '');
                    $colorTag = 'teal';
                    if (strpos($profLower, 'abogad') !== false) $colorTag = 'indigo';
                    elseif (strpos($profLower, 'psicolog') !== false) $colorTag = 'violet';
                ?>
                    <article class="cita-card group relative p-6 rounded-3xl bg-white dark:bg-slate-800 border <?= $esHoy ? 'border-teal-500 ring-2 ring-teal-500/20 shadow-md' : 'border-slate-200/80 dark:border-slate-700/80 shadow-xs' ?> hover:shadow-md transition-all flex flex-col justify-between"
                             data-estado="<?= htmlspecialchars($cita->estado) ?>"
                             data-search="<?= htmlspecialchars(strtolower(($cita->nombre_servicio ?? '') . ' ' . ($cita->nombre_profesional ?? '') . ' ' . ($cita->fechaFormateada ?? '') . ' ' . ($cita->especializacion ?? ''))) ?>">

                        <!-- Header de la Tarjeta (Servicio y Estado) -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between gap-3">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold tracking-wide uppercase bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                                    <span class="w-1.5 h-1.5 rounded-full <?= $colorTag === 'teal' ? 'bg-teal-500' : ($colorTag === 'indigo' ? 'bg-indigo-500' : 'bg-violet-500') ?>"></span>
                                    <?= htmlspecialchars($cita->nombre_servicio ?: 'Consulta General') ?>
                                </span>

                                <?php if ($esHoy): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-100 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300 font-extrabold text-[11px]">
                                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                        Para Hoy
                                    </span>
                                <?php elseif ($esPasada): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 font-semibold text-[11px]">
                                        Finalizada
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 font-bold text-[11px]">
                                        Confirmada ✓
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Información del Profesional -->
                            <div class="flex items-center gap-4 pt-1">
                                <img src="<?= htmlspecialchars($imgSrc) ?>" 
                                     alt="<?= htmlspecialchars($cita->nombre_profesional) ?>"
                                     class="w-13 h-13 rounded-2xl object-cover border-2 border-slate-200 dark:border-slate-700 shrink-0"
                                     onerror="this.src='/public/build/img/avatar.webp'">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-base font-bold text-slate-900 dark:text-white truncate">
                                        <?= htmlspecialchars($cita->nombre_profesional) ?>
                                    </h3>
                                    <p class="text-xs text-teal-600 dark:text-teal-400 font-semibold truncate capitalize">
                                        <?= htmlspecialchars($cita->especializacion ?: $cita->profesion) ?>
                                    </p>
                                    <?php if (!empty($cita->email_profesional)): ?>
                                        <p class="text-[11px] text-slate-400 dark:text-slate-500 truncate mt-0.5">
                                            <?= htmlspecialchars($cita->email_profesional) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Bloque de Horario y Fecha -->
                            <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750/70 border border-slate-200/80 dark:border-slate-700 flex items-center justify-between gap-3">
                                <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-200">
                                    <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-bold capitalize"><?= htmlspecialchars($cita->fechaFormateada) ?></span>
                                </div>
                                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-white dark:bg-slate-800 text-teal-700 dark:text-teal-300 font-extrabold text-xs shadow-2xs border border-slate-200/60 dark:border-slate-700">
                                    <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span><?= htmlspecialchars($cita->horaFormateada) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer de la Tarjeta y Acciones -->
                        <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between gap-3">
                            <span class="text-[11px] text-slate-400 font-medium">
                                Cita ID #<?= (int)$cita->citaId ?>
                            </span>

                            <div class="flex items-center gap-2">
                                <?php if (!$esPasada): ?>
                                    <!-- Botón Cancelar con Diálogo SweetAlert -->
                                    <form method="POST" action="/public/misCitas" class="form-cancelar-cita">
                                        <input type="hidden" name="citaId" value="<?= (int)$cita->citaId ?>">
                                        <button type="button" 
                                                class="btn-cancelar-modal inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-rose-200 dark:border-rose-900/60 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 text-xs font-bold transition-all active:scale-95 cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            <span>Cancelar Cita</span>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <a href="/public/citas" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition-colors">
                                        <span>Volver a agendar</span>
                                        <svg class="w-3.5 h-3.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Mensaje cuando la búsqueda no coincide con ninguna tarjeta -->
            <div id="citas-sin-resultados" class="hidden bg-white dark:bg-slate-800 rounded-3xl p-10 text-center border border-slate-200/80 dark:border-slate-700/80 space-y-3">
                <svg class="w-10 h-10 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <div class="space-y-1">
                    <h4 class="text-sm font-bold text-slate-800 dark:text-white">No se encontraron citas con esos criterios</h4>
                    <p class="text-xs text-slate-500">Prueba con otro término de búsqueda o selecciona la pestaña "Todas".</p>
                </div>
                <button type="button" id="btn-limpiar-busqueda" class="text-xs font-bold text-teal-600 hover:underline cursor-pointer">
                    Limpiar búsqueda
                </button>
            </div>
        <?php endif; ?>

    </div>
</main>