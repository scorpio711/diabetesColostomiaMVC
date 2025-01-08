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

        <?php if (intval($resultado) === 1): ?>
            <div id="alert-2"
                class="flex p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    El Horario ha sido creado
                </div>
                <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- fin de la alerta -->
            <!-- alerta de investigacion creada-->
        <?php elseif (intval($resultado) === 2): ?>
            <div id="alert-1"
                class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    El Horario ha sido actualizado
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-1" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <!-- fin de la alerta -->
            <!-- alerta de investigacion creada-->
        <?php elseif (intval($resultado) === 3): ?>
            <div id="alert-3" class="flex p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    Se ha borrado El servicio
                </div>
                <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        <?php endif; ?>

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
                        <input type="text" name="nombre"
                            class=" bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->nombre ?>">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" aria-label="disabled input" name="email" disabled
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $fechaFormateada = date("d/m/Y", strtotime($usuario->fecha_nacimiento)); ?>"
                            disabled>
                    </div>

                    <div class="w-full">
                        <label for="sexo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                        <input type="text" id="disabled-input" aria-label="disabled input"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->sexo ?>" disabled>
                    </div>

                    <?php if ($_SESSION["rol"] == "abogado"): ?>
                        <div class="w-full">
                            <label for="especializacion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especialización</label>
                            <select name="especializacion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Escoge una especialización</option>
                                <option value="civil" <?php echo $profesionalC->especializacion === "civil" ? "selected" : '' ?>>
                                    Derecho Civil</option>
                                <option value="penal" <?php echo $profesionalC->especializacion === "penal" ? "selected" : '' ?>>
                                    Derecho Penal</option>
                                <option value="laboral" <?php echo $profesionalC->especializacion === "laboral" ? "selected" : '' ?>>Derecho Laboral</option>
                                <option value="comercial" <?php echo $profesionalC->especializacion === "comercial" ? "selected" : '' ?>>Derecho Comercial</option>
                                <option value="constitucional" <?php echo $profesionalC->especializacion === "constitucional" ? "selected" : '' ?>>Derecho Constitucional</option>
                                <option value="administrativo" <?php echo $profesionalC->especializacion === "administrativo" ? "selected" : '' ?>>Derecho Administrativo</option>
                                <option value="ambiental" <?php echo $profesionalC->especializacion === "ambiental" ? "selected" : '' ?>>Derecho Ambiental</option>
                                <option value="internacional" <?php echo $profesionalC->especializacion === "internacional" ? "selected" : '' ?>>Derecho Internacional</option>
                                <option value="tributario" <?php echo $profesionalC->especializacion === "tributario" ? "selected" : '' ?>>Derecho Tributario</option>
                                <option value="familia" <?php echo $profesionalC->especializacion === "familia" ? "selected" : '' ?>>Derecho de Familia</option>
                                <option value="propiedad_intelectual" <?php echo $profesionalC->especializacion === "propiedad_intelectual" ? "selected" : '' ?>>Derecho de
                                    Propiedad Intelectual</option>
                            </select>
                        </div>
                    <?php endif ?>

                    <?php if ($_SESSION["rol"] == "enfermero"): ?>
                        <div class="w-full">
                            <label for="especializacion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especialización</label>
                            <select name="especializacion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Escoge una especialización</option>
                                <option value="cuidados_criticos" <?php echo $profesionalC->especializacion === "cuidados_criticos" ? "selected" : '' ?>>Cuidados críticos
                                </option>
                                <option value="pediatrica" <?php echo $profesionalC->especializacion === "pediatrica" ? "selected" : '' ?>>Pediátrica</option>
                                <option value="geriatrica" <?php echo $profesionalC->especializacion === "geriatrica" ? "selected" : '' ?>>Geriátrica</option>
                                <option value="salud_mental" <?php echo $profesionalC->especializacion === "salud_mental" ? "selected" : '' ?>>Salud mental</option>
                                <option value="oncologica" <?php echo $profesionalC->especializacion === "oncologica" ? "selected" : '' ?>>Oncológica</option>
                                <option value="salud_comunitaria" <?php echo $profesionalC->especializacion === "salud_comunitaria" ? "selected" : '' ?>>Salud comunitaria
                                </option>
                                <option value="obstetrica_ginecologica" <?php echo $profesionalC->especializacion === "obstetrica_ginecologica" ? "selected" : '' ?>>Obstétrica y
                                    ginecológica</option>
                                <option value="emergencias" <?php echo $profesionalC->especializacion === "emergencias" ? "selected" : '' ?>>Emergencias</option>
                                <option value="anestesia" <?php echo $profesionalC->especializacion === "anestesia" ? "selected" : '' ?>>Anestesia</option>
                                <option value="nefrologica" <?php echo $profesionalC->especializacion === "nefrologica" ? "selected" : '' ?>>Nefrológica</option>
                                <option value="cardiovascular" <?php echo $profesionalC->especializacion === "cardiovascular" ? "selected" : '' ?>>Cardiovascular</option>
                                <option value="rehabilitacion" <?php echo $profesionalC->especializacion === "rehabilitacion" ? "selected" : '' ?>>Rehabilitación</option>
                                <option value="cuidados_paliativos" <?php echo $profesionalC->especializacion === "cuidados_paliativos" ? "selected" : '' ?>>Cuidados
                                    paliativos</option>
                                <option value="investigacion_clinica" <?php echo $profesionalC->especializacion === "investigacion_clinica" ? "selected" : '' ?>>Investigación
                                    clínica</option>
                                <option value="gestion_administracion_salud" <?php echo $profesionalC->especializacion === "gestion_administracion_salud" ? "selected" : '' ?>>Gestión
                                    y administración de servicios de salud</option>
                                <option value="quirurgica" <?php echo $profesionalC->especializacion === "quirurgica" ? "selected" : '' ?>>Quirúrgica</option>
                                <option value="trasplantes" <?php echo $profesionalC->especializacion === "trasplantes" ? "selected" : '' ?>>Trasplantes</option>
                                <option value="salud_ocupacional" <?php echo $profesionalC->especializacion === "salud_ocupacional" ? "selected" : '' ?>>Salud ocupacional
                                </option>
                                <option value="forense" <?php echo $profesionalC->especializacion === "forense" ? "selected" : '' ?>>Forense</option>
                                <option value="cuidados_domiciliarios" <?php echo $profesionalC->especializacion === "cuidados_domiciliarios" ? "selected" : '' ?>>Cuidados
                                    domiciliarios</option>

                            </select>
                        </div>
                    <?php endif ?>

                    <?php if ($_SESSION["rol"] == "psicologo"): ?>
                        <div class="w-full">
                            <label for="especializacion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especialización</label>
                            <select name="especializacion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Escoge una especialización</option>
                                <option value="clinica" <?php echo $profesionalC->especializacion === "clinica" ? "selected" : '' ?>>Clínica</option>
                                <option value="educativa" <?php echo $profesionalC->especializacion === "educativa" ? "selected" : '' ?>>Educativa</option>
                                <option value="organizacional" <?php echo $profesionalC->especializacion === "organizacional" ? "selected" : '' ?>>Organizacional</option>
                                <option value="deporte" <?php echo $profesionalC->especializacion === "deporte" ? "selected" : '' ?>>Deporte</option>
                                <option value="social" <?php echo $profesionalC->especializacion === "social" ? "selected" : '' ?>>Social</option>
                                <option value="juridica" <?php echo $profesionalC->especializacion === "juridica" ? "selected" : '' ?>>Jurídica</option>
                                <option value="neuropsicologia" <?php echo $profesionalC->especializacion === "neuropsicologia" ? "selected" : '' ?>>Neuropsicología</option>
                                <option value="psicoterapia" <?php echo $profesionalC->especializacion === "psicoterapia" ? "selected" : '' ?>>Psicoterapia</option>
                                <option value="infantil" <?php echo $profesionalC->especializacion === "infantil" ? "selected" : '' ?>>Infantil</option>
                                <option value="adolescente" <?php echo $profesionalC->especializacion === "adolescente" ? "selected" : '' ?>>Adolescente</option>
                                <option value="forense" <?php echo $profesionalC->especializacion === "forense" ? "selected" : '' ?>>Forense</option>
                                <option value="emergencias" <?php echo $profesionalC->especializacion === "emergencias" ? "selected" : '' ?>>Emergencias</option>
                                <option value="salud_mental" <?php echo $profesionalC->especializacion === "salud_mental" ? "selected" : '' ?>>Salud Mental</option>
                                <option value="gerontologia" <?php echo $profesionalC->especializacion === "gerontologia" ? "selected" : '' ?>>Gerontología</option>
                                <option value="violencia_familiar" <?php echo $profesionalC->especializacion === "violencia_familiar" ? "selected" : '' ?>>Violencia
                                    Familiar</option>
                                <option value="adicciones" <?php echo $profesionalC->especializacion === "adicciones" ? "selected" : '' ?>>Adicciones</option>
                                <option value="sexologia" <?php echo $profesionalC->especializacion === "sexologia" ? "selected" : '' ?>>Sexología</option>
                                <option value="psicologia_experimental" <?php echo $profesionalC->especializacion === "psicologia_experimental" ? "selected" : '' ?>>Psicología
                                    Experimental</option>
                                <option value="psicologia_ambiental" <?php echo $profesionalC->especializacion === "psicologia_ambiental" ? "selected" : '' ?>>Psicología
                                    Ambiental</option>
                            </select>
                        </div>
                    <?php endif ?>


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
                            <input type="text" id="phone-input" aria-describedby="helper-text-explanation" name="telefono"
                                value="<?php echo s($profesionalC->telefono) ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                pattern="3(0[0-5]|1[0-9]|2[0-9]|5[0-1])[0-9]{7}" placeholder="3234567890" required />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Haz
                            una
                            descripción de tu perfil</label>
                        <textarea id="message" rows="4" name="descripcion"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Haz tu descripcion..."><?php echo $profesionalC->descripcion ?></textarea>
                    </div>
                    <!-- <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="archivo">Archivos
                            relacionados con tu perfil</label>
                        <input name="archivo"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" type="file">
                    </div> -->

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
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $fechaFormateada = date("d/m/Y", strtotime($usuario->fecha_nacimiento)); ?>"
                            disabled>
                    </div>

                    <div class="w-full">
                        <label for="sexo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                        <input type="text" id="disabled-input" aria-label="disabled input"
                            class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?php echo $usuario->sexo ?>" disabled>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit" name="actulizarImagen"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Actualizar Imagen
                        </button>
                    </div>
            </form>
            <button
                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                type="button" data-drawer-target="drawer-timepicker" data-drawer-show="drawer-timepicker"
                aria-controls="drawer-timepicker">
                Mi horario
            </button>
        <?php endif ?>
    </div>
</section>

<div id="drawer-timepicker"
    class="fixed top-0 left-0 z-50 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-96 dark:bg-gray-800"
    tabindex="-1" aria-labelledby="drawer-timepicker-label">
    <h5 id="drawer-label"
        class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Time
        schedule</h5>
    <button type="button" data-drawer-hide="drawer-timepicker" aria-controls="drawer-timepicker"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form method="POST">
        <!-- <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-600 dark:bg-gray-700 mb-6">
            <div class="flex justify-between items-center mb-3">
                <span class="text-gray-900 dark:text-white text-base font-medium">Business hours</span>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" name="business-hours" class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-600 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="sr-only">Business hours</span>
                </label>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-normal">Enable or disable business working hours for
                all weekly working days</p>
        </div> -->

        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-[4rem]">
                    <input id="monday" name="days[]" type="checkbox" value="monday" <?php if (in_array('monday', $diasCheck)) {
                        echo 'checked';
                    } ?>
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="monday" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Lun</label>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="start-time-monday" class="sr-only">Start time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="start-time-monday" name="start-time-monday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="07:00" max="20:00" value="<?php if (isset($horarios_por_dia['monday'])) {
                                // Si existe 'monday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['monday']->start_time) ? $horarios_por_dia['monday']->start_time : "07:00";
                            } else {
                                echo "07:00"; // Valor predeterminado si no existe 'monday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="end-time-monday" class="sr-only">End time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="end-time-monday" name="end-time-monday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="08:00" max="21:00" value="<?php if (isset($horarios_por_dia['monday'])) {
                                // Si existe 'monday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['monday']->end_time) ? $horarios_por_dia['monday']->end_time : "07:00";
                            } else {
                                echo "20:00"; // Valor predeterminado si no existe 'monday'
                            }
                            ; ?>" />
                    </div>
                </div>

            </div>
        </div>
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-[4rem]">
                    <input id="tuesday" name="days[]" type="checkbox" value="tuesday" <?php if (in_array('tuesday', $diasCheck)) {
                        echo 'checked';
                    } ?>
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="tuesday" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mar</label>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="start-time-tuesday" class="sr-only">Start time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="start-time-tuesday" name="start-time-tuesday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="07:00" max="20:00" value="<?php if (isset($horarios_por_dia['tuesday'])) {
                                // Si existe 'tuesday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['tuesday']->start_time) ? $horarios_por_dia['tuesday']->start_time : "07:00";
                            } else {
                                echo "07:00"; // Valor predeterminado si no existe 'tuesday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="end-time-tuesday" class="sr-only">End time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="end-time-tuesday" name="end-time-tuesday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="08:00" max="21:00" value="<?php if (isset($horarios_por_dia['tuesday'])) {
                                // Si existe 'tuesday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['tuesday']->end_time) ? $horarios_por_dia['tuesday']->end_time : "07:00";
                            } else {
                                echo "20:00"; // Valor predeterminado si no existe 'tuesday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <!-- <div>
                    <button type="button"
                        class="inline-flex items-center p-1.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Delete</span>
                    </button>
                </div> -->
            </div>
        </div>
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-[4rem]">
                    <input id="wednesday" name="days[]" type="checkbox" value="wednesday" <?php if (in_array('wednesday', $diasCheck)) {
                        echo 'checked';
                    } ?>
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="wednesday" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mie</label>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="start-time-wednesday" class="sr-only">Start time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="start-time-wednesday" name="start-time-wednesday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="07:00" max="20:00" value="<?php if (isset($horarios_por_dia['wednesday'])) {
                                // Si existe 'wednesday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['wednesday']->start_time) ? $horarios_por_dia['wednesday']->start_time : "07:00";
                            } else {
                                echo "07:00"; // Valor predeterminado si no existe 'wednesday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="end-time-wednesday" class="sr-only">End time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="end-time-wednesday" name="end-time-wednesday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="08:00" max="21:00" value="<?php if (isset($horarios_por_dia['wednesday'])) {
                                // Si existe 'wednesday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['wednesday']->end_time) ? $horarios_por_dia['wednesday']->end_time : "07:00";
                            } else {
                                echo "20:00"; // Valor predeterminado si no existe 'wednesday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <!-- <div>
                    <button type="button"
                        class="inline-flex items-center p-1.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Delete</span>
                    </button>
                </div> -->
            </div>
        </div>
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-[4rem]">
                    <input id="thursday" name="days[]" type="checkbox" value="thursday" <?php if (in_array('thursday', $diasCheck)) {
                        echo 'checked';
                    } ?>
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="thursday" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jue</label>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="start-time-thursday" class="sr-only">Start time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="start-time-thursday" name="start-time-thursday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="07:00" max="20:00" value="<?php if (isset($horarios_por_dia['thursday'])) {
                                // Si existe 'thursday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['thursday']->start_time) ? $horarios_por_dia['thursday']->start_time : "07:00";
                            } else {
                                echo "07:00"; // Valor predeterminado si no existe 'thursday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="end-time-thursday" class="sr-only">End time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="end-time-thursday" name="end-time-thursday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="08:00" max="21:00" value="<?php if (isset($horarios_por_dia['thursday'])) {
                                // Si existe 'thursday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['thursday']->end_time) ? $horarios_por_dia['thursday']->end_time : "07:00";
                            } else {
                                echo "20:00"; // Valor predeterminado si no existe 'thursday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <!-- <div>
                    <button type="button"
                        class="inline-flex items-center p-1.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Delete</span>
                    </button>
                </div> -->
            </div>
        </div>
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-[4rem]">
                    <input id="friday" name="days[]" type="checkbox" value="friday" <?php if (in_array('friday', $diasCheck)) {
                        echo 'checked';
                    } ?>
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="friday" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vie</label>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="start-time-friday" class="sr-only">Start time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="start-time-friday" name="start-time-friday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="07:00" max="20:00" value="<?php if (isset($horarios_por_dia['firday'])) {
                                // Si existe 'firday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['firday']->start_time) ? $horarios_por_dia['firday']->start_time : "07:00";
                            } else {
                                echo "07:00"; // Valor predeterminado si no existe 'firday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="end-time-friday" class="sr-only">End time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="end-time-friday" name="end-time-friday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="08:00" max="21:00" value="<?php if (isset($horarios_por_dia['firday'])) {
                                // Si existe 'firday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['firday']->end_time) ? $horarios_por_dia['firday']->end_time : "07:00";
                            } else {
                                echo "20:00"; // Valor predeterminado si no existe 'firday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <!-- <div>
                    <button type="button"
                        class="inline-flex items-center p-1.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Delete</span>
                    </button>
                </div> -->
            </div>
        </div>
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-[4rem]">
                    <input id="saturday" name="days[]" type="checkbox" value="saturday" <?php if (in_array('saturday', $diasCheck)) {
                        echo 'checked';
                    } ?>
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="saturday" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sáb</label>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="start-time-saturday" class="sr-only">Start time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="start-time-saturday" name="start-time-saturday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="07:00" max="20:00" value="<?php if (isset($horarios_por_dia['saturday'])) {
                                // Si existe 'saturday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['saturday']->start_time) ? $horarios_por_dia['saturday']->start_time : "07:00";
                            } else {
                                echo "07:00"; // Valor predeterminado si no existe 'saturday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="end-time-saturday" class="sr-only">End time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="end-time-saturday" name="end-time-saturday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="08:00" max="21:00" value="<?php if (isset($horarios_por_dia['saturday'])) {
                                // Si existe 'saturday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['saturday']->end_time) ? $horarios_por_dia['saturday']->end_time : "07:00";
                            } else {
                                echo "20:00"; // Valor predeterminado si no existe 'saturday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <!-- <div>
                    <button type="button"
                        class="inline-flex items-center p-1.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Delete</span>
                    </button>
                </div> -->
            </div>
        </div>
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-[4rem]">
                    <input id="sunday" name="days[]" type="checkbox" value="sunday" <?php if (in_array('sunday', $diasCheck)) {
                        echo 'checked';
                    } ?>
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="sunday" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dom</label>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="start-time-sunday" class="sr-only">Start time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="start-time-sunday" name="start-time-sunday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="07:00" max="20:00" value="<?php if (isset($horarios_por_dia['sunday'])) {
                                // Si existe 'sunday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['sunday']->start_time) ? $horarios_por_dia['sunday']->start_time : "07:00";
                            } else {
                                echo "07:00"; // Valor predeterminado si no existe 'sunday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <div class="w-full max-w-[7rem]">
                    <label for="end-time-sunday" class="sr-only">End time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="end-time-sunday" name="end-time-sunday"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="08:00" max="21:00" value="<?php if (isset($horarios_por_dia['sunday'])) {
                                // Si existe 'sunday', verificar si tiene la propiedad 'start_time'
                                echo isset($horarios_por_dia['sunday']->end_time) ? $horarios_por_dia['sunday']->end_time : "07:00";
                            } else {
                                echo "20:00"; // Valor predeterminado si no existe 'sunday'
                            }
                            ; ?>" />
                    </div>
                </div>
                <!-- <div>
                    <button type="button"
                        class="inline-flex items-center p-1.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Delete</span>
                    </button>
                </div> -->
            </div>
        </div>
        <!-- <button type="button"
            class="inline-flex items-center justify-center w-full py-2.5 mb-4 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
            </svg>
            Add interval
        </button> -->
        <div class="grid grid-cols-2 gap-4 bottom-4 left-0 w-full md:px-4 ">
            <button type="button" data-drawer-hide="drawer-timepicker"
                class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
            <button type="submit" name="guardarHorario"
                class="text-white w-full inline-flex items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Save all
            </button>
        </div>
    </form>
</div>