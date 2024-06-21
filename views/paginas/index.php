
<?php
if (!$_SESSION["login"]):
    ?>
    <div id="sticky-banner" tabindex="-1"
        class="fixed top-0 start-0 z-50 flex justify-between w-full p-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
        <div class="flex items-center mx-auto">
            <p class="flex items-center text-sm font-normal text-gray-500 dark:text-gray-400">
                <span
                    class="inline-flex p-1 me-3 bg-gray-200 rounded-full dark:bg-gray-600 w-6 h-6 items-center justify-center flex-shrink-0">
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                        <path
                            d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z" />
                    </svg>
                    <span class="sr-only">Light bulb</span>
                </span>
                <span>Registrate para acceder a más servicios <a href="/public/registro"
                        class="inline font-medium text-blue-600 underline dark:text-blue-500 underline-offset-2 decoration-600 dark:decoration-500 decoration-solid hover:no-underline">Registrate
                        aquí</a></span>
            </p>
        </div>
        <div class="flex items-center">
            <button data-dismiss-target="#sticky-banner" type="button"
                class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close banner</span>
            </button>
        </div>
    </div>
<?php
endif;
?>

<div class="container mx-auto p-4 md:py-12 mt-10 ">
    <!--parte rincipal -->
    <section class="flex flex-col items-center">
        <div class="flex max-w-xl flex-col items-center pt-8 pb-0 text-center sm:pb-16 lg:pt-32 lg:pb-32">
            <p class="mb-4 font-semibold text-blue-800 dark:text-white  md:mb-6 md:text-lg xl:text-xl">Estamos
                orgullosos de
                presentarte</p>
            <h1 class="text-black-800 mb-8 text-4xl font-bold sm:text-5xl md:mb-12 md:text-6xl dark:text-white"><span
                    class="text-transparent bg-clip-text bg-gradient-to-r to-green-500 from-blue-800 dark:to-lime-500 dark:from-green-400">Una
                    Plataforma para
                    la Diabetes y la Colostomía</span></h1>

            <p class="mb-8 leading-relaxed text-blue-800 dark:text-white md:mb-12 xl:text-lg">"Uniendo fuerzas para
                vivir con pasión
                y superar los desafíos juntos"</p>

            <div class="flex w-full flex-col gap-2.5 sm:flex-row sm:justify-center">
                <a href="/public/registro">
                    <button type="button"
                        class="text-white bg-gradient-to-br  from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-base px-6 py-3.5 text-center me-2 mb-2">Registrate</button>
                </a>
                <a href="/public/login">
                    <button
                        class="text-white bg-gradient-to-r from-green-400 to-blue-800 dark:to-lime-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-16 py-4 text-center me-2 mb-2">

                        Inicia Sesion

                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- fin del gradiente -->
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

    <!-- sobre nosotros -->
    <div class=" py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:gap-12">
                <div>
                    <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto">
                        <img src="../public/build/img/jared-rice-NTyBbu66_SI-unsplash (1).webp" loading="lazy"
                            alt="Photo by Martin Sanchez" class="h-full w-full object-cover object-center" />
                    </div>
                </div>

                <div class="md:pt-8">
                    <p class="text-center font-bold text-blue-800 dark:text-lime-500 md:text-left">¿Quienes somos nosotros?</p>

                    <h1
                        class="mb-4 text-center text-2xl font-bold text-gray-800 sm:text-3xl md:mb-6 md:text-left dark:text-white">
                        Cuidando Juntos la Diabetes y la Colostomía</h1>

                    <p class="mb-6 text-gray-700 dark:text-gray-200 sm:text-lg md:mb-8">
                        Nuestra misión es proporcionar apoyo integral y empoderamiento a las personas con diabetes y
                        colostomía, brindándoles información, recursos y una comunidad solidaria. Nos esforzamos por
                        mejorar la calidad de vida de nuestros usuarios al fomentar la educación, el auto-cuidado y
                        la conexión entre pares.<br /><br />
                        Buscamos romper barreras, eliminar el estigma y promover la inclusión, permitiendo que cada
                        individuo viva una vida plena y saludable, sin importar los desafíos que enfrenten. <a href="#"
                            class="text-blue-800 dark:text-lime-500 underline transition duration-100 dark:hover:text-lime-600 hover:text-blue-600">Mas
                            sobre nosotros</a>
                    </p>

                    <h2
                        class="mb-2 text-center text-xl font-semibold text-gray-900 sm:text-2xl md:mb-4 md:text-left dark:text-white">
                        Sobre Nosotros</h2>

                    <p class="mb-6 text-gray-700 dark:text-gray-200 sm:text-lg md:mb-8">En el Equipo de Apoyo D-Care, estamos
                        comprometidos en brindar un apoyo incondicional a las personas que viven con diabetes y
                        colostomía. Somos un grupo de profesionales altamente capacitados y apasionados, dedicados a
                        ofrecer un espacio seguro y comprensivo para aquellos que enfrentan estos desafíos diarios.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700 ">

    <!-- Nuestros servicios -->
    <div class="py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl dark:text-white">
                    Nuestros Servicios
                </h2>

                <p class="mx-auto max-w-screen-md text-center text-gray- dark:text-gray-200 md:text-lg">Nuestros servicios abarcan
                    asesoramiento legal, apoyo psicológico y atención médica especializada, proporcionando un
                    enfoque integral para aquellos que viven con diabetes y colostomía.</p>
            </div>
            <!-- text - end -->

            <div class="grid gap-x-4 gap-y-8 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-3">
                <!-- product - start -->
                <div>
                    <a href="/public/juridico"
                        class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3">
                        <img src="/public/build/img/clarisse-meyer-jKU2NneZAbI-unsplash.webp" loading="lazy"
                            alt="Photo by Austin Wade"
                            class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                    </a>

                    <div class="flex items-start justify-between gap-2 px-2">
                        <div class="flex flex-col">
                            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                                <a href="#"
                                    class="transition duration-100 hover:text-indigo-500 active:text-indigo-600">Ayuda
                                    Juridica</a>
                            </h2>

                            <p class="mb-8 text-gray-700 dark:text-gray-200">Brindamos asesoramiento legal especializado, guiando a las
                                personas con diabetes y colostomía en la protección de sus derechos, beneficios y
                                recursos legales para asegurar su bienestar y calidad de vida.</p>
                        </div>
                    </div>
                </div>
                <!-- product - end -->


                <!-- product - start -->
                <div>
                    <a href="/public/psicologico"
                        class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3">
                        <img src="../public/build/img/roman-kraft-0EVKn3-5JSU-unsplash.webp" loading="lazy"
                            alt="Photo by Austin Wade"
                            class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                    </a>

                    <div class="flex items-start justify-between gap-2 px-2">
                        <div class="flex flex-col">
                            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                                <a href="/public/psicologico"
                                    class="transition duration-100 hover:text-indigo-500 active:text-indigo-600">Apoyo
                                    Psicológico</a>
                            </h2>

                            <p class="mb-8 text-gray-700 dark:text-gray-200">Nuestro equipo de psicólogos capacitados ofrece un espacio
                                seguro y confidencial para el apoyo emocional, ayudando a las personas con diabetes
                                y colostomía a enfrentar los desafíos psicológicos, manejar el estrés y fortalecer
                                su resiliencia.</p>
                        </div>
                    </div>
                </div>
                <!-- product - end -->

                <!-- product - start -->
                <div>
                    <a href="/public/medico"
                        class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3">
                        <img src="../public/build/img/patty-brito-Y-3Dt0us7e0-unsplash.webp" loading="lazy"
                            alt="Photo by Vladimir Fedotov"
                            class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                    </a>

                    <div class="flex items-start justify-between gap-2 px-2">
                        <div class="flex flex-col">
                            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                                <a href="/public/medico"
                                    class="transition duration-100 hover:text-indigo-500 active:text-indigo-600">Atención
                                    Médica</a>
                            </h2>

                            <p class="mb-8 text-gray-700 dark:text-gray-200">Proporcionamos atención médica personalizada y
                                especializada, trabajando en colaboración con médicos expertos en diabetes y
                                colostomía para ofrecer un enfoque integral en el cuidado de la salud física, el
                                manejo de la enfermedad y la promoción del bienestar general.</p>
                        </div>
                    </div>
                </div>
                <!-- product - end -->
            </div>
        </div>
    </div>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
    <!-- investigaciones -->
    <?php
    require "listadoInvestigaciones.php";
    ?>
</div>
</body>