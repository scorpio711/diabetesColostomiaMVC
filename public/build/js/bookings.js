/**
 * Motor de Agendamiento de Citas Clínicas Multidisciplinarias
 * Carefulness - Sistema de Gestión de Citas
 */

const bookingState = {
    step: 1,
    servicio: null,
    profesional: null,
    fecha: '',
    hora: '',
    slots: []
};

// Inicialización segura contra estados de carga del DOM
if (window.__bookingsAppInitialized) {
    console.log('Carefulness Bookings App ya inicializada.');
} else {
    window.__bookingsAppInitialized = true;
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBookingApp);
    } else {
        initBookingApp();
    }
}

function initBookingApp() {
    setupStepperNavigation();
    cargarServicios();
    setupFechaListener();
    setupConfirmacionButton();
    setupContinuarPaso4Button();
    setupProximoDiaButton();
    setupSlotsGridDelegation();
}

/**
 * Navegación y Stepper (Paso 1 a Paso 4)
 */
function setupStepperNavigation() {
    const btnAnterior = document.getElementById('btn-anterior');
    const btnSiguiente = document.getElementById('btn-siguiente');

    if (btnAnterior) {
        btnAnterior.addEventListener('click', () => {
            if (bookingState.step > 1) {
                goToStep(bookingState.step - 1);
            }
        });
    }

    if (btnSiguiente) {
        btnSiguiente.addEventListener('click', () => {
            if (validarPasoActual()) {
                goToStep(bookingState.step + 1);
            }
        });
    }

    // Navegación directa en los pills del stepper
    document.querySelectorAll('.step-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetStep = parseInt(btn.dataset.step, 10);
            if (targetStep < bookingState.step) {
                goToStep(targetStep);
            } else if (targetStep === bookingState.step + 1 && validarPasoActual()) {
                goToStep(targetStep);
            }
        });
    });
}

function validarPasoActual() {
    switch (bookingState.step) {
        case 1:
            return Boolean(bookingState.servicio);
        case 2:
            return Boolean(bookingState.profesional);
        case 3:
            return Boolean(bookingState.fecha && bookingState.hora);
        case 4:
            return Boolean(bookingState.servicio && bookingState.profesional && bookingState.fecha && bookingState.hora);
        default:
            return true;
    }
}

function updateNavigationButtons() {
    const btnAnterior = document.getElementById('btn-anterior');
    const btnSiguiente = document.getElementById('btn-siguiente');
    const stepText = document.getElementById('step-indicator-text');

    if (btnAnterior) {
        btnAnterior.disabled = (bookingState.step === 1);
    }

    if (btnSiguiente) {
        if (bookingState.step === 4) {
            btnSiguiente.classList.add('hidden');
        } else {
            btnSiguiente.classList.remove('hidden');
            btnSiguiente.disabled = !validarPasoActual();
        }
    }

    if (stepText) {
        stepText.textContent = `Paso ${bookingState.step} de 4`;
    }

    updateStepperPills();
}

function updateStepperPills() {
    document.querySelectorAll('.step-btn').forEach(btn => {
        const stepNum = parseInt(btn.dataset.step, 10);
        const circle = btn.querySelector('.step-circle');

        if (stepNum === bookingState.step) {
            btn.className = 'step-btn group flex items-center gap-3 p-3 rounded-2xl transition-all text-left w-full border border-teal-500 bg-teal-50/60 dark:bg-teal-950/40 shadow-sm cursor-default';
            if (circle) circle.className = 'step-circle w-9 h-9 rounded-xl bg-teal-600 text-white font-bold text-sm flex items-center justify-center shrink-0 shadow-sm';
        } else if (stepNum < bookingState.step) {
            btn.className = 'step-btn group flex items-center gap-3 p-3 rounded-2xl transition-all text-left w-full border border-emerald-300 dark:border-emerald-800 bg-white dark:bg-slate-800 cursor-pointer hover:shadow-xs';
            if (circle) circle.className = 'step-circle w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 font-bold text-sm flex items-center justify-center shrink-0';
        } else {
            btn.className = 'step-btn group flex items-center gap-3 p-3 rounded-2xl transition-all text-left w-full border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/60 opacity-60 cursor-not-allowed';
            if (circle) circle.className = 'step-circle w-9 h-9 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm flex items-center justify-center shrink-0';
        }
    });
}

function goToStep(targetStep) {
    if (targetStep < 1 || targetStep > 4) return;

    bookingState.step = targetStep;

    // Conmutación determinista de los 4 pasos usando sus IDs exactos
    for (let i = 1; i <= 4; i++) {
        const content = document.getElementById(`step-content-${i}`);
        if (content) {
            if (i === targetStep) {
                content.classList.remove('hidden');
            } else {
                content.classList.add('hidden');
            }
        }
    }

    if (targetStep === 2) {
        cargarProfesionales();
    } else if (targetStep === 3) {
        prepararPasoFecha();
    } else if (targetStep === 4) {
        prepararResumen();
    }

    updateNavigationButtons();

    try {
        window.scrollTo({ top: 100, behavior: 'smooth' });
    } catch (e) {
        window.scrollTo(0, 100);
    }
}

/**
 * ==========================================
 * PASO 1: SERVICIOS
 * ==========================================
 */
async function cargarServicios() {
    const loader = document.getElementById('loader-servicios');
    const grid = document.getElementById('grid-servicios');

    if (loader) loader.classList.remove('hidden');
    if (grid) grid.classList.add('hidden');

    try {
        const respuesta = await fetch('/public/api/servicios');
        const servicios = await respuesta.json();

        if (loader) loader.classList.add('hidden');
        if (grid) grid.classList.remove('hidden');

        renderServicios(servicios);
    } catch (error) {
        console.error('Error al cargar servicios:', error);
        if (loader) {
            loader.innerHTML = `
                <div class="p-4 rounded-2xl bg-red-50 text-red-700 text-xs">
                    Error al cargar los servicios clínicos. Por favor recarga la página.
                </div>
            `;
        }
    }
}

function renderServicios(servicios) {
    const grid = document.getElementById('grid-servicios');
    if (!grid) return;

    grid.innerHTML = '';

    const iconMap = {
        'enfermero': `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />`,
        'abogado': `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />`,
        'psicologo': `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />`
    };

    servicios.forEach(servicio => {
        const { id, nombre_servicio, descripcion, profesionales } = servicio;
        const iconPath = iconMap[profesionales] || iconMap['enfermero'];

        const card = document.createElement('div');
        card.className = `servicio-card group relative p-6 rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:border-teal-500 hover:shadow-md cursor-pointer transition-all flex flex-col justify-between`;
        card.dataset.id = id;

        card.innerHTML = `
            <div class="space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${iconPath}
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                        ${escapeHtml(nombre_servicio)}
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                        ${escapeHtml(descripcion || 'Atención especializada, seguimiento continuo y orientación clínica personalizada.')}
                    </p>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                <span class="check-text">Elegir este servicio</span>
                <span class="card-radio w-5 h-5 rounded-full border-2 border-slate-300 dark:border-slate-600 flex items-center justify-center">
                    <span class="dot w-2.5 h-2.5 rounded-full bg-teal-600 hidden"></span>
                </span>
            </div>
        `;

        card.addEventListener('click', () => {
            seleccionarServicio(servicio, card);
        });

        grid.appendChild(card);
    });
}

function seleccionarServicio(servicio, cardElement) {
    bookingState.servicio = servicio;
    bookingState.profesional = null;
    bookingState.fecha = '';
    bookingState.hora = '';

    document.querySelectorAll('.servicio-card').forEach(c => {
        c.classList.remove('border-teal-500', 'ring-2', 'ring-teal-500/20', 'bg-teal-50/20');
        const dot = c.querySelector('.dot');
        const checkText = c.querySelector('.check-text');
        if (dot) dot.classList.add('hidden');
        if (checkText) checkText.textContent = 'Elegir este servicio';
    });

    cardElement.classList.add('border-teal-500', 'ring-2', 'ring-teal-500/20', 'bg-teal-50/20');
    const dot = cardElement.querySelector('.dot');
    const checkText = cardElement.querySelector('.check-text');
    if (dot) dot.classList.remove('hidden');
    if (checkText) checkText.textContent = 'Servicio seleccionado ✓';

    updateNavigationButtons();

    setTimeout(() => {
        goToStep(2);
    }, 280);
}

/**
 * ==========================================
 * PASO 2: PROFESIONALES
 * ==========================================
 */
async function cargarProfesionales() {
    if (!bookingState.servicio) return;

    const loader = document.getElementById('loader-profesionales');
    const grid = document.getElementById('grid-profesionales');
    const nombreServicioSpan = document.getElementById('servicio-seleccionado-nombre');

    if (nombreServicioSpan) {
        nombreServicioSpan.textContent = bookingState.servicio.nombre_servicio;
    }

    if (loader) loader.classList.remove('hidden');
    if (grid) {
        grid.classList.add('hidden');
        grid.innerHTML = '';
    }

    try {
        const profesionParam = encodeURIComponent(bookingState.servicio.profesionales || '');
        const url = `/public/api/profesionales?servicio_id=${bookingState.servicio.id}&profesion=${profesionParam}`;
        const respuesta = await fetch(url);
        const profesionales = await respuesta.json();

        if (loader) loader.classList.add('hidden');
        if (grid) grid.classList.remove('hidden');

        renderProfesionales(profesionales);
    } catch (error) {
        console.error('Error al cargar profesionales:', error);
        if (loader) {
            loader.innerHTML = `
                <div class="p-4 rounded-2xl bg-red-50 text-red-700 text-xs">
                    Error al cargar los especialistas. Por favor intenta de nuevo.
                </div>
            `;
        }
    }
}

function renderProfesionales(profesionales) {
    const grid = document.getElementById('grid-profesionales');
    if (!grid) return;

    grid.innerHTML = '';

    // Filtro de seguridad por disciplina del servicio seleccionado
    const profesionEsperada = (bookingState.servicio && bookingState.servicio.profesionales) 
        ? bookingState.servicio.profesionales.toLowerCase().trim() 
        : null;

    const listaFiltrada = profesionEsperada 
        ? (profesionales || []).filter(p => (p.profesion || '').toLowerCase().trim() === profesionEsperada)
        : (profesionales || []);

    if (!listaFiltrada || listaFiltrada.length === 0) {
        grid.innerHTML = `
            <div class="col-span-full p-8 text-center rounded-3xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700 text-slate-500">
                <p class="text-sm font-semibold">No hay especialistas disponibles para este servicio en este momento.</p>
            </div>
        `;
        return;
    }

    listaFiltrada.forEach(prof => {
        const { id, nombre_completo, profesion, especializacion, telefono, descripcion, imagenUsuario } = prof;
        const imgSrc = imagenUsuario ? `/public/imagenesUsuarios/${imagenUsuario}` : '/public/build/img/avatar.webp';

        const card = document.createElement('div');
        card.className = `profesional-card group relative p-6 rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:border-teal-500 hover:shadow-md cursor-pointer transition-all flex flex-col justify-between`;
        card.dataset.id = id;

        card.innerHTML = `
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <img src="${imgSrc}" 
                         alt="${escapeHtml(nombre_completo)}" 
                         class="w-14 h-14 rounded-2xl object-cover border-2 border-slate-200 dark:border-slate-600 group-hover:border-teal-500 transition-colors"
                         onerror="this.src='/public/build/img/avatar.webp'">
                    <div class="min-w-0 flex-1">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white truncate group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                            ${escapeHtml(nombre_completo)}
                        </h3>
                        <p class="text-xs text-teal-600 dark:text-teal-400 font-semibold uppercase tracking-wider truncate">
                            ${escapeHtml(especializacion || profesion)}
                        </p>
                    </div>
                </div>

                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-3 leading-relaxed">
                    ${escapeHtml(descripcion || 'Especialista clínico certificado con amplia experiencia asistencial y acompañamiento integral a pacientes.')}
                </p>

                ${telefono ? `
                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                        <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>${escapeHtml(telefono)}</span>
                    </div>
                ` : ''}
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                <span class="check-text">Seleccionar especialista</span>
                <span class="card-radio w-5 h-5 rounded-full border-2 border-slate-300 dark:border-slate-600 flex items-center justify-center">
                    <span class="dot w-2.5 h-2.5 rounded-full bg-teal-600 hidden"></span>
                </span>
            </div>
        `;

        card.addEventListener('click', () => {
            seleccionarProfesional(prof, card);
        });

        grid.appendChild(card);
    });
}

function seleccionarProfesional(profesional, cardElement) {
    bookingState.profesional = profesional;
    bookingState.fecha = '';
    bookingState.hora = '';

    document.querySelectorAll('.profesional-card').forEach(c => {
        c.classList.remove('border-teal-500', 'ring-2', 'ring-teal-500/20', 'bg-teal-50/20');
        const dot = c.querySelector('.dot');
        const checkText = c.querySelector('.check-text');
        if (dot) dot.classList.add('hidden');
        if (checkText) checkText.textContent = 'Seleccionar especialista';
    });

    cardElement.classList.add('border-teal-500', 'ring-2', 'ring-teal-500/20', 'bg-teal-50/20');
    const dot = cardElement.querySelector('.dot');
    const checkText = cardElement.querySelector('.check-text');
    if (dot) dot.classList.remove('hidden');
    if (checkText) checkText.textContent = 'Especialista seleccionado ✓';

    updateNavigationButtons();

    setTimeout(() => {
        goToStep(3);
    }, 280);
}

/**
 * ==========================================
 * PASO 3: FECHA Y SLOTS DE HORARIOS
 * ==========================================
 */

/**
 * Calcula el siguiente día hábil (lunes a viernes) a partir de una fecha YYYY-MM-DD
 */
function calcularSiguienteDiaHabil(fechaBaseStr) {
    let base = fechaBaseStr ? new Date(fechaBaseStr + 'T12:00:00') : new Date();
    base.setDate(base.getDate() + 1);

    if (base.getDay() === 6) { // Sábado -> Lunes
        base.setDate(base.getDate() + 2);
    } else if (base.getDay() === 0) { // Domingo -> Lunes
        base.setDate(base.getDate() + 1);
    }

    const yyyy = base.getFullYear();
    const mm = String(base.getMonth() + 1).padStart(2, '0');
    const dd = String(base.getDate()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd}`;
}

/**
 * Sugiere de entrada un día que tenga disponibilidad garantizada:
 * Si son pasadas las 15:00 o fin de semana, sugiere mañana o el próximo lunes
 */
function obtenerFechaPorDefecto() {
    const ahora = new Date();
    const horaActual = ahora.getHours();

    let fecha = new Date();
    if (horaActual >= 15) {
        fecha.setDate(fecha.getDate() + 1);
    }

    if (fecha.getDay() === 6) { // Sábado -> Lunes
        fecha.setDate(fecha.getDate() + 2);
    } else if (fecha.getDay() === 0) { // Domingo -> Lunes
        fecha.setDate(fecha.getDate() + 1);
    }

    const anio = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, '0');
    const dia = String(fecha.getDate()).padStart(2, '0');
    return `${anio}-${mes}-${dia}`;
}

function prepararPasoFecha() {
    const profNombreSpan = document.getElementById('profesional-seleccionado-nombre');
    const fechaInput = document.getElementById('fecha-input');

    if (profNombreSpan && bookingState.profesional) {
        profNombreSpan.textContent = bookingState.profesional.nombre_completo;
    }

    // Si aún no hay fecha seleccionada, precargar automáticamente el primer día hábil con turnos
    if (!bookingState.fecha) {
        bookingState.fecha = obtenerFechaPorDefecto();
    }

    if (fechaInput) {
        fechaInput.value = bookingState.fecha;
    }

    consultarDisponibilidad(bookingState.fecha);
}

function setupFechaListener() {
    const fechaInput = document.getElementById('fecha-input');
    if (!fechaInput) return;

    const onFechaChange = (e) => {
        const fechaElegida = e.target.value;
        if (!fechaElegida) return;

        bookingState.fecha = fechaElegida;
        bookingState.hora = '';
        actualizarInfoSlotSeleccionado();
        updateNavigationButtons();
        consultarDisponibilidad(fechaElegida);
    };

    fechaInput.addEventListener('input', onFechaChange);
    fechaInput.addEventListener('change', onFechaChange);
}

function setupProximoDiaButton() {
    const btn = document.getElementById('btn-proximo-dia');
    if (btn) {
        btn.addEventListener('click', () => {
            const nuevaFecha = calcularSiguienteDiaHabil(bookingState.fecha);
            bookingState.fecha = nuevaFecha;
            bookingState.hora = '';
            const fechaInput = document.getElementById('fecha-input');
            if (fechaInput) fechaInput.value = nuevaFecha;
            actualizarInfoSlotSeleccionado();
            updateNavigationButtons();
            consultarDisponibilidad(nuevaFecha);
        });
    }
}

async function consultarDisponibilidad(fecha) {
    if (!bookingState.profesional) return;

    const placeholder = document.getElementById('slots-placeholder');
    const loader = document.getElementById('slots-loader');
    const vacio = document.getElementById('slots-vacio');
    const grid = document.getElementById('slots-grid');

    if (placeholder) placeholder.classList.add('hidden');
    if (vacio) vacio.classList.add('hidden');
    if (grid) {
        grid.classList.add('hidden');
        grid.innerHTML = '';
    }
    if (loader) loader.classList.remove('hidden');

    try {
        const url = `/public/api/disponibilidad?profesional_id=${bookingState.profesional.id}&fecha=${encodeURIComponent(fecha)}`;
        const respuesta = await fetch(url);
        const data = await respuesta.json();

        if (loader) loader.classList.add('hidden');

        if (!data.disponible) {
            mostrarEstadoVacio(data.mensaje || 'El profesional no tiene horarios de atención programados para este día.');
            actualizarInfoSlotSeleccionado();
            return;
        }

        renderSlots(data.slots || [], fecha);
    } catch (error) {
        console.error('Error al consultar disponibilidad:', error);
        if (loader) loader.classList.add('hidden');
        mostrarEstadoVacio('Ocurrió un error al consultar los horarios. Por favor intenta con otra fecha.');
        actualizarInfoSlotSeleccionado();
    }
}

function mostrarEstadoVacio(mensaje) {
    const vacio = document.getElementById('slots-vacio');
    const mensajeP = document.getElementById('slots-vacio-mensaje');
    const grid = document.getElementById('slots-grid');
    if (grid) grid.classList.add('hidden');
    if (mensajeP) mensajeP.textContent = mensaje;
    if (vacio) vacio.classList.remove('hidden');
    actualizarInfoSlotSeleccionado();
}

function renderSlots(slots, fechaConsultada) {
    const grid = document.getElementById('slots-grid');
    const vacio = document.getElementById('slots-vacio');
    if (!grid) return;

    if (!slots || slots.length === 0) {
        mostrarEstadoVacio('No hay horarios de atención configurados para este día.');
        actualizarInfoSlotSeleccionado();
        return;
    }

    const turnosDisponibles = slots.filter(s => s.disponible);

    if (vacio) vacio.classList.add('hidden');
    grid.innerHTML = '';
    grid.classList.remove('hidden');

    // Si existen turnos pero todos ya pasaron (ej: hoy por la tarde)
    if (turnosDisponibles.length === 0) {
        const aviso = document.createElement('div');
        aviso.className = 'col-span-full p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-amber-900 dark:text-amber-200 text-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-xs mb-2';
        aviso.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Los turnos para hoy han concluido o están reservados.</span>
            </div>
            <button type="button" id="btn-banner-proximo-dia" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-600 hover:bg-amber-700 active:scale-95 text-white font-bold rounded-xl shadow-xs transition cursor-pointer text-xs shrink-0 self-start sm:self-auto">
                <span>Ver próximo día libre &rarr;</span>
            </button>
        `;
        grid.appendChild(aviso);

        const btnBanner = aviso.querySelector('#btn-banner-proximo-dia');
        if (btnBanner) {
            btnBanner.addEventListener('click', () => {
                const nuevaFecha = calcularSiguienteDiaHabil(bookingState.fecha);
                bookingState.fecha = nuevaFecha;
                bookingState.hora = '';
                const fechaInput = document.getElementById('fecha-input');
                if (fechaInput) fechaInput.value = nuevaFecha;
                actualizarInfoSlotSeleccionado();
                updateNavigationButtons();
                consultarDisponibilidad(nuevaFecha);
            });
        }
    }

    slots.forEach(slot => {
        const { hora, disponible, ocupada, pasada } = slot;
        const estaSeleccionado = (bookingState.hora === hora);

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.dataset.hora = hora;

        if (disponible) {
            btn.className = `slot-btn px-4 py-3 rounded-2xl border text-sm font-extrabold transition-all flex items-center justify-center gap-2 cursor-pointer select-none 
                ${estaSeleccionado 
                    ? 'border-2 border-teal-600 bg-teal-600 text-white shadow-md shadow-teal-600/30 ring-2 ring-teal-500/30 scale-102' 
                    : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white hover:border-teal-500 hover:bg-teal-50/40 dark:hover:bg-teal-950/20 active:scale-95'}`;
            
            btn.innerHTML = `
                <svg class="w-4 h-4 ${estaSeleccionado ? 'text-white' : 'text-teal-600 dark:text-teal-400'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>${hora}</span>
            `;

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                seleccionarHora(hora, btn);
            });
        } else {
            btn.disabled = true;
            btn.className = `px-4 py-3 rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-850 text-slate-400 dark:text-slate-600 text-xs font-semibold flex items-center justify-center gap-1 cursor-not-allowed opacity-50`;
            btn.innerHTML = `
                <span class="line-through">${hora}</span>
                <span class="text-[10px] uppercase font-bold">(${ocupada ? 'Ocupado' : 'Pasado'})</span>
            `;
        }

        grid.appendChild(btn);
    });

    actualizarInfoSlotSeleccionado();
}

/**
 * Event delegation de respaldo sobre el grid de slots
 */
function setupSlotsGridDelegation() {
    const grid = document.getElementById('slots-grid');
    if (!grid) return;

    grid.addEventListener('click', (e) => {
        const btn = e.target.closest('.slot-btn');
        if (!btn || btn.disabled) return;
        const hora = btn.dataset.hora;
        if (hora && bookingState.hora !== hora) {
            seleccionarHora(hora, btn);
        }
    });
}

function seleccionarHora(hora, btnElement) {
    if (!hora) return;
    bookingState.hora = hora;

    // Resaltar visualmente el botón seleccionado en la grilla
    document.querySelectorAll('.slot-btn').forEach(b => {
        b.className = 'slot-btn px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white hover:border-teal-500 hover:bg-teal-50/40 dark:hover:bg-teal-950/20 active:scale-95 text-sm font-extrabold transition-all flex items-center justify-center gap-2 cursor-pointer select-none';
        const svg = b.querySelector('svg');
        if (svg) svg.className = 'w-4 h-4 text-teal-600 dark:text-teal-400';
    });

    if (btnElement) {
        btnElement.className = 'slot-btn px-4 py-3 rounded-2xl border-2 border-teal-600 bg-teal-600 text-white shadow-lg shadow-teal-600/30 text-sm font-extrabold transition-all flex items-center justify-center gap-2 cursor-pointer ring-2 ring-teal-500/30 scale-102 select-none';
        const activeSvg = btnElement.querySelector('svg');
        if (activeSvg) activeSvg.className = 'w-4 h-4 text-white';
    }

    // Actualizar la tarjeta de confirmación del Paso 3
    actualizarInfoSlotSeleccionado();
    
    // Habilitar los controles de navegación
    updateNavigationButtons();

    // Actualizar de inmediato los textos de confirmación del Paso 4
    prepararResumen();

    // Transición suave directa al Paso 4
    setTimeout(() => {
        goToStep(4);
    }, 280);
}

function actualizarInfoSlotSeleccionado() {
    const card = document.getElementById('slot-seleccionado-card');
    const texto = document.getElementById('slot-seleccionado-texto');
    if (!card || !texto) return;

    if (bookingState.fecha && bookingState.hora) {
        try {
            const fechaParts = bookingState.fecha.split('-');
            const y = parseInt(fechaParts[0], 10);
            const m = parseInt(fechaParts[1], 10) - 1;
            const d = parseInt(fechaParts[2], 10);
            const dateObj = new Date(y, m, d);
            const opciones = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const fechaLegible = dateObj.toLocaleDateString('es-CO', opciones);

            texto.textContent = `${bookingState.hora} hrs · ${fechaLegible}`;
        } catch (e) {
            texto.textContent = `${bookingState.hora} hrs · ${bookingState.fecha}`;
        }
        card.classList.remove('hidden');
    } else {
        card.classList.add('hidden');
    }
}

function setupContinuarPaso4Button() {
    const btn = document.getElementById('btn-continuar-paso4');
    if (btn) {
        btn.addEventListener('click', () => {
            if (validarPasoActual()) {
                goToStep(4);
            }
        });
    }
}

/**
 * ==========================================
 * PASO 4: RESUMEN Y CONFIRMACIÓN
 * ==========================================
 */
function prepararResumen() {
    const resServicio = document.getElementById('resumen-servicio');
    const resProfesional = document.getElementById('resumen-profesional');
    const resFechaHora = document.getElementById('resumen-fechahora');

    if (resServicio && bookingState.servicio) {
        resServicio.textContent = bookingState.servicio.nombre_servicio;
    }

    if (resProfesional && bookingState.profesional) {
        resProfesional.textContent = `${bookingState.profesional.nombre_completo} (${bookingState.profesional.especializacion || bookingState.profesional.profesion})`;
    }

    if (resFechaHora) {
        if (bookingState.fecha && bookingState.hora) {
            try {
                const fechaParts = bookingState.fecha.split('-');
                const y = parseInt(fechaParts[0], 10);
                const m = parseInt(fechaParts[1], 10) - 1;
                const d = parseInt(fechaParts[2], 10);
                const dateObj = new Date(y, m, d);
                const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const fechaFormateada = dateObj.toLocaleDateString('es-CO', opciones);

                resFechaHora.innerHTML = `<span class="capitalize">${fechaFormateada}</span> a las <strong class="text-teal-600 dark:text-teal-400 text-lg">${bookingState.hora} hrs</strong>`;
            } catch (e) {
                resFechaHora.textContent = `${bookingState.fecha} a las ${bookingState.hora} hrs`;
            }
        } else if (bookingState.hora) {
            resFechaHora.textContent = `A las ${bookingState.hora} hrs`;
        } else {
            resFechaHora.textContent = 'Horario no seleccionado';
        }
    }

    updateNavigationButtons();
}

function setupConfirmacionButton() {
    const btnConfirmar = document.getElementById('btn-confirmar-cita');
    if (!btnConfirmar) return;

    btnConfirmar.addEventListener('click', async () => {
        if (!validarPasoActual()) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Faltan datos',
                    text: 'Por favor completa todos los pasos antes de confirmar la cita.'
                });
            }
            return;
        }

        const originalText = btnConfirmar.innerHTML;
        btnConfirmar.disabled = true;
        btnConfirmar.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span>Reservando cita en la agenda...</span>
        `;

        try {
            const payload = {
                id_profesional: bookingState.profesional.id,
                fecha: bookingState.fecha,
                hora: bookingState.hora,
                servicios: bookingState.servicio.id
            };

            const respuesta = await fetch('/public/api/cita', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const data = await respuesta.json();

            if (data.ok) {
                if (typeof Swal !== 'undefined') {
                    await Swal.fire({
                        icon: 'success',
                        title: '¡Cita Confirmada con Éxito!',
                        html: `
                            <p class="text-sm text-slate-600 mb-2">Tu consulta médica ha sido reservada satisfactoriamente en el sistema.</p>
                            <div class="p-4 rounded-2xl bg-teal-50 text-teal-800 text-xs text-left space-y-1 border border-teal-200">
                                <div><strong>Servicio:</strong> ${escapeHtml(bookingState.servicio.nombre_servicio)}</div>
                                <div><strong>Especialista:</strong> ${escapeHtml(bookingState.profesional.nombre_completo)}</div>
                                <div><strong>Fecha y Hora:</strong> ${escapeHtml(bookingState.fecha)} - ${escapeHtml(bookingState.hora)} hrs</div>
                            </div>
                        `,
                        confirmButtonText: 'Ver Mis Citas Agendadas',
                        confirmButtonColor: '#0d9488'
                    });
                } else {
                    alert('¡Cita Confirmada con Éxito!');
                }
                window.location.href = '/public/misCitas';
            } else {
                throw new Error(data.mensaje || 'No fue posible guardar la reserva.');
            }
        } catch (error) {
            console.error('Error al reservar cita:', error);
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo reservar',
                    text: error.message || 'Ocurrió un error inesperado al procesar tu cita. Intenta con otro horario.'
                });
            } else {
                alert(error.message || 'Error al procesar la cita.');
            }
            btnConfirmar.disabled = false;
            btnConfirmar.innerHTML = originalText;
        }
    });
}

/**
 * Utilidad de escape seguro para inyección de texto HTML
 */
function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}