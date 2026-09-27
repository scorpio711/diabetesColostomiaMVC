<?php
// Datos de métricas pasados desde PaginasController::indexAdmin
$stats = $stats ?? [
    'usuarios' => 0,
    'pacientes' => 0,
    'profesionales' => 0,
    'investigaciones' => 0,
    'blogs' => 0,
    'servicios' => 0,
    'citas' => 0,
];
$nombreAdmin = $nombreAdmin ?? ($_SESSION['nombre'] ?? 'Administrador');
?>

<main class="min-h-screen bg-slate-50 dark:bg-slate-900 py-10 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto space-y-10">
        
        <!-- Header Principal del Dashboard -->
        <header class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80 dark:border-slate-700/80 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-emerald-500/10 dark:bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 mb-3 border border-emerald-200 dark:border-emerald-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        PANEL DE ADMINISTRACIÓN CLÍNICA
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Bienvenido, <span class="text-emerald-600 dark:text-emerald-400"><?= htmlspecialchars($nombreAdmin) ?></span>
                    </h1>
                    <p class="mt-2 text-slate-600 dark:text-slate-300 text-base max-w-2xl">
                        Supervisa, administra y gestiona los recursos del portal de Colostomía y Diabetes con total control de usuarios, citas, pacientes e investigaciones científicas.
                    </p>
                </div>

                <!-- Botones de Acción Rápida -->
                <div class="flex flex-wrap items-center gap-3">
                    <a href="/public" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-medium text-sm text-slate-700 dark:text-slate-200 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 border border-slate-200 dark:border-slate-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Ver Sitio Público
                    </a>
                    <a href="/public/logout" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-medium text-sm text-red-600 dark:text-red-400 bg-red-50 hover:bg-red-100 dark:bg-red-950/40 dark:hover:bg-red-900/60 border border-red-200 dark:border-red-900 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </header>

        <!-- Métricas Rápidas / KPIs -->
        <section aria-label="Indicadores Generales" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- KPI: Pacientes -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pacientes Clínicos</p>
                    <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1"><?= number_format($stats['pacientes'] ?? 0) ?></p>
                    <span class="inline-flex items-center text-xs font-medium text-emerald-600 dark:text-emerald-400 mt-2">
                        Expedientes registrados
                    </span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            <!-- KPI: Profesionales -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Profesionales de Salud</p>
                    <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1"><?= number_format($stats['profesionales'] ?? 0) ?></p>
                    <span class="inline-flex items-center text-xs font-medium text-teal-600 dark:text-teal-400 mt-2">
                        Médicos, Psicólogos, Abogados
                    </span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
            </div>

            <!-- KPI: Investigaciones -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Investigaciones</p>
                    <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1"><?= number_format($stats['investigaciones'] ?? 0) ?></p>
                    <span class="inline-flex items-center text-xs font-medium text-cyan-600 dark:text-cyan-400 mt-2">
                        Artículos científicos
                    </span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-cyan-100 dark:bg-cyan-950/60 text-cyan-600 dark:text-cyan-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>

            <!-- KPI: Citas Clínicas -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Citas Programadas</p>
                    <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1"><?= number_format($stats['citas'] ?? 0) ?></p>
                    <span class="inline-flex items-center text-xs font-medium text-amber-600 dark:text-amber-400 mt-2">
                        Atenciones agendadas
                    </span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </section>

        <!-- Cuadrícula de Módulos de Administración -->
        <section aria-label="Módulos de Gestión">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Módulos del Administrador</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Selecciona el módulo correspondiente para administrar los datos clínicos.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                <!-- 1. Investigaciones -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 p-6 flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                <?= $stats['investigaciones'] ?? 0 ?> Artículos
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            Investigaciones
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Crea, edita y publica artículos científicos sobre colostomía y diabetes para la comunidad médica.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/60">
                        <a href="/public/admin/investigaciones/administrar" 
                           class="inline-flex items-center justify-between w-full text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700">
                            Administrar Investigaciones
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 2. Usuarios del Sistema -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 p-6 flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                <?= $stats['usuarios'] ?? 0 ?> Cuentas
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            Usuarios
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Control de cuentas de acceso, confirmación de correo, roles de administración y credenciales.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/60">
                        <a href="/public/admin/usuarios/administrar" 
                           class="inline-flex items-center justify-between w-full text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700">
                            Administrar Usuarios
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 3. Pacientes -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 p-6 flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-purple-50 text-purple-700 dark:bg-purple-950/40 dark:text-purple-300 border border-purple-200 dark:border-purple-800">
                                Clínicos
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            Pacientes
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Expedientes de pacientes, condición clínica diagnosticada y seguimiento médico personalizado.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/60">
                        <a href="/public/admin/pacientes/administrar" 
                           class="inline-flex items-center justify-between w-full text-sm font-semibold text-purple-600 dark:text-purple-400 hover:text-purple-700">
                            Administrar Pacientes
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 4. Profesionales -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 p-6 flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-700 dark:bg-teal-950/40 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                                Especialistas
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                            Profesionales
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Gestión de especialistas médicos, enfermeros, psicólogos y asesores jurídicos del portal.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/60">
                        <a href="/public/admin/profesionales/administrar" 
                           class="inline-flex items-center justify-between w-full text-sm font-semibold text-teal-600 dark:text-teal-400 hover:text-teal-700">
                            Administrar Profesionales
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 5. Citas Clínicas -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 p-6 flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                Agenda
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            Citas Médicas
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Control de agenda médica, horarios de atención, citas confirmadas y solicitudes pendientes.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/60">
                        <a href="/public/admin/citas" 
                           class="inline-flex items-center justify-between w-full text-sm font-semibold text-amber-600 dark:text-amber-400 hover:text-amber-700">
                            Administrar Citas
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 6. Artículos y Blog -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 p-6 flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-300 border border-rose-200 dark:border-rose-800">
                                <?= $stats['blogs'] ?? 0 ?> Posts
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                            Blog y Artículos
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Publicación de contenido divulgativo, consejos prácticos y novedades médicas para los pacientes.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/60">
                        <a href="/public/admin/blog" 
                           class="inline-flex items-center justify-between w-full text-sm font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700">
                            Administrar Blog
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 7. Servicios Clínicos -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 p-6 flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 dark:bg-indigo-950/40 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                                Catálogo
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Servicios Clínicos
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Configuración de especialidades clínicas, asignación de profesionales y descripción de atenciones.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/60">
                        <a href="/public/admin/servicios/administrar" 
                           class="inline-flex items-center justify-between w-full text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700">
                            Administrar Servicios
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 8. Encuestas y Evaluaciones -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 p-6 flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                Diagnóstico
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            Encuestas Clínicas
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Habilitación de evaluaciones de salud, psicología y asesoría jurídica para pacientes.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/60 flex flex-wrap gap-2">
                        <a href="/public/admin/encuestaSalud" 
                           class="text-xs font-medium px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-emerald-100 hover:text-emerald-700 transition-colors">
                            Salud
                        </a>
                        <a href="/public/admin/encuestaPsicologia" 
                           class="text-xs font-medium px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-emerald-100 hover:text-emerald-700 transition-colors">
                            Psicología
                        </a>
                        <a href="/public/admin/encuestaJuridica" 
                           class="text-xs font-medium px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-emerald-100 hover:text-emerald-700 transition-colors">
                            Jurídica
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- Banner de Estado de Seguridad y Servidor -->
        <footer class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200/80 dark:border-slate-700/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 dark:text-slate-400">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span>Base de Datos Conectada &middot; Control de Acceso por Roles (RBAC) Activo</span>
            </div>
            <div>
                <span>Plataforma Médica Colostomía y Diabetes &copy; <?= date('Y') ?></span>
            </div>
        </footer>

    </div>
</main>