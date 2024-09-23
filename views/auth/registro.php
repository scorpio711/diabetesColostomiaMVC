<?php

$script = "<script src ='/public/build/js/app.js'></script>";

?>

<section class="dark:bg-gray-90 dark:bg-gray-900 pb-4 pt-32">
    <div class="flex flex-col items-center justify-center px-6  mx-auto ">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class=" h-14 mr-2" src="/public/build/img/Logo CAREFULNESS.svg" alt="logo">

        </a>
        <?php foreach ($errores as $error): ?>
            <div class="p-4 mb-4 text-sm mt-4 text-red-800 w-96 text-center rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">¡Cuidado!</span>
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <div
            class="w-full bg-white rounded-lg border border-blue-300 shadow shadow-green-500/20 md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl font-bold  leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Crea tu cuenta</h1>
                <form class="space-y-4 md:space-y-6" enctype="multipart/form-data" method="POST">
                    <div class="mb-6">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                            Completo</label>
                        <input type="text" name="nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Nombre Completo" value="<?php echo s($usuario->nombre) ?>">
                    </div>

                    <div class="w-full">
                        <label for="sexo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                        <select name="sexo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            <option selected value="">Escoge tu sexo</option>
                            <option value="masculino" <?php echo $usuario->sexo === "masculino" ? "selected" : '' ?>>
                                Masculino</option>
                            <option value="femenino" <?php echo $usuario->sexo === "femenino" ? "selected" : '' ?>>
                                Femenino</option>
                        </select>
                    </div>

                    <div id="opcionPaciente">
                        <label for="enfermedad"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Condición</label>
                        <select id="countries" name="enfermedad"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            <option value="">Selecciona tu condición</option>
                            <option value="diabetes" <?php echo $usuario->enfermedad == "diabetes" ? "selected" : "" ?>>
                                Diabetes</option>
                            <option value="colostomia" <?php echo $usuario->enfermedad == "colostomia" ? "selected" : "" ?>>Colostomia</option>
                        </select>
                    </div>

                    <div>
                        <label for="Fecha-nacimiento"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
                            nacimiento</label>

                        <input value="<?php echo date('Y-m-d', strtotime(s($usuario->fecha_nacimiento))); ?>"
                            type="date" name="fecha_nacimiento" id="fecha"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="$2999" required="">
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu
                            Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="name@company.com" required="" value="<?php echo s($usuario->email) ?>">
                    </div>
                    <div>
                        <label for="phone-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu
                            número de telefono</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                    <path
                                        d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                                </svg>
                            </div>
                            <input type="text" id="phone-input" aria-describedby="helper-text-explanation"
                                name="telefono" value="<?php echo s($usuario->telefono) ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                pattern="3(0[0-5]|1[0-9]|2[0-9]|5[0-1])[0-9]{7}" placeholder="3234567890" required />
                        </div>
                        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Escribe tu
                            numero cumpliendo el formato</p>
                    </div>

                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            required="">
                    </div>
                    <!-- <div>
                        <label for="confirm-password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirma tu contraseña</label>
                        <input type="password" name="confirm-password" id="confirm-password"
                            placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            required="">
                    </div> -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox"
                                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                required="">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-black dark:text-gray-300">Acepto los <a
                                    class="font-medium text-green-500 hover:underline dark:text-primary-500"
                                    href="#">Terminos y condiciones</a></label>
                        </div>
                    </div>
                    <button type="submit" name="crear"
                        class="text-white bg-gradient-to-br  from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-base px-6 py-3.5 text-center me-2 mb-2 w-full">Crear
                        tu cuenta</button>
                    <p class="text-sm  text-black dark:text-gray-400">
                        ¿Ya tienes una Cuenta? <a href="/public/login"
                            class="font-medium text-green-500 hover:underline dark:text-green-500">Inicia Sesión
                            Aqui</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>