const cita = {
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
  mostrarOpcionSeleccionada();
}

// Consulta la API en el backend de PHP
async function consultarApi() {
  try {
    const url = "http://localhost:3000/public/api/servicios";
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
      "p-8",
      "bg-white",
      "border",
      "border-gray-200",
      "rounded-lg",
      "shadow",
      "hover:border-indigo-300",
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

  //Comprobar si un servicio ya fue agregado o quitarlo
  if (servicios.some((agregado) => agregado.id === id)) {
    //Eliminarlo
    cita.servicios = servicios.filter((agreado) => agreado.id !== id);
    divServicio.classList.remove("border-indigo-300");
  } else {
    //agregarlo
    cita.servicios = [...servicios, servicio];
    divServicio.classList.add("border-indigo-300");
  }

  console.log(cita);
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
