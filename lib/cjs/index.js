"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (g && (g = 0, op[0] && (_ = 0)), _) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
Object.defineProperty(exports, "__esModule", { value: true });
var flowbite_1 = require("flowbite");
document.addEventListener("DOMContentLoaded", function () {
    iniciarApp();
});
function iniciarApp() {
    consultarApi(); // consulta la api en el backend de php
}
function consultarApi() {
    return __awaiter(this, void 0, void 0, function () {
        var url, resultado, data, bookings, error_1;
        return __generator(this, function (_a) {
            switch (_a.label) {
                case 0:
                    _a.trys.push([0, 3, , 4]);
                    url = "https://api.cal.com/v1/bookings?userId=1&apiKey=cal_live_734742ae8dbe3eae4139d063a47b8f3d";
                    return [4 /*yield*/, fetch(url)];
                case 1:
                    resultado = _a.sent();
                    return [4 /*yield*/, resultado.json()];
                case 2:
                    data = _a.sent();
                    bookings = data.bookings;
                    filtrar(bookings);
                    return [3 /*break*/, 4];
                case 3:
                    error_1 = _a.sent();
                    console.log(error_1);
                    return [3 /*break*/, 4];
                case 4: return [2 /*return*/];
            }
        });
    });
}
function filtrar(bookings) {
    var _a;
    // Filtrar el resultado
    var div = document.getElementById("usuarioEmail");
    if (!div) {
        console.log("Elemento div no encontrado");
        return;
    }
    // Obtener el contenido de texto del div
    var correoFiltrar = (_a = div.textContent) === null || _a === void 0 ? void 0 : _a.trim();
    if (!correoFiltrar) {
        console.log("Correo electrónico no encontrado en el div");
        return;
    }
    // Filtrar el arreglo para incluir solo las reservaciones con el correo especificado
    var reservasFiltradas = bookings.filter(function (reserva) { return reserva.attendees[0].email === correoFiltrar; });
    //Segundo filtro que excluye las reservas pasadas
    var fechaActual = new Date();
    var citasFuturas = reservasFiltradas.filter(function (reserva) {
        var fechaCita = new Date(reserva.startTime);
        return fechaCita > fechaActual;
    });
    //Tercer filtro que valida la citas que no esten canceladas
    var citasNoCanceladas = citasFuturas.filter(function (reserva) {
        return reserva.status !== "CANCELLED";
    });
    // console.log(citasNoCanceladas);
    if (citasNoCanceladas.length !== 0) {
        mostrarAlerta();
        //obtener fechaFormateada
        var fechasFormateadas = formatearFecha(citasFuturas);
        console.log(fechasFormateadas[0]);
        // cambiar el contenido del mensaje del modal
        var pElement = document.getElementById('mensaje-cita');
        pElement.textContent = "Solo se permite agendar una cita por usuario. \n        Actualmente, ya tienes una cita programada para ".concat(fechasFormateadas[0], ". \n        Por favor, cancela o reprograma la cita existente si deseas agendar una nueva. \n        Esto nos ayuda a garantizar una mejor organizaci\u00F3n y disponibilidad para todos nuestros usuarios.");
    }
}
function mostrarAlerta() {
    var $modalElement = document.getElementById('default-modal');
    var modalOptions = {
        placement: 'center',
        backdrop: 'static',
        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
        closable: true
    };
    // instance options object
    var instanceOptions = {
        id: 'default-modal',
        override: true
    };
    var modal = new flowbite_1.Modal($modalElement, modalOptions, instanceOptions);
    modal.show();
}
function formatearFecha(bookings) {
    var fechasFormateadas = [];
    bookings.forEach(function (reserva) {
        var isoDate = reserva.startTime;
        // Crea un objeto Date a partir de la cadena ISO
        var date = new Date(isoDate);
        // Obtén los componentes de la fecha
        var options = {
            weekday: 'long', // Día de la semana
            year: 'numeric', // Año
            month: 'long', // Mes
            day: 'numeric', // Día del mes
            hour: '2-digit', // Hora
            minute: '2-digit' // Minuto
        };
        // Formatea la fecha a una cadena legible
        fechasFormateadas.push(date.toLocaleDateString('es-ES', options));
    });
    return fechasFormateadas;
}
var flowbite_2 = require("flowbite");
var tabsElement = document.getElementById('tabs-example');
// create an array of objects with the id, trigger element (eg. button), and the content element
var tabElements = [
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
var options = {
    defaultTabId: 'profile',
    activeClasses: 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
    inactiveClasses: 'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: function () {
        // console.log('tab is shown');
    },
};
// instance options with default values
var instanceOptions = {
    id: 'tabs-example',
    override: true
};
/*
* tabsElement: parent element of the tabs component (required)
* tabElements: array of tab elements (required)
* options (optional)
* instanceOptions (optional)
*/
var tabs = new flowbite_2.Tabs(tabsElement, tabElements, options, instanceOptions);
tabs.show("profile");
//botones
var siguiente = document.getElementById("siguiente");
var atras = document.getElementById("atras");
// Inicializar el índice de la pestaña actual
var currentTabIndex = tabElements.findIndex(function (tab) { return tab.id === options.defaultTabId; });
// Función para mostrar la pestaña en base al índice actual
function showTabByIndex(index) {
    var tab = tabElements[index];
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
//# sourceMappingURL=index.js.map