<section class="pt-24">
    <div class="bg-white dark:bg-gray-900 max-w-2xl px-6 py-6 mx-auto rounded-md ">
        <?php foreach ($errores as $error): ?>
            <div class="flex justify-center align-center">
                <div class="p-4 mb-4 text-sm mt-4 text-red-800 w-96 text-center rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">¡Cuidado!</span>
                    <?php echo $error; ?>
                </div>
            </div>

        <?php endforeach; ?>

        <?php if (intval($_SESSION["actualizado"]) == 1): ?>
            <div class="flex justify-center">
                <img class="rounded w-36 h-36" src="/public/imagenesUsuarios/<?php echo $_SESSION["imagen"] ?>"
                    alt="Extra large avatar">
            </div>
        <?php endif; ?>
        <?php if (intval($_SESSION["actualizado"]) == 0): ?>
            <div class="flex justify-center">
                <img class="rounded w-36 h-36" src="/public/build/img/avatar.webp" alt="Extra large avatar">
            </div>
        <?php endif; ?>
        <?php if ($usuario->actualizado === "0"): ?>
            <form enctype="multipart/form-data" method="POST">
                <!-- <input type="number" name="id" class="hidden" value="<?php echo $usuario->id; ?>"> -->
                <input type="text" name="imagenPrevia" class="hidden" value="<?php echo $usuario->imagen; ?>">

                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" aria-label="disabled input" name="nombre" disabled
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->nombre ?>">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" aria-label="disabled input" name="email" disabled
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->email ?>">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="imagen">Foto
                            de
                            perfil</label>
                        <input name="imagen"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" type="file">
                    </div>

                    <div class="w-full">
                        <label for="fecha_nacimiento"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                            nacimiento</label>
                        <input type="text" id="disabled-input" aria-label="disabled input"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $fechaFormateada = date("d/m/Y", strtotime($usuario->fecha_nacimiento)); ?>"
                            disabled>
                    </div>

                    <div class="w-full">
                        <label for="sexo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                        <input type="text" id="disabled-input" aria-label="disabled input"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->sexo ?>" disabled>
                    </div>

                    <div class="w-full">
                        <label for="especializacion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especialización</label>
                        <select name="especializacion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Escoge una especialización</option>
                            <option value="civil" <?php echo $profesionalC->especializacion === "civil" ? "selected" : '' ?>>
                                Derecho Civil</option>
                            <option value="penal" <?php echo $profesionalC->especializacion === "penal" ? "selected" : '' ?>>
                                Derecho Penal</option>
                            <option value="laboral" <?php echo $profesionalC->especializacion === "laboral" ? "selected" : '' ?>>
                                Derecho Laboral</option>
                            <option value="comercial" <?php echo $profesionalC->especializacion === "comercial" ? "selected" : '' ?>>Derecho Comercial</option>
                            <option value="constitucional" <?php echo $profesionalC->especializacion === "constitucional" ? "selected" : '' ?>>Derecho Constitucional</option>
                            <option value="administrativo" <?php echo $profesionalC->especializacion === "administrativo" ? "selected" : '' ?>>Derecho Administrativo</option>
                            <option value="ambiental" <?php echo $profesionalC->especializacion === "ambiental" ? "selected" : '' ?>>Derecho Ambiental</option>
                            <option value="internacional" <?php echo $profesionalC->especializacion === "internacional" ? "selected" : '' ?>>Derecho Internacional</option>
                            <option value="tributario" <?php echo $profesionalC->especializacion === "tributario" ? "selected" : '' ?>>Derecho Tributario</option>
                            <option value="familia" <?php echo $profesionalC->especializacion === "familia" ? "selected" : '' ?>>
                                Derecho de Familia</option>
                            <option value="propiedad_intelectual" <?php echo $profesionalC->especializacion === "propiedad_intelectual" ? "selected" : '' ?>>Derecho de
                                Propiedad Intelectual</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="base-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
                        <input type="number" id="base-input" name="telefono" placeholder="Tu telefono" value="<?php echo $profesionalC->telefono?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Haz una
                            descripción de tu perfil</label>
                        <textarea id="message" rows="4" name="descripcion"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Haz tu descripcion..."><?php echo $profesionalC->descripcion?></textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="archivo">Archivos relacionados con tu perfil</label>
                        <input name="archivo"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" type="file">
                    </div>

                    <!-- <div class="sm:col-span-2">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea id="description" rows="8"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Write a product description here...">Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US</textarea>
                </div> -->
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" name="actualizar"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Acutalizar perfil
                    </button>
                </div>
            </form>
        <?php endif ?>

        <?php if ($usuario->actualizado === "1"): ?>
            <form enctype="multipart/form-data" method="POST">

                <input type="text" name="imagenPrevia" class="hidden" value="<?php echo $usaurio->imagen; ?>">

                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" aria-label="disabled input" name="nombre" disabled
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->nombre ?>">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="imagen_perfil">Foto
                            de
                            perfil</label>
                        <input name="imagen"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" type="file">
                    </div>

                    <div class="w-full">
                        <label for="fecha_nacimiento"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                            nacimiento</label>
                        <input type="text" id="disabled-input" aria-label="disabled input"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $fechaFormateada = date("d/m/Y", strtotime($usuario->fecha_nacimiento)); ?>"
                            disabled>
                    </div>

                    <div class="w-full">
                        <label for="sexo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                        <input type="text" id="disabled-input" aria-label="disabled input"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->sexo ?>" disabled>
                    </div>
                  
                    <div class="flex items-center space-x-4">
                        <button type="submit" name="actulizarImagen"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Acutalizar Imagen
                        </button>
                    </div>
            </form>
        <?php endif ?>
    </div>
</section>