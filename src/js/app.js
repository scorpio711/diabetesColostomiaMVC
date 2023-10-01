document.addEventListener("DOMContentloaded", function () {
  iniciarApp();
});

function iniciarApp(){
    consultarApi();
}
async function consultarApi() {
  try {
    const url = "http://localhost:3000/public/api/servicios";
    const resultado = await fetch(url);

    console.log(resultado);
  } catch (error) {
    console.log(error);
  }
}

// Consulta la API en el backend de PHP
