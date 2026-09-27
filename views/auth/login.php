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
                Iniciar Sesión
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Accede a tu portal médico y acompañamiento integral
            </p>
        </div>

        <!-- Mensajes de Error -->
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

        <!-- Alertas de Estado (Query Params) -->
        <?php if (isset($resultado) && $resultado == 1): ?>
            <div id="alert-1"
                class="flex items-center p-4 text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 dark:bg-gray-800 dark:border-emerald-800 dark:text-emerald-300 shadow-sm"
                role="alert">
                <svg class="flex-shrink-0 w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    ¡Estás a un paso! Revisa tu correo para confirmar tu cuenta.
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg p-1.5 hover:bg-emerald-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-emerald-300 dark:hover:bg-gray-700 transition"
                    data-dismiss-target="#alert-1" aria-label="Cerrar">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        <?php endif; ?>

        <?php if (isset($resultado) && $resultado == 2): ?>
            <div class="flex items-center p-4 text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 dark:bg-gray-800 dark:border-emerald-800 dark:text-emerald-300 shadow-sm"
                role="alert">
                <svg class="w-5 h-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="ms-3 text-sm font-semibold">
                    ¡Felicidades! Tu cuenta ha sido confirmada con éxito. Ya puedes ingresar.
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($resultado) && $resultado == 3): ?>
            <div id="alert-2"
                class="flex items-center p-4 text-teal-800 rounded-xl bg-teal-50 border border-teal-200 dark:bg-gray-800 dark:border-teal-800 dark:text-teal-300 shadow-sm"
                role="alert">
                <svg class="w-5 h-5 flex-shrink-0 text-teal-600 dark:text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="ms-3 text-sm font-medium">
                    Tu contraseña ha sido actualizada correctamente.
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-teal-50 text-teal-500 rounded-lg p-1.5 hover:bg-teal-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-teal-300 dark:hover:bg-gray-700 transition"
                    data-dismiss-target="#alert-2" aria-label="Cerrar">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        <?php endif; ?>

        <!-- Tarjeta del Formulario -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl space-y-6">
            <form method="POST" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Correo Electrónico
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                        placeholder="tu-correo@ejemplo.com">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-gray-900 dark:text-white">
                            Contraseña
                        </label>
                        <a href="/public/olvide-password"
                            class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                        placeholder="••••••••">
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-semibold rounded-xl text-base px-6 py-3.5 text-center shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all duration-200">
                    <span>Ingresar a mi cuenta</span>
                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    ¿Aún no tienes una cuenta?
                    <a href="/public/registro"
                        class="font-semibold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 hover:underline ms-1">
                        Regístrate gratis
                    </a>
                </p>
            </div>
        </div>
    </div>
</main>