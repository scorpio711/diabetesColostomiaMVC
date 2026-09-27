<main class="min-h-screen py-16 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-6">
        
        <!-- Encabezado con Logo -->
        <div class="text-center">
            <a href="/public" class="inline-flex items-center justify-center gap-2 mb-4 group">
                <img class="h-12 w-auto transform group-hover:scale-105 transition-transform"
                    src="/public/build/img/Logo CAREFULNESS.svg" alt="CAREFULNESS">
                <span class="text-2xl font-bold text-gray-900 dark:text-white">CAREFULNESS</span>
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                ¿Olvidaste tu Contraseña?
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                No te preocupes, escribe tu email para enviarte las instrucciones de restablecimiento.
            </p>
        </div>

        <!-- Errores -->
        <?php if (!empty($errores)): ?>
            <div class="space-y-2">
                <?php foreach ($errores as $error): ?>
                    <div class="flex items-center gap-2 p-3.5 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 dark:bg-gray-800 dark:border-red-900 dark:text-red-400 shadow-sm"
                        role="alert">
                        <svg class="w-4 h-4 flex-shrink-0 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium"><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Alerta de éxito -->
        <?php if (isset($resultado) && $resultado == 1): ?>
            <div id="alert-4"
                class="flex items-center p-4 text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 dark:bg-gray-800 dark:border-emerald-800 dark:text-emerald-300 shadow-sm"
                role="alert">
                <svg class="flex-shrink-0 w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="ms-3 text-sm font-semibold">
                    ¡Listo! Revisa tu bandeja de correo para continuar con el restablecimiento.
                </div>
            </div>
        <?php endif; ?>

        <!-- Tarjeta del Formulario -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl space-y-6">
            <form class="space-y-5" method="POST">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Correo Electrónico Registrado
                    </label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                        placeholder="tu-correo@ejemplo.com">
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-semibold rounded-xl text-base px-6 py-3.5 text-center shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all duration-200">
                    <span>Enviar instrucciones</span>
                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    ¿Recordaste tu contraseña?
                    <a href="/public/login"
                        class="font-semibold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 hover:underline ms-1">
                        Regresar a iniciar sesión
                    </a>
                </p>
            </div>
        </div>
    </div>
</main>