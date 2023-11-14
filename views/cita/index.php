<?php

$script = "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src ='/public/build/js/app.js'></script>
";
?>

<div class="bg-white dark:bg-gray-900 py-20 mx-auto max-w-screen-xl px-4 md:px-8">
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Servicios</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Informacion</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="resumen-tab" data-tabs-target="#resumen" type="button" role="tab" aria-controls="resumen"
                    onclick="mostrarResumen()" aria-selected="false">Resumen</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
            aria-labelledby="profile-tab">

            <div id="servicios" class="grid grid-cols-2 gap-x-4 gap-y-8 md:grid-cols-3 lg:gap-x-8 lg:gap-y-12"></div>

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