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
                        <input type="text"  name="nombre" 
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
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Acutalizar Imagen
                        </button>
                    </div>
            </form>
        <?php endif ?>
    </div>
</section>