<main class="container mx-auto p-4 md:py-12 mt-10">

    <div class="text-left py-8 md:px-8">
        <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            Bienvenido a esta Encuesta</h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl   dark:text-gray-400">Here at
            A continuación encontrarás una serie de frases que describen diferentes clases de
            sentimientos y estados de ánimo, y al lado unas escalas de 10 puntos. Lee cada frase y rodea con un
            círculo el valor de 0 a 10 que indique mejor cómo te SIENTES AHORA MISMO, en este
            momento. No emplees demasiado tiempo en cada frase y para cada una de ellas elige una respuesta.
        </p>
    </div>

    <div class="grid grid-cols-11 justify-items-center pb-8">
        <h1 class="font-bold text-gray-900 dark:text-white">0</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">1</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">2</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">3</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">4</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">5</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">6</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">7</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">8</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">9</h1>
        <h1 class="font-bold text-gray-900 dark:text-white">10</h1>
    </div>

    <form method="POST">
        <div class="pb-8 md:px-8">
            <label for="steps-range-1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                nerviosos</label>
            <input name="step-range-1" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                irritado</label>
            <input name="step-range-2" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                alegre</label>
            <input id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                melancólico</label>
            <input name="step-range-3" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                optimista</label>
            <input name="step-range-4" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                alicaído</label>
            <input name="step-range-5" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-6" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                enojado</label>
            <input name="step-range-6" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-7" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                ansioso</label>
            <input name="step-range-7" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-8" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                apagado</label>
            <input name="step-range-8" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-9" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                molesto</label>
            <input name="step-range-9" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-10" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                jovial</label>
            <input name="step-range-10" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-11" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                intranquilo</label>
            <input name="step-range-11" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-12" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                enfadado</label>
            <input name="step-range-12" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-13" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                contento</label>
            <input name="step-range-13" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="pb-8 md:px-8">
            <label for="steps-range-14" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Me siento
                triste</label>
            <input name="step-range-14" id="steps-range" type="range" min="0" max="10" value="5" step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>

        <button type="submit" name="encuesta"
            class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Subir</button>
    </form>

</main>