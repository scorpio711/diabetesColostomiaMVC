<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION["login"] ?? false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CAREFULNESS</title>
    <link rel="stylesheet" href="/public/build/css/output.css" />
    <link rel="icon" href="/public/build/img/Logo CAREFULNESS.svg" type="image/png">
    
</head>


<body
    class="dark:bg-gray-900  container mx-auto bg-fixed bg-cover bg-center  selection:bg-green-500 selection:text-white dark:selection:bg-white dark:selection:text-black"" >
    <div  id="loader" class=" fixed bg-green-haze-50 z-[100] h-screen  w-screen top-0 left-0 flex items-center justify-center">
    <l-cardio size="124" stroke="4" speed="2" color="green"></l-cardio>
    </div>
    <header>
        <nav class=" bg-white fixed w-full z-[40] top-0 left-0 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/public" class="flex items-center">
                    <img src="/public/build/img/Logo CAREFULNESS.svg" class="h-10" alt="Flowbite Logo" />
                    <span
                        class="self-center text-2xl hidden sm:block font-semibold whitespace-nowrap text-transparent bg-clip-text bg-gradient-to-r to-green-500 from-teal-700 dark:from-green-400 dark:to-lime-500">CAREFULNESS</span>
                </a>
                <?php if ($auth): ?>
                    <div class="md:order-2">
                        <?php if (intval($_SESSION["actualizado"]) == 1): ?>
                            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                                data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer"
                                src="/public/imagenesUsuarios/<?php echo "$_SESSION[imagen]" ?>" alt="User dropdown">
                        <?php endif; ?>

                        <?php if (intval($_SESSION["actualizado"] == 0)): ?>
                            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                                data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer"
                                src="/public/build/img/avatar.webp" alt="User dropdown">
                        <?php endif; ?>

                        <!-- Dropdown menu -->
                        <div id="userDropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div>
                                    <?php echo "$_SESSION[nombre]" ?>
                                </div>
                                <div id="usuarioEmail" class="font-medium truncate">
                                    <?php echo "$_SESSION[email]" ?>
                                </div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">

                                <?php if ($_SESSION["rol"] == "paciente"): ?>
                                    <li>
                                        <div class="flex">
                                            <a href="/public/perfil">
                                                <button id="defaultModalButton" data-modal-toggle="defaultModal"
                                                    class=" px-4  mb-2 ml-[0.9rem] text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-500 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                                    type="button">
                                                    Perfil
                                                </button>
                                            </a>
                                        </div>
                                    </li>
                                <?php endif ?>
                                <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 'abogado' || $_SESSION['rol'] == 'enfermero' || $_SESSION['rol'] == 'psicologo')): ?>
                                    <li>
                                        <div class="flex">
                                            <a href="/public/perfil/profesionales">
                                                <button id="defaultModalButton" data-modal-toggle="defaultModal"
                                                    class=" px-4  mb-2 text-sm ml-[0.9rem] font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-500 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                                    type="button">
                                                    Perfil
                                                </button>
                                            </a>
                                        </div>
                                    </li>
                                <?php endif ?>
                                <?php if ($_SESSION["admin"]): ?>
                                    <li>
                                        <a href="/public/admin/index"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Administrar</a>
                                    </li>
                                <?php endif; ?>
                                <?php if ($_SESSION["rol"] == "abogado"): ?>
                                    <li>
                                        <a href="/public/admin/abogados"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Administrar</a>
                                    </li>
                                <?php endif; ?>
                                <?php if ($_SESSION["rol"] == "psicologo"): ?>
                                    <li>
                                        <a href="/public/admin/psicologos"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Administrar</a>
                                    </li>
                                <?php endif; ?>
                                <?php if ($_SESSION["rol"] == "enfermero"): ?>
                                    <li>
                                        <a href="/public/admin/enfermeros"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Administrar</a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="/public/misCitas"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mis
                                        citas</a>
                                </li>
                            </ul>
                            <div>
                                <a href="/public/logout" class="md:order-2">
                                    <button type="button"
                                        class=" px-4  mb-2 ml-[0.9rem] text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-500 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cerrar
                                        Sesion</button>
                                </a>
                            </div>
                        </div>

                    </div>
                <?php endif; ?>
                <?php if (!$auth): ?>
                    <a href="/public/login" class="md:order-2">
                        <button type="button"
                            class="  text-white bg-gradient-to-br from-green-400 to-blue-600  dark:to-lime-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Iniciar
                            Sesión</button>
                    </a>
                <?php endif ?>
                <button data-collapse-toggle="navbar-multi-level" type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-multi-level" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
                    <ul
                        class="flex flex-col font-medium align-center items-center p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                        <li>
                            <a href="/public"
                                class="block text-green-500 dark:text-lime-500 rounded md:bg-transparen md:p-0  md:dark:bg-transparent"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-black border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 hover:text-green-500 dark:hover:text-lime-500 md:p-0 md:w-auto dark:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Servicios
                                <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg></button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar"
                                class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                    aria-labelledby="dropdownLargeButton">
                                    <li>
                                        <a href="/public/medico"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medico</a>
                                    </li>
                                    <li>
                                        <a href="/public/juridico"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Juridico</a>
                                    </li>
                                    <li>
                                        <a href="/public/psicologico"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Psicologico</a>
                                    </li>

                                    <li aria-labelledby="dropdownNavbarLink">
                                        <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                                            data-dropdown-placement="right-start" type="button"
                                            class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Otros<svg
                                                aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg></button>
                                        <div id="doubleDropdown"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="doubleDropdownButton">
                                                <li>
                                                    <a href="/public/encuesta"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Encuesta</a>
                                                </li>
                                                <li>
                                                    <a href="/public/cita"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Nosotros</a>
                                                </li>
                                                <li>
                                                    <a href="/public/contacto"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Contacto</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php if ($auth): ?>
                            <li>
                                <a href="/public/citas"
                                    class="block py-2 pl-3 pr-4 text-gray-900 rounded  md:hover:bg-transparent md:border-0 md:p-0 dark:text-white hover:text-green-500 dark:hover:text-lime-500 dark:hover:bg-gray-700  md:dark:hover:bg-transparent">Citas</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="/public/investigaciones"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded md:border-0 hover:text-green-500 dark:hover:text-lime-500 md:p-0 dark:text-white md:dark:hover:bg-transparent">Investigaciones</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>


    <!-- alertas -->


    <?php echo $contenido; ?>

    <?php echo $script ?? ''; ?>



    <footer>

        <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a href="/public" class="flex items-center mb-4 sm:mb-0">
                        <img src="/public/build/img/Logo CAREFULNESS.svg" class="h-12" alt="Flowbite Logo" />
                        <span
                            class="self-center text-2xl font-semibold whitespace-nowrap text-transparent bg-clip-text bg-gradient-to-r to-green-500 from-cyan-500 dark:from-green-500 dark:to-lime-500">CAREFULNESS</span>
                    </a>
                    <ul
                        class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6 ">Nosotros</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6">Politicas de privacidad</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6 ">Licencia</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Contacto</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-6 inset-x-0 top-0 z-50 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                        href="https://flowbite.com/" class="hover:underline">CAREFULNESS™</a>. Todos los Derechos
                    Reservados.</span>
            </div>
        </footer>
    </footer>

</body>

<!-- sweet alerts -->
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: '665f3fa423cdafbec1181793' },
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production'
        });
      }
      v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/cardio.js"></script>
<script>
    var loader = document.getElementById("loader");
    window.addEventListener("load", function(){
        loader.style.display= "none";
    })
</script>

<!-- gsap -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/MotionPathPlugin.min.js"></script>

<!-- excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

 
</html>