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
                Restablecer Contraseña
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Crea una nueva contraseña segura para tu cuenta
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

        <?php if (empty($noToken)): ?>
            <!-- Tarjeta del Formulario -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl space-y-6">
                <form class="space-y-5" method="POST">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            Nueva Contraseña
                        </label>
                        <input type="password" name="password" id="password" required minlength="8"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-semibold rounded-xl text-base px-6 py-3.5 text-center shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all duration-200">
                        <span>Guardar nueva contraseña</span>
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </form>
            </div>
        <?php else: ?>
            <!-- Token inválido -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl text-center space-y-4">
                <span class="text-4xl block">⚠️</span>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Enlace no válido o expirado</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    El enlace para restablecer tu contraseña no es válido o ya ha sido utilizado anteriormente.
                </p>
                <div class="pt-2">
                    <a href="/public/olvide-password"
                        class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition shadow-sm">
                        Solicitar nuevo enlace
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>