<section class="bg-gray-50 dark:bg-gray-90 py-20">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
            Flowbite
        </a>
        <?php foreach ($errores as $error): ?>
            <div class="p-4 text-sm my-4 text-red-800 w-96 text-center rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">¡Cuidado!</span>
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <div
            class="w-full align-center bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 justify-center md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Confrimacion de Cuenta
                </h1>
                <a href="/public/">
                    <button type="button"
                        class="my-8 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Volver
                        a la pagina principal</button>
                </a>
            </div>
        </div>

    </div>
</section>