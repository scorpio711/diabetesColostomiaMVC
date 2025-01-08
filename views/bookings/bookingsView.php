<div id="agendarCita" class="py-20 mx-auto max-w-screen-xl px-4 md:px-8">
    <div>
        <h1 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
            Agenda una <span
                class="text-transparent bg-clip-text bg-gradient-to-r to-green-500 from-blue-800 dark:from-green-400 dark:to-lime-500">Cita:</span>
        </h1>

        <ol class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
            <li class="flex items-center text-green-600 dark:text-green-500 space-x-2.5 rtl:space-x-reverse">
                <span
                    class="flex items-center justify-center w-8 h-8 border border-green-600 rounded-full shrink-0 dark:border-green-500">
                    1
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Servicio</h3>
                    <p class="text-sm">Step details here</p>
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

    </div>


    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400"
            id="tabs-example" role="tablist">
            <li class="me-2" role="presentation">
                <button
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                    id="profile-tab-example" type="button" role="tab" aria-controls="profile-example"
                    aria-selected="false">
                    Profile
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                    id="dashboard-tab-example" type="button" role="tab" aria-controls="dashboard-example"
                    aria-selected="false">
                    Dashboard
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                    id="settings-tab-example" type="button" role="tab" aria-controls="settings-example"
                    aria-selected="false">
                    Settings
                </button>
            </li>
            <li role="presentation">
                <button
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                    id="contacts-tab-example" type="button" role="tab" aria-controls="contacts-example"
                    aria-selected="false">
                    Contacts
                </button>
            </li>
        </ul>
    </div>
    <div id="tabContentExample">
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="profile-example" role="tabpanel"
            aria-labelledby="profile-tab-example">
            <div id="servicios"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-8 lg:gap-x-8 lg:gap-y-12"></div>
        </div>
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="dashboard-example" role="tabpanel"
            aria-labelledby="dashboard-tab-example">

            <div id="profesionales"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-8 lg:gap-x-8 lg:gap-y-12">

            </div>


        </div>
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="settings-example" role="tabpanel"
            aria-labelledby="settings-tab-example">

            <!-- <h2 class="text-xl text-gray-900 dark:text-white font-bold mb-2">Digital Transformation</h2>
            <div class="flex items-center space-x-4 rtl:space-x-reverse mb-3">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 dark:text-white text-base font-medium">30.06.2024</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 dark:text-white text-base font-medium">California, USA</span>
                </div>
            </div> -->
            <div class="flex items-start space-x-4 rtl:space-x-reverse mb-5">
                <div>
                    <div class="text-base font-normal text-gray-500 dark:text-gray-400 mb-2">Participantes</div>
                    <div class="flex -space-x-4 rtl:space-x-reverse">
                        <img class="w-8 h-8 border border-white rounded-full dark:border-gray-800"
                            src="/docs/images/people/profile-picture-5.jpg" alt="">
                        <img class="w-8 h-8 border border-white rounded-full dark:border-gray-800"
                            src="/docs/images/people/profile-picture-2.jpg" alt="">
                        <img class="w-8 h-8 border border-white rounded-full dark:border-gray-800"
                            src="/docs/images/people/profile-picture-3.jpg" alt="">
                        <a class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border border-white rounded-full hover:bg-gray-600 dark:border-gray-800"
                            href="#">+99</a>
                    </div>
                </div>
                <div>
                    <div class="text-base font-normal text-gray-500 dark:text-gray-400 mb-3">Duración</div>
                    <span class="text-gray-900 dark:text-white text-base font-medium block">30 min</span>
                </div>
                <div>
                    <div class="text-base font-normal text-gray-500 dark:text-gray-400 mb-3">Tipo de reunión</div>
                    <span class="text-gray-900 dark:text-white text-base font-medium block">Web conference</span>
                </div>
            </div>
            <div
                class="pt-5 border-t border-gray-200 dark:border-gray-800 flex sm:flex-row flex-col sm:space-x-5 rtl:space-x-reverse">
                <div id="horario"></div>
                <div
                    class="sm:ms-7 sm:ps-5 sm:border-s border-gray-200 dark:border-gray-800 w-full sm:max-w-[15rem] mt-5 sm:mt-0">
                    <h3 class="text-gray-900 dark:text-white text-base font-medium mb-3 text-center">Wednesday 30 June
                        2024</h3>
                    <button type="button" data-collapse-toggle="timetable"
                        class="inline-flex items-center w-full py-2 px-5 me-2 justify-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg class="w-4 h-4 text-gray-800 dark:text-white me-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                clip-rule="evenodd" />
                        </svg>
                        Escoge una hora
                    </button>
                    <label class="sr-only">
                        Escoge una hora
                    </label>
                    <ul id="timetable" class="grid w-full grid-cols-2 gap-2 mt-5">
                        <li>
                            <input type="radio" id="10-am" value="" class="hidden peer" name="timetable">
                            <label for="10-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                10:00 AM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="10-30-am" value="" class="hidden peer" name="timetable">
                            <label for="10-30-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                10:30 AM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="11-am" value="" class="hidden peer" name="timetable">
                            <label for="11-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                11:00 AM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="11-30-am" value="" class="hidden peer" name="timetable">
                            <label for="11-30-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                11:30 AM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="12-am" value="" class="hidden peer" name="timetable" checked>
                            <label for="12-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                12:00 AM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="12-30-pm" value="" class="hidden peer" name="timetable">
                            <label for="12-30-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                12:30 PM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="1-pm" value="" class="hidden peer" name="timetable">
                            <label for="1-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                01:00 PM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="1-30-pm" value="" class="hidden peer" name="timetable">
                            <label for="1-30-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                01:30 PM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="2-pm" value="" class="hidden peer" name="timetable">
                            <label for="2-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                02:00 PM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="2-30-pm" value="" class="hidden peer" name="timetable">
                            <label for="2-30-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                02:30 PM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="3-pm" value="" class="hidden peer" name="timetable">
                            <label for="3-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                03:00 PM
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="3-30-pm" value="" class="hidden peer" name="timetable">
                            <label for="3-30-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 dark:hover:text-white dark:border-blue-500 dark:peer-checked:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white peer-checked:text-white hover:bg-blue-500 dark:text-blue-500 dark:bg-gray-900 dark:hover:bg-blue-600 dark:hover:border-blue-600 dark:peer-checked:bg-blue-500">
                                03:30 PM
                            </label>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="contacts-example" role="tabpanel"
            aria-labelledby="contacts-tab-example">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                This is some placeholder content the
                <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                Clicking another tab will toggle the visibility of this one for
                the next. The tab JavaScript swaps classes to control the content
                visibility and styling.
            </p>
        </div>
    </div>
    <div class="mt-4 ml-4">
        <button id="atras"
            class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800">
            <span
                class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Atras
            </span>
        </button>

        <button id="siguiente"
            class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
            <span
                class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                siguiente
            </span>
        </button>
    </div>

</div>

<!-- alertas -->
<div>
    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Ya tienes una cita agendada
                    </h3>

                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Estimado usuario,
                    </p>
                    <p id="mensaje-cita" class="text-base leading-relaxed text-gray-500 dark:text-gray-400">


                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Gracias por tu comprensión.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <a href="/public">
                        <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ir al inicio</button>
                    </a>
                    <a href="/public/misCitas">
                        <button type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Mis
                            citas</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module" src="/public/build/js/bookings.js"></script>
<script src="/public/build/types/bookings.js"></script>


 