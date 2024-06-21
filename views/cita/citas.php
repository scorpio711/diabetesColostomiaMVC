<div class="py-20 mx-auto max-w-screen-xl px-4 md:px-8">
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


        <!-- Cal inline embed code begins -->
        <div style="width:100%;height:100%;overflow:scroll" id="my-cal-inline"></div>
        <script type="text/javascript">
            (function (C, A, L) { let p = function (a, ar) { a.q.push(ar); }; let d = C.document; C.Cal = C.Cal || function () { let cal = C.Cal; let ar = arguments; if (!cal.loaded) { cal.ns = {}; cal.q = cal.q || []; d.head.appendChild(d.createElement("script")).src = A; cal.loaded = true; } if (ar[0] === L) { const api = function () { p(api, arguments); }; const namespace = ar[1]; api.q = api.q || []; if (typeof namespace === "string") { cal.ns[namespace] = cal.ns[namespace] || api; p(cal.ns[namespace], ar); p(cal, ["initNamespace", namespace]); } else p(cal, ar); return; } p(cal, ar); }; })(window, "https://app.cal.com/embed/embed.js", "init");
            Cal("init", { origin: "https://cal.com" });

            Cal("inline", {
                elementOrSelector: "#my-cal-inline",
                calLink: "scorpio711/cita-stomadiahelp",
                layout: "month_view"
            });

            Cal("ui", { "styles": { "branding": { "brandColor": "#0E9F6E" } }, "hideEventTypeDetails": false, "layout": "month_view" });
        </script>
        <!-- Cal inline embed code ends -->
    </div>