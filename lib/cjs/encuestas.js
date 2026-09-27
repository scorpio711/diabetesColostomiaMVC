"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var flowbite_1 = require("flowbite");
var $modalElement = document.querySelector('#modalEl');
var modalOptions = {
    placement: 'center',
    backdrop: 'static',
    backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
    closable: true,
    onHide: function () {
        console.log('modal is hidden');
    },
    onShow: function () {
        console.log('modal is shown');
    },
    onToggle: function () {
        console.log('modal has been toggled');
    },
};
// instance options object
var instanceOptions = {
    id: 'modalEl',
    override: true
};
var modal = new flowbite_1.Modal($modalElement, modalOptions, instanceOptions);
modal.show();
//# sourceMappingURL=encuestas.js.map