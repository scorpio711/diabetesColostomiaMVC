<?php

$script = "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src ='/public/build/js/app.js'></script>
";
?>


<div class="py-20 mx-auto max-w-screen-xl px-4 md:px-8">
    <div class="py-8">
        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">Bienvenido a
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-blue-500">Citas</span>
        </h1>
        <p class="text-lg text-gray-500 lg:text-xl dark:text-gray-400">
            Por favor seleciona la cita y completa los pasos</p>
    </div>

    <ol class="items-center w-full space-y-4 pb-3 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
        <li class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
            <span
                class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                1
            </span>
            <span>
                <h3 class="font-medium leading-tight">Escoge tu servicio</h3>
                <p class="text-sm">Da click en una tarjeta</p>
            </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
            <span
                class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                2
            </span>
            <span>
                <h3 class="font-medium leading-tight">Company info</h3>
                <p class="text-sm">Step details here</p>
            </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
            <span
                class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                3
            </span>
            <span>
                <h3 class="font-medium leading-tight">Payment info</h3>
                <p class="text-sm">Step details here</p>
            </span>
        </li>
    </ol>


    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist"
            data-tabs-active-classes="text-purple-700 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
            data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300">

            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Servicios</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Informacion</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="resumen-tab" data-tabs-target="#resumen" type="button" role="tab" aria-controls="resumen"
                    onclick="mostrarResumen()" aria-selected="false">Resumen</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
            aria-labelledby="profile-tab">

            <div id="servicios"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-8 lg:gap-x-8 lg:gap-y-12"></div>

        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
            aria-labelledby="dashboard-tab">
            <div id="alertas"></div>
            <form>
                <input type="text" id="id" name="id" class="hidden" value="<?php echo $id ?>">

                <div class="w-full mb-2">
                    <label for="escolaridad"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="nombre" aria-label="disabled input" name="escolaridad"
                        class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="<?php echo $nombre ?>" disabled>
                </div>

                <div class="grid md:gap-6 mb-4 md:grid-cols-2">
                    <div>
                        <label for="fecha"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                        <input type="date" id="fecha" min="<?php echo date("Y-m-d", strtotime("+1 day")) ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Doe" required>
                    </div>
                    <div>
                        <label for="hora" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escoge
                            una Hora</label>
                        <input type="time" id="hora" step="3600"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                </div>
            </form>
        </div>

        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="resumen" role="tabpanel"
            aria-labelledby="resumen-tab">
            <div id="alertaResumen"></div>
        </div>
    </div>
</div>