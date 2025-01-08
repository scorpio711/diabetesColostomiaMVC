document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(MotionPathPlugin)
    tabs();
});

const inputs = document.querySelectorAll('.steps-range');

function handleRangeChange(value) {
    const section = Math.floor(value / 25); // Divide el rango en 4 secciones de 25 unidades cada una
    switch (section) {
        case 0:
            animarEstrella("verde");
            break;
        case 1:
            animarEstrella("amarilla");
            break;
        case 2:
            animarEstrella("naranja");
            break;
        case 3:
            animarEstrella("roja");
            break;
    }
}

inputs.forEach(input => {
    console.log(`Inicializando input con valor: ${input.value}`);
    input.addEventListener('input', (event) => {
        const value = parseInt(event.target.value, 10);
        handleRangeChange(value);
    });
});

function animarEstrella(color) {
    const estrella = document.getElementById(`estrella${color.charAt(0).toUpperCase() + color.slice(1)}`);

    gsap.timeline()
        // Primero aseguramos que la estrella esté visible y a escala normal
        .set(estrella, { opacity: 1, scale: 1 })
        // Aparecer la estrella
        .fromTo(estrella, { opacity: 0, scale: 1 }, { opacity: 1, scale: 1, duration: 1 })
        // Agrandar la estrella
        .to(estrella, { scale: 2, duration: 1 })
        // Desaparecer la estrella
        .to(estrella, { scale: 1, duration: 1 });
}

function tabs() {
    const tabs = document.querySelectorAll('[role="tab"]');
    const tabPanels = document.querySelectorAll('[role="tabpanel"]');
    const images = document.querySelectorAll('.relative img'); // Selecciona todas las imágenes
    let currentTabIndex = 0;

    // Definir la lista de preguntas
    const preguntas = [
        "He tenido dificultades al realizar los cuidados que necesito para mantener adcuadamente mi salud, por:",
        "He tenido dificultades al realizar los cambios en mi alimentación que son necesarios para mantener mi salud, por:",
        "He tenido dificultades al realizar la actividad física que necesito para mantener mi salud, por:",
        "He tenido dificultades para usar la vestimenta y/o accesorio y/o calzado que mejor se adapta a mis necesidades de salud, por: ",
        "He tenido dificultades para identificar los signos de alarma y acudir a los servicios especializados ante complicaciones en mi salud, por: "
    ];

    // Índice para recorrer las preguntas
    let preguntaIndex = 0;

    // Selecciona el texto de la pregunta
    const pregunta = document.getElementById("pregunta");

    // Selecciona botones
    const nextButton = document.getElementById('next-tab');
    const prevButton = document.getElementById('prev-tab');
    const finalizarButton = document.getElementById('finalizar-tab');



    function showTab(index) {
        tabs.forEach((tab, i) => {
            tab.setAttribute('aria-selected', i === index ? 'true' : 'false');
            tabPanels[i].classList.toggle('hidden', i !== index);
        });

        // Actualiza la pregunta correspondiente al tab actual
        if (index < preguntas.length) {
            gsap.to(pregunta, {
                duration: 0.5,
                text: preguntas[index],
                ease: "none"
            });
        }

        // Aplica la clase 'grayscale' a todas las imágenes excepto la actual
        images.forEach((img, i) => {
            if (i === index) {
                img.classList.remove('grayscale'); // Imagen actual en color
            } else {
                img.classList.add('grayscale'); // Otras imágenes en escala de grises
            }
        });

        // Mostrar/ocultar botones
        if (index === tabs.length - 1) {
            nextButton.classList.add('hidden');
            finalizarButton.classList.remove('hidden');
        } else {
            nextButton.classList.remove('hidden');
            finalizarButton.classList.add('hidden');
        }
    }

    nextButton.addEventListener('click', () => {
        if (currentTabIndex < tabs.length - 1) {
            currentTabIndex++;
        }
        showTab(currentTabIndex);
    });

    prevButton.addEventListener('click', () => {
        if (currentTabIndex > 0) {
            currentTabIndex--;
        }
        showTab(currentTabIndex);
    });

    finalizarButton.addEventListener('click', () => {
        // Aquí puedes realizar cualquier acción adicional
        setTimeout(function () {
            window.location.reload(); // Recargar la página
        }, 2);
    });

    // Inicializa mostrando la primera pestaña y pregunta
    showTab(currentTabIndex);

    // Para que también funcione con el botón "card__arrow"
    document.getElementById("card__arrow").addEventListener("click", () => {
        if (currentTabIndex < tabs.length - 1) {
            currentTabIndex++;
        }
        showTab(currentTabIndex);
    });
}



