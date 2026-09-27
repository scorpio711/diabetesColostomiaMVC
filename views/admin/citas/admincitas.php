<?php
// Precomputar métricas y estados
$hoy = date('Y-m-d');
$totalCitas = count($citas ?? []);
$citasHoy = 0;
$citasProximas = 0;
$citasPasadas = 0;
$pacientesMap = [];

foreach ($citas ?? [] as $c) {
    $fec = $c->fecha ?? '';
    if ($fec === $hoy) {
        $citasHoy++;
    } elseif ($fec > $hoy) {
        $citasProximas++;
    } else {
        $citasPasadas++;
    }

    if (!empty($c->id_paciente)) {
        $pacientesMap[$c->id_paciente] = true;
    }
}
$totalPacientesUnicos = count($pacientesMap);

// URL de retorno según el rol
$rolActual = strtolower($rol ?? $_SESSION['rol'] ?? '');
$urlVolver = '/public/admin/index';
if ($rolActual === 'abogado') {
    $urlVolver = '/public/admin/abogados';
} elseif ($rolActual === 'enfermero') {
    $urlVolver = '/public/admin/enfermeros';
} elseif ($rolActual === 'psicologo') {
    $urlVolver = '/public/admin/psicologos';
} elseif ($rolActual === 'profesional') {
    $urlVolver = '/public/admin/indexProfesionales';
}
?>

<main class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- ==========================================
             1. ALERTAS DE ESTADO
             ========================================== -->
        <?php if (intval($resultado ?? 0) === 1): ?>
            <div id="alerta-exito" class="flex items-center p-4 mb-4 text-emerald-800 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-600 bg-emerald-100 rounded-xl dark:bg-emerald-900 dark:text-emerald-200 mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium">
                    <span class="font-bold">¡Cita cancelada con éxito!</span> La cita médica y sus servicios asociados fueron eliminados del sistema.
                </div>
                <button type="button" onclick="document.getElementById('alerta-exito').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 dark:bg-emerald-950/40 dark:text-emerald-400 dark:hover:bg-emerald-900" aria-label="Cerrar">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        <?php endif; ?>

        <!-- ==========================================
             2. ENCABEZADO PRINCIPAL DE LA AGENDA
             ========================================== -->
        <header class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 dark:border-slate-700/80 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-teal-500/10 dark:bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        AGENDA CLÍNICA &middot; <?= strtoupper(htmlspecialchars($rolActual ?: 'PROFESIONAL')) ?>
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Gestión de <span class="text-teal-600 dark:text-teal-400">Citas Médicas</span>
                    </h1>
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-2xl leading-relaxed">
                        Administra y monitorea las consultas agendadas por los pacientes, consulta sus datos clínicos y actualiza el estado de tu atención.
                    </p>
                </div>

                <!-- Botones de Acción -->
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" id="btnExportarExcel" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm text-emerald-700 bg-emerald-100 hover:bg-emerald-200 dark:bg-emerald-950/60 dark:text-emerald-300 dark:hover:bg-emerald-900/60 border border-emerald-200 dark:border-emerald-800 transition-all shadow-xs cursor-pointer active:scale-95">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar Excel
                    </button>

                    <a href="/public/perfil/profesionales#horario" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm text-teal-700 bg-teal-100 hover:bg-teal-200 dark:bg-teal-950/60 dark:text-teal-300 dark:hover:bg-teal-900/60 border border-teal-200 dark:border-teal-800 transition-colors">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Mi Horario
                    </a>

                    <a href="<?= htmlspecialchars($urlVolver) ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-medium text-sm text-slate-700 dark:text-slate-200 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 border border-slate-200 dark:border-slate-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver al Panel
                    </a>
                </div>
            </div>
        </header>

        <!-- ==========================================
             3. TARJETAS DE INDICADORES (KPIs)
             ========================================== -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" aria-label="Indicadores">
            <!-- 1. Total Citas -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total en Agenda</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalCitas ?></p>
                </div>
            </div>

            <!-- 2. Citas Hoy -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4 relative overflow-hidden">
                <?php if ($citasHoy > 0): ?>
                    <div class="absolute top-2 right-2 flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </div>
                <?php endif; ?>
                <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-400 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 uppercase tracking-wider">Citas de Hoy</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $citasHoy ?></p>
                </div>
            </div>

            <!-- 3. Citas Próximas -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-100 dark:bg-teal-950/60 text-teal-700 dark:text-teal-400 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-teal-700 dark:text-teal-400 uppercase tracking-wider">Citas Próximas</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $citasProximas ?></p>
                </div>
            </div>

            <!-- 4. Pacientes Únicos -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-950/60 text-purple-700 dark:text-purple-400 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-purple-700 dark:text-purple-400 uppercase tracking-wider">Pacientes Únicos</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalPacientesUnicos ?></p>
                </div>
            </div>
        </section>

        <!-- ==========================================
             4. BARRA DE HERRAMIENTAS: BÚSQUEDA Y FILTROS
             ========================================== -->
        <section class="bg-white dark:bg-slate-800 rounded-2xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-sm space-y-4">
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
                
                <!-- Buscador en tiempo real -->
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="inputBuscar" 
                           class="w-full pl-10 pr-10 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors" 
                           placeholder="Buscar por paciente, servicio, fecha o email...">
                    <button type="button" id="btnLimpiarBusqueda" class="hidden absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Pestañas de Filtro Rápido -->
                <div class="flex flex-wrap items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-900/80 rounded-xl">
                    <button type="button" data-filtro="todos" class="tab-filtro px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all bg-white dark:bg-slate-800 text-teal-700 dark:text-teal-300 shadow-xs">
                        Todas <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300"><?= $totalCitas ?></span>
                    </button>
                    <button type="button" data-filtro="hoy" class="tab-filtro px-3.5 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Hoy <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300"><?= $citasHoy ?></span>
                    </button>
                    <button type="button" data-filtro="proximas" class="tab-filtro px-3.5 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Próximas <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-teal-100 dark:bg-teal-950/60 text-teal-800 dark:text-teal-300"><?= $citasProximas ?></span>
                    </button>
                    <button type="button" data-filtro="pasadas" class="tab-filtro px-3.5 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Historial <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300"><?= $citasPasadas ?></span>
                    </button>
                </div>

                <!-- Filtro por Condición Clínica -->
                <div class="flex items-center gap-2">
                    <label for="selectCondicion" class="text-xs font-medium text-slate-500 dark:text-slate-400 shrink-0">Condición:</label>
                    <select id="selectCondicion" class="py-2 px-3 text-xs font-semibold rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 focus:ring-teal-500 focus:border-teal-500">
                        <option value="todas">Todas las condiciones</option>
                        <option value="diabetes">Diabetes</option>
                        <option value="colostomia">Colostomía</option>
                        <option value="general">General / Sin definir</option>
                    </select>
                </div>
            </div>

            <!-- Contador de resultados visibles -->
            <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 pt-2 border-t border-slate-100 dark:border-slate-700/60">
                <span id="contadorResultados">Mostrando <strong><?= $totalCitas ?></strong> de <?= $totalCitas ?> citas en agenda</span>
                <span id="filtroActivoTexto" class="hidden sm:inline-block italic">Filtro: Todos los registros</span>
            </div>
        </section>

        <!-- ==========================================
             5. TABLA Y LISTADO DE CITAS
             ========================================== -->
        <section class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
            
            <?php if (empty($citas)): ?>
                <!-- Estado Vacío General (Sin citas registradas) -->
                <div class="py-16 px-6 text-center space-y-4">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="max-w-md mx-auto">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Sin citas programadas</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                            No se encontraron consultas registradas para tu perfil profesional en este momento. Las nuevas solicitudes aparecerán aquí automáticamente.
                        </p>
                    </div>
                </div>
            <?php else: ?>

                <!-- Vista de Tabla para Escritorio / Tablets (md en adelante) -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead class="text-xs uppercase tracking-wider bg-slate-50 dark:bg-slate-900/60 text-slate-700 dark:text-slate-300 border-b border-slate-200/80 dark:border-slate-700/80">
                            <tr>
                                <th scope="col" class="px-6 py-4">Paciente</th>
                                <th scope="col" class="px-6 py-4">Servicio Clínico</th>
                                <th scope="col" class="px-6 py-4">Condición</th>
                                <th scope="col" class="px-6 py-4">Fecha y Horario</th>
                                <th scope="col" class="px-6 py-4 text-center">Estado</th>
                                <th scope="col" class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaCitasBody" class="divide-y divide-slate-100 dark:divide-slate-700/60">
                            <?php foreach ($citas as $cita): 
                                $fechaCita = $cita->fecha ?? '';
                                $horaCita = $cita->hora ?? '';
                                $esHoy = ($fechaCita === $hoy);
                                $esProxima = ($fechaCita > $hoy);
                                $esPasada = ($fechaCita < $hoy);

                                $tipoFiltro = 'pasadas';
                                if ($esHoy) $tipoFiltro = 'hoy';
                                elseif ($esProxima) $tipoFiltro = 'proximas';

                                $condicionRaw = strtolower($cita->condicion ?? 'general');
                                $condicionNormalizada = 'general';
                                if (strpos($condicionRaw, 'diabetes') !== false) {
                                    $condicionNormalizada = 'diabetes';
                                } elseif (strpos($condicionRaw, 'colostomia') !== false || strpos($condicionRaw, 'colostomía') !== false) {
                                    $condicionNormalizada = 'colostomia';
                                }

                                // Iniciales del paciente para avatar
                                $partesNombre = explode(' ', trim($cita->nombre ?? 'Paciente'));
                                $iniciales = mb_strtoupper(mb_substr($partesNombre[0] ?? 'P', 0, 1));
                                if (!empty($partesNombre[1])) {
                                    $iniciales .= mb_strtoupper(mb_substr($partesNombre[1], 0, 1));
                                }

                                // Formatear hora si es posible (ej: 09:00:00 -> 09:00 AM)
                                $horaFormateada = $horaCita;
                                if (!empty($horaCita)) {
                                    $horaFormateada = date("g:i A", strtotime($horaCita));
                                }
                            ?>
                                <tr class="fila-cita hover:bg-slate-50/80 dark:hover:bg-slate-750/50 transition-colors"
                                    data-filtro="<?= $tipoFiltro ?>"
                                    data-condicion="<?= $condicionNormalizada ?>"
                                    data-texto="<?= strtolower(htmlspecialchars(($cita->nombre ?? '') . ' ' . ($cita->email_paciente ?? '') . ' ' . ($cita->nombre_servicio ?? '') . ' ' . ($cita->condicion ?? '') . ' ' . ($cita->fechaHora ?? '') . ' ' . ($cita->telefono ?? ''))) ?>"
                                    data-id="<?= $cita->citaId ?>"
                                    data-paciente="<?= htmlspecialchars($cita->nombre ?? 'Paciente') ?>"
                                    data-email="<?= htmlspecialchars($cita->email_paciente ?? 'No registrado') ?>"
                                    data-telefono="<?= htmlspecialchars($cita->telefono ?? 'No registrado') ?>"
                                    data-servicio="<?= htmlspecialchars($cita->nombre_servicio ?? 'Servicio médico') ?>"
                                    data-condicion-texto="<?= htmlspecialchars($cita->condicion ?? 'General') ?>"
                                    data-fechahora="<?= htmlspecialchars($cita->fechaHora ?? ($fechaCita . ' ' . $horaCita)) ?>">
                                    
                                    <!-- 1. Paciente -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-teal-500 to-emerald-400 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                                                <?= $iniciales ?>
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900 dark:text-white">
                                                    <?= htmlspecialchars($cita->nombre ?? 'Paciente') ?>
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1 mt-0.5">
                                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <?= htmlspecialchars($cita->email_paciente ?? 'No registrado') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- 2. Servicio Clínico -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-semibold bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600">
                                            <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                            <?= htmlspecialchars($cita->nombre_servicio ?? 'Consulta general') ?>
                                        </span>
                                    </td>

                                    <!-- 3. Condición -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($condicionNormalizada === 'diabetes'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Diabetes
                                            </span>
                                        <?php elseif ($condicionNormalizada === 'colostomia'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Colostomía
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-750 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                                <?= htmlspecialchars($cita->condicion ?? 'General') ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 4. Fecha y Horario -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <?= htmlspecialchars($cita->fechaHora ?? ($fechaCita . ' ' . $horaFormateada)) ?>
                                            </span>
                                        </div>
                                    </td>

                                    <!-- 5. Estado -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?php if ($esHoy): ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-900 dark:bg-amber-950/80 dark:text-amber-300 border border-amber-200 dark:border-amber-700">
                                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                                                HOY
                                            </span>
                                        <?php elseif ($esProxima): ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                                PRÓXIMA
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 dark:bg-slate-750 dark:text-slate-400 border border-slate-200 dark:border-slate-700">
                                                FINALIZADA
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 6. Acciones -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="inline-flex items-center justify-end gap-2">
                                            <!-- Ver detalle/contacto modal -->
                                            <button type="button" 
                                                    class="btn-ver-detalle p-2 text-slate-600 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-400 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-colors"
                                                    title="Ver datos de contacto del paciente">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>

                                            <!-- Formulario seguro de cancelación con SweetAlert2 -->
                                            <form method="POST" class="form-cancelar inline-block m-0">
                                                <input type="hidden" name="citaId" value="<?= $cita->citaId ?>">
                                                <button type="button" 
                                                        class="btn-cancelar-cita inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-white bg-rose-50 hover:bg-rose-600 dark:bg-rose-950/40 dark:hover:bg-rose-600 border border-rose-200 dark:border-rose-900 rounded-xl transition-all"
                                                        title="Cancelar esta cita médica">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Cancelar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Vista de Tarjetas para Móviles (Visible solo en pantallas pequeñas) -->
                <div id="citasMobileList" class="md:hidden divide-y divide-slate-100 dark:divide-slate-700/60 p-4 space-y-4">
                    <?php foreach ($citas as $cita): 
                        $fechaCita = $cita->fecha ?? '';
                        $horaCita = $cita->hora ?? '';
                        $esHoy = ($fechaCita === $hoy);
                        $esProxima = ($fechaCita > $hoy);
                        $tipoFiltro = $esHoy ? 'hoy' : ($esProxima ? 'proximas' : 'pasadas');

                        $condicionRaw = strtolower($cita->condicion ?? 'general');
                        $condicionNormalizada = 'general';
                        if (strpos($condicionRaw, 'diabetes') !== false) {
                            $condicionNormalizada = 'diabetes';
                        } elseif (strpos($condicionRaw, 'colostomia') !== false || strpos($condicionRaw, 'colostomía') !== false) {
                            $condicionNormalizada = 'colostomia';
                        }
                    ?>
                        <div class="tarjeta-cita bg-slate-50 dark:bg-slate-750 p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 space-y-3"
                             data-filtro="<?= $tipoFiltro ?>"
                             data-condicion="<?= $condicionNormalizada ?>"
                             data-texto="<?= strtolower(htmlspecialchars(($cita->nombre ?? '') . ' ' . ($cita->email_paciente ?? '') . ' ' . ($cita->nombre_servicio ?? '') . ' ' . ($cita->condicion ?? '') . ' ' . ($cita->fechaHora ?? '') . ' ' . ($cita->telefono ?? ''))) ?>"
                             data-id="<?= $cita->citaId ?>"
                             data-paciente="<?= htmlspecialchars($cita->nombre ?? 'Paciente') ?>"
                             data-email="<?= htmlspecialchars($cita->email_paciente ?? 'No registrado') ?>"
                             data-telefono="<?= htmlspecialchars($cita->telefono ?? 'No registrado') ?>"
                             data-servicio="<?= htmlspecialchars($cita->nombre_servicio ?? 'Servicio médico') ?>"
                             data-condicion-texto="<?= htmlspecialchars($cita->condicion ?? 'General') ?>"
                             data-fechahora="<?= htmlspecialchars($cita->fechaHora ?? ($fechaCita . ' ' . $horaCita)) ?>">

                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="font-bold text-base text-slate-900 dark:text-white">
                                        <?= htmlspecialchars($cita->nombre ?? 'Paciente') ?>
                                    </h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                        <?= htmlspecialchars($cita->email_paciente ?? 'No registrado') ?>
                                    </p>
                                </div>
                                <?php if ($esHoy): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-900 dark:bg-amber-950/80 dark:text-amber-300">
                                        HOY
                                    </span>
                                <?php elseif ($esProxima): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300">
                                        PRÓXIMA
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-200 text-slate-600 dark:bg-slate-700 dark:text-slate-400">
                                        HISTORIAL
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-xs pt-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                <div>
                                    <span class="text-slate-400 uppercase tracking-wider text-[10px] block">Servicio</span>
                                    <span class="font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($cita->nombre_servicio ?? 'Consulta') ?></span>
                                </div>
                                <div>
                                    <span class="text-slate-400 uppercase tracking-wider text-[10px] block">Condición</span>
                                    <span class="font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($cita->condicion ?? 'General') ?></span>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-slate-400 uppercase tracking-wider text-[10px] block">Fecha y Hora</span>
                                    <span class="font-bold text-teal-700 dark:text-teal-400"><?= htmlspecialchars($cita->fechaHora ?? ($fechaCita . ' ' . $horaCita)) ?></span>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                <button type="button" class="btn-ver-detalle px-3 py-1.5 text-xs font-semibold text-teal-700 dark:text-teal-300 bg-teal-50 dark:bg-teal-950/40 rounded-xl">
                                    Ver Contacto
                                </button>
                                <form method="POST" class="form-cancelar inline-block m-0">
                                    <input type="hidden" name="citaId" value="<?= $cita->citaId ?>">
                                    <button type="button" class="btn-cancelar-cita px-3 py-1.5 text-xs font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/40 rounded-xl">
                                        Cancelar Cita
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Estado "Sin Resultados" para filtros y búsqueda -->
                <div id="sinResultados" class="hidden py-12 px-4 text-center">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-400 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">No se encontraron citas con los filtros seleccionados</p>
                    <p class="text-xs text-slate-400 mt-1">Intenta cambiar el término de búsqueda o seleccionar otra categoría.</p>
                    <button type="button" id="btnRestablecerFiltros" class="mt-4 px-4 py-2 rounded-xl text-xs font-semibold bg-teal-600 text-white hover:bg-teal-700 transition-colors">
                        Restablecer Filtros
                    </button>
                </div>

            <?php endif; ?>
        </section>

    </div>
</main>

<!-- ==========================================
     6. MODAL DETALLES DEL PACIENTE (CONTACTO)
     ========================================== -->
<div id="modalDetallePaciente" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs overflow-y-auto flex items-center justify-center p-4">
    <div class="relative bg-white dark:bg-slate-800 rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-700 transform transition-all animate-fade-in space-y-6">
        
        <!-- Header modal -->
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-3">
                <div id="modalAvatar" class="w-12 h-12 rounded-2xl bg-teal-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
                    P
                </div>
                <div>
                    <h3 id="modalNombre" class="text-lg font-extrabold text-slate-900 dark:text-white">Nombre del Paciente</h3>
                    <span id="modalCondicion" class="inline-block mt-0.5 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300">Condición</span>
                </div>
            </div>
            <button type="button" id="btnCerrarModal" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Detalles informativos -->
        <div class="space-y-4 bg-slate-50 dark:bg-slate-750 p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 text-sm">
            <div class="flex items-center justify-between py-1 border-b border-slate-200/60 dark:border-slate-700/60">
                <span class="text-slate-400 text-xs font-medium">Servicio Solicitado:</span>
                <span id="modalServicio" class="font-semibold text-slate-800 dark:text-slate-200">-</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-slate-200/60 dark:border-slate-700/60">
                <span class="text-slate-400 text-xs font-medium">Fecha y Hora de Cita:</span>
                <span id="modalFechaHora" class="font-bold text-teal-700 dark:text-teal-400">-</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-slate-200/60 dark:border-slate-700/60">
                <span class="text-slate-400 text-xs font-medium">Correo Electrónico:</span>
                <span id="modalEmail" class="font-semibold text-slate-800 dark:text-slate-200">-</span>
            </div>
            <div class="flex items-center justify-between py-1">
                <span class="text-slate-400 text-xs font-medium">Teléfono de Contacto:</span>
                <span id="modalTelefono" class="font-semibold text-slate-800 dark:text-slate-200">-</span>
            </div>
        </div>

        <!-- Acciones directas de comunicación -->
        <div class="flex flex-wrap items-center gap-3 justify-end pt-2">
            <a id="btnModalEmail" href="#" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-xs text-white bg-teal-600 hover:bg-teal-700 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Enviar Correo
            </a>

            <a id="btnModalWhatsapp" href="#" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-xs text-emerald-700 bg-emerald-100 hover:bg-emerald-200 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.861.174.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.086s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/>
                </svg>
                WhatsApp
            </a>

            <button type="button" id="btnCerrarModalBottom" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 transition-colors">
                Cerrar
            </button>
        </div>

    </div>
</div>

<!-- ==========================================
     7. LÓGICA JAVASCRIPT: BÚSQUEDA, FILTROS,
        EXPORTACIÓN A EXCEL Y CANCELACIÓN SEGURA
     ========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputBuscar = document.getElementById('inputBuscar');
    const btnLimpiar = document.getElementById('btnLimpiarBusqueda');
    const tabsFiltro = document.querySelectorAll('.tab-filtro');
    const selectCondicion = document.getElementById('selectCondicion');
    const contadorResultados = document.getElementById('contadorResultados');
    const sinResultados = document.getElementById('sinResultados');
    const btnRestablecer = document.getElementById('btnRestablecerFiltros');
    const btnExportarExcel = document.getElementById('btnExportarExcel');

    // Elementos del modal
    const modal = document.getElementById('modalDetallePaciente');
    const btnCerrarModal = document.getElementById('btnCerrarModal');
    const btnCerrarModalBottom = document.getElementById('btnCerrarModalBottom');
    const modalAvatar = document.getElementById('modalAvatar');
    const modalNombre = document.getElementById('modalNombre');
    const modalCondicion = document.getElementById('modalCondicion');
    const modalServicio = document.getElementById('modalServicio');
    const modalFechaHora = document.getElementById('modalFechaHora');
    const modalEmail = document.getElementById('modalEmail');
    const modalTelefono = document.getElementById('modalTelefono');
    const btnModalEmail = document.getElementById('btnModalEmail');
    const btnModalWhatsapp = document.getElementById('btnModalWhatsapp');

    let filtroTiempoActual = 'todos';
    let filtroCondicionActual = 'todas';
    let queryBusqueda = '';

    // Filtrar elementos
    function aplicarFiltros() {
        const filas = document.querySelectorAll('.fila-cita');
        const tarjetas = document.querySelectorAll('.tarjeta-cita');
        let contadorVisibles = 0;

        function evalItem(item) {
            const fTiempo = item.getAttribute('data-filtro');
            const fCond = item.getAttribute('data-condicion');
            const texto = item.getAttribute('data-texto') || '';

            // 1. Filtro tiempo
            const coincideTiempo = (filtroTiempoActual === 'todos') || (fTiempo === filtroTiempoActual);
            // 2. Filtro condición
            const coincideCond = (filtroCondicionActual === 'todas') || (fCond === filtroCondicionActual);
            // 3. Búsqueda texto
            const coincideTexto = !queryBusqueda || texto.includes(queryBusqueda);

            const esVisible = coincideTiempo && coincideCond && coincideTexto;
            if (esVisible) {
                item.classList.remove('hidden');
                contadorVisibles++;
            } else {
                item.classList.add('hidden');
            }
        }

        filas.forEach(evalItem);
        tarjetas.forEach(evalItem);

        // Contador y estado vacío
        const totalItems = filas.length;
        if (contadorResultados) {
            contadorResultados.innerHTML = `Mostrando <strong>${contadorVisibles}</strong> de ${totalItems} citas en agenda`;
        }

        if (sinResultados) {
            if (contadorVisibles === 0 && totalItems > 0) {
                sinResultados.classList.remove('hidden');
            } else {
                sinResultados.classList.add('hidden');
            }
        }
    }

    // Eventos de Búsqueda
    if (inputBuscar) {
        inputBuscar.addEventListener('input', function (e) {
            queryBusqueda = e.target.value.trim().toLowerCase();
            if (btnLimpiar) {
                if (queryBusqueda.length > 0) {
                    btnLimpiar.classList.remove('hidden');
                } else {
                    btnLimpiar.classList.add('hidden');
                }
            }
            aplicarFiltros();
        });
    }

    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', function () {
            inputBuscar.value = '';
            queryBusqueda = '';
            btnLimpiar.classList.add('hidden');
            inputBuscar.focus();
            aplicarFiltros();
        });
    }

    // Eventos de Pestañas de Filtro Rápido
    tabsFiltro.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabsFiltro.forEach(function (t) {
                t.classList.remove('bg-white', 'dark:bg-slate-800', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
                t.classList.add('text-slate-600', 'dark:text-slate-400');
            });

            tab.classList.add('bg-white', 'dark:bg-slate-800', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
            tab.classList.remove('text-slate-600', 'dark:text-slate-400');

            filtroTiempoActual = tab.getAttribute('data-filtro');
            aplicarFiltros();
        });
    });

    // Evento Dropdown Condición
    if (selectCondicion) {
        selectCondicion.addEventListener('change', function (e) {
            filtroCondicionActual = e.target.value;
            aplicarFiltros();
        });
    }

    // Botón Restablecer Filtros
    if (btnRestablecer) {
        btnRestablecer.addEventListener('click', function () {
            if (inputBuscar) inputBuscar.value = '';
            queryBusqueda = '';
            if (btnLimpiar) btnLimpiar.classList.add('hidden');
            if (selectCondicion) selectCondicion.value = 'todas';
            filtroCondicionActual = 'todas';

            // Reset tabs
            tabsFiltro.forEach(function (t, idx) {
                if (idx === 0) {
                    t.classList.add('bg-white', 'dark:bg-slate-800', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
                    t.classList.remove('text-slate-600', 'dark:text-slate-400');
                } else {
                    t.classList.remove('bg-white', 'dark:bg-slate-800', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
                    t.classList.add('text-slate-600', 'dark:text-slate-400');
                }
            });
            filtroTiempoActual = 'todos';
            aplicarFiltros();
        });
    }

    // ==========================================
    // CANCELACIÓN CON SWEETALERT2
    // ==========================================
    document.querySelectorAll('.btn-cancelar-cita').forEach(function (boton) {
        boton.addEventListener('click', function (e) {
            e.preventDefault();
            const form = boton.closest('form');
            const contenedor = boton.closest('.fila-cita') || boton.closest('.tarjeta-cita');
            const paciente = contenedor ? contenedor.getAttribute('data-paciente') : 'el paciente';
            const fechaHora = contenedor ? contenedor.getAttribute('data-fechahora') : '';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '¿Cancelar esta cita médica?',
                    html: `Se cancelará la consulta agendada para <strong>${paciente}</strong> (${fechaHora}).<br><br><span class="text-xs text-slate-500">Esta acción liberará el espacio y no se puede revertir.</span>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Sí, cancelar cita',
                    cancelButtonText: 'Conservar cita',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-3xl dark:bg-slate-800 dark:text-white',
                        confirmButton: 'rounded-xl px-4 py-2 font-semibold',
                        cancelButton: 'rounded-xl px-4 py-2 font-semibold'
                    }
                }).then(function (result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            } else {
                if (confirm(`¿Estás seguro de cancelar la cita de ${paciente}?`)) {
                    form.submit();
                }
            }
        });
    });

    // ==========================================
    // MODAL DE DETALLE Y CONTACTO
    // ==========================================
    function abrirModalDetalle(elem) {
        const item = elem.closest('.fila-cita') || elem.closest('.tarjeta-cita');
        if (!item || !modal) return;

        const paciente = item.getAttribute('data-paciente') || 'Paciente';
        const email = item.getAttribute('data-email') || 'No registrado';
        const telefono = item.getAttribute('data-telefono') || 'No registrado';
        const servicio = item.getAttribute('data-servicio') || 'Consulta general';
        const condicion = item.getAttribute('data-condicion-texto') || 'General';
        const fechaHora = item.getAttribute('data-fechahora') || '';

        modalNombre.textContent = paciente;
        modalCondicion.textContent = condicion;
        modalServicio.textContent = servicio;
        modalFechaHora.textContent = fechaHora;
        modalEmail.textContent = email;
        modalTelefono.textContent = telefono;

        // Avatar iniciales
        const partes = paciente.trim().split(' ');
        let iniciales = (partes[0] || 'P').charAt(0).toUpperCase();
        if (partes[1]) iniciales += partes[1].charAt(0).toUpperCase();
        modalAvatar.textContent = iniciales;

        // Acciones
        if (email && email !== 'No registrado') {
            btnModalEmail.href = `mailto:${email}?subject=Consulta Médica - Carefulness&body=Hola ${encodeURIComponent(paciente)}, respecto a tu cita agendada el ${encodeURIComponent(fechaHora)}:`;
            btnModalEmail.classList.remove('hidden');
        } else {
            btnModalEmail.classList.add('hidden');
        }

        const telefonoLimpio = telefono.replace(/[^0-9]/g, '');
        if (telefonoLimpio.length >= 7) {
            btnModalWhatsapp.href = `https://wa.me/${telefonoLimpio}?text=Hola%20${encodeURIComponent(paciente)},%20te%20escribo%20de%20Carefulness%20sobre%20tu%20cita%20médica:`;
            btnModalWhatsapp.classList.remove('hidden');
        } else {
            btnModalWhatsapp.classList.add('hidden');
        }

        modal.classList.remove('hidden');
    }

    function cerrarModal() {
        if (modal) modal.classList.add('hidden');
    }

    document.querySelectorAll('.btn-ver-detalle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            abrirModalDetalle(btn);
        });
    });

    if (btnCerrarModal) btnCerrarModal.addEventListener('click', cerrarModal);
    if (btnCerrarModalBottom) btnCerrarModalBottom.addEventListener('click', cerrarModal);

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) cerrarModal();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            cerrarModal();
        }
    });

    // ==========================================
    // EXPORTACIÓN MEJORADA A EXCEL
    // ==========================================
    if (btnExportarExcel) {
        btnExportarExcel.addEventListener('click', function () {
            if (typeof XLSX === 'undefined') {
                alert('La librería para exportar a Excel está cargando, por favor intenta en unos segundos.');
                return;
            }

            const filas = document.querySelectorAll('.fila-cita');
            if (filas.length === 0) {
                alert('No hay citas en la agenda para exportar.');
                return;
            }

            const datosExcel = [
                ['ID Cita', 'Paciente', 'Correo Electrónico', 'Teléfono', 'Condición', 'Servicio Clínico', 'Fecha y Hora', 'Estado']
            ];

            filas.forEach(function (fila) {
                // Si la fila está oculta por búsqueda o filtro, podemos decidir exportarla o respetar el filtro.
                // Aquí exportamos las filas actualmente visibles según el filtro:
                if (!fila.classList.contains('hidden')) {
                    const id = fila.getAttribute('data-id') || '';
                    const paciente = fila.getAttribute('data-paciente') || '';
                    const email = fila.getAttribute('data-email') || '';
                    const telefono = fila.getAttribute('data-telefono') || '';
                    const condicion = fila.getAttribute('data-condicion-texto') || '';
                    const servicio = fila.getAttribute('data-servicio') || '';
                    const fechaHora = fila.getAttribute('data-fechahora') || '';
                    const estado = fila.getAttribute('data-filtro') || '';

                    let estadoTxt = 'Historial';
                    if (estado === 'hoy') estadoTxt = 'Hoy';
                    else if (estado === 'proximas') estadoTxt = 'Próxima';

                    datosExcel.push([id, paciente, email, telefono, condicion, servicio, fechaHora, estadoTxt]);
                }
            });

            if (datosExcel.length <= 1) {
                alert('No hay registros visibles con los filtros actuales para exportar.');
                return;
            }

            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(datosExcel);

            // Ajustar ancho de columnas
            ws['!cols'] = [
                { wch: 10 }, // ID Cita
                { wch: 26 }, // Paciente
                { wch: 30 }, // Correo
                { wch: 18 }, // Teléfono
                { wch: 16 }, // Condición
                { wch: 25 }, // Servicio
                { wch: 22 }, // Fecha y Hora
                { wch: 14 }  // Estado
            ];

            XLSX.utils.book_append_sheet(wb, ws, 'Agenda Citas');
            const fechaHoyStr = new Date().toISOString().slice(0, 10);
            XLSX.writeFile(wb, `Agenda_Citas_Carefulness_${fechaHoyStr}.xlsx`);
        });
    }
});
</script>