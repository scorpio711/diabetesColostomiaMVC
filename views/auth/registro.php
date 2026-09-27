<?php
$script = "<script src='/public/build/js/app.js'></script>";
?>

<main class="min-h-screen py-16 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg space-y-6">
        
        <!-- Encabezado con Logo -->
        <div class="text-center">
            <a href="/public" class="inline-flex items-center justify-center gap-2 mb-4 group">
                <img class="h-12 w-auto transform group-hover:scale-105 transition-transform"
                    src="/public/build/img/Logo CAREFULNESS.svg" alt="CAREFULNESS">
                <span class="text-2xl font-bold text-gray-900 dark:text-white">CAREFULNESS</span>
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                Crea tu Cuenta
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Únete a la comunidad y accede a orientación médica, emocional y jurídica
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

        <!-- Tarjeta de Registro -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl space-y-6">
            <form class="space-y-5" method="POST" enctype="multipart/form-data">
                
                <!-- Nombre Completo -->
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Nombre Completo
                    </label>
                    <input type="text" name="nombre" id="nombre" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                        placeholder="Ej. Juan Pérez" value="<?php echo s($usuario->nombre ?? ''); ?>">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Sexo -->
                    <div>
                        <label for="sexo" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            Sexo
                        </label>
                        <select name="sexo" id="sexo" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm">
                            <option value="">Selecciona sexo</option>
                            <option value="masculino" <?php echo ($usuario->sexo ?? '') === "masculino" ? "selected" : ''; ?>>Masculino</option>
                            <option value="femenino" <?php echo ($usuario->sexo ?? '') === "femenino" ? "selected" : ''; ?>>Femenino</option>
                        </select>
                    </div>

                    <!-- Condición / Diagnóstico -->
                    <div id="opcionPaciente">
                        <label for="enfermedad" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            Condición Médica
                        </label>
                        <select id="enfermedad" name="enfermedad" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm">
                            <option value="">Selecciona condición</option>
                            <option value="diabetes" <?php echo ($usuario->enfermedad ?? '') == "diabetes" ? "selected" : ""; ?>>Diabetes</option>
                            <option value="colostomia" <?php echo ($usuario->enfermedad ?? '') == "colostomia" ? "selected" : ""; ?>>Colostomía / Ostomía</option>
                        </select>
                    </div>
                </div>

                <!-- Fecha de Nacimiento -->
                <div>
                    <label for="fecha_nacimiento" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Fecha de Nacimiento
                    </label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required
                        value="<?php echo !empty($usuario->fecha_nacimiento) ? date('Y-m-d', strtotime(s($usuario->fecha_nacimiento))) : ''; ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm">
                </div>

                <!-- Correo Electrónico -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Correo Electrónico
                    </label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                        placeholder="tu-correo@ejemplo.com" value="<?php echo s($usuario->email ?? ''); ?>">
                </div>

                <!-- Teléfono Celular -->
                <div>
                    <label for="phone-input" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Teléfono Móvil
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 19 18">
                                <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                            </svg>
                        </div>
                        <input type="tel" id="phone-input" name="telefono" required
                            value="<?php echo s($usuario->telefono ?? ''); ?>"
                            class="w-full ps-10 px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                            placeholder="3001234567">
                    </div>
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Contraseña (mínimo 8 caracteres)
                    </label>
                    <input type="password" name="password" id="password" required minlength="8"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                        placeholder="••••••••">
                </div>

                <!-- Términos -->
                <div class="flex items-start gap-3">
                    <input id="terms" type="checkbox" required
                        class="w-4 h-4 mt-1 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="terms" class="text-sm text-gray-600 dark:text-gray-300 leading-snug">
                        Acepto los <a class="font-semibold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 underline" href="#">Términos y condiciones</a> de privacidad y salud.
                    </label>
                </div>

                <!-- Botón de Registro -->
                <button type="submit" name="crear"
                    class="w-full inline-flex items-center justify-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-semibold rounded-xl text-base px-6 py-3.5 text-center shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all duration-200">
                    <span>Crear mi cuenta gratuita</span>
                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    ¿Ya tienes una cuenta registrada?
                    <a href="/public/login"
                        class="font-semibold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 hover:underline ms-1">
                        Inicia sesión aquí
                    </a>
                </p>
            </div>
        </div>
    </div>
</main>