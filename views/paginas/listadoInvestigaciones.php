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

                <div
                    class="max-w-sm bg-green-50 border border-blue-300 shadow-md shadow-green-500/20  rounded-lg  dark:bg-gray-800 dark:border-gray-700" style="backdrop-filter: blur(20px);">
                    <a href="#">
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
                        <a href="/public/blog"
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