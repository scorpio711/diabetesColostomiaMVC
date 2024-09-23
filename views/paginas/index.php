<?php
if (!$_SESSION["login"]):
    ?>
    <div id="sticky-banner" tabindex="-1"
        class="fixed top-0 start-0 z-50 flex justify-between w-full p-4 border-b border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
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
                        class="inline font-medium text-green-500 underline dark:text-blue-500 underline-offset-2 decoration-600 dark:decoration-500 decoration-solid hover:no-underline">Registrate
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
            <p id="animacion1" class="mb-4 font-semibold text-teal-900 dark:text-white  md:mb-6 md:text-lg xl:text-xl">
            </p>
            <h1 class="text-black-800 mb-8 text-4xl font-bold sm:text-5xl md:mb-12 md:text-6xl dark:text-white"><span
                    id="animacion2"
                    class="text-transparent bg-clip-text bg-gradient-to-r to-green-500 from-teal-700 dark:to-lime-500 dark:from-green-400"></span>
            </h1>

            <p class="mb-8 leading-relaxed text-black dark:text-white md:mb-12 xl:text-lg">"Uniendo fuerzas para
                vivir con pasión
                y superar los desafíos juntos"</p>

            <div class="flex w-full flex-col gap-2.5 sm:flex-row sm:justify-center">
                <a href="/public/registro">
                    <button type="button"
                        class="text-white bg-gradient-to-br  from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-base px-6 py-3.5 text-center me-2 mb-2">Registrate</button>
                </a>
                <a href="/public/login">
                    <button
                        class="relative inline-flex items-center leading-7 justify-center p-0.5 mb-2 me-2 overflow-hidden text-base font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                        <span
                            class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Iniciar Sesión
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- fin del gradiente -->
    <hr class="h-px my-8 bg-blue-200 border-0 dark:bg-gray-700">
    <!-- bento grid -->
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
                                <div
                                    class="flex -space-x-4 rtl:space-x-reverse justify-center items-center pt-10 sm:pt-0">
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
    <hr class="h-[0.1px] my-8 bg-blue-200 border-0 dark:bg-gray-700">
    <!-- Testimonios -->
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm">
                <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Testimonios</h2>
                <p class="mb-8 font-light text-black lg:mb-16 sm:text-xl dark:text-gray-400">Explore the whole
                    collection of open-source web components and elements built with the utility classes from Tailwind
                </p>
            </div>
            <div class="grid mb-8 lg:mb-12 lg:grid-cols-2 border border-blue-300 rounded-lg shadow-md shadow-green-500/20">
                <figure
                    class="flex flex-col justify-center items-center p-8 text-center bg-green-50 border-b border-blue-300 md:p-12 lg:border-r dark:bg-gray-800 dark:border-gray-700">
                    <blockquote class="mx-auto mb-8 max-w-2xl text-gray-500 dark:text-gray-400">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Speechless with how easy this
                            was to integrate</h3>
                        <p class="my-4">"I recently got my hands on Flowbite Pro, and holy crap, I'm speechless with how
                            easy this was to integrate within my application. Most templates are a pain, code is
                            scattered, and near impossible to theme.</p>
                        <p class="my-4">Flowbite has code in one place and I'm not joking when I say it took me a matter
                            of minutes to copy the code, customise it and integrate within a Laravel + Vue application.
                        </p>
                        <p class="my-4">If you care for your time, I hands down would go with this."</p>
                    </blockquote>
                    <figcaption class="flex justify-center items-center space-x-3">
                        <img class="w-9 h-9 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/karen-nelson.png"
                            alt="profile picture">
                        <div class="space-y-0.5 font-medium dark:text-white text-left">
                            <div>Bonnie Green</div>
                            <div class="text-sm font-light text-gray-500 dark:text-gray-400">Developer at Open AI</div>
                        </div>
                    </figcaption>
                </figure>
                <figure
                    class="flex flex-col justify-center items-center p-8 text-center bg-green-50 border-b border-blue-300 md:p-12 dark:bg-gray-800 dark:border-gray-700">
                    <blockquote class="mx-auto mb-8 max-w-2xl text-gray-500 dark:text-gray-400">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Solid foundation for any project
                        </h3>
                        <p class="my-4">"FlowBite provides a robust set of design tokens and components based on the
                            popular Tailwind CSS framework. From the most used UI components like forms and navigation
                            bars to the whole app screens designed both for desktop and mobile, this UI kit provides a
                            solid foundation for any project.</p>
                        <p class="my-4">Designing with Figma components that can be easily translated to the utility
                            classes of Tailwind CSS is a huge timesaver!"</p>
                    </blockquote>
                    <figcaption class="flex justify-center items-center space-x-3">
                        <img class="w-9 h-9 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                            alt="profile picture">
                        <div class="space-y-0.5 font-medium dark:text-white text-left">
                            <div>Roberta Casas</div>
                            <div class="text-sm font-light text-gray-500 dark:text-gray-400">Lead designer at Dropbox
                            </div>
                        </div>
                    </figcaption>
                </figure>
                <figure
                    class="flex flex-col justify-center items-center p-8 text-center bg-green-50 border-b border-blue-300 lg:border-b-0 md:p-12 lg:border-r dark:bg-gray-800 dark:border-gray-700">
                    <blockquote class="mx-auto mb-8 max-w-2xl text-gray-500 dark:text-gray-400">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Mindblowing workflow and
                            variants</h3>
                        <p class="my-4">"As someone who mainly designs in the browser, I've been a casual user of Figma,
                            but as soon as I saw and started playing with FlowBite my mind was 🤯.</p>
                        <p class="my-4">Everything is so well structured and simple to use (I've learnt so much about
                            Figma by just using the toolkit).</p>
                        <p class="my-4">Aesthetically, the well designed components are beautiful and will undoubtedly
                            level up your next application."</p>
                    </blockquote>
                    <figcaption class="flex justify-center items-center space-x-3">
                        <img class="w-9 h-9 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                            alt="profile picture">
                        <div class="space-y-0.5 font-medium dark:text-white text-left">
                            <div>Jese Leos</div>
                            <div class="text-sm font-light text-gray-500 dark:text-gray-400">Software Engineer at
                                Facebook</div>
                        </div>
                    </figcaption>
                </figure>
                <figure
                    class="flex flex-col justify-center items-center p-8 text-center bg-green-50 border-blue-300 md:p-12 dark:bg-gray-800 dark:border-gray-700">
                    <blockquote class="mx-auto mb-8 max-w-2xl text-gray-500 dark:text-gray-400">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Efficient Collaborating</h3>
                        <p class="my-4">"This is a very complex and beautiful set of elements. Under the hood it comes
                            with the best things from 2 different worlds: Figma and Tailwind.</p>
                        <p class="my-4">You have many examples that can be used to create a fast prototype for your
                            team."</p>
                    </blockquote>
                    <figcaption class="flex justify-center items-center space-x-3">
                        <img class="w-9 h-9 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                            alt="profile picture">
                        <div class="space-y-0.5 font-medium dark:text-white text-left">
                            <div>Joseph McFall</div>
                            <div class="text-sm font-light text-gray-500 dark:text-gray-400">CTO at Google</div>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <!-- <div class="text-center">
                <a href="#"
                    class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Show
                    more...</a>
            </div> -->
    </section>

    <hr class="h-[0.1px] my-8 bg-blue-200 border-0 dark:bg-gray-700">
    </section>
    <!-- fin bento grid -->

    <!-- investigaciones -->

    <?php
    require "listadoInvestigaciones.php";
    ?>


</div>




</div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.registerPlugin(TextPlugin);

        // Definir la primera animación
        gsap.to(animacion1, {
            duration: 1,
            text: "Estamos orgullosos de presentarte una plataforma",
            ease: "none",
            onComplete: () => {
                // Definir la segunda animación dentro de la función onComplete de la primera
                gsap.to(animacion2, {
                    duration: 1,
                    text: "Para personas con Diabetes y Ostomizados",
                    ease: "none"
                });
            }
        });
    });
</script>