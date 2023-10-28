<section class="bg-white pt-12 dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <?php foreach ($errores as $error): ?>
            <div class="p-4 mb-4 text-sm mt-4 text-red-800 w-96 text-center rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">¡Cuidado!</span>
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Perfil</h2>
        <div class="flex justify-center">
            <img class="rounded w-36 h-36" src="/public/imagenesUsuarios/<?php echo $_SESSION["imagen"] ?>"
                alt="Extra large avatar">
        </div>
        <?php if ($usuario->actualizado === "0"): ?>
            <form enctype="multipart/form-data" method="POST">
                <!-- <input type="number" name="id" class="hidden" value="<?php echo $usuario->id; ?>"> -->
                <input type="text" name="imagenPrevia" class="hidden" value="<?php echo $paciente->imagen; ?>">

                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" aria-label="disabled input" name="nombre" disabled
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->nombre ?>">
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
                        <label for="enfermedad"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enfermedad</label>

                        <input type="text" id="disabled-input" aria-label="disabled input" name="enfermedad"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->enfermedad ?>" disabled>

                    </div>
                    <div class="w-full">
                        <label for="escolaridad"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escolaridad</label>
                        <select name="escolaridad"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Escoge nivel de escolaridad</option>
                            <option value="ninguna" <?php echo $paciente->escolaridad === "ninguna" ? "selected" : '' ?>>
                                Ninguna</option>
                            <option value="primaria" <?php echo $paciente->escolaridad === "primaria" ? "selected" : '' ?>>
                                Primaria</option>
                            <option value="bachillerato" <?php echo $paciente->escolaridad === "bachillerato" ? "selected" : '' ?>>
                                Bachillerato</option>
                            <option value="tecnico" <?php echo $paciente->escolaridad === "tecnico" ? "selected" : '' ?>>
                                Tecnico</option>
                            <option value="pregrado" <?php echo $paciente->escolaridad === "pregrado" ? "selected" : '' ?>>
                                Pregrado</option>
                            <option value="postgrado" <?php echo $paciente->escolaridad === "postgrado" ? "selected" : '' ?>>
                                Postgrado</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <label for="estrato_socioeconomico"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estrato
                            socieconomieco</label>
                        <select name="estrato_socioeconomico"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Escoge tu estrato</option>
                            <option value="1" <?php echo $paciente->estrato_socioeconomico === "1" ? "selected" : '' ?>>1
                            </option>
                            <option value="2" <?php echo $paciente->estrato_socioeconomico === "2" ? "selected" : '' ?>>2
                            </option>
                            <option value="3" <?php echo $paciente->estrato_socioeconomico === "3" ? "selected" : '' ?>>3
                            </option>
                            <option value="4" <?php echo $paciente->estrato_socioeconomico === "4" ? "selected" : '' ?>>4
                            </option>
                            <option value="5" <?php echo $paciente->estrato_socioeconomico === "5" ? "selected" : '' ?>>5
                            </option>
                            <option value="6" <?php echo $paciente->estrato_socioeconomico === "6" ? "selected" : '' ?>>6
                            </option>
                        </select>
                    </div>

                    <div class="w-full">
                        <label for="lugar_de_residencia"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lugar de
                            residencia</label>
                        <select name="lugar_de_residencia"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Escoge tu Lugar de residencia</option>
                            <option value="urbana" <?php echo $paciente->lugar_de_residencia === "urbana" ? "selected" : '' ?>>
                                Urbana</option>
                            <option value="rural" <?php echo $paciente->lugar_de_residencia === "rural" ? "selected" : '' ?>>
                                Rural</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <label for="ocupacion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ocupacion</label>
                        <select name="ocupacion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Escogte tu ocupación</option>
                            <option value="hogar" <?php echo $paciente->ocupacion === "hogar" ? "selected" : '' ?>>Hogar
                            </option>
                            <option value="empleado" <?php echo $paciente->ocupacion === "empleado" ? "selected" : '' ?>>
                                Empleado</option>
                            <option value="independiente" <?php echo $paciente->ocupacion === "independiente" ? "selected" : '' ?>>Independiente</option>
                            <option value="pensionado" <?php echo $paciente->ocupacion === "pensionado" ? "selected" : '' ?>>
                                Pensionado</option>
                            <option value="agricultor" <?php echo $paciente->ocupacion === "agricultor" ? "selected" : '' ?>>
                                Agricultor</option>
                            <option value="estudiante" <?php echo $paciente->ocupacion === "estudiante" ? "selected" : '' ?>>
                                Estudiante</option>
                            <option value="otro" <?php echo $paciente->ocupacion === "otro" ? "selected" : '' ?>>otro</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <label for="apoyo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apoyo</label>
                        <select name="apoyo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Quien te apoya</option>
                            <option value="conyuge" <?php echo $paciente->apoyo === "conyuge" ? "selected" : '' ?>>Conyuge
                            </option>
                            <option value="hijo" <?php echo $paciente->apoyo === "hijo" ? "selected" : '' ?>>Hijo</option>
                            <option value="padres" <?php echo $paciente->apoyo === "padres" ? "selected" : '' ?>>Padre o madre
                            </option>
                            <option value="familiar" <?php echo $paciente->apoyo === "familiar" ? "selected" : '' ?>>Otro
                                familiar</option>
                            <option value="amigo" <?php echo $paciente->apoyo === "amigos" ? "selected" : '' ?>>Amigo</option>
                            <option value="otro" <?php echo $paciente->apoyo === "otros" ? "selected" : '' ?>>Otro</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <label for="afiliacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de
                            afiliacion</label>
                        <select name="afiliacion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Escoge tu tipo de afiliacion</option>
                            <option value="subsidiado" <?php echo $paciente->afiliacion === "subsidiado" ? "selected" : '' ?>>
                                Subsidiado</option>
                            <option value="contributivo" <?php echo $paciente->afiliacion === "contributivo" ? "selected" : '' ?>>Contributivo</option>
                            <option value="R.E" <?php echo $paciente->afiliacion === "R.E" ? "selected" : '' ?>>Regimen
                                especial</option>
                            <option value="particular" <?php echo $paciente->afiliacion === "particular" ? "selected" : '' ?>>
                                Particular</option>
                            <option value="otros" <?php echo $paciente->afiliacion === "otros" ? "selected" : '' ?>>Otro
                            </option>
                        </select>
                    </div>

                    <div class="w-full">
                        <label for="tiempo_enfermedad"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tiempo con
                            la enfermedad</label>
                        <select name="tiempo_enfermedad"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Escoge el tiempo</option>
                            <option value="<3 meses" <?php echo $paciente->tiempo_enfermedad === "<3 meses" ? "selected" : '' ?>>Menor a 3 meses</option>
                            <option value="3-6 meses" <?php echo $paciente->tiempo_enfermedad === "3-6 meses" ? "selected" : '' ?>>De 3 a 6 meses</option>
                            <option value="1-2 años" <?php echo $paciente->tiempo_enfermedad === "1-2 años" ? "selected" : '' ?>>Entre 1 y 2 años</option>
                            <option value="3-5 años" <?php echo $paciente->tiempo_enfermedad === "3-5 años" ? "selected" : '' ?>>Entre 3 y 5 años</option>
                            <option value=">5 años" <?php echo $paciente->tiempo_enfermedad === "5 años" ? "selected" : '' ?>>
                                Mayor a 5 años</option>
                        </select>
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

                <input type="text" name="imagenPrevia" class="hidden" value="<?php echo $pacienteActualizado->imagen; ?>">

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
                    <div class="w-full">
                        <label for="enfermedad"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enfermedad</label>

                        <input type="text" id="disabled-input" aria-label="disabled input"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->enfermedad ?>" disabled>

                    </div>

                    <div class="w-full">
                        <label for="escolaridad"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escolaridad</label>
                        <input type="text" id="disabled-input" aria-label="disabled input" name="escolaridad"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $pacienteActualizado->escolaridad ?>" disabled>
                    </div>
                    <div class="w-full">
                        <label for="estrato_socieconomico"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estrato Economico</label>
                        <input type="text" id="disabled-input" aria-label="disabled input" name="estrato_socieconomico"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $pacienteActualizado->estrato_socioeconomico ?>" disabled>
                    </div>
                    <div class="w-full">
                        <label for="lugar_de_recidencia"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lugar de residencia</label>
                        <input type="text" id="disabled-input" aria-label="disabled input" name="lugar_de_recidencia"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $pacienteActualizado->lugar_de_residencia ?>" disabled>
                    </div>
                    <div class="w-full">
                        <label for="ocuapcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ocupación</label>
                        <input type="text" id="disabled-input" aria-label="disabled input" name="ocuapcion"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $pacienteActualizado->ocupacion ?>" disabled>
                    </div>

                    <div class="w-full">
                        <label for="apoyo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apoyo</label>
                        <input type="text" id="disabled-input" aria-label="disabled input" name="apoyo"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700
                            dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500
                            dark:focus:border-blue-500" value="<?php echo $pacienteActualizado->apoyo ?>" disabled>
                    </div>

                    <div class="w-full">
                        <label for="afiliacion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Afiliacion</label>
                        <input type="text" id="disabled-input" aria-label="disabled input" name="afiliacion"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $pacienteActualizado->afiliacion ?>" disabled>
                    </div>

                    <div class="w-full">
                        <label for="tiempo_enfermedad"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tiempo con la
                            enfermedad</label>
                        <input type="text" id="disabled-input" aria-label="disabled input" name="tiempo_enfermedad"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $pacienteActualizado->tiempo_enfermedad ?>" disabled>
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