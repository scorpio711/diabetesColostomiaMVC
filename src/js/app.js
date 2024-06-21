const cita = {
  id: "",
  nombre: "",
  fecha: "",
  hora: "",
  servicios: [],
};

document.addEventListener("DOMContentLoaded", function () {
  iniciarApp();
});

function iniciarApp() {
  consultarApi();
  // mostrarOpcionSeleccionada();
  nombreCliente(); //añade el nombre del cliente al objeto de cita
  idCliente(); //añade el nombre del cliente al objeto de cita
  seleccionarFecha(); //añade la fecha de la cita al objeto cita
  seleccionarHora(); //añade la fecha de la cita al objeto cita
  mostrarResumen(); //añade la fecha de la cita al objeto cita
}

// Consulta la API en el backend de PHP
async function consultarApi() {
  try {
    const url = `${location.origin}/public/api/servicios`;
    const resultado = await fetch(url);
    const servicios = await resultado.json();
    mostrarServicios(servicios);
  } catch (error) {
    console.log(error);
  }
}

function mostrarServicios(servicios) {
  servicios.forEach((servicio) => {
    const { id, nombre_servicio, descripcion } = servicio;

    // Crear el elemento <div> con las clases y atributos necesarios
    const divElement = document.createElement("a");
    divElement.href = "#";
    divElement.classList.add(
      "max-w-sm",
      "p-6",
      "border",
      "border-gray-200",
      "rounded-lg",
      "shadow",
      "hover:bg-gray-100",
      "dark:hover:bg-gray-700",
      "dark:bg-gray-800",
      "dark:border-gray-700"
    );
    divElement.dataset.idServicio = id;
    divElement.onclick = function () {
      seleccionarServicio(servicio);
    };

    // Crear el primer enlace <a> y su contenido
    const link1 = document.createElement("a");
    link1.href = "#";
    const h5Element = document.createElement("h5");
    h5Element.classList.add(
      "mb-2",
      "text-2xl",
      "font-bold",
      "tracking-tight",
      "text-gray-900",
      "dark:text-white"
    );
    h5Element.textContent = nombre_servicio;
    link1.appendChild(h5Element);

    // Crear el primer párrafo <p> y su contenido
    const p1 = document.createElement("p");
    p1.classList.add(
      "mb-3",
      "font-normal",
      "text-gray-700",
      "dark:text-gray-400"
    );
    p1.textContent = descripcion;

    // Crear el icono SVG y añadirlo al segundo enlace

    // Agregar todos los elementos al <div> principal
    divElement.appendChild(link1);
    divElement.appendChild(p1);

    // Agregar el <div> al documento (por ejemplo, al cuerpo del documento)
    document.querySelector("#servicios").appendChild(divElement);
  });
}

function seleccionarServicio(servicio) {
  const { id } = servicio;
  const { servicios } = cita;

  //identificar al elemento al que se le da click
  const divServicio = document.querySelector(`[data-id-servicio = "${id}"]`);
  const hElement = divServicio.querySelector('h5');
  console.log(hElement);
  //Comprobar si un servicio ya fue agregado o quitarlo
  if (servicios.some((agregado) => agregado.id === id)) {
    //Eliminarlo
    cita.servicios = servicios.filter((agreado) => agreado.id !== id);
    hElement.classList.add("text-gray-900"); 
    divServicio.classList.add("border-gray-200"); 
    hElement.classList.remove("text-purple-600");
    divServicio.classList.remove("border-purple-600");
  } else {
    //agregarlo
    cita.servicios = [...servicios, servicio];
    hElement.classList.remove("text-gray-900");
    divServicio.classList.remove("border-gray-200"); 
    hElement.classList.add("text-purple-600");
    divServicio.classList.add("border-purple-600");
  }

  // console.log(cita);
}

function mostrarOpcionSeleccionada() {
  var select = document.getElementById("opciones");
  var resultado = document.getElementById("resultado");
  var opcionSeleccionada = document.getElementById("opcionSeleccionada");
  var opcionPaciente = document.getElementById("opcionPaciente");

  if (select.value === "") {
    resultado.style.display = "none";
    opcionDosHTML.style.display = "none";
  } else {
    if (select.value === "paciente") {
      opcionPaciente.style.display = "block";
    } else {
      opcionPaciente.style.display = "none";
    }
  }
}

function nombreCliente() {
  const nombre = document.querySelector("#nombre").value;
  cita.nombre = nombre;
}

function idCliente() {
  const id = document.querySelector("#id").value;
  cita.id = id;
}

function seleccionarFecha() {
  const inputFecha = document.querySelector("#fecha");
  inputFecha.addEventListener("input", function (e) {
    const dia = new Date(e.target.value).getUTCDay();
    if ([0, 6].includes(dia)) {
      e.target.value = "";
      mostrarAlerta("Fines de semana no permitidos", "error", "#alertas");
    } else {
      cita.fecha = e.target.value;
    }
  });
}

function seleccionarHora() {
  const inputHora = document.querySelector("#hora");
  inputHora.addEventListener("input", function (e) {
    const horaCita = e.target.value;
    const hora = horaCita.split(":")[0];
    if (hora < 7 || hora > 18) {
      e.target.value = "";
      mostrarAlerta("hora no valida", "error", "#alertas");
    } else {
      cita.hora = e.target.value;
      console.log(cita);
    }
  });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
  const alertaPrevia = document.querySelector("#alertaError");
  if (alertaPrevia) {
    alertaPrevia.remove();
  }
  if (tipo == "error") {
    alertaClase =
      "flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400";
  } else if (tipo == "bien") {
    alertaClase =
      "flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400";
  }
  // Crear el elemento div
  var alerta = document.createElement("div");

  // Agregar clases y atributos al elemento div
  alerta.className = alertaClase;
  alerta.setAttribute("role", "alert");

  // Crear el elemento span para el título
  var titulo = document.createElement("span");
  titulo.className = "font-medium";

  // Crear un nodo de texto para el mensaje
  var mensaje = document.createTextNode(mensaje);

  // Agregar el título y el mensaje al elemento div
  alerta.appendChild(titulo);
  alerta.appendChild(mensaje);
  alerta.id = "alertaError";

  // Agregar el elemento div a la página
  // document.body.appendChild(alerta);

  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);

  if (desaparece) {
    //eleminar la alerta
    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
}

function mostrarResumen() {
  const resumen = document.querySelector("#resumen");

  //Limpiar contenido de resumen
  while (resumen.firstChild) {
    resumen.removeChild(resumen.firstChild);
  }
  if (Object.values(cita).includes("") || cita.servicios.length === 0) {
    mostrarAlerta(
      "Faltan datos de servicios, fecha u hora",
      "error",
      "#resumen",
      false
    );

    return;
  }

  const { nombre, fecha, hora, servicios } = cita;

  //servicios

  const contenedorServicios = document.createElement("div");
  contenedorServicios.className = "flex flex-col pb-3";

  const tituloServicios = document.createElement("dt");
  tituloServicios.className =
    "mb-1 text-gray-500 md:text-base dark:text-gray-400";
  tituloServicios.textContent = "servicios: ";

  contenedorServicios.appendChild(tituloServicios);

  servicios.forEach((servicio) => {
    const { nombre_servicio } = servicio;

    const nombreServicio = document.createElement("dd");
    nombreServicio.className = "text-base font-semibold";
    nombreServicio.textContent = nombre_servicio;

    contenedorServicios.appendChild(nombreServicio);
  });

  const lista = document.createElement("dl");
  lista.className =
    "max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700";

  //nombre
  const contenedorNombre = document.createElement("div");
  contenedorNombre.className = "flex flex-col pb-3";

  const tituloNombre = document.createElement("dt");
  tituloNombre.className = "mb-1 text-gray-500 md:text-base dark:text-gray-400";
  tituloNombre.textContent = "Nombre: ";

  const nombreCliente = document.createElement("dd");
  nombreCliente.className = "text-base font-semibold";
  nombreCliente.textContent = nombre;

  contenedorNombre.appendChild(tituloNombre);
  contenedorNombre.appendChild(nombreCliente);

  //fecha
  const contenedorFecha = document.createElement("div");
  contenedorFecha.className = "flex flex-col pb-3";

  const tituloFecha = document.createElement("dt");
  tituloFecha.className = "mb-1 text-gray-500 md:text-base dark:text-gray-400";
  tituloFecha.textContent = "Fecha: ";

  //Formatear Fecha
  const fechaObj = new Date(fecha);
  const mes = fechaObj.getMonth();
  const dia = fechaObj.getDate() + 2;
  const anio = fechaObj.getFullYear();

  const fechaUTC = new Date(Date.UTC(anio, mes, dia));

  const opciones = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  const fechaFormateada = fechaUTC.toLocaleDateString("es-CO", opciones);

  const fechaCliente = document.createElement("dd");
  fechaCliente.className = "text-base font-semibold";
  fechaCliente.textContent = fechaFormateada; //
  contenedorFecha.appendChild(tituloFecha);
  contenedorFecha.appendChild(fechaCliente);

  //hora
  const contenedorHora = document.createElement("div");
  contenedorHora.className = "flex flex-col pb-3";

  const tituloHora = document.createElement("dt");
  tituloHora.className = "mb-1 text-gray-500 md:text-base dark:text-gray-400";
  tituloHora.textContent = "Hora: ";

  const HoraCliente = document.createElement("dd");
  HoraCliente.className = "text-base font-semibold";
  HoraCliente.textContent = hora.split(":")[0] + ":00";

  contenedorHora.appendChild(tituloHora);
  contenedorHora.appendChild(HoraCliente);


  lista.appendChild(contenedorNombre);
  lista.appendChild(contenedorFecha);
  lista.appendChild(contenedorHora);
  lista.appendChild(contenedorServicios);

  //Boton para crear una cita

  const botonReservar = document.createElement("button");
  botonReservar.className =
    "text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2";
  botonReservar.textContent = "Reservar Cita";
  botonReservar.onclick = reservarCita;

  resumen.appendChild(lista);
  resumen.appendChild(botonReservar);
}

async function reservarCita() {
  const { id, nombre, fecha, hora, servicios } = cita;

  const idServicio = servicios.map((servicio) => servicio.id);

  const datos = new FormData();
  datos.append("id_paciente", id);
  datos.append("fecha", fecha);
  datos.append("hora", hora.split(":")[0] + ":00" + ":00");
  datos.append("servicios", idServicio);

  console.log(...datos);

  try {
    //Peticion hacia la api
    const url = `${location.origin}/public/api/cita`;

    const respuesta = await fetch(url, {
      method: "POST",
      body: datos,
    });

    const resultado = await respuesta.json();

    if (resultado.resultado) {
      Swal.fire({
        title: "Buen Trabajo!",
        text: "Cita Creada!",
        icon: "success",
        button: "Ok",
      }).then(() => {
        setTimeout(() => {
          window.location.reload();
        }, 15);
      });
    }
  } catch (error) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Hubo un error al guardar la cita(verifica si ya actualizaste tu perfil)",
    });
  }
}