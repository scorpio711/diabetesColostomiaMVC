<?php
// Precomputar métricas para la encuesta de salud
$totalEncuestas = count($encuestas ?? []);
$totalBajo = 0;
$totalMedio = 0;
$totalAlto = 0;
$totalHabilitadas = 0;

foreach ($encuestas ?? [] as $e) {
    $cat = strtolower(trim($e['categoria_total'] ?? ''));
    if ($cat === 'bajo') {
        $totalBajo++;
    } elseif ($cat === 'medio') {
        $totalMedio++;
    } elseif ($cat === 'alto') {
        $totalAlto++;
    }

    if (intval($e['encuesta_salud'] ?? 1) === 0) {
        $totalHabilitadas++;
    }
}

// URL de retorno
$rolActual = strtolower($rol ?? $_SESSION['rol'] ?? '');
$urlVolver = '/public/admin/index';
if ($rolActual === 'enfermero') {
    $urlVolver = '/public/admin/enfermeros';
} elseif ($rolActual === 'abogado') {
    $urlVolver = '/public/admin/abogados';
} elseif ($rolActual === 'psicologo') {
    $urlVolver = '/public/admin/psicologos';
} elseif ($rolActual === 'profesional') {
    $urlVolver = '/public/admin/indexProfesionales';
}

if (!function_exists('colorBadgeNivelSalud')) {
    function colorBadgeNivelSalud($val) {
        $v = strtolower(trim($val ?? ''));
        if ($v === 'alto') return 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800';
        if ($v === 'medio') return 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800';
        return 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border-rose-200 dark:border-rose-800';
    }
}
if (!function_exists('colorBadgeNivel')) {
    function colorBadgeNivel($val) {
        return colorBadgeNivelSalud($val);
    }
}
?>

<main class="min-h-screen bg-slate-50 dark:bg-slate-900 pt-20 pb-12 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- ==========================================
             1. ALERTAS DE ACCIÓN
             ========================================== -->
        <?php if (intval($resultado ?? 0) === 2): ?>
            <div id="alerta-exito" class="flex items-center p-4 mb-4 text-emerald-800 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-600 bg-emerald-100 rounded-xl dark:bg-emerald-900 dark:text-emerald-200 mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium">
                    <span class="font-bold">¡Encuesta habilitada exitosamente!</span> El paciente ahora puede volver a ingresar y responder la evaluación de salud y autocuidado.
                </div>
                <button type="button" onclick="document.getElementById('alerta-exito').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg p-1.5 hover:bg-emerald-100 dark:bg-emerald-950/40 dark:text-emerald-400" aria-label="Cerrar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        <?php endif; ?>

        <!-- ==========================================
             2. ENCABEZADO PRINCIPAL
             ========================================== -->
        <header class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 dark:border-slate-700/80 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-emerald-500/10 dark:bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        EVALUACIÓN CLÍNICA &middot; SALUD Y AUTOCUIDADO
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Encuestas de <span class="text-emerald-600 dark:text-emerald-400">Salud y Autocuidado</span>
                    </h1>
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-2xl leading-relaxed">
                        Analiza el nivel de capacidad de autocuidado de los pacientes con diabetes o colostomía. Identifica factores de riesgo en medicación, dieta, actividad física y signos de alarma.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" id="btnExportarExcel" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm text-emerald-700 bg-emerald-100 hover:bg-emerald-200 dark:bg-emerald-950/60 dark:text-emerald-300 dark:hover:bg-emerald-900/60 border border-emerald-200 dark:border-emerald-800 transition-all shadow-xs cursor-pointer active:scale-95">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar Excel
                    </button>

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
            <!-- Total Evaluaciones -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Evaluaciones</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalEncuestas ?></p>
                </div>
            </div>

            <!-- Autocuidado Alto (Óptimo) -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wider">Autocuidado Óptimo</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalAlto ?></p>
                </div>
            </div>

            <!-- Autocuidado Medio -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-400 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 uppercase tracking-wider">Autocuidado Medio</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalMedio ?></p>
                </div>
            </div>

            <!-- Autocuidado Bajo (Atención prioritaria) -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4 relative overflow-hidden">
                <?php if ($totalBajo > 0): ?>
                    <div class="absolute top-2 right-2 flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                    </div>
                <?php endif; ?>
                <div class="w-12 h-12 rounded-xl bg-rose-100 dark:bg-rose-950/60 text-rose-700 dark:text-rose-400 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-rose-700 dark:text-rose-400 uppercase tracking-wider">Riesgo / Bajo</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalBajo ?></p>
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
                           class="w-full pl-10 pr-10 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors" 
                           placeholder="Buscar por paciente, correo o condición...">
                    <button type="button" id="btnLimpiarBusqueda" class="hidden absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Pestañas de Filtro por Nivel -->
                <div class="flex flex-wrap items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-900/80 rounded-xl">
                    <button type="button" data-filtro="todos" class="tab-filtro px-3 py-1.5 rounded-lg text-xs font-semibold transition-all bg-white dark:bg-slate-800 text-emerald-700 dark:text-emerald-300 shadow-xs">
                        Todas <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300"><?= $totalEncuestas ?></span>
                    </button>
                    <button type="button" data-filtro="alto" class="tab-filtro px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Óptimo (Alto) <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300"><?= $totalAlto ?></span>
                    </button>
                    <button type="button" data-filtro="medio" class="tab-filtro px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Medio <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300"><?= $totalMedio ?></span>
                    </button>
                    <button type="button" data-filtro="bajo" class="tab-filtro px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Riesgo (Bajo) <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-rose-100 dark:bg-rose-950/60 text-rose-800 dark:text-rose-300"><?= $totalBajo ?></span>
                    </button>
                </div>

                <!-- Filtro por Condición -->
                <div class="flex items-center gap-2">
                    <label for="selectCondicion" class="text-xs font-medium text-slate-500 dark:text-slate-400 shrink-0">Condición:</label>
                    <select id="selectCondicion" class="py-2 px-3 text-xs font-semibold rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="todas">Todas las condiciones</option>
                        <option value="diabetes">Diabetes</option>
                        <option value="colostomia">Colostomía</option>
                        <option value="general">General / Otras</option>
                    </select>
                </div>
            </div>

            <!-- Contador de resultados -->
            <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 pt-2 border-t border-slate-100 dark:border-slate-700/60">
                <span id="contadorResultados">Mostrando <strong><?= $totalEncuestas ?></strong> evaluaciones</span>
                <span class="hidden sm:inline-block italic text-[11px]">Haz clic en "Ver Diagnóstico" para examinar cada área de autocuidado</span>
            </div>
        </section>

        <!-- ==========================================
             5. LISTADO Y TABLA DE EVALUACIONES
             ========================================== -->
        <section class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
            
            <?php if (empty($encuestas)): ?>
                <div class="py-16 px-6 text-center space-y-4">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="max-w-md mx-auto">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Sin encuestas de salud registradas</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                            Aún no hay pacientes que hayan completado el instrumento de salud y autocuidado.
                        </p>
                    </div>
                </div>
            <?php else: ?>

                <!-- Vista de Tabla para Escritorio -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead class="text-xs uppercase tracking-wider bg-slate-50 dark:bg-slate-900/60 text-slate-700 dark:text-slate-300 border-b border-slate-200/80 dark:border-slate-700/80">
                            <tr>
                                <th scope="col" class="px-5 py-4">Paciente</th>
                                <th scope="col" class="px-5 py-4">Condición</th>
                                <th scope="col" class="px-5 py-4">Fecha & Intento</th>
                                <th scope="col" class="px-5 py-4 text-center">Nivel Global</th>
                                <th scope="col" class="px-5 py-4">Semáforo de Dimensiones</th>
                                <th scope="col" class="px-5 py-4 text-center">Estado</th>
                                <th scope="col" class="px-5 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaEncuestasBody" class="divide-y divide-slate-100 dark:divide-slate-700/60">
                            <?php foreach ($encuestas as $encuesta):
                                $nivelGlobal = strtolower(trim($encuesta['categoria_total'] ?? ''));
                                $condicionRaw = strtolower(trim($encuesta['enfermedad'] ?? 'general'));
                                $condicionNormalizada = 'general';
                                if (strpos($condicionRaw, 'diabetes') !== false) {
                                    $condicionNormalizada = 'diabetes';
                                } elseif (strpos($condicionRaw, 'colostomia') !== false || strpos($condicionRaw, 'colostomía') !== false) {
                                    $condicionNormalizada = 'colostomia';
                                }

                                $fecha = !empty($encuesta['fecha_registro']) ? date("d/m/Y", strtotime($encuesta['fecha_registro'])) : 'Reciente';
                                $estaBloqueada = intval($encuesta['encuesta_salud'] ?? 1) === 1;

                                // Partes de nombre para iniciales
                                $partes = explode(' ', trim($encuesta['nombre'] ?? 'Paciente'));
                                $iniciales = mb_strtoupper(mb_substr($partes[0] ?? 'P', 0, 1));
                                if (!empty($partes[1])) {
                                    $iniciales .= mb_strtoupper(mb_substr($partes[1], 0, 1));
                                }
                            ?>
                                <tr class="fila-encuesta hover:bg-slate-50/80 dark:hover:bg-slate-750/50 transition-colors"
                                    data-filtro="<?= $nivelGlobal ?>"
                                    data-condicion="<?= $condicionNormalizada ?>"
                                    data-texto="<?= strtolower(htmlspecialchars(($encuesta['nombre'] ?? '') . ' ' . ($encuesta['email'] ?? '') . ' ' . ($encuesta['enfermedad'] ?? '') . ' ' . ($encuesta['categoria_total'] ?? ''))) ?>"
                                    data-id="<?= $encuesta['id'] ?>"
                                    data-usuario-id="<?= $encuesta['usuario_id'] ?>"
                                    data-nombre="<?= htmlspecialchars($encuesta['nombre'] ?? 'Paciente') ?>"
                                    data-email="<?= htmlspecialchars($encuesta['email'] ?? 'No registrado') ?>"
                                    data-condicion-texto="<?= htmlspecialchars($encuesta['enfermedad'] ?? 'General') ?>"
                                    data-fecha="<?= $fecha ?>"
                                    data-intento="<?= htmlspecialchars($encuesta['intento'] ?? '1') ?>"
                                    data-instrumental="<?= htmlspecialchars($encuesta['cuidado_instrumental'] ?? 'No evaluado') ?>"
                                    data-alimentacion="<?= htmlspecialchars($encuesta['alimentacion'] ?? 'No evaluado') ?>"
                                    data-actividad="<?= htmlspecialchars($encuesta['actividad_fisica'] ?? 'No evaluado') ?>"
                                    data-adaptaciones="<?= htmlspecialchars($encuesta['adaptaciones'] ?? 'No evaluado') ?>"
                                    data-alarma="<?= htmlspecialchars($encuesta['signos_alarma'] ?? 'No evaluado') ?>"
                                    data-total="<?= htmlspecialchars($encuesta['categoria_total'] ?? 'No evaluado') ?>">

                                    <!-- 1. Paciente -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-400 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                                                <?= $iniciales ?>
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900 dark:text-white">
                                                    <?= htmlspecialchars($encuesta['nombre'] ?? 'Paciente') ?>
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                                    <?= htmlspecialchars($encuesta['email'] ?? 'Sin correo') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- 2. Condición -->
                                    <td class="px-5 py-4 whitespace-nowrap">
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
                                                <?= htmlspecialchars($encuesta['enfermedad'] ?? 'General') ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 3. Fecha & Intento -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="text-xs font-semibold text-slate-900 dark:text-white"><?= $fecha ?></div>
                                        <span class="inline-block mt-0.5 text-[11px] text-slate-400">Intento #<?= htmlspecialchars($encuesta['intento'] ?? '1') ?></span>
                                    </td>

                                    <!-- 4. Nivel Global -->
                                    <td class="px-5 py-4 whitespace-nowrap text-center">
                                        <?php if ($nivelGlobal === 'alto'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                Óptimo (Alto)
                                            </span>
                                        <?php elseif ($nivelGlobal === 'medio'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                Medio
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border border-rose-200 dark:border-rose-800">
                                                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                                                Riesgo (Bajo)
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 5. Semáforo de Dimensiones -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="flex flex-wrap items-center gap-1 max-w-xs">
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorBadgeNivelSalud($encuesta['cuidado_instrumental']) ?>" title="Cuidado Instrumental">
                                                Inst: <?= htmlspecialchars($encuesta['cuidado_instrumental'] ?? '-') ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorBadgeNivelSalud($encuesta['alimentacion']) ?>" title="Alimentación">
                                                Alim: <?= htmlspecialchars($encuesta['alimentacion'] ?? '-') ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorBadgeNivelSalud($encuesta['actividad_fisica']) ?>" title="Actividad Física">
                                                Act: <?= htmlspecialchars($encuesta['actividad_fisica'] ?? '-') ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorBadgeNivelSalud($encuesta['adaptaciones']) ?>" title="Adaptaciones">
                                                Adapt: <?= htmlspecialchars($encuesta['adaptaciones'] ?? '-') ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorBadgeNivelSalud($encuesta['signos_alarma']) ?>" title="Signos de Alarma">
                                                Alarm: <?= htmlspecialchars($encuesta['signos_alarma'] ?? '-') ?>
                                            </span>
                                        </div>
                                    </td>

                                    <!-- 6. Estado -->
                                    <td class="px-5 py-4 whitespace-nowrap text-center">
                                        <?php if ($estaBloqueada): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-100 text-slate-600 dark:bg-slate-750 dark:text-slate-400">
                                                Completada
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">
                                                Habilitada
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 7. Acciones -->
                                    <td class="px-5 py-4 whitespace-nowrap text-right">
                                        <div class="inline-flex items-center justify-end gap-2">
                                            <!-- Ver diagnóstico detallado -->
                                            <button type="button" 
                                                    class="btn-ver-diagnostico inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-950/40 dark:hover:bg-emerald-900/60 border border-emerald-200 dark:border-emerald-800 transition-colors"
                                                    title="Ver reporte clínico detallado">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Diagnóstico
                                            </button>

                                            <!-- Formulario seguro para habilitar re-evaluación -->
                                            <?php if ($estaBloqueada): ?>
                                                <form method="POST" class="form-habilitar inline-block m-0">
                                                    <input type="hidden" name="investigacion[id]" value="<?= $encuesta['usuario_id'] ?>">
                                                    <button type="button" 
                                                            class="btn-habilitar-encuesta inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-semibold text-teal-700 dark:text-teal-300 bg-teal-50 hover:bg-teal-100 dark:bg-teal-950/40 dark:hover:bg-teal-900/60 border border-teal-200 dark:border-teal-800 transition-colors"
                                                            title="Habilitar para que el paciente pueda responder nuevamente">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                        </svg>
                                                        Re-habilitar
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Vista de Tarjetas para Móviles / Tablets pequeñas -->
                <div id="encuestasMobileList" class="lg:hidden divide-y divide-slate-100 dark:divide-slate-700/60 p-4 space-y-4">
                    <?php foreach ($encuestas as $encuesta): 
                        $nivelGlobal = strtolower(trim($encuesta['categoria_total'] ?? ''));
                        $condicionRaw = strtolower(trim($encuesta['enfermedad'] ?? 'general'));
                        $condicionNormalizada = (strpos($condicionRaw, 'diabetes') !== false) ? 'diabetes' : ((strpos($condicionRaw, 'colostomia') !== false) ? 'colostomia' : 'general');
                        $fecha = !empty($encuesta['fecha_registro']) ? date("d/m/Y", strtotime($encuesta['fecha_registro'])) : 'Reciente';
                        $estaBloqueada = intval($encuesta['encuesta_salud'] ?? 1) === 1;
                    ?>
                        <div class="tarjeta-encuesta bg-slate-50 dark:bg-slate-750 p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 space-y-3"
                             data-filtro="<?= $nivelGlobal ?>"
                             data-condicion="<?= $condicionNormalizada ?>"
                             data-texto="<?= strtolower(htmlspecialchars(($encuesta['nombre'] ?? '') . ' ' . ($encuesta['email'] ?? '') . ' ' . ($encuesta['enfermedad'] ?? '') . ' ' . ($encuesta['categoria_total'] ?? ''))) ?>"
                             data-id="<?= $encuesta['id'] ?>"
                             data-usuario-id="<?= $encuesta['usuario_id'] ?>"
                             data-nombre="<?= htmlspecialchars($encuesta['nombre'] ?? 'Paciente') ?>"
                             data-email="<?= htmlspecialchars($encuesta['email'] ?? 'No registrado') ?>"
                             data-condicion-texto="<?= htmlspecialchars($encuesta['enfermedad'] ?? 'General') ?>"
                             data-fecha="<?= $fecha ?>"
                             data-intento="<?= htmlspecialchars($encuesta['intento'] ?? '1') ?>"
                             data-instrumental="<?= htmlspecialchars($encuesta['cuidado_instrumental'] ?? 'No evaluado') ?>"
                             data-alimentacion="<?= htmlspecialchars($encuesta['alimentacion'] ?? 'No evaluado') ?>"
                             data-actividad="<?= htmlspecialchars($encuesta['actividad_fisica'] ?? 'No evaluado') ?>"
                             data-adaptaciones="<?= htmlspecialchars($encuesta['adaptaciones'] ?? 'No evaluado') ?>"
                             data-alarma="<?= htmlspecialchars($encuesta['signos_alarma'] ?? 'No evaluado') ?>"
                             data-total="<?= htmlspecialchars($encuesta['categoria_total'] ?? 'No evaluado') ?>">

                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="font-bold text-base text-slate-900 dark:text-white">
                                        <?= htmlspecialchars($encuesta['nombre'] ?? 'Paciente') ?>
                                    </h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                        <?= htmlspecialchars($encuesta['email'] ?? 'Sin correo') ?>
                                    </p>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold <?= colorBadgeNivel($encuesta['categoria_total']) ?>">
                                    <?= htmlspecialchars($encuesta['categoria_total'] ?? 'General') ?>
                                </span>
                            </div>

                            <!-- Chips resumen -->
                            <div class="grid grid-cols-2 gap-2 text-xs pt-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                <div>
                                    <span class="text-slate-400 text-[10px] block uppercase">Condición</span>
                                    <span class="font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($encuesta['enfermedad'] ?? 'General') ?></span>
                                </div>
                                <div>
                                    <span class="text-slate-400 text-[10px] block uppercase">Fecha / Intento</span>
                                    <span class="font-semibold text-slate-800 dark:text-slate-200"><?= $fecha ?> (#<?= htmlspecialchars($encuesta['intento'] ?? '1') ?>)</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                <button type="button" class="btn-ver-diagnostico px-3 py-1.5 text-xs font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/40 rounded-xl">
                                    Ver Diagnóstico
                                </button>
                                <?php if ($estaBloqueada): ?>
                                    <form method="POST" class="form-habilitar inline-block m-0">
                                        <input type="hidden" name="investigacion[id]" value="<?= $encuesta['usuario_id'] ?>">
                                        <button type="button" class="btn-habilitar-encuesta px-3 py-1.5 text-xs font-semibold text-teal-700 dark:text-teal-300 bg-teal-50 dark:bg-teal-950/40 rounded-xl">
                                            Re-habilitar
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Estado "Sin Resultados" -->
                <div id="sinResultados" class="hidden py-12 px-4 text-center">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-400 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">No se encontraron evaluaciones con los filtros aplicados</p>
                    <p class="text-xs text-slate-400 mt-1">Modifica el término de búsqueda o selecciona otra categoría.</p>
                    <button type="button" id="btnRestablecerFiltros" class="mt-4 px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-600 text-white hover:bg-emerald-700 transition-colors">
                        Restablecer Filtros
                    </button>
                </div>

            <?php endif; ?>
        </section>

    </div>
</main>

<!-- ==========================================
     6. MODAL DE DIAGNÓSTICO CLÍNICO DETALLADO
     ========================================== -->
<div id="modalDiagnosticoSalud" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs overflow-y-auto flex items-center justify-center p-4">
    <div class="relative bg-white dark:bg-slate-800 rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-700 transform transition-all animate-fade-in space-y-6">
        
        <!-- Header del Modal -->
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-3">
                <div id="modalAvatar" class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
                    P
                </div>
                <div>
                    <h3 id="modalNombre" class="text-lg font-extrabold text-slate-900 dark:text-white">Nombre del Paciente</h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span id="modalCondicion" class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300">Condición</span>
                        <span id="modalFecha" class="text-xs text-slate-400">Fecha</span>
                    </div>
                </div>
            </div>
            <button type="button" id="btnCerrarModal" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Banner de Nivel Global -->
        <div id="modalBannerNivel" class="p-4 rounded-2xl flex items-center justify-between border">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider block text-slate-500 dark:text-slate-400">Resultado Global de Autocuidado</span>
                <div id="modalNivelTexto" class="text-xl font-extrabold mt-0.5">Nivel Alto</div>
            </div>
            <span id="modalPillNivel" class="px-3 py-1 rounded-full text-xs font-extrabold">Óptimo</span>
        </div>

        <!-- Desglose por Dimensiones Clínicas -->
        <div class="space-y-3">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Desglose por Áreas Evaluadas</h4>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                
                <!-- 1. Cuidado Instrumental -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-800 dark:text-slate-200 text-xs">Cuidado Instrumental</span>
                        <span id="modalDimInstrumental" class="text-xs font-bold px-2 py-0.5 rounded-md">Alto</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Manejo de medicamentos, dispositivos y curaciones.</p>
                </div>

                <!-- 2. Alimentación -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-800 dark:text-slate-200 text-xs">Alimentación y Dieta</span>
                        <span id="modalDimAlimentacion" class="text-xs font-bold px-2 py-0.5 rounded-md">Medio</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Pautas nutricionales, control de glucosa y fibras.</p>
                </div>

                <!-- 3. Actividad Física -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-800 dark:text-slate-200 text-xs">Actividad Física</span>
                        <span id="modalDimActividad" class="text-xs font-bold px-2 py-0.5 rounded-md">Alto</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Movilidad adaptada, ejercicios de bajo impacto.</p>
                </div>

                <!-- 4. Adaptaciones -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-800 dark:text-slate-200 text-xs">Adaptaciones Diarias</span>
                        <span id="modalDimAdaptaciones" class="text-xs font-bold px-2 py-0.5 rounded-md">Bajo</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Ajustes en ropa, descanso, trabajo e higiene personal.</p>
                </div>

                <!-- 5. Signos de Alarma -->
                <div class="sm:col-span-2 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-800 dark:text-slate-200 text-xs">Reconocimiento de Signos de Alarma</span>
                        <span id="modalDimAlarma" class="text-xs font-bold px-2 py-0.5 rounded-md">Alto</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Detección oportuna de hipo/hiperglucemia o complicaciones del estoma.</p>
                </div>

            </div>
        </div>

        <!-- Acciones del Modal -->
        <div class="flex flex-wrap items-center justify-between gap-3 pt-2 border-t border-slate-200/80 dark:border-slate-700/80">
            <a id="btnModalEmail" href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Contactar Paciente
            </a>

            <button type="button" id="btnCerrarModalBottom" class="px-5 py-2 rounded-xl text-xs font-semibold text-white bg-slate-800 hover:bg-slate-900 dark:bg-slate-700 dark:hover:bg-slate-600 transition-colors">
                Entendido
            </button>
        </div>

    </div>
</div>

<!-- ==========================================
     7. SCRIPT JAVASCRIPT: BÚSQUEDA, FILTROS,
        EXCEL Y RE-HABILITACIÓN SEGURA
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

    // Modal
    const modal = document.getElementById('modalDiagnosticoSalud');
    const btnCerrarModal = document.getElementById('btnCerrarModal');
    const btnCerrarModalBottom = document.getElementById('btnCerrarModalBottom');
    const modalAvatar = document.getElementById('modalAvatar');
    const modalNombre = document.getElementById('modalNombre');
    const modalCondicion = document.getElementById('modalCondicion');
    const modalFecha = document.getElementById('modalFecha');
    const modalBannerNivel = document.getElementById('modalBannerNivel');
    const modalNivelTexto = document.getElementById('modalNivelTexto');
    const modalPillNivel = document.getElementById('modalPillNivel');
    const modalDimInstrumental = document.getElementById('modalDimInstrumental');
    const modalDimAlimentacion = document.getElementById('modalDimAlimentacion');
    const modalDimActividad = document.getElementById('modalDimActividad');
    const modalDimAdaptaciones = document.getElementById('modalDimAdaptaciones');
    const modalDimAlarma = document.getElementById('modalDimAlarma');
    const btnModalEmail = document.getElementById('btnModalEmail');

    let filtroNivelActual = 'todos';
    let filtroCondicionActual = 'todas';
    let queryBusqueda = '';

    function aplicarFiltros() {
        const filas = document.querySelectorAll('.fila-encuesta');
        const tarjetas = document.querySelectorAll('.tarjeta-encuesta');
        let contadorVisibles = 0;

        function evalItem(item) {
            const fNivel = item.getAttribute('data-filtro') || '';
            const fCond = item.getAttribute('data-condicion') || '';
            const texto = item.getAttribute('data-texto') || '';

            const coincideNivel = (filtroNivelActual === 'todos') || (fNivel === filtroNivelActual);
            const coincideCond = (filtroCondicionActual === 'todas') || (fCond === filtroCondicionActual);
            const coincideTexto = !queryBusqueda || texto.includes(queryBusqueda);

            if (coincideNivel && coincideCond && coincideTexto) {
                item.classList.remove('hidden');
                contadorVisibles++;
            } else {
                item.classList.add('hidden');
            }
        }

        filas.forEach(evalItem);
        tarjetas.forEach(evalItem);

        const totalItems = filas.length;
        if (contadorResultados) {
            contadorResultados.innerHTML = `Mostrando <strong>${contadorVisibles}</strong> de ${totalItems} evaluaciones`;
        }

        if (sinResultados) {
            if (contadorVisibles === 0 && totalItems > 0) {
                sinResultados.classList.remove('hidden');
            } else {
                sinResultados.classList.add('hidden');
            }
        }
    }

    if (inputBuscar) {
        inputBuscar.addEventListener('input', function (e) {
            queryBusqueda = e.target.value.trim().toLowerCase();
            if (btnLimpiar) {
                if (queryBusqueda.length > 0) btnLimpiar.classList.remove('hidden');
                else btnLimpiar.classList.add('hidden');
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

    tabsFiltro.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabsFiltro.forEach(function (t) {
                t.classList.remove('bg-white', 'dark:bg-slate-800', 'text-emerald-700', 'dark:text-emerald-300', 'shadow-xs');
                t.classList.add('text-slate-600', 'dark:text-slate-400');
            });

            tab.classList.add('bg-white', 'dark:bg-slate-800', 'text-emerald-700', 'dark:text-emerald-300', 'shadow-xs');
            tab.classList.remove('text-slate-600', 'dark:text-slate-400');

            filtroNivelActual = tab.getAttribute('data-filtro');
            aplicarFiltros();
        });
    });

    if (selectCondicion) {
        selectCondicion.addEventListener('change', function (e) {
            filtroCondicionActual = e.target.value;
            aplicarFiltros();
        });
    }

    if (btnRestablecer) {
        btnRestablecer.addEventListener('click', function () {
            if (inputBuscar) inputBuscar.value = '';
            queryBusqueda = '';
            if (btnLimpiar) btnLimpiar.classList.add('hidden');
            if (selectCondicion) selectCondicion.value = 'todas';
            filtroCondicionActual = 'todas';

            tabsFiltro.forEach(function (t, idx) {
                if (idx === 0) {
                    t.classList.add('bg-white', 'dark:bg-slate-800', 'text-emerald-700', 'dark:text-emerald-300', 'shadow-xs');
                    t.classList.remove('text-slate-600', 'dark:text-slate-400');
                } else {
                    t.classList.remove('bg-white', 'dark:bg-slate-800', 'text-emerald-700', 'dark:text-emerald-300', 'shadow-xs');
                    t.classList.add('text-slate-600', 'dark:text-slate-400');
                }
            });
            filtroNivelActual = 'todos';
            aplicarFiltros();
        });
    }

    // ==========================================
    // RE-HABILITACIÓN CON SWEETALERT2
    // ==========================================
    document.querySelectorAll('.btn-habilitar-encuesta').forEach(function (boton) {
        boton.addEventListener('click', function (e) {
            e.preventDefault();
            const form = boton.closest('form');
            const contenedor = boton.closest('.fila-encuesta') || boton.closest('.tarjeta-encuesta');
            const paciente = contenedor ? contenedor.getAttribute('data-nombre') : 'el paciente';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '¿Habilitar encuesta de salud?',
                    html: `Se permitirá que <strong>${paciente}</strong> vuelva a responder el instrumento de salud y autocuidado desde su panel.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#059669',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Sí, habilitar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'rounded-3xl dark:bg-slate-800 dark:text-white',
                        confirmButton: 'rounded-xl px-4 py-2 font-semibold',
                        cancelButton: 'rounded-xl px-4 py-2 font-semibold'
                    }
                }).then(function (result) {
                    if (result.isConfirmed) form.submit();
                });
            } else {
                if (confirm(`¿Habilitar la encuesta para ${paciente}?`)) form.submit();
            }
        });
    });

    // ==========================================
    // MODAL DE DIAGNÓSTICO
    // ==========================================
    function aplicarEstiloPill(elem, valor) {
        const v = (valor || '').toLowerCase().trim();
        elem.textContent = valor || 'No evaluado';
        elem.className = 'text-xs font-bold px-2 py-0.5 rounded-md';

        if (v === 'alto') {
            elem.classList.add('bg-emerald-100', 'text-emerald-800', 'dark:bg-emerald-950/60', 'dark:text-emerald-300');
        } else if (v === 'medio') {
            elem.classList.add('bg-amber-100', 'text-amber-800', 'dark:bg-amber-950/60', 'dark:text-amber-300');
        } else {
            elem.classList.add('bg-rose-100', 'text-rose-800', 'dark:bg-rose-950/60', 'dark:text-rose-300');
        }
    }

    function abrirModalDiagnostico(btn) {
        const item = btn.closest('.fila-encuesta') || btn.closest('.tarjeta-encuesta');
        if (!item || !modal) return;

        const nombre = item.getAttribute('data-nombre') || 'Paciente';
        const email = item.getAttribute('data-email') || '';
        const condicion = item.getAttribute('data-condicion-texto') || 'General';
        const fecha = item.getAttribute('data-fecha') || '';
        const intento = item.getAttribute('data-intento') || '1';
        const total = item.getAttribute('data-total') || 'Medio';

        modalNombre.textContent = nombre;
        modalCondicion.textContent = condicion;
        modalFecha.textContent = `${fecha} (Intento #${intento})`;

        // Avatar
        const partes = nombre.trim().split(' ');
        let iniciales = (partes[0] || 'P').charAt(0).toUpperCase();
        if (partes[1]) iniciales += partes[1].charAt(0).toUpperCase();
        modalAvatar.textContent = iniciales;

        // Banner Global
        const vTotal = total.toLowerCase().trim();
        modalNivelTexto.textContent = `Autocuidado ${total}`;
        modalBannerNivel.className = 'p-4 rounded-2xl flex items-center justify-between border';

        if (vTotal === 'alto') {
            modalBannerNivel.classList.add('bg-emerald-50', 'dark:bg-emerald-950/40', 'border-emerald-200', 'dark:border-emerald-800');
            modalPillNivel.className = 'px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200';
            modalPillNivel.textContent = 'Óptimo';
        } else if (vTotal === 'medio') {
            modalBannerNivel.classList.add('bg-amber-50', 'dark:bg-amber-950/40', 'border-amber-200', 'dark:border-amber-800');
            modalPillNivel.className = 'px-3 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200';
            modalPillNivel.textContent = 'Seguimiento';
        } else {
            modalBannerNivel.classList.add('bg-rose-50', 'dark:bg-rose-950/40', 'border-rose-200', 'dark:border-rose-800');
            modalPillNivel.className = 'px-3 py-1 rounded-full text-xs font-extrabold bg-rose-100 text-rose-800 dark:bg-rose-900 dark:text-rose-200';
            modalPillNivel.textContent = 'Prioritario';
        }

        // Dimensiones individuales
        aplicarEstiloPill(modalDimInstrumental, item.getAttribute('data-instrumental'));
        aplicarEstiloPill(modalDimAlimentacion, item.getAttribute('data-alimentacion'));
        aplicarEstiloPill(modalDimActividad, item.getAttribute('data-actividad'));
        aplicarEstiloPill(modalDimAdaptaciones, item.getAttribute('data-adaptaciones'));
        aplicarEstiloPill(modalDimAlarma, item.getAttribute('data-alarma'));

        // Botón contacto
        if (email && email !== 'No registrado') {
            btnModalEmail.href = `mailto:${email}?subject=Seguimiento Plan de Autocuidado - Carefulness&body=Hola ${encodeURIComponent(nombre)}, revisamos tu última evaluación de salud y autocuidado:`;
            btnModalEmail.classList.remove('hidden');
        } else {
            btnModalEmail.classList.add('hidden');
        }

        modal.classList.remove('hidden');
    }

    function cerrarModal() {
        if (modal) modal.classList.add('hidden');
    }

    document.querySelectorAll('.btn-ver-diagnostico').forEach(function (btn) {
        btn.addEventListener('click', function () {
            abrirModalDiagnostico(btn);
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
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) cerrarModal();
    });

    // ==========================================
    // EXPORTACIÓN A EXCEL
    // ==========================================
    if (btnExportarExcel) {
        btnExportarExcel.addEventListener('click', function () {
            if (typeof XLSX === 'undefined') {
                alert('La librería para exportar a Excel está cargando, por favor intenta en unos segundos.');
                return;
            }

            const filas = document.querySelectorAll('.fila-encuesta');
            const datosExcel = [
                ['ID', 'Paciente', 'Correo', 'Condición', 'Fecha', 'Intento', 'Cuidado Instrumental', 'Alimentación', 'Actividad Física', 'Adaptaciones', 'Signos de Alarma', 'Nivel Global']
            ];

            filas.forEach(function (fila) {
                if (!fila.classList.contains('hidden')) {
                    datosExcel.push([
                        fila.getAttribute('data-id') || '',
                        fila.getAttribute('data-nombre') || '',
                        fila.getAttribute('data-email') || '',
                        fila.getAttribute('data-condicion-texto') || '',
                        fila.getAttribute('data-fecha') || '',
                        fila.getAttribute('data-intento') || '',
                        fila.getAttribute('data-instrumental') || '',
                        fila.getAttribute('data-alimentacion') || '',
                        fila.getAttribute('data-actividad') || '',
                        fila.getAttribute('data-adaptaciones') || '',
                        fila.getAttribute('data-alarma') || '',
                        fila.getAttribute('data-total') || ''
                    ]);
                }
            });

            if (datosExcel.length <= 1) {
                alert('No hay evaluaciones visibles para exportar.');
                return;
            }

            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(datosExcel);
            ws['!cols'] = [
                { wch: 8 }, { wch: 25 }, { wch: 28 }, { wch: 16 }, { wch: 14 },
                { wch: 10 }, { wch: 20 }, { wch: 16 }, { wch: 16 }, { wch: 16 },
                { wch: 18 }, { wch: 14 }
            ];

            XLSX.utils.book_append_sheet(wb, ws, 'Encuesta Salud');
            const fechaHoyStr = new Date().toISOString().slice(0, 10);
            XLSX.writeFile(wb, `Evaluaciones_Salud_Autocuidado_${fechaHoyStr}.xlsx`);
        });
    }
});
</script>