import { Modal } from 'flowbite';
import type { ModalOptions, ModalInterface } from 'flowbite';
import type { InstanceOptions } from 'flowbite';


document.addEventListener("DOMContentLoaded", function () {
    iniciarApp();
});

function iniciarApp(): void {
    consultarApi(); // consulta la api en el backend de php
}

async function consultarApi(): Promise<void> {
    try {
        const url =
            "https://api.cal.com/v1/bookings?userId=1&apiKey=cal_live_734742ae8dbe3eae4139d063a47b8f3d";
        const resultado = await fetch(url);
        const data = await resultado.json();
        const bookings: Booking[] = data.bookings;
        filtrar(bookings);
    } catch (error) {
        console.log(error);
    }
}

function filtrar(bookings: Booking[]): void {
    // Filtrar el resultado
    const div = document.getElementById("usuarioEmail");

    if (!div) {
        console.log("Elemento div no encontrado");
        return;
    }

    // Obtener el contenido de texto del div
    const correoFiltrar = div.textContent?.trim();

    if (!correoFiltrar) {
        console.log("Correo electrónico no encontrado en el div");
        return;
    }

    // Filtrar el arreglo para incluir solo las reservaciones con el correo especificado
    const reservasFiltradas = bookings.filter(
        (reserva) => reserva.attendees[0].email === correoFiltrar
    );

    //Segundo filtro que excluye las reservas pasadas
    const fechaActual = new Date();

    const citasFuturas = reservasFiltradas.filter(reserva => {
        const fechaCita = new Date(reserva.startTime);
        return fechaCita > fechaActual;
    });

    //Tercer filtro que valida la citas que no esten canceladas
    const citasNoCanceladas = citasFuturas.filter((reserva) => {
        return reserva.status !== "CANCELLED";
    });
    // console.log(citasNoCanceladas);
    if (citasNoCanceladas.length !== 0) {
        mostrarAlerta();

        //obtener fechaFormateada
        const fechasFormateadas = formatearFecha(citasFuturas);
        console.log(fechasFormateadas[0]);
        // cambiar el contenido del mensaje del modal

        const pElement = document.getElementById('mensaje-cita');

        pElement.textContent = `Solo se permite agendar una cita por usuario. 
        Actualmente, ya tienes una cita programada para ${fechasFormateadas[0]}. 
        Por favor, cancela o reprograma la cita existente si deseas agendar una nueva. 
        Esto nos ayuda a garantizar una mejor organización y disponibilidad para todos nuestros usuarios.`;
    }
}

// Tipos de datos
interface Booking {
    attendees: Attendee[];
    // otros campos relevantes de Booking
}

interface Attendee {
    email: string;
    // otros campos relevantes de Attendee
}


function mostrarAlerta() {
    const $modalElement: HTMLElement = document.getElementById('default-modal');

    const modalOptions: ModalOptions = {
        placement: 'center',
        backdrop: 'static',
        backdropClasses:
            'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
        closable: true
    };

    // instance options object
    const instanceOptions: InstanceOptions = {
        id: 'default-modal',
        override: true
    };

    const modal: ModalInterface = new Modal($modalElement, modalOptions, instanceOptions);

    modal.show();

}

function formatearFecha(bookings: Booking[]) {

    const fechasFormateadas: string[] = [];

    bookings.forEach(reserva => {
        const isoDate = reserva.startTime;
        // Crea un objeto Date a partir de la cadena ISO
        const date = new Date(isoDate);

        // Obtén los componentes de la fecha
        const options: Intl.DateTimeFormatOptions = {
            weekday: 'long', // Día de la semana
            year: 'numeric', // Año
            month: 'long',   // Mes
            day: 'numeric',  // Día del mes
            hour: '2-digit', // Hora
            minute: '2-digit' // Minuto
        };

        // Formatea la fecha a una cadena legible
        fechasFormateadas.push(date.toLocaleDateString('es-ES', options));
    });

    return fechasFormateadas;

}


import { Tabs } from 'flowbite';
import type { TabsOptions, TabsInterface, TabItem } from 'flowbite';


const tabsElement: HTMLElement = document.getElementById('tabs-example');

// create an array of objects with the id, trigger element (eg. button), and the content element
const tabElements: TabItem[] = [
    {
        id: 'profile',
        triggerEl: document.querySelector('#profile-tab-example'),
        targetEl: document.querySelector('#profile-example'),
    },
    {
        id: 'dashboard',
        triggerEl: document.querySelector('#dashboard-tab-example'),
        targetEl: document.querySelector('#dashboard-example'),
    },
    {
        id: 'settings',
        triggerEl: document.querySelector('#settings-tab-example'),
        targetEl: document.querySelector('#settings-example'),
    },
    {
        id: 'contacts',
        triggerEl: document.querySelector('#contacts-tab-example'),
        targetEl: document.querySelector('#contacts-example'),
    },
];

// options with default values
const options: TabsOptions = {
    defaultTabId: 'profile',
    activeClasses:
        'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
    inactiveClasses:
        'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: () => {
        // console.log('tab is shown');
    },
};

// instance options with default values
const instanceOptions: InstanceOptions = {
    id: 'tabs-example',
    override: true
};

/*
* tabsElement: parent element of the tabs component (required)
* tabElements: array of tab elements (required)
* options (optional)
* instanceOptions (optional)
*/
const tabs: TabsInterface = new Tabs(tabsElement, tabElements, options, instanceOptions);
tabs.show("profile");


//botones
const siguiente = document.getElementById("siguiente");
const atras = document.getElementById("atras");


// Inicializar el índice de la pestaña actual
let currentTabIndex = tabElements.findIndex(tab => tab.id === options.defaultTabId);

// Función para mostrar la pestaña en base al índice actual
function showTabByIndex(index: number) {
    const tab = tabElements[index];
    if (tab) {
        tabs.show(tab.id);
        currentTabIndex = index;
    }
}

// Configurar el botón de siguiente
siguiente.addEventListener("click", function () {
    // Verificar que no estamos en la última pestaña
    if (currentTabIndex < tabElements.length - 1) {
        showTabByIndex(currentTabIndex + 1);
    }
});

// Configurar el botón de atrás
atras.addEventListener("click", function () {
    // Verificar que no estamos en la primera pestaña
    if (currentTabIndex > 0) {
        showTabByIndex(currentTabIndex - 1);
    }
});

