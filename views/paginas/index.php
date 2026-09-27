<?php
// ALERTA 1: Toast interactivo de bienvenida para visitantes (No autenticados)
if (empty($_SESSION["login"])):
?>
    <div id="welcome-floating-toast" 
        class="fixed bottom-6 left-6 z-40 max-w-sm w-[calc(100%-3rem)] bg-white/95 dark:bg-gray-800/95 backdrop-blur-md rounded-2xl shadow-2xl border border-emerald-500/30 p-4 transform translate-y-24 opacity-0 transition-all duration-500 ease-out hidden"
        role="alert">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-600 text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-emerald-500/20">
                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <div class="flex-1 pr-1">
                <h4 class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-1.5">
                    ¡Bienvenido a CAREFULNESS!
                </h4>
                <p class="text-xs text-gray-600 dark:text-gray-300 mt-1 leading-relaxed">
                    Regístrate gratis para agendar valoraciones médicas, recibir orientación jurídica y acompañamiento psicológico.
                </p>
                <div class="flex items-center gap-2 mt-3">
                    <a href="/public/registro" 
                        class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-lg shadow-sm transition">
                        Crear Cuenta
                    </a>
                    <a href="/public/login" 
                        class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                        Iniciar Sesión
                    </a>
                </div>
            </div>
            <button id="dismiss-welcome-toast" type="button" aria-label="Cerrar aviso"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
<?php endif; ?>

<div class="container mx-auto px-4 py-4 md:py-8 relative">
    <?php
    // ALERTA 2: Smart Callout interactivo para pacientes con perfil incompleto
    if (!empty($_SESSION["login"]) && isset($_SESSION["actualizado"]) && intval($_SESSION["actualizado"]) === 0):
    ?>
        <div id="incomplete-profile-alert" class="mb-8 rounded-2xl bg-gradient-to-r from-amber-500/10 via-emerald-500/10 to-teal-500/10 dark:from-amber-950/40 dark:via-emerald-950/40 dark:to-teal-950/40 border border-amber-300 dark:border-amber-500/30 p-4 md:p-5 shadow-sm transition-all duration-300">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm md:text-base font-bold text-gray-900 dark:text-white">
                                Tu perfil de salud está incompleto
                            </h3>
                            <span class="px-2 py-0.5 text-[10px] font-extrabold uppercase rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900/60 dark:text-amber-300">
                                40% Completado
                            </span>
                        </div>
                        <p class="text-xs md:text-sm text-gray-600 dark:text-gray-300 mt-1 max-w-2xl leading-relaxed">
                            Completa tus datos clínicos y de contacto para que nuestros profesionales de enfermería, psicología y derecho puedan brindarte un seguimiento seguro y personalizado.
                        </p>
                        <div class="w-full max-w-md bg-gray-200 dark:bg-gray-700 h-2 rounded-full mt-2.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-500 to-emerald-500 h-full rounded-full transition-all duration-500" style="width: 40%"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 self-end sm:self-center flex-shrink-0">
                    <a href="/public/perfil" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-amber-500 to-emerald-600 hover:from-amber-600 hover:to-emerald-700 text-white text-xs md:text-sm font-bold rounded-xl shadow-sm transition transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Completar Perfil
                    </a>
                    <button id="dismiss-profile-alert" type="button" aria-label="Descartar por ahora"
                        class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 rounded-xl hover:bg-white/50 dark:hover:bg-gray-800/50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Hero Principal -->
    <?php
    $esAdmin = !empty($_SESSION["rol"]) && $_SESSION["rol"] == "admin";
    $estaAutenticado = !empty($_SESSION["login"]);
    $esFuncionarioVar = !empty($esFuncionario);
    if (!$estaAutenticado || $esFuncionarioVar || $esAdmin):
        ?>
        <section class="flex flex-col items-center relative py-6 md:py-12 text-center">
            <!-- Badge superior -->
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-xs font-semibold text-emerald-800 dark:text-emerald-300 mb-6 shadow-sm">
                <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Plataforma de Salud & Acompañamiento Integral
            </div>

            <div class="max-w-3xl mx-auto flex flex-col items-center">
                <p id="animacion1"
                    class="mb-3 font-semibold text-teal-800 dark:text-emerald-400 text-base sm:text-lg md:text-xl tracking-wide min-h-[1.75rem]">
                    Estamos orgullosos de presentarte una plataforma
                </p>

                <h1
                    class="text-gray-900 dark:text-white mb-6 text-3xl font-extrabold sm:text-5xl md:text-6xl tracking-tight leading-tight min-h-[4rem]">
                    <span id="animacion2" class="text-emerald-700 dark:text-emerald-400 font-extrabold">
                        Para personas con Diabetes y Ostomizados
                    </span>
                </h1>

                <p class="mb-8 max-w-2xl text-base md:text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                    "Uniendo fuerzas para vivir con pasión, autonomía y bienestar. Orientación médica, apoyo psicoemocional
                    y respaldo jurídico en un solo lugar seguro."
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 w-full max-w-md">
                    <a href="/public/registro" class="w-full sm:w-auto">
                        <button type="button"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-semibold rounded-xl text-base px-7 py-3.5 text-center shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all duration-200">
                            <span>Registrarme gratis</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </a>
                    <a href="/public/login" class="w-full sm:w-auto">
                        <button type="button"
                            class="w-full sm:w-auto inline-flex items-center justify-center text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-600 font-semibold rounded-xl text-base px-6 py-3.5 text-center shadow-sm hover:-translate-y-0.5 transition-all duration-200">
                            Iniciar Sesión
                        </button>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (isset($enfermedad) && $enfermedad == "colostomia"): ?>
        <section class="py-8 md:py-14">
            <div class="grid max-w-screen-xl px-4 mx-auto lg:gap-10 lg:grid-cols-12 items-center">
                <div class="mr-auto place-self-center lg:col-span-7 text-left">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 border border-emerald-300 dark:border-emerald-800 text-xs font-semibold text-emerald-800 dark:text-emerald-300 mb-4">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Cuidado Especializado • Ostomías
                    </div>
                    <h1
                        class="text-gray-900 dark:text-white mb-4 text-3xl font-extrabold sm:text-4xl md:text-5xl leading-tight">
                        <span id="animacion1" class="text-emerald-700 dark:text-emerald-400 font-extrabold">
                            ¡Bienvenido! Cuidemos juntos de tu Ostomía
                        </span>
                    </h1>
                    <p class="max-w-2xl mb-8 text-gray-600 dark:text-gray-300 text-base md:text-lg leading-relaxed">
                        Estamos a tu lado para acompañarte en el cuidado diario del estoma, la protección de la piel
                        periestomal, la nutrición adaptada y tu bienestar emocional con expertos en enfermería y salud.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="/public/colostomia"
                            class="inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-white rounded-xl bg-emerald-600 hover:bg-emerald-700 shadow-md shadow-emerald-600/20 hover:-translate-y-0.5 transition-all duration-200">
                            Mi Portal de Colostomía
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                        <a href="/public/contacto"
                            class="inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-gray-800 dark:text-white border border-gray-300 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 hover:-translate-y-0.5 transition-all duration-200">
                            Agendar Consulta
                        </a>
                    </div>
                </div>
                <div class="hidden lg:col-span-5 lg:flex justify-center relative">
                    <div class="relative group">
                        <img src="/public/build/img/lennox-chitando-QEHWkzcBaZQ-unsplash.jpg"
                            class="w-full h-auto max-w-sm rounded-3xl shadow-2xl border-4 border-white dark:border-gray-800 object-cover transform group-hover:scale-[1.02] transition duration-300"
                            alt="Cuidado de la salud">
                        <div
                            class="absolute -bottom-4 -left-4 bg-white dark:bg-gray-800 px-4 py-2.5 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 flex items-center gap-2">
                            <span class="text-xl">🩺</span>
                            <span class="text-xs font-bold text-gray-800 dark:text-gray-200">Enfermería y Guías
                                Clínicas</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (isset($enfermedad) && $enfermedad == "diabetes"): ?>
        <section class="py-8 md:py-14">
            <div class="grid max-w-screen-xl px-4 mx-auto lg:gap-10 lg:grid-cols-12 items-center">
                <div class="mr-auto place-self-center lg:col-span-7 text-left">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-100 dark:bg-teal-950 border border-teal-300 dark:border-teal-800 text-xs font-semibold text-teal-800 dark:text-teal-300 mb-4">
                        <span class="flex h-2 w-2 rounded-full bg-teal-500 animate-pulse"></span>
                        Control Integral • Diabetes
                    </div>
                    <h1
                        class="text-gray-900 dark:text-white mb-4 text-3xl font-extrabold sm:text-4xl md:text-5xl leading-tight">
                        <span id="animacion1" class="text-teal-700 dark:text-teal-400 font-extrabold">
                            ¡Bienvenido! Cuidemos juntos de tu Diabetes
                        </span>
                    </h1>
                    <p class="max-w-2xl mb-8 text-gray-600 dark:text-gray-300 text-base md:text-lg leading-relaxed">
                        Te acompañamos en tu monitoreo glucémico, prevención de complicaciones, hábitos alimenticios
                        saludables y soporte continuo para una vida plena y activa.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="/public/diabetes"
                            class="inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-white rounded-xl bg-teal-600 hover:bg-teal-700 shadow-md shadow-teal-600/20 hover:-translate-y-0.5 transition-all duration-200">
                            Mi Portal de Diabetes
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                        <a href="/public/contacto"
                            class="inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-gray-800 dark:text-white border border-gray-300 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 hover:-translate-y-0.5 transition-all duration-200">
                            Agendar Consulta
                        </a>
                    </div>
                </div>
                <div class="hidden lg:col-span-5 lg:flex justify-center relative">
                    <div class="relative group">
                        <img src="/public/build/img/lennox-chitando-QEHWkzcBaZQ-unsplash.jpg"
                            class="w-full h-auto max-w-sm rounded-3xl shadow-2xl border-4 border-white dark:border-gray-800 object-cover transform group-hover:scale-[1.02] transition duration-300"
                            alt="Control glucémico y salud">
                        <div
                            class="absolute -bottom-4 -left-4 bg-white dark:bg-gray-800 px-4 py-2.5 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 flex items-center gap-2">
                            <span class="text-xl">📊</span>
                            <span class="text-xs font-bold text-gray-800 dark:text-gray-200">Control Glucémico &
                                Nutrición</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Barra de Métricas y Confianza (Impacto) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 my-8 max-w-5xl mx-auto">
        <div
            class="stat-card p-4 md:p-5 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm text-center transform hover:-translate-y-1 transition duration-300">
            <span class="block text-2xl md:text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">+1,200</span>
            <span class="text-xs md:text-sm font-medium text-gray-600 dark:text-gray-400 mt-1 block">Pacientes
                Acompañados</span>
        </div>
        <div
            class="stat-card p-4 md:p-5 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm text-center transform hover:-translate-y-1 transition duration-300">
            <span class="block text-2xl md:text-3xl font-extrabold text-teal-600 dark:text-teal-400">3 Áreas</span>
            <span class="text-xs md:text-sm font-medium text-gray-600 dark:text-gray-400 mt-1 block">Médica, Psicológica
                y Legal</span>
        </div>
        <div
            class="stat-card p-4 md:p-5 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm text-center transform hover:-translate-y-1 transition duration-300">
            <span class="block text-2xl md:text-3xl font-extrabold text-blue-600 dark:text-blue-400">+50</span>
            <span class="text-xs md:text-sm font-medium text-gray-600 dark:text-gray-400 mt-1 block">Guías e
                Investigaciones</span>
        </div>
        <div
            class="stat-card p-4 md:p-5 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm text-center transform hover:-translate-y-1 transition duration-300">
            <span class="block text-2xl md:text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">100%</span>
            <span class="text-xs md:text-sm font-medium text-gray-600 dark:text-gray-400 mt-1 block">Confidencial y
                Guiado</span>
        </div>
    </div>

    <!-- Bento Grid de Servicios y Especialidades -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span
                    class="px-3.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    Áreas de Acompañamiento
                </span>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-3 mb-3">
                    Todo lo que necesitas para tu bienestar
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-base">
                    Un equipo interdisciplinario dedicado a resolver tus dudas, defender tus derechos y cuidar de tu
                    salud integral.
                </p>
            </div>

            <div class="grid gap-4 md:gap-5 grid-cols-1 md:grid-cols-6">
                <!-- Card 1: Sobre Nosotros -->
                <div
                    class="bento-card col-span-1 md:col-span-6 xl:col-span-3 overflow-hidden relative p-7 md:p-8 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 hover:-translate-y-1.5 transition-all duration-300 group">
                    <div class="grid sm:grid-cols-2 gap-6 items-center">
                        <div class="flex flex-col justify-between h-full space-y-6">
                            <div
                                class="relative size-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 flex items-center justify-center p-2 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                <img src="/public/build/img/sun-dynamic-premium.png" alt="Icono Sol"
                                    class="w-8 h-8 object-contain">
                            </div>
                            <div class="space-y-2">
                                <span
                                    class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Nuestra
                                    Misión</span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Sobre Nosotros</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    Promovemos una comunidad de apoyo integral para personas con diabetes y ostomías,
                                    facilitando herramientas clínicas, emocionales y de orientación jurídica.
                                </p>
                            </div>
                        </div>
                        <div
                            class="overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700 h-44 sm:h-full">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                src="/public/build/img/hands-1327811_1920.jpg" alt="Comunidad unida">
                        </div>
                    </div>
                </div>

                <!-- Card 2: Profesionales -->
                <a href="/public/contacto"
                    class="bento-card col-span-1 md:col-span-6 xl:col-span-3 overflow-hidden relative p-7 md:p-8 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col justify-between">
                    <div class="grid sm:grid-cols-2 gap-6 items-center">
                        <div class="flex flex-col justify-between h-full space-y-6">
                            <div
                                class="relative size-12 rounded-2xl bg-teal-50 dark:bg-teal-950 border border-teal-200 dark:border-teal-800 flex items-center justify-center p-2 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                <img src="/public/build/img/boy-dynamic-premium.png" alt="Icono Especialistas"
                                    class="w-8 h-8 object-contain">
                            </div>
                            <div class="space-y-2">
                                <span
                                    class="text-xs font-bold uppercase tracking-wider text-teal-600 dark:text-teal-400">Equipo
                                    Certificado</span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Nuestros Especialistas</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    Enfermeros expertos en estomas, psicólogos clínicos y abogados defensores del
                                    derecho a la salud listos para brindarte atención personalizada.
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center space-y-3 pt-4 sm:pt-0">
                            <div class="flex -space-x-3 rtl:space-x-reverse justify-center items-center">
                                <img class="size-14 rounded-full border-2 border-white dark:border-gray-800 object-cover shadow-sm group-hover:-translate-y-1 transition duration-200"
                                    src="/public/build/img/perfil1.jpg" alt="Profesional 1">
                                <img class="size-14 rounded-full border-2 border-white dark:border-gray-800 object-cover shadow-sm group-hover:-translate-y-1 transition duration-200 delay-75"
                                    src="/public/build/img/perfil2.jpg" alt="Profesional 2">
                                <img class="size-14 rounded-full border-2 border-white dark:border-gray-800 object-cover shadow-sm group-hover:-translate-y-1 transition duration-200 delay-150"
                                    src="/public/build/img/perfil3.jpg" alt="Profesional 3">
                                <img class="size-14 rounded-full border-2 border-white dark:border-gray-800 object-cover shadow-sm group-hover:-translate-y-1 transition duration-200 delay-200"
                                    src="/public/build/img/perfil4.jpg" alt="Profesional 4">
                            </div>
                            <span
                                class="inline-flex items-center text-xs font-bold text-emerald-600 dark:text-emerald-400 group-hover:gap-2 gap-1 transition-all">
                                Agendar consulta con un profesional
                                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Card 3: Ayuda Jurídica -->
                <a href="/public/juridico"
                    class="bento-card col-span-1 md:col-span-3 lg:col-span-2 overflow-hidden relative p-7 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col justify-between">
                    <div>
                        <div
                            class="relative size-20 rounded-2xl bg-indigo-50 dark:bg-indigo-950 border border-indigo-200 dark:border-indigo-800 flex items-center justify-center mx-auto p-3 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                            <img src="/public/build/img/notebook-dynamic-premium.webp" alt="Asesoría Jurídica"
                                class="w-14 h-14 object-contain">
                        </div>
                        <div class="mt-6 text-center space-y-2">
                            <span
                                class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Derechos
                                en Salud</span>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Asesoría Jurídica</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                Orientación legal para reclamar bolsas de colostomía, tirillas de glucemia, medicamentos
                                e interposición de tutelas.
                            </p>
                        </div>
                    </div>
                    <div class="pt-6 text-center">
                        <span
                            class="inline-flex items-center text-xs font-bold text-indigo-600 dark:text-indigo-400 group-hover:gap-1.5 gap-1 transition-all">
                            Conocer derechos <span
                                class="transform group-hover:translate-x-1 transition-transform">→</span>
                        </span>
                    </div>
                </a>

                <!-- Card 4: Atención Médica -->
                <a href="/public/medico"
                    class="bento-card col-span-1 md:col-span-3 lg:col-span-2 overflow-hidden relative p-7 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:shadow-rose-500/10 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col justify-between">
                    <div>
                        <div
                            class="relative size-20 rounded-2xl bg-rose-50 dark:bg-rose-950 border border-rose-200 dark:border-rose-800 flex items-center justify-center mx-auto p-3 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                            <img src="/public/build/img/heart-dynamic-premium.png" alt="Atención Médica"
                                class="w-14 h-14 object-contain">
                        </div>
                        <div class="mt-6 text-center space-y-2">
                            <span
                                class="text-xs font-bold uppercase tracking-wider text-rose-600 dark:text-rose-400">Cuidados
                                Clínicos</span>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Atención y Enfermería</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                Guías de cuidado del estoma, monitoreo de glicemia capilar, prevención de lesiones y
                                protocolos de enfermería validados.
                            </p>
                        </div>
                    </div>
                    <div class="pt-6 text-center">
                        <span
                            class="inline-flex items-center text-xs font-bold text-rose-600 dark:text-rose-400 group-hover:gap-1.5 gap-1 transition-all">
                            Ver guías médicas <span
                                class="transform group-hover:translate-x-1 transition-transform">→</span>
                        </span>
                    </div>
                </a>

                <!-- Card 5: Apoyo Emocional -->
                <a href="/public/psicologico"
                    class="bento-card col-span-1 md:col-span-6 lg:col-span-2 overflow-hidden relative p-7 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:shadow-amber-500/10 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col justify-between">
                    <div>
                        <div
                            class="relative size-20 rounded-2xl bg-amber-50 dark:bg-amber-950 border border-amber-200 dark:border-amber-800 flex items-center justify-center mx-auto p-3 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                            <img src="/public/build/img/star-dynamic-premium.png" alt="Apoyo Emocional"
                                class="w-14 h-14 object-contain">
                        </div>
                        <div class="mt-6 text-center space-y-2">
                            <span
                                class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Salud
                                Emocional</span>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Soporte Psicológico</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                Acompañamiento en la aceptación del diagnóstico, manejo de la ansiedad, autoimagen,
                                resiliencia y apoyo familiar.
                            </p>
                        </div>
                    </div>
                    <div class="pt-6 text-center">
                        <span
                            class="inline-flex items-center text-xs font-bold text-amber-600 dark:text-amber-400 group-hover:gap-1.5 gap-1 transition-all">
                            Acceder a apoyo <span
                                class="transform group-hover:translate-x-1 transition-transform">→</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Eventos y Talleres Comunitarios -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span
                    class="px-3.5 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                    Comunidad en Acción
                </span>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-3 mb-3">
                    Encuentros, Charlas y Talleres
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-base">
                    Momentos compartidos en nuestras jornadas de capacitación, integración y aprendizaje colectivo.
                </p>
            </div>

            <div id="gallery"
                class="relative w-full max-w-5xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800"
                data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-64 sm:h-96 md:h-[28rem] overflow-hidden rounded-3xl">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="/public/build/img/DSC_0113 (2).jpg" class="absolute block w-full h-full object-cover"
                            alt="Taller comunitario">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <img src="/public/build/img/DSC_0154.jpg" class="absolute block w-full h-full object-cover"
                            alt="Encuentro de pacientes">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="/public/build/img/DSC_0080.jpg" class="absolute block w-full h-full object-cover"
                            alt="Jornada de salud">
                    </div>
                    <!-- Item 4 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="/public/build/img/DSC_0073.jpg" class="absolute block w-full h-full object-cover"
                            alt="Capacitación y educación">
                    </div>
                    <!-- Item 5 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="/public/build/img/DSC_0057.jpg" class="absolute block w-full h-full object-cover"
                            alt="Actividades de bienestar">
                    </div>
                </div>

                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-white dark:bg-gray-800 text-gray-800 dark:text-white shadow-md group-hover:bg-gray-100 dark:group-hover:bg-gray-700 group-hover:scale-110 transition-all">
                        <svg class="w-5 h-5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2.5" d="m15 19-7-7 7-7" />
                        </svg>
                        <span class="sr-only">Anterior</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-white dark:bg-gray-800 text-gray-800 dark:text-white shadow-md group-hover:bg-gray-100 dark:group-hover:bg-gray-700 group-hover:scale-110 transition-all">
                        <svg class="w-5 h-5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2.5" d="m9 5 7 7-7 7" />
                        </svg>
                        <span class="sr-only">Siguiente</span>
                    </span>
                </button>
            </div>
        </div>
    </section>

    <hr class="my-10 border-t border-gray-200 dark:border-gray-700">

    <!-- Listado de Investigaciones -->
    <?php
    require "listadoInvestigaciones.php";
    ?>

</div>

<!-- ========================================== -->
<!-- MODAL INTERACTIVO DE ENCUESTAS DIAGNÓSTICAS -->
<!-- ========================================== -->
<?php if (isset($enfermedad) && ($enfermedad == "diabetes" || $enfermedad == "colostomia")): ?>
    <?php 
    $faltaPsicologia = !isset($encuestaPsicologia) || $encuestaPsicologia == 0;
    $faltaSalud = !isset($encuestaSalud) || $encuestaSalud == 0;
    $faltaJuridico = !isset($encuestaJuridico) || $encuestaJuridico == 0;
    
    $totalEncuestas = 3;
    $pendientes = ($faltaPsicologia ? 1 : 0) + ($faltaSalud ? 1 : 0) + ($faltaJuridico ? 1 : 0);
    $completadas = $totalEncuestas - $pendientes;
    $porcentajeCompletado = round(($completadas / $totalEncuestas) * 100);
    ?>

    <?php if ($pendientes > 0): ?>
        <!-- Píldora / Widget Flotante Interactivo en la esquina inferior derecha -->
        <div id="floating-encuestas-widget" class="fixed bottom-6 right-6 z-40 hidden">
            <button id="open-encuestas-modal-btn" type="button" 
                class="group flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 hover:from-emerald-500 hover:to-teal-600 text-white rounded-2xl shadow-2xl hover:shadow-emerald-500/30 transition-all duration-300 transform hover:-translate-y-1 focus:ring-4 focus:ring-emerald-400/50">
                <span class="relative flex h-3.5 w-3.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-white"></span>
                </span>
                <div class="text-left">
                    <p class="text-[10px] uppercase font-extrabold tracking-wider text-emerald-200">Autoevaluaciones</p>
                    <p class="text-xs font-bold"><?php echo $pendientes; ?> pendiente<?php echo $pendientes > 1 ? 's' : ''; ?> por responder</p>
                </div>
                <div class="w-7 h-7 rounded-xl bg-white/20 flex items-center justify-center group-hover:rotate-12 transition-transform">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </button>
        </div>

        <!-- Backdrop y Modal Principal -->
        <div id="interactive-encuestas-modal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none">
            
            <div id="encuestas-modal-card" class="relative w-full max-w-lg bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden transform scale-95 transition-transform duration-300">
                
                <!-- Encabezado con Banner y Progreso -->
                <div class="relative bg-gradient-to-r from-teal-700 via-emerald-700 to-slate-900 text-white p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-[11px] font-bold uppercase tracking-wider backdrop-blur-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                            Tu Plan de Bienestar
                        </div>
                        <button type="button" id="close-encuestas-modal-btn" aria-label="Cerrar ventana"
                            class="text-emerald-100 hover:text-white p-1.5 rounded-xl hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <h3 class="text-xl md:text-2xl font-black text-white">
                        ¡Queremos personalizar tu cuidado!
                    </h3>
                    <p class="text-xs md:text-sm text-emerald-100/90 mt-1 leading-relaxed">
                        Completa estas 3 breves evaluaciones para que nuestro equipo médico, psicológico y legal diseñe recomendaciones exactas para ti.
                    </p>

                    <!-- Barra de Progreso Dinámica -->
                    <div class="mt-4 pt-3 border-t border-emerald-600/50">
                        <div class="flex justify-between items-center text-xs font-semibold mb-1.5 text-emerald-100">
                            <span>Progreso de Autoevaluación</span>
                            <span class="font-bold"><?php echo $completadas; ?> de <?php echo $totalEncuestas; ?> completadas (<?php echo $porcentajeCompletado; ?>%)</span>
                        </div>
                        <div class="w-full h-2 bg-emerald-950/60 rounded-full overflow-hidden p-0.5">
                            <div class="h-full bg-gradient-to-r from-lime-300 to-emerald-300 rounded-full transition-all duration-700 ease-out" 
                                style="width: <?php echo max(5, $porcentajeCompletado); ?>%"></div>
                        </div>
                    </div>
                </div>

                <!-- Cuerpo del Modal: Tarjetas Interactivas de las Encuestas -->
                <div class="p-6 space-y-3.5 max-h-[60vh] overflow-y-auto">
                    
                    <!-- 1. Encuesta de Salud Física -->
                    <div class="group relative rounded-2xl p-4 border transition-all duration-200 <?php echo $faltaSalud ? 'bg-slate-50 dark:bg-gray-900/60 border-emerald-200 dark:border-emerald-800/60 hover:border-emerald-400 hover:shadow-md' : 'bg-emerald-50/50 dark:bg-emerald-950/20 border-emerald-300 dark:border-emerald-800/80'; ?>">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3.5">
                                <div class="w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-lg flex-shrink-0">
                                    🩺
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white">Salud Física y Estoma</h4>
                                        <?php if ($faltaSalud): ?>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300">~5 min</span>
                                        <?php else: ?>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-emerald-200 text-emerald-900 dark:bg-emerald-800 dark:text-emerald-100 flex items-center gap-1">
                                                <svg class="w-3 h-3 text-emerald-700 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                Lista
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Control de glucemia, piel periestomal y dispositivos.</p>
                                </div>
                            </div>

                            <div>
                                <?php if ($faltaSalud): ?>
                                    <a href="/public/encuestaSalud" 
                                        class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                                        <span>Iniciar</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </a>
                                <?php else: ?>
                                    <span class="text-emerald-600 dark:text-emerald-400 text-xs font-bold">Completada ✓</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Encuesta de Bienestar Emocional -->
                    <div class="group relative rounded-2xl p-4 border transition-all duration-200 <?php echo $faltaPsicologia ? 'bg-slate-50 dark:bg-gray-900/60 border-sky-200 dark:border-sky-800/60 hover:border-sky-400 hover:shadow-md' : 'bg-sky-50/50 dark:bg-sky-950/20 border-sky-300 dark:border-sky-800/80'; ?>">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3.5">
                                <div class="w-11 h-11 rounded-xl bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center font-bold text-lg flex-shrink-0">
                                    💭
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white">Estado Emocional y Resiliencia</h4>
                                        <?php if ($faltaPsicologia): ?>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-sky-100 text-sky-800 dark:bg-sky-900/60 dark:text-sky-300">~4 min</span>
                                        <?php else: ?>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-sky-200 text-sky-900 dark:bg-sky-800 dark:text-sky-100 flex items-center gap-1">
                                                <svg class="w-3 h-3 text-sky-700 dark:text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                Lista
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Adaptación, imagen corporal y manejo del estrés.</p>
                                </div>
                            </div>

                            <div>
                                <?php if ($faltaPsicologia): ?>
                                    <a href="/public/encuestaPsicologia" 
                                        class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                                        <span>Iniciar</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </a>
                                <?php else: ?>
                                    <span class="text-sky-600 dark:text-sky-400 text-xs font-bold">Completada ✓</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Encuesta de Situación Jurídica -->
                    <div class="group relative rounded-2xl p-4 border transition-all duration-200 <?php echo $faltaJuridico ? 'bg-slate-50 dark:bg-gray-900/60 border-indigo-200 dark:border-indigo-800/60 hover:border-indigo-400 hover:shadow-md' : 'bg-indigo-50/50 dark:bg-indigo-950/20 border-indigo-300 dark:border-indigo-800/80'; ?>">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3.5">
                                <div class="w-11 h-11 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-lg flex-shrink-0">
                                    ⚖️
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white">Garantías y Suministro EPS</h4>
                                        <?php if ($faltaJuridico): ?>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-indigo-100 text-indigo-800 dark:bg-indigo-900/60 dark:text-indigo-300">~3 min</span>
                                        <?php else: ?>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-indigo-200 text-indigo-900 dark:bg-indigo-800 dark:text-indigo-100 flex items-center gap-1">
                                                <svg class="w-3 h-3 text-indigo-700 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                Lista
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Entrega oportuna de bolsas, insulinas y tutelas.</p>
                                </div>
                            </div>

                            <div>
                                <?php if ($faltaJuridico): ?>
                                    <a href="/public/encuestaJuridica" 
                                        class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                                        <span>Iniciar</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </a>
                                <?php else: ?>
                                    <span class="text-indigo-600 dark:text-indigo-400 text-xs font-bold">Completada ✓</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer del Modal -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-gray-900/60 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between">
                    <span class="text-[11px] text-gray-500 dark:text-gray-400 flex items-center gap-1">
                        🔒 Respuestas 100% confidenciales
                    </span>
                    <button type="button" id="defer-encuestas-modal-btn"
                        class="px-4 py-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition">
                        Recordármelo más tarde
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- SCRIPT INTERACTIVO DE ALERTAS Y MODALES -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Toast Flotante de Bienvenida (Visitantes)
    const welcomeToast = document.getElementById('welcome-floating-toast');
    const dismissWelcomeBtn = document.getElementById('dismiss-welcome-toast');
    
    if (welcomeToast && !sessionStorage.getItem('dismiss_welcome_toast')) {
        setTimeout(function() {
            welcomeToast.classList.remove('hidden');
            requestAnimationFrame(function() {
                welcomeToast.classList.remove('translate-y-24', 'opacity-0');
                welcomeToast.classList.add('translate-y-0', 'opacity-100');
            });
        }, 1200);

        if (dismissWelcomeBtn) {
            dismissWelcomeBtn.addEventListener('click', function() {
                welcomeToast.classList.add('translate-y-24', 'opacity-0');
                setTimeout(function() { welcomeToast.classList.add('hidden'); }, 500);
                sessionStorage.setItem('dismiss_welcome_toast', 'true');
            });
        }
    }

    // 2. Callout de Perfil Incompleto
    const profileAlert = document.getElementById('incomplete-profile-alert');
    const dismissProfileBtn = document.getElementById('dismiss-profile-alert');

    if (profileAlert && sessionStorage.getItem('dismiss_profile_alert')) {
        profileAlert.style.display = 'none';
    } else if (profileAlert && dismissProfileBtn) {
        dismissProfileBtn.addEventListener('click', function() {
            profileAlert.style.opacity = '0';
            profileAlert.style.transform = 'scale(0.98)';
            setTimeout(function() {
                profileAlert.style.display = 'none';
            }, 300);
            sessionStorage.setItem('dismiss_profile_alert', 'true');
        });
    }

    // 3. Modal Interactivo de Encuestas Diagnósticas + Widget Flotante
    const encuestasModal = document.getElementById('interactive-encuestas-modal');
    const encuestasCard = document.getElementById('encuestas-modal-card');
    const floatingWidget = document.getElementById('floating-encuestas-widget');
    const closeBtn = document.getElementById('close-encuestas-modal-btn');
    const deferBtn = document.getElementById('defer-encuestas-modal-btn');
    const openWidgetBtn = document.getElementById('open-encuestas-modal-btn');

    function openModal() {
        if (!encuestasModal) return;
        if (floatingWidget) floatingWidget.classList.add('hidden');
        encuestasModal.classList.remove('opacity-0', 'pointer-events-none');
        encuestasModal.classList.add('opacity-100', 'pointer-events-auto');
        if (encuestasCard) {
            encuestasCard.classList.remove('scale-95');
            encuestasCard.classList.add('scale-100');
        }
    }

    function closeModalAndShowWidget(storeSession) {
        if (!encuestasModal) return;
        encuestasModal.classList.remove('opacity-100', 'pointer-events-auto');
        encuestasModal.classList.add('opacity-0', 'pointer-events-none');
        if (encuestasCard) {
            encuestasCard.classList.remove('scale-100');
            encuestasCard.classList.add('scale-95');
        }
        if (floatingWidget) {
            setTimeout(function() {
                floatingWidget.classList.remove('hidden');
            }, 300);
        }
        if (storeSession) {
            sessionStorage.setItem('encuestas_minimizadas', 'true');
        }
    }

    if (encuestasModal) {
        const isMinimizadas = sessionStorage.getItem('encuestas_minimizadas');
        if (isMinimizadas) {
            if (floatingWidget) floatingWidget.classList.remove('hidden');
        } else {
            // Mostrar modal suavemente tras 1.8 segundos
            setTimeout(openModal, 1800);
        }

        if (closeBtn) closeBtn.addEventListener('click', function() { closeModalAndShowWidget(true); });
        if (deferBtn) deferBtn.addEventListener('click', function() { closeModalAndShowWidget(true); });
        if (openWidgetBtn) openWidgetBtn.addEventListener('click', openModal);

        // Cerrar al hacer clic en el backdrop
        encuestasModal.addEventListener('click', function(e) {
            if (e.target === encuestasModal) {
                closeModalAndShowWidget(true);
            }
        });
    }
});
</script>
