<main class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Header Principal de Pacientes -->
        <header class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 dark:border-slate-700/80 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-teal-500/10 dark:bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300 mb-3 border border-teal-200 dark:border-teal-800">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        EXPEDIENTES & ATENCIÓN ASISTENCIAL &middot; <?= strtoupper(htmlspecialchars($rol)) ?>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Directorio Clínico de <span class="text-teal-600 dark:text-teal-400">Pacientes</span>
                    </h1>
                    <p class="mt-2 text-slate-600 dark:text-slate-300 text-sm sm:text-base max-w-2xl leading-relaxed">
                        Visualiza expedientes clínicos, datos sociodemográficos, canales de contacto y el estado de encuestas especializadas de cada paciente asignado.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" id="btnExportarPacientes"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm text-emerald-700 bg-emerald-100 hover:bg-emerald-200 dark:bg-emerald-950/60 dark:text-emerald-300 dark:hover:bg-emerald-900/60 border border-emerald-200 dark:border-emerald-800 transition-colors shadow-xs">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Exportar Excel / CSV
                    </button>
                    <a href="/public/admin/index"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-medium text-sm text-slate-700 dark:text-slate-200 bg-white hover:bg-slate-100 dark:bg-slate-700 dark:hover:bg-slate-600 border border-slate-200 dark:border-slate-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Volver
                    </a>
                </div>
            </div>
        </header>

        <!-- Métricas Clínicas Rápidas (KPIs) -->
        <section aria-label="Estadísticas de Pacientes" class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-100 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Pacientes</span>
                    <p class="text-2xl font-black text-slate-900 dark:text-white"><?= intval($stats['total'] ?? count($pacientes)) ?></p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                    <span class="text-xl">🩺</span>
                </div>
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Ostomizados</span>
                    <p class="text-2xl font-black text-emerald-600 dark:text-emerald-400"><?= intval($stats['colostomia'] ?? 0) ?></p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center flex-shrink-0">
                    <span class="text-xl">🩸</span>
                </div>
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Diabéticos</span>
                    <p class="text-2xl font-black text-blue-600 dark:text-blue-400"><?= intval($stats['diabetes'] ?? 0) ?></p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Con Encuestas</span>
                    <p class="text-2xl font-black text-purple-600 dark:text-purple-400"><?= intval($stats['encuestas'] ?? 0) ?></p>
                </div>
            </div>
        </section>

        <!-- Barra de Búsqueda y Filtros Rápidos -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
            
            <!-- Campo de Búsqueda en Vivo -->
            <div class="w-full md:w-80 relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" id="buscadorPacientes"
                    class="bg-slate-50 dark:bg-slate-700/60 border border-slate-200 dark:border-slate-600 text-slate-900 dark:text-white text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block w-full pl-10 p-2.5 transition-colors placeholder:text-slate-400"
                    placeholder="Buscar por nombre, email, teléfono, ciudad..." />
            </div>

            <!-- Botones de Filtro por Condición -->
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-1 hidden sm:inline">Filtrar:</span>
                <button type="button" class="filtro-btn active px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all bg-teal-600 text-white shadow-xs" data-filtro="todos">
                    Todos
                </button>
                <button type="button" class="filtro-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all" data-filtro="colostomia">
                    🩺 Colostomía
                </button>
                <button type="button" class="filtro-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all" data-filtro="diabetes">
                    🩸 Diabetes
                </button>
                <button type="button" class="filtro-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all" data-filtro="encuestas">
                    📑 Con Encuestas
                </button>
            </div>

            <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                Mostrando <span id="conteoPacientes" class="font-bold text-teal-600 dark:text-teal-400"><?= count($pacientes) ?></span> paciente(s)
            </div>
        </div>

        <!-- Tabla Clínica de Pacientes -->
        <section class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300" id="tablaPacientes">
                    <thead class="text-xs uppercase tracking-wider bg-slate-100/80 dark:bg-slate-700/50 text-slate-700 dark:text-slate-200 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th scope="col" class="px-5 py-4">Paciente</th>
                            <th scope="col" class="px-5 py-4">Diagnóstico</th>
                            <th scope="col" class="px-5 py-4">Contacto Directo</th>
                            <th scope="col" class="px-5 py-4">Perfil Social</th>
                            <th scope="col" class="px-5 py-4">Red de Apoyo</th>
                            <th scope="col" class="px-5 py-4 text-center">Encuestas</th>
                            <th scope="col" class="px-5 py-4 text-right">Expediente</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                        <?php if (empty($pacientes)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    No se encontraron pacientes registrados en la base de datos.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pacientes as $paciente): ?>
                                <?php
                                $enf = strtolower(trim($paciente->enfermedad ?? ''));
                                $tieneEncuesta = (!empty($paciente->encuesta_salud) || !empty($paciente->encuesta_psicologia) || !empty($paciente->encuesta_juridico));
                                $imgSrc = !empty($paciente->imagen)
                                    ? "/public/imagenesUsuarios/" . htmlspecialchars($paciente->imagen)
                                    : "https://ui-avatars.com/api/?name=" . urlencode($paciente->nombre ?: 'Paciente') . "&background=0D9488&color=fff";
                                ?>
                                <tr class="paciente-fila hover:bg-slate-50/80 dark:hover:bg-slate-700/30 transition-colors"
                                    data-enfermedad="<?= htmlspecialchars($enf) ?>"
                                    data-encuestas="<?= $tieneEncuesta ? '1' : '0' ?>"
                                    data-search="<?= htmlspecialchars(strtolower(($paciente->nombre ?? '') . ' ' . ($paciente->email ?? '') . ' ' . ($paciente->telefono ?? '') . ' ' . ($paciente->lugar_de_residencia ?? '') . ' ' . ($paciente->pacienteId ?? ''))) ?>">

                                    <!-- 1. Paciente (Avatar + Nombre + Edad) -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($paciente->nombre) ?>"
                                                 class="w-11 h-11 rounded-2xl object-cover border border-slate-200 dark:border-slate-700 flex-shrink-0" />
                                            <div>
                                                <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                                    <?= htmlspecialchars($paciente->nombre) ?>
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 flex items-center gap-1.5">
                                                    <span>ID #<?= $paciente->pacienteId ?></span>
                                                    <span>&middot;</span>
                                                    <span><?= $paciente->edad ? $paciente->edad . ' años' : 'Edad N/D' ?></span>
                                                    <span>&middot;</span>
                                                    <span class="capitalize"><?= htmlspecialchars($paciente->sexo ?: 'N/D') ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- 2. Diagnóstico / Patología -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <?php if ($enf === 'colostomia'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                                                <span>🩺</span> Colostomía
                                            </span>
                                        <?php elseif ($enf === 'diabetes'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                                <span>🩸</span> Diabetes
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                                En Evaluación
                                            </span>
                                        <?php endif; ?>
                                        <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                            Ev: <?= htmlspecialchars($paciente->tiempo_enfermedad ?: 'No especificado') ?>
                                        </div>
                                    </td>

                                    <!-- 3. Contacto Directo -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="flex flex-col gap-1">
                                            <?php if (!empty($paciente->telefono)): ?>
                                                <div class="flex items-center gap-2">
                                                    <a href="tel:<?= htmlspecialchars($paciente->telefono) ?>"
                                                       class="text-xs font-semibold text-slate-700 dark:text-slate-300 hover:text-teal-600 flex items-center gap-1">
                                                        <svg class="w-3.5 h-3.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                        <?= htmlspecialchars($paciente->telefono) ?>
                                                    </a>
                                                    <a href="https://wa.me/57<?= preg_replace('/\D/', '', $paciente->telefono) ?>" target="_blank"
                                                       class="text-[10px] px-1.5 py-0.5 rounded-md bg-emerald-100 text-emerald-800 font-bold hover:bg-emerald-200">
                                                        WhatsApp
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400">Sin teléfono</span>
                                            <?php endif; ?>

                                            <?php if (!empty($paciente->email)): ?>
                                                <a href="mailto:<?= htmlspecialchars($paciente->email) ?>"
                                                   class="text-xs text-slate-500 dark:text-slate-400 hover:text-teal-600 truncate max-w-[160px]">
                                                    <?= htmlspecialchars($paciente->email) ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    <!-- 4. Perfil Sociodemográfico -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="text-xs text-slate-900 dark:text-white font-medium">
                                            <?= htmlspecialchars($paciente->lugar_de_residencia ?: 'No registrada') ?>
                                        </div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                            Estrato: <?= htmlspecialchars($paciente->estrato_socioeconomico ?: 'N/D') ?> &middot; EPS: <?= htmlspecialchars($paciente->afiliacion ?: 'N/D') ?>
                                        </div>
                                    </td>

                                    <!-- 5. Red de Apoyo & Ocupación -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="text-xs font-semibold text-slate-800 dark:text-slate-200">
                                            <?= htmlspecialchars($paciente->apoyo ?: 'Sin red registrada') ?>
                                        </div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                            <?= htmlspecialchars($paciente->ocupacion ?: 'Ocupación no especificada') ?>
                                        </div>
                                    </td>

                                    <!-- 6. Encuestas Clínicas -->
                                    <td class="px-5 py-4 whitespace-nowrap text-center">
                                        <div class="inline-flex items-center gap-1.5">
                                            <span title="Encuesta de Salud"
                                                  class="w-6 h-6 rounded-lg flex items-center justify-center text-xs font-bold <?= !empty($paciente->encuesta_salud) ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-slate-100 text-slate-400 dark:bg-slate-700/60' ?>">
                                                M
                                            </span>
                                            <span title="Encuesta Psicológica"
                                                  class="w-6 h-6 rounded-lg flex items-center justify-center text-xs font-bold <?= !empty($paciente->encuesta_psicologia) ? 'bg-blue-100 text-blue-800 dark:bg-blue-950 dark:text-blue-300' : 'bg-slate-100 text-slate-400 dark:bg-slate-700/60' ?>">
                                                P
                                            </span>
                                            <span title="Encuesta Jurídica"
                                                  class="w-6 h-6 rounded-lg flex items-center justify-center text-xs font-bold <?= !empty($paciente->encuesta_juridico) ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-950 dark:text-indigo-300' : 'bg-slate-100 text-slate-400 dark:bg-slate-700/60' ?>">
                                                J
                                            </span>
                                        </div>
                                    </td>

                                    <!-- 7. Acciones (Ver Expediente) -->
                                    <td class="px-5 py-4 whitespace-nowrap text-right">
                                        <button type="button" data-modal-target="expedienteModal<?= $paciente->pacienteId ?>" data-modal-toggle="expedienteModal<?= $paciente->pacienteId ?>"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl font-semibold text-xs text-teal-700 bg-teal-50 hover:bg-teal-100 dark:bg-teal-950/40 dark:text-teal-300 dark:hover:bg-teal-900/60 border border-teal-200 dark:border-teal-800 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Expediente
                                        </button>
                                    </td>
                                </tr>

                                <!-- MODAL EXPEDIENTE COMPLETO PARA CADA PACIENTE -->
                                <div id="expedienteModal<?= $paciente->pacienteId ?>" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-slate-900/50 backdrop-blur-xs">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <div class="relative bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                                            
                                            <!-- Encabezado del Expediente -->
                                            <div class="p-6 bg-gradient-to-r from-teal-600 to-emerald-700 text-white flex items-center justify-between">
                                                <div class="flex items-center gap-4">
                                                    <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($paciente->nombre) ?>"
                                                         class="w-16 h-16 rounded-2xl object-cover border-2 border-white/30 shadow-md bg-white/10" />
                                                    <div>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-white/20 text-white mb-1">
                                                            Expediente Clínico &middot; ID #<?= $paciente->pacienteId ?>
                                                        </span>
                                                        <h3 class="text-xl font-black leading-tight"><?= htmlspecialchars($paciente->nombre) ?></h3>
                                                        <p class="text-xs text-teal-100 mt-0.5">
                                                            <?= $paciente->edad ? $paciente->edad . ' años' : 'Edad N/D' ?> &middot; <?= htmlspecialchars($paciente->sexo ?: 'Sexo N/D') ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <button type="button" class="text-white/80 hover:text-white rounded-lg p-1.5 transition-colors"
                                                        data-modal-toggle="expedienteModal<?= $paciente->pacienteId ?>">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Cuerpo del Expediente -->
                                            <div class="p-6 space-y-6 text-sm">
                                                
                                                <!-- Sección 1: Diagnóstico y Evolución -->
                                                <div>
                                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">1. Condición Clínica</h4>
                                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                            <span class="text-xs text-slate-400 block">Diagnóstico</span>
                                                            <span class="font-bold text-slate-800 dark:text-white capitalize"><?= htmlspecialchars($paciente->enfermedad ?: 'En evaluación') ?></span>
                                                        </div>
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                            <span class="text-xs text-slate-400 block">Tiempo de Evolución</span>
                                                            <span class="font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($paciente->tiempo_enfermedad ?: 'No indicado') ?></span>
                                                        </div>
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                            <span class="text-xs text-slate-400 block">EPS / Afiliación</span>
                                                            <span class="font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($paciente->afiliacion ?: 'No indicada') ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Sección 2: Contacto -->
                                                <div>
                                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">2. Canales de Contacto</h4>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700 flex items-center justify-between">
                                                            <div>
                                                                <span class="text-xs text-slate-400 block">Teléfono / Celular</span>
                                                                <span class="font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($paciente->telefono ?: 'No registrado') ?></span>
                                                            </div>
                                                            <?php if (!empty($paciente->telefono)): ?>
                                                                <a href="https://wa.me/57<?= preg_replace('/\D/', '', $paciente->telefono) ?>" target="_blank"
                                                                   class="px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-100 text-emerald-800 hover:bg-emerald-200">
                                                                    WhatsApp
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                            <span class="text-xs text-slate-400 block">Correo Electrónico</span>
                                                            <span class="font-bold text-slate-800 dark:text-white break-all"><?= htmlspecialchars($paciente->email ?: 'No registrado') ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Sección 3: Datos Sociodemográficos -->
                                                <div>
                                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">3. Perfil Social y Entorno</h4>
                                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                            <span class="text-xs text-slate-400 block">Residencia</span>
                                                            <span class="font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($paciente->lugar_de_residencia ?: 'N/D') ?></span>
                                                        </div>
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                            <span class="text-xs text-slate-400 block">Estrato</span>
                                                            <span class="font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($paciente->estrato_socioeconomico ?: 'N/D') ?></span>
                                                        </div>
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                            <span class="text-xs text-slate-400 block">Escolaridad</span>
                                                            <span class="font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($paciente->escolaridad ?: 'N/D') ?></span>
                                                        </div>
                                                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                            <span class="text-xs text-slate-400 block">Ocupación</span>
                                                            <span class="font-bold text-slate-800 dark:text-white truncate block"><?= htmlspecialchars($paciente->ocupacion ?: 'N/D') ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                                        <span class="text-xs text-slate-400 block">Red de Apoyo Principal (Cuidador / Familiar)</span>
                                                        <span class="font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($paciente->apoyo ?: 'No especificada') ?></span>
                                                    </div>
                                                </div>

                                                <!-- Sección 4: Evaluación de Encuestas -->
                                                <div>
                                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">4. Evaluaciones Especializadas</h4>
                                                    <div class="grid grid-cols-3 gap-3">
                                                        <div class="p-3 rounded-2xl border text-center <?= !empty($paciente->encuesta_salud) ? 'bg-emerald-50 border-emerald-200 text-emerald-800 dark:bg-emerald-950/40 dark:border-emerald-800 dark:text-emerald-300' : 'bg-slate-50 border-slate-200 text-slate-400 dark:bg-slate-700/50 dark:border-slate-700' ?>">
                                                            <span class="text-base font-bold block mb-1">Médica</span>
                                                            <span class="text-xs font-semibold"><?= !empty($paciente->encuesta_salud) ? '✓ Completada' : 'Pendiente' ?></span>
                                                        </div>
                                                        <div class="p-3 rounded-2xl border text-center <?= !empty($paciente->encuesta_psicologia) ? 'bg-blue-50 border-blue-200 text-blue-800 dark:bg-blue-950/40 dark:border-blue-800 dark:text-blue-300' : 'bg-slate-50 border-slate-200 text-slate-400 dark:bg-slate-700/50 dark:border-slate-700' ?>">
                                                            <span class="text-base font-bold block mb-1">Psicológica</span>
                                                            <span class="text-xs font-semibold"><?= !empty($paciente->encuesta_psicologia) ? '✓ Completada' : 'Pendiente' ?></span>
                                                        </div>
                                                        <div class="p-3 rounded-2xl border text-center <?= !empty($paciente->encuesta_juridico) ? 'bg-indigo-50 border-indigo-200 text-indigo-800 dark:bg-indigo-950/40 dark:border-indigo-800 dark:text-indigo-300' : 'bg-slate-50 border-slate-200 text-slate-400 dark:bg-slate-700/50 dark:border-slate-700' ?>">
                                                            <span class="text-base font-bold block mb-1">Jurídica</span>
                                                            <span class="text-xs font-semibold"><?= !empty($paciente->encuesta_juridico) ? '✓ Completada' : 'Pendiente' ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Pie del Modal -->
                                            <div class="p-4 bg-slate-50 dark:bg-slate-700/50 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                                                <button type="button" data-modal-toggle="expedienteModal<?= $paciente->pacienteId ?>"
                                                    class="py-2 px-5 text-sm font-semibold text-slate-700 bg-white rounded-xl border border-slate-300 hover:bg-slate-100 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 transition-colors">
                                                    Cerrar Expediente
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</main>

<!-- Lógica de Búsqueda, Filtrado y Exportación de Pacientes -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputBuscador = document.getElementById('buscadorPacientes');
    const filas = document.querySelectorAll('.paciente-fila');
    const conteo = document.getElementById('conteoPacientes');
    const btnsFiltro = document.querySelectorAll('.filtro-btn');
    const btnExportar = document.getElementById('btnExportarPacientes');

    let filtroActual = 'todos';

    function filtrarTabla() {
        const query = (inputBuscador.value || '').toLowerCase().trim();
        let visibles = 0;

        filas.forEach(fila => {
            const dataSearch = fila.getAttribute('data-search') || '';
            const enfermedad = fila.getAttribute('data-enfermedad') || '';
            const encuestas = fila.getAttribute('data-encuestas') || '0';

            const coincideTexto = !query || dataSearch.includes(query);
            let coincideFiltro = true;

            if (filtroActual === 'colostomia') {
                coincideFiltro = (enfermedad === 'colostomia');
            } else if (filtroActual === 'diabetes') {
                coincideFiltro = (enfermedad === 'diabetes');
            } else if (filtroActual === 'encuestas') {
                coincideFiltro = (encuestas === '1');
            }

            if (coincideTexto && coincideFiltro) {
                fila.style.display = '';
                visibles++;
            } else {
                fila.style.display = 'none';
            }
        });

        if (conteo) {
            conteo.textContent = visibles;
        }
    }

    if (inputBuscador) {
        inputBuscador.addEventListener('input', filtrarTabla);
    }

    btnsFiltro.forEach(btn => {
        btn.addEventListener('click', function () {
            btnsFiltro.forEach(b => {
                b.classList.remove('bg-teal-600', 'text-white', 'shadow-xs');
                b.classList.add('text-slate-600', 'dark:text-slate-300', 'bg-slate-100', 'dark:bg-slate-700');
            });
            this.classList.remove('text-slate-600', 'dark:text-slate-300', 'bg-slate-100', 'dark:bg-slate-700');
            this.classList.add('bg-teal-600', 'text-white', 'shadow-xs');

            filtroActual = this.getAttribute('data-filtro') || 'todos';
            filtrarTabla();
        });
    });

    // Exportación a Excel / CSV con UTF-8 BOM
    if (btnExportar) {
        btnExportar.addEventListener('click', function () {
            const datos = [
                ['ID', 'Nombre', 'Diagnóstico', 'Edad', 'Sexo', 'Teléfono', 'Email', 'Lugar Residencia', 'Estrato', 'Ocupación', 'Red de Apoyo', 'EPS', 'Tiempo Enfermedad']
            ];

            filas.forEach(fila => {
                if (fila.style.display !== 'none') {
                    const id = fila.querySelector('td:nth-child(1) span')?.textContent?.replace('ID #', '')?.trim() || '';
                    const nombre = fila.querySelector('td:nth-child(1) .font-bold')?.textContent?.trim() || '';
                    const diag = fila.querySelector('td:nth-child(2) span')?.textContent?.trim() || '';
                    const tel = fila.querySelector('td:nth-child(3) a[href^="tel:"]')?.textContent?.trim() || '';
                    const email = fila.querySelector('td:nth-child(3) a[href^="mailto:"]')?.textContent?.trim() || '';
                    const lugar = fila.querySelector('td:nth-child(4) div:nth-child(1)')?.textContent?.trim() || '';
                    const apoyo = fila.querySelector('td:nth-child(5) div:nth-child(1)')?.textContent?.trim() || '';
                    const ocupacion = fila.querySelector('td:nth-child(5) div:nth-child(2)')?.textContent?.trim() || '';

                    datos.push([id, nombre, diag, '', '', tel, email, lugar, '', ocupacion, apoyo, '', '']);
                }
            });

            let csvContent = '\uFEFF';
            datos.forEach(row => {
                const escaped = row.map(val => `"${(val || '').replace(/"/g, '""')}"`);
                csvContent += escaped.join(';') + '\r\n';
            });

            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `pacientes_${new Date().toISOString().slice(0, 10)}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        });
    }
});
</script>