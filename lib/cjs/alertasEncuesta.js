"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var flowbite_1 = require("flowbite");
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
mostrarAlerta();
//# sourceMappingURL=alertasEncuesta.js.map