<?php

$script = "<script src ='/public/build/js/app.js'></script>";

?>

<section class="dark:bg-gray-90 dark:bg-gray-900 py-40">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="../../public/build/img/zyro-image.webp" alt="logo">
            StomaDiahelp
        </a>
        <?php foreach ($errores as $error): ?>
            <div class="p-4 mb-4 text-sm mt-4 text-red-800 w-96 text-center rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">¡Cuidado!</span>
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Crea tu Cuenta
                </h1>
                <form class="space-y-4 md:space-y-6" enctype="multipart/form-data" method="POST">
                    <div class="mb-6">
                        <label for="nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" name="nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Nombre Completo" value="<?php echo s($usuario->nombre) ?>">
                    </div>

                    <div class="w-full">
                        <label for="sexo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                        <select name="sexo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecciona tu condición</option>
                            <option value="diabetes" <?php echo $usuario->enfermedad == "diabetes" ? "selected" : ""?>>Diabetes</option>
                            <option value="colostomia" <?php echo $usuario->enfermedad == "colostomia" ? "selected" : ""?>>Colostomia</option>
                        </select>
                    </div>

                    <div>
                        <label for="Fecha-nacimiento"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
                            nacimiento</label>

                        <input value="<?php echo date('Y-m-d', strtotime(s($usuario->fecha_nacimiento))); ?>"
                            type="date" name="fecha_nacimiento" id="fecha"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="$2999" required="">
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu
                            Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@company.com" required="" value="<?php echo s($usuario->email) ?>">
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                    </div>
                    <!-- <div>
                        <label for="confirm-password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirma tu contraseña</label>
                        <input type="password" name="confirm-password" id="confirm-password"
                            placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                    </div> -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                required="">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">Acepto los <a
                                    class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                                    href="#">Terminos y condiciones</a></label>
                        </div>
                    </div>
                    <button type="submit" name="crear"
                        class="text-white bg-gradient-to-br  from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-base px-6 py-3.5 text-center me-2 mb-2 w-full">Crear
                        tu cuenta</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        ¿Ya tienes una Cuenta? <a href="/public/login"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Inicia Sesion
                            Aqui</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>