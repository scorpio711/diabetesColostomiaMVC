<link rel="stylesheet" href="/public/build/css/encuesta.css" />
<main class="container mx-auto max-w-7xl p-4 md:pt-12 mt-6">
    <h1
        class="text-4xl font-bold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white text-center mt-8">
        ¿Qué haces cuándo?</h1>
    <div class="grid grid-cols-4 mt-8">
        <div class="grid grid-rows-2 col-span-2">
            <!-- Primera fila -->
            <div class="flex justify-center items-center mb-4 ">

                <div
                    class="card ml-24 mb-6 shadow-md shadow-green-500/20 col-span-full  xl:col-span-3 overflow-hidden relative p-8 rounded-3xl bg-white border border-blue-300 dark:border-gray-800 dark:bg-gray-900">
                    <p id="pregunta" class="dark:text-gray-300 text-gray-700 text-center"></p>

                    <div class="buttons">
                        <button id="prev-tab" href="/public/blog"
                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                            Volver
                        </button>
                        <button href="/public/blog" id="next-tab"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Siguiente
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>

                    </div>
                </div>
            </div>

            <!-- Segunda fila -->
            <div class="relative ml-20">
                <img src="/public/build/img/Pregunta 1.png" alt="pregunta 1"
                    class="h-[17rem] xl:h-[20rem] z-40 absolute bottom-4">
                <img src="/public/build/img/Pregunta 2.png" alt="pregunta 2"
                    class="h-[17rem] xl:h-[20rem] z-30 absolute left-[4.5rem] xl:left-24 bottom-4">
                <img src="/public/build/img/Pregunta 3.png" alt="pregunta 3"
                    class="h-[17rem] xl:h-[20rem] z-20 absolute left-[8.5rem] xl:left-48 bottom-4">
                <img src="/public/build/img/Pregunta 4.png" alt="pregunta 4"
                    class="h-[17rem] xl:h-[20rem] z-10 absolute left-[13rem] xl:left-[18rem] bottom-4">
                <img src="/public/build/img/Pregunta 5.png" alt="pregunta 5"
                    class="h-[17rem] xl:h-[20rem] z-0 absolute  left-[16.5rem] xl:left-[23rem] bottom-4">
            </div>
        </div>

        <!-- parte derecha -->
        <div class="col-start-3 col-span-2">
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
                <form method="POST">
                    <div class="hidden rounded-lg " id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="pb-8 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                conocimiento</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dificultades
                                economicas</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de
                                motivación</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de apoyo del
                                equipo de salud</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-4"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Falta de apoyo de
                                cuidadores y familiares</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>

                    </div>
                    <div class="hidden rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                nervioso</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                irritado</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                alegre</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                melancólico</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-4"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                optimista</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div class="hidden rounded-lg" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                nervioso</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                irritado</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                alegre</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                melancólico</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-4"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                optimista</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div class="hidden rounded-lg" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                nervioso</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                irritado</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                alegre</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                melancólico</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-4"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                optimista</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div class="hidden rounded-lg" id="pregunta5" role="tabpanel" aria-labelledby="pregunta5-tab">
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                nervioso</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                irritado</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                alegre</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-3"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                melancólico</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                        <div class="pb-8 md:px-8">
                            <label for="steps-range-4"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me
                                siento
                                optimista</label>
                            <input class="steps-range" type="range" min="0" max="100" value="50">
                        </div>
                    </div>
                    <!-- <button type="submit" name="encuesta"
                    class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Subir</button> -->
                </form>
            </div>
        </div>
    </div>

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
                    id="contacts-tab" data-tabs-target="#pregunta5" type="button" role="tab" aria-controls="pregunta5"
                    aria-selected="false">Contacts</button>
            </li>
        </ul>
    </div>

    <div class="flex justify-between mb-4">

    </div>

</main>

<script src="/public/build/js/encuesta.js"></script>