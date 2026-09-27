<?php
// Precomputar edad
$edadCalculada = null;
$fechaNacFormateada = "No registrada";
if (!empty($usuario->fecha_nacimiento) && $usuario->fecha_nacimiento !== '0000-00-00' && $usuario->fecha_nacimiento !== '0') {
    try {
        $nac = new DateTime($usuario->fecha_nacimiento);
        $hoy = new DateTime();
        $edadCalculada = $nac->diff($hoy)->y;
        $fechaNacFormateada = $nac->format('d/m/Y');
    } catch (\Throwable $e) {
        $edadCalculada = null;
        $fechaNacFormateada = "No registrada";
    }
}

// Imagen del profesional
$imagenUsuario = "/public/build/img/avatar.webp";
if (!empty($usuario->imagen) && file_exists(CARPETA_IMAGENES_USUARIOS . $usuario->imagen)) {
    $imagenUsuario = "/public/imagenesUsuarios/" . htmlspecialchars($usuario->imagen);
} elseif (!empty($_SESSION["imagen"]) && file_exists(CARPETA_IMAGENES_USUARIOS . $_SESSION["imagen"])) {
    $imagenUsuario = "/public/imagenesUsuarios/" . htmlspecialchars($_SESSION["imagen"]);
}

// Rol y configuración visual
$rol = strtolower(trim($_SESSION["rol"] ?? $usuario->rol ?? 'profesional'));
$esAbogado = $rol === 'abogado';
$esEnfermero = $rol === 'enfermero';
$esPsicologo = $rol === 'psicologo';

$tituloRol = 'Especialista Asistencial';
$iconoRol = '🩺';
if ($esAbogado) {
    $tituloRol = 'Abogado(a) Especialista';
    $iconoRol = '⚖️';
} elseif ($esEnfermero) {
    $tituloRol = 'Profesional de Enfermería';
    $iconoRol = '🩺';
} elseif ($esPsicologo) {
    $tituloRol = 'Psicólogo(a) Especialista';
    $iconoRol = '🧠';
}

$estaActualizado = intval($usuario->actualizado ?? 0) === 1;

// Prioridad a $_POST para que no se borre lo que el profesional escribió si hay error de validación
$nombreActual = htmlspecialchars($_POST['nombre'] ?? $profesional->nombre ?? $usuario->nombre ?? '');
$telefonoActual = htmlspecialchars($_POST['telefono'] ?? $profesional->telefono ?? $usuario->telefono ?? '');
$especializacionActual = strtolower(trim($_POST['especializacion'] ?? $profesional->especializacion ?? ''));
$descripcionActual = htmlspecialchars($_POST['descripcion'] ?? $profesional->descripcion ?? '');
?>

<main class="min-h-screen pt-24 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-slate-50 via-teal-50/20 to-slate-50 dark:from-slate-900 dark:via-slate-850 dark:to-slate-900 transition-colors">
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- ==========================================
             1. CABECERA & ACCIÓN DE RETORNO
             ========================================== -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200/80 dark:border-slate-800 pb-5">
            <div class="flex items-center gap-3">
                <a href="/public/admin/index" class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition shadow-xs" title="Volver al panel administrativo">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $estaActualizado ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800' : 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800' ?>">
                            <span class="w-2 h-2 rounded-full <?= $estaActualizado ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse' ?>"></span>
                            <?= $estaActualizado ? 'Perfil Profesional Activo' : 'Perfil Pendiente por Completar' ?>
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">
                        Mi Perfil Profesional
                    </h1>
                </div>
            </div>

            <!-- Accesos rápidos -->
            <div class="flex items-center gap-2">
                <a href="#horario" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 hover:bg-emerald-100 transition shadow-xs">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Disponibilidad Semanal ↓
                </a>
                <a href="/public" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-750 transition shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Portal
                </a>
            </div>
        </div>

        <!-- ==========================================
             2. ALERTAS (ÉXITO O ERRORES)
             ========================================== -->
        <?php if ($resultado === 'perfil_ok' || intval($resultado) === 3): ?>
            <div class="flex items-center p-4 text-emerald-800 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-600 bg-emerald-100 rounded-xl dark:bg-emerald-900 dark:text-emerald-200 mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium">
                    ¡Perfil profesional actualizado exitosamente! Los cambios en tu información de contacto, especialidad y foto han sido guardados.
                </div>
            </div>
        <?php elseif (intval($resultado) === 1): ?>
            <div class="flex items-center p-4 text-emerald-800 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-600 bg-emerald-100 rounded-xl dark:bg-emerald-900 dark:text-emerald-200 mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414 1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium">
                    ¡Tu horario y disponibilidad semanal han sido guardados y sincronizados correctamente!
                </div>
            </div>
        <?php elseif (intval($resultado) === 2): ?>
            <div class="flex items-center p-4 text-blue-800 rounded-2xl bg-blue-50 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200 dark:border-blue-800 shadow-sm animate-fade-in" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-600 bg-blue-100 rounded-xl dark:bg-blue-900 dark:text-blue-200 mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium">
                    Se han desactivado todos los días de atención. Tu cuenta queda temporalmente sin horarios disponibles.
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

                <!-- Datos principales del profesional -->
                <div class="flex-1 text-center sm:text-left space-y-2">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                            <?= htmlspecialchars($usuario->nombre) ?>
                        </h2>
                        <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                            <span><?= $iconoRol ?></span>
                            <?= $tituloRol ?>
                        </span>
                        <?php if (!empty($profesional->especializacion) && $profesional->especializacion !== 'General'): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-750 dark:text-slate-300">
                                <?= ucwords(str_replace('_', ' ', htmlspecialchars($profesional->especializacion))) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                        <?= htmlspecialchars($usuario->email) ?>
                    </p>

                    <!-- Chips de datos demográficos y de contacto -->
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
                            <span><?= !empty($telefonoActual) ? $telefonoActual : 'Sin teléfono registrado' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================================
             4. FORMULARIO COMPLETO DE PERFIL PROFESIONAL
             ========================================== -->
        <form enctype="multipart/form-data" method="POST" id="formPerfilProfesional" class="space-y-6">
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

            <!-- SECCIÓN A: Datos de Identificación y Contacto -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-6 sm:p-8 shadow-xs space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <span class="w-7 h-7 rounded-lg bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center font-bold text-xs">1</span>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Datos de Identificación y Contacto</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div>
                        <label for="inputNombre" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                            <span>Nombre Profesional de Atención</span>
                            <span class="text-teal-600">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="inputNombre" name="nombre" value="<?= $nombreActual ?>" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
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
                            <input type="tel" id="inputTelefono" name="telefono" value="<?= $telefonoActual ?>" placeholder="Ej: 3101234567" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-655 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Fecha de Nacimiento Oficial -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                            <span>Fecha de Nacimiento</span>
                            <span class="text-[10px] text-slate-400 font-normal">Oficial (no editable)</span>
                        </label>
                        <div class="relative">
                            <input type="text" value="<?= $fechaNacFormateada ?>" disabled class="w-full bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm rounded-xl p-2.5 cursor-not-allowed">
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN B: Especialidad y Perfil Profesional -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-6 sm:p-8 shadow-xs space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <span class="w-7 h-7 rounded-lg bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center font-bold text-xs">2</span>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Especialidad y Perfil Profesional</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Rol / Profesión Oficial -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                            <span>Profesión / Rol Asignado</span>
                            <span class="text-[10px] text-slate-400 font-normal">Oficial</span>
                        </label>
                        <div class="relative">
                            <input type="text" value="<?= $tituloRol ?>" disabled class="w-full bg-slate-50 dark:bg-slate-750 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm rounded-xl p-2.5 cursor-not-allowed font-medium">
                            <span class="absolute right-3 top-2.5 text-base"><?= $iconoRol ?></span>
                        </div>
                    </div>

                    <!-- Especialización -->
                    <div>
                        <label for="selectEspecializacion" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Área de Especialización <span class="text-teal-600">*</span>
                        </label>

                        <?php if ($esAbogado): ?>
                            <select id="selectEspecializacion" name="especializacion" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                                <option value="">Escoge una especialización</option>
                                <option value="civil" <?= $especializacionActual === 'civil' ? 'selected' : '' ?>>Derecho Civil</option>
                                <option value="penal" <?= $especializacionActual === 'penal' ? 'selected' : '' ?>>Derecho Penal</option>
                                <option value="laboral" <?= $especializacionActual === 'laboral' ? 'selected' : '' ?>>Derecho Laboral</option>
                                <option value="comercial" <?= $especializacionActual === 'comercial' ? 'selected' : '' ?>>Derecho Comercial</option>
                                <option value="constitucional" <?= $especializacionActual === 'constitucional' ? 'selected' : '' ?>>Derecho Constitucional</option>
                                <option value="administrativo" <?= $especializacionActual === 'administrativo' ? 'selected' : '' ?>>Derecho Administrativo</option>
                                <option value="ambiental" <?= $especializacionActual === 'ambiental' ? 'selected' : '' ?>>Derecho Ambiental</option>
                                <option value="internacional" <?= $especializacionActual === 'internacional' ? 'selected' : '' ?>>Derecho Internacional</option>
                                <option value="tributario" <?= $especializacionActual === 'tributario' ? 'selected' : '' ?>>Derecho Tributario</option>
                                <option value="familia" <?= $especializacionActual === 'familia' ? 'selected' : '' ?>>Derecho de Familia</option>
                                <option value="propiedad_intelectual" <?= $especializacionActual === 'propiedad_intelectual' ? 'selected' : '' ?>>Derecho de Propiedad Intelectual</option>
                            </select>
                        <?php elseif ($esEnfermero): ?>
                            <select id="selectEspecializacion" name="especializacion" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                                <option value="">Escoge una especialización</option>
                                <option value="cuidados_criticos" <?= $especializacionActual === 'cuidados_criticos' ? 'selected' : '' ?>>Cuidados críticos</option>
                                <option value="pediatrica" <?= $especializacionActual === 'pediatrica' ? 'selected' : '' ?>>Pediátrica</option>
                                <option value="geriatrica" <?= $especializacionActual === 'geriatrica' ? 'selected' : '' ?>>Geriátrica</option>
                                <option value="salud_mental" <?= $especializacionActual === 'salud_mental' ? 'selected' : '' ?>>Salud mental</option>
                                <option value="oncologica" <?= $especializacionActual === 'oncologica' ? 'selected' : '' ?>>Oncológica</option>
                                <option value="salud_comunitaria" <?= $especializacionActual === 'salud_comunitaria' ? 'selected' : '' ?>>Salud comunitaria</option>
                                <option value="obstetrica_ginecologica" <?= $especializacionActual === 'obstetrica_ginecologica' ? 'selected' : '' ?>>Obstétrica y ginecológica</option>
                                <option value="emergencias" <?= $especializacionActual === 'emergencias' ? 'selected' : '' ?>>Emergencias</option>
                                <option value="anestesia" <?= $especializacionActual === 'anestesia' ? 'selected' : '' ?>>Anestesia</option>
                                <option value="nefrologica" <?= $especializacionActual === 'nefrologica' ? 'selected' : '' ?>>Nefrológica</option>
                                <option value="cardiovascular" <?= $especializacionActual === 'cardiovascular' ? 'selected' : '' ?>>Cardiovascular</option>
                                <option value="rehabilitacion" <?= $especializacionActual === 'rehabilitacion' ? 'selected' : '' ?>>Rehabilitación</option>
                                <option value="cuidados_paliativos" <?= $especializacionActual === 'cuidados_paliativos' ? 'selected' : '' ?>>Cuidados paliativos</option>
                                <option value="investigacion_clinica" <?= $especializacionActual === 'investigacion_clinica' ? 'selected' : '' ?>>Investigación clínica</option>
                                <option value="gestion_administracion_salud" <?= $especializacionActual === 'gestion_administracion_salud' ? 'selected' : '' ?>>Gestión y administración de salud</option>
                                <option value="quirurgica" <?= $especializacionActual === 'quirurgica' ? 'selected' : '' ?>>Quirúrgica</option>
                                <option value="trasplantes" <?= $especializacionActual === 'trasplantes' ? 'selected' : '' ?>>Trasplantes</option>
                                <option value="salud_ocupacional" <?= $especializacionActual === 'salud_ocupacional' ? 'selected' : '' ?>>Salud ocupacional</option>
                                <option value="forense" <?= $especializacionActual === 'forense' ? 'selected' : '' ?>>Forense</option>
                                <option value="cuidados_domiciliarios" <?= $especializacionActual === 'cuidados_domiciliarios' ? 'selected' : '' ?>>Cuidados domiciliarios</option>
                            </select>
                        <?php elseif ($esPsicologo): ?>
                            <select id="selectEspecializacion" name="especializacion" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                                <option value="">Escoge una especialización</option>
                                <option value="clinica" <?= $especializacionActual === 'clinica' ? 'selected' : '' ?>>Clínica</option>
                                <option value="educativa" <?= $especializacionActual === 'educativa' ? 'selected' : '' ?>>Educativa</option>
                                <option value="organizacional" <?= $especializacionActual === 'organizacional' ? 'selected' : '' ?>>Organizacional</option>
                                <option value="deporte" <?= $especializacionActual === 'deporte' ? 'selected' : '' ?>>Deporte</option>
                                <option value="social" <?= $especializacionActual === 'social' ? 'selected' : '' ?>>Social</option>
                                <option value="juridica" <?= $especializacionActual === 'juridica' ? 'selected' : '' ?>>Jurídica</option>
                                <option value="neuropsicologia" <?= $especializacionActual === 'neuropsicologia' ? 'selected' : '' ?>>Neuropsicología</option>
                                <option value="psicoterapia" <?= $especializacionActual === 'psicoterapia' ? 'selected' : '' ?>>Psicoterapia</option>
                                <option value="infantil" <?= $especializacionActual === 'infantil' ? 'selected' : '' ?>>Infantil</option>
                                <option value="adolescente" <?= $especializacionActual === 'adolescente' ? 'selected' : '' ?>>Adolescente</option>
                                <option value="forense" <?= $especializacionActual === 'forense' ? 'selected' : '' ?>>Forense</option>
                                <option value="emergencias" <?= $especializacionActual === 'emergencias' ? 'selected' : '' ?>>Emergencias</option>
                                <option value="salud_mental" <?= $especializacionActual === 'salud_mental' ? 'selected' : '' ?>>Salud Mental</option>
                                <option value="gerontologia" <?= $especializacionActual === 'gerontologia' ? 'selected' : '' ?>>Gerontología</option>
                                <option value="violencia_familiar" <?= $especializacionActual === 'violencia_familiar' ? 'selected' : '' ?>>Violencia Familiar</option>
                                <option value="adicciones" <?= $especializacionActual === 'adicciones' ? 'selected' : '' ?>>Adicciones</option>
                                <option value="sexologia" <?= $especializacionActual === 'sexologia' ? 'selected' : '' ?>>Sexología</option>
                                <option value="psicologia_experimental" <?= $especializacionActual === 'psicologia_experimental' ? 'selected' : '' ?>>Psicología Experimental</option>
                                <option value="psicologia_ambiental" <?= $especializacionActual === 'psicologia_ambiental' ? 'selected' : '' ?>>Psicología Ambiental</option>
                            </select>
                        <?php else: ?>
                            <input type="text" id="selectEspecializacion" name="especializacion" value="<?= $especializacionActual ?>" placeholder="Ej: Especialista Clínico" required class="w-full bg-white dark:bg-slate-750 border border-slate-300 dark:border-slate-650 text-slate-800 dark:text-white text-sm rounded-xl p-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                        <?php endif; ?>
                    </div>

                    <!-- Descripción Profesional -->
                    <div class="sm:col-span-2">
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="textareaDescripcion" class="block text-xs font-semibold text-slate-700 dark:text-slate-300">
                                Descripción de tu Perfil y Experiencia <span class="text-teal-600">*</span>
                            </label>
                            <span id="contadorCaracteres" class="text-[11px] font-semibold text-slate-400">
                                <span id="longitudActual">0</span> / 500 caracteres (mínimo 50)
                            </span>
                        </div>
                        <textarea id="textareaDescripcion" name="descripcion" rows="4" minlength="50" maxlength="500" required placeholder="Describe tu formación, enfoque profesional y experiencia asistencial para que los pacientes te conozcan mejor..." class="block p-3 w-full text-sm text-slate-800 dark:text-white bg-white dark:bg-slate-750 rounded-2xl border border-slate-300 dark:border-slate-650 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition leading-relaxed"><?= $descripcionActual ?></textarea>
                        <p class="text-[11px] text-slate-400 dark:text-slate-400 mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Esta reseña aparecerá visible a los pacientes al agendar citas contigo.
                        </p>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 5. BOTONES DE ACCIÓN DEL PERFIL
                 ========================================== -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-5 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="#horario" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-700 dark:text-slate-300 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-650 transition">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Ir a Horarios de Atención
                </a>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="submit" name="actualizar" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-2.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 transition shadow-md shadow-teal-500/20 active:scale-95 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Guardar Cambios del Perfil
                    </button>
                </div>
            </div>
        </form>

    </div>
</main>

<!-- ==========================================
     6. GESTIÓN DE HORARIOS Y DISPONIBILIDAD SEMANAL
     ========================================== -->
<?php
$diasSemanales = [
    'monday'    => ['nombre' => 'Lunes', 'corto' => 'Lun'],
    'tuesday'   => ['nombre' => 'Martes', 'corto' => 'Mar'],
    'wednesday' => ['nombre' => 'Miércoles', 'corto' => 'Mié'],
    'thursday'  => ['nombre' => 'Jueves', 'corto' => 'Jue'],
    'friday'    => ['nombre' => 'Viernes', 'corto' => 'Vie'],
    'saturday'  => ['nombre' => 'Sábado', 'corto' => 'Sáb'],
    'sunday'    => ['nombre' => 'Domingo', 'corto' => 'Dom'],
];
?>
<section id="horario" class="py-10 scroll-mt-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <form method="POST" class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 shadow-xs border border-slate-200/80 dark:border-slate-700/80 transition-all">
            <!-- Header Card -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-100 dark:border-slate-700/60">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-100 dark:border-emerald-800 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h2 class="text-xl sm:text-2xl font-black text-slate-800 dark:text-slate-100 tracking-tight">Disponibilidad y Horarios</h2>
                            <span id="badge-contador" class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                <span id="num-dias-activos">0</span> días activos
                            </span>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Configura los días y rangos en los que atenderás citas. Los turnos de 1 hora se generan automáticamente para los pacientes dentro del rango definido.</p>
                    </div>
                </div>

                <button type="submit" name="guardarHorario" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm rounded-xl shadow-md shadow-emerald-600/20 transition active:scale-95 shrink-0 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar Horario
                </button>
            </div>

            <!-- Toolbar de Ajustes Rápidos -->
            <div class="mt-6 p-4 rounded-2xl bg-slate-50 dark:bg-slate-750 border border-slate-200/70 dark:border-slate-700/60 flex flex-wrap items-center justify-between gap-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-400 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"/></svg>
                    Plantillas rápidas:
                </span>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" id="btn-preset-oficina" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600 transition shadow-xs cursor-pointer">
                        Lun-Vie (08:00 - 17:00)
                    </button>
                    <button type="button" id="btn-preset-manana" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600 transition shadow-xs cursor-pointer">
                        Mañanas (08:00 - 12:00)
                    </button>
                    <button type="button" id="btn-preset-tarde" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600 transition shadow-xs cursor-pointer">
                        Tardes (13:00 - 18:00)
                    </button>
                    <button type="button" id="btn-preset-todos" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 transition cursor-pointer">
                        Todos
                    </button>
                    <button type="button" id="btn-preset-ninguno" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800 hover:bg-rose-100 dark:hover:bg-rose-900/60 transition cursor-pointer">
                        Limpiar Todo
                    </button>
                </div>
            </div>

            <!-- Lista de Días -->
            <div class="mt-6 space-y-3">
                <?php foreach ($diasSemanales as $key => $info):
                    $activo = in_array($key, $diasCheck ?? []);
                    $inicio = isset($horarios_por_dia[$key]->start_time) ? substr($horarios_por_dia[$key]->start_time, 0, 5) : '08:00';
                    $fin = isset($horarios_por_dia[$key]->end_time) ? substr($horarios_por_dia[$key]->end_time, 0, 5) : '17:00';
                ?>
                    <div class="day-card group p-4 sm:p-5 rounded-2xl border transition-all duration-200 <?php echo $activo ? 'bg-emerald-50/30 dark:bg-emerald-950/20 border-emerald-200 dark:border-emerald-800/80 shadow-xs' : 'bg-slate-50/50 dark:bg-slate-800/30 border-slate-200 dark:border-slate-700/60 opacity-75'; ?>" data-day="<?php echo $key; ?>">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <!-- Toggle y Nombre del Día -->
                            <div class="flex items-center gap-3 min-w-[180px]">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="days[]" value="<?php echo $key; ?>" id="day-<?php echo $key; ?>" class="sr-only peer day-checkbox" <?php echo $activo ? 'checked' : ''; ?>>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-600 peer-checked:bg-emerald-600"></div>
                                </label>
                                <div>
                                    <label for="day-<?php echo $key; ?>" class="font-bold text-slate-800 dark:text-slate-100 cursor-pointer block select-none">
                                        <?php echo $info['nombre']; ?>
                                    </label>
                                    <span class="day-status-pill text-[11px] font-semibold uppercase tracking-wider <?php echo $activo ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400 dark:text-slate-400'; ?>">
                                        <?php echo $activo ? '● Atiende este día' : '○ No disponible'; ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Selector de Horarios -->
                            <div class="flex items-center gap-2 flex-1 max-w-md time-inputs-container <?php echo $activo ? '' : 'pointer-events-none opacity-40'; ?>">
                                <div class="relative flex-1">
                                    <span class="absolute top-1 left-2.5 text-[10px] font-semibold text-slate-400 uppercase pointer-events-none">Desde</span>
                                    <input type="time" name="start-time-<?php echo $key; ?>" id="start-time-<?php echo $key; ?>" value="<?php echo $inicio; ?>" min="06:00" max="22:00" step="1800"
                                        class="time-input-start w-full pt-4 pb-1 px-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-slate-100 font-semibold text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                                </div>
                                <span class="text-slate-400 font-bold px-1">→</span>
                                <div class="relative flex-1">
                                    <span class="absolute top-1 left-2.5 text-[10px] font-semibold text-slate-400 uppercase pointer-events-none">Hasta</span>
                                    <input type="time" name="end-time-<?php echo $key; ?>" id="end-time-<?php echo $key; ?>" value="<?php echo $fin; ?>" min="06:00" max="22:00" step="1800"
                                        class="time-input-end w-full pt-4 pb-1 px-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-slate-100 font-semibold text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                                </div>
                            </div>

                            <!-- Badge de cálculo de horas -->
                            <div class="hidden md:flex items-center justify-end w-28 text-right">
                                <span class="hours-badge text-xs font-semibold px-2.5 py-1 rounded-lg <?php echo $activo ? 'bg-emerald-100/70 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300' : 'bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-400'; ?>">
                                    Calculando...
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Footer con Botón y Nota Informativa -->
            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700/60 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Las citas de pacientes se generarán en bloques de 1 hora según este rango.</span>
                </div>
                <button type="submit" name="guardarHorario" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 active:scale-95 text-white font-bold text-sm rounded-xl shadow-md shadow-emerald-600/30 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar y Sincronizar Horarios
                </button>
            </div>
        </form>
    </div>
</section>

<!-- ==========================================
     7. SCRIPTS CLIENTE: AVATAR PREVIEW + CONTADOR + HORARIOS
     ========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- A. Preview de Avatar & Validación en Cliente ---
    const inputFoto = document.getElementById("inputFotoPerfil");
    const previewImg = document.getElementById("avatarPreviewImg");
    const avisoFoto = document.getElementById("avisoCambioFoto");
    const btnCancelarFoto = document.getElementById("btnCancelarFoto");
    const fotoOriginalSrc = previewImg ? previewImg.src : "";

    if (inputFoto && previewImg) {
        inputFoto.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file) {
                // Validar máx 4MB
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

    // --- B. Contador en vivo de caracteres de la Descripción ---
    const txtDesc = document.getElementById("textareaDescripcion");
    const lenActual = document.getElementById("longitudActual");
    const contDesc = document.getElementById("contadorCaracteres");

    function actualizarContadorDesc() {
        if (!txtDesc || !lenActual) return;
        const total = txtDesc.value.trim().length;
        lenActual.innerText = total;

        if (total < 50) {
            contDesc.classList.remove("text-emerald-600", "dark:text-emerald-400", "text-rose-600");
            contDesc.classList.add("text-amber-600", "dark:text-amber-400");
        } else if (total > 500) {
            contDesc.classList.remove("text-amber-600", "dark:text-amber-400", "text-emerald-600");
            contDesc.classList.add("text-rose-600");
        } else {
            contDesc.classList.remove("text-amber-600", "dark:text-amber-400", "text-rose-600");
            contDesc.classList.add("text-emerald-600", "dark:text-emerald-400");
        }
    }

    if (txtDesc) {
        txtDesc.addEventListener("input", actualizarContadorDesc);
        actualizarContadorDesc();
    }

    // --- C. Horarios y Disponibilidad Semanal ---
    const dayCards = document.querySelectorAll('.day-card');
    const contadorSpan = document.getElementById('num-dias-activos');

    function calcularHoras(start, end) {
        if (!start || !end) return 0;
        const p1 = start.split(':').map(Number);
        const p2 = end.split(':').map(Number);
        const diff = (p2[0] * 60 + p2[1]) - (p1[0] * 60 + p1[1]);
        return diff > 0 ? (diff / 60) : 0;
    }

    function actualizarFila(card) {
        const checkbox = card.querySelector('.day-checkbox');
        const container = card.querySelector('.time-inputs-container');
        const pill = card.querySelector('.day-status-pill');
        const badge = card.querySelector('.hours-badge');
        const startInput = card.querySelector('.time-input-start');
        const endInput = card.querySelector('.time-input-end');

        if (checkbox.checked) {
            card.classList.remove('bg-slate-50/50', 'dark:bg-slate-800/30', 'border-slate-200', 'dark:border-slate-700/60', 'opacity-75');
            card.classList.add('bg-emerald-50/30', 'dark:bg-emerald-950/20', 'border-emerald-200', 'dark:border-emerald-800/80', 'shadow-xs');
            container.classList.remove('pointer-events-none', 'opacity-40');
            pill.innerHTML = '● Atiende este día';
            pill.className = 'day-status-pill text-[11px] font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400';

            const horas = calcularHoras(startInput.value, endInput.value);
            if (horas > 0) {
                badge.innerText = horas + (horas === 1 ? ' hora' : ' horas');
                badge.className = 'hours-badge text-xs font-semibold px-2.5 py-1 rounded-lg bg-emerald-100/70 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300';
            } else {
                badge.innerText = 'Inválido';
                badge.className = 'hours-badge text-xs font-semibold px-2.5 py-1 rounded-lg bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300';
            }
        } else {
            card.classList.remove('bg-emerald-50/30', 'dark:bg-emerald-950/20', 'border-emerald-200', 'dark:border-emerald-800/80', 'shadow-xs');
            card.classList.add('bg-slate-50/50', 'dark:bg-slate-800/30', 'border-slate-200', 'dark:border-slate-700/60', 'opacity-75');
            container.classList.add('pointer-events-none', 'opacity-40');
            pill.innerHTML = '○ No disponible';
            pill.className = 'day-status-pill text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-400';
            badge.innerText = 'Inactivo';
            badge.className = 'hours-badge text-xs font-semibold px-2.5 py-1 rounded-lg bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-400';
        }
    }

    function actualizarContador() {
        let activos = 0;
        dayCards.forEach(card => {
            const cb = card.querySelector('.day-checkbox');
            if (cb && cb.checked) activos++;
            actualizarFila(card);
        });
        if (contadorSpan) contadorSpan.innerText = activos;
    }

    dayCards.forEach(card => {
        const checkbox = card.querySelector('.day-checkbox');
        const startInput = card.querySelector('.time-input-start');
        const endInput = card.querySelector('.time-input-end');

        checkbox.addEventListener('change', actualizarContador);
        startInput.addEventListener('change', () => actualizarFila(card));
        endInput.addEventListener('change', () => actualizarFila(card));
    });

    function aplicarPreset(diasActivos, horaInicio, horaFin) {
        dayCards.forEach(card => {
            const day = card.dataset.day;
            const cb = card.querySelector('.day-checkbox');
            const startInput = card.querySelector('.time-input-start');
            const endInput = card.querySelector('.time-input-end');

            if (diasActivos.includes(day)) {
                cb.checked = true;
                if (horaInicio) startInput.value = horaInicio;
                if (horaFin) endInput.value = horaFin;
            } else {
                cb.checked = false;
            }
        });
        actualizarContador();
    }

    const btnOficina = document.getElementById('btn-preset-oficina');
    const btnManana = document.getElementById('btn-preset-manana');
    const btnTarde = document.getElementById('btn-preset-tarde');
    const btnTodos = document.getElementById('btn-preset-todos');
    const btnNinguno = document.getElementById('btn-preset-ninguno');

    if (btnOficina) {
        btnOficina.addEventListener('click', () => {
            aplicarPreset(['monday', 'tuesday', 'wednesday', 'thursday', 'friday'], '08:00', '17:00');
        });
    }
    if (btnManana) {
        btnManana.addEventListener('click', () => {
            aplicarPreset(['monday', 'tuesday', 'wednesday', 'thursday', 'friday'], '08:00', '12:00');
        });
    }
    if (btnTarde) {
        btnTarde.addEventListener('click', () => {
            aplicarPreset(['monday', 'tuesday', 'wednesday', 'thursday', 'friday'], '13:00', '18:00');
        });
    }
    if (btnTodos) {
        btnTodos.addEventListener('click', () => {
            aplicarPreset(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'], '08:00', '17:00');
        });
    }
    if (btnNinguno) {
        btnNinguno.addEventListener('click', () => {
            aplicarPreset([], null, null);
        });
    }

    actualizarContador();
});
</script>