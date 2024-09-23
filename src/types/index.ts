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
    console.log(citasNoCanceladas);
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