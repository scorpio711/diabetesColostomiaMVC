document.addEventListener("DOMContentLoaded", function () {
  iniciarApp();
});

function iniciarApp() {
  consultarApi(); // consulta la api en el backend de php
}

async function consultarApi() {
  try {
    const url =
      "https://api.cal.com/v1/bookings?userId=1&apiKey=cal_live_734742ae8dbe3eae4139d063a47b8f3d";
    const resultado = await fetch(url);
    const data = await resultado.json();
    const bookings = data.bookings;
    filtrar(bookings);
  } catch (error) {
    console.log(error);
  }
}

function filtrar(bookings) {
  //Segundo filtro que excluye las reservas pasadas
  const fechaActual = new Date();

  const citasFuturas = bookings.filter((reserva) => {
    const fechaCita = new Date(reserva.startTime);
    return fechaCita > fechaActual;
  });
  //Tercer filtro que valida la citas que no esten canceladas
  const citasNoCanceladas = citasFuturas.filter((reserva) => {
    return reserva.status !== "CANCELLED";
  });

  mostrarBookings(citasNoCanceladas);
}

function mostrarBookings(bookings) {
  const tbody = document.getElementById("bookingTableBody");
  bookings.forEach((booking) => {
    const { startTime, endTime, attendees, user, id, status } = booking;
    const { email, name } = attendees[0];
    // Crear una nueva fila
    const tr = document.createElement("tr");
    tr.className = "border-b dark:border-gray-700";

    // Crear celdas de la fila con clases
    const profesionalTd = document.createElement("td");
    profesionalTd.className =
      "px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white";
    profesionalTd.textContent = name;

    const emailTd = document.createElement("td");
    emailTd.className =
      "px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white";
    emailTd.textContent = email;

    const startTimeTd = document.createElement("td");
    startTimeTd.className =
      "px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white";
    startTimeTd.textContent = new Date(startTime).toLocaleString(); // Formatear la fecha

    const endTimeTd = document.createElement("td");
    endTimeTd.className =
      "px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white";
    endTimeTd.textContent = status;

    const botonTd = document.createElement("td");

    // Crear el boton con acciones
    const boton = document.createElement("button");
    // Configura sus atributos y clases
    boton.id = `deleteButton${id}`;
    boton.className =
      "focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900";
    boton.textContent = "Cancelar"; // El texto del botón
    boton.type = "button";

    //agregar el boton al td
    botonTd.appendChild(boton);

    // Agregar celdas a la fila
    tr.appendChild(profesionalTd);
    tr.appendChild(emailTd);
    tr.appendChild(endTimeTd);
    tr.appendChild(startTimeTd);
    tr.appendChild(botonTd);

    // Agregar la fila al tbody
    tbody.appendChild(tr);
    document.getElementById(`deleteButton${id}`).addEventListener("click", () => {
      cancelarCita(id);
    });
  });
}

async function cancelarCita(id) {
  console.log(id);
  const url = `https://api.cal.com/v1/bookings/${id}/cancel?apiKey=cal_live_734742ae8dbe3eae4139d063a47b8f3d`;
  try {
    const respuesta = await fetch(url, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
    });

    const resultado = await respuesta.json();

    if (resultado) {
      Swal.fire({
        title: "Buen Trabajo!",
        text: "Cita Cancelada!",
        icon: "success",
        button: "Ok",
      }).then(() => {
        setTimeout(() => {
          window.location.reload();
        }, 1500); // Cambiado a 1500 ms
      });
    }
  } catch (error) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Hubo un error al cancelar la cita (verifica si ya actualizaste tu perfil)",
    });
  }
}