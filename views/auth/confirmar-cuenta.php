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
                Confirmación de Cuenta
            </h1>
        </div>

        <!-- Errores -->
        <?php if (!empty($errores)): ?>
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl text-center space-y-4">
                <span class="text-4xl block">⚠️</span>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Token No Válido</h3>
                <?php foreach ($errores as $error): ?>
                    <p class="text-sm text-red-600 dark:text-red-400 font-medium"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Es posible que el enlace haya expirado o tu cuenta ya haya sido confirmada previamente.
                </p>
                <div class="pt-4 flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="/public/login"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition shadow-sm">
                        Ir a Iniciar Sesión
                    </a>
                    <a href="/public/registro"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-xl transition">
                        Crear una Cuenta
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Éxito -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl text-center space-y-4">
                <div class="size-16 rounded-2xl bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 flex items-center justify-center mx-auto text-3xl">
                    ✅
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">¡Cuenta Confirmada con Éxito!</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                    Tu correo electrónico ha sido validado correctamente. Ya puedes acceder a todos los servicios de la plataforma.
                </p>
                <div class="pt-4">
                    <a href="/public/login"
                        class="w-full inline-flex items-center justify-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-semibold rounded-xl text-base px-6 py-3.5 text-center shadow-lg shadow-emerald-600/25 transition">
                        <span>Iniciar Sesión Ahora</span>
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>