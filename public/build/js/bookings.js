const cita={id:"",nombre:"",fecha:"",hora:"",servicios:[],profesional:""};function iniciarApp(){consultarApi(),nombreCliente(),idCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}async function consultarApi(){try{const e=location.origin+"/public/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}async function consultarProfesionales(e=null){try{const t=location.origin+"/public/api/profesionales",a=await fetch(t),o=await a.json();mostrarProfesionales(e?o.filter(t=>t.profesion===e):o)}catch(e){console.log(e)}}function mostrarProfesionales(e){const t=document.querySelector("#profesionales");t.innerHTML="",e.forEach(e=>{const{id:a,nombre:o,profesion:r,imagenUsuario:n}=e,c=document.createElement("div");c.classList.add("w-full","max-w-sm","bg-white","cursor-pointer","border","border-gray-200","rounded-lg","shadow","hover:bg-gray-100","dark:bg-gray-800","dark:border-gray-700"),c.dataset.idProfesional=a,c.onclick=function(){seleccionarProfesional(e)};const i=document.createElement("div");i.classList.add("flex","flex-col","items-center","py-5");const s=document.createElement("img");s.classList.add("w-24","h-24","mb-3","rounded-full","shadow-lg"),s.src="/public/imagenesUsuarios/"+n||"/public/build/img/avatar.png",s.alt=o+" image";const l=document.createElement("h5");l.classList.add("mb-1","text-xl","font-medium","text-gray-900","dark:text-white"),l.textContent=o;const d=document.createElement("span");d.classList.add("text-sm","text-gray-500","dark:text-gray-400"),d.textContent=r,i.appendChild(s),i.appendChild(l),i.appendChild(d),c.appendChild(i),t.appendChild(c)})}function seleccionarProfesional(e){const{id:t}=e,{profesion:a}=cita,o=document.querySelector(`[data-id-profesional="${t}"]`),r=o.querySelector("h5");document.querySelectorAll("[data-id-profesional]").forEach(e=>{const t=e.querySelector("h5");t.classList.remove("text-purple-600"),t.classList.add("text-gray-900"),e.classList.remove("border-purple-600"),e.classList.add("border-gray-200")}),r.classList.remove("text-gray-900"),r.classList.add("text-purple-600"),o.classList.remove("border-gray-200"),o.classList.add("border-purple-600"),cita.profesionales=[e],console.log(cita)}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre_servicio:a,descripcion:o}=e,r=document.createElement("a");r.href="#",r.classList.add("max-w-sm","p-6","border","bg-white","border-gray-200","rounded-lg","shadow","hover:bg-gray-100","dark:hover:bg-gray-700","dark:bg-gray-800","dark:border-gray-700"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)};const n=document.createElement("a");n.href="#";const c=document.createElement("h5");c.classList.add("mb-2","text-2xl","font-bold","tracking-tight","text-gray-900","dark:text-white"),c.textContent=a,n.appendChild(c);const i=document.createElement("p");i.classList.add("mb-3","font-normal","text-gray-700","dark:text-gray-400"),i.textContent=o,r.appendChild(n),r.appendChild(i),document.querySelector("#servicios").appendChild(r)})}function seleccionarServicio(e){const{id:t}=e,{servicios:a}=cita,o=document.querySelector(`[data-id-servicio = "${t}"]`),r=o.querySelector("h5");document.querySelectorAll("[data-id-servicio]").forEach(e=>{const t=e.querySelector("h5");t.classList.remove("text-purple-600"),t.classList.add("text-gray-900"),e.classList.remove("border-purple-600"),e.classList.add("border-gray-200")}),r.classList.remove("text-gray-900"),r.classList.add("text-purple-600"),o.classList.remove("border-gray-200"),o.classList.add("border-purple-600"),cita.servicios=[e],consultarProfesionales(cita.servicios[0].profesionales),console.log(cita)}function mostrarOpcionSeleccionada(){var e=document.getElementById("opciones"),t=document.getElementById("resultado"),a=(document.getElementById("opcionSeleccionada"),document.getElementById("opcionPaciente"));""===e.value?(t.style.display="none",opcionDosHTML.style.display="none"):"paciente"===e.value?a.style.display="block":a.style.display="none"}function nombreCliente(){const e=document.querySelector("#nombre").value;cita.nombre=e}function idCliente(){const e=document.querySelector("#id").value;cita.id=e}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[0,6].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no permitidos","error","#alertas")):cita.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<7||t>18?(e.target.value="",mostrarAlerta("hora no valida","error","#alertas")):(cita.hora=e.target.value,console.log(cita))}))}function mostrarAlerta(e,t,a,o=!0){const r=document.querySelector("#alertaError");r&&r.remove(),"error"==t?alertaClase="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400":"bien"==t&&(alertaClase="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400");var n=document.createElement("div");n.className=alertaClase,n.setAttribute("role","alert");var c=document.createElement("span");c.className="font-medium";e=document.createTextNode(e);n.appendChild(c),n.appendChild(e),n.id="alertaError";document.querySelector(a).appendChild(n),o&&setTimeout(()=>{n.remove()},3e3)}function mostrarResumen(){const e=document.querySelector("#resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de servicios, fecha u hora","error","#resumen",!1);const{nombre:t,fecha:a,hora:o,servicios:r}=cita,n=document.createElement("div");n.className="flex flex-col pb-3";const c=document.createElement("dt");c.className="mb-1 text-gray-500 md:text-base dark:text-gray-400",c.textContent="servicios: ",n.appendChild(c),r.forEach(e=>{const{nombre_servicio:t}=e,a=document.createElement("dd");a.className="text-base font-semibold",a.textContent=t,n.appendChild(a)});const i=document.createElement("dl");i.className="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700";const s=document.createElement("div");s.className="flex flex-col pb-3";const l=document.createElement("dt");l.className="mb-1 text-gray-500 md:text-base dark:text-gray-400",l.textContent="Nombre: ";const d=document.createElement("dd");d.className="text-base font-semibold",d.textContent=t,s.appendChild(l),s.appendChild(d);const m=document.createElement("div");m.className="flex flex-col pb-3";const u=document.createElement("dt");u.className="mb-1 text-gray-500 md:text-base dark:text-gray-400",u.textContent="Fecha: ";const p=new Date(a),g=p.getMonth(),f=p.getDate()+2,b=p.getFullYear(),h=new Date(Date.UTC(b,g,f)).toLocaleDateString("es-CO",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),x=document.createElement("dd");x.className="text-base font-semibold",x.textContent=h,m.appendChild(u),m.appendChild(x);const y=document.createElement("div");y.className="flex flex-col pb-3";const v=document.createElement("dt");v.className="mb-1 text-gray-500 md:text-base dark:text-gray-400",v.textContent="Hora: ";const C=document.createElement("dd");C.className="text-base font-semibold",C.textContent=o.split(":")[0]+":00",y.appendChild(v),y.appendChild(C),i.appendChild(s),i.appendChild(m),i.appendChild(y),i.appendChild(n);const E=document.createElement("button");E.className="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2",E.textContent="Reservar Cita",E.onclick=reservarCita,e.appendChild(i),e.appendChild(E)}async function reservarCita(){const{id:e,nombre:t,fecha:a,hora:o,servicios:r}=cita,n=r.map(e=>e.id),c=new FormData;c.append("id_paciente",e),c.append("fecha",a),c.append("hora",o.split(":")[0]+":00:00"),c.append("servicios",n),console.log(...c);try{const e=location.origin+"/public/api/cita",t=await fetch(e,{method:"POST",body:c});(await t.json()).resultado&&Swal.fire({title:"Buen Trabajo!",text:"Cita Creada!",icon:"success",button:"Ok"}).then(()=>{setTimeout(()=>{window.location.reload()},15)})}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita(verifica si ya actualizaste tu perfil)"})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));