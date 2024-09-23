<div id="agendarCita" class="py-20 mx-auto max-w-screen-xl px-4 md:px-8">
    <div>
        <h1 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
            Agenda una <span
                class="text-transparent bg-clip-text bg-gradient-to-r to-green-500 from-blue-800 dark:from-green-400 dark:to-lime-500">Cita:</span>
        </h1>
        <div class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
            <p>¡Hola! 😊 Aquí puedes programar una cita de manera sencilla. Solo sigue estos pasos:</p>
            <ol>
                <li>1. Escoge la fecha y la hora que más te convengan.</li>
                <li>2. Llena los siguientes datos.</li>
            </ol>
            <p>Un profesional se pondrá en contacto contigo muy pronto. ¡Gracias! 💼📅</p>
            <div />
        </div>

        <div class="pt-8">
            <!-- Cal inline embed code begins -->
            <div style="width:100%;height:100%;overflow:scroll" id="my-cal-inline"></div>
        </div>

        <script type="text/javascript">
            (function (C, A, L) { let p = function (a, ar) { a.q.push(ar); }; let d = C.document; C.Cal = C.Cal || function () { let cal = C.Cal; let ar = arguments; if (!cal.loaded) { cal.ns = {}; cal.q = cal.q || []; d.head.appendChild(d.createElement("script")).src = A; cal.loaded = true; } if (ar[0] === L) { const api = function () { p(api, arguments); }; const namespace = ar[1]; api.q = api.q || []; if (typeof namespace === "string") { cal.ns[namespace] = cal.ns[namespace] || api; p(cal.ns[namespace], ar); p(cal, ["initNamespace", namespace]); } else p(cal, ar); return; } p(cal, ar); }; })(window, "https://app.cal.com/embed/embed.js", "init");
            Cal("init", { origin: "https://cal.com" });

            Cal("inline", {
                elementOrSelector: "#my-cal-inline",
                calLink: "stomadiahelp/citas234",
                layout: "month_view"
            });

            Cal("ui", { "styles": { "branding": { "brandColor": "#22c55e" } }, "hideEventTypeDetails": false, "layout": "month_view" });
        </script>
        <!-- Cal inline embed code ends -->
        <!-- Cal inline embed code ends -->
    </div>
</div>
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
<!-- <script type="module" src="/public/build/js/citas.js"></script> -->
<script src="./build/types/app-bundle.js"></script>