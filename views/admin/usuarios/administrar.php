<main class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Header Principal de Gestión de Usuarios -->
        <header class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 dark:border-slate-700/80 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-indigo-500/10 dark:bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-950/60 dark:text-indigo-300 mb-3 border border-indigo-200 dark:border-indigo-800">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                        SEGURIDAD & ADMINISTRACIÓN DE CUENTAS
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Gestión de <span class="text-indigo-600 dark:text-indigo-400">Usuarios</span>
                    </h1>
                    <p class="mt-2 text-slate-600 dark:text-slate-300 text-sm sm:text-base max-w-2xl leading-relaxed">
                        Control centralizado de accesos, roles clínicos, estados de verificación y cuentas activas en la plataforma.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" id="btnExportarUsuarios"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm text-emerald-700 bg-emerald-100 hover:bg-emerald-200 dark:bg-emerald-950/60 dark:text-emerald-300 dark:hover:bg-emerald-900/60 border border-emerald-200 dark:border-emerald-800 transition-colors shadow-xs">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Exportar Excel / CSV
                    </button>
                    <button type="button" data-modal-target="createProductModal" data-modal-toggle="createProductModal"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition-all shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Añadir Usuario
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

        <!-- Alertas de Estado -->
        <?php if (intval($resultado) === 1): ?>
            <div class="flex items-center p-4 text-emerald-800 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 shadow-xs" role="alert">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm font-semibold">El usuario ha sido creado correctamente y se le ha enviado el correo de confirmación.</div>
            </div>
        <?php elseif (intval($resultado) === 2): ?>
            <div class="flex items-center p-4 text-teal-800 rounded-2xl bg-teal-50 dark:bg-teal-950/40 dark:text-teal-300 border border-teal-200 dark:border-teal-800 shadow-xs" role="alert">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm font-semibold">El perfil del usuario ha sido actualizado correctamente.</div>
            </div>
        <?php elseif (intval($resultado) === 3): ?>
            <div class="flex items-center p-4 text-blue-800 rounded-2xl bg-blue-50 dark:bg-blue-950/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800 shadow-xs" role="alert">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm font-semibold">La cuenta de usuario ha sido eliminada del sistema.</div>
            </div>
        <?php endif; ?>

        <!-- Métricas Rápidas (KPIs) -->
        <section aria-label="Estadísticas de Usuarios" class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Usuarios</span>
                    <p class="text-2xl font-black text-slate-900 dark:text-white"><?= intval($stats['total'] ?? count($usuarios)) ?></p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-100 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                    <span class="text-xl">🧑‍⚕️</span>
                </div>
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Profesionales</span>
                    <p class="text-2xl font-black text-teal-600 dark:text-teal-400"><?= intval($stats['profesionales'] ?? 0) ?></p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                    <span class="text-xl">🩺</span>
                </div>
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Pacientes</span>
                    <p class="text-2xl font-black text-emerald-600 dark:text-emerald-400"><?= intval($stats['pacientes'] ?? 0) ?></p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Verificados</span>
                    <p class="text-2xl font-black text-blue-600 dark:text-blue-400"><?= intval($stats['confirmados'] ?? 0) ?></p>
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
                <input type="text" id="buscadorUsuarios"
                    class="bg-slate-50 dark:bg-slate-700/60 border border-slate-200 dark:border-slate-600 text-slate-900 dark:text-white text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 p-2.5 transition-colors placeholder:text-slate-400"
                    placeholder="Buscar por nombre, email, rol o condición..." />
            </div>

            <!-- Botones de Filtro por Rol -->
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-1 hidden sm:inline">Rol:</span>
                <button type="button" class="filtro-usuario-btn active px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all bg-indigo-600 text-white shadow-xs" data-rol="todos">
                    Todos
                </button>
                <button type="button" class="filtro-usuario-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all" data-rol="paciente">
                    🩺 Pacientes
                </button>
                <button type="button" class="filtro-usuario-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all" data-rol="profesional">
                    🧑‍⚕️ Profesionales
                </button>
                <button type="button" class="filtro-usuario-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all" data-rol="admin">
                    🛡️ Admins
                </button>
            </div>

            <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                Mostrando <span id="conteoUsuarios" class="font-bold text-indigo-600 dark:text-indigo-400"><?= count($usuarios) ?></span> usuario(s)
            </div>
        </div>

        <!-- Tabla de Usuarios -->
        <section class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300" id="tablaUsuarios">
                    <thead class="text-xs uppercase tracking-wider bg-slate-100/80 dark:bg-slate-700/50 text-slate-700 dark:text-slate-200 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th scope="col" class="px-5 py-4">Usuario</th>
                            <th scope="col" class="px-5 py-4">Correo Electrónico</th>
                            <th scope="col" class="px-5 py-4">Rol en Plataforma</th>
                            <th scope="col" class="px-5 py-4">Condición</th>
                            <th scope="col" class="px-5 py-4 text-center">Verificación</th>
                            <th scope="col" class="px-5 py-4 text-center">Perfil</th>
                            <th scope="col" class="px-5 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                        <?php if (empty($usuarios)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                    No se encontraron cuentas de usuario registradas.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($usuarios as $usr): ?>
                                <?php
                                $r = strtolower(trim($usr->rol ?? ''));
                                $enf = strtolower(trim($usr->enfermedad ?? ''));
                                $esProf = ($r === 'abogado' || $r === 'enfermero' || $r === 'psicologo');
                                $esAdm = ($r === 'admin' || !empty($usr->admin));
                                $imgSrc = !empty($usr->imagen)
                                    ? "/public/imagenesUsuarios/" . htmlspecialchars($usr->imagen)
                                    : "https://ui-avatars.com/api/?name=" . urlencode($usr->nombre ?: 'Usuario') . "&background=6366F1&color=fff";
                                ?>
                                <tr class="usuario-fila hover:bg-slate-50/80 dark:hover:bg-slate-700/30 transition-colors"
                                    data-rol="<?= $esAdm ? 'admin' : ($esProf ? 'profesional' : ($r === 'paciente' ? 'paciente' : 'otro')) ?>"
                                    data-search="<?= htmlspecialchars(strtolower(($usr->nombre ?? '') . ' ' . ($usr->email ?? '') . ' ' . ($usr->rol ?? '') . ' ' . ($usr->enfermedad ?? '') . ' ' . ($usr->id ?? ''))) ?>">

                                    <!-- 1. Usuario (Avatar + Nombre + ID) -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($usr->nombre) ?>"
                                                 class="w-10 h-10 rounded-2xl object-cover border border-slate-200 dark:border-slate-700 flex-shrink-0" />
                                            <div>
                                                <div class="font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($usr->nombre) ?></div>
                                                <div class="text-xs text-slate-400">ID #<?= $usr->id ?> &middot; <?= htmlspecialchars($usr->sexo ?: 'N/D') ?></div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- 2. Correo -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="text-xs font-semibold text-slate-700 dark:text-slate-300"><?= htmlspecialchars($usr->email) ?></div>
                                        <div class="text-[11px] text-slate-400">
                                            <?= !empty($usr->fecha_nacimiento) ? 'Nac: ' . date("d/m/Y", strtotime($usr->fecha_nacimiento)) : 'Sin fecha' ?>
                                        </div>
                                    </td>

                                    <!-- 3. Rol en Plataforma -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <?php if ($esAdm): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800 dark:bg-purple-950/60 dark:text-purple-300 border border-purple-200 dark:border-purple-800">
                                                🛡️ Administrador
                                            </span>
                                        <?php elseif ($r === 'enfermero'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                                                🩺 Enfermería
                                            </span>
                                        <?php elseif ($r === 'psicologo'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                                🧠 Psicología
                                            </span>
                                        <?php elseif ($r === 'abogado'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800 dark:bg-indigo-950/60 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                                                ⚖️ Asesoría Jurídica
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                                👤 Paciente
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 4. Condición Médica -->
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <?php if ($enf === 'colostomia'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-50 text-teal-700 dark:bg-teal-950/40 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                                                Colostomía
                                            </span>
                                        <?php elseif ($enf === 'diabetes'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                                Diabetes
                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400">N/A</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 5. Estado de Verificación -->
                                    <td class="px-5 py-4 whitespace-nowrap text-center">
                                        <?php if (intval($usr->confirmado) === 1): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-300">
                                                ✓ Verificado
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-300">
                                                ⏳ Pendiente
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 6. Perfil -->
                                    <td class="px-5 py-4 whitespace-nowrap text-center">
                                        <?php if (intval($usr->actualizado) === 1): ?>
                                            <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">Completo</span>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400">Incompleto</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- 7. Acciones -->
                                    <td class="px-5 py-4 whitespace-nowrap text-right">
                                        <div class="inline-flex items-center gap-1">
                                            <button type="button" data-modal-target="updateProductModal<?= $usr->id ?>" data-modal-toggle="updateProductModal<?= $usr->id ?>"
                                                class="p-2 text-slate-500 hover:text-indigo-600 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-colors" title="Editar Usuario">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button type="button" data-modal-target="deleteModal<?= $usr->id ?>" data-modal-toggle="deleteModal<?= $usr->id ?>"
                                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-950/40 rounded-xl transition-colors" title="Eliminar Usuario">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </div>

    <!-- MODAL CREAR USUARIO -->
    <div id="createProductModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-slate-900/50 backdrop-blur-xs">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative p-6 bg-white rounded-3xl shadow-xl dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                <div class="flex justify-between items-center pb-4 mb-4 border-b border-slate-200 dark:border-slate-700">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Añadir Nuevo Usuario</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Registra un nuevo paciente o personal asistencial en la plataforma.</p>
                    </div>
                    <button type="button" class="text-slate-400 hover:text-slate-600 rounded-lg p-1.5"
                        data-modal-toggle="createProductModal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Correo Electrónico</label>
                            <input type="email" name="email" required
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                                placeholder="ejemplo@correo.com">
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Nombre Completo</label>
                            <input type="text" name="nombre" required
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                                placeholder="Nombre y Apellidos">
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Contraseña Inicial</label>
                            <input type="password" name="password" required
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                                placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Sexo</label>
                            <select name="sexo" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                <option value="">Selecciona sexo</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Condición / Diagnóstico</label>
                            <select name="enfermedad" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                <option value="">Ninguna / Personal</option>
                                <option value="colostomia">Colostomía</option>
                                <option value="diabetes">Diabetes</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700">
                        <button type="button" data-modal-toggle="createProductModal"
                            class="py-2.5 px-5 text-sm font-medium text-slate-700 bg-white rounded-xl border border-slate-300 hover:bg-slate-50 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600">
                            Cancelar
                        </button>
                        <button type="submit" name="crear"
                            class="text-white bg-indigo-600 hover:bg-indigo-700 font-semibold rounded-xl text-sm px-6 py-2.5 transition-all shadow-xs">
                            Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODALES DE EDICIÓN Y ELIMINACIÓN -->
    <?php foreach ($usuarios as $usr): ?>
        <!-- Modal Editar Usuario -->
        <div id="updateProductModal<?= $usr->id ?>" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-slate-900/50 backdrop-blur-xs">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <div class="relative p-6 bg-white rounded-3xl shadow-xl dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                    <div class="flex justify-between items-center pb-4 mb-4 border-b border-slate-200 dark:border-slate-700">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Editar Usuario</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Modifica los datos de la cuenta #<?= $usr->id ?>.</p>
                        </div>
                        <button type="button" class="text-slate-400 hover:text-slate-600 rounded-lg p-1.5"
                            data-modal-toggle="updateProductModal<?= $usr->id ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST" enctype="multipart/form-data" class="space-y-4">
                        <input type="hidden" name="usuario[id]" value="<?= $usr->id ?>">
                        <input type="hidden" name="imagenPrevia" value="<?= htmlspecialchars($usr->imagen ?? '') ?>">

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Correo Electrónico</label>
                                <input type="email" name="usuario[email]" value="<?= htmlspecialchars($usr->email) ?>" required
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Nombre Completo</label>
                                <input type="text" name="usuario[nombre]" value="<?= htmlspecialchars($usr->nombre) ?>" required
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Fecha de Nacimiento</label>
                                <input type="date" name="usuario[fecha_nacimiento]" value="<?= $usr->fecha_nacimiento ? date('Y-m-d', strtotime($usr->fecha_nacimiento)) : '' ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Nueva Contraseña (Opcional)</label>
                                <input type="password" name="usuario[password]"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                                    placeholder="Dejar en blanco para no cambiar">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Sexo</label>
                                <select name="usuario[sexo]" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                    <option value="">Selecciona sexo</option>
                                    <option value="masculino" <?= $usr->sexo === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="femenino" <?= $usr->sexo === 'femenino' ? 'selected' : '' ?>>Femenino</option>
                                    <option value="otro" <?= $usr->sexo === 'otro' ? 'selected' : '' ?>>Otro</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-semibold text-slate-700 dark:text-slate-300">Condición / Diagnóstico</label>
                                <select name="usuario[enfermedad]" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                    <option value="" <?= empty($usr->enfermedad) ? 'selected' : '' ?>>Ninguna / Personal</option>
                                    <option value="colostomia" <?= $usr->enfermedad === 'colostomia' ? 'selected' : '' ?>>Colostomía</option>
                                    <option value="diabetes" <?= $usr->enfermedad === 'diabetes' ? 'selected' : '' ?>>Diabetes</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-4 flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700">
                            <button type="button" data-modal-toggle="updateProductModal<?= $usr->id ?>"
                                class="py-2.5 px-5 text-sm font-medium text-slate-700 bg-white rounded-xl border border-slate-300 hover:bg-slate-50 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600">
                                Cancelar
                            </button>
                            <button type="submit" name="actualizar"
                                class="text-white bg-indigo-600 hover:bg-indigo-700 font-semibold rounded-xl text-sm px-6 py-2.5 transition-all shadow-xs">
                                Actualizar Datos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar Usuario -->
        <div id="deleteModal<?= $usr->id ?>" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-slate-900/50 backdrop-blur-xs">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative p-5 text-center bg-white rounded-2xl shadow-xl dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                    <button type="button" class="text-slate-400 absolute top-3 right-3 hover:text-slate-600" data-modal-toggle="deleteModal<?= $usr->id ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-950/60 text-red-600 dark:text-red-400 flex items-center justify-center mx-auto mb-3.5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <p class="mb-1 text-base font-bold text-slate-900 dark:text-white">¿Eliminar usuario?</p>
                    <p class="mb-4 text-xs text-slate-500 dark:text-slate-400">Se eliminará la cuenta de <strong><?= htmlspecialchars($usr->nombre) ?></strong> y su acceso al sistema.</p>
                    <div class="flex justify-center items-center gap-3">
                        <button data-modal-toggle="deleteModal<?= $usr->id ?>" type="button"
                            class="py-2.5 px-4 text-xs font-semibold text-slate-700 bg-white rounded-xl border border-slate-300 hover:bg-slate-100 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600">
                            Cancelar
                        </button>
                        <form method="POST" class="m-0">
                            <input type="hidden" name="id" value="<?= $usr->id ?>">
                            <button type="submit" name="borrar"
                                class="py-2.5 px-4 text-xs font-semibold text-center text-white bg-red-600 rounded-xl hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 shadow-xs">
                                Sí, eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<!-- Lógica de Búsqueda, Filtrado y Exportación de Usuarios -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputBuscador = document.getElementById('buscadorUsuarios');
    const filas = document.querySelectorAll('.usuario-fila');
    const conteo = document.getElementById('conteoUsuarios');
    const btnsFiltro = document.querySelectorAll('.filtro-usuario-btn');
    const btnExportar = document.getElementById('btnExportarUsuarios');

    let rolActual = 'todos';

    function filtrarTabla() {
        const query = (inputBuscador.value || '').toLowerCase().trim();
        let visibles = 0;

        filas.forEach(fila => {
            const dataSearch = fila.getAttribute('data-search') || '';
            const rolFila = fila.getAttribute('data-rol') || '';

            const coincideTexto = !query || dataSearch.includes(query);
            let coincideRol = (rolActual === 'todos') || (rolFila === rolActual);

            if (coincideTexto && coincideRol) {
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
                b.classList.remove('bg-indigo-600', 'text-white', 'shadow-xs');
                b.classList.add('text-slate-600', 'dark:text-slate-300', 'bg-slate-100', 'dark:bg-slate-700');
            });
            this.classList.remove('text-slate-600', 'dark:text-slate-300', 'bg-slate-100', 'dark:bg-slate-700');
            this.classList.add('bg-indigo-600', 'text-white', 'shadow-xs');

            rolActual = this.getAttribute('data-rol') || 'todos';
            filtrarTabla();
        });
    });

    // Exportación a Excel / CSV con UTF-8 BOM
    if (btnExportar) {
        btnExportar.addEventListener('click', function () {
            const datos = [
                ['ID', 'Nombre', 'Correo', 'Rol', 'Condición', 'Estado Verificación', 'Perfil']
            ];

            filas.forEach(fila => {
                if (fila.style.display !== 'none') {
                    const id = fila.querySelector('td:nth-child(1) .text-xs')?.textContent?.replace('ID #', '')?.split('·')[0]?.trim() || '';
                    const nombre = fila.querySelector('td:nth-child(1) .font-bold')?.textContent?.trim() || '';
                    const email = fila.querySelector('td:nth-child(2) div:nth-child(1)')?.textContent?.trim() || '';
                    const rol = fila.querySelector('td:nth-child(3) span')?.textContent?.trim() || '';
                    const cond = fila.querySelector('td:nth-child(4) span')?.textContent?.trim() || '';
                    const verif = fila.querySelector('td:nth-child(5) span')?.textContent?.trim() || '';
                    const perfil = fila.querySelector('td:nth-child(6) span')?.textContent?.trim() || '';

                    datos.push([id, nombre, email, rol, cond, verif, perfil]);
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
            a.download = `usuarios_${new Date().toISOString().slice(0, 10)}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        });
    }
});
</script>