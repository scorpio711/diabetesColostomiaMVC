// Configuración limpia y estable de TinyMCE con plugins de código abierto locales
const editorConfig = {
  selector: "#editor",
  language: "es",
  width: "100%",
  height: 520,
  resize: true,
  branding: false,
  statusbar: true,
  menubar: "edit insert format table tools",
  plugins: [
    "advlist",
    "autolink",
    "lists",
    "link",
    "image",
    "charmap",
    "preview",
    "anchor",
    "searchreplace",
    "visualblocks",
    "code",
    "fullscreen",
    "insertdatetime",
    "media",
    "table",
    "help",
    "wordcount"
  ],
  toolbar:
    "undo redo | styles | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | preview fullscreen code",
  content_style:
    "body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.6; color: #1e293b; padding: 12px; } img { max-width: 100%; height: auto; border-radius: 8px; }",
  setup: function (editor) {
    editor.on("init", function () {
      console.log("TinyMCE inicializado correctamente.");
    });
  }
};

// Inicializar TinyMCE
if (typeof tinymce !== "undefined") {
  tinymce.init(editorConfig);
}

// Manejar el guardado del formulario
const formulario = document.getElementById("formulario");

if (formulario) {
  formulario.addEventListener("submit", async (e) => {
    e.preventDefault();
    await actualizarBlog();
  });
}

async function actualizarBlog() {
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");

  if (!id) {
    alert("Error: No se encontró el identificador del artículo.");
    return;
  }

  // Obtener contenido de TinyMCE de forma segura
  let contenido = "";
  if (typeof tinymce !== "undefined") {
    const editorInstance = tinymce.get("editor") || tinymce.activeEditor;
    if (editorInstance) {
      contenido = editorInstance.getContent();
    }
  }

  const btnGuardar = document.getElementById("btnGuardarBlog");
  const textoOriginal = btnGuardar ? btnGuardar.innerHTML : "Guardar";

  if (btnGuardar) {
    btnGuardar.disabled = true;
    btnGuardar.innerHTML = `
      <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
      </svg> Guardando...
    `;
  }

  try {
    const datos = new FormData();
    datos.append("contenido_html", contenido);
    datos.append("id", id);

    const url = `${location.origin}/public/api/blog`;
    const respuesta = await fetch(url, {
      method: "POST",
      body: datos,
    });

    const resultado = await respuesta.json();

    if (resultado && (resultado.status === "ok" || resultado === true || resultado.resultado)) {
      if (btnGuardar) {
        btnGuardar.classList.remove("bg-blue-700", "hover:bg-blue-800");
        btnGuardar.classList.add("bg-emerald-600", "hover:bg-emerald-700");
        btnGuardar.innerHTML = `
          <svg class="w-4 h-4 mr-1 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg> ¡Guardado con éxito!
        `;
      }

      // Cerrar modal o recargar suavemente
      setTimeout(() => {
        location.reload();
      }, 700);
    } else {
      alert("No se pudo guardar: " + (resultado.mensaje || "Ocurrió un error inesperado."));
      if (btnGuardar) {
        btnGuardar.disabled = false;
        btnGuardar.innerHTML = textoOriginal;
      }
    }
  } catch (error) {
    console.error("Error al actualizar el blog:", error);
    alert("Error de conexión al intentar guardar los cambios.");
    if (btnGuardar) {
      btnGuardar.disabled = false;
      btnGuardar.innerHTML = textoOriginal;
    }
  }
}
