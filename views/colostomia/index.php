<?php
if ($_SESSION["actualizado"] == 0):
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
                <span>Por favor actualiza tu perfil puedes hacerlo dando<a href="/public/perfil"
                        class="inline font-medium text-green-600 underline dark:text-green-500 underline-offset-2 decoration-600 dark:decoration-500 decoration-solid hover:no-underline">
                        click
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
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="text-black-800 mb-4 text-4xl font-bold sm:text-5xl md:mb-8 md:text-6xl dark:text-white">
                    <span id="animacion1"
                        class="text-transparent bg-clip-text bg-gradient-to-r to-green-500 from-teal-700 dark:to-lime-500 dark:from-green-400"></span>
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Estamos aquí para apoyarte en el cuidado de tu ostomía, brindándote información y herramientas.</p>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Get started
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Speak to Sales
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex justify-center">
                <img src="/public/build/img/ingmar-h-c4GhGLsaFgk-unsplash.jpg" class="w-full h-auto max-w-80 rounded-lg"
                    alt="mockup">
            </div>
        </div>
    </section>
</div>
<div>
    <!-- component -->
    <section>
        <div class="p-8 mx-auto px-6 max-w-7xl">

            <div class="relative">
                <div class="relative z-10 grid gap-3 grid-cols-6">

                    <a href="#"
                        class="shadow-md shadow-green-500/20 col-span-full hover:bg-green-100/40 xl:col-span-3 overflow-hidden relative p-8 rounded-3xl bg-white border border-blue-300 dark:border-gray-800 dark:bg-gray-900">

                        <div class="grid sm:grid-cols-2">
                            <div class="flex flex-col justify-between relative z-10 space-y-12 lg:space-y-6">
                                <div
                                    class="relative aspect-square rounded-full size-12 flex border dark:bg-white/5 dark:border-white/10 before:absolute before:-inset-2 before:border-green-300 border-blue-300 before:border before:border-green-300 border-blue-300 dark:before:border-white/5 dark:before:bg-white/5 before:rounded-full">
                                    <img src="/public/build/img/sun-dynamic-premium.png" alt="">
                                </div>
                                <div class="space-y-2">
                                    <h2
                                        class="text-xl font-bold text-gray-800 transition group-hover:text-purple-950 dark:text-white">
                                        Sobre Nosotros</h2>
                                    <p class="dark:text-gray-300 text-gray-700">Provident fugit vero voluptate.
                                        Voluptates a sapiente inventore nisi.</p>
                                </div>
                            </div>
                            <div
                                class="overflow-hidden relative mt-6 sm:mt-auto h-fit -mb-[34px] -mr-[34px] sm:ml-6 py-6 p-6 border border-blue-300 rounded-tl-lg dark:bg-white/5 dark:border-white/10">
                                <img class="rounded-lg" src="/public/build/img/hands-1327811_1920.jpg" alt="">
                            </div>
                        </div>
                    </a>

                    </a>
                    <a href="#"
                        class="shadow-md shadow-green-500/20 col-span-full hover:bg-green-100/40 xl:col-span-3 overflow-hidden relative p-8 rounded-3xl bg-white border border-blue-300 dark:border-gray-800 dark:bg-gray-900">
                        <div class="h-full grid sm:grid-cols-2">
                            <div class="flex flex-col justify-between relative z-10 space-y-12 lg:space-y-6">
                                <div
                                    class="relative aspect-square rounded-full size-12 flex border dark:bg-white/5 dark:border-white/10 before:absolute before:-inset-2 before:border before:border-green-300 border-blue-300 dark:before:border-white/5 dark:before:bg-white/5 before:rounded-full">
                                    <img src="/public/build/img/boy-dynamic-premium.png" alt="">
                                </div>
                                <div class="space-y-2">
                                    <h2
                                        class="text-xl font-bold text-gray-800 transition group-hover:text-purple-950 dark:text-white">
                                        Conosca a nuestros Profesionales</h2>
                                    <p class="dark:text-gray-300 text-gray-700">Voluptate. magnam magni
                                        doloribus dolores voluptates a sapiente inventore nisi.</p>
                                </div>
                            </div>
                            <div class="flex -space-x-4 rtl:space-x-reverse justify-center items-center pt-10 sm:pt-0">
                                <img class="size-16 sm:size-20 border-2 border-white rounded-full dark:border-gray-800"
                                    src="/public/build/img/perfil1.jpg" alt="">
                                <img class="size-16 sm:size-20 border-2 border-white rounded-full dark:border-gray-800"
                                    src="/public/build/img/perfil2.jpg" alt="">
                                <img class="size-16 sm:size-20 border-2 border-white rounded-full dark:border-gray-800"
                                    src="/public/build/img/perfil3.jpg" alt="">
                                <img class="size-16 sm:size-20 border-2 border-white rounded-full dark:border-gray-800"
                                    src="/public/build/img/perfil4.jpg" alt="">
                            </div>
                        </div>
                    </a>

                    <a href="#"
                        class="shadow-md shadow-green-500/20 col-span-full hover:bg-green-100/40 sm:col-span-3 lg:col-span-2 overflow-hidden relative p-8 rounded-3xl bg-white border border-blue-300 dark:border-gray-800 dark:bg-gray-900 ">
                        <div>
                            <div
                                class="relative aspect-square rounded-full size-32 flex border mx-auto dark:bg-white/5 dark:border-white/10 before:absolute before:-inset-2 before:border before:border-green-300 border-blue-300 dark:before:border-white/5 dark:before:bg-white/5 before:rounded-full">
                                <img src="/public/build/img/notebook-dynamic-premium.webp" alt="imagen">
                            </div>
                            <div class="mt-6 text-center relative z-10 space-y-2">
                                <h2
                                    class="text-xl font-bold text-gray-800 transition group-hover:text-purple-950 dark:text-white ">
                                    Ayuda Juridica</h2>
                                <p class="dark:text-gray-300 text-gray-700">Provident fugit and vero voluptate.
                                    magnam magni doloribus dolores voluptates a sapiente nisi.</p>
                            </div>
                        </div>
                    </a>
                    <a href="#"
                        class="shadow-md shadow-green-500/20 col-span-full hover:bg-green-100/40 sm:col-span-3 lg:col-span-2 overflow-hidden relative p-8 rounded-3xl bg-white border border-blue-300 dark:border-gray-800 dark:bg-gray-900 ">
                        <div>
                            <div
                                class="relative aspect-square rounded-full size-32 flex border mx-auto dark:bg-white/5 dark:border-white/10 before:absolute before:-inset-2 before:border before:border-green-300 border-blue-300 dark:before:border-white/5 dark:before:bg-white/5 before:rounded-full">
                                <img src="/public/build/img/heart-dynamic-premium.png" alt="imagen">
                            </div>
                            <div class="mt-6 text-center relative z-10 space-y-2">
                                <h2
                                    class="text-xl font-bold text-gray-800 transition group-hover:text-purple-950 dark:text-white ">
                                    Atención Médica</h2>
                                <p class="dark:text-gray-300 text-gray-700">Provident fugit and vero voluptate.
                                    magnam magni doloribus dolores voluptates a sapiente nisi.</p>
                            </div>
                        </div>
                    </a>
                    <a href="#"
                        class="shadow-md shadow-green-500/20 col-span-full hover:bg-green-100/40 lg:col-span-2 overflow-hidden flex relative p-8 rounded-3xl bg-white border border-blue-300 dark:border-gray-800 dark:bg-gray-900">
                        <div>
                            <div
                                class="relative aspect-square rounded-full size-32 flex border mx-auto dark:bg-white/5 dark:border-white/10 before:absolute before:-inset-2 before:border before:border-green-300 border-blue-300 dark:before:border-white/5 dark:before:bg-white/5 before:rounded-full">
                                <img src="/public/build/img/star-dynamic-premium.png" alt="imagen">
                            </div>
                            <div class="mt-6 text-center relative z-10 space-y-2">
                                <h2
                                    class="text-xl font-bold text-gray-800 transition group-hover:text-purple-950 dark:text-white ">
                                    Apoyo Emocional</h2>
                                <p class="dark:text-gray-300 text-gray-700">Provident fugit and vero voluptate.
                                    magnam magni doloribus dolores voluptates a sapiente nisi.</p>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>
</div>
<!-- Investigaciones -->
<div class="py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-xl px-4 md:px-8">
        <!-- text - start -->
        <div class="mx-auto max-w-screen-sm text-center">
            <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Articulos relacionados</h2>
            <p class="mb-8 font-light text-black lg:mb-16 sm:text-xl dark:text-gray-400">Explore the whole
                collection of open-source web components and elements built with the utility classes from Tailwind
            </p>
        </div>
        <!-- text - end -->

        <div
            class="grid gap-4 sm:grid-cols-2 md:gap-6  xl:grid-cols-4 xl:gap-8 justify-center items-center justify-items-center">
            <?php foreach ($investigaciones as $investigacion): ?>
                <!-- article - start -->

                <div class="max-w-sm bg-green-50 border border-blue-300 shadow-md shadow-green-500/20  rounded-lg  dark:bg-gray-800 dark:border-gray-700"
                    style="backdrop-filter: blur(20px);">
                    <a href="<?php echo $investigacion->url ?>">
                        <img class="rounded-t-lg" src="/public/imagenesInvestigaciones/<?php echo $investigacion->imagen ?>"
                            alt="imagen investigación" />
                    </a>
                    <div class="p-5 text-center">
                        <a href="#">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <?php echo $investigacion->titulo ?>
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            <?php echo substr($investigacion->resumen, 0, 90); ?>...
                        </p>
                        <a href="<?php echo $investigacion->url ?>"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Leer más
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- article - end -->
            <?php endforeach ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.registerPlugin(TextPlugin);

        // Definir la primera animación
        gsap.to(animacion1, {
            duration: 1,
            text: '¡Bienvenido! Nos alegra que estés aquí Juntos cuidaremos de tu Ostomía',
            ease: "none",
            onComplete: () => {
                // Definir la segunda animación dentro de la función onComplete de la primera
                gsap.to(animacion2, {
                    duration: 1,
                    text: "",
                    ease: "none"
                });
            }
        });
    });
</script>