<?php
// Precomputar métricas
$totalProfesionales = count($profesionales ?? []);
$totalEnfermeros = 0;
$totalAbogados = 0;
$totalPsicologos = 0;

foreach ($profesionales ?? [] as $p) {
    $prof = strtolower(trim($p->profesion ?? ''));
    if ($prof === 'enfermero') {
        $totalEnfermeros++;
    } elseif ($prof === 'abogado') {
        $totalAbogados++;
    } elseif ($prof === 'psicologo') {
        $totalPsicologos++;
    }
}
?>

<main class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- ==========================================
             1. CABECERA & NAVEGACIÓN
             ========================================== -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-slate-200/80 dark:border-slate-800 pb-5">
            <div class="flex items-center gap-3">
                <a href="/public/admin/index" class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-750 transition shadow-xs" title="Volver al Panel Administrativo">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                            <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                            Gestión Asistencial
                        </span>
                        <span class="text-xs text-slate-400 dark:text-slate-500">|</span>
                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Personal Médico y Legal</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1 tracking-tight">
                        Administración de Profesionales
                    </h1>
                </div>
            </div>

            <!-- Botón de acción principal: Crear Profesional -->
            <div class="flex items-center gap-3">
                <a href="/public/admin/index" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-750 transition shadow-xs">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Panel Admin
                </a>
                <button type="button" id="btnAbrirModalCrear" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 active:scale-95 text-white font-bold text-xs rounded-xl shadow-md shadow-teal-600/20 transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Registrar Nuevo Especialista
                </button>
            </div>
        </div>

        <!-- ==========================================
             2. ALERTAS Y NOTIFICACIONES
             ========================================== -->
        <?php if (intval($resultado) === 1): ?>
            <div id="alerta-exito" class="flex items-center p-4 text-emerald-800 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-emerald-600 bg-emerald-100 rounded-xl dark:bg-emerald-900/60 dark:text-emerald-200 mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium">
                    <span class="font-bold">¡Profesional creado con éxito!</span> Se ha generado la cuenta de acceso y enviado la confirmación al correo electrónico.
                </div>
                <button type="button" onclick="document.getElementById('alerta-exito').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 dark:bg-emerald-950/40 dark:text-emerald-400 dark:hover:bg-emerald-900" aria-label="Cerrar">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        <?php elseif (intval($resultado) === 2): ?>
            <div id="alerta-actualizado" class="flex items-center p-4 text-teal-800 rounded-2xl bg-teal-50 dark:bg-teal-950/60 dark:text-teal-300 border border-teal-200 dark:border-teal-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-teal-600 bg-teal-100 rounded-xl dark:bg-teal-900/60 dark:text-teal-200 mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium">
                    <span class="font-bold">¡Datos actualizados!</span> La información del profesional y su usuario vinculado se guardaron correctamente.
                </div>
                <button type="button" onclick="document.getElementById('alerta-actualizado').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-teal-50 text-teal-500 rounded-lg p-1.5 hover:bg-teal-100 dark:bg-teal-950/40 dark:text-teal-400 dark:hover:bg-teal-900" aria-label="Cerrar">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        <?php elseif (intval($resultado) === 3): ?>
            <div id="alerta-borrado" class="flex items-center p-4 text-blue-800 rounded-2xl bg-blue-50 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200 dark:border-blue-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-blue-600 bg-blue-100 rounded-xl dark:bg-blue-900/60 dark:text-blue-200 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <div class="text-sm font-medium">
                    <span class="font-bold">¡Profesional eliminado!</span> Se eliminó el registro profesional, sus horarios y la cuenta vinculada del sistema.
                </div>
                <button type="button" onclick="document.getElementById('alerta-borrado').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg p-1.5 hover:bg-blue-100 dark:bg-blue-950/40 dark:text-blue-400 dark:hover:bg-blue-900" aria-label="Cerrar">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        <?php endif; ?>

        <!-- Errores de validación -->
        <?php if (!empty($errores)): ?>
            <div id="alerta-errores" class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 shadow-sm animate-fade-in" role="alert">
                <div class="flex items-start gap-3">
                    <div class="shrink-0 p-1 bg-rose-100 dark:bg-rose-900/60 rounded-lg text-rose-600 dark:text-rose-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-sm">Por favor revisa los siguientes campos:</h4>
                        <ul class="list-disc list-inside mt-1.5 text-xs space-y-1">
                            <?php foreach ($errores as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <button type="button" onclick="document.getElementById('alerta-errores').remove()" class="text-rose-400 hover:text-rose-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <!-- ==========================================
             3. KPI METRICAS / TARJETAS RESUMEN
             ========================================== -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-slate-100 dark:bg-slate-750 flex items-center justify-center text-slate-700 dark:text-slate-200 shrink-0 text-xl">
                    👥
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Total Equipo</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white"><?= $totalProfesionales ?></span>
                </div>
            </div>

            <!-- Enfermeros -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-teal-50 dark:bg-teal-950/50 flex items-center justify-center text-teal-600 dark:text-teal-300 shrink-0 text-xl border border-teal-200/50 dark:border-teal-800/50">
                    🩺
                </div>
                <div>
                    <span class="text-xs font-semibold text-teal-600 dark:text-teal-400 uppercase tracking-wider block">Enfermeros(as)</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white"><?= $totalEnfermeros ?></span>
                </div>
            </div>

            <!-- Abogados -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-300 shrink-0 text-xl border border-indigo-200/50 dark:border-indigo-800/50">
                    ⚖️
                </div>
                <div>
                    <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider block">Abogados(as)</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white"><?= $totalAbogados ?></span>
                </div>
            </div>

            <!-- Psicólogos -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-sky-50 dark:bg-sky-950/50 flex items-center justify-center text-sky-600 dark:text-sky-300 shrink-0 text-xl border border-sky-200/50 dark:border-sky-800/50">
                    🧠
                </div>
                <div>
                    <span class="text-xs font-semibold text-sky-600 dark:text-sky-400 uppercase tracking-wider block">Psicólogos(as)</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white"><?= $totalPsicologos ?></span>
                </div>
            </div>
        </div>

        <!-- ==========================================
             4. BARRA DE HERRAMIENTAS: BÚSQUEDA Y FILTRO
             ========================================== -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs p-4 sm:p-5">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                
                <!-- Buscador en tiempo real -->
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="buscadorProfesionales" placeholder="Buscar por nombre, correo, teléfono o especialidad..." class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                </div>

                <!-- Filtros y Contador -->
                <div class="flex items-center gap-2.5">
                    <div class="relative">
                        <select id="filtroProfesion" class="appearance-none bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-xl pl-3.5 pr-8 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 cursor-pointer">
                            <option value="todos">Todas las Profesiones</option>
                            <option value="enfermero">🩺 Enfermería</option>
                            <option value="abogado">⚖️ Abogados</option>
                            <option value="psicologo">🧠 Psicología</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <span id="contadorResultados" class="text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-750 px-3 py-2 rounded-xl">
                        <?= $totalProfesionales ?> profesionales
                    </span>
                </div>
            </div>

            <!-- ==========================================
                 5. TABLA DE PROFESIONALES
                 ========================================== -->
            <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200/70 dark:border-slate-700/70">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm" id="tablaProfesionales">
                        <thead class="bg-slate-50 dark:bg-slate-850/80 text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 border-b border-slate-200/80 dark:border-slate-700">
                            <tr>
                                <th scope="col" class="px-4 py-3.5">Especialista</th>
                                <th scope="col" class="px-4 py-3.5">Profesión & Especialidad</th>
                                <th scope="col" class="px-4 py-3.5">Contacto</th>
                                <th scope="col" class="px-4 py-3.5">Demografía</th>
                                <th scope="col" class="px-4 py-3.5 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 bg-white dark:bg-slate-800">
                            <?php if (empty($profesionales)): ?>
                                <tr id="filaSinDatos">
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="max-w-sm mx-auto">
                                            <span class="text-4xl block mb-2">🩺</span>
                                            <h3 class="text-base font-bold text-slate-700 dark:text-slate-200">No hay profesionales registrados</h3>
                                            <p class="text-xs text-slate-400 mt-1">Empieza registrando al primer especialista asistencial o legal del sistema.</p>
                                            <button type="button" onclick="document.getElementById('btnAbrirModalCrear').click()" class="mt-4 inline-flex items-center gap-1.5 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-xs font-bold transition">
                                                ➕ Registrar Especialista
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($profesionales as $prof): ?>
                                    <?php
                                    $rolProf = strtolower(trim($prof->profesion ?? ''));
                                    $nombreCompleto = trim(($prof->nombre ?? '') . ' ' . ($prof->apellido ?? ''));
                                    if (empty($nombreCompleto)) $nombreCompleto = 'Sin Nombre';

                                    // Configuración de estilo por profesión
                                    $badgeRolColor = 'bg-slate-100 text-slate-700 border-slate-200 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600';
                                    $iconoRol = '🩺';
                                    $nombreRol = 'Profesional';

                                    if ($rolProf === 'abogado') {
                                        $badgeRolColor = 'bg-indigo-50 text-indigo-700 border-indigo-200/80 dark:bg-indigo-950/60 dark:text-indigo-300 dark:border-indigo-800';
                                        $iconoRol = '⚖️';
                                        $nombreRol = 'Abogado';
                                    } elseif ($rolProf === 'enfermero') {
                                        $badgeRolColor = 'bg-teal-50 text-teal-700 border-teal-200/80 dark:bg-teal-950/60 dark:text-teal-300 dark:border-teal-800';
                                        $iconoRol = '🩺';
                                        $nombreRol = 'Enfermero(a)';
                                    } elseif ($rolProf === 'psicologo') {
                                        $badgeRolColor = 'bg-sky-50 text-sky-700 border-sky-200/80 dark:bg-sky-950/60 dark:text-sky-300 dark:border-sky-800';
                                        $iconoRol = '🧠';
                                        $nombreRol = 'Psicólogo(a)';
                                    }

                                    // Foto de perfil
                                    $fotoSrc = "/public/build/img/avatar.webp";
                                    if (!empty($prof->imagen) && file_exists(CARPETA_IMAGENES_USUARIOS . $prof->imagen)) {
                                        $fotoSrc = "/public/imagenesUsuarios/" . htmlspecialchars($prof->imagen);
                                    }
                                    ?>
                                    <tr class="fila-profesional hover:bg-slate-50/70 dark:hover:bg-slate-750/50 transition-colors"
                                        data-nombre="<?= strtolower(htmlspecialchars($nombreCompleto)) ?>"
                                        data-email="<?= strtolower(htmlspecialchars($prof->email ?? '')) ?>"
                                        data-telefono="<?= strtolower(htmlspecialchars($prof->telefono ?? '')) ?>"
                                        data-profesion="<?= $rolProf ?>"
                                        data-especializacion="<?= strtolower(htmlspecialchars($prof->especializacion ?? '')) ?>">
                                        
                                        <!-- Especialista (Avatar + Nombre + ID) -->
                                        <td class="px-4 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <img class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-100 dark:ring-slate-700 shrink-0 bg-slate-100" src="<?= $fotoSrc ?>" alt="<?= htmlspecialchars($nombreCompleto) ?>" onerror="this.src='/public/build/img/avatar.webp'">
                                                <div class="min-w-0">
                                                    <span class="font-bold text-slate-900 dark:text-white block truncate leading-tight">
                                                        <?= htmlspecialchars($nombreCompleto) ?>
                                                    </span>
                                                    <div class="flex items-center gap-1.5 mt-0.5">
                                                        <span class="text-[11px] font-mono text-slate-400">ID: #<?= $prof->id ?></span>
                                                        <?php if (intval($prof->usuario_confirmado ?? 0) === 1): ?>
                                                            <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                                                ✓ Confirmado
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[10px] font-semibold bg-amber-50 text-amber-700 dark:bg-amber-950/50 dark:text-amber-300">
                                                                ⏳ Pendiente
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Profesión & Especialidad -->
                                        <td class="px-4 py-3.5">
                                            <div class="space-y-1">
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold border <?= $badgeRolColor ?>">
                                                    <span><?= $iconoRol ?></span>
                                                    <span><?= $nombreRol ?></span>
                                                </span>
                                                <span class="text-xs text-slate-600 dark:text-slate-300 block font-medium truncate max-w-xs">
                                                    <?= !empty($prof->especializacion) ? htmlspecialchars(ucwords($prof->especializacion)) : 'General' ?>
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Contacto -->
                                        <td class="px-4 py-3.5 text-xs text-slate-600 dark:text-slate-300">
                                            <div class="space-y-1">
                                                <a href="mailto:<?= htmlspecialchars($prof->email ?? '') ?>" class="flex items-center gap-1.5 text-teal-600 dark:text-teal-400 hover:underline truncate max-w-xs" title="Enviar correo">
                                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                    <span class="truncate"><?= htmlspecialchars($prof->email ?? 'Sin correo') ?></span>
                                                </a>
                                                <a href="tel:<?= htmlspecialchars($prof->telefono ?? '') ?>" class="flex items-center gap-1.5 text-slate-500 dark:text-slate-400 hover:text-slate-700 truncate" title="Llamar">
                                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                    <span><?= !empty($prof->telefono) ? htmlspecialchars($prof->telefono) : 'No registrado' ?></span>
                                                </a>
                                            </div>
                                        </td>

                                        <!-- Demografía -->
                                        <td class="px-4 py-3.5 text-xs text-slate-600 dark:text-slate-300">
                                            <div>
                                                <span class="font-semibold block text-slate-700 dark:text-slate-200">
                                                    <?= !empty($prof->edad) ? htmlspecialchars($prof->edad) . ' años' : 'Edad n/d' ?>
                                                </span>
                                                <span class="text-[11px] text-slate-400 capitalize">
                                                    <?= !empty($prof->sexo) ? htmlspecialchars($prof->sexo) : 'Sexo n/d' ?>
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Acciones -->
                                        <td class="px-4 py-3.5 text-right">
                                            <div class="inline-flex items-center gap-1.5">
                                                <!-- Botón Editar -->
                                                <button type="button" 
                                                    class="btn-abrir-editar p-2 text-slate-600 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-400 bg-slate-100 hover:bg-teal-50 dark:bg-slate-700 dark:hover:bg-teal-950/60 rounded-xl transition cursor-pointer"
                                                    title="Editar Profesional"
                                                    data-id="<?= $prof->id ?>"
                                                    data-nombre="<?= htmlspecialchars($prof->nombre ?? '') ?>"
                                                    data-apellido="<?= htmlspecialchars($prof->apellido ?? '') ?>"
                                                    data-email="<?= htmlspecialchars($prof->email ?? '') ?>"
                                                    data-telefono="<?= htmlspecialchars($prof->telefono ?? '') ?>"
                                                    data-profesion="<?= $rolProf ?>"
                                                    data-especializacion="<?= htmlspecialchars($prof->especializacion ?? '') ?>"
                                                    data-sexo="<?= htmlspecialchars($prof->sexo ?? '') ?>"
                                                    data-fecha-nacimiento="<?= htmlspecialchars($prof->fecha_nacimiento ?? '') ?>">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </button>

                                                <!-- Botón Eliminar -->
                                                <button type="button" 
                                                    class="btn-abrir-eliminar p-2 text-slate-600 dark:text-slate-300 hover:text-rose-600 dark:hover:text-rose-400 bg-slate-100 hover:bg-rose-50 dark:bg-slate-700 dark:hover:bg-rose-950/60 rounded-xl transition cursor-pointer"
                                                    title="Eliminar Profesional"
                                                    data-id="<?= $prof->id ?>"
                                                    data-nombre="<?= htmlspecialchars($nombreCompleto) ?>">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <!-- Fila sin resultados de búsqueda -->
                            <tr id="filaSinCoincidencias" class="hidden">
                                <td colspan="5" class="py-10 text-center">
                                    <div class="max-w-xs mx-auto text-slate-400 dark:text-slate-500">
                                        <svg class="w-10 h-10 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        <p class="text-sm font-semibold">No se encontraron profesionales con esos criterios de búsqueda.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- ==========================================
     6. MODAL: REGISTRAR NUEVO PROFESIONAL
     ========================================== -->
<div id="modalCrear" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-200">
    <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-2xl w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 transform scale-95 transition-transform duration-200 overflow-y-auto max-h-[90vh]">
        
        <!-- Header -->
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-700/80">
            <div>
                <span class="text-xs font-bold text-teal-600 dark:text-teal-400 uppercase tracking-wider block">Nuevo Especialista</span>
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">Registrar Profesional</h3>
            </div>
            <button type="button" class="btn-cerrar-modal p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 dark:hover:text-slate-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Formulario -->
        <form method="POST" action="/public/admin/profesionales/administrar" class="mt-5 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Nombre -->
                <div>
                    <label for="crear_nombre" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nombre <span class="text-rose-500">*</span></label>
                    <input type="text" name="nombre" id="crear_nombre" required value="<?= htmlspecialchars($_POST['nombre'] ?? $profesionalC->nombre ?? '') ?>" placeholder="Ej: Diana María" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Apellido -->
                <div>
                    <label for="crear_apellido" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Apellido <span class="text-rose-500">*</span></label>
                    <input type="text" name="apellido" id="crear_apellido" required value="<?= htmlspecialchars($_POST['apellido'] ?? $profesionalC->apellido ?? '') ?>" placeholder="Ej: Gómez Restrepo" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label for="crear_email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Correo Electrónico <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" id="crear_email" required value="<?= htmlspecialchars($_POST['email'] ?? $profesionalC->email ?? '') ?>" placeholder="correo@ejemplo.com" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="crear_telefono" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Teléfono / WhatsApp <span class="text-rose-500">*</span></label>
                    <input type="tel" name="telefono" id="crear_telefono" required value="<?= htmlspecialchars($_POST['telefono'] ?? $profesionalC->telefono ?? '') ?>" placeholder="Ej: 3001234567" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Fecha de Nacimiento -->
                <div>
                    <label for="crear_fecha" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Fecha de Nacimiento <span class="text-rose-500">*</span></label>
                    <input type="date" name="fecha_nacimiento" id="crear_fecha" required value="<?= htmlspecialchars($_POST['fecha_nacimiento'] ?? '') ?>" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Sexo -->
                <div>
                    <label for="crear_sexo" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Sexo <span class="text-rose-500">*</span></label>
                    <select name="sexo" id="crear_sexo" required class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none cursor-pointer">
                        <option value="">Selecciona el sexo</option>
                        <option value="femenino" <?= (($_POST['sexo'] ?? $profesionalC->sexo ?? '') === 'femenino') ? 'selected' : '' ?>>Femenino</option>
                        <option value="masculino" <?= (($_POST['sexo'] ?? $profesionalC->sexo ?? '') === 'masculino') ? 'selected' : '' ?>>Masculino</option>
                    </select>
                </div>

                <!-- Profesión -->
                <div>
                    <label for="crear_profesion" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Profesión / Rol Asignado <span class="text-rose-500">*</span></label>
                    <select name="profesion" id="crear_profesion" required class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none cursor-pointer">
                        <option value="">Selecciona la profesión</option>
                        <option value="enfermero" <?= (($_POST['profesion'] ?? $profesionalC->profesion ?? '') === 'enfermero') ? 'selected' : '' ?>>🩺 Profesional de Enfermería</option>
                        <option value="abogado" <?= (($_POST['profesion'] ?? $profesionalC->profesion ?? '') === 'abogado') ? 'selected' : '' ?>>⚖️ Abogado(a) Especialista</option>
                        <option value="psicologo" <?= (($_POST['profesion'] ?? $profesionalC->profesion ?? '') === 'psicologo') ? 'selected' : '' ?>>🧠 Psicólogo(a) Clínico</option>
                    </select>
                </div>

                <!-- Especialización -->
                <div>
                    <label for="crear_especializacion" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Especialización / Área</label>
                    <input type="text" name="especializacion" id="crear_especializacion" value="<?= htmlspecialchars($_POST['especializacion'] ?? $profesionalC->especializacion ?? '') ?>" placeholder="Ej: Cuidados críticos, Derecho en salud..." class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Contraseña Inicial -->
                <div class="sm:col-span-2">
                    <label for="crear_password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Contraseña Inicial de Acceso <span class="text-rose-500">*</span></label>
                    <input type="password" name="contraseña" id="crear_password" required minlength="6" placeholder="Mínimo 6 caracteres" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                    <p class="text-[11px] text-slate-400 mt-1">El profesional podrá cambiar su contraseña desde su perfil tras ingresar.</p>
                </div>

            </div>

            <!-- Footer con botones -->
            <div class="pt-4 border-t border-slate-100 dark:border-slate-700/80 flex items-center justify-end gap-3">
                <button type="button" class="btn-cerrar-modal px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                    Cancelar
                </button>
                <button type="submit" name="crear" class="px-6 py-2.5 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white rounded-xl text-xs font-bold shadow-md shadow-teal-600/20 active:scale-95 transition">
                    ✓ Registrar y Crear Cuenta
                </button>
            </div>
        </form>

    </div>
</div>

<!-- ==========================================
     7. MODAL: EDITAR PROFESIONAL (DINÁMICO)
     ========================================== -->
<div id="modalEditar" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-200">
    <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-2xl w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 transform scale-95 transition-transform duration-200 overflow-y-auto max-h-[90vh]">
        
        <!-- Header -->
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-700/80">
            <div>
                <span class="text-xs font-bold text-teal-600 dark:text-teal-400 uppercase tracking-wider block">Modificar Ficha</span>
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">Editar Datos del Especialista</h3>
            </div>
            <button type="button" class="btn-cerrar-modal p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 dark:hover:text-slate-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Formulario -->
        <form method="POST" action="/public/admin/profesionales/administrar" class="mt-5 space-y-4">
            <input type="hidden" name="id" id="edit_id" value="">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Nombre -->
                <div>
                    <label for="edit_nombre" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nombre <span class="text-rose-500">*</span></label>
                    <input type="text" name="nombre" id="edit_nombre" required class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Apellido -->
                <div>
                    <label for="edit_apellido" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Apellido <span class="text-rose-500">*</span></label>
                    <input type="text" name="apellido" id="edit_apellido" required class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label for="edit_email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Correo Electrónico <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" id="edit_email" required class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="edit_telefono" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Teléfono <span class="text-rose-500">*</span></label>
                    <input type="tel" name="telefono" id="edit_telefono" required class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Profesión -->
                <div>
                    <label for="edit_profesion" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Profesión <span class="text-rose-500">*</span></label>
                    <select name="profesion" id="edit_profesion" required class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none cursor-pointer">
                        <option value="enfermero">🩺 Profesional de Enfermería</option>
                        <option value="abogado">⚖️ Abogado(a) Especialista</option>
                        <option value="psicologo">🧠 Psicólogo(a) Clínico</option>
                    </select>
                </div>

                <!-- Especialización -->
                <div>
                    <label for="edit_especializacion" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Especialización</label>
                    <input type="text" name="especializacion" id="edit_especializacion" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>

                <!-- Sexo -->
                <div>
                    <label for="edit_sexo" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Sexo</label>
                    <select name="sexo" id="edit_sexo" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none cursor-pointer">
                        <option value="femenino">Femenino</option>
                        <option value="masculino">Masculino</option>
                    </select>
                </div>

                <!-- Fecha de Nacimiento -->
                <div>
                    <label for="edit_fecha" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="edit_fecha" class="w-full px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>
            </div>

            <!-- Footer -->
            <div class="pt-4 border-t border-slate-100 dark:border-slate-700/80 flex items-center justify-end gap-3">
                <button type="button" class="btn-cerrar-modal px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                    Cancelar
                </button>
                <button type="submit" name="actualizar" class="px-6 py-2.5 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white rounded-xl text-xs font-bold shadow-md shadow-teal-600/20 active:scale-95 transition">
                    Guardar Cambios
                </button>
            </div>
        </form>

    </div>
</div>

<!-- ==========================================
     8. MODAL: ELIMINAR PROFESIONAL (CONFIRMACIÓN)
     ========================================== -->
<div id="modalEliminar" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-200">
    <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 text-center transform scale-95 transition-transform duration-200">
        
        <div class="w-14 h-14 mx-auto rounded-2xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center mb-4 border border-rose-200/60 dark:border-rose-800/60">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>

        <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">¿Eliminar este Profesional?</h3>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
            Estás a punto de eliminar a <strong id="delete_nombre_profesional" class="text-slate-800 dark:text-slate-200">este especialista</strong>. Esta acción eliminará su perfil, sus horarios de atención y su cuenta de usuario asociada.
        </p>

        <form method="POST" action="/public/admin/profesionales/administrar" class="mt-6 flex items-center justify-center gap-3">
            <input type="hidden" name="id" id="delete_id" value="">
            <button type="button" class="btn-cerrar-modal px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                No, Cancelar
            </button>
            <button type="submit" name="borrar" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold shadow-md shadow-rose-600/30 active:scale-95 transition">
                Sí, Eliminar Profesional
            </button>
        </form>

    </div>
</div>

<!-- ==========================================
     9. SCRIPTS VANILLA: MODALES + BUSCADOR INTERACTIVO
     ========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Referencias Modales ---
    const modalCrear = document.getElementById('modalCrear');
    const modalEditar = document.getElementById('modalEditar');
    const modalEliminar = document.getElementById('modalEliminar');

    function abrirModal(modal) {
        if (!modal) return;
        modal.classList.remove('opacity-0', 'pointer-events-none');
        const dialog = modal.querySelector('div');
        if (dialog) {
            dialog.classList.remove('scale-95');
            dialog.classList.add('scale-100');
        }
    }

    function cerrarModales() {
        [modalCrear, modalEditar, modalEliminar].forEach(m => {
            if (m) {
                m.classList.add('opacity-0', 'pointer-events-none');
                const dialog = m.querySelector('div');
                if (dialog) {
                    dialog.classList.remove('scale-100');
                    dialog.classList.add('scale-95');
                }
            }
        });
    }

    // Botón abrir Crear
    const btnAbrirCrear = document.getElementById('btnAbrirModalCrear');
    if (btnAbrirCrear) {
        btnAbrirCrear.addEventListener('click', () => abrirModal(modalCrear));
    }

    // Botones cerrar
    document.querySelectorAll('.btn-cerrar-modal').forEach(btn => {
        btn.addEventListener('click', cerrarModales);
    });

    // Cerrar al hacer clic en el backdrop
    [modalCrear, modalEditar, modalEliminar].forEach(m => {
        if (m) {
            m.addEventListener('click', (e) => {
                if (e.target === m) cerrarModales();
            });
        }
    });

    // Cerrar con Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') cerrarModales();
    });

    // --- Manejo del Modal Editar Dinámico ---
    const editId = document.getElementById('edit_id');
    const editNombre = document.getElementById('edit_nombre');
    const editApellido = document.getElementById('edit_apellido');
    const editEmail = document.getElementById('edit_email');
    const editTelefono = document.getElementById('edit_telefono');
    const editProfesion = document.getElementById('edit_profesion');
    const editEspecializacion = document.getElementById('edit_especializacion');
    const editSexo = document.getElementById('edit_sexo');
    const editFecha = document.getElementById('edit_fecha');

    document.querySelectorAll('.btn-abrir-editar').forEach(btn => {
        btn.addEventListener('click', function () {
            if (editId) editId.value = this.dataset.id || '';
            if (editNombre) editNombre.value = this.dataset.nombre || '';
            if (editApellido) editApellido.value = this.dataset.apellido || '';
            if (editEmail) editEmail.value = this.dataset.email || '';
            if (editTelefono) editTelefono.value = this.dataset.telefono || '';
            if (editProfesion) editProfesion.value = this.dataset.profesion || 'enfermero';
            if (editEspecializacion) editEspecializacion.value = this.dataset.especializacion || '';
            if (editSexo) editSexo.value = this.dataset.sexo || 'femenino';
            if (editFecha) editFecha.value = this.dataset.fechaNacimiento || '';

            abrirModal(modalEditar);
        });
    });

    // --- Manejo del Modal Eliminar Dinámico ---
    const deleteId = document.getElementById('delete_id');
    const deleteNombre = document.getElementById('delete_nombre_profesional');

    document.querySelectorAll('.btn-abrir-eliminar').forEach(btn => {
        btn.addEventListener('click', function () {
            if (deleteId) deleteId.value = this.dataset.id || '';
            if (deleteNombre) deleteNombre.textContent = this.dataset.nombre || 'este especialista';

            abrirModal(modalEliminar);
        });
    });

    // --- Buscador y Filtro por Profesión en Tiempo Real ---
    const buscador = document.getElementById('buscadorProfesionales');
    const filtroProfesion = document.getElementById('filtroProfesion');
    const filas = document.querySelectorAll('.fila-profesional');
    const filaSinCoincidencias = document.getElementById('filaSinCoincidencias');
    const contadorResultados = document.getElementById('contadorResultados');

    function filtrarTabla() {
        const query = (buscador ? buscador.value : '').toLowerCase().trim();
        const profesionSeleccionada = (filtroProfesion ? filtroProfesion.value : 'todos').toLowerCase();
        let visibles = 0;

        filas.forEach(fila => {
            const nombre = fila.dataset.nombre || '';
            const email = fila.dataset.email || '';
            const telefono = fila.dataset.telefono || '';
            const profesion = fila.dataset.profesion || '';
            const especializacion = fila.dataset.especializacion || '';

            const coincideTexto = !query || 
                nombre.includes(query) || 
                email.includes(query) || 
                telefono.includes(query) || 
                especializacion.includes(query);

            const coincideProfesion = (profesionSeleccionada === 'todos') || (profesion === profesionSeleccionada);

            if (coincideTexto && coincideProfesion) {
                fila.classList.remove('hidden');
                visibles++;
            } else {
                fila.classList.add('hidden');
            }
        });

        if (filaSinCoincidencias) {
            if (visibles === 0 && filas.length > 0) {
                filaSinCoincidencias.classList.remove('hidden');
            } else {
                filaSinCoincidencias.classList.add('hidden');
            }
        }

        if (contadorResultados) {
            contadorResultados.textContent = `${visibles} de ${filas.length} profesionales`;
        }
    }

    if (buscador) buscador.addEventListener('input', filtrarTabla);
    if (filtroProfesion) filtroProfesion.addEventListener('change', filtrarTabla);
});
</script>