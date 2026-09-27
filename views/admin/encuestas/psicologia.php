<?php
// Precomputar métricas para la evaluación psicológica
$totalEncuestas = count($encuestas ?? []);
$totalAlerta = 0;
$totalModerado = 0;
$totalEstable = 0;

foreach ($encuestas ?? [] as $e) {
    $dep = floatval($e['tristeza_depresion'] ?? 0);
    $ans = floatval($e['ansiedad'] ?? 0);
    $ira = floatval($e['ira_hostilidad'] ?? 0);
    $ale = floatval($e['alegria'] ?? 0);

    if ($dep >= 2.75 || $ans >= 2.75) {
        $totalAlerta++;
    } elseif ($dep >= 2.0 || $ans >= 2.0 || $ira >= 2.5) {
        $totalModerado++;
    } else {
        $totalEstable++;
    }
}

// URL de retorno
$rolActual = strtolower($rol ?? $_SESSION['rol'] ?? '');
$urlVolver = '/public/admin/index';
if ($rolActual === 'psicologo') {
    $urlVolver = '/public/admin/psicologos';
} elseif ($rolActual === 'enfermero') {
    $urlVolver = '/public/admin/enfermeros';
} elseif ($rolActual === 'abogado') {
    $urlVolver = '/public/admin/abogados';
} elseif ($rolActual === 'profesional') {
    $urlVolver = '/public/admin/indexProfesionales';
}

// Helper para categorizar perfil emocional general
if (!function_exists('obtenerPerfilPsicologico')) {
    function obtenerPerfilPsicologico($dep, $ans, $ira, $ale) {
        if ($dep >= 2.75 && $ans >= 2.75) {
            return ['tipo' => 'alerta', 'titulo' => 'Alerta Mixta (Ansiedad/Depresión)', 'color' => 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border-rose-200 dark:border-rose-800'];
        } elseif ($dep >= 2.75) {
            return ['tipo' => 'alerta', 'titulo' => 'Alerta Síntomas Depresivos', 'color' => 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border-rose-200 dark:border-rose-800'];
        } elseif ($ans >= 2.75) {
            return ['tipo' => 'alerta', 'titulo' => 'Alerta Síntomas de Ansiedad', 'color' => 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border-rose-200 dark:border-rose-800'];
        } elseif ($dep >= 2.0 || $ans >= 2.0 || $ira >= 2.5) {
            return ['tipo' => 'moderado', 'titulo' => 'Riesgo Emocional Moderado', 'color' => 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800'];
        } else {
            return ['tipo' => 'estable', 'titulo' => 'Bienestar Emocional Favorable', 'color' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800'];
        }
    }
}

if (!function_exists('colorSubescalaNegativa')) {
    function colorSubescalaNegativa($val) {
        if ($val >= 2.75) return 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border-rose-200 dark:border-rose-800';
        if ($val >= 2.0) return 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800';
        return 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800';
    }
}

if (!function_exists('colorSubescalaPositiva')) {
    function colorSubescalaPositiva($val) {
        if ($val >= 2.75) return 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800';
        if ($val >= 2.0) return 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800';
        return 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border-rose-200 dark:border-rose-800';
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
                    <span class="font-bold">¡Encuesta habilitada exitosamente!</span> El paciente podrá volver a completar el instrumento de evaluación psicológica.
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
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-violet-500/10 dark:bg-violet-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-violet-100 text-violet-800 dark:bg-violet-950/60 dark:text-violet-300 border border-violet-200 dark:border-violet-800">
                        <span class="w-2 h-2 rounded-full bg-violet-500 animate-pulse"></span>
                        EVALUACIÓN CLÍNICA &middot; BIENESTAR Y SALUD EMOCIONAL
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Evaluaciones de <span class="text-violet-600 dark:text-violet-400">Salud Psicológica</span>
                    </h1>
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-2xl leading-relaxed">
                        Monitorea el estado emocional de los pacientes crónicos. Analiza índices de tristeza/depresión, ansiedad, hostilidad y afecto positivo para brindar soporte psicoterapéutico oportuno.
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
            <!-- Total Encuestas -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Evaluaciones</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalEncuestas ?></p>
                </div>
            </div>

            <!-- Bienestar Favorable -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wider">Bienestar Estable</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalEstable ?></p>
                </div>
            </div>

            <!-- Nivel Moderado -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-400 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 uppercase tracking-wider">Riesgo Moderado</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalModerado ?></p>
                </div>
            </div>

            <!-- Alerta Emocional -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4 relative overflow-hidden">
                <?php if ($totalAlerta > 0): ?>
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
                    <span class="text-xs font-semibold text-rose-700 dark:text-rose-400 uppercase tracking-wider">Alerta Emocional</span>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white"><?= $totalAlerta ?></p>
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
                           class="w-full pl-10 pr-10 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition-colors" 
                           placeholder="Buscar por paciente, correo o condición...">
                    <button type="button" id="btnLimpiarBusqueda" class="hidden absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Pestañas de Filtro por Perfil -->
                <div class="flex flex-wrap items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-900/80 rounded-xl">
                    <button type="button" data-filtro="todos" class="tab-filtro px-3 py-1.5 rounded-lg text-xs font-semibold transition-all bg-white dark:bg-slate-800 text-violet-700 dark:text-violet-300 shadow-xs">
                        Todas <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300"><?= $totalEncuestas ?></span>
                    </button>
                    <button type="button" data-filtro="alerta" class="tab-filtro px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Alerta Emocional <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-rose-100 dark:bg-rose-950/60 text-rose-800 dark:text-rose-300"><?= $totalAlerta ?></span>
                    </button>
                    <button type="button" data-filtro="moderado" class="tab-filtro px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Moderado <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300"><?= $totalModerado ?></span>
                    </button>
                    <button type="button" data-filtro="estable" class="tab-filtro px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                        Estable <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300"><?= $totalEstable ?></span>
                    </button>
                </div>

                <!-- Filtro por Condición -->
                <div class="flex items-center gap-2">
                    <label for="selectCondicion" class="text-xs font-medium text-slate-500 dark:text-slate-400 shrink-0">Condición:</label>
                    <select id="selectCondicion" class="py-2 px-3 text-xs font-semibold rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 focus:ring-violet-500 focus:border-violet-500">
                        <option value="todas">Todas las condiciones</option>
                        <option value="diabetes">Diabetes</option>
                        <option value="colostomia">Colostomía</option>
                        <option value="general">General / Otras</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 pt-2 border-t border-slate-100 dark:border-slate-700/60">
                <span id="contadorResultados">Mostrando <strong><?= $totalEncuestas ?></strong> evaluaciones</span>
                <span class="hidden sm:inline-block italic text-[11px]">Escala de evaluación psicológica de 1.0 (mínimo) a 4.0 (máximo)</span>
            </div>
        </section>

        <!-- ==========================================
             5. LISTADO Y TABLA DE EVALUACIONES
             ========================================== -->
        <section class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
            
            <?php if (empty($encuestas)): ?>
                <div class="py-16 px-6 text-center space-y-4">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-violet-50 dark:bg-violet-950/40 text-violet-600 dark:text-violet-400 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="max-w-md mx-auto">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Sin evaluaciones psicológicas</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                            Aún no se registran respuestas en el cuestionario de estado emocional.
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
                                <th scope="col" class="px-5 py-4">Subescalas Emocionales (1 a 4)</th>
                                <th scope="col" class="px-5 py-4 text-center">Perfil Emocional</th>
                                <th scope="col" class="px-5 py-4 text-center">Estado</th>
                                <th scope="col" class="px-5 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaEncuestasBody" class="divide-y divide-slate-100 dark:divide-slate-700/60">
                            <?php foreach ($encuestas as $encuesta):
                                $dep = floatval($encuesta['tristeza_depresion'] ?? 0);
                                $ans = floatval($encuesta['ansiedad'] ?? 0);
                                $ira = floatval($encuesta['ira_hostilidad'] ?? 0);
                                $ale = floatval($encuesta['alegria'] ?? 0);

                                $perfil = obtenerPerfilPsicologico($dep, $ans, $ira, $ale);

                                $condicionRaw = strtolower(trim($encuesta['enfermedad'] ?? 'general'));
                                $condicionNormalizada = (strpos($condicionRaw, 'diabetes') !== false) ? 'diabetes' : ((strpos($condicionRaw, 'colostomia') !== false) ? 'colostomia' : 'general');
                                $fecha = !empty($encuesta['fecha_registro']) ? date("d/m/Y", strtotime($encuesta['fecha_registro'])) : 'Reciente';
                                $estaBloqueada = intval($encuesta['encuesta_psicologia'] ?? 1) === 1;

                                $partes = explode(' ', trim($encuesta['nombre'] ?? 'Paciente'));
                                $iniciales = mb_strtoupper(mb_substr($partes[0] ?? 'P', 0, 1));
                                if (!empty($partes[1])) {
                                    $iniciales .= mb_strtoupper(mb_substr($partes[1], 0, 1));
                                }
                            ?>
                                <tr class="fila-encuesta hover:bg-slate-50/80 dark:hover:bg-slate-750/50 transition-colors"
                                    data-filtro="<?= $perfil['tipo'] ?>"
                                    data-condicion="<?= $condicionNormalizada ?>"
                                    data-texto="<?= strtolower(htmlspecialchars(($encuesta['nombre'] ?? '') . ' ' . ($encuesta['email'] ?? '') . ' ' . ($encuesta['enfermedad'] ?? '') . ' ' . $perfil['titulo'])) ?>"
                                    data-id="<?= $encuesta['id'] ?>"
                                    data-usuario-id="<?= $encuesta['usuario_id'] ?>"
                                    data-nombre="<?= htmlspecialchars($encuesta['nombre'] ?? 'Paciente') ?>"
                                    data-email="<?= htmlspecialchars($encuesta['email'] ?? 'No registrado') ?>"
                                    data-condicion-texto="<?= htmlspecialchars($encuesta['enfermedad'] ?? 'General') ?>"
                                    data-fecha="<?= $fecha ?>"
                                    data-intento="<?= htmlspecialchars($encuesta['intento'] ?? '1') ?>"
                                    data-depresion="<?= number_format($dep, 2) ?>"
                                    data-ansiedad="<?= number_format($ans, 2) ?>"
                                    data-hostilidad="<?= number_format($ira, 2) ?>"
                                    data-alegria="<?= number_format($ale, 2) ?>"
                                    data-perfil-titulo="<?= htmlspecialchars($perfil['titulo']) ?>"
                                    data-perfil-tipo="<?= $perfil['tipo'] ?>">

                                    <!-- 1. Paciente -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-violet-500 to-indigo-400 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
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

                                    <!-- 4. Subescalas Emocionales -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="flex flex-wrap items-center gap-1 max-w-sm">
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorSubescalaNegativa($dep) ?>" title="Tristeza y Depresión">
                                                Depresión: <?= number_format($dep, 2) ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorSubescalaNegativa($ans) ?>" title="Ansiedad">
                                                Ansiedad: <?= number_format($ans, 2) ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorSubescalaNegativa($ira) ?>" title="Ira y Hostilidad">
                                                Ira: <?= number_format($ira, 2) ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold border <?= colorSubescalaPositiva($ale) ?>" title="Alegría y Afecto Positivo">
                                                Alegría: <?= number_format($ale, 2) ?>
                                            </span>
                                        </div>
                                    </td>

                                    <!-- 5. Perfil Emocional -->
                                    <td class="px-5 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border <?= $perfil['color'] ?>">
                                            <?php if ($perfil['tipo'] === 'alerta'): ?>
                                                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                                            <?php elseif ($perfil['tipo'] === 'moderado'): ?>
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                            <?php else: ?>
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                            <?php endif; ?>
                                            <?= $perfil['titulo'] ?>
                                        </span>
                                    </td>

                                    <!-- 6. Estado -->
                                    <td class="px-5 py-4 whitespace-nowrap text-center">
                                        <?php if ($estaBloqueada): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-100 text-slate-600 dark:bg-slate-750 dark:text-slate-400">
                                                Completada
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-violet-50 text-violet-700 dark:bg-violet-950/40 dark:text-violet-300">
                                                Habilitada
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 7. Acciones -->
                                    <td class="px-5 py-4 whitespace-nowrap text-right">
                                        <div class="inline-flex items-center justify-end gap-2">
                                            <button type="button" 
                                                    class="btn-ver-diagnostico inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-semibold text-violet-700 dark:text-violet-300 bg-violet-50 hover:bg-violet-100 dark:bg-violet-950/40 dark:hover:bg-violet-900/60 border border-violet-200 dark:border-violet-800 transition-colors"
                                                    title="Ver perfil psicológico completo">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Diagnóstico
                                            </button>

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

                <!-- Vista de Tarjetas para Móviles -->
                <div id="encuestasMobileList" class="lg:hidden divide-y divide-slate-100 dark:divide-slate-700/60 p-4 space-y-4">
                    <?php foreach ($encuestas as $encuesta): 
                        $dep = floatval($encuesta['tristeza_depresion'] ?? 0);
                        $ans = floatval($encuesta['ansiedad'] ?? 0);
                        $ira = floatval($encuesta['ira_hostilidad'] ?? 0);
                        $ale = floatval($encuesta['alegria'] ?? 0);
                        $perfil = obtenerPerfilPsicologico($dep, $ans, $ira, $ale);

                        $condicionRaw = strtolower(trim($encuesta['enfermedad'] ?? 'general'));
                        $condicionNormalizada = (strpos($condicionRaw, 'diabetes') !== false) ? 'diabetes' : ((strpos($condicionRaw, 'colostomia') !== false) ? 'colostomia' : 'general');
                        $fecha = !empty($encuesta['fecha_registro']) ? date("d/m/Y", strtotime($encuesta['fecha_registro'])) : 'Reciente';
                        $estaBloqueada = intval($encuesta['encuesta_psicologia'] ?? 1) === 1;
                    ?>
                        <div class="tarjeta-encuesta bg-slate-50 dark:bg-slate-750 p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 space-y-3"
                             data-filtro="<?= $perfil['tipo'] ?>"
                             data-condicion="<?= $condicionNormalizada ?>"
                             data-texto="<?= strtolower(htmlspecialchars(($encuesta['nombre'] ?? '') . ' ' . ($encuesta['email'] ?? '') . ' ' . ($encuesta['enfermedad'] ?? '') . ' ' . $perfil['titulo'])) ?>"
                             data-id="<?= $encuesta['id'] ?>"
                             data-usuario-id="<?= $encuesta['usuario_id'] ?>"
                             data-nombre="<?= htmlspecialchars($encuesta['nombre'] ?? 'Paciente') ?>"
                             data-email="<?= htmlspecialchars($encuesta['email'] ?? 'No registrado') ?>"
                             data-condicion-texto="<?= htmlspecialchars($encuesta['enfermedad'] ?? 'General') ?>"
                             data-fecha="<?= $fecha ?>"
                             data-intento="<?= htmlspecialchars($encuesta['intento'] ?? '1') ?>"
                             data-depresion="<?= number_format($dep, 2) ?>"
                             data-ansiedad="<?= number_format($ans, 2) ?>"
                             data-hostilidad="<?= number_format($ira, 2) ?>"
                             data-alegria="<?= number_format($ale, 2) ?>"
                             data-perfil-titulo="<?= htmlspecialchars($perfil['titulo']) ?>"
                             data-perfil-tipo="<?= $perfil['tipo'] ?>">

                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="font-bold text-base text-slate-900 dark:text-white">
                                        <?= htmlspecialchars($encuesta['nombre'] ?? 'Paciente') ?>
                                    </h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                        <?= htmlspecialchars($encuesta['email'] ?? 'Sin correo') ?>
                                    </p>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border <?= $perfil['color'] ?>">
                                    <?= $perfil['titulo'] ?>
                                </span>
                            </div>

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
                                <button type="button" class="btn-ver-diagnostico px-3 py-1.5 text-xs font-semibold text-violet-700 dark:text-violet-300 bg-violet-50 dark:bg-violet-950/40 rounded-xl">
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

                <div id="sinResultados" class="hidden py-12 px-4 text-center">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-400 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">No se encontraron evaluaciones con los filtros aplicados</p>
                    <button type="button" id="btnRestablecerFiltros" class="mt-4 px-4 py-2 rounded-xl text-xs font-semibold bg-violet-600 text-white hover:bg-violet-700 transition-colors">
                        Restablecer Filtros
                    </button>
                </div>

            <?php endif; ?>
        </section>

    </div>
</main>

<!-- ==========================================
     6. MODAL DE DIAGNÓSTICO EMOCIONAL DETALLADO
     ========================================== -->
<div id="modalDiagnosticoPsicologia" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs overflow-y-auto flex items-center justify-center p-4">
    <div class="relative bg-white dark:bg-slate-800 rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-700 transform transition-all animate-fade-in space-y-6">
        
        <!-- Header del Modal -->
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-3">
                <div id="modalAvatar" class="w-12 h-12 rounded-2xl bg-violet-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
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

        <!-- Banner de Perfil Clínico -->
        <div id="modalBannerPerfil" class="p-4 rounded-2xl flex items-center justify-between border">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider block text-slate-500 dark:text-slate-400">Evaluación Emocional Global</span>
                <div id="modalPerfilTitulo" class="text-xl font-extrabold mt-0.5">Perfil</div>
            </div>
            <span id="modalPillPerfil" class="px-3 py-1 rounded-full text-xs font-extrabold">Estado</span>
        </div>

        <!-- Termómetros de las 4 Subescalas -->
        <div class="space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Termómetro Emocional (Rango 1.0 a 4.0)</h4>
            
            <div class="space-y-3">
                
                <!-- 1. Tristeza / Depresión -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="font-bold text-slate-800 dark:text-slate-200">Tristeza y Sintomatología Depresiva</span>
                        <span id="modalValDepresion" class="font-extrabold text-sm text-slate-900 dark:text-white">2.50 / 4.0</span>
                    </div>
                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                        <div id="modalBarDepresion" class="h-2.5 rounded-full transition-all duration-500" style="width: 50%;"></div>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">Sentimientos de desánimo, soledad y desesperanza vinculados a su condición crónica.</p>
                </div>

                <!-- 2. Ansiedad -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="font-bold text-slate-800 dark:text-slate-200">Ansiedad e Inquietud</span>
                        <span id="modalValAnsiedad" class="font-extrabold text-sm text-slate-900 dark:text-white">2.50 / 4.0</span>
                    </div>
                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                        <div id="modalBarAnsiedad" class="h-2.5 rounded-full transition-all duration-500" style="width: 50%;"></div>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">Preocupación persistente, tensión somática y miedo ante complicaciones médicas.</p>
                </div>

                <!-- 3. Ira / Hostilidad -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="font-bold text-slate-800 dark:text-slate-200">Ira, Hostilidad e Irritabilidad</span>
                        <span id="modalValHostilidad" class="font-extrabold text-sm text-slate-900 dark:text-white">1.75 / 4.0</span>
                    </div>
                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                        <div id="modalBarHostilidad" class="h-2.5 rounded-full transition-all duration-500" style="width: 40%;"></div>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">Frustración con el tratamiento, reactividad emocional y dificultades relacionales.</p>
                </div>

                <!-- 4. Alegría / Afecto Positivo -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/80 dark:border-slate-700/80">
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="font-bold text-slate-800 dark:text-slate-200">Alegría, Optimismo y Resiliencia</span>
                        <span id="modalValAlegria" class="font-extrabold text-sm text-slate-900 dark:text-white">3.25 / 4.0</span>
                    </div>
                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                        <div id="modalBarAlegria" class="h-2.5 rounded-full transition-all duration-500" style="width: 80%;"></div>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">Capacidad para experimentar disfrute, gratitud y mantener una actitud positiva.</p>
                </div>

            </div>
        </div>

        <!-- Acciones del Modal -->
        <div class="flex flex-wrap items-center justify-between gap-3 pt-2 border-t border-slate-200/80 dark:border-slate-700/80">
            <a id="btnModalEmail" href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Agendar Sesión / Correo
            </a>

            <button type="button" id="btnCerrarModalBottom" class="px-5 py-2 rounded-xl text-xs font-semibold text-white bg-slate-800 hover:bg-slate-900 dark:bg-slate-700 dark:hover:bg-slate-600 transition-colors">
                Entendido
            </button>
        </div>

    </div>
</div>

<!-- ==========================================
     7. SCRIPT JAVASCRIPT
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
    const modal = document.getElementById('modalDiagnosticoPsicologia');
    const btnCerrarModal = document.getElementById('btnCerrarModal');
    const btnCerrarModalBottom = document.getElementById('btnCerrarModalBottom');
    const modalAvatar = document.getElementById('modalAvatar');
    const modalNombre = document.getElementById('modalNombre');
    const modalCondicion = document.getElementById('modalCondicion');
    const modalFecha = document.getElementById('modalFecha');
    const modalBannerPerfil = document.getElementById('modalBannerPerfil');
    const modalPerfilTitulo = document.getElementById('modalPerfilTitulo');
    const modalPillPerfil = document.getElementById('modalPillPerfil');
    const modalValDepresion = document.getElementById('modalValDepresion');
    const modalBarDepresion = document.getElementById('modalBarDepresion');
    const modalValAnsiedad = document.getElementById('modalValAnsiedad');
    const modalBarAnsiedad = document.getElementById('modalBarAnsiedad');
    const modalValHostilidad = document.getElementById('modalValHostilidad');
    const modalBarHostilidad = document.getElementById('modalBarHostilidad');
    const modalValAlegria = document.getElementById('modalValAlegria');
    const modalBarAlegria = document.getElementById('modalBarAlegria');
    const btnModalEmail = document.getElementById('btnModalEmail');

    let filtroPerfilActual = 'todos';
    let filtroCondicionActual = 'todas';
    let queryBusqueda = '';

    function aplicarFiltros() {
        const filas = document.querySelectorAll('.fila-encuesta');
        const tarjetas = document.querySelectorAll('.tarjeta-encuesta');
        let contadorVisibles = 0;

        function evalItem(item) {
            const fPerfil = item.getAttribute('data-filtro') || '';
            const fCond = item.getAttribute('data-condicion') || '';
            const texto = item.getAttribute('data-texto') || '';

            const coincidePerfil = (filtroPerfilActual === 'todos') || (fPerfil === filtroPerfilActual);
            const coincideCond = (filtroCondicionActual === 'todas') || (fCond === filtroCondicionActual);
            const coincideTexto = !queryBusqueda || texto.includes(queryBusqueda);

            if (coincidePerfil && coincideCond && coincideTexto) {
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
            if (contadorVisibles === 0 && totalItems > 0) sinResultados.classList.remove('hidden');
            else sinResultados.classList.add('hidden');
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
                t.classList.remove('bg-white', 'dark:bg-slate-800', 'text-violet-700', 'dark:text-violet-300', 'shadow-xs');
                t.classList.add('text-slate-600', 'dark:text-slate-400');
            });

            tab.classList.add('bg-white', 'dark:bg-slate-800', 'text-violet-700', 'dark:text-violet-300', 'shadow-xs');
            tab.classList.remove('text-slate-600', 'dark:text-slate-400');

            filtroPerfilActual = tab.getAttribute('data-filtro');
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
                    t.classList.add('bg-white', 'dark:bg-slate-800', 'text-violet-700', 'dark:text-violet-300', 'shadow-xs');
                    t.classList.remove('text-slate-600', 'dark:text-slate-400');
                } else {
                    t.classList.remove('bg-white', 'dark:bg-slate-800', 'text-violet-700', 'dark:text-violet-300', 'shadow-xs');
                    t.classList.add('text-slate-600', 'dark:text-slate-400');
                }
            });
            filtroPerfilActual = 'todos';
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
                    title: '¿Habilitar cuestionario psicológico?',
                    html: `Se permitirá que <strong>${paciente}</strong> vuelva a responder la evaluación de bienestar emocional.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#7c3aed',
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
                if (confirm(`¿Habilitar la evaluación para ${paciente}?`)) form.submit();
            }
        });
    });

    // ==========================================
    // MODAL DE DIAGNÓSTICO
    // ==========================================
    function actualizarBarra(val, elemVal, elemBar, esPositiva) {
        const num = parseFloat(val) || 1.0;
        const pct = Math.min(100, Math.max(10, ((num - 1.0) / 3.0) * 100));
        elemVal.textContent = `${num.toFixed(2)} / 4.0`;
        elemBar.style.width = `${pct}%`;

        elemBar.className = 'h-2.5 rounded-full transition-all duration-500';
        if (!esPositiva) {
            if (num >= 2.75) elemBar.classList.add('bg-rose-500');
            else if (num >= 2.0) elemBar.classList.add('bg-amber-500');
            else elemBar.classList.add('bg-emerald-500');
        } else {
            if (num >= 2.75) elemBar.classList.add('bg-emerald-500');
            else if (num >= 2.0) elemBar.classList.add('bg-amber-500');
            else elemBar.classList.add('bg-rose-500');
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
        const perfilTitulo = item.getAttribute('data-perfil-titulo') || 'Perfil';
        const perfilTipo = item.getAttribute('data-perfil-tipo') || 'estable';

        const dep = item.getAttribute('data-depresion');
        const ans = item.getAttribute('data-ansiedad');
        const ira = item.getAttribute('data-hostilidad');
        const ale = item.getAttribute('data-alegria');

        modalNombre.textContent = nombre;
        modalCondicion.textContent = condicion;
        modalFecha.textContent = `${fecha} (Intento #${intento})`;

        const partes = nombre.trim().split(' ');
        let iniciales = (partes[0] || 'P').charAt(0).toUpperCase();
        if (partes[1]) iniciales += partes[1].charAt(0).toUpperCase();
        modalAvatar.textContent = iniciales;

        // Banner perfil
        modalPerfilTitulo.textContent = perfilTitulo;
        modalBannerPerfil.className = 'p-4 rounded-2xl flex items-center justify-between border';

        if (perfilTipo === 'alerta') {
            modalBannerPerfil.classList.add('bg-rose-50', 'dark:bg-rose-950/40', 'border-rose-200', 'dark:border-rose-800');
            modalPillPerfil.className = 'px-3 py-1 rounded-full text-xs font-extrabold bg-rose-100 text-rose-800 dark:bg-rose-900 dark:text-rose-200';
            modalPillPerfil.textContent = 'Alerta Prioritaria';
        } else if (perfilTipo === 'moderado') {
            modalBannerPerfil.classList.add('bg-amber-50', 'dark:bg-amber-950/40', 'border-amber-200', 'dark:border-amber-800');
            modalPillPerfil.className = 'px-3 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200';
            modalPillPerfil.textContent = 'Seguimiento';
        } else {
            modalBannerPerfil.classList.add('bg-emerald-50', 'dark:bg-emerald-950/40', 'border-emerald-200', 'dark:border-emerald-800');
            modalPillPerfil.className = 'px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200';
            modalPillPerfil.textContent = 'Favorable';
        }

        actualizarBarra(dep, modalValDepresion, modalBarDepresion, false);
        actualizarBarra(ans, modalValAnsiedad, modalBarAnsiedad, false);
        actualizarBarra(ira, modalValHostilidad, modalBarHostilidad, false);
        actualizarBarra(ale, modalValAlegria, modalBarAlegria, true);

        if (email && email !== 'No registrado') {
            btnModalEmail.href = `mailto:${email}?subject=Sesión de Acompañamiento Emocional - Carefulness&body=Hola ${encodeURIComponent(nombre)}, revisamos tu última evaluación psicológica y quisiéramos ofrecerte un espacio de diálogo:`;
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
                ['ID', 'Paciente', 'Correo', 'Condición', 'Fecha', 'Intento', 'Depresión (1-4)', 'Ansiedad (1-4)', 'Hostilidad (1-4)', 'Alegría (1-4)', 'Perfil Clínico']
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
                        fila.getAttribute('data-depresion') || '',
                        fila.getAttribute('data-ansiedad') || '',
                        fila.getAttribute('data-hostilidad') || '',
                        fila.getAttribute('data-alegria') || '',
                        fila.getAttribute('data-perfil-titulo') || ''
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
                { wch: 10 }, { wch: 18 }, { wch: 18 }, { wch: 18 }, { wch: 18 },
                { wch: 30 }
            ];

            XLSX.utils.book_append_sheet(wb, ws, 'Encuesta Psicología');
            const fechaHoyStr = new Date().toISOString().slice(0, 10);
            XLSX.writeFile(wb, `Evaluaciones_Psicologicas_${fechaHoyStr}.xlsx`);
        });
    }
});
</script>