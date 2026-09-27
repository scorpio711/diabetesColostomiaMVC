/**
 * Gestor de Historial y Cancelación de Citas Médicas
 * Carefulness - Sistema de Gestión de Citas
 */

if (window.__misCitasInitialized) {
    console.log('Mis Citas ya inicializado.');
} else {
    window.__misCitasInitialized = true;
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMisCitas);
    } else {
        initMisCitas();
    }
}

function initMisCitas() {
    setupFiltrosYBusqueda();
    setupCancelacionModales();
    checkAlertaCancelacionUrl();
}

/**
 * 1. Filtros por Pestaña (Todas / Próximas / Finalizadas) y Búsqueda en Vivo
 */
function setupFiltrosYBusqueda() {
    const inputBusqueda = document.getElementById('input-busqueda-citas');
    const tabs = document.querySelectorAll('.tab-filtro');
    const btnLimpiar = document.getElementById('btn-limpiar-busqueda');
    const cards = document.querySelectorAll('.cita-card');
    const sinResultados = document.getElementById('citas-sin-resultados');

    let filtroActual = 'todas';
    let queryActual = '';

    function aplicarFiltros() {
        let visibles = 0;

        cards.forEach(card => {
            const estado = card.dataset.estado || '';
            const searchData = card.dataset.search || '';

            // 1. Chequeo de pestaña
            let pasaFiltro = false;
            if (filtroActual === 'todas') {
                pasaFiltro = true;
            } else if (filtroActual === 'proxima') {
                pasaFiltro = (estado === 'proxima' || estado === 'hoy');
            } else if (filtroActual === 'pasada') {
                pasaFiltro = (estado === 'pasada');
            }

            // 2. Chequeo de texto de búsqueda
            let pasaBusqueda = true;
            if (queryActual.trim().length > 0) {
                pasaBusqueda = searchData.includes(queryActual.trim().toLowerCase());
            }

            if (pasaFiltro && pasaBusqueda) {
                card.classList.remove('hidden');
                visibles++;
            } else {
                card.classList.add('hidden');
            }
        });

        if (sinResultados) {
            if (visibles === 0 && cards.length > 0) {
                sinResultados.classList.remove('hidden');
            } else {
                sinResultados.classList.add('hidden');
            }
        }
    }

    // Listener de input de búsqueda
    if (inputBusqueda) {
        inputBusqueda.addEventListener('input', (e) => {
            queryActual = e.target.value;
            aplicarFiltros();
        });
    }

    // Listener de pestañas de filtro
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => {
                t.className = 'tab-filtro px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 transition-all cursor-pointer';
            });

            tab.className = 'tab-filtro px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all bg-white dark:bg-slate-800 text-teal-700 dark:text-teal-300 shadow-xs cursor-pointer';
            filtroActual = tab.dataset.filter || 'todas';
            aplicarFiltros();
        });
    });

    // Botón de limpiar búsqueda
    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', () => {
            if (inputBusqueda) inputBusqueda.value = '';
            queryActual = '';
            filtroActual = 'todas';
            tabs.forEach((t, i) => {
                if (i === 0) {
                    t.className = 'tab-filtro px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all bg-white dark:bg-slate-800 text-teal-700 dark:text-teal-300 shadow-xs cursor-pointer';
                } else {
                    t.className = 'tab-filtro px-3.5 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 transition-all cursor-pointer';
                }
            });
            aplicarFiltros();
        });
    }
}

/**
 * 2. Confirmación y Cancelación Segura de Citas
 */
function setupCancelacionModales() {
    // Delegación global sobre el documento para garantizar que cualquier botón funcione
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('.btn-cancelar-modal');
        if (!btn) return;

        e.preventDefault();
        e.stopPropagation();

        const form = btn.closest('form');
        if (!form) return;

        const card = btn.closest('.cita-card');
        const citaIdInput = form.querySelector('input[name="citaId"]');
        const citaId = citaIdInput ? citaIdInput.value : '';

        if (!citaId) {
            console.error('No se encontró el ID de la cita a cancelar');
            return;
        }

        const ejecutarCancelacion = async () => {
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = `
                <svg class="animate-spin h-3.5 w-3.5 text-rose-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span>Cancelando...</span>
            `;

            try {
                const formData = new FormData(form);
                formData.append('ajax', '1');

                const respuesta = await fetch('/public/misCitas', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await respuesta.json();

                if (data.ok) {
                    if (card) {
                        card.style.transition = 'all 0.35s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            card.remove();
                            recalcularContadores();
                        }, 350);
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Cita Cancelada!',
                            text: 'La consulta médica ha sido liberada y eliminada de tu agenda.',
                            confirmButtonColor: '#0d9488',
                            confirmButtonText: 'Aceptar',
                            timer: 3500
                        });
                    }
                } else {
                    throw new Error(data.mensaje || 'Error al cancelar la cita.');
                }
            } catch (err) {
                console.warn('Fallo en cancelación asíncrona, enviando por formulario tradicional:', err);
                form.submit();
            }
        };

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Deseas cancelar esta cita médica?',
                html: '<p class="text-sm text-slate-600 dark:text-slate-300 mt-2">Esta acción liberará el horario del especialista para que esté disponible a otros pacientes.</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Sí, cancelar cita',
                cancelButtonText: 'No, mantenerla',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    ejecutarCancelacion();
                }
            });
        } else {
            if (confirm('¿Estás seguro de cancelar esta cita médica?')) {
                ejecutarCancelacion();
            }
        }
    });
}

/**
 * Recalcula en vivo los contadores de KPIs y pestañas si se elimina una tarjeta
 */
function recalcularContadores() {
    const cards = document.querySelectorAll('.cita-card');
    let proximas = 0;
    let pasadas = 0;

    cards.forEach(c => {
        const est = c.dataset.estado;
        if (est === 'proxima' || est === 'hoy') proximas++;
        else if (est === 'pasada') pasadas++;
    });

    // Actualizar tabs
    const tabTodas = document.querySelector('.tab-filtro[data-filter="todas"]');
    const tabProx = document.querySelector('.tab-filtro[data-filter="proxima"]');
    const tabPas = document.querySelector('.tab-filtro[data-filter="pasada"]');

    if (tabTodas) tabTodas.textContent = `Todas (${cards.length})`;
    if (tabProx) tabProx.textContent = `Próximas (${proximas})`;
    if (tabPas) tabPas.textContent = `Finalizadas (${pasadas})`;

    // Si ya no quedan citas, recargar para mostrar el estado vacío
    if (cards.length === 0) {
        window.location.reload();
    }
}

/**
 * 3. Notificación de éxito si el usuario viene de cancelar una cita por método estándar
 */
function checkAlertaCancelacionUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('resultado') === '1') {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: '¡Cita Cancelada!',
                text: 'La cita médica ha sido liberada y retirada de tu agenda satisfactoriamente.',
                confirmButtonColor: '#0d9488',
                confirmButtonText: 'Entendido',
                timer: 4000
            });
        }
        // Limpiar ?resultado=1 de la barra de dirección sin recargar la página
        const urlLimpia = window.location.pathname;
        window.history.replaceState({}, document.title, urlLimpia);
    }
}
