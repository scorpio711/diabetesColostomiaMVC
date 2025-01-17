<link rel="stylesheet" href="/public/build/css/encuesta.css" />
<main class="container mx-auto max-w-7xl p-4 md:pt-12 mt-6">
    <h1
        class="text-4xl font-bold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white text-center mt-8">
        ¿Qué haces cuándo?</h1>
    <form method="POST">
        <div class="flex flex-col lg:grid grid-rows-2 grid-col-2 md:grid-cols-4 lg:grid-rows-1 mt-8">
            <div class="lg:grid grid-rows-2 col-span-4 lg:col-span-2">

                <!-- Primera fila -->
                <div class="flex justify-center items-center mb-4 ">

                    <div
                        class="card lg:ml-24 mb-6 shadow-md shadow-green-500/20 col-span-full  xl:col-span-3 overflow-hidden relative p-8 rounded-3xl bg-white border border-blue-300 dark:border-gray-800 dark:bg-gray-900">
                        <p id="pregunta" class="dark:text-gray-300 text-gray-700 text-center"></p>

                        <div class="buttons">
                            <button type="button" id="prev-tab" href="/public/blog"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                                </svg>
                                Volver
                            </button>
                            <button type="button" href="/public/blog" id="next-tab"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Siguiente
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </button>
                            <button type="submit" id="finalizar-tab" name="finalizar"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 hidden">Finalizar</button>
                        </div>
                    </div>
                </div>

                <!-- Segunda fila -->
                <div class="relative flex flex-row justify-center">
                    <img src="/public/build/img/derecho1.png" alt="pregunta 1"
                        class="img-1 h-16 lg:h-[17rem] xl:h-[20rem] z-[8] lg:absolute left-[0] bottom-4">
                    <img src="/public/build/img/derecho2.png" alt="pregunta 2"
                        class="img-2 h-16 lg:h-[17rem] xl:h-[20rem] z-[7] lg:absolute lg:left-[4.5rem] xl:left-24 bottom-4">
                    <img src="/public/build/img/derecho3.png" alt="derecho3"
                        class="img-3 h-16 lg:h-[17rem] xl:h-[20rem] z-[6] lg:absolute lg:left-[8.5rem] xl:left-[11rem] bottom-4">
                    <img src="/public/build/img/derecho4.png" alt="derecho4"
                        class="img-4 h-16 lg:h-[17rem] xl:h-[20rem] z-[5] lg:absolute lg:left-[13rem] xl:left-[16rem] bottom-4">
                    <img src="/public/build/img/derecho5.png" alt="derecho5"
                        class="img-5 h-16 lg:h-[17rem] xl:h-[20rem] z-[4] lg:absolute lg:left-[18rem] xl:left-[21.5rem] bottom-4">
                    <img src="/public/build/img/derecho5.png" alt="derecho6"
                        class="img-5 h-16 lg:h-[17rem] xl:h-[20rem] z-0 lg:absolute lg:left-[23rem] xl:left-[27rem] bottom-4">
                </div>
            </div>

            <!-- parte derecha -->
            <div class="lg:col-start-3 col-span-4 lg:col-span-2">
                <div class="text-left md:px-8">

                    <div class="grid grid-cols-4 w-full mt-4">
                        <div class="flex  justify-center items-end">
                            <p class="text-base font-medium text-gray-900 dark:text-white">Nunca</p>
                        </div>
                        <div class="flex justify-center items-end">
                            <p class="text-base font-medium text-gray-900 dark:text-white">Pocas <br>Veces</p>
                        </div>
                        <div class="flex justify-center items-end">
                            <p class="text-base font-medium text-gray-900 dark:text-white">Frecuentemente</p>

                        </div>
                        <div class="flex justify-center items-end">
                            <p class="text-base font-medium text-gray-900 dark:text-white">Siempre</p>
                        </div>

                        <div id="estrellaVerde" class="flex  justify-center">
                            <img src="/public/build/img/Estrellaverde-02.png" alt="estrella verde" class="h-16">
                        </div>
                        <div id="estrellaAmarilla" class="flex justify-center">
                            <img src="/public/build/img/Estrellaamarilla-02.png" alt="estrella amarilla" class="h-16">
                        </div>
                        <div id="estrellaNaranja" class="flex justify-center">
                            <img src="/public/build/img/Estrellanaranja-02.png" alt="estrella naranja" class="h-16">
                        </div>
                        <div id="estrellaRoja" class="flex justify-center">
                            <img src="/public/build/img/Estrellarojo-02.png" alt="estrella roja" class="h-16">
                        </div>
                    </div>
                </div>
                <div id="default-tab-content">

                    <div class="hidden rounded-lg " id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="pb-12 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                conocimiento</label>
                            <input name="fundamental[1]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dificultades
                                económicas para la asesoría</label>
                            <input name="fundamental[2]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de apoyo de
                                un grupo asesor</label>
                            <input name="fundamental[3]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de apoyo de
                                organismos de control y/o entes territoriales</label>
                            <input name="fundamental[4]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div class="hidden rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                conocimiento</label>
                            <input name="salud[1]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de cobertura
                                en el Plan Básico Beneficios en Salud - PBS</label>
                            <input name="salud[2]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                conocimiento en la Ruta de Atención</label>
                            <input name="salud[3]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de apoyo
                                institucional</label>
                            <input name="salud[4]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div class="hidden rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                conocimiento</label>
                            <input name="peticion[1]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dificultades
                                económicas para una asesoría</label>
                            <input name="peticion[2]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Falta de
                                conocimiento en la ruta de radicación</label>
                            <input name="peticion[3]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rapidez en la
                                respuesta de la solicitud
                            </label>
                            <input name="peticion[4]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div class="hidden rounded-lg" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                conocimiento</label>
                            <input name="proceso[1]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dificultades en la
                                atención</label>
                            <input name="proceso[2]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de apoyo en
                                la asesoría jurídica</label>
                            <input name="proceso[3]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dificultades en el
                                término de respuesta </label>
                            <input name="proceso[4]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-4"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dificultades en el
                                trámite de las peticiones quejas y reclamos ante la Superintendencia de Salud</label>
                            <input name="proceso[5]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div class="hidden rounded-lg" id="pregunta5" role="tabpanel" aria-labelledby="pregunta5-tab">
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                conocimiento</label>
                            <input name="tutela[1]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dificultades
                                económicas para la asesoría</label>
                            <input name="tutela[2]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                conocimiento en la ruta de su trámite</label>
                            <input name="tutela[3]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-12 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de apoyo de
                                entidades públicas como Personerías, Alcaldías, Inspecciones de Polícia para realizar la
                                acción de Tutela</label>
                            <input name="tutela[4]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div class="hidden rounded-lg" id="pregunta6" role="tabpanel" aria-labelledby="pregunta6-tab">
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trato con los
                                funcionarios de la Salud</label>
                            <input name="dignidad[1]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suministro de
                                materiales médicos</label>
                            <input name="dignidad[2]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suministro de
                                medicamentos para tratamientos</label>
                            <input name="dignidad[3]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servicios Médicos
                                Especializados</label>
                            <input name="dignidad[4]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-4"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Acompañamiento
                                emocional del paciente y su familia.</label>
                            <input name="dignidad[5]" class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700 hidden">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Dashboard</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
                    aria-selected="false">Settings</button>
            </li>
            <li role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts"
                    aria-selected="false">Contacts</button>
            </li>
            <li role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="pregunta5" data-tabs-target="#pregunta5" type="button" role="tab" aria-controls="pregunta5"
                    aria-selected="false">Contacts</button>
            </li>
            <li role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="pregunta6" data-tabs-target="#pregunta6" type="button" role="tab" aria-controls="pregunta6"
                    aria-selected="false">Contacts</button>
            </li>
        </ul>
    </div>

    <div class="flex justify-between mb-4">

    </div>
    <!-- Alertas -->
    <!-- Main modal -->
    <div id="modalEl" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between rounded-t border-b p-5 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white lg:text-2xl">
                        ¡Encuesta Completada!
                    </h3>

                </div>
                <!-- Modal body -->
                <div class="space-y-6 p-6">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Gracias por responder todas las preguntas. Por el momento, no es posible realizar la encuesta
                        nuevamente. En el futuro, se te invitará a responder una nueva encuesta para evaluar tu
                        progreso. ¡Te agradecemos por tu tiempo y participación!
                    </p>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                    <a href="/public/">
                        <button
                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ir al inicio
                        </button></a>

                </div>
            </div>
        </div>
    </div>
</main>

<script src="/public/build/js/encuestaJuridica.js"></script>
<?php if ($encuestaHabilitada == 1): ?>
    <script src="/public/build/types/encuestas.js"></script>
<?php endif; ?>