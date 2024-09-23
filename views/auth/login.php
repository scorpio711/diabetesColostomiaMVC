<body class="dark:bg-black">
    <main class="contenedor py-28">
        <div class="flex min-h-full flex-col items-center mt-24 justify-center px-6 pb-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-14 w-auto" src="/public/build/img/Logo CAREFULNESS.svg" alt="Your Company">
            </div>
            <?php foreach ($errores as $error): ?>
                <div class="p-4 text-sm mt-4 text-red-800 text-center rounded-lg w-80 bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">¡Cuidado!</span>
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
            <?php if ($resultado == 1): ?>
                <div id="alert-1"
                    class="flex items-center p-4 mt-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        Estas a un paso, entra a tu correo y Confirma tu cuenta
                    </div>
                    <button type="button"
                        class="ml-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
            <?php if ($resultado == 2): ?>
                <div class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <span class="font-medium">Felicidades</span> Tu cuenta ha sido confirmada
                </div>
            <?php endif ?>
            <?php if ($resultado == 3): ?>
                <div id="alert-2"
                    class="flex items-center p-4 mt-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        La contraseña ha sido cambiada
                    </div>
                    <button type="button"
                        class="ml-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            <?php endif; ?>

            <div
                class="sm:mx-auto mt-6 sm:w-full sm:max-w-sm p-4 sm:p-8 border border-blue-300 shadow-green-500/20 rounded-lg shadow-md dark:border-gray-800">
                <h1
                    class="text-xl font-bold pb-4 leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Inicia Sesión</h1>
                <form method="POST" class="space-y-6" action="#" method="POST">
                    <div class="w-72 sm:w-full">
                        <label for="email"
                            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Correo
                            Electronico</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-500 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="w-72 sm:w-full">
                        <div class="flex items-center justify-between">
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Contraseña</label>
                            <div class="text-sm">
                                <a href="/public/olvide-password"
                                    class="font-semibold text-green-500 hover:decoration-1 dark:text-lime-400 dark:hover:text-lime-300">Olvidaste
                                    tu
                                    contraseña?</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-500 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full text-white bg-gradient-to-br from-green-400 to-blue-600 dark:to-lime-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-base px-6 py-2 text-center me-2 mb-2">Inicia
                            Sesion</button>
                    </div>
                </form>
                <p class="mt-4 text-center text-sm text-black dark:text-white">
                    ¿No estas registrado?
                    <a href="/public/registro"
                        class="font-semibold leading-6 text-green-500 hover:decoration-1 dark:text-lime-400 dark:hover:text-lime-300">Registrate
                        Gratis</a>
                </p>
            </div>


        </div>
    </main>
</body>