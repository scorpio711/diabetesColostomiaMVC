<?php
// Precomputar edad
$edadCalculada = null;
if (!empty($usuario->fecha_nacimiento)) {
    try {
        $nac = new DateTime($usuario->fecha_nacimiento);
        $hoy = new DateTime();
        $edadCalculada = $nac->diff($hoy)->y;
    } catch (\Throwable $e) {
        $edadCalculada = null;
    }
}

// Imagen del usuario
$imagenUsuario = "/public/build/img/avatar.webp";
if (!empty($usuario->imagen) && file_exists(CARPETA_IMAGENES_USUARIOS . $usuario->imagen)) {
    $imagenUsuario = "/public/imagenesUsuarios/" . htmlspecialchars($usuario->imagen);
} elseif (!empty($_SESSION["imagen"]) && file_exists(CARPETA_IMAGENES_USUARIOS . $_SESSION["imagen"])) {
    $imagenUsuario = "/public/imagenesUsuarios/" . htmlspecialchars($_SESSION["imagen"]);
}

// Condición y colores
$condicion = strtolower(trim($usuario->enfermedad ?? 'general'));
$esDiabetes = strpos($condicion, 'diabetes') !== false;
$esColostomia = strpos($condicion, 'colostomia') !== false || strpos($condicion, 'colostomía') !== false;

$estaActualizado = intval($usuario->actualizado ?? 0) === 1;

// Datos de paciente con prioridad absoluta a $_POST (para preservar las respuestas si hay errores de validación)
$escolaridadActual = strtolower(trim($_POST['escolaridad'] ?? (!empty($pacienteActualizado->id) ? $pacienteActualizado->escolaridad : '')));
$estratoActual = strval($_POST['estrato_socioeconomico'] ?? (!empty($pacienteActualizado->id) ? $pacienteActualizado->estrato_socioeconomico : ''));
$residenciaActual = strtolower(trim($_POST['lugar_de_residencia'] ?? (!empty($pacienteActualizado->id) ? $pacienteActualizado->lugar_de_residencia : '')));
$ocupacionActual = strtolower(trim($_POST['ocupacion'] ?? (!empty($pacienteActualizado->id) ? $pacienteActualizado->ocupacion : '')));
$apoyoActual = strtolower(trim($_POST['apoyo'] ?? (!empty($pacienteActualizado->id) ? $pacienteActualizado->apoyo : '')));
$afiliacionActual = strtolower(trim($_POST['afiliacion'] ?? (!empty($pacienteActualizado->id) ? $pacienteActualizado->afiliacion : '')));
$tiempoActual = trim($_POST['tiempo_enfermedad'] ?? (!empty($pacienteActualizado->id) ? $pacienteActualizado->tiempo_enfermedad : ''));
$telefonoActual = htmlspecialchars($_POST['telefono'] ?? $usuario->telefono ?? (!empty($pacienteActualizado->id) ? $pacienteActualizado->telefono : ''));
?>

<main class="min-h-screen pt-24 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-slate-50 via-teal-50/20 to-slate-50 dark:from-slate-900 dark:via-slate-850 dark:to-slate-900 transition-colors">
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- ==========================================
             1. CABECERA & ACCIÓN DE RETORNO
             ========================================== -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200/80 dark:border-slate-800 pb-5">
            <div class="flex items-center gap-3">
                <a href="/public" class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition shadow-xs" title="Volver al inicio">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $estaActualizado ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800' : 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800' ?>">
                            <span class="w-2 h-2 rounded-full <?= $estaActualizado ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse' ?>"></span>
                            <?= $estaActualizado ? 'Perfil Completo y Activo' : 'Perfil Pendiente por Completar' ?>
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">
                        Mi Perfil de Paciente
                    </h1>
                </div>
            </div>

            <!-- Accesos rápidos -->
            <div class="flex items-center gap-2">
                <a href="/public/misCitas" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-750 transition shadow-xs">
                    <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Mis Citas
                </a>
                <a href="/public" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-teal-700 dark:text-teal-300 bg-teal-50 dark:bg-teal-950/50 border border-teal-200 dark:border-teal-800 hover:bg-teal-100 transition shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Inicio
                </a>
            </div>
        </div>

        <!-- ==========================================
             2. ALERTAS (ÉXITO O ERRORES)
             ========================================== -->
        <?php if (intval($resultado ?? 0) === 1): ?>
            <div class="flex items-center p-4 text-emerald-800 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-600 bg-emerald-100 rounded-xl dark:bg-emerald-900 dark:text-emerald-200 mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium">
                    ¡Perfil actualizado exitosamente! Los cambios en tu información personal y foto han sido guardados.
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($errores)): ?>
            <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 space-y-2 shadow-sm" role="alert">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <svg class="w-5 h-5 text-rose-600 dark:text-rose-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Por favor verifica los siguientes campos antes de continuar:
                </div>
                <ul class="list-disc list-inside text-xs pl-2 space-y-1">
                    <?php foreach ($errores as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- ==========================================
             3. TARJETA HERO: IDENTIFICACIÓN & AVATAR
             ========================================== -->
        <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-6 sm:p-8 shadow-xs">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">

                <!-- Avatar con preview dinámico -->
                <div class="flex flex-col items-center sm:items-start shrink-0">
                    <div class="relative group">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-750 border-4 border-white dark:border-slate-700 shadow-md">
                            <img id="avatarPreviewImg" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" src="<?= $imagenUsuario ?>" alt="Foto de perfil de <?= htmlspecialchars($usuario->nombre) ?>">
                        </div>

                        <!-- Botón para disparar input de archivo -->
                        <label for="inputFotoPerfil" class="absolute -bottom-2 -right-2 w-10 h-10 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white flex items-center justify-center cursor-pointer shadow-md transition-transform hover:scale-110 active:scale-95 border-2 border-white dark:border-slate-800" title="Subir foto de perfil (Opcional)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </label>
                    </div>
                    <span class="text-[11px] font-medium text-slate-400 dark:text-slate-400 mt-2 text-center">Foto de perfil (opcional)</span>
                </div>

                <!-- Datos principales del paciente -->
                <div class="flex-1 text-center sm:text-left space-y-2">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                            <?= htmlspecialchars($usuario->nombre) ?>
                        </h2>
                        <?php if ($esDiabetes): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Diabetes
                            </span>
                        <?php elseif ($esColostomia): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                Colostomía
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-750 dark:text-slate-300">
                                <?= htmlspecialchars($usuario->enfermedad ?? 'General') ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                        <?= htmlspecialchars($usuario->email) ?>
                    </p>

                    <!-- Chips de datos demográficos rápidos -->
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 pt-2">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-slate-100 dark:bg-slate-750 text-slate-700 dark:text-slate-300">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span><?= $edadCalculada !== null ? "{$edadCalculada} años" : 'Edad no calculada' ?></span>
                        </div>

                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-slate-100 dark:bg-slate-750 text-slate-700 dark:text-slate-300">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Sexo: <?= ucfirst(htmlspecialchars($usuario->sexo ?? 'No registrado')) ?></span>
                        </div>

                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-slate-100 dark:bg-slate-750 text-slate-700 dark:text-slate-300">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span><?= !empty($telefonoActual) ? $telefonoActual : 'Sin teléfono' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================================
             4. FORMULARIO COMPLETO DE PERFIL
             ========================================== -->
        <form enctype="multipart/form-data" method="POST" id="formPerfilPaciente" class="space-y-6">
            <input type="hidden" name="imagenPrevia" value="<?= htmlspecialchars($usuario->imagen ?? '') ?>">
            
            <!-- Input de archivo oculto activado por la cámara del avatar -->
            <input id="inputFotoPerfil" name="imagen" type="file" accept="image/jpeg,image/png,image/webp" class="hidden">

            <div id="avisoCambioFoto" class="hidden p-3 rounded-2xl bg-teal-50 dark:bg-teal-950/50 border border-teal-200 dark:border-teal-800 text-teal-800 dark:text-teal-300 text-xs flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Nueva foto seleccionada (se aplicará al guardar cambios)
                </span>
                <button type="button" id="btnCancelarFoto" class="font-bold underline hover:text-teal-950 dark:hover:text-white">Cancelar</button>
            </div>

            <!-- SECCIÓN A: Datos de Identificación Oficial -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-6 sm:p-8 shadow-xs space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <span class="w-7 h-7 rounded-lg bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center font-bold text-xs">1</span>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Datos de Identificación y Contacto</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                            <span>Nombre Completo</span>
                            <span class="text-[10px] text-slate-400 font-normal">Oficial (no editable)</span>
                        </label>
                        <div class="relative">
                            <input type="text" value="<?= htmlspecialchars($usuario->nombre) ?>" disabled class="w-full bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm rounded-xl p-2.5 cursor-not-allowed">
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Correo -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                            <span>Correo Electrónico</span>
                            <span class="text-[10px] text-slate-400 font-normal">Cuenta de acceso</span>
                        </label>
                        <div class="relative">
                            <input type="email" value="<?= htmlspecialchars($usuario->email) ?>" disabled class="w-full bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm rounded-xl p-2.5 cursor-not-allowed">
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Teléfono editable -->
                    <div>
                        <label for="inputTelefono" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Teléfono Celular de Contacto <span class="text-teal-600">*</span>
                        </label>
                        <div class="relative">
                            <input type="tel" id="inputTelefono" name="telefono" value="<?= $telefonoActual ?>" placeholder="Ej: 3101234567" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Condición / Enfermedad -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                            <span>Diagnóstico / Condición Clínica</span>
                            <span class="text-[10px] text-slate-400 font-normal">Oficial</span>
                        </label>
                        <input type="text" value="<?= htmlspecialchars($usuario->enfermedad ?? 'General') ?>" disabled class="w-full bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm rounded-xl p-2.5 cursor-not-allowed font-medium">
                    </div>
                </div>
            </div>

            <!-- SECCIÓN B: Información Sociodemográfica -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-6 sm:p-8 shadow-xs space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <span class="w-7 h-7 rounded-lg bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center font-bold text-xs">2</span>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Información Sociodemográfica</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Escolaridad -->
                    <div>
                        <label for="selectEscolaridad" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Nivel de Escolaridad <span class="text-teal-600">*</span>
                        </label>
                        <select id="selectEscolaridad" name="escolaridad" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <option value="">Selecciona tu escolaridad</option>
                            <option value="ninguna" <?= $escolaridadActual === 'ninguna' ? 'selected' : '' ?>>Ninguna</option>
                            <option value="primaria" <?= $escolaridadActual === 'primaria' ? 'selected' : '' ?>>Primaria</option>
                            <option value="bachillerato" <?= $escolaridadActual === 'bachillerato' ? 'selected' : '' ?>>Bachillerato</option>
                            <option value="tecnico" <?= $escolaridadActual === 'tecnico' ? 'selected' : '' ?>>Técnico / Tecnólogo</option>
                            <option value="pregrado" <?= $escolaridadActual === 'pregrado' ? 'selected' : '' ?>>Pregrado / Universitario</option>
                            <option value="postgrado" <?= $escolaridadActual === 'postgrado' ? 'selected' : '' ?>>Postgrado / Especialización</option>
                        </select>
                    </div>

                    <!-- Estrato -->
                    <div>
                        <label for="selectEstrato" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Estrato Socioeconómico <span class="text-teal-600">*</span>
                        </label>
                        <select id="selectEstrato" name="estrato_socioeconomico" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <option value="">Selecciona tu estrato</option>
                            <option value="1" <?= $estratoActual === '1' ? 'selected' : '' ?>>Estrato 1 (Bajo - Bajo)</option>
                            <option value="2" <?= $estratoActual === '2' ? 'selected' : '' ?>>Estrato 2 (Bajo)</option>
                            <option value="3" <?= $estratoActual === '3' ? 'selected' : '' ?>>Estrato 3 (Medio - Bajo)</option>
                            <option value="4" <?= $estratoActual === '4' ? 'selected' : '' ?>>Estrato 4 (Medio)</option>
                            <option value="5" <?= $estratoActual === '5' ? 'selected' : '' ?>>Estrato 5 (Medio - Alto)</option>
                            <option value="6" <?= $estratoActual === '6' ? 'selected' : '' ?>>Estrato 6 (Alto)</option>
                        </select>
                    </div>

                    <!-- Lugar de residencia -->
                    <div>
                        <label for="selectResidencia" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Lugar de Residencia <span class="text-teal-600">*</span>
                        </label>
                        <select id="selectResidencia" name="lugar_de_residencia" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <option value="">Selecciona zona de residencia</option>
                            <option value="urbana" <?= $residenciaActual === 'urbana' ? 'selected' : '' ?>>Zona Urbana (Ciudad / Casco Urbano)</option>
                            <option value="rural" <?= $residenciaActual === 'rural' ? 'selected' : '' ?>>Zona Rural (Campo / Vereda)</option>
                        </select>
                    </div>

                    <!-- Ocupación -->
                    <div>
                        <label for="selectOcupacion" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Ocupación Principal <span class="text-teal-600">*</span>
                        </label>
                        <select id="selectOcupacion" name="ocupacion" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <option value="">Selecciona tu ocupación</option>
                            <option value="hogar" <?= $ocupacionActual === 'hogar' ? 'selected' : '' ?>>Labores del Hogar / Ama de casa</option>
                            <option value="empleado" <?= $ocupacionActual === 'empleado' ? 'selected' : '' ?>>Empleado(a) / Dependiente</option>
                            <option value="independiente" <?= $ocupacionActual === 'independiente' ? 'selected' : '' ?>>Trabajador(a) Independiente</option>
                            <option value="pensionado" <?= $ocupacionActual === 'pensionado' ? 'selected' : '' ?>>Pensionado(a) / Jubilado(a)</option>
                            <option value="agricultor" <?= $ocupacionActual === 'agricultor' ? 'selected' : '' ?>>Agricultor(a) / Campo</option>
                            <option value="estudiante" <?= $ocupacionActual === 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
                            <option value="otro" <?= $ocupacionActual === 'otro' ? 'selected' : '' ?>>Otra ocupación</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN C: Red de Apoyo y Afiliación en Salud -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-6 sm:p-8 shadow-xs space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <span class="w-7 h-7 rounded-lg bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center font-bold text-xs">3</span>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Acompañamiento y Sistema de Salud</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Red de apoyo -->
                    <div>
                        <label for="selectApoyo" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Principal Red de Apoyo <span class="text-teal-600">*</span>
                        </label>
                        <select id="selectApoyo" name="apoyo" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <option value="">¿Quién te apoya?</option>
                            <option value="conyuge" <?= $apoyoActual === 'conyuge' ? 'selected' : '' ?>>Cónyuge / Pareja</option>
                            <option value="hijo" <?= $apoyoActual === 'hijo' ? 'selected' : '' ?>>Hijo(a)</option>
                            <option value="padres" <?= $apoyoActual === 'padres' ? 'selected' : '' ?>>Padre o Madre</option>
                            <option value="familiar" <?= $apoyoActual === 'familiar' ? 'selected' : '' ?>>Otro Familiar</option>
                            <option value="amigo" <?= ($apoyoActual === 'amigo' || $apoyoActual === 'amigos') ? 'selected' : '' ?>>Amigo(a) / Vecino</option>
                            <option value="otro" <?= ($apoyoActual === 'otro' || $apoyoActual === 'otros') ? 'selected' : '' ?>>Otro / Solo</option>
                        </select>
                    </div>

                    <!-- Afiliación -->
                    <div>
                        <label for="selectAfiliacion" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Régimen de Afiliación <span class="text-teal-600">*</span>
                        </label>
                        <select id="selectAfiliacion" name="afiliacion" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <option value="">Tipo de Afiliación</option>
                            <option value="subsidiado" <?= $afiliacionActual === 'subsidiado' ? 'selected' : '' ?>>Subsidiado (Sisbén)</option>
                            <option value="contributivo" <?= $afiliacionActual === 'contributivo' ? 'selected' : '' ?>>Contributivo (EPS)</option>
                            <option value="R.E" <?= ($afiliacionActual === 'r.e' || $afiliacionActual === 're') ? 'selected' : '' ?>>Régimen Especial</option>
                            <option value="particular" <?= $afiliacionActual === 'particular' ? 'selected' : '' ?>>Particular / Privado</option>
                            <option value="otros" <?= ($afiliacionActual === 'otros' || $afiliacionActual === 'otro') ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>

                    <!-- Tiempo con la condición -->
                    <div>
                        <label for="selectTiempo" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Tiempo con la Condición <span class="text-teal-600">*</span>
                        </label>
                        <select id="selectTiempo" name="tiempo_enfermedad" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <option value="">Tiempo de evolución</option>
                            <option value="<3 meses" <?= $tiempoActual === '<3 meses' ? 'selected' : '' ?>>Menor a 3 meses</option>
                            <option value="3-6 meses" <?= $tiempoActual === '3-6 meses' ? 'selected' : '' ?>>De 3 a 6 meses</option>
                            <option value="1-2 años" <?= $tiempoActual === '1-2 años' ? 'selected' : '' ?>>Entre 1 y 2 años</option>
                            <option value="3-5 años" <?= $tiempoActual === '3-5 años' ? 'selected' : '' ?>>Entre 3 y 5 años</option>
                            <option value=">5 años" <?= ($tiempoActual === '>5 años' || $tiempoActual === '5 años') ? 'selected' : '' ?>>Mayor a 5 años</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 5. BOTONES DE ACCIÓN
                 ========================================== -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-5 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="/public" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-700 dark:text-slate-300 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-650 transition">
                    Cancelar
                </a>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="submit" name="actualizar" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-2.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 transition shadow-md shadow-teal-500/20 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <?= $estaActualizado ? 'Guardar Cambios del Perfil' : 'Completar y Guardar Perfil' ?>
                    </button>
                </div>
            </div>
        </form>

    </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const inputFoto = document.getElementById("inputFotoPerfil");
    const previewImg = document.getElementById("avatarPreviewImg");
    const avisoFoto = document.getElementById("avisoCambioFoto");
    const btnCancelarFoto = document.getElementById("btnCancelarFoto");
    const fotoOriginalSrc = previewImg ? previewImg.src : "";

    if (inputFoto && previewImg) {
        inputFoto.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file) {
                // Validar tamaño máx 4MB
                if (file.size > 4 * 1024 * 1024) {
                    alert("La imagen seleccionada supera el límite de 4MB. Por favor elige una imagen más ligera.");
                    inputFoto.value = "";
                    return;
                }

                const reader = new FileReader();
                reader.onload = (event) => {
                    previewImg.src = event.target.result;
                    previewImg.classList.add("ring-4", "ring-teal-500", "transition-all");
                    if (avisoFoto) avisoFoto.classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (btnCancelarFoto) {
        btnCancelarFoto.addEventListener("click", () => {
            if (inputFoto) inputFoto.value = "";
            if (previewImg) {
                previewImg.src = fotoOriginalSrc;
                previewImg.classList.remove("ring-4", "ring-teal-500");
            }
            if (avisoFoto) avisoFoto.classList.add("hidden");
        });
    }
});
</script>