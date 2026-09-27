<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION["login"] ?? false;
$currentRoute = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CAREFULNESS - Colostomía y Diabetes</title>
    <link rel="stylesheet" href="/public/build/css/output.css" />
    <link rel="icon" href="/public/build/img/Logo CAREFULNESS.svg" type="image/svg+xml">

    <!-- Previene parpadeo (FOUC) del modo oscuro -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body
    class="bg-slate-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex flex-col pt-20 selection:bg-emerald-500 selection:text-white dark:selection:bg-emerald-400 dark:selection:text-gray-900 antialiased transition-colors duration-200">
    <header>
        <!-- BARRA DE NAVEGACIÓN PRINCIPAL (FROSTED GLASS OPTIMIZADO PARA IPAD Y TODAS LAS PANTALLAS) -->
        <nav id="main-navbar" class="fixed top-0 left-0 right-0 z-40 glass-nav shadow-sm transition-all duration-300">
            <div
                class="max-w-screen-xl flex flex-wrap lg:flex-nowrap items-center justify-between mx-auto px-4 py-2.5 sm:py-3 lg:py-2.5">

                <!-- LOGO Y MARCA -->
                <a href="/public" class="flex items-center gap-2 sm:gap-2.5 group focus:outline-none flex-shrink-0">
                    <img src="/public/build/img/Logo CAREFULNESS.svg"
                        class="h-7 sm:h-8 xl:h-9 w-auto transform group-hover:scale-105 transition-transform duration-200"
                        alt="CAREFULNESS Logo" />
                    <span
                        class="self-center text-base sm:text-lg xl:text-2xl font-black tracking-tight whitespace-nowrap text-transparent bg-clip-text bg-gradient-to-r from-teal-600 via-emerald-600 to-lime-600 dark:from-emerald-400 dark:via-teal-300 dark:to-lime-400">
                        CAREFULNESS
                    </span>
                </a>

                <!-- BOTONES DERECHA: DARK MODE + LOGIN/USUARIO + BOTÓN HAMBURGUESA -->
                <div class="flex items-center gap-1.5 sm:gap-2 lg:order-2 flex-shrink-0">
                    <!-- BOTÓN MODO OSCURO / CLARO -->
                    <button id="theme-toggle" type="button" aria-label="Cambiar tema claro u oscuro"
                        class="text-gray-500 dark:text-gray-400 hover:bg-black/5 dark:hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 rounded-xl text-sm p-1.5 sm:p-2 transition-all">
                        <!-- Icono Luna (visible en modo claro) -->
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <!-- Icono Sol (visible en modo oscuro) -->
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- USUARIO AUTENTICADO -->
                    <?php if ($auth): ?>
                        <div class="relative">
                            <button id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                                data-dropdown-placement="bottom-end"
                                class="flex items-center gap-1.5 sm:gap-2 p-1 rounded-full focus:ring-2 focus:ring-emerald-500/50 transition">
                                <div class="relative">
                                    <?php if (intval($_SESSION["actualizado"] ?? 0) === 1 && !empty($_SESSION["imagen"]) && file_exists(CARPETA_IMAGENES_USUARIOS . $_SESSION["imagen"])): ?>
                                        <img class="w-8 h-8 xl:w-9 xl:h-9 rounded-full object-cover border-2 border-emerald-500"
                                            src="/public/imagenesUsuarios/<?php echo htmlspecialchars($_SESSION["imagen"]) ?>"
                                            alt="Foto de perfil">
                                    <?php else: ?>
                                        <img class="w-8 h-8 xl:w-9 xl:h-9 rounded-full object-cover border-2 border-emerald-500"
                                            src="/public/build/img/avatar.webp" alt="Foto por defecto">
                                    <?php endif; ?>
                                    <span
                                        class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-white dark:border-gray-900 rounded-full"></span>
                                </div>
                                <span
                                    class="hidden 2xl:block text-xs font-semibold text-gray-700 dark:text-gray-300 max-w-[110px] truncate">
                                    <?php echo htmlspecialchars($_SESSION["nombre"] ?? "Mi Cuenta") ?>
                                </span>
                            </button>

                            <!-- DROPDOWN DEL USUARIO (CON FROSTED GLASS) -->
                            <div id="userDropdown"
                                class="z-50 hidden glass-panel divide-y divide-gray-100 dark:divide-gray-700/60 rounded-2xl shadow-2xl w-60 text-sm overflow-hidden">
                                <div
                                    class="px-4 py-3 bg-emerald-500/[0.04] dark:bg-emerald-400/[0.04] border-b border-gray-200/40 dark:border-gray-700/40 rounded-t-2xl">
                                    <p class="font-bold text-gray-900 dark:text-white truncate">
                                        <?php echo htmlspecialchars($_SESSION["nombre"] ?? "Usuario") ?>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                        <?php echo htmlspecialchars($_SESSION["email"] ?? "") ?>
                                    </p>
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 mt-2 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300">
                                        <?php echo htmlspecialchars($_SESSION["rol"] ?? "Usuario") ?>
                                    </span>
                                </div>

                                <ul class="py-2 text-gray-700 dark:text-gray-200">
                                    <?php
                                    $rol = $_SESSION["rol"] ?? "";
                                    $esProfesional = in_array($rol, ["abogado", "enfermero", "psicologo"]);
                                    $perfilUrl = $esProfesional ? "/public/perfil/profesionales" : "/public/perfil";
                                    ?>
                                    <li>
                                        <a href="<?php echo $perfilUrl; ?>"
                                            class="flex items-center gap-2.5 px-4 py-2 hover:bg-emerald-500/10 transition">
                                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Mi Perfil
                                        </a>
                                    </li>

                                    <li>
                                        <a href="/public/misCitas"
                                            class="flex items-center gap-2.5 px-4 py-2 hover:bg-emerald-500/10 transition">
                                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Mis Citas Médicas
                                        </a>
                                    </li>

                                    <?php if (!empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"])): ?>
                                        <li>
                                            <a href="/public/admin/index"
                                                class="flex items-center gap-2.5 px-4 py-2 text-indigo-600 dark:text-indigo-400 font-semibold hover:bg-indigo-500/10 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                Panel Administrativo
                                            </a>
                                        </li>
                                    <?php elseif ($rol === "abogado"): ?>
                                        <li>
                                            <a href="/public/admin/abogados"
                                                class="flex items-center gap-2.5 px-4 py-2 text-indigo-600 dark:text-indigo-400 font-semibold hover:bg-indigo-500/10 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                                </svg>
                                                Panel Jurídico
                                            </a>
                                        </li>
                                    <?php elseif ($rol === "psicologo"): ?>
                                        <li>
                                            <a href="/public/admin/psicologos"
                                                class="flex items-center gap-2.5 px-4 py-2 text-sky-600 dark:text-sky-400 font-semibold hover:bg-sky-500/10 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Panel Psicológico
                                            </a>
                                        </li>
                                    <?php elseif ($rol === "enfermero"): ?>
                                        <li>
                                            <a href="/public/admin/enfermeros"
                                                class="flex items-center gap-2.5 px-4 py-2 text-emerald-600 dark:text-emerald-400 font-semibold hover:bg-emerald-500/10 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                                </svg>
                                                Panel Clínico
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>

                                <div class="py-1">
                                    <a href="/public/logout"
                                        class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-rose-600 dark:text-rose-400 hover:bg-rose-500/10 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Cerrar Sesión
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- ACCIONES VISITANTE (NO AUTENTICADO) -->
                        <div class="flex items-center gap-1 sm:gap-1.5 xl:gap-2">
                            <a href="/public/registro"
                                class="hidden xl:inline-flex items-center px-3 py-1.5 text-xs font-semibold text-gray-700 dark:text-gray-200 hover:bg-black/5 dark:hover:bg-white/10 border border-gray-300/80 dark:border-gray-700/80 rounded-xl transition">
                                Registrarse
                            </a>
                            <a href="/public/login"
                                class="inline-flex items-center justify-center px-2.5 sm:px-3.5 xl:px-4 py-1.5 sm:py-2 text-xs sm:text-xs xl:text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 rounded-xl shadow-sm hover:shadow transition transform hover:-translate-y-0.5 focus:ring-2 focus:ring-emerald-400">
                                Iniciar Sesión
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- BOTÓN HAMBURGUESA (MÓVILES Y TABLETS VERTICALES HASTA 1024px) -->
                    <button id="navbar-toggle-btn" type="button" aria-controls="navbar-main" aria-expanded="false"
                        class="inline-flex items-center justify-center p-1.5 sm:p-2 text-gray-600 dark:text-gray-300 rounded-xl lg:hidden hover:bg-black/5 dark:hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 transition">
                        <span class="sr-only">Abrir menú de navegación</span>
                        <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="close-menu-icon" class="hidden w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- CONTENIDO DEL MENÚ (RESPONSIVE: EN LÍNEA EN IPAD HORIZONTAL/DESKTOP, DESPLEGABLE EN MOBILE/IPAD VERTICAL) -->
                <div class="hidden w-full lg:flex lg:w-auto lg:order-1 items-center transition-all duration-300"
                    id="navbar-main">
                    <ul
                        class="flex flex-col lg:flex-row lg:items-center gap-1.5 lg:gap-1 xl:gap-1.5 2xl:gap-2 p-3 lg:py-1 lg:px-2 mt-3 lg:mt-0 font-medium rounded-2xl glass-nav-center transition-all">
                        <?php
                        $isHome = ($currentRoute === '/public' || $currentRoute === '/public/');
                        $isServicios = in_array($currentRoute, ['/public/medico', '/public/psicologico', '/public/juridico', '/public/encuestaSalud', '/public/encuestaPsicologia', '/public/encuestaJuridica']);
                        $isBlog = ($currentRoute === '/public/blog');
                        $isCitas = ($currentRoute === '/public/citas');
                        ?>

                        <!-- INICIO -->
                        <li>
                            <a href="/public"
                                class="nav-link block px-2.5 lg:px-2 xl:px-3 py-1.5 lg:py-1.5 xl:py-2 rounded-xl text-xs xl:text-sm font-semibold transition-all <?php echo $isHome ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 font-bold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-black/5 dark:hover:bg-white/5'; ?>">
                                Inicio
                            </a>
                        </li>

                        <!-- ESPECIALIDADES (DESPLEGABLE INTERACTIVO MÓVIL Y DESKTOP) -->
                        <li class="relative">
                            <button id="dropdownServiciosBtn" type="button" aria-expanded="false"
                                class="flex items-center justify-between w-full px-2.5 lg:px-2 xl:px-3 py-1.5 lg:py-1.5 xl:py-2 rounded-xl text-xs xl:text-sm font-semibold transition-all cursor-pointer <?php echo $isServicios ? 'text-emerald-600 dark:text-emerald-400 font-bold bg-emerald-500/10' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-black/5 dark:hover:bg-white/5'; ?>">
                                <span>Especialidades</span>
                                <svg id="dropdownServiciosArrow" class="w-3.5 h-3.5 ml-1 transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Menú Desplegable con Frosted Glass (Adaptable a columna en móvil y flotante en desktop) -->
                            <div id="dropdownServicios"
                                class="z-50 hidden glass-panel divide-y divide-gray-100 dark:divide-gray-700/60 rounded-2xl shadow-2xl w-full lg:w-72 overflow-hidden lg:absolute lg:top-full lg:left-0 mt-1.5 transition-all">
                                <div class="p-2 space-y-1">
                                    <a href="/public/medico"
                                        class="nav-sublink flex items-center gap-3 p-2.5 rounded-xl hover:bg-emerald-500/10 group transition">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p
                                                class="text-xs font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400">
                                                Área Médica & Ostomías</p>
                                            <p class="text-[11px] text-gray-500 dark:text-gray-400">Cuidado periestomal
                                                y glucosa</p>
                                        </div>
                                    </a>

                                    <a href="/public/psicologico"
                                        class="nav-sublink flex items-center gap-3 p-2.5 rounded-xl hover:bg-sky-500/10 group transition">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-sky-500/15 text-sky-600 dark:text-sky-400 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p
                                                class="text-xs font-bold text-gray-900 dark:text-white group-hover:text-sky-600 dark:group-hover:text-sky-400">
                                                Salud Psicológica</p>
                                            <p class="text-[11px] text-gray-500 dark:text-gray-400">Resiliencia y apoyo
                                                emocional</p>
                                        </div>
                                    </a>

                                    <a href="/public/juridico"
                                        class="nav-sublink flex items-center gap-3 p-2.5 rounded-xl hover:bg-indigo-500/10 group transition">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p
                                                class="text-xs font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                                Defensa Jurídica</p>
                                            <p class="text-[11px] text-gray-500 dark:text-gray-400">Tutelas de insumos y
                                                salud</p>
                                        </div>
                                    </a>
                                </div>

                                <div
                                    class="p-2.5 bg-emerald-500/[0.04] dark:bg-emerald-400/[0.04] border-t border-gray-200/40 dark:border-gray-700/40">
                                    <p
                                        class="px-2 py-1 text-[10px] font-extrabold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Evaluaciones Diagnósticas</p>
                                    <div class="grid grid-cols-3 gap-1 px-0.5 pt-1">
                                        <a href="/public/encuestaSalud"
                                            class="nav-sublink px-2 py-1.5 text-center text-[11px] font-semibold text-emerald-700 dark:text-emerald-300 hover:bg-emerald-500/15 rounded-lg transition">Médica</a>
                                        <a href="/public/encuestaPsicologia"
                                            class="nav-sublink px-2 py-1.5 text-center text-[11px] font-semibold text-sky-700 dark:text-sky-300 hover:bg-sky-500/15 rounded-lg transition">Emocional</a>
                                        <a href="/public/encuestaJuridica"
                                            class="nav-sublink px-2 py-1.5 text-center text-[11px] font-semibold text-indigo-700 dark:text-indigo-300 hover:bg-indigo-500/15 rounded-lg transition">Jurídica</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- AGENDAR CITA (CON ACCESO DIRECTO SI HAY SESIÓN O AVISO AMABLE SI ES VISITANTE) -->
                        <li>
                            <?php if ($auth): ?>
                                <a href="/public/citas"
                                    class="nav-link inline-flex items-center gap-1.5 px-2.5 lg:px-2 xl:px-3 py-1.5 lg:py-1.5 xl:py-2 rounded-xl text-xs xl:text-sm font-semibold transition-all <?php echo $isCitas ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 font-bold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-black/5 dark:hover:bg-white/5'; ?>">
                                    <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Citas</span>
                                </a>
                            <?php else: ?>
                                <button type="button" id="btn-citas-unauthenticated"
                                    class="inline-flex items-center justify-between lg:justify-start gap-1.5 w-full lg:w-auto px-2.5 lg:px-2 xl:px-3 py-1.5 lg:py-1.5 xl:py-2 rounded-xl text-xs xl:text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-black/5 dark:hover:bg-white/5 transition-all cursor-pointer">
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Citas</span>
                                    </span>
                                    <span class="lg:hidden text-[10px] font-bold px-1.5 py-0.5 rounded bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">Requiere Registro</span>
                                </button>
                            <?php endif; ?>
                        </li>

                        <!-- BLOG -->
                        <li>
                            <a href="/public/blog"
                                class="nav-link block px-2.5 lg:px-2 xl:px-3 py-1.5 lg:py-1.5 xl:py-2 rounded-xl text-xs xl:text-sm font-semibold transition-all <?php echo $isBlog ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 font-bold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-black/5 dark:hover:bg-white/5'; ?>">
                                Blog
                            </a>
                        </li>

                        <!-- ACCIONES MÓVILES EXTRAS (SOLO VISIBLE CUANDO NO ESTÁ AUTENTICADO EN PANTALLAS PEQUEÑAS) -->
                        <?php if (!$auth): ?>
                            <li
                                class="lg:hidden pt-2 border-t border-gray-200/60 dark:border-gray-700/60 flex flex-col gap-2">
                                <a href="/public/login"
                                    class="nav-link w-full py-2.5 text-center text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl shadow-sm">
                                    Iniciar Sesión
                                </a>
                                <a href="/public/registro"
                                    class="nav-link w-full py-2 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-xl hover:bg-black/5 dark:hover:bg-white/5">
                                    Crear Cuenta de Paciente
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- CONTENIDO PRINCIPAL DE LA VISTA -->
    <div class="flex-grow">
        <?php echo $contenido; ?>
    </div>

    <!-- FOOTER MODERNO Y LIMPIO -->
    <footer
        class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-16 transition-colors duration-200">
        <div class="w-full max-w-screen-xl mx-auto px-4 py-8 md:py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Columna Marca -->
                <div class="md:col-span-2 space-y-3">
                    <a href="/public" class="flex items-center gap-3">
                        <img src="/public/build/img/Logo CAREFULNESS.svg" class="h-10 w-auto" alt="CAREFULNESS Logo" />
                        <span
                            class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-600 dark:from-emerald-400 dark:to-lime-400">
                            CAREFULNESS
                        </span>
                    </a>
                    <p class="text-sm text-gray-600 dark:text-gray-400 max-w-sm leading-relaxed">
                        Plataforma interdisciplinaria de salud dedicada al apoyo integral de pacientes con colostomía y
                        diabetes mediante atención médica, bienestar psicológico y defensa jurídica.
                    </p>
                </div>

                <!-- Columna Enlaces de Interés -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-900 dark:text-white mb-3">
                        Especialidades</h3>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li><a href="/public/medico"
                                class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Cuidado Médico &
                                Estoma</a></li>
                        <li><a href="/public/psicologico"
                                class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Salud
                                Emocional</a></li>
                        <li><a href="/public/juridico"
                                class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Derecho a la
                                Salud</a></li>
                        <li><a href="/public/citas"
                                class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Agendar
                                Valoración</a></li>
                    </ul>
                </div>

                <!-- Columna Comunidad y Legal -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-900 dark:text-white mb-3">Comunidad
                        & Soporte</h3>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li><a href="/public/blog"
                                class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Blog & Guías</a>
                        </li>
                        <li><a href="/public/investigaciones"
                                class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Investigaciones</a>
                        </li>
                        <li><a href="/public/contacto"
                                class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Contacto y
                                Ayuda</a></li>
                        <li><a href="/public/registro"
                                class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Crear Cuenta</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-6 border-gray-200 dark:border-gray-800" />

            <div
                class="flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 dark:text-gray-400 gap-4">
                <span>© <?php echo date('Y'); ?> CAREFULNESS. Todos los derechos reservados.</span>
                <div class="flex gap-6">
                    <a href="/public/contacto" class="hover:underline">Privacidad</a>
                    <a href="/public/contacto" class="hover:underline">Términos de Servicio</a>
                    <a href="/public/contacto" class="hover:underline">Soporte al Paciente</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- LIBRERÍAS Y SCRIPTS GLOBALES -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>

    <!-- Chat Bot Widget Seguro -->
    <!-- <script type="text/javascript">
        (function (d, t) {
            var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
            v.onload = function () {
                if (window.voiceflow && window.voiceflow.chat) {
                    window.voiceflow.chat.load({
                        verify: { projectID: '665f3fa423cdafbec1181793' },
                        url: 'https://general-runtime.voiceflow.com',
                        versionID: 'production'
                    });
                }
            };
            v.src = "https://cdn.voiceflow.com/widget/bundle.mjs";
            v.type = "text/javascript";
            s.parentNode.insertBefore(v, s);
        })(document, 'script');
    </script> -->

    <!-- Ocultamiento Seguro de Loader -->
    <script>
        function hideLoader() {
            var loader = document.getElementById("loader");
            if (loader) {
                loader.style.display = "none";
            }
        }
        if (document.readyState === "complete" || document.readyState === "interactive") {
            hideLoader();
        } else {
            document.addEventListener("DOMContentLoaded", hideLoader);
            window.addEventListener("load", hideLoader);
        }
        setTimeout(hideLoader, 500);
    </script>

    <!-- Manejador de Dark Mode y Navbar Interactivo -->
    <script>
        (function () {
            // Sincronización de tema Dark / Light
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            function syncIcons() {
                const isDark = document.documentElement.classList.contains('dark');
                if (darkIcon && lightIcon) {
                    if (isDark) {
                        lightIcon.classList.remove('hidden');
                        darkIcon.classList.add('hidden');
                    } else {
                        darkIcon.classList.remove('hidden');
                        lightIcon.classList.add('hidden');
                    }
                }
            }

            syncIcons();

            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function () {
                    const html = document.documentElement;
                    if (html.classList.contains('dark')) {
                        html.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        html.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                    syncIcons();
                });
            }

            // Manejador del Menú Móvil / Tablet Vertical
            const toggleBtn = document.getElementById('navbar-toggle-btn');
            const navMenu = document.getElementById('navbar-main');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeMenuIcon = document.getElementById('close-menu-icon');

            if (toggleBtn && navMenu) {
                function setMenuState(open) {
                    if (open) {
                        navMenu.classList.remove('hidden');
                        if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
                        if (closeMenuIcon) closeMenuIcon.classList.remove('hidden');
                        toggleBtn.setAttribute('aria-expanded', 'true');
                    } else {
                        navMenu.classList.add('hidden');
                        if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                        if (closeMenuIcon) closeMenuIcon.classList.add('hidden');
                        toggleBtn.setAttribute('aria-expanded', 'false');
                    }
                }

                toggleBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
                    setMenuState(!isExpanded);
                });

                // Auto-cerrar al hacer clic SOLO en enlaces <a> del menú en mobile / tablet vertical
                const navLinks = navMenu.querySelectorAll('a.nav-link, a.nav-sublink');
                navLinks.forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (window.innerWidth < 1024) {
                            setMenuState(false);
                        }
                    });
                });

                // Cerrar al hacer clic afuera
                document.addEventListener('click', function (e) {
                    if (window.innerWidth < 1024 && !navMenu.contains(e.target) && !toggleBtn.contains(e.target)) {
                        setMenuState(false);
                    }
                });
            }

            // Manejador del menú de Especialidades (Móvil y Escritorio)
            const serviciosBtn = document.getElementById('dropdownServiciosBtn');
            const serviciosDropdown = document.getElementById('dropdownServicios');
            const serviciosArrow = document.getElementById('dropdownServiciosArrow');

            if (serviciosBtn && serviciosDropdown) {
                serviciosBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isHidden = serviciosDropdown.classList.contains('hidden');
                    if (isHidden) {
                        serviciosDropdown.classList.remove('hidden');
                        if (serviciosArrow) serviciosArrow.classList.add('rotate-180');
                        serviciosBtn.setAttribute('aria-expanded', 'true');
                    } else {
                        serviciosDropdown.classList.add('hidden');
                        if (serviciosArrow) serviciosArrow.classList.remove('rotate-180');
                        serviciosBtn.setAttribute('aria-expanded', 'false');
                    }
                });

                // Cerrar dropdown de Especialidades al hacer clic afuera
                document.addEventListener('click', function (e) {
                    if (!serviciosBtn.contains(e.target) && !serviciosDropdown.contains(e.target)) {
                        serviciosDropdown.classList.add('hidden');
                        if (serviciosArrow) serviciosArrow.classList.remove('rotate-180');
                        serviciosBtn.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Aviso para usuarios no autenticados al hacer clic en Citas
            const btnCitasGuest = document.getElementById('btn-citas-unauthenticated');
            if (btnCitasGuest) {
                btnCitasGuest.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: '📅 Agendamiento de Citas',
                            html: `
                                <div class="space-y-3 pt-2 text-center">
                                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mx-auto text-2xl">
                                        🩺
                                    </div>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                        ¡Nos encantaría atenderte!
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed max-w-sm mx-auto">
                                        Para poder agendar y gestionar citas con nuestros especialistas (médicos, psicólogos o abogados), es necesario que tengas una cuenta en la plataforma.
                                    </p>
                                    <div class="pt-3 flex flex-col sm:flex-row gap-2.5 justify-center">
                                        <a href="/public/registro" class="inline-flex items-center justify-center px-4 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                                            Crear Cuenta Gratis
                                        </a>
                                        <a href="/public/login" class="inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition">
                                            Iniciar Sesión
                                        </a>
                                    </div>
                                </div>
                            `,
                            showConfirmButton: false,
                            showCloseButton: true,
                            background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                            color: document.documentElement.classList.contains('dark') ? '#f8fafc' : '#0f172a'
                        });
                    } else {
                        if (confirm('Para agendar una cita necesitas una cuenta. ¿Deseas ir al registro?')) {
                            window.location.href = '/public/registro';
                        }
                    }
                });
            }

            // Efecto de sombra al hacer scroll
            const mainNavbar = document.getElementById('main-navbar');
            if (mainNavbar) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 20) {
                        mainNavbar.classList.add('shadow-md');
                    } else {
                        mainNavbar.classList.remove('shadow-md');
                    }
                }, { passive: true });
            }
        })();
    </script>

    <!-- Animaciones GSAP -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/MotionPathPlugin.min.js"></script>

    <!-- Excel Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <?php
    $esAdminReal = !empty($_SESSION['admin']) || !empty($_SESSION['admin_real']);
    if ($esAdminReal && file_exists(__DIR__ . "/admin/quick-toolbar.php")) {
        include __DIR__ . "/admin/quick-toolbar.php";
    }
    ?>

    <!-- Script específico inyectado por las vistas -->
    <?php echo $script ?? ''; ?>
</body>

</html>